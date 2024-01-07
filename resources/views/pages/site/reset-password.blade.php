@extends('layouts.site.main')

@section('meta')
<meta property="og:description" content="">
@stop

@section('title', 'Thiết lập mật khẩu mới - Trick loR')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/personal.css') }}">
@stop

@section('content')
<div class="personal-wrapper card">
    <form method="POST">
        <div class="d-flex flex-column gap-4">
            <h2 class="m-0">Thiết lập mật khẩu mới</h2>

            @csrf

            <input type="hidden" name="verification_token" value="{{ $verificationToken }}">
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
                <i class="far fa-edit"></i>
                <span>Xác nhận</span>
            </button>
        </div>
    </form>
</div>
@stop

@section('js')
@stop