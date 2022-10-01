function setCookie(name, value, ihour) {
	var iH = ihour || 1;
	var exp = new Date;
	exp.setTime(exp.getTime() + iH * 60 * 60 * 1000);
	document.cookie = name + ("=" + escape(value) + ";expires=" + exp.toGMTString() + ";path=/;");
}

function getCookie(name) {
	var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	if (arr != null) {
		return unescape(arr[2]);
	}
	return null;
}

