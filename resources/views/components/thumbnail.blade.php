@php
$thumbnailMq = $thumbnails[0];
$thumbnailHq = $thumbnails[1];
$thumbnailMax = $thumbnails[2];
@endphp
<img src="{{ $thumbnailMax }}" srcset="{{ $thumbnailMq }} 320w, {{ $thumbnailHq }} 480w, {{ $thumbnailMax }} 1280w" sizes="(max-width: 320px) 280px, (max-width: 480px) 440px, 1280px" alt="@if(isset($alt){{ $alt }}$endif)" />