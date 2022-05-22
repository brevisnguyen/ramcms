var action = getarg(document.location.href);
if(action=='')
{
	action='wlcome';
}
ShowAction(action);

$('#lagnav a').click(function() {
	var actiontemp = $(this).attr('href');
	if(actiontemp!=null)
	{
		action=actiontemp;
		//$(action).hide();
		//$(action).show();
		ShowAction(action);
	}
});

function getarg(url) {
	arr = url.split("#");
	if (arr.length > 1) {
		return arr[1];
	}
	return '';
}

function ShowAction(id) {
	$('#lagnav a').each(function() {
		var actiontemp = $(this).attr('href');
		if (actiontemp == '#' + id || actiontemp == id) {
			$(this).parent().addClass("active");
			$(actiontemp).show();
		} else {
			$(this).parent().removeClass("active");
			$(actiontemp).hide();
		}
	});
}

$(function(){
	//在这里面输入任何合法的js语句
	var areainfo=['500px', '650px'];
	if(document.documentElement.clientWidth<1000)
	{
		areainfo=['360px', '450px'];
	}
	layer.open({
	  type: 1 //Page层类型
	  ,area: areainfo
	  ,title: '欢迎使用热热资源'
	  ,shade: 0.6 //遮罩透明度
	  ,anim: 1 //0-6的动画形式，-1不开启
	  ,content: '<div style="margin:1rem; "><h1 style="text-align:center">采集送福利全网最高</h1><p style="text-align:center"><b><font color="#FF0000" size="4">采集热热资源可免费赞助VPS服务器</font></b></p><strong style="margin-left:2rem">一、广告赞助奖励PS：广告赞助为月支付</strong><ol><li>达到3000IP赞助700元广告横幅一条    赠送现金100元</li><li>达到5000IP赞助1000元广告横幅一条   赠送现金200元</li><li>达到10000IP赞助2000元广告横幅一条  赠送现金500元</li><li>达到20000IP赞助2500元广告横幅一条  赠送现金800元</li></ol><strong style="margin-left:2rem">二、广告赞助要求</strong> <ol><li>全站采集热热资源（rerezy.com）不能有其他资源站任何资源；</li><li>流量取最近15天平均值达到赞助要求，已申请赞助日期计算7天后方可获得广告赞助；</li><li>广告赞助期间，如发现采集其他资源、长时间中断采集、虚假流量等情况，终止合作；</li><li>申请广告赞助站长需要提供后台流量统计查看代码（cnzz或百度统计），不提供不赞助；</li><li>当月获得广告赞助的站长下月视采集情况决定是否持续赞助；</li></ol><strong style="margin-left:2rem">三、站长推荐奖励</strong><ol><li>推荐30名站长采集本站资源，奖励1800元现金.</li><li>推荐20名赞助采集本站资源，奖励1100元现金.</li><li>推荐10名赞助采集本站资源，奖励 500 元现金.</li></ol> <strong style="margin-left:2rem">四、推荐奖励要求</strong><ol><li>所推荐的采集站长IP要达到3000以上</li><li>所推荐的站长需要提供网站域名和流量统计</li><li>被推荐的站长如果全站采集资源（rerezy.com）也可以享受广告赞助</li></ol><div style="color:red;font-size: 20px;text-align: center;">联系QQ：378833&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telegram：rerezy1</div><br><br></div>'
	});    
	if(document.documentElement.clientWidth>1000)
	{
		$(".layui-layer-content").css("overflow","hidden");
	}
  
});