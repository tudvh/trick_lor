@php
use App\Helpers\DateHelper;
@endphp

<div class="content-wrapper row">
    @foreach ($listPosts as $post)
    <div class="item col-12 col-sm-{{ $colSm }} col-lg-{{ $colLg }}">
        <a href="{{ route('site.post', ['post' => $post->slug]) }}">
            <div class="img-box">
                <?php
                $thumbnails = $post->thumbnails;
                if ($thumbnails) {
                    $thumbnailMq = $thumbnails[0];
                    $thumbnailHq = $thumbnails[1];
                    $thumbnailMax = $thumbnails[2];
                } else {
                    $thumbnailMq = url('public/assets/img/post-thumbnail/post-thumbnail-default/mqdefault.png');
                    $thumbnailHq = url('public/assets/img/post-thumbnail/post-thumbnail-default/hqdefault.png');
                    $thumbnailMax = url('public/assets/img/post-thumbnail/post-thumbnail-default/maxresdefault.png');
                }
                ?>
                <img src="{{ $thumbnailMax }}" srcset="{{ $thumbnailMq }} 320w, {{ $thumbnailHq }} 480w, {{ $thumbnailMax }} 1280w" sizes="(max-width: 320px) 280px, (max-width: 480px) 440px, 1280px" alt="{{ $post->title }}" />
            </div>
            <div class="info">
                <h3 class="title">{{ $post->title }}</h3>
                <span>{{ DateHelper::convertDateFormat($post->created_at) }}</span>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($post->codes as $code)
                    <div class="icon-box">{!! $code->language->icon !!}</div>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>