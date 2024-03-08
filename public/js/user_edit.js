$(function () {
    $(document).on("change", 'input[name="icon"]', function () {
        let elem = this; //操作された要素を取得
        if (elem.files.length == 0) {
            if (resetCount == 0) {
                $('input[value="current_icon"]').prop("checked", true).change();
            } else {
                $('input[value="default_icon"]').prop("checked", true).change();
            }
        } else {
            let fileReader = new FileReader(); //ファイルを読み取るオブジェクトを生成
            fileReader.readAsDataURL(elem.files[0]); //ファイルを読み取る
            fileReader.onload = function () {
                //ファイル読み取りが完了したら
                if (fileReader.result) {
                    let imgSrc = fileReader.result; //src要素を生成
                    $("#preview-new_icon").attr("src", imgSrc); //画像をプレビュー
                    $('input[value="new_icon"]').prop("checked", true).change();
                }
            };
        }
    });

    $("#reset-icon").click(function () {
        $('input[value="default_icon"]').prop("checked", true).change();
        resetCount++;
    });

    $(document).on("change", 'input[name="icon_status"]', function () {
        var radioVal = $('input[name="icon_status"]:checked').val();
        $(".preview-icon").removeClass("active");
        $("#preview-" + radioVal).addClass("active");
    });
});
