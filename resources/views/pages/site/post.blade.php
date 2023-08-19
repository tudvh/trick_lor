@extends('layouts.site.main')

@section('title', 'Trang chủ')

@section('css')
<link rel="stylesheet" href="{{ url('public/site/css/prism.css') }}">
<link rel="stylesheet" href="{{ url('public/site/css/post.css') }}">
@stop

@section('content')

<div class="row">
    <div class="col-12 col-lg-6">
        <div id="video-box" class="w-100 d-flex justify-content-center">
            <iframe class="video" type="text/html" frameborder="0" style="width: 100%; height: 500px;" src="https://www.youtube-nocookie.com/embed/{{ $post->youtube_id }}?autoplay=1&disablekb=1&fs=0&iv_load_policy=3&loop=1&playlist=0HaBOFvBoIA&modestbranding=1&rel=0&showinfo=0&vq=hd1080"></iframe>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <div class="d-flex justify-content-end align-items-center mt-3 gap-3" id="action">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                    </svg>
                </div>
                <!-- <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" fill="#ff0000" />
                    </svg>
                </div> -->
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mt-4 mt-lg-0 mb-5">
        <h2 class="post-title">{{ $post->title }}</h2>
        <span class="post-info">19/8/2023</span>
        <div class="d-flex gap-2 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24">
                <path d="M12 18.1778L16.6192 16.9222L17.2434 10.1444H9.02648L8.82219 7.88889H17.4477L17.6747 5.67778H6.32535L6.96091 12.3556H14.7806L14.5195 15.2222L12 15.8889L9.48045 15.2222L9.32156 13.3778H7.0517L7.38083 16.9222L12 18.1778ZM3 2H21L19.377 20L12 22L4.62295 20L3 2Z" fill="rgba(227,76,38,1)"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24">
                <path d="M5.00055 3L4.35055 6.34H17.9405L17.5005 8.5H3.92055L3.26055 11.83H16.8505L16.0905 15.64L10.6105 17.45L5.86055 15.64L6.19055 14H2.85055L2.06055 18L9.91055 21L18.9605 18L20.1605 11.97L20.4005 10.76L21.9405 3H5.00055Z" fill="rgba(41,101,241,1)"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24">
                <path d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM13.3344 16.055C14.0531 16.6343 14.7717 16.9203 15.4904 16.913C15.9304 16.913 16.2677 16.8323 16.5024 16.671C16.7297 16.517 16.8434 16.297 16.8434 16.011C16.8434 15.7177 16.7297 15.4683 16.5024 15.263C16.2677 15.0577 15.8241 14.8523 15.1714 14.647C14.3867 14.4197 13.7817 14.1263 13.3564 13.767C12.9384 13.4077 12.7257 12.9053 12.7184 12.26C12.7184 11.6513 12.9824 11.1417 13.5104 10.731C14.0237 10.3203 14.6801 10.115 15.4794 10.115C16.5941 10.115 17.4887 10.3863 18.1634 10.929L17.3934 12.128C17.1221 11.9153 16.8104 11.7613 16.4584 11.666C16.1064 11.556 15.7911 11.501 15.5124 11.501C15.1311 11.501 14.8267 11.5707 14.5994 11.71C14.3721 11.8493 14.2584 12.0327 14.2584 12.26C14.2584 12.5093 14.3977 12.722 14.6764 12.898C14.9551 13.0667 15.4317 13.2537 16.1064 13.459C16.9204 13.701 17.4997 14.0237 17.8444 14.427C18.1891 14.8303 18.3614 15.3437 18.3614 15.967C18.3614 16.605 18.1157 17.155 17.6244 17.617C17.1404 18.0717 16.4364 18.31 15.5124 18.332C14.3024 18.332 13.2904 17.969 12.4764 17.243L13.3344 16.055ZM7.80405 16.693C8.03872 16.8397 8.32105 16.913 8.65105 16.913C8.99572 16.913 9.28172 16.814 9.50905 16.616C9.73639 16.4107 9.85005 16.055 9.85005 15.549V10.247H11.3351V15.835C11.3131 16.7003 11.0637 17.3237 10.5871 17.705C10.3157 17.9323 10.0187 18.0937 9.69605 18.189C9.37339 18.2843 9.06172 18.332 8.76105 18.332C8.21105 18.332 7.72339 18.2367 7.29805 18.046C6.84339 17.8407 6.46205 17.4777 6.15405 16.957L7.18805 16.11C7.37872 16.3667 7.58405 16.561 7.80405 16.693Z" fill="rgba(240,219,79,1)"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 640 512">
                <path d="M320 104.5c171.4 0 303.2 72.2 303.2 151.5S491.3 407.5 320 407.5c-171.4 0-303.2-72.2-303.2-151.5S148.7 104.5 320 104.5m0-16.8C143.3 87.7 0 163 0 256s143.3 168.3 320 168.3S640 349 640 256 496.7 87.7 320 87.7zM218.2 242.5c-7.9 40.5-35.8 36.3-70.1 36.3l13.7-70.6c38 0 63.8-4.1 56.4 34.3zM97.4 350.3h36.7l8.7-44.8c41.1 0 66.6 3 90.2-19.1 26.1-24 32.9-66.7 14.3-88.1-9.7-11.2-25.3-16.7-46.5-16.7h-70.7L97.4 350.3zm185.7-213.6h36.5l-8.7 44.8c31.5 0 60.7-2.3 74.8 10.7 14.8 13.6 7.7 31-8.3 113.1h-37c15.4-79.4 18.3-86 12.7-92-5.4-5.8-17.7-4.6-47.4-4.6l-18.8 96.6h-36.5l32.7-168.6zM505 242.5c-8 41.1-36.7 36.3-70.1 36.3l13.7-70.6c38.2 0 63.8-4.1 56.4 34.3zM384.2 350.3H421l8.7-44.8c43.2 0 67.1 2.5 90.2-19.1 26.1-24 32.9-66.7 14.3-88.1-9.7-11.2-25.3-16.7-46.5-16.7H417l-32.8 168.7z" fill="#8993be" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 448 512">
                <path d="M439.8 200.5c-7.7-30.9-22.3-54.2-53.4-54.2h-40.1v47.4c0 36.8-31.2 67.8-66.8 67.8H172.7c-29.2 0-53.4 25-53.4 54.3v101.8c0 29 25.2 46 53.4 54.3 33.8 9.9 66.3 11.7 106.8 0 26.9-7.8 53.4-23.5 53.4-54.3v-40.7H226.2v-13.6h160.2c31.1 0 42.6-21.7 53.4-54.2 11.2-33.5 10.7-65.7 0-108.6zM286.2 404c11.1 0 20.1 9.1 20.1 20.3 0 11.3-9 20.4-20.1 20.4-11 0-20.1-9.2-20.1-20.4.1-11.3 9.1-20.3 20.1-20.3zM167.8 248.1h106.8c29.7 0 53.4-24.5 53.4-54.3V91.9c0-29-24.4-50.7-53.4-55.6-35.8-5.9-74.7-5.6-106.8.1-45.2 8-53.4 24.7-53.4 55.6v40.7h106.9v13.6h-147c-31.1 0-58.3 18.7-66.8 54.2-9.8 40.7-10.2 66.1 0 108.6 7.6 31.6 25.7 54.2 56.8 54.2H101v-48.8c0-35.3 30.5-66.4 66.8-66.4zm-6.7-142.6c-11.1 0-20.1-9.1-20.1-20.3.1-11.3 9-20.4 20.1-20.4 11 0 20.1 9.2 20.1 20.4s-9 20.3-20.1 20.3z" fill="#4584b6" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 384 512">
                <path d="M277.74 312.9c9.8-6.7 23.4-12.5 23.4-12.5s-38.7 7-77.2 10.2c-47.1 3.9-97.7 4.7-123.1 1.3-60.1-8 33-30.1 33-30.1s-36.1-2.4-80.6 19c-52.5 25.4 130 37 224.5 12.1zm-85.4-32.1c-19-42.7-83.1-80.2 0-145.8C296 53.2 242.84 0 242.84 0c21.5 84.5-75.6 110.1-110.7 162.6-23.9 35.9 11.7 74.4 60.2 118.2zm114.6-176.2c.1 0-175.2 43.8-91.5 140.2 24.7 28.4-6.5 54-6.5 54s62.7-32.4 33.9-72.9c-26.9-37.8-47.5-56.6 64.1-121.3zm-6.1 270.5a12.19 12.19 0 0 1-2 2.6c128.3-33.7 81.1-118.9 19.8-97.3a17.33 17.33 0 0 0-8.2 6.3 70.45 70.45 0 0 1 11-3c31-6.5 75.5 41.5-20.6 91.4zM348 437.4s14.5 11.9-15.9 21.2c-57.9 17.5-240.8 22.8-291.6.7-18.3-7.9 16-19 26.8-21.3 11.2-2.4 17.7-2 17.7-2-20.3-14.3-131.3 28.1-56.4 40.2C232.84 509.4 401 461.3 348 437.4zM124.44 396c-78.7 22 47.9 67.4 148.1 24.5a185.89 185.89 0 0 1-28.2-13.8c-44.7 8.5-65.4 9.1-106 4.5-33.5-3.8-13.9-15.2-13.9-15.2zm179.8 97.2c-78.7 14.8-175.8 13.1-233.3 3.6 0-.1 11.8 9.7 72.4 13.6 92.2 5.9 233.8-3.3 237.1-46.9 0 0-6.4 16.5-76.2 29.7zM260.64 353c-59.2 11.4-93.5 11.1-136.8 6.6-33.5-3.5-11.6-19.7-11.6-19.7-86.8 28.8 48.2 61.4 169.5 25.9a60.37 60.37 0 0 1-21.1-12.8z" fill="#f89820" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 512 512">
                <path d="M216.29 158.39H137C97 147.9 6.51 150.63 6.51 233.18c0 30.09 15 51.23 35 61-25.1 23-37 33.85-37 49.21 0 11 4.47 21.14 17.89 26.81C8.13 383.61 0 393.35 0 411.65c0 32.11 28.05 50.82 101.63 50.82 70.75 0 111.79-26.42 111.79-73.18 0-58.66-45.16-56.5-151.63-63l13.43-21.55c27.27 7.58 118.7 10 118.7-67.89 0-18.7-7.73-31.71-15-41.07l37.41-2.84zm-63.42 241.9c0 32.06-104.89 32.1-104.89 2.43 0-8.14 5.27-15 10.57-21.54 77.71 5.3 94.32 3.37 94.32 19.11zm-50.81-134.58c-52.8 0-50.46-71.16 1.2-71.16 49.54 0 50.82 71.16-1.2 71.16zm133.3 100.51v-32.1c26.75-3.66 27.24-2 27.24-11V203.61c0-8.5-2.05-7.38-27.24-16.26l4.47-32.92H324v168.71c0 6.51.4 7.32 6.51 8.14l20.73 2.84v32.1zm52.45-244.31c-23.17 0-36.59-13.43-36.59-36.61s13.42-35.77 36.59-35.77c23.58 0 37 12.62 37 35.77s-13.42 36.61-37 36.61zM512 350.46c-17.49 8.53-43.1 16.26-66.28 16.26-48.38 0-66.67-19.5-66.67-65.46V194.75c0-5.42 1.05-4.06-31.71-4.06V154.5c35.78-4.07 50-22 54.47-66.27h38.63c0 65.83-1.34 61.81 3.26 61.81H501v40.65h-60.56v97.15c0 6.92-4.92 51.41 60.57 26.84z" fill="#f34f29" />
            </svg>
        </div>
        <div class="mt-5 post-desc">
            <h4>Giới thiệu</h4>
            <p>H&agrave;m <code>calc()</code> l&agrave; một c&ocirc;ng cụ mạnh mẽ cho ph&eacute;p bạn thực hiện c&aacute;c ph&eacute;p t&iacute;nh to&aacute;n trong CSS. Điều n&agrave;y rất hữu &iacute;ch khi bạn cần t&iacute;nh to&aacute;n gi&aacute; trị của thuộc t&iacute;nh CSS dựa tr&ecirc;n c&aacute;c gi&aacute; trị kh&aacute;c. <code>calc()</code> c&oacute; thể được sử dụng trong nhiều thuộc t&iacute;nh như <code>width</code>, <code>height</code>, <code>margin</code>, <code>padding</code> v&agrave; nhiều thuộc t&iacute;nh kh&aacute;c.</p>
            <h4>C&aacute;ch sử dụng</h4>
            <p>H&agrave;m <code>calc()</code>&nbsp;c&oacute; c&aacute;ch sử dụng kh&aacute; đơn giản. Bạn chỉ cần sử dụng c&aacute;c ph&eacute;p to&aacute;n (+, -, *, /) để kết hợp c&aacute;c gi&aacute; trị cần t&iacute;nh to&aacute;n.</p>
            <p>V&iacute; dụ:</p>
            <pre class="language-css"><code>width: calc(100% - 20px);
height: calc(50vh + 30px);
padding: calc(10px * 2);</code></pre>
            <p>Trong v&iacute; dụ tr&ecirc;n, ch&uacute;ng ta sử dụng <code>calc()</code> để t&iacute;nh to&aacute;n gi&aacute; trị cho thuộc t&iacute;nh <code>width</code>, <code>height</code> v&agrave; <code>padding</code>.</p>
            <h4>Kết luận</h4>
            <p>H&agrave;m <code>calc()</code> l&agrave; một c&ocirc;ng cụ mạnh mẽ cho ph&eacute;p bạn thực hiện t&iacute;nh to&aacute;n trong CSS, gi&uacute;p tạo ra c&aacute;c thiết kế linh hoạt v&agrave; th&iacute;ch nghi với nhiều k&iacute;ch thước m&agrave;n h&igrave;nh kh&aacute;c nhau. Bằng c&aacute;ch kết hợp c&aacute;c ph&eacute;p to&aacute;n (+, -, *, /) với gi&aacute; trị của c&aacute;c thuộc t&iacute;nh, bạn c&oacute; thể tạo ra c&aacute;c giao diện hấp dẫn v&agrave; linh hoạt cho trang web của m&igrave;nh. H&atilde;y tận dụng <code>calc()</code> để tạo ra c&aacute;c trải nghiệm người d&ugrave;ng tốt hơn tr&ecirc;n mọi thiết bị!</p>

            <pre class="language-php"><code>public function testEditor()
{
    return view('pages.site.testEditor');
}</code></pre>
            <div class="copy-btn" data-clipboard-target="pre code">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
                </svg>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<!-- Prism JS -->
<script src="{{ url('public/site/js/prism.js') }}"></script>
<script>
    Prism.highlightAll();
</script>

<!-- Local JS -->
<script>
    const videoElement = document.querySelector('.video')
    const videoBox = document.querySelector('#video-box')
    const actionBox = document.querySelector('#action')

    function setHeightVideo() {
        const windowHeight = window.innerHeight
        const videoTop = videoElement.offsetTop
        const videoMaxWidth = videoBox.offsetWidth
        const videoMaxHeight = windowHeight - videoTop - 70
        const videoAspectRatio = 9 / 16

        let calculatedWidth, calculatedHeight

        if (videoMaxWidth / videoAspectRatio > videoMaxHeight) {
            calculatedHeight = videoMaxHeight
            calculatedWidth = calculatedHeight * videoAspectRatio
        } else {
            calculatedWidth = videoMaxWidth
            calculatedHeight = calculatedWidth / videoAspectRatio
        }

        videoElement.style.width = `${calculatedWidth}px`
        actionBox.style.width = `${calculatedWidth}px`
        videoElement.style.height = `${calculatedHeight}px`
    }

    setHeightVideo()
    window.addEventListener('resize', setHeightVideo)
</script>
@stop