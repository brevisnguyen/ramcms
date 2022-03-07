'use strict';
var _layui, _typeof = 'function' == typeof Symbol && 'symbol' == typeof Symbol.iterator ?
function(o) {
	return typeof o
}: function(o) {
	return o && 'function' == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? 'symbol': typeof o
};
function _defineProperty(o, w, e) {
	return w in o ? Object.defineProperty(o, w, {
		value: e,
		enumerable: !0,
		configurable: !0,
		writable: !0
	}) : o[w] = e,
	o
};

layui['config']((_layui = {},
_defineProperty(_layui, 'version', magic['ver']), _defineProperty(_layui, 'base', magic['cdn'] + ('asset/js/')), _layui))['extend'](_defineProperty({},
'common', '{/}' + (1 == magic['comm'] ? magic['tpl'] : magic['cdn']) + ('/asset/js/common')))['use'](['jquery', 'common'],
function() {
	var _ref, _ref2, _ref3, _x44d, 
	_0x44d768 = (_x44d = {},
	_defineProperty(_x44d, 'global', (_ref = {},
	_defineProperty(_ref, 'sorted',
	function() {
		_0x44d768['navbar']['init'](),
		layui['common']['picing']['init']('.mo-situ-lazy'),
		_0x44d768['global']['player']('.mo-play-load'),
		layui['common']['global']['init'](),
		layui['common']['global']['trident']() || (console['log']('%c%c主题名称%c魔加模板修复版(苹果CMSv10版)', 'line-height:28px', 'padding:4px;background:#222;color:#fff;font-size:16px;margin-right:15px', 'color:#3fa9f5;font-size:16px;line-height:28px'), console['log']('%c%c主题官网%chttp://ain19.com', 'line-height:28px', 'padding:4px;background:#222;color:#fff;font-size:16px;margin-right:15px', 'color:#ff9900;font-size:16px;line-height:28px')),
		_typeof(_0x44d768['moload']['judges']) !== 'function' || -2 == _0x44d768['moload']['judges']['toString']()['indexOf']('location') ? location['reload']() : (_typeof(_0x44d768['moload']['mojia']) !== 'function' || 10 > _0x44d768['moload']['mojia']['toString']()['match'](/\(\)/g)['length']) && _0x44d768['moload']['judges']()
	}), _defineProperty(_ref, 'change', 'a5e68d6cf32ada0751c821f1feb31ae8'), _defineProperty(_ref, 'player',
	function(o) {
		if (_typeof(_0x44d768['moload']['judges']) !== 'function' || -2 == _0x44d768['moload']['judges']['toString']()['indexOf']('location') ? location['reload']() : (_typeof(_0x44d768['moload']['mojia']) !== 'function' || 10 > _0x44d768['moload']['mojia']['toString']()['match'](/\(\)/g)['length']) && _0x44d768['moload']['judges'](), !layui['jquery']('.mo-java-play')['length']) return ! 1;
		document['getElementById']('mo-play-iframe');
		if (1 == layui['jquery'](o)['attr']('data-copy')) layui['jquery']('.mo-play-copyer')['show']()['css']('z-index', '99');
		else if (1 == layui['jquery'](o)['attr']('data-group')) {
			var c = document['getElementById']('mo-play-iframe');
			c['src'] = layui['jquery'](o)['attr']('data-link'),
			c['onload'] = function() {
				layui['jquery']('.mo-play-advert')['show'](),
				layui['jquery']('.mo-play-iframe')['show']()['css']('z-index', '99'),
				layui['common']['player']['time'](o, c, layui['jquery'](o)['attr']('data-time'))
			}
		} else 1 == layui['jquery']('.mo-chat-info')['attr']('data-chat') ? (layui['jquery']('.mo-play-wechat')['show']()['css']('z-index', '99'), layui['common']['cookie']['get']('mo_wechat') && (layui['jquery']('.mo-play-wechat')['hide'](), layui['common']['player']['judge'](o))) : layui['common']['player']['judge'](o)
	}), _ref)), _defineProperty(_x44d, 'moload', (_ref2 = {},
	_defineProperty(_ref2, 'mojia',
	function() {
		_0x44d768['moload']['obtain']();
		var j = layui['jquery']('.mo-java-mojia'),
		Y = Date['parse'](new Date) / 1e3;
		j['attr']('data-aid') ? 32 != j['attr']('data-aid')['length'] || _0x44d768['moload']['timeer'](j['attr']('data-aid')) ? _0x44d768['moload']['judges']() : (300 > Y - j['attr']('data-time') || 86400 < Y - j['attr']('data-time')) && layui['jquery']['post'](magic['tpl'] + ('asset/exc/create.php?id=url'), 'addr=' + Y,
		function(c) {
			j['attr']('data-aid') != c['msg'] || layui['jquery']('.mo-navs-submit')['attr']('data-file') != _0x44d768['global']['change'] ? _0x44d768['moload']['judges']() : layui['jquery']['post'](magic['tpl'] + ('asset/exc/create.php?id=url'), 'key=' + encodeURIComponent(_0x44d768['moload']['keystr']()),
			function(G) {
				G['Status'] === void 0 ? G['length'] && j['attr']('data-aid') == G[0]['txt'] && G[0]['txt'] == G[0]['entries'][0] && G[0]['entries'][0] == layui['jquery']('.mo-navs-name')['attr']('data-name') ? layui['jquery']['post'](magic['tpl'] + ('asset/exc/create.php?id=url'), 'time=' + Y) : _0x44d768['moload']['judges']() : G['Answer'] ? j['attr']('data-aid') == G['Answer'][0]['data']['replace'](/\"/g, '') && layui['jquery']('.mo-navs-name')['attr']('data-name') == G['Answer'][0]['data']['replace'](/\"/g, '') ? layui['jquery']['post'](magic['tpl'] + ('asset/exc/create.php?id=url'), 'time=' + Y) : _0x44d768['moload']['judges']() : _0x44d768['moload']['judges']()
			})['error'](function() {
				location['reload']()
			},
			'json')
		})['error'](function() {
			location['reload']()
		},
		'json') : _0x44d768['moload']['judges'](),
		_0x44d768['global']['sorted']()
	}), _defineProperty(_ref2, 'obtain',
	function() {
		layui['common']['global']['submit']('.mo-keys-btns', '.mo-keys-info'),
		layui['jquery']('.mo-keys-btns')['click'](function() {
			return (layui['jquery']('.mo-keys-tips')['text']('请稍等...'), 32 != layui['jquery']('.mo-keys-text')['val']()['length']) ? (layui['jquery']('.mo-keys-tips')['text']('请输入正确的KEY'), !1) : layui['jquery']('.mo-keys-agree')['hasClass']('mo-icon-weixuanzhong') ? (layui['jquery']('.mo-keys-tips')['text']('请勾选用户许可协议'), !1) : layui['jquery']('.mo-navs-submit')['attr']('data-file') == _0x44d768['global']['change'] ? _0x44d768['moload']['timeer'](layui['jquery']('.mo-keys-text')['val']()) ? (layui['jquery']('.mo-keys-tips')['text']('KEY已过期'), !1) : void layui['jquery']['post'](magic['tpl'] + ('asset/exc/create.php?id=url'), 'key=' + encodeURIComponent(_0x44d768['moload']['keystr']()),
			function(x) {
				var ro = void 0 === x['Answer'] ? x['length'] ? x[0]['entries'][0] : '0' : x['Answer'][0]['data']['replace'](/\"/g, ''),
				mo = void 0 === x['Status'] ? x['length'] ? x[0]['host'] : '0' : x['Question'][0]['name'];
				return - 1 == mo['indexOf']('233343.xyz') ? (layui['jquery']('.mo-keys-tips')['text']('验证服务器与主题服务器不符'), !1) : layui['jquery']('.mo-keys-text')['val']() != ro || layui['jquery']('.mo-navs-name')['attr']('data-name') != ro ? (layui['jquery']('.mo-keys-tips')['text']('输入的KEY与服务器KEY不匹配'), !1) : void layui['jquery']['post'](magic['tpl'] + ('asset/exc/create.php?id=opt'), 'key=' + layui['jquery']('.mo-keys-text')['val']() + ('&tga=') + layui['common']['hexmd5']['init'](0, 8, layui['jquery']('.mo-navs-input')['attr']('data-soft') + ('.mojia.random.') + _0x44d768['moload']['domain'](location['host'])) + ('&url=') + location['host'],
				function(ao) {
					return layui['jquery']('.mo-keys-tips')['text'](ao['msg']),
					0 != ao['code'] && void(location['href'] = magic['path'])
				})['error'](function(ao) {
					layui['jquery']('.mo-keys-tips')['text']('授权失败：' + ao['status'] + ('，请联系QQ1570457334'))
				},
				'json')
			})['error'](function(x) {
				layui['jquery']('.mo-keys-tips')['text']('授权失败：' + x['status'] + ('，请联系QQ1570457334'))
			},
			'json') : (layui['jquery']('.mo-keys-tips')['text']('主题文件被修改过,请还原后再进行授权'), !1)
		})
	}), _defineProperty(_ref2, 'timeer',
	function(o) {
		return /^[0-9]+$/ ['test'](o['substring'](18, 32)) && (Date['parse'](new Date) / 1e3 - o['substring'](18, 28)) / 86400 > o['substring'](28, 32)
	}), _defineProperty(_ref2, 'judges',
	function() {
		var j = layui['jquery']('.mo-java-mojia'),
		Y = j['attr']('data-rid') == layui['common']['hexmd5']['init'](0, 8, layui['jquery']('.mo-navs-input')['attr']('data-soft') + ('.mojia.random.') + _0x44d768['moload']['domain'](j['attr']('data-mid'))) ? _0x44d768['moload']['domain'](j['attr']('data-mid')) : _0x44d768['moload']['domain'](location['host']);
		return 'https://cloudflare-dns.com/dns-query?ct=application/dns-json&name=' + Y + ('.233343.xyz&type=TXT')
	}), _defineProperty(_ref2, 'domain',
	function(o) {
		var Y = !0;
		if ( - 1 != o['indexOf'](':')) var c = o['indexOf'](':'),
		o = o['substring'](0, c);
		for (var t = o['split']('.'), k = t['length'], M = ['.com.cn', '.net.cn', '.org.cn', '.eu.org'], b = 0; b < M['length']; b++) - 1 != o['indexOf'](M[b]) && (Y = !1);
		if (Y == !0) var f = t[k - 2] + '.' + t[k - 1];
		else var f = t[k - 3] + '.' + t[k - 2] + '.' + t[k - 1];
		return f
	}), _ref2)), _defineProperty(_x44d, 'navbar', (_ref3 = {},
	_defineProperty(_ref3, 'init',
	function() {
		this['search']('.mo-navs-submit', '.mo-navs-input'),
		layui['jquery']('.mo-java-hunt')['text']() && this['record'](7, 'mo_record', layui['jquery']('.mo-java-hunt')['text'](), '', '', ''),
		15 == layui['jquery']('.mo-java-data')['attr']('data-aid') && this['record'](7, 'mo_history', layui['jquery']('.mo-java-play')['attr']('data-name'), layui['jquery']('.mo-java-play')['attr']('data-show'), '', layui['jquery']('.mo-java-play')['attr']('data-nums'))
	}), _defineProperty(_ref3, 'search',
	function(o, w) {
		_typeof(_0x44d768['moload']['judges']) !== 'function' || -1 == _0x44d768['moload']['judges']['toString']()['indexOf']('location') ? location['reload']() : (_typeof(_0x44d768['moload']['mojia']) !== 'function' || 10 > _0x44d768['moload']['mojia']['toString']()['match'](/\(\)/g)['length']) && _0x44d768['moload']['judges'](),
		layui['jquery'](document)['on']('click', o,
		function() {
			layui['jquery'](this)['prev']()['val']() && (location['href'] = _0x44d768['navbar']['jumper'](layui['jquery'](this)['prev']()['val']()['replace'](/</g, '')['replace'](/>/g, '')['trim']()))
		}),
		layui['jquery'](document)['on']('focus', w,
		function() {
			layui['common']['global']['edge'](),
			layui['common']['global']['submit'](o, w),
			layui['common']['navbar']['adding']('.mo-part-mask'),
			layui['common']['navbar']['baidu'](),
			layui['jquery']('.mo-java-ceal')['hide'](),
			layui['jquery']('.mo-pops-search')['show'](),
			layui['jquery'](w)['val'](layui['jquery'](w)['val']()),
			_0x44d768['navbar']['keyup'](w)
		})
	}), _defineProperty(_ref3, 'keyup',
	function(o) {
		1 == layui['jquery']('.mo-navs-search')['attr']('data-auto') && layui['jquery'](document)['on']('keyup', o,
		function(Y) {
			var V = window['event'] ? Y['keyCode'] : Y['which'],
			G = layui['jquery'](this)['val']()['trim']();
			G ? _0x44d768['navbar']['lister'](o, G, G, V, 0) : layui['jquery']('.mo-pops-keys')['hide']()['find']('.mo-pops-list')['addClass']('mo-pbxs-10px mo-pbmd-5px')['parent']()['next']()['show']()['children'](':first')['addClass']('mo-ptmd-5px')
		})
	}), _defineProperty(_ref3, 'jumper',
	function(o) {
		return layui['jquery']('.mo-navs-name')['attr']('data-href') + ('?wd=') + encodeURIComponent(layui['common']['global']['filter'](o))
	}), _defineProperty(_ref3, 'lister',
	function(o, w, e, n, O) {
		var M = layui['jquery']('.mo-navs-name')['attr']('data-type');
		layui['jquery']['post'](magic['path'] + ('index.php/ajax/suggest.html?limit=10&mid=') + M + ('&wd=') + encodeURIComponent(w),
		function(b) {
			if (1 != b['code']) return ! 1;
			var R = JSON['stringify'](b)['replace']('"list":{', '"list":[')['replace']('},"url"', '],"url"')['replace'](/"[0-9]":{/g, '{')['replace'](/topic_/g, '');
			if (b = 3 == M ? JSON['parse'](R) : b, 0 < b['list']['length']) {
				for (var E = '',
				B = 0; B < b['list']['length']; B++) E += '<li class="mo-pops-item mo-pops-sort mo-cols-rows"><a class="mo-pnxs-15px mo-lhxs-40px mo-wrap-arow" href="' + layui['jquery']('.mo-navs-name')['attr']('data-href') + ('?wd=') + b['list'][B]['name'] + ('"><span class="mo-pops-text mo-wrap-arow">') + b['list'][B]['name']['replace'](w, '<span class="mo-text-mojia">' + w + ('</span>')) + ('</span></a></li>');
				_0x44d768['navbar']['keying'](o, '.mo-pops-sort', 'mo-back-fixed', '.mo-pops-text', n, E)
			} else {
				if (1 == O) {
					var E = '<li class="mo-pops-item mo-cols-rows"><a class="mo-pnxs-15px mo-lhxs-40px mo-wrap-arow" href="' + _0x44d768['navbar']['jumper'](e) + ('"><span class="mo-pops-text mo-wrap-arow mo-cols-info mo-cols-xs9">') + e + ('</span><span class="mo-wrap-arow mo-coxs-right mo-cols-info mo-cols-xs3">查看更多</span></a></li>');
					return layui['jquery']('.mo-pops-keys')['show']()['find']('.mo-pops-list')['html'](E)['removeClass']('mo-pbxs-10px mo-pbmd-5px')['parent']()['next']()['show']()['children'](':first')['removeClass']('mo-ptmd-5px'),
					!1
				}
				layui['use']('pinyin',
				function() {
					_0x44d768['navbar']['lister'](o, layui['pinyin']['init'](w), w, n, O + 1)
				})
			}
		},
		'json')
	}), _defineProperty(_ref3, 'keying',
	function(o, w, e, n, O, i) {
		var b = layui['jquery']('.' + e)['prevAll']()['length'];
		40 == O ? layui['jquery'](w)['hasClass'](e) ? b == layui['jquery'](w)['length'] - 1 ? (layui['jquery'](o)['val'](layui['jquery'](w)['eq'](0)['find'](n)['text']()), layui['jquery'](w)['removeClass'](e)['eq'](0)['addClass'](e)) : (layui['jquery'](o)['val'](layui['jquery'](w)['eq'](b + 1)['find'](n)['text']()), layui['jquery'](w)['removeClass'](e)['eq'](b + 1)['addClass'](e)) : (layui['jquery'](o)['val'](layui['jquery'](w)['eq'](0)['find'](n)['text']()), layui['jquery'](w)['removeClass'](e)['eq'](0)['addClass'](e)) : 38 == O ? 0 == b ? (layui['jquery'](o)['val'](layui['jquery'](w)['eq'](layui['jquery'](w)['length'] - 1)['find'](n)['text']()), layui['jquery'](w)['removeClass'](e)['eq'](layui['jquery'](w)['length'] - 1)['addClass'](e)) : (layui['jquery'](o)['val'](layui['jquery'](w)['eq'](b - 1)['find'](n)['text']()), layui['jquery'](w)['removeClass'](e)['eq'](b - 1)['addClass'](e)) : layui['jquery']('.mo-pops-keys')['show']()['find']('.mo-pops-list')['html'](i)['addClass']('mo-pbxs-10px mo-pbmd-5px')['parent']()['next']()['hide']()
	}), _defineProperty(_ref3, 'record',
	function(_0x526340, _0x4d260b, _0x1038a7, _0xcbe987, _0x416c35, _0x26a9d1) {	
		if (_0x1038a7 == void 0) return ! 1;
		var _0x416c35 = location['href'],
		_0x27202d = layui['common']['cookie']['get'](_0x4d260b);
		if (_0x27202d != void 0) {
			for (var _0x1f1fe9 = eval(_0x27202d), _0x4839ff = '[{"name":"' + layui['common']['global']['filter'](_0x1038a7) + ('","show":"') + _0xcbe987 + ('","link":"') + _0x416c35 + ('","num":"') + _0x26a9d1 + ('"},'), _0x10900a = 0; _0x10900a < _0x1f1fe9['length'] && (_0x1f1fe9[_0x10900a]['name'] == _0x1038a7 ? ++_0x526340: _0x4839ff += '{"name":"' + _0x1f1fe9[_0x10900a]['name'] + ('","show":"') + _0x1f1fe9[_0x10900a]['show'] + ('","link":"') + _0x1f1fe9[_0x10900a]['link'] + ('","num":"') + _0x1f1fe9[_0x10900a]['num'] + ('"},'), !(_0x10900a > _0x526340)); _0x10900a++);
			var _0x4839ff = _0x4839ff['substring'](0, _0x4839ff['lastIndexOf'](','));
			_0x4839ff += ']'
		} else var _0x4839ff = '[{"name":"' + layui['common']['global']['filter'](_0x1038a7) + ('","show":"') + _0xcbe987 + ('","link":"') + _0x416c35 + ('","num":"') + _0x26a9d1 + ('"}]');
		layui['common']['cookie']['set'](_0x4d260b, _0x4839ff, 7)
	}), _ref3)), _x44d);
	_0x44d768['moload']['mojia']()
});