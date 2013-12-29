<!--
/////////////////////////////////////////////////////////////////////////////
//  Caspio External Embed Javascript Version 1
//  (C) Copyright 2004 Caspio, Inc. All Rights Reserved.
//
//  Filename: $RCSfile: e1.js,v $
//  Update:   $Date: 2011/02/08 13:29:37 $
//  Version:  $Revision: 1.22 $
//  Contents: External Javascript file to reduce the download and to support
//            the new caspio URL to improve our ranking in search engines
//
/////////////////////////////////////////////////////////////////////////////
// Extra tests to ensure that only IE5.5+ (IE6) will do the undefined tests
//       IE4+                 IE5+                                                                      IE5.5+
if ((document.all) && (document.getElementById) && (document.body) && (document.body.style) && (document.body.style.filter)) {
if (v_winloc_host == undefined) var v_winloc_host = window.location.host;
if (v_winloc_pathname == undefined) var v_winloc_pathname = window.location.pathname;
if (v_winloc_search == undefined) var v_winloc_search = window.location.search;
} else { var v_winloc_host = window.location.host; var v_winloc_pathname = window.location.pathname; var v_winloc_search = window.location.search; }
// client branding variables (every new content and style must be added for IE (non-quoted) and for other browsers separately)
// the second variable is the style associated with it from brandingStyle array
if (brandingContent == undefined) {
    var brandingContent = [["", 0],
						   ["", 0]
						  ];
}
if (brandingStyle == undefined) {
	var brandingStyle = ["font-family: Arial,Verdana; padding: 10px 0px 5px; font-size: 10px;"];
}
if(arr == undefined) var arr = new Array();
function f_cbload(v_sK, v_sP) {
	// client branding calculating
	var branding = "&amp;cbb=914";
	var currentContent = "";
	var currentStyle = "";
	var appKey = v_sK;
	if(appKey.indexOf("&amp;")!=-1 || appKey.indexOf("&")!=-1){
		appKey = appKey.substring(0,appKey.indexOf("&"));
	}
	if(document.getElementById("cb"+appKey)){
			for(i=0;i<brandingContent.length;i++){
			
				//if((document.getElementById("cb"+appKey).style.cssText.toUpperCase().trim())==(brandingContent[i][1].toUpperCase().trim())) {
					if((document.getElementById("cb"+appKey).innerHTML.toUpperCase())==(brandingContent[i][0].toUpperCase())) {
						branding = "&amp;cbb=&#57;&#52;";
						currentContent = document.getElementById("cb"+appKey).innerHTML;
						//currentStyle = document.getElementById("cb"+appKey).style.cssText;
						currentStyle = brandingStyle[brandingContent[i][1]];
						//currentStyle = "font-family: Arial,Verdana; padding: 10px 0px 5px; font-size: 10px;";
						var d = document.getElementById("cb"+appKey);
						d.parentNode.removeChild(d);
						break;
					}
					//break;
				//}
			}
	}
	var tmp = [branding,currentContent,currentStyle,appKey];
	arr.push(tmp);
	v_path = v_winloc_pathname+v_winloc_search;
    document.write("\n<style type=\"text/css\">\n<!--\n #cxkg {visibility:hidden; font-size:6px; position:relative; }\n-->\n</style>\n");
    if ((v_path.toUpperCase().indexOf("DP.ASP?APPKEY=") != -1)||(v_path.toUpperCase().indexOf("DP.ASP?APPSESSION=") != -1))
    	document.write("<br/><strong>Error - Cannot display DataPage due to multiple embedded deployments.</strong></br>");
    else document.write("<scri"+"pt type=\"text/javascript\" src=\""+v_sP+"//b3.caspio.com/dp.asp?AppKey="+v_sK+"&amp;js=true"+branding+"&amp;pathname="+window.location.protocol+"//"+v_winloc_host+v_winloc_pathname+"&amp;"+v_winloc_search+"\"></scr"+"ipt>");
}
String.prototype.trim = function () {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
}
String.prototype.startsWith = function(str) {
    return (this.match("^"+str)==str);
}
// show client branding AFTER the form
if (!v_cbOldonload){
	var v_cbOldonload = window.onload;
	if(v_cbOldonload != undefined && (''+v_cbOldonload).startsWith('function myInitLoad')) {v_cbOldonload=null;}
}
window.onload=myInitLoad;
function myInitLoad() {
	var j=0;
	var cxkgs = document.getElementsByTagName("form");
	if (!arr) return;
	for(i=0;i<cxkgs.length;i++){
		if(cxkgs[i].getAttribute("id") == "caspioform"){
		    if(j >= arr.length) break;
			if(arr[j] && arr[j][0] && arr[j][0] == "&amp;cbb=&#57;&#52;"){
			    try {
			        if(cxkgs[i].elements && cxkgs[i].elements["AppKey"] && cxkgs[i].elements["AppKey"].value != arr[j][3]) continue;
			    }catch(v_e){}
			    
				var newDiv = document.createElement("div");
				newDiv.innerHTML = arr[j][1];
				newDiv.style.cssText = arr[j][2];
				var found = false;
				var tmp = cxkgs[i];
				var tmpParent = cxkgs[i].parentNode;
				do{
					var tmpChildNodes = tmpParent.childNodes;
					for(k=0;k<tmpChildNodes.length;k++){
						if(tmpChildNodes[k].attributes != null && tmpChildNodes[k].getAttribute("id") == "caspioform"){
							tmpChildNodes[k].parentNode.insertBefore(newDiv, tmp.nextSibling);
							found = true;
							break;
						}
					}
					if(found) break;
					tmp = tmpParent;
					tmpParent = tmpParent.parentNode;
				} while(tmpParent != document);
			}
			j=j+1;
		}
	}
	// if is dot net
	cxkgs = document.getElementsByTagName("div");
	for(i=0;i<cxkgs.length;i++){
		if(cxkgs[i].getAttribute("id") != null && cxkgs[i].getAttribute("id").startsWith("CaspioFormDiv_")) {
		    if(j >= arr.length) break;
			if(arr[j] && arr[j][0] && arr[j][0] == "&amp;cbb=&#57;&#52;"){
			    try {
			        var appkeyHiddens = cxkgs[i].getElementsByName("AppKey");
			        if(appkeyHiddens && appkeyHiddens[0] && appkeyHiddens[0].value != arr[j][3]) continue;
			    }catch(v_e){}
			    
				var newDiv = document.createElement("div");
				newDiv.innerHTML = arr[j][1];
				newDiv.style.cssText = arr[j][2];
				var found = false;
				var tmp = cxkgs[i];
				var tmpParent = cxkgs[i].parentNode;
				do{
					var tmpChildNodes = tmpParent.childNodes;
					for(k=0;k<tmpChildNodes.length;k++){
						if(tmpChildNodes[k].attributes != null){
							if(tmpChildNodes[k].getAttribute("id") != null){
								if(tmpChildNodes[k].getAttribute("id").startsWith("CaspioFormDiv_"+arr[j][3])){
									document.getElementById("CaspioFormDiv_"+arr[j][3]).appendChild(newDiv);
									found = true;
									break;
								}
							}
						}
					}
					if(found) break;
					tmp = tmpParent;
					tmpParent = tmpParent.parentNode;
				} while(tmpParent != document);
			}
			j=j+1;
		}
	}
	if(v_cbOldonload){ v_cbOldonload(); }
};
//->