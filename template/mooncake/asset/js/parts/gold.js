var hadpingfen = 0;

function stars(r) {
    var curstars = parseInt(r.data.score / 2);
    $("#pa").html(r['data'].vod_gold_5 + "人");
    $("#pb").html(r['data'].vod_gold_4 + "人");
    $("#pc").html(r['data'].vod_gold_3 + "人");
    $("#pd").html(r['data'].vod_gold_2 + "人");
    $("#pe").html(r['data'].vod_gold_1 + "人");
    //$("#commnum").html(r['curpingfen'].num);
    var totalnum = parseInt(r['data'].vod_gold_1) + parseInt(r['data'].vod_gold_2) + parseInt(r['data'].vod_gold_3) + parseInt(r['data'].vod_gold_4) + parseInt(r['data'].vod_gold_5);

    if (totalnum > 0) {
        $("#pam").css("width", ((parseInt(r['data'].vod_gold_5) / totalnum) * 100) + "%");
        $("#pbm").css("width", ((parseInt(r['data'].vod_gold_4) / totalnum) * 100) + "%");
        $("#pcm").css("width", ((parseInt(r['data'].vod_gold_3) / totalnum) * 100) + "%");
        $("#pdm").css("width", ((parseInt(r['data'].vod_gold_2) / totalnum) * 100) + "%");
        $("#pem").css("width", ((parseInt(r['data'].vod_gold_1) / totalnum) * 100) + "%")
    };
    if (r['hadpingfen'] != undefined && r['hadpingfen'] != null) {
        hadpingfen = 1
    };
    var PFbai = r.data.score * 10;
    if (PFbai > 0) {
        $("#rating-main").show();
        $("#rating-kong").hide();
        //$("#fenshu").css('width', parseInt(PFbai) + "%");
        //$("#total").css('width', parseInt(PFbai) + "%");
        $("#fenshu").animate({
            'width': parseInt(PFbai) + "%"
        });
        $("#total").animate({
            'width': parseInt(PFbai) + "%"
        });
        $("#pingfen").html(r.data.score);
        $("#pingfen2").html(r.data.score)
    } else {
        $("#rating-main").hide();
        $("#rating-kong").show();
        $(".loading").addClass('nopingfen').html('Chưa có đánh giá nào, hãy là người đầu tiên.');
    };



    //$("#golder").html(r['curpingfen'].golder);
    console.log(curstars);
    if (curstars > 0) {
        var curnum = curstars - 1;
        $("ul.rating li:lt(" + curnum + ")").addClass("current");
        $("ul.rating li:eq(" + curnum + ")").addClass("current");
        $("ul.rating li:gt(" + curnum + ")").removeClass("current");
        var arr = new Array('Dở', 'Xem được', 'Bình thường', 'Hay', 'Rất hay');
        $("#ratewords").html(arr[curnum])
    }
};

function gold_init() {

    $("ul.rating li").each(function (i) {
        var $title = $(this).attr("title");
        var $lis = $("ul.rating li");
        var num = $(this).index();
        var n = num + 1;
        $(this).click(function () {
            if (hadpingfen > 0) {
                $.showfloatdiv({
                    txt: 'Bạn đã đánh giá rồi.'
                });
                $.hidediv({});
            } else {
                $.showfloatdiv({
                    txt: 'Đang xử lý...',
                    cssname: 'loading'
                });
                $lis.removeClass("active");
                $("ul.rating li:lt(" + n + ")").addClass("active");
                $("#ratewords").html($title);
                $.getJSON(maccms.path + '/index.php/ajax/score?mid=' + $('#rating').attr('data-mid') + '&id=' + $('#rating').attr('data-id') + '&score=' + ($(this).attr('val') * 2), function (r) {
                    if (parseInt(r.code) == 1) {
                        stars(r);
                        $.showfloatdiv({
                            txt: r.msg
                        });
                        $.hidediv({});
                        hadpingfen = 1;
                    } else {
                        hadpingfen = 1;
                        $.showfloatdiv({
                            txt: r.msg
                        });
                        $.hidediv({});
                    }
                });
            }
        }).hover(function () {
            this.myTitle = this.title;
            this.title = "";
            $(this).nextAll().removeClass("active");
            $(this).prevAll().addClass("active");
            $(this).addClass("active");
            $("#ratewords").html($title);
        }, function () {
            this.title = this.myTitle;
            $("ul.rating li:lt(" + n + ")").removeClass("hover");
        });
    });
    $(".rating-panle").hover(function () {
        $(this).find(".rating-show").show();
    }, function () {
        $(this).find(".rating-show").hide();
    });
}
gold_init();