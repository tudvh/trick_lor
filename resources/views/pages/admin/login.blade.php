<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="{{ url('public/admin/css/style_login.css') }}">
  <link rel="icon" href="{{ url('public/site/img/logo-icon.png') }}">

  <style>
    .error {
      color: red;

      margin-top: 15px;
      display: block;
      font-weight: bold;
      font-style: italic;
      text-align: center;
    }

    .none {
      display: none;
    }
  </style>
</head>

<body>
  <div class="center">
    <h1>Đăng nhập Admin</h1>
    <form action="{{ route('admin.login') }}" method="post">
      @csrf
      @if (session('error'))
      <p class="error">{{ session('error') }}</p>
      @endif
      <div class="txt_field">
        <input type="text" required name='username'>
        <span></span>
        <label>Tài khoản</label>
      </div>
      <div class="txt_field">
        <input type="password" required name='password'>
        <span></span>
        <label>Mật khẩu</label>
      </div>

      <input type="submit" value="Login">
      <div class="signup_link">
      </div>
    </form>
  </div>

  <!-- <script src="{{ url('public/assets/js/hide-logo.js') }}"></script> -->
</body>

</html>