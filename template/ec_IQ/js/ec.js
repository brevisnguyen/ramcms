if(location.hostname.match()){
    $(document).ready(function(){
        window.onscroll = function(){
            var Head = 70;
            var scrolltop = document.body.scrollTop || document.documentElement.scrollTop;
            var vodplay = $("#bofang_box").height();
            if(scrolltop > Head){$('.header').addClass('highlight');}else{$('.header').removeClass('highlight');}
            if(scrolltop > vodplay){$('#bofang_box').addClass('playbottom');}else{$('#bofang_box').removeClass('playbottom');}
            if(scrolltop > 470){$('#atrhor').addClass('atrhor');}else{$('#atrhor').removeClass('atrhor');}
            if(scrolltop > 1400){$('#atrlist').addClass('atrhor');}else{$('#atrlist').removeClass('atrhor');}
        };
        $(".eclazy").lazyload({effect: "fadeIn"});
        $(".lazy").lazyload({effect: "fadeIn"});
        //头部用户显示隐藏
        $('.login-after').hover(function() {
            $("#panel").show();
        }, function() {
            $("#panel").hide();
        });
        //二级导航头部用户显示隐藏
        $('#dhBtn').hover(function() {
            $(".ec-allnav").show();
        }, function() {
            $(".ec-allnav").hide();
        });
        //搜索切换
        $(".qh-navs-name").click(function(){
            $(".mac-navs-name").html($(this).html());
            $("#search").attr("action",$(this).attr("value"));
        });
        $('.mac-navs-name').click(function() {
            $('.qh-search').toggleClass("qh-icon");
            $(".qh-event").show();
        });
        $('.qh-event').click(function() {
            $(this).hide();
            $('.qh-search').toggleClass("qh-icon");
        });
        //tag列表
        $(".homepage_main_tabs_title").hover(function(){
            $('.homepage_channel_video_wrap').hide();
            $(this).children("div").show();
        });
        $(".nav-channel-box").mouseleave(function(){
            $(this).find('.homepage_channel_video_wrap').hide();
        });
        //主题切换
        $("#theme").click(function(){
            $("#themebox").show();
        });
        $("#themebox .pop_close").click(function(){
            $("#themebox").hide();
        });
        function changeColor(skinName){
            $("#"+skinName).addClass('selected').siblings().removeClass('selected');
            $("#cssfile").attr('href','/template/ec_IQ/css/'+skinName+'.css');
            $.cookie('mySkin',skinName,{path:'/',expires:10});
        };
        var $a = $(".bglist div");
        $a.click(function(){
            var skinName= this.id;
            changeColor(skinName);
        })
        var cookieSkin = $.cookie('mySkin');
        if(cookieSkin){
            changeColor(cookieSkin);
        }
        //返回顶部
        var $body = $(document.body);
        $(window).scroll(function () {
            var scrollHeight = $(document).height();
            var scrollTop = $(window).scrollTop();
            var $footerHeight = $('.page-footer').outerHeight(true);
            var $windowHeight = $(window).innerHeight();
            scrollTop > 50 ? $("#scrollUp").fadeIn(200).css("display","block") : $("#scrollUp").fadeOut(200);
        });
        $('#scrollUp').click(function (e) {
            e.preventDefault();
            $('html,body').animate({ scrollTop:0});
        });
        //点击展开
        $("#ecbto").click(function(){
            $(".intro-wrap").toggle();
            $("#ecbto span").toggleClass("icon-xiangxia2").toggleClass("icon-xiangshang2");
        });
        //点击显示
        $("#antic").click(function(){
            $("#ecdiv3").show();
        });
        $(".ecdiv4").click(function(){
            $("#ecdiv3").hide();
        });
        //播放页隐藏显示元素
        $(".play_share").hover(function(){
            $(this).children(".fn-panel").show();},function(){
            $(this).children(".fn-panel").hide();
        });
        //搜索下拉菜单
        $(".mac_wd").click(function(){
            $(".hot-search-list").slideDown()
        })
        $(".search-input").keydown(function(){
            $(".hot-search-list").slideUp()
        });
        $(".so-home").mouseleave(function(){
            $(".hot-search-list").slideUp()
        })
        //滑动模块
        var mySwiper = new Swiper('.swiper-container1',{
            paginationClickable: true,
            slidesPerView:'auto',
        });
        var mySwiper = new Swiper('.swiper-container2',{
            paginationClickable: true,
            slidesPerView:'auto',
        });
        //热播列表滑动
        $(".sum-li").hover(function(){
            $(this).addClass("rankblk").siblings().removeClass("rankblk");
        })
        //片源切换
        $("#tag a").click(
            function(){
                $(this).addClass("active").siblings().removeClass("active");
                index = $("#tag a").index(this);
                $("#tagContent #playsx").eq(index).fadeIn(800).siblings().hide();
                $("#tagContent #playsx").eq(index).addClass("daoxu").siblings().removeClass("daoxu");
            }
        );
        //倒叙切换
        $("#zxdaoxu").click(function() {
            var tb = $(".daoxu").find("li");
            var total = tb.length;
            for (var i = 0; i < total; i++)
            {
                for (var j = i; j < total ; j++)
                {
                    $(tb).eq(j).insertBefore($(tb).eq(i));
                    $(tb).eq(i).insertAfter($(tb).eq(j));
                }
            }
            return;
        });
        //详情
        $("#desc_txt").click(function(){
            $(".desc_txt").toggleClass("full_text");
            $(".desc_txt .fa").toggleClass("icon-xiangxia2");
            $(".desc_txt .fa").toggleClass("icon-xiangshang2");
        });
        //复制网址
        $('.fn-share-code-btn').click(function(){
            var e=document.getElementById("videoURL");
            e.select();
            document.execCommand("Copy");
            MAC.Pop.Msg(100,20,'复制成功~快去分享给小伙伴们吧',1000);
        });
        //解析线路
        var urllin = $("#jxline").html();
        if(urllin != null){
            var urldata = urllin.split(",");
            for(var i=0;i<urldata.length;i++){
                $("#ec-xlqh").append('<button type="button" value="' + urldata[i] + '">线路' + (i+1) + '</button>');
            };
        };
        var jxurllin = $("#jxurllin").html();
        if(jxurllin != null){
            var urldata = jxurllin.split(",");
            for(var i=0;i<urldata.length;i++){
                $("#jk").append('<option value="' + urldata [i] + '" selected="">' + (i+1) + '号解析</option>');
            };
        };
        $('#ssdi').click(function(){
            var jxapi = $('#jk').val();
            var jxurl = $('#url').val();
            var official = jxurl.search(/iqiyi.com|v.qq.com|youku.com|mgtv.com|pptv.com|fun.tv|le.com|bilibili.com|miguvideo.com|sohu.com|1905.com/gi);
            if(official == -1){
                MAC.Pop.Msg(100,20,'请检查地址是否正确',1000);
            }else{
                $('#palybox').attr("src",jxapi+jxurl);
            };
        });
        $("#ec-xlqh button").click(function(){
            var urlstr = $("#bfurl").attr("href");
            var jxurl = $(this).val();
            var fullurl = jxurl+urlstr;
            var jburl = $("#playleft iframe").attr("src");
            var official = jburl.search(/iqiyi.com|v.qq.com|youku.com|mgtv.com|pptv.com|fun.tv|le.com|bilibili.com|miguvideo.com|sohu.com|1905.com/gi);
            if(official == -1){
                MAC.Pop.Msg(100,20,'云播资源无需切换',1000);
            }else{
                $(this).addClass("ok").siblings().removeClass("ok");
                $("#playleft iframe").attr("src",fullurl);
                MAC.Pop.Msg(100,20,'线路切换成功',1000);
            };
        });
        //滚动公告
        $('.swap').html($('.news_li').html());
        x = $('.news_li');
        y = $('.swap');
        h = $('.news_li li').length * 20;
        var hh = $('.news_li li').length;
        if (hh > 1)
            b();
        b();
        function b() {
            t = parseInt(x.css('top'));
            y.css('top', '20px');
            x.animate({
                top: t - 20 + 'px'
            }, 'slow');
            if (Math.abs(t) == h - 20) {
                y.animate({
                    top: '0px'
                }, 'slow');
                z = x;
                x = y;
                y = z;
            }
            setTimeout(b, 3000);
        };
    });
    //首页列表多页切换
    var car = {};
    function inprev(data){
        if(car[data] == 1){$('.'+[data]+'prevf').addClass("disable");};
        if(car[data] >= 1){
            var dangqan = '#' + data + (car[data]+1);
            var shangye = '#' + data + car[data];
            $(dangqan).hide();
            $(shangye).show();
            $('.'+[data]+'nextf').removeClass("disable");
            car[data]--;
        };
    };
    function innext(data){
        if(car[data] == null){car[data] = 0};
        if(car[data] == 1){$('.'+[data]+'nextf').addClass("disable");};
        if(car[data] <= 1){
            car[data]++;
            var shangye = '#' + data + car[data];
            var xiaya = '#' + data + (car[data] +1);
            var lazy = xiaya + ' .eclazy';
            $(shangye).hide();
            $(xiaya).show();
            $(lazy).lazyload({effect: "show"});
            $('.'+[data]+'prevf').removeClass("disable");
        };
    };
}
console.log('玖卿资源');