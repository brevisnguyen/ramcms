

var action = getarg(document.location.href);
if(action=='')
{
	action='wlcome';
}
ShowAction(action);

$('#navbar a').click(function() {
	var actiontemp = $(this).attr('href');
	if(actiontemp!=null)
	{
		action=actiontemp;
		$(action).hide();
		$(action).show();
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
	$('#navbar a').each(function() {
		var actiontemp = $(this).attr('href');
		if (actiontemp == '#' + id || actiontemp == id) {
			$(this).parent().addClass("active");
		} else {
			$(this).parent().removeClass("active");
			$(actiontemp).hide();
		}
	});
}