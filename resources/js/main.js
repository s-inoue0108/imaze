// フェードイン
$(function() {
    $(window).on('load', function() { 
        $('.wrapper, .footer').animate({ opacity: 1 }, { duration: 500, easing: 'swing'});
        $('.quiz-modal').removeClass('opacity-0');
    });
});

// フェードイン/アウト
$(function() {
    var n = $('.deadline-notice').length / 2;
    var current = 0;
    var next = 1;

    setInterval(function() {
        for (let i = 0; i < n; i++) {
            $('.deadline-notice').eq(current + 2*i).delay(200).fadeIn(1000);
            $('.deadline-notice').eq(next + 2*i).fadeOut(1000);
        }
        if (current == 0 && next == 1) {
            current = 1;
            next = 0;
        }else{
            current = 0;
            next = 1;
        }
    }, 4000);
});

// gpt-load
$(function() {
    $('.gpt-btn').on('click', function() {
        $('.gpt-load').fadeIn();
        $('.gpt-spinner').addClass('spin');
    });
});

// トップへ戻るボタン
$(function() {
    var topBtn = $('.top-btn');    
    topBtn.hide();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            //ボタンの表示方法
            topBtn.fadeIn(300);
        } else {
            //ボタンの非表示方法
            topBtn.fadeOut(300);
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,  html').animate({
        scrollTop: 0
        },   500);
        return false;
    });
});

// input icon, input imageが空ならボタンを押せないようにする
$(function() {
    $('input[name="icon"], input[name="image"]').on('change', function(e) {
        var num_file = e.target.files.length;

        if (num_file == 0) {
            $('#btn_upload').prop("disabled", true);
        }else{
            $('#btn_upload').prop("disabled", false);
        }
    });
});

// アップロードできるファイルの拡張子を制限
$(function() {
    $('input[name="icon"], input[name="image"]').on('change', function(e) {
        var num_file = e.target.files.length;
        var uploadedFile = e.target.files[0];

        const approvalFileType = ["png", "jpg", "jpeg", "PNG", "JPG"];

        if (num_file != 0) {
            let fileType = uploadedFile.type.split("/")[1];

            if (!approvalFileType.includes(fileType)) {
                alert('PNGまたはJPEGファイルを選択してください');
                $(this).val("");
                $('#btn_upload').prop("disabled", true);
            }else{
                // 投稿フォームの画像プレビュー
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        }else{
            // 投稿フォームの画像プレビュー削除
            $("#preview").attr('src', '/storage/logo/iMAZE-logo.png');
        }
        
     });
});