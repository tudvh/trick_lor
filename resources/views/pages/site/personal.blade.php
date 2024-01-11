@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
@stop

@section('title', 'Thiết lập về tôi - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/assets/css/image-chosen.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/personal.css') }}">
@stop

@section('content')
<div class="personal-wrapper">
    <livewire:site.auth.personal :user="$user" />

    <form class="my-5 card" action="{{ route('site.auth.change-password') }}" method="POST">
        <div class="d-flex flex-column gap-4">
            <h2 class="m-0 fw-bold">Thiết lập mật khẩu mới</h2>

            @csrf

            @if ($user->hasPassword())
            <div class="form-group">
                <label for="password-old" class="form-label">Mật khẩu cũ</label>
                <input type="password" class="form-control @if($errors->has('password_old')) is-invalid @endif" id="password-old" name="password_old" value="{{ old('password_old') }}" required>
                @if ($errors->has('password_old'))
                <small class="text-danger">{{ $errors->first('password_old') }}</small>
                @endif
            </div>
            @endif

            <div class="form-group">
                <label for="password-new" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control @if($errors->has('password_new')) is-invalid @endif" id="password-new" name="password_new" value="{{ old('password_new') }}" required>
                @if ($errors->has('password_new'))
                <small class="text-danger">{{ $errors->first('password_new') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password-new-confirm" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control @if($errors->has('password_new_confirm')) is-invalid @endif" id="password-new-confirm" name="password_new_confirm" value="{{ old('password_new_confirm') }}" required>
                @if ($errors->has('password_new_confirm'))
                <small class="text-danger">{{ $errors->first('password_new_confirm') }}</small>
                @endif
            </div>

            <button type="submit" class="btn btn-success ms-auto gap-2">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Xác nhận</span>
            </button>
        </div>
    </form>
</div>
@stop

@section('js')
@stop