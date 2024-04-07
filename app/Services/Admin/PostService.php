<?php

namespace App\Services\Admin;

use App\Helpers\StringHelper;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Repositories\Post\PostRepository;
use App\Services\CloudinaryService;
use DOMDocument;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PostService
{
    private const CLOUDINARY_ROOT_PATH = "post";
    private const IMAGE_DESCRIPTION_MAX_QUALITY = 720;

    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected PostRepository $postRepository
    ) {
    }

    /**
     * Get a list of posts based on the search criteria
     *
     * @param array $dataSearch
     * @return LengthAwarePaginator
     */
    public function getList(array $dataSearch): LengthAwarePaginator
    {
        return $this->postRepository->getListForAdmin($dataSearch);
    }

    public function getByUserId($userId, $searchKey, $searchCategory, $searchStatus, $sortBy)
    {
        $posts = Post::where('author_id', $userId);

        if ($searchStatus != null) {
            $posts->where('status', $searchStatus);
        }
        if ($searchCategory != null) {
            $posts->whereHas('categories', function ($query) use ($searchCategory) {
                return $query->where('slug', $searchCategory);
            });
        }
        if ($searchKey != null) {
            $searchKey = '%' . str_replace(' ', '%', trim($searchKey))  . '%';

            $posts->where(function ($query) use ($searchKey) {
                $query->where('id', 'like', $searchKey)
                    ->orWhere('title', 'like', $searchKey)
                    ->orWhere('description', 'like', $searchKey)
                    ->orWhere('youtube_id', 'like', $searchKey)
                    ->orWhereHas('categories', function ($query) use ($searchKey) {
                        return $query->where('name', 'like', $searchKey);
                    });
            });
        }
        if ($sortBy == 'most-popular') {
            $posts->withCount(['postViews as views'])
                ->orderBy('views', 'desc');
        }

        $posts = $posts->with([
            'categories:name,icon_color',
            'postViews',
            'postComments'
        ])
            ->latest('id')
            ->paginate(20);

        return $posts;
    }

    /**
     * Get a single post by its ID
     *
     * @param int $id
     * @return Post
     */
    public function findById(int $id): Post
    {
        return $this->postRepository->findBy($id, 'id');
    }

    public function createToPreview($title, $authorId, $youtubeId = null, $description = null, $categories)
    {
        $post = new Post([
            'id' => 999999,
            'title' => Str::ucfirst(trim($title)),
            'author_id' => $authorId,
            'youtube_id' => trim($youtubeId),
            'description' => trim($description),
        ]);

        $postCategories = collect($categories)->map(function ($categoryId) use ($post) {
            return new CategoryPost([
                'post_id' => $post->id,
                'category_id' => $categoryId
            ]);
        });
        $post->postCategories = $postCategories;

        return $post;
    }

    public function create($title, $authorId, $youtubeId = null, $description = null, $thumbnailCustom)
    {
        $postTitle = StringHelper::handleTitle($title);

        $post = Post::create([
            'title' => $postTitle,
            'slug' => Str::slug($postTitle),
            'author_id' => $authorId,
            'youtube_id' => $youtubeId ? $youtubeId : null,
        ]);

        $post->description = $this->handleDescription(trim($description), $post->id, $post->title);

        if ($youtubeId) {
            $post->thumbnails = [
                "https://i.ytimg.com/vi/{$youtubeId}/mqdefault.jpg",
                "https://i.ytimg.com/vi/{$youtubeId}/hqdefault.jpg",
                "https://i.ytimg.com/vi/{$youtubeId}/maxresdefault.jpg"
            ];
        }

        if ($thumbnailCustom) {
            $post->thumbnails_custom = $this->handleThumbnailCustom($thumbnailCustom, $post->id);
        }

        $post->save();

        return $post;
    }

    // public function update(Post $post, $title, $youtubeId = null, $status, $description = null, $thumbnailCustom, $isRemoveThumbnailCustom)
    // {
    //     $post->title = StringHelper::handleTitle($title);
    //     $post->slug = Str::slug($post->title);
    //     $post->youtube_id = $youtubeId ? $youtubeId : null;
    //     $post->status = $status;

    //     $post->description = $this->handleDescription(trim($description), $post->id, $post->title);
    //     $this->deleteImageDescriptionOld($post->id, $post->description);

    //     if ($youtubeId) {
    //         $post->thumbnails = [
    //             "https://i.ytimg.com/vi/{$youtubeId}/mqdefault.jpg",
    //             "https://i.ytimg.com/vi/{$youtubeId}/hqdefault.jpg",
    //             "https://i.ytimg.com/vi/{$youtubeId}/maxresdefault.jpg"
    //         ];
    //     } else {
    //         $post->thumbnails = null;
    //     }

    //     if ($thumbnailCustom) {
    //         $post->thumbnails_custom = $this->handleThumbnailCustom($thumbnailCustom, $post->id);
    //     } elseif ($isRemoveThumbnailCustom && $post->thumbnails_custom) {
    //         $folderPath = $this::CLOUDINARY_ROOT_PATH . "/" . $post->id . "/post-thumbnail";
    //         $this->cloudinaryService->deleteFolder($folderPath);

    //         $post->thumbnails_custom = null;
    //     }

    //     $post->save();
    // }

    /**
     * Update post.
     *
     * @param  Post $post
     * @param  array $attributes
     * @return void
     */
    public function update(Post $post, array $attributes): void
    {
        $this->postRepository->update($post, $attributes);
    }

    public function delete($postId)
    {
        $post = $this->findById($postId);

        // Delete image in Cloudinary
        $folderPath = $this::CLOUDINARY_ROOT_PATH . "/" . $postId;
        $this->cloudinaryService->deleteFolder($folderPath);

        // Delete in DB
        $post->delete();
    }

    public function checkYoutubeId($youtubeId)
    {
        if (!$youtubeId) {
            return true;
        }

        $apiKey = env('YOUTUBE_API_KEY');
        $url = "https://www.googleapis.com/youtube/v3/videos?id={$youtubeId}&key={$apiKey}&part=status";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['items'][0]['status']['embeddable']) && $data['items'][0]['status']['embeddable']) {
                return true;
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            dd('Có lỗi trong lúc kiểm tra Youtube id. Vui lòng thử lại.');
        }

        return false;
    }

    private function handleThumbnailCustom($thumbnailCustomUrl, $postId)
    {
        $thumbnailSizes = ['mqdefault' => 180, 'hqdefault' => 360, 'maxresdefault' => 720];
        $thumbnails = [];

        foreach ($thumbnailSizes as $size => $maxQuality) {
            $publicId = $this::CLOUDINARY_ROOT_PATH . "/$postId/post-thumbnail/$size";
            $uploadedSrc = $this->cloudinaryService->upload($thumbnailCustomUrl, $publicId, $maxQuality)->getSecurePath();

            $thumbnails[] = $uploadedSrc;
        }

        return $thumbnails;
    }

    private function handleDescription($description, $postId, $postTitle)
    {
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));
        $body = $dom->getElementsByTagName('body')->item(0);

        $imageElements = [];
        $this->collectImages($body, $imageElements);

        foreach ($imageElements as $imageElement) {
            $imageSrcOld = $imageElement->getAttribute('src');
            $publicId = $imageElement->getAttribute('data-public-id');

            if ($publicId == '') {
                $imageName = uniqid();
                $imagePublicId = $this::CLOUDINARY_ROOT_PATH . "/$postId/post-description/$imageName";
                $maxQuality = $this::IMAGE_DESCRIPTION_MAX_QUALITY;
                $uploadedResult = $this->cloudinaryService->upload($imageSrcOld, $imagePublicId, $maxQuality);

                $imageElement->setAttribute('src', $uploadedResult->getSecurePath());
                $imageElement->setAttribute('data-public-id', $uploadedResult->getPublicId());
                $imageElement->setAttribute('alt', $postTitle);

                $imageElement->removeAttribute('width');
                $imageElement->removeAttribute('height');
            }
        }

        $bodyContent = '';
        foreach ($body->childNodes as $childNode) {
            $bodyContent .= $dom->saveHTML($childNode);
        }

        return $bodyContent;
    }

    private function deleteImageDescriptionOld($postId, $descriptionUpdate)
    {
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($descriptionUpdate, 'HTML-ENTITIES', 'UTF-8'));
        $imageElements = $dom->getElementsByTagName('img');

        $publicIdsUpdate = collect($imageElements)->map(function ($element) {
            return $element->getAttribute('data-public-id');
        })->toArray();

        $folderPath = $this::CLOUDINARY_ROOT_PATH . "/$postId/post-description";
        $imageResourcesInFolder = $this->cloudinaryService->getAllResourcesInFolder($folderPath);

        $publicIdsDelete = [];
        foreach ($imageResourcesInFolder as $imageResource) {
            if (!in_array($imageResource['public_id'], $publicIdsUpdate)) {
                $publicIdsDelete[] = $imageResource['public_id'];
            }
        }

        if (count($publicIdsDelete) > 0) {
            $this->cloudinaryService->delete($publicIdsDelete);
        }
    }

    private function collectImages($node, &$imageElements)
    {
        foreach ($node->childNodes as $childNode) {
            if ($childNode->nodeName === 'img') {
                $imageElements[] = $childNode;
            } else {
                $this->collectImages($childNode, $imageElements);
            }
        }
    }
}
