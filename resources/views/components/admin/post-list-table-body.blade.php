@php
use \App\Helpers\DateHelper;
@endphp

<div class="table-responsive">
    <table class="table table-hover table-bordered align-middle m-0">
        <thead class="table-secondary">
            <tr>
                <th>Id</th>
                <th>Tiêu đề</th>
                <th>Youtube Id</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <td class="post-title">{{ $post->title }}</td>
                <td>{{ $post->youtube_id }}</td>
                <td>{{ DateHelper::convertDateFormat($post->created_at) }}</td>
                <td>
                    @if($post->active)
                    <span class='badge bg-success'>Hoạt động</span>
                    @else
                    <span class='badge bg-danger'>Ẩn</span>
                    @endif
                </td>
                <td>
                    <div class='d-flex justify-content-center align-items-center gap-2'>
                        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class='btn btn-primary'>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        @if($post->active)
                        <button class='btn btn-danger' data-index="{{ $post->id }}" onclick="togglePostStatus('{{ $post->id }}', false)">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                        @else
                        <button class='btn btn-success' data-index="{{ $post->id }}" onclick="togglePostStatus('{{ $post->id }}', true)">
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

<div class="mt-3">
    {{ $posts->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>