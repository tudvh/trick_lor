@extends('layouts.admin.main')

@section('title', 'Danh sách bài đăng')

@section('css')
<link rel="stylesheet" href="{{ url('public/admin/css/users/index.css') }}">
@stop

@section('content')
<livewire:admin.users.index />
@stop

@section('js')
@stop