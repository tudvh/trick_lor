@php
use App\Helpers\DateHelper;
@endphp

<div class="content-wrapper row">
    @foreach ($listPosts as $post)
    <div class="item col-12 col-sm-{{ $colSm }} col-lg-{{ $colLg }}">
        <a href="{{ route('site.post', ['post' => $post->slug]) }}">
            <div class="img-box">
                <?php
                if ($post->thumbnails_custom) {
                    $thumbnails = $post->thumbnails_custom;
                } elseif ($post->thumbnails) {
                    $thumbnails = $post->thumbnails;
                } else {
                    $thumbnails = [
                        url('public/assets/img/post-thumbnail/post-thumbnail-default/mqdefault.png'),
                        url('public/assets/img/post-thumbnail/post-thumbnail-default/hqdefault.png'),
                        url('public/assets/img/post-thumbnail/post-thumbnail-default/maxresdefault.png')
                    ];
                }
                ?>
                <x-thumbnail :thumbnails="$thumbnails" :alt="$post->title" />
            </div>
            <div class="info">
                <h3 class="title">{{ $post->title }}</h3>
                <span>{{ DateHelper::convertDateFormat($post->created_at) }}</span>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($post->postLanguages as $postLanguage)
                    <div class="icon-box">{!! $postLanguage->language->icon !!}</div>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>