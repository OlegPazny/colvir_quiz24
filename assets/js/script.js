jQuery(function($){
    $("#newQuestionTxt").summernote({
        lang:"ru-RU",
        height:$(window).height()*0.3,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
          ],
    });
    $("#content").summernote();
    $('.dropdown-toggle').dropdown();
});
