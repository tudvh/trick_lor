 tinymce.init({
    selector: "#desc-textarea",
    block_formats: 'Header 4=h4;Paragraph=p',
    plugins: "tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss preview",
    toolbar: "undo redo | blocks | bold italic underline strikethrough | link image table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | codesample preview code",
    tinycomments_mode: "embedded",
});