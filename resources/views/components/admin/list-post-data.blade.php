@php
use \App\Helpers\DateHelper;
use \App\Helpers\NumberHelper;
@endphp

<div class="table-responsive">
    <table class="table table-hover align-middle m-0">
        <thead class="table-secondary">
            <tr>
                <th>Id</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Youtube Id</th>
                <th>Chế độ hiển thị</th>
                <th>Ngày tạo</th>
                <th>Số lượt xem</th>
                <th>Số bình luận</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr class="align-top" data-post-id="{{ $post->id }}">
                <th>{{ $post->id }}</th>
                <td class="post-title" title="{{ $post->title }}">
                    <div class="d-flex gap-3">
                        <div class="thumbnail-container">
                            <div class="thumbnail-box">
                                @if($post->thumbnails_custom)
                                <x-thumbnail :thumbnails="$post->thumbnails_custom" :alt="$post->title" />
                                @elseif($post->thumbnails)
                                <x-thumbnail :thumbnails="$post->thumbnails" :alt="$post->title" />
                                @else
                                <img src="{{ url('public/admin/img/post-default.png') }}" class="thumbnail-content-default">
                                @endif
                            </div>
                        </div>
                        <span class="post-title-text">{{ $post->title }}</span>
                    </div>
                </td>
                <td class="post-language">
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        @foreach($post->postCategories as $postCategory)
                        <div class="icon-box" title="{{ $postCategory->category->name }}">
                            {!! $postCategory->category->icon !!}
                        </div>
                        @endforeach
                    </div>
                </td>
                <td>{{ $post->youtube_id }}</td>
                <td>
                    @if($post->active)
                    <span class='badge bg-success'>Công khai</span>
                    @else
                    <span class='badge bg-secondary'>Riêng tư</span>
                    @endif
                </td>
                <td>{{ DateHelper::convertDateFormat($post->created_at) }}</td>
                <td>{{ NumberHelper::format($post->postViews->count()) }}</td>
                <td>0</td>
                <td>
                    <div class='d-flex justify-content-center align-items-center gap-2'>
                        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class='btn btn-primary' title="Chỉnh sửa bài đăng">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        @if($post->active)
                        <button class='btn btn-danger' onclick="togglePostStatus('{{ $post->id }}', false)" title="Chuyển sang chế độ riêng tư">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                        @else
                        <button class='btn btn-success' onclick="togglePostStatus('{{ $post->id }}', true)" title="Chuyển sang chế độ công khai">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $posts->withQueryString()->links('partials.paginate-custom', ['onEachSide' => 3]) }}