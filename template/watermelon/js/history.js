var timeout=30;var jNum=8;function AddHistory(){var Str,ShowStr,iArr,TemStr,sArr,jArr;Str=getCookie("history");if(Str==null){Str='';}
if(typeof(play_vid)!="undefined"){if(playtit==''){playtit="继续播放";}
TemStr=play_vid+'$'+infotit+'$'+playtit+'$'+infourl+'$'+window.location.href+'$$';if(Str!=""||Str!="History="){iArr=Str.replace("History=","").split("$$");var n=0
for(var i=0;i<iArr.length-1;i++){if(play_vid-iArr[i].split("$")[0]!=0&&n<jNum-1){TemStr+=iArr[i]+'$$';n++;}}}
TemStr="History="+TemStr
setCookie("history",TemStr,timeout);}}
function WriteHistory(){ShowStr=getCookie("history");if(ShowStr=="History="||ShowStr==null){ShowStr='<li class="kong">没有观看历史</li>';}else{sArr=ShowStr.split("$$");ShowStr='';var curl=window.location.href.split('/')[4];var tg='target="_blank"';if(!isNaN(curl))tg='target="_self"';for(var i=0;i<sArr.length-1;i++){jArr=sArr[i].split("$");jArr1=sArr[i].split("$");if(jArr[1].length>13){jArr1[1]=jArr1[1].substring(0,10)+".."}
if(jArr[2].length>8){jArr1[2]=jArr1[2].substring(0,8)+".."}
ShowStr+='<li><p><a class="del" href="javascript:void(0);" onclick="DelHistory('+i+'); return false;" target="_self" title="删除">\u5220\u9664</a><a href="'+jArr[3]+'" class="name" title="'+jArr[1]+'" target="_blank">'+jArr1[1]+'</a><a href="'+jArr[4]+'" class="his_part" title="继续播放" '+tg+'>['+jArr1[2]+']</a></p></li>';}}
document.getElementById("history").innerHTML=ShowStr;}
function DelHistory(i){var Str,iArr,TemStr,sArr,jArr,ShowStr;TemStr='';Str=getCookie("history");if(Str!=null){if(i==-1){if(confirm("确定清空吗？")){document.getElementById("history").innerHTML='<li class="kong">没有观看历史</li>';setCookie("history","History=");}}else{iArr=Str.replace("History=","").split("$$");for(var j=0;j<iArr.length-1;j++){if(j!=i){TemStr+=iArr[j]+'$$';}}
ShowStr='';sArr=TemStr.split("$$");for(var h=0;h<sArr.length-1;h++){jArr=sArr[h].split("$");jArr1=sArr[h].split("$");if(jArr[1].length>13){jArr1[1]=jArr1[1].substring(0,10)+".."}
if(jArr[2].length>8){jArr1[2]=jArr1[2].substring(0,8)+".."}
ShowStr+='<li><p><a class="del" href="javascript:void(0);" onclick="DelHistory('+h+'); return false;" target="_self" title="删除">\u5220\u9664</a><a href="'+jArr[3]+'" class="name" title="'+jArr[1]+'" target="_blank">'+jArr1[1]+'</a><a href="'+jArr[4]+'" class="his_part" title="继续播放" target="_blank">['+jArr1[2]+']</a></p></li>';}
document.getElementById("history").innerHTML=ShowStr;TemStr="History="+TemStr;setCookie("history",TemStr,timeout);}}}
function add_zero(temp){if(temp<10){return "0"+temp;}else{return temp;}}
function showTop()
{document.getElementById("Tab_top_0").className="history";document.getElementById("List_top_0").style.display="";}
function hideTop()
{var CurTabObj=document.getElementById("Tab_top_0");var CurListObj=document.getElementById("List_top_0");CurTabObj.className="history";CurListObj.style.display="none";}
function switchTab(identify,index,count,cnon,cnout){try{for(i=1;i<count+1;i++){var CurTabObj=document.getElementById("Tab_"+identify+"_"+i);var CurListObj=document.getElementById("List_"+identify+"_"+i);if(i!=index){CurTabObj.className=cnout;CurListObj.style.display="none";}}
document.getElementById("Tab_"+identify+"_"+index).className=cnon;document.getElementById("List_"+identify+"_"+index).style.display="block";jQuery("img").lazyload({container:jQuery("#List_"+identify+"_"+index)});}catch(ee){}}
function playlistTab(identify,index,count,cnon,cnout){try{for(i=1;i<count+1;i++){var CurTabObj=document.getElementById("Tab_"+identify+"_"+i);var CurListObj=document.getElementById("List_"+identify+"_"+i);var CurinfoObj=document.getElementById("info_"+identify+"_"+i);if(i==index){CurTabObj.className=cnon;CurListObj.style.display="block";CurinfoObj.style.display="block";}else{CurTabObj.className=cnout;CurListObj.style.display="none";CurinfoObj.style.display="none";}}}catch(ee){}}
function tab_show(a,b,c,d){x=a,max_i=b,tn=c,tc=d;for(var i=1;i<=max_i;i++){if(document.getElementById(tn+i))document.getElementById(tn+i).className=document.getElementById(tc+i).className="";}
document.getElementById(tn+x).className=document.getElementById(tc+x).className="on";}
function addFavorite(sURL,sTitle){try{window.external.addFavorite(sURL,sTitle);}
catch(e){try{window.sidebar.addPanel(sTitle,sURL,"");}
catch(e)
{alert("加入收藏失败，请使用Ctrl+D进行添加");}}}
function setHome(obj,vrl,url){try{obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);this.style.behavior='url(#default#homepage)';this.setHomePage(url);}
catch(e){if(window.netscape){try{netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");}
catch(e){alert("此操作被浏览器拒绝！请手动设置");}
var prefs=Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);prefs.setCharPref('browser.startup.homepage',vrl);}}}
function dysearch11(){if($("searchword").value=='输入影片名称或演员名'||jQuery("#searchword").val()==""){$("dykw").disabled=='disabled';}else{$("dykw").disabled=='';}
return false;}
function dysearch(){if(jQuery("#searchword").val()=='输入影片名称或演员名'||jQuery("#searchword").val()==''||jQuery.trim(jQuery("#searchword").val())==''){jQuery("#searchword").val('');jQuery("#searchword").focus();return false;}}
function btsearch(){if(jQuery("#searchword1").val()=='输入影片名称或演员名'||jQuery("#searchword1").val()==''||jQuery.trim(jQuery("#searchword").val())==''){jQuery("#searchword1").val('');jQuery("#searchword1").focus();return false;}}
function DelayToSearch(){}
function getsearch(){if(jQuery.trim(jQuery("#searchword").val())){jQuery.getJSON('/json-'+encodeURIComponent(jQuery("#searchword").val()).replace(/%/g,'$')+".html",function(json){if(json.length==0){jQuery(".showresult").html("<em>\u6CA1\u6709\u627E\u5230\u4EFB\u4F55\u5F71\u7247\uFF0C\u8BF7\u5C1D\u8BD5\u4FEE\u6539\u5173\u952E\u8BCD</em>");}else{var tmpstr="";jQuery.each(json,function(i,obj){tmpstr+="<li><a target=\"_blank\" href=\""+obj.url+"\"><label>"+obj.tyname+"</label><p>"+obj.title.replace(jQuery("#searchword").val(),"<span>"+jQuery("#searchword").val()+"</span>")+"</p></a></li>";});jQuery(".showresult").html(tmpstr);}
jQuery(".showresult").slideDown();});}else{jQuery(".showresult").html("");jQuery(".showresult").slideUp();}}
function endfun(){jQuery("#searchword").focus(function(){if(jQuery(".showresult").html())jQuery(".showresult").slideDown();});jQuery("#searchword").blur(function(){jQuery(".showresult").delay(200).slideUp();});jQuery("#dykw").val(' ');}
function killErrors(){return true;}
window.onerror=killErrors;