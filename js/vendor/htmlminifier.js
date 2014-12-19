/*!
 * HTMLMinifier v0.6.6 (http://kangax.github.io/html-minifier/)
 * Copyright 2010-2014 Juriy "kangax" Zaytsev
 * Licensed under MIT (https://github.com/kangax/html-minifier/blob/gh-pages/LICENSE)
 */
!function(a){"use strict";function b(a){var b,c=new RegExp("(?:\\s*[\\w:-]+(?:\\s*(?:"+d(a)+")\\s*(?:(?:\"[^\"]*\")|(?:'[^']*')|[^>\\s]+))?)*");if(a.customAttrSurround){for(var e=[],f=a.customAttrSurround.length-1;f>=0;f--)e[f]="(?:\\s*"+a.customAttrSurround[f][0].source+c.source+a.customAttrSurround[f][1].source+")";e.unshift(c.source),b=new RegExp("((?:"+e.join("|")+")*)")}else b=new RegExp("("+c.source+")");return new RegExp(j.source+b.source+k.source)}function c(a){var b=new RegExp(f.source+"(?:\\s*("+d(a)+")\\s*(?:"+i.join("|")+"))?");if(a.customAttrSurround){for(var c=[],e=a.customAttrSurround.length-1;e>=0;e--)c[e]="(?:("+a.customAttrSurround[e][0].source+")"+b.source+"("+a.customAttrSurround[e][1].source+"))";return c.unshift("(?:"+b.source+")"),new RegExp(c.join("|"),"g")}return new RegExp(b.source,"g")}function d(a){return h.concat(a.customAttrAssign||[]).map(function(a){return"(?:"+a.source+")"}).join("|")}function e(a){for(var b={},c=a.split(","),d=0;d<c.length;d++)b[c[d]]=!0,b[c[d].toUpperCase()]=!0;return b}var f=/([\w:-]+)/,g=/=/,h=[g],i=[/"((?:\\.|[^"])*)"/.source,/'((?:\\.|[^'])*)'/.source,/([^>\s]+)/.source],j=/^<([\w:-]+)/,k=/\s*(\/?)>/,l=/^<\/([\w:-]+)[^>]*>/,m=/\/>$/,n=/^<!DOCTYPE [^>]+>/i,o=/<(%|\?)/,p=/(%|\?)>/,q=!1;"x".replace(/x(.)?/g,function(a,b){q=""===b});var r,s,t,u=e("area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed,wbr"),v=e("a,abbr,acronym,applet,b,basefont,bdo,big,br,button,cite,code,del,dfn,em,font,i,iframe,img,input,ins,kbd,label,map,noscript,object,q,s,samp,script,select,small,span,strike,strong,sub,sup,svg,textarea,tt,u,var"),w=e("colgroup,dd,dt,li,options,p,td,tfoot,th,thead,tr,source"),x=e("checked,compact,declare,defer,disabled,ismap,multiple,nohref,noresize,noshade,nowrap,readonly,selected"),y=e("script,style,noscript"),z={},A=a.HTMLParser=function(a,d){function e(a,b,c,e){for(var g=!1;!d.html5&&A.last()&&v[A.last()];)f("",A.last());if(w[b]&&A.last()===b&&f("",b),e=u[b]||!!e,e?g=a.match(m):A.push(b),d.start){var h=[];c.replace(D,function(){var a,b,c,e,f,g,i=7;if(q&&-1===arguments[0].indexOf('""')&&(""===arguments[3]&&(arguments[3]=void 0),""===arguments[4]&&(arguments[4]=void 0),""===arguments[5]&&(arguments[5]=void 0)),a=arguments[1])g=arguments[2],c=arguments[3],b=c||arguments[4]||arguments[5];else if(d.customAttrSurround)for(var j=d.customAttrSurround.length-1;j>=0;j--)if(a=arguments[j*i+7],g=arguments[j*i+8],a){c=arguments[j*i+9],b=c||arguments[j*i+10]||arguments[j*i+11],e=arguments[j*i+6],f=arguments[j*i+12];break}void 0===b&&(b=x[a]?a:c),h.push({name:a,value:b,escaped:b&&b.replace(/(^|[^\\])"/g,"$1&quot;"),customAssign:g||"=",customOpen:e||"",customClose:f||""})}),d.start&&d.start(b,h,e,g)}}function f(a,b){var c;if(b)for(c=A.length-1;c>=0&&A[c].toLowerCase()!==b;c--);else c=0;if(c>=0){for(var e=A.length-1;e>=c;e--)d.end&&d.end(A[e]);A.length=c}}var g,h,i,j,k,A=[],B=a;A.last=function(){return this[this.length-1]};for(var C=b(d),D=c(d);a;){if(h=!0,A.last()&&y[A.last()])r=A.last().toLowerCase(),s=z[r]||(z[r]=new RegExp("([\\s\\S]*?)</"+r+"[^>]*>","i")),a=a.replace(s,function(a,b){return"script"!==r&&"style"!==r&&"noscript"!==r&&(b=b.replace(/<!--([\s\S]*?)-->/g,"$1").replace(/<!\[CDATA\[([\s\S]*?)\]\]>/g,"$1")),d.chars&&d.chars(b),""}),f("",r);else if(0===a.indexOf("<!--")&&(g=a.indexOf("-->"),g>=0&&(d.comment&&d.comment(a.substring(4,g)),a=a.substring(g+3),h=!1)),0===a.indexOf("<![")?(g=a.indexOf("]>"),g>=0&&(d.comment&&d.comment(a.substring(2,g+1),!0),a=a.substring(g+2),h=!1)):0===a.search(o)?(g=a.search(p),g>=0&&(d.ignore&&d.ignore(a.substring(0,g+2)),a=a.substring(g+2),h=!1)):(i=n.exec(a))?(d.doctype&&d.doctype(i[0]),a=a.substring(i[0].length),h=!1):0===a.indexOf("</")?(i=a.match(l),i&&(a=a.substring(i[0].length),i[0].replace(l,f),j="/"+i[1].toLowerCase(),h=!1)):0===a.indexOf("<")&&(i=a.match(C),i&&(a=a.substring(i[0].length),i[0].replace(C,e),j=i[1].toLowerCase(),h=!1)),h){g=a.indexOf("<");var E=0>g?a:a.substring(0,g);a=0>g?"":a.substring(g),t=a.match(C),t?k=t[1]:(t=a.match(l),k=t?"/"+t[1]:""),d.chars&&d.chars(E,j,k)}if(a===B)throw"Parse Error: "+a;B=a}f()};a.HTMLtoXML=function(a){var b="";return new A(a,{start:function(a,c,d){b+="<"+a;for(var e=0;e<c.length;e++)b+=" "+c[e].name+'="'+c[e].escaped+'"';b+=(d?"/":"")+">"},end:function(a){b+="</"+a+">"},chars:function(a){b+=a},comment:function(a){b+="<!--"+a+"-->"},ignore:function(a){b+=a}}),b},a.HTMLtoDOM=function(a,b){var c=e("html,head,body,title"),d={link:"head",base:"head"};b?b=b.ownerDocument||b.getOwnerDocument&&b.getOwnerDocument()||b:"undefined"!=typeof DOMDocument?b=new DOMDocument:"undefined"!=typeof document&&document.implementation&&document.implementation.createDocument?b=document.implementation.createDocument("","",null):"undefined"!=typeof ActiveX&&(b=new ActiveXObject("Msxml.DOMDocument"));var f=[],g=b.documentElement||b.getDocumentElement&&b.getDocumentElement();if(!g&&b.createElement&&!function(){var a=b.createElement("html"),c=b.createElement("head");c.appendChild(b.createElement("title")),a.appendChild(c),a.appendChild(b.createElement("body")),b.appendChild(a)}(),b.getElementsByTagName)for(var h in c)c[h]=b.getElementsByTagName(h)[0];var i=c.body;return new A(a,{start:function(a,e,g){if(c[a])return void(i=c[a]);var h=b.createElement(a);for(var j in e)h.setAttribute(e[j].name,e[j].value);d[a]&&"boolean"!=typeof c[d[a]]?c[d[a]].appendChild(h):i&&i.appendChild&&i.appendChild(h),g||(f.push(h),i=h)},end:function(){f.length-=1,i=f[f.length-1]},chars:function(a){i.appendChild(b.createTextNode(a))},comment:function(){},ignore:function(){}}),b}}("undefined"==typeof exports?this:exports),function(a){"use strict";function b(a){return a?a.replace(/[\t\n\r ]+/g," "):a}function c(a,b,c,d){var e=["a","abbr","acronym","b","bdi","bdo","big","button","cite","code","del","dfn","em","font","i","ins","kbd","mark","q","rt","rp","s","samp","small","span","strike","strong","sub","sup","svg","time","tt","u","var"];return b&&"img"!==b&&"input"!==b&&("/"!==b.substr(0,1)||"/"===b.substr(0,1)&&-1===e.indexOf(b.substr(1)))&&(a=a.replace(/^\s+/,d.conservativeCollapse?" ":"")),c&&"img"!==c&&"input"!==c&&("/"===c.substr(0,1)||"/"!==c.substr(0,1)&&-1===e.indexOf(c))&&(a=a.replace(/\s+$/,d.conservativeCollapse?" ":"")),b&&c?a.replace(/[\t\n\r]+/g," ").replace(/[ ]+/g," "):a}function d(a){return/\[if[^\]]+\]/.test(a)||/\s*((?:<!)?\[endif\])$/.test(a)}function e(a,b){if(/^!/.test(a))return!0;if(b.ignoreCustomComments)for(var c=0,d=b.ignoreCustomComments.length;d>c;c++)if(b.ignoreCustomComments[c].test(a))return!0;return!1}function f(a){return/^on[a-z]+/.test(a)}function g(a){return/^[^\x20\t\n\f\r"'`=<>]+$/.test(a)&&!/\/$/.test(a)&&!/\/$/.test(a)}function h(a,b){for(var c=a.length;c--;)if(a[c].name.toLowerCase()===b)return!0;return!1}function i(a,b,c,d){return c=c?J(c.toLowerCase()):"","script"===a&&"language"===b&&"javascript"===c||"form"===a&&"method"===b&&"get"===c||"input"===a&&"type"===b&&"text"===c||"script"===a&&"charset"===b&&!h(d,"src")||"a"===a&&"name"===b&&h(d,"id")||"area"===a&&"shape"===b&&"rect"===c}function j(a,b,c){return"script"===a&&"type"===b&&"text/javascript"===J(c.toLowerCase())}function k(a,b,c){return("style"===a||"link"===a)&&"type"===b&&"text/css"===J(c.toLowerCase())}function l(a){return/^(?:allowfullscreen|async|autofocus|autoplay|checked|compact|controls|declare|default|defaultchecked|defaultmuted|defaultselected|defer|disabled|draggable|enabled|formnovalidate|hidden|indeterminate|inert|ismap|itemscope|loop|multiple|muted|nohref|noresize|noshade|novalidate|nowrap|open|pauseonexit|readonly|required|reversed|scoped|seamless|selected|sortable|spellcheck|truespeed|typemustmatch|visible)$/.test(a)}function m(a,b){return/^(?:a|area|link|base)$/.test(b)&&"href"===a||"img"===b&&/^(?:src|longdesc|usemap)$/.test(a)||"object"===b&&/^(?:classid|codebase|data|usemap)$/.test(a)||"q"===b&&"cite"===a||"blockquote"===b&&"cite"===a||("ins"===b||"del"===b)&&"cite"===a||"form"===b&&"action"===a||"input"===b&&("src"===a||"usemap"===a)||"head"===b&&"profile"===a||"script"===b&&("src"===a||"for"===a)}function n(a,b){return/^(?:a|area|object|button)$/.test(b)&&"tabindex"===a||"input"===b&&("maxlength"===a||"tabindex"===a)||"select"===b&&("size"===a||"tabindex"===a)||"textarea"===b&&/^(?:rows|cols|tabindex)$/.test(a)||"colgroup"===b&&"span"===a||"col"===b&&"span"===a||("th"===b||"td"===b)&&("rowspan"===a||"colspan"===a)}function o(a,c,d,e,g){if(d&&f(c)){if(d=J(d).replace(/^javascript:\s*/i,"").replace(/\s*;$/,""),e.minifyJS){var h="(function(){"+d+"})()",i=D(h,e.minifyJS);return i.slice(12,i.length-4).replace(/"/g,"&quot;")}return d}return"class"===c?b(J(d)):m(c,a)?(d=J(d),e.minifyURLs?C(d,e.minifyURLs):d):n(c,a)?J(d):"style"===c?(d=J(d).replace(/\s*;\s*$/,""),e.minifyCSS?E(d,e.minifyCSS):d):(p(a,g)&&"content"===c&&(d=d.replace(/1\.0/g,"1").replace(/\s+/g,"")),d)}function p(a,b){if("meta"!==a)return!1;for(var c=0,d=b.length;d>c;c++)if("name"===b[c].name&&"viewport"===b[c].value)return!0}function q(a){return a.replace(/^(\[[^\]]+\]>)\s*/,"$1").replace(/\s*(<!\[endif\])$/,"$1")}function r(a){return a.replace(/^(?:\s*\/\*\s*<!\[CDATA\[\s*\*\/|\s*\/\/\s*<!\[CDATA\[.*)/,"").replace(/(?:\/\*\s*\]\]>\s*\*\/|\/\/\s*\]\]>)\s*$/,"")}function s(a,b,c){for(var d=0,e=c.length;e>d;d++)if("type"===c[d].name.toLowerCase()&&b.processScripts.indexOf(c[d].value)>-1)return F(a,b);return a}function t(a,b){return a.replace(K[b],"").replace(L[b],"")}function u(a){return/^(?:html|t?body|t?head|tfoot|tr|td|th|dt|dd|option|colgroup|source)$/.test(a)}function v(a,b,c){var d=/^(["'])?\s*\1$/.test(c);return d?"input"===a&&"value"===b||M.test(b):!1}function w(a){return"textarea"!==a}function x(a){return!/^(?:script|style|pre|textarea)$/.test(a)}function y(a){return!/^(?:pre|textarea)$/.test(a)}function z(a){for(var b="",c=0,d=a.length;d>c;c++)b+=" "+a[c].name+(l(a[c].value)?"":'="'+a[c].value+'"');return b}function A(a,b,c,d){var e,f=d.caseSensitive?a.name:a.name.toLowerCase(),h=a.escaped;return d.removeRedundantAttributes&&i(c,f,h,b)||d.removeScriptTypeAttributes&&j(c,f,h)||d.removeStyleLinkTypeAttributes&&k(c,f,h)?"":(h=o(c,f,h,d,b),(void 0!==h&&!d.removeAttributeQuotes||!g(h))&&(h='"'+h+'"'),d.removeEmptyAttributes&&v(c,f,h)?"":(e=void 0===h||d.collapseBooleanAttributes&&l(f)?f:f+a.customAssign+h," "+a.customOpen+e+a.customClose))}function B(a){for(var b=["canCollapseWhitespace","canTrimWhitespace"],c=0,d=b.length;d>c;c++)a[b[c]]||(a[b[c]]=function(){return!1})}function C(b,c){"object"!=typeof c&&(c={});try{var d=a.RelateUrl;return"undefined"==typeof d&&"function"==typeof require&&(d=require("relateurl")),d&&d.relate?d.relate(b,c):b}catch(e){H(e)}return b}function D(b,c){"object"!=typeof c&&(c={}),c.fromString=!0,c.output={inline_script:!0};try{var d=a.UglifyJS;if("undefined"==typeof d&&"function"==typeof require&&(d=require("uglify-js")),!d)return b;if(d.minify)return d.minify(b,c).code;if(d.parse){var e=d.parse(b);e.figure_out_scope();var f=d.Compressor(),g=e.transform(f);g.figure_out_scope(),g.compute_char_frequency(),c.mangle!==!1&&g.mangle_names();var h=d.OutputStream(c.output);return g.print(h),h.toString()}return b}catch(i){H(i)}return b}function E(a,b){"object"!=typeof b&&(b={}),"undefined"==typeof b.noAdvanced&&(b.noAdvanced=!0);try{if("undefined"!=typeof CleanCSS)return new CleanCSS(b).minify(a);if("function"==typeof require){var c=require("clean-css");return new c(b).minify(a)}}catch(d){H(d)}return a}function F(a,f){function g(a,b){return x(a)||f.canCollapseWhitespace(a,b)}function h(a,b){return y(a)||f.canTrimWhitespace(a,b)}f=f||{},a=J(a),B(f);var i=[],j=[],k="",l="",m=[],n=[],o=[],p=f.lint,v=!1,C=new Date;new I(a,{html5:"undefined"!=typeof f.html5?f.html5:!0,start:function(a,b,c,d){if(v)return void j.push("<"+a,z(b),d?"/":"",">");a=f.caseSensitive?a:a.toLowerCase(),l=a,k="",m=b,f.collapseWhitespace&&(h(a,b)||n.push(a),g(a,b)||o.push(a));var e="<"+a,i=(d&&f.keepClosingSlash?"/":"")+">";0===b.length&&(e+=i),j.push(e),p&&p.testElement(a);for(var q,r=0,s=b.length;s>r;r++)p&&p.testAttribute(a,b[r].name.toLowerCase(),b[r].escaped),q=A(b[r],b,a,f),r===s-1&&(q+=i),j.push(q)},end:function(a){if(v)return void j.push("</"+a+">");f.collapseWhitespace&&(n.length&&a===n[n.length-1]&&n.pop(),o.length&&a===o[o.length-1]&&o.pop());var b=""===k&&a===l;if(f.removeEmptyElements&&b&&w(a)){for(var c=j.length-1;c>=0;c--)if(/^<[^\/!]/.test(j[c])){j.splice(c);break}}else f.removeOptionalTags&&u(a)||(j.push("</"+(f.caseSensitive?a:a.toLowerCase())+">"),i.push.apply(i,j),j.length=0,k="")},chars:function(a,d,e){return v?void j.push(a):(("script"===l||"style"===l)&&(f.removeCommentsFromCDATA&&(a=t(a,l)),f.removeCDATASectionsFromCDATA&&(a=r(a)),f.processScripts&&(a=s(a,f,m))),"script"===l&&f.minifyJS&&(a=D(a,f.minifyJS)),"style"===l&&f.minifyCSS&&(a=E(a,f.minifyCSS)),f.collapseWhitespace&&(n.length||(a=d||e?c(a,d,e,f):J(a)),o.length||(a=b(a))),k=a,p&&p.testChars(a),void j.push(a))},comment:function(a,b){var c=b?"<!":"<!--",g=b?">":"-->";return/^\s*htmlmin:ignore/.test(a)?(v=!v,void j.push("<!--"+a+"-->")):(a=f.removeComments?d(a)?c+q(a)+g:e(a,f)?"<!--"+a+"-->":"":c+a+g,void j.push(a))},ignore:function(a){j.push(f.removeIgnored?"":a)},doctype:function(a){j.push(f.useShortDoctype?"<!DOCTYPE html>":b(a))},customAttrAssign:f.customAttrAssign,customAttrSurround:f.customAttrSurround}),i.push.apply(i,j);var F=G(i,f);return H("minified in: "+(new Date-C)+"ms"),F}function G(a,b){var c,d=b.maxLineLength;if(d){for(var e,f=[],g="",h=0,i=a.length;i>h;h++)e=a[h],g.length+e.length<d?g+=e:(f.push(g.replace(/^\n/,"")),g=e);f.push(g),c=f.join("\n")}else c=a.join("");return c}var H,I;H=a.console&&a.console.log?function(b){a.console.log(b)}:function(){},a.HTMLParser?I=a.HTMLParser:"function"==typeof require&&(I=require("./htmlparser").HTMLParser);var J=function(a){return"string"!=typeof a?a:a.replace(/^\s+/,"").replace(/\s+$/,"")};String.prototype.trim&&(J=function(a){return"string"!=typeof a?a:a.trim()});var K={script:/^\s*(?:\/\/)?\s*<!--.*\n?/,style:/^\s*<!--\s*/},L={script:/\s*(?:\/\/)?\s*-->\s*$/,style:/\s*-->\s*$/},M=new RegExp("^(?:class|id|style|title|lang|dir|on(?:focus|blur|change|click|dblclick|mouse(?:down|up|over|move|out)|key(?:press|down|up)))$");"undefined"!=typeof exports?exports.minify=F:a.minify=F}(this),function(a){"use strict";function b(a){return/^(?:big|small|hr|blink|marquee)$/.test(a)}function c(a){return/^(?:applet|basefont|center|dir|font|isindex|strike)$/.test(a)}function d(a){return/^on[a-z]+/.test(a)}function e(a){return"style"===a.toLowerCase()}function f(a,b){return"align"===b&&/^(?:caption|applet|iframe|img|imput|object|legend|table|hr|div|h[1-6]|p)$/.test(a)||"alink"===b&&"body"===a||"alt"===b&&"applet"===a||"archive"===b&&"applet"===a||"background"===b&&"body"===a||"bgcolor"===b&&/^(?:table|t[rdh]|body)$/.test(a)||"border"===b&&/^(?:img|object)$/.test(a)||"clear"===b&&"br"===a||"code"===b&&"applet"===a||"codebase"===b&&"applet"===a||"color"===b&&/^(?:base(?:font)?)$/.test(a)||"compact"===b&&/^(?:dir|[dou]l|menu)$/.test(a)||"face"===b&&/^base(?:font)?$/.test(a)||"height"===b&&/^(?:t[dh]|applet)$/.test(a)||"hspace"===b&&/^(?:applet|img|object)$/.test(a)||"language"===b&&"script"===a||"link"===b&&"body"===a||"name"===b&&"applet"===a||"noshade"===b&&"hr"===a||"nowrap"===b&&/^t[dh]$/.test(a)||"object"===b&&"applet"===a||"prompt"===b&&"isindex"===a||"size"===b&&/^(?:hr|font|basefont)$/.test(a)||"start"===b&&"ol"===a||"text"===b&&"body"===a||"type"===b&&/^(?:li|ol|ul)$/.test(a)||"value"===b&&"li"===a||"version"===b&&"html"===a||"vlink"===b&&"body"===a||"vspace"===b&&/^(?:applet|img|object)$/.test(a)||"width"===b&&/^(?:hr|td|th|applet|pre)$/.test(a)}function g(a,b){return"href"===a&&/^\s*javascript\s*:\s*void\s*(\s+0|\(\s*0\s*\))\s*$/i.test(b)}function h(){this.log=[],this._lastElement=null,this._isElementRepeated=!1}h.prototype.testElement=function(a){c(a)?this.log.push('Found <span class="deprecated-element">deprecated</span> <strong><code>&lt;'+a+"&gt;</code></strong> element"):b(a)?this.log.push('Found <span class="presentational-element">presentational</span> <strong><code>&lt;'+a+"&gt;</code></strong> element"):this.checkRepeatingElement(a)},h.prototype.checkRepeatingElement=function(a){"br"===a&&"br"===this._lastElement?this._isElementRepeated=!0:this._isElementRepeated&&(this._reportRepeatingElement(),this._isElementRepeated=!1),this._lastElement=a},h.prototype._reportRepeatingElement=function(){this.log.push("Found <code>&lt;br></code> sequence. Try replacing it with styling.")},h.prototype.testAttribute=function(a,b,c){d(b)?this.log.push('Found <span class="event-attribute">event attribute</span> (<strong>'+b+"</strong>) on <strong><code>&lt;"+a+"&gt;</code></strong> element."):f(a,b)?this.log.push('Found <span class="deprecated-attribute">deprecated</span> <strong>'+b+"</strong> attribute on <strong><code>&lt;"+a+"&gt;</code></strong> element."):e(b)?this.log.push('Found <span class="style-attribute">style attribute</span> on <strong><code>&lt;'+a+"&gt;</code></strong> element."):g(b,c)&&this.log.push('Found <span class="inaccessible-attribute">inaccessible attribute</span> (on <strong><code>&lt;'+a+"&gt;</code></strong> element).")},h.prototype.testChars=function(a){this._lastElement="",/(&nbsp;\s*){2,}/.test(a)&&this.log.push("Found repeating <strong><code>&amp;nbsp;</code></strong> sequence. Try replacing it with styling.")},h.prototype.test=function(a,b,c){this.testElement(a),this.testAttribute(a,b,c)},h.prototype.populate=function(a){if(this._isElementRepeated&&this._reportRepeatingElement(),this.log.length)if(a)a.innerHTML="<ol><li>"+this.log.join("<li>")+"</ol>";else{var b=" - "+this.log.join("\n - ").replace(/(<([^>]+)>)/gi,"").replace(/&lt;/g,"<").replace(/&gt;/g,">");console.log(b)}},a.HTMLLint=h}("undefined"==typeof exports?this:exports);