<?php

namespace App\Http\Controllers\Admin;

use \App\Helpers\DateHelper;
use App\Models\Post;
use App\Models\Code;
use App\Models\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    private function renderTable($listPost)
    {
        $renderStr = '';
        foreach ($listPost as $post) {
            $activeString = $post->active ? "<span class='badge bg-success'>Hoạt động</span>" : "<span class='badge bg-danger'>Ẩn</span>";
            $activeIcon = '';
            if (!$post->active) {
                $activeIcon = "<button class='btn btn-success' onclick='togglePost($post->id)'>
                <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 576 512'>
                    <path style='fill:#fff;' d='M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z'/>
                </svg>
                </button>";
            } else {
                $activeIcon = "<button class='btn btn-danger' onclick='togglePost($post->id)'>
                    <svg  xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 640 512'><path style='fill:#fff;' d='M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z'/></svg>      
                </button>";
            }
            $dateCreateString = DateHelper::convertDateFormat($post->created_at);
            $renderStr .= "<tr>
            <th scope='row'> $post->id </th>
            <td> $post->title </td>
            <td> $post->youtube_id </td>
            <td>  $dateCreateString </td>
            <td>
                $activeString
            </td>
            <td>
                <a href='' class='btn btn-primary'>
                    <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'>
                        <path style='fill:#fff' d='M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z' />
                    </svg>
                </a>
                $activeIcon
            </td>
        </tr>";
        }
        return $renderStr;
    }

    public function index()
    {
        $posts = Post::all();
        $page = 'posts';
        $listLanguage = Language::all();
        $postRender = $this->renderTable($posts);

        return view('pages.admin.posts.index', compact('postRender', 'page', 'listLanguage'));
    }

    public function create()
    {
        $listLanguage = Language::all();
        $page = 'posts';
        return view('pages.admin.posts.create', compact('listLanguage', 'page'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title',
            'youtube_id' => 'required|unique:posts,youtube_id',

        ], [
            'title.required' => 'Vui lòng nhập title.',
            'title.unique' => 'Tên bài đăng đã tồn tại.',

            'youtube_id.required' => 'Vui lòng nhập youtube_id.',
            'youtube_id.unique' => 'Youtube_id đã tồn tại.'

        ]);


        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->youtube_id = $request->youtube_id;
        $post->description = $request->input('description');
        $post->active = $request->status;
        
        $links=["https://i.ytimg.com/vi/{$post->youtube_id}/mqdefault.jpg",
            "https://i.ytimg.com/vi/{$post->youtube_id}/hqdefault.jpg",
            "https://i.ytimg.com/vi/{$post->youtube_id}/maxresdefault.jpg"
        ];
        $post->thumbnail = json_encode($links);

        $post->save();
        foreach($request->languages as $language){
            $code =  new Code();
            $code->post_id = $post->id;
            $code->language_id = $language;
            $code->save();
        } 
        
        
        

        return redirect()->route('admin.posts.index')->with("success","Thêm bài đăng thành công!");
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }

    public function search(Request $request)
    {
        $status = $request->status;
        $language = $request->language;
        $listPost = Post::query();
        if ($status != '') {
            $listPost = $listPost->where('active', $status);
        }
        if ($language != '') {
            $listPost = $listPost->whereHas('codes', function ($query) use ($language) {
                return $query->where('language_id', $language);
            });
        }
        $listPost = $listPost->where('title', 'like', '%' . $request->title . '%')->get();
        $postRender = $this->renderTable($listPost);
        return $postRender;
    }

    public function setStatus(Post $post)
    {
        $post->active = $post->active == 1 ? 0 : 1;
        $post->save();
        return redirect()->route('admin.posts.index');
    }

    public function preview(Request $request){
        $post = new Post();
        $post->id=9999;
        $post->title = $request->title;
        $post->youtube_id = $request->youtube_id;
        

        $post->description = $request->input('description');

        $postLanguages = collect($request->languages)->map(function ($language) use ($post) {
            return new Code([
                'post_id' => $post->id,
                'language_id' => $language
            ]);
        });
        
        $post->codes=$postLanguages;
        
        
        
        echo view('components.product-detail',compact('post'));
    }
}
