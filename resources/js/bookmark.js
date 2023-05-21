// ブックマーク情報をAjax POSTでQuizControllerへ送信

$(function() {
    $('.btn_bookmark').on('click', function() {

        // クイズのid
        var quiz_id = $(this).parents('[id *= "quiz_"]').attr('id').substr(5);

        // url
        var url = 'quiz/bookmark/' + quiz_id;

        // Ajax
        $.ajax({
            async: true,
            url: url,
            method: 'POST',
            dataType: 'json',
            data : {
                quiz_id: quiz_id,
            },
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            }).done(function(json){

                // ブックマークボタンを置換
                $('#quiz_' + json.quiz_id).find('.bookmark-state').html('<div class="badge badge-primary text-yellow-400"><i class="fa-solid fa-star"></i></div>');

            }).fail(function(json){

                alert('このクイズをブックマークできませんでした');

        });
    });
});