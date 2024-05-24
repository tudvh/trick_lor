@props(['thumbnails' => [], 'alt' => '', 'class' => ''])

@php
    $thumbnailMq = $thumbnails[0] ?? '';
    $thumbnailHq = $thumbnails[1] ?? '';
    $thumbnailMax = $thumbnails[2] ?? '';
@endphp

<img src="{{ $thumbnailMq }}" srcset="{{ $thumbnailMq }} 180w, {{ $thumbnailHq }} 360w, {{ $thumbnailMax }} 720w"
    sizes="(max-width: 600px) 180px, (max-width: 1024px) 360px, 720px" alt="{{ $alt }}"
    class="{{ $class }}" />
