jQuery(function($){
    $("#newQuestionTxt").summernote({
        lang:"ru-RU",
        height:$(window).height()*0.3,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
          ],
          fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto', 'Jura'],
          fontNamesIgnoreCheck: ['Jura'],
          callbacks: {
            onInit: function() {
                $('.note-editable').css('text-align', 'justify');
            }
        }
    });
    $("#content").summernote();
    $('#newQuestionTxt').summernote('fontName', 'Jura');
    $('.dropdown-toggle').dropdown();
});
