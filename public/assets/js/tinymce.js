tinymce.init({
  selector: '#desc-textarea',
  placeholder: 'Nhập mô tả',
  height: 'calc(100vh - var(--header-height) - 234px)',
  block_formats: 'Header 2=h2;Header 3=h3;Header 4=h4;Paragraph=p',
  plugins:
    'tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss preview fullscreen',
  toolbar:
    'undo redo | blocks | bold italic underline strikethrough | link image table | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | codesample preview code fullscreen',
  tinycomments_mode: 'embedded',
  setup: function (editor) {
    editor.on('change', function () {
      tinymce.triggerSave()
    })
  },
  // init_instance_callback: function (editor) {
  //   editor.editorContainer.classList.add('form-control')
  // },
})
