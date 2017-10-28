$(function () {
    //フラッシュメッセージを一定時間表示後にフェイドアウトして消す
    $(".flash-msg").fadeIn("slow", function () {
        $(this).delay(1200).fadeOut("slow");
    });
    //せっかちな人用に、フェイドアウト前でも、要素かbodyをクリックすればフラッシュメッセージが消える
    $(".flash-msg, body").on("click", function () {
        $(".flash-msg").hide();
    });

    //データピッカー
    $('.use-calendar').datepicker({
        dateFormat: 'yy年mm月dd日',
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass   : 'iradio_flat-blue'
    })

});
