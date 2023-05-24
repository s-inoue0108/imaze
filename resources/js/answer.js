// 答えをAjax POSTでQuizControllerへ送信

$(function() {
    $('.btn_solution').on('click', function() {

        // クイズのid
        var quiz_id = $(this).parents('[id *= "quiz_"]').attr('id').substr(5);

        // 解答
        var solution = $(this).parents('[id *= "quiz_"]').find('input[name="solution"]').val();

        // 解答が空でなければAjax POST
        if (solution != '') {
            
            // url
            var url = 'quiz/answer/' + quiz_id;

            // inputを空に
            $(this).parents('[id *= "quiz_"]').find('input[name="solution"]').val('');
    
            $.ajax({
                async: true,
                url: url,
                method: 'POST',
                dataType: 'json',
                data : {
                    quiz_id: quiz_id,
                    solution: solution,
                },
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                }).done(function(json){

                    $(function() {

                        if (json.message === '不正解') {

                            // アラートを表示
                            $('.answer-alert').children('div').eq(0).css('z-index', 30);
                            $('.answer-alert').children('div').eq(0).animate({ opacity: 1 }, { duration: 300, easing: 'swing'});

                            $('.alert-close').on('click', function() {
                                $('.answer-alert').children('div').eq(0).css({'opacity':'0', 'z-index':'-1'});
                            });

                            setTimeout(function() {
                                $('.answer-alert').children('div').eq(0).css({'opacity':'0', 'z-index':'-1'});
                            }, 5000);

                        }else if (json.message === '正解！') {

                            // アラートを表示
                            $('.answer-alert').children('div').eq(1).css('z-index', 30);
                            $('.answer-alert').children('div').eq(1).animate({ opacity: 1 }, { duration: 300, easing: 'swing'});

                            $('.alert-close').on('click', function() {
                                $('.answer-alert').children('div').eq(1).css({'opacity':'0', 'z-index':'-2'});
                            });

                            setTimeout(function() {
                                $('.answer-alert').children('div').eq(1).css({'opacity':'0', 'z-index':'-2'});
                            }, 5000);

                            // 正解済みバッジと解説を表示
                            $('#quiz_' + json.quiz_id).find('.status-badge').html('<div class="badge badge-secondary lg:badge-lg check">正答済み</div>');
                            $('#quiz_' + json.quiz_id).find('.answer-section').html('<div class="flex justify-center items-center px-8"><label for="quiz-modal-' + quiz_id + '" class="btn btn-primary w-full max-w-xs">解説を見る</label></div>');

                        }else if (json.message === 'あなたが最初の正解者です！') {

                            $('.answer-alert').children('div').eq(2).css('z-index', 30);
                            $('.answer-alert').children('div').eq(2).animate({ opacity: 1 }, { duration: 300, easing: 'swing'});

                            $('.alert-close').on('click', function() {
                                $('.answer-alert').children('div').eq(2).css({'opacity':'0', 'z-index':'-3'});
                            });

                            setTimeout(function() {
                                $('.answer-alert').children('div').eq(2).css({'opacity':'0', 'z-index':'-3'});
                            }, 5000);

                             // 正解済みバッジと解説を表示
                             $('#quiz_' + json.quiz_id).find('.status-badge').html('<div class="badge badge-secondary lg:badge-lg check">正答済み</div>');
                             $('#quiz_' + json.quiz_id).find('.answer-section').html('<div class="flex justify-center items-center px-8"><label for="quiz-modal-' + quiz_id + '" class="btn btn-primary w-full max-w-xs">解説を見る</label></div>');

                        }else if (json.message === 'このクイズへの解答は締め切られています') {

                            // アラートを表示
                            $('.answer-alert').children('div').eq(3).css('z-index', 30);
                            $('.answer-alert').children('div').eq(3).animate({ opacity: 1 }, { duration: 300, easing: 'swing'});

                            $('.alert-close').on('click', function() {
                                $('.answer-alert').children('div').eq(3).css({'opacity':'0', 'z-index':'-4'});
                            });

                            setTimeout(function() {
                                $('.answer-alert').children('div').eq(3).css({'opacity':'0', 'z-index':'-4'});
                            }, 5000);
                        }
                    });
    
        　　    }).fail(function(json){
    
                    alert('解答に失敗しました');
    
            });
        }
    });
});

