$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.htmltexteditor').summernote({
    height: 250,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript', 'fontname', 'strikethrough', 'fontsize', 'color']],
      ['para', ['ul', 'ol', 'paragraph', 'style', 'height']],
      ['picture', ['picture', 'link', 'video', 'table', 'hr']],
      ['fullscreen', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
    ],

    image: [
      ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
      ['float', ['floatLeft', 'floatRight', 'floatNone']],
      ['remove', ['removeMedia']]
    ],
    link: [
      ['link', ['linkDialogShow', 'unlink']]
    ],
    table: [
      ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
      ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
    ],
    air: [
      ['color', ['color']],
      ['font', ['bold', 'underline', 'clear']],
      ['para', ['ul', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture']]
    ],
    fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],
    placeholder: 'write here...',
    callbacks: {


      onImageUpload: function (files) {
        for (var i = files.length - 1; i >= 0; i--) {
          var $this = $(this);
          sendSummerFile(files[i], function (url) {
            $this.summernote("insertImage", url);
          });
        }
      }

    }


  });

  function sendSummerFile(file) {
    var data = new FormData();
    data.append("file", file);
    var url = baseurl + '/summer_editor_upload';
    $.ajax({
      data: data,
      type: "POST",
      url: url,
      cache: false,
      contentType: false,
      processData: false,
      success: function (url) {
        $("#wysiwyg").summernote("insertImage", url);
      }
    });
  }
});







