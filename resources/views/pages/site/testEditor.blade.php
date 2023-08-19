<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tiny.cloud/1/x8lr9jtz8dxvdavxa6kvrljyfxuuox94bkdn4knyhhg07dsq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>
    <textarea id="hehe11">Welcome to TinyMCE!</textarea>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss preview',
            toolbar: 'undo redo | blocks | bold italic underline strikethrough | link image table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | codesample | preview code',
            tinycomments_mode: 'embedded',
        });
    </script>
</body>

</html>