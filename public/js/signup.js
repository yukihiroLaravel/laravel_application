$(function () {
    $(document).on("change", 'input[name="icon"]', function () {
        let elem = this; //操作された要素を取得
        $(".preview-icon").removeClass("active");
        if (elem.files.length == 0) {
            $("#preview-default_icon").addClass("active");
        } else {
            let fileReader = new FileReader(); //ファイルを読み取るオブジェクトを生成
            fileReader.readAsDataURL(elem.files[0]); //ファイルを読み取る
            fileReader.onload = function () {
                //ファイル読み取りが完了したら
                if (fileReader.result) {
                    let imgSrc = fileReader.result; //src要素を生成
                    $("#preview-new_icon").attr("src", imgSrc); //画像をプレビュー
                    $("#preview-new_icon").addClass("active");
                }
            };
        }
    });

    $("#reset-icon").click(function () {
        document.getElementById("user_icon").value = "";

        $(".preview-icon").removeClass("active");
        $("#preview-default_icon").addClass("active");
    });
});
