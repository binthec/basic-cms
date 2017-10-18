$(function () {
    //フラッシュメッセージを一定時間表示後にフェイドアウトして消す
    $(".flash-msg").fadeIn("slow", function () {
        $(this).delay(1200).fadeOut("slow");
    });
    //せっかちな人用に、フェイドアウト前でも、要素かbodyをクリックすればフラッシュメッセージが消える
    $(".flash-msg, body").on("click", function () {
        $(".flash-msg").hide();
    });
});
