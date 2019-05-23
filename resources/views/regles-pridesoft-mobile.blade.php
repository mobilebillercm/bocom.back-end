
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html id="iubenda_policy" class="iubenda_fixed_policy">
<head>


	
  <title>Politique de confidentialité de BOCOM Mobile</title>
	
	<meta content="Cette Application collecte certaines Données personnelles de ses Utilisateurs." name="description" />
	<meta content="privacy policy" name="keywords" />

  <meta http-equiv="Content-Language" content="fr" />
  <meta name="robots" content="noindex, follow">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","errorBeacon":"bam.nr-data.net","licenseKey":"cff3f9c950","applicationID":"541403","transactionName":"cF4LTEIMD1RURBdDWkdUSkhCChVZUk9nQFxfWAZBHxALV0Y=","queueTime":0,"applicationTime":207,"agent":""}</script>
<script type="text/javascript">(window.NREUM||(NREUM={})).loader_config={xpid:"XAUFU1VADQcBUFFR"};window.NREUM||(NREUM={}),__nr_require=function(t,n,e){function r(e){if(!n[e]){var o=n[e]={exports:{}};t[e][0].call(o.exports,function(n){var o=t[e][1][n];return r(o||n)},o,o.exports)}return n[e].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<e.length;o++)r(e[o]);return r}({1:[function(t,n,e){function r(t){try{s.console&&console.log(t)}catch(n){}}var o,i=t("ee"),a=t(15),s={};try{o=localStorage.getItem("__nr_flags").split(","),console&&"function"==typeof console.log&&(s.console=!0,o.indexOf("dev")!==-1&&(s.dev=!0),o.indexOf("nr_dev")!==-1&&(s.nrDev=!0))}catch(c){}s.nrDev&&i.on("internal-error",function(t){r(t.stack)}),s.dev&&i.on("fn-err",function(t,n,e){r(e.stack)}),s.dev&&(r("NR AGENT IN DEVELOPMENT MODE"),r("flags: "+a(s,function(t,n){return t}).join(", ")))},{}],2:[function(t,n,e){function r(t,n,e,r,o){try{d?d-=1:i("err",[o||new UncaughtException(t,n,e)])}catch(s){try{i("ierr",[s,c.now(),!0])}catch(u){}}return"function"==typeof f&&f.apply(this,a(arguments))}function UncaughtException(t,n,e){this.message=t||"Uncaught error with no additional information",this.sourceURL=n,this.line=e}function o(t){i("err",[t,c.now()])}var i=t("handle"),a=t(16),s=t("ee"),c=t("loader"),f=window.onerror,u=!1,d=0;c.features.err=!0,t(1),window.onerror=r;try{throw new Error}catch(l){"stack"in l&&(t(8),t(7),"addEventListener"in window&&t(5),c.xhrWrappable&&t(9),u=!0)}s.on("fn-start",function(t,n,e){u&&(d+=1)}),s.on("fn-err",function(t,n,e){u&&(this.thrown=!0,o(e))}),s.on("fn-end",function(){u&&!this.thrown&&d>0&&(d-=1)}),s.on("internal-error",function(t){i("ierr",[t,c.now(),!0])})},{}],3:[function(t,n,e){t("loader").features.ins=!0},{}],4:[function(t,n,e){function r(t){}if(window.performance&&window.performance.timing&&window.performance.getEntriesByType){var o=t("ee"),i=t("handle"),a=t(8),s=t(7),c="learResourceTimings",f="addEventListener",u="resourcetimingbufferfull",d="bstResource",l="resource",p="-start",h="-end",m="fn"+p,w="fn"+h,v="bstTimer",y="pushState",g=t("loader");g.features.stn=!0,t(6);var b=NREUM.o.EV;o.on(m,function(t,n){var e=t[0];e instanceof b&&(this.bstStart=g.now())}),o.on(w,function(t,n){var e=t[0];e instanceof b&&i("bst",[e,n,this.bstStart,g.now()])}),a.on(m,function(t,n,e){this.bstStart=g.now(),this.bstType=e}),a.on(w,function(t,n){i(v,[n,this.bstStart,g.now(),this.bstType])}),s.on(m,function(){this.bstStart=g.now()}),s.on(w,function(t,n){i(v,[n,this.bstStart,g.now(),"requestAnimationFrame"])}),o.on(y+p,function(t){this.time=g.now(),this.startPath=location.pathname+location.hash}),o.on(y+h,function(t){i("bstHist",[location.pathname+location.hash,this.startPath,this.time])}),f in window.performance&&(window.performance["c"+c]?window.performance[f](u,function(t){i(d,[window.performance.getEntriesByType(l)]),window.performance["c"+c]()},!1):window.performance[f]("webkit"+u,function(t){i(d,[window.performance.getEntriesByType(l)]),window.performance["webkitC"+c]()},!1)),document[f]("scroll",r,{passive:!0}),document[f]("keypress",r,!1),document[f]("click",r,!1)}},{}],5:[function(t,n,e){function r(t){for(var n=t;n&&!n.hasOwnProperty(u);)n=Object.getPrototypeOf(n);n&&o(n)}function o(t){s.inPlace(t,[u,d],"-",i)}function i(t,n){return t[1]}var a=t("ee").get("events"),s=t(18)(a,!0),c=t("gos"),f=XMLHttpRequest,u="addEventListener",d="removeEventListener";n.exports=a,"getPrototypeOf"in Object?(r(document),r(window),r(f.prototype)):f.prototype.hasOwnProperty(u)&&(o(window),o(f.prototype)),a.on(u+"-start",function(t,n){var e=t[1],r=c(e,"nr@wrapped",function(){function t(){if("function"==typeof e.handleEvent)return e.handleEvent.apply(e,arguments)}var n={object:t,"function":e}[typeof e];return n?s(n,"fn-",null,n.name||"anonymous"):e});this.wrapped=t[1]=r}),a.on(d+"-start",function(t){t[1]=this.wrapped||t[1]})},{}],6:[function(t,n,e){var r=t("ee").get("history"),o=t(18)(r);n.exports=r,o.inPlace(window.history,["pushState","replaceState"],"-")},{}],7:[function(t,n,e){var r=t("ee").get("raf"),o=t(18)(r),i="equestAnimationFrame";n.exports=r,o.inPlace(window,["r"+i,"mozR"+i,"webkitR"+i,"msR"+i],"raf-"),r.on("raf-start",function(t){t[0]=o(t[0],"fn-")})},{}],8:[function(t,n,e){function r(t,n,e){t[0]=a(t[0],"fn-",null,e)}function o(t,n,e){this.method=e,this.timerDuration=isNaN(t[1])?0:+t[1],t[0]=a(t[0],"fn-",this,e)}var i=t("ee").get("timer"),a=t(18)(i),s="setTimeout",c="setInterval",f="clearTimeout",u="-start",d="-";n.exports=i,a.inPlace(window,[s,"setImmediate"],s+d),a.inPlace(window,[c],c+d),a.inPlace(window,[f,"clearImmediate"],f+d),i.on(c+u,r),i.on(s+u,o)},{}],9:[function(t,n,e){function r(t,n){d.inPlace(n,["onreadystatechange"],"fn-",s)}function o(){var t=this,n=u.context(t);t.readyState>3&&!n.resolved&&(n.resolved=!0,u.emit("xhr-resolved",[],t)),d.inPlace(t,y,"fn-",s)}function i(t){g.push(t),h&&(x?x.then(a):w?w(a):(E=-E,O.data=E))}function a(){for(var t=0;t<g.length;t++)r([],g[t]);g.length&&(g=[])}function s(t,n){return n}function c(t,n){for(var e in t)n[e]=t[e];return n}t(5);var f=t("ee"),u=f.get("xhr"),d=t(18)(u),l=NREUM.o,p=l.XHR,h=l.MO,m=l.PR,w=l.SI,v="readystatechange",y=["onload","onerror","onabort","onloadstart","onloadend","onprogress","ontimeout"],g=[];n.exports=u;var b=window.XMLHttpRequest=function(t){var n=new p(t);try{u.emit("new-xhr",[n],n),n.addEventListener(v,o,!1)}catch(e){try{u.emit("internal-error",[e])}catch(r){}}return n};if(c(p,b),b.prototype=p.prototype,d.inPlace(b.prototype,["open","send"],"-xhr-",s),u.on("send-xhr-start",function(t,n){r(t,n),i(n)}),u.on("open-xhr-start",r),h){var x=m&&m.resolve();if(!w&&!m){var E=1,O=document.createTextNode(E);new h(a).observe(O,{characterData:!0})}}else f.on("fn-end",function(t){t[0]&&t[0].type===v||a()})},{}],10:[function(t,n,e){function r(t){var n=this.params,e=this.metrics;if(!this.ended){this.ended=!0;for(var r=0;r<d;r++)t.removeEventListener(u[r],this.listener,!1);if(!n.aborted){if(e.duration=a.now()-this.startTime,4===t.readyState){n.status=t.status;var i=o(t,this.lastSize);if(i&&(e.rxSize=i),this.sameOrigin){var c=t.getResponseHeader("X-NewRelic-App-Data");c&&(n.cat=c.split(", ").pop())}}else n.status=0;e.cbTime=this.cbTime,f.emit("xhr-done",[t],t),s("xhr",[n,e,this.startTime])}}}function o(t,n){var e=t.responseType;if("json"===e&&null!==n)return n;var r="arraybuffer"===e||"blob"===e||"json"===e?t.response:t.responseText;return h(r)}function i(t,n){var e=c(n),r=t.params;r.host=e.hostname+":"+e.port,r.pathname=e.pathname,t.sameOrigin=e.sameOrigin}var a=t("loader");if(a.xhrWrappable){var s=t("handle"),c=t(11),f=t("ee"),u=["load","error","abort","timeout"],d=u.length,l=t("id"),p=t(14),h=t(13),m=window.XMLHttpRequest;a.features.xhr=!0,t(9),f.on("new-xhr",function(t){var n=this;n.totalCbs=0,n.called=0,n.cbTime=0,n.end=r,n.ended=!1,n.xhrGuids={},n.lastSize=null,p&&(p>34||p<10)||window.opera||t.addEventListener("progress",function(t){n.lastSize=t.loaded},!1)}),f.on("open-xhr-start",function(t){this.params={method:t[0]},i(this,t[1]),this.metrics={}}),f.on("open-xhr-end",function(t,n){"loader_config"in NREUM&&"xpid"in NREUM.loader_config&&this.sameOrigin&&n.setRequestHeader("X-NewRelic-ID",NREUM.loader_config.xpid)}),f.on("send-xhr-start",function(t,n){var e=this.metrics,r=t[0],o=this;if(e&&r){var i=h(r);i&&(e.txSize=i)}this.startTime=a.now(),this.listener=function(t){try{"abort"===t.type&&(o.params.aborted=!0),("load"!==t.type||o.called===o.totalCbs&&(o.onloadCalled||"function"!=typeof n.onload))&&o.end(n)}catch(e){try{f.emit("internal-error",[e])}catch(r){}}};for(var s=0;s<d;s++)n.addEventListener(u[s],this.listener,!1)}),f.on("xhr-cb-time",function(t,n,e){this.cbTime+=t,n?this.onloadCalled=!0:this.called+=1,this.called!==this.totalCbs||!this.onloadCalled&&"function"==typeof e.onload||this.end(e)}),f.on("xhr-load-added",function(t,n){var e=""+l(t)+!!n;this.xhrGuids&&!this.xhrGuids[e]&&(this.xhrGuids[e]=!0,this.totalCbs+=1)}),f.on("xhr-load-removed",function(t,n){var e=""+l(t)+!!n;this.xhrGuids&&this.xhrGuids[e]&&(delete this.xhrGuids[e],this.totalCbs-=1)}),f.on("addEventListener-end",function(t,n){n instanceof m&&"load"===t[0]&&f.emit("xhr-load-added",[t[1],t[2]],n)}),f.on("removeEventListener-end",function(t,n){n instanceof m&&"load"===t[0]&&f.emit("xhr-load-removed",[t[1],t[2]],n)}),f.on("fn-start",function(t,n,e){n instanceof m&&("onload"===e&&(this.onload=!0),("load"===(t[0]&&t[0].type)||this.onload)&&(this.xhrCbStart=a.now()))}),f.on("fn-end",function(t,n){this.xhrCbStart&&f.emit("xhr-cb-time",[a.now()-this.xhrCbStart,this.onload,n],n)})}},{}],11:[function(t,n,e){n.exports=function(t){var n=document.createElement("a"),e=window.location,r={};n.href=t,r.port=n.port;var o=n.href.split("://");!r.port&&o[1]&&(r.port=o[1].split("/")[0].split("@").pop().split(":")[1]),r.port&&"0"!==r.port||(r.port="https"===o[0]?"443":"80"),r.hostname=n.hostname||e.hostname,r.pathname=n.pathname,r.protocol=o[0],"/"!==r.pathname.charAt(0)&&(r.pathname="/"+r.pathname);var i=!n.protocol||":"===n.protocol||n.protocol===e.protocol,a=n.hostname===document.domain&&n.port===e.port;return r.sameOrigin=i&&(!n.hostname||a),r}},{}],12:[function(t,n,e){function r(){}function o(t,n,e){return function(){return i(t,[f.now()].concat(s(arguments)),n?null:this,e),n?void 0:this}}var i=t("handle"),a=t(15),s=t(16),c=t("ee").get("tracer"),f=t("loader"),u=NREUM;"undefined"==typeof window.newrelic&&(newrelic=u);var d=["setPageViewName","setCustomAttribute","setErrorHandler","finished","addToTrace","inlineHit","addRelease"],l="api-",p=l+"ixn-";a(d,function(t,n){u[n]=o(l+n,!0,"api")}),u.addPageAction=o(l+"addPageAction",!0),u.setCurrentRouteName=o(l+"routeName",!0),n.exports=newrelic,u.interaction=function(){return(new r).get()};var h=r.prototype={createTracer:function(t,n){var e={},r=this,o="function"==typeof n;return i(p+"tracer",[f.now(),t,e],r),function(){if(c.emit((o?"":"no-")+"fn-start",[f.now(),r,o],e),o)try{return n.apply(this,arguments)}finally{c.emit("fn-end",[f.now()],e)}}}};a("setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","),function(t,n){h[n]=o(p+n)}),newrelic.noticeError=function(t){"string"==typeof t&&(t=new Error(t)),i("err",[t,f.now()])}},{}],13:[function(t,n,e){n.exports=function(t){if("string"==typeof t&&t.length)return t.length;if("object"==typeof t){if("undefined"!=typeof ArrayBuffer&&t instanceof ArrayBuffer&&t.byteLength)return t.byteLength;if("undefined"!=typeof Blob&&t instanceof Blob&&t.size)return t.size;if(!("undefined"!=typeof FormData&&t instanceof FormData))try{return JSON.stringify(t).length}catch(n){return}}}},{}],14:[function(t,n,e){var r=0,o=navigator.userAgent.match(/Firefox[\/\s](\d+\.\d+)/);o&&(r=+o[1]),n.exports=r},{}],15:[function(t,n,e){function r(t,n){var e=[],r="",i=0;for(r in t)o.call(t,r)&&(e[i]=n(r,t[r]),i+=1);return e}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],16:[function(t,n,e){function r(t,n,e){n||(n=0),"undefined"==typeof e&&(e=t?t.length:0);for(var r=-1,o=e-n||0,i=Array(o<0?0:o);++r<o;)i[r]=t[n+r];return i}n.exports=r},{}],17:[function(t,n,e){n.exports={exists:"undefined"!=typeof window.performance&&window.performance.timing&&"undefined"!=typeof window.performance.timing.navigationStart}},{}],18:[function(t,n,e){function r(t){return!(t&&t instanceof Function&&t.apply&&!t[a])}var o=t("ee"),i=t(16),a="nr@original",s=Object.prototype.hasOwnProperty,c=!1;n.exports=function(t,n){function e(t,n,e,o){function nrWrapper(){var r,a,s,c;try{a=this,r=i(arguments),s="function"==typeof e?e(r,a):e||{}}catch(f){l([f,"",[r,a,o],s])}u(n+"start",[r,a,o],s);try{return c=t.apply(a,r)}catch(d){throw u(n+"err",[r,a,d],s),d}finally{u(n+"end",[r,a,c],s)}}return r(t)?t:(n||(n=""),nrWrapper[a]=t,d(t,nrWrapper),nrWrapper)}function f(t,n,o,i){o||(o="");var a,s,c,f="-"===o.charAt(0);for(c=0;c<n.length;c++)s=n[c],a=t[s],r(a)||(t[s]=e(a,f?s+o:o,i,s))}function u(e,r,o){if(!c||n){var i=c;c=!0;try{t.emit(e,r,o,n)}catch(a){l([a,e,r,o])}c=i}}function d(t,n){if(Object.defineProperty&&Object.keys)try{var e=Object.keys(t);return e.forEach(function(e){Object.defineProperty(n,e,{get:function(){return t[e]},set:function(n){return t[e]=n,n}})}),n}catch(r){l([r])}for(var o in t)s.call(t,o)&&(n[o]=t[o]);return n}function l(n){try{t.emit("internal-error",n)}catch(e){}}return t||(t=o),e.inPlace=f,e.flag=a,e}},{}],ee:[function(t,n,e){function r(){}function o(t){function n(t){return t&&t instanceof r?t:t?c(t,s,i):i()}function e(e,r,o,i){if(!l.aborted||i){t&&t(e,r,o);for(var a=n(o),s=h(e),c=s.length,f=0;f<c;f++)s[f].apply(a,r);var d=u[y[e]];return d&&d.push([g,e,r,a]),a}}function p(t,n){v[t]=h(t).concat(n)}function h(t){return v[t]||[]}function m(t){return d[t]=d[t]||o(e)}function w(t,n){f(t,function(t,e){n=n||"feature",y[e]=n,n in u||(u[n]=[])})}var v={},y={},g={on:p,emit:e,get:m,listeners:h,context:n,buffer:w,abort:a,aborted:!1};return g}function i(){return new r}function a(){(u.api||u.feature)&&(l.aborted=!0,u=l.backlog={})}var s="nr@context",c=t("gos"),f=t(15),u={},d={},l=n.exports=o();l.backlog=u},{}],gos:[function(t,n,e){function r(t,n,e){if(o.call(t,n))return t[n];var r=e();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(t,n,{value:r,writable:!0,enumerable:!1}),r}catch(i){}return t[n]=r,r}var o=Object.prototype.hasOwnProperty;n.exports=r},{}],handle:[function(t,n,e){function r(t,n,e,r){o.buffer([t],r),o.emit(t,n,e)}var o=t("ee").get("handle");n.exports=r,r.ee=o},{}],id:[function(t,n,e){function r(t){var n=typeof t;return!t||"object"!==n&&"function"!==n?-1:t===window?0:a(t,i,function(){return o++})}var o=1,i="nr@id",a=t("gos");n.exports=r},{}],loader:[function(t,n,e){function r(){if(!x++){var t=b.info=NREUM.info,n=l.getElementsByTagName("script")[0];if(setTimeout(u.abort,3e4),!(t&&t.licenseKey&&t.applicationID&&n))return u.abort();f(y,function(n,e){t[n]||(t[n]=e)}),c("mark",["onload",a()+b.offset],null,"api");var e=l.createElement("script");e.src="https://"+t.agent,n.parentNode.insertBefore(e,n)}}function o(){"complete"===l.readyState&&i()}function i(){c("mark",["domContent",a()+b.offset],null,"api")}function a(){return E.exists&&performance.now?Math.round(performance.now()):(s=Math.max((new Date).getTime(),s))-b.offset}var s=(new Date).getTime(),c=t("handle"),f=t(15),u=t("ee"),d=window,l=d.document,p="addEventListener",h="attachEvent",m=d.XMLHttpRequest,w=m&&m.prototype;NREUM.o={ST:setTimeout,SI:d.setImmediate,CT:clearTimeout,XHR:m,REQ:d.Request,EV:d.Event,PR:d.Promise,MO:d.MutationObserver};var v=""+location,y={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-1044.min.js"},g=m&&w&&w[p]&&!/CriOS/.test(navigator.userAgent),b=n.exports={offset:s,now:a,origin:v,features:{},xhrWrappable:g};t(12),l[p]?(l[p]("DOMContentLoaded",i,!1),d[p]("load",r,!1)):(l[h]("onreadystatechange",o),d[h]("onload",r)),c("mark",["firstbyte",s],null,"api");var x=0,E=t(17)},{}]},{},["loader",2,10,4,3]);</script>
	<meta http-equiv="date" content="2017-09-07">
	<meta http-equiv="last-modified" content="2017-09-07">
	<meta property="og:title" content="Politique de confidentialité de BOCOM Mobile" />
	<meta property="og:type" content="website" />
	<!--<meta property="og:image" content="https://www.iubenda.com/images/site/fb-image.png" />-->
	<meta property="og:site_name" content="iubenda" />
	<meta property="fb:app_id" content="190131204371223"/>
	<!--<link rel="image_src" href="https://www.iubenda.com/images/site/fb-image.png"/>-->

  <meta name="viewport" content="width=device-width">

  <link href="policy.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="policy.js" type="text/javascript"></script>

</head>
<body>

  


    <div id="wbars_all">
      <div class="iub_container iub_base_container">
        <div id="wbars">
          <div class="iub_content legal_pp">


            
<div class="iub_header">

    <h1>Politique de confidentialité de <strong>BOCOM Mobile</strong></h1>

      <p>Cette Application collecte certaines Données personnelles de ses Utilisateurs.</p>
</div> <!-- /header -->

	
	              <div class="simple_pp">
	
	                <div class="one_line_col">
	
	                  <h2 style="text-align: center; font-variant:small-caps;">Résumé de la politique</h2>
	
	                </div> <!-- /one_line_col -->

	                



    <h2>Données personnelles collectées pour les raisons suivantes et en utilisant les services suivants :</h2>

    <ul class="for_boxes cf">

      <li class="one_line_col">
        <ul class="for_boxes">


            <li>

              <div class="iconed policyicon_purpose_47">

                <h3>Autorisations du dispositif pour accéder aux Données personnelles</h3>


                <ul>




                    <li>
                      <h3>Autorisations du dispositif pour accéder aux Données personnelles</h3>
                      <p>Données personnelles : Autorisation de la localisation approximative (non continue), Autorisation de la localisation précise (non continue) et Autorisation du téléphone</p>
                    </li>


                </ul>

              </div>

            </li>

           

        </ul>
      </li>

    </ul>
   

 





	
	              </div> <!-- /simple_pp -->
	
	              <div class="one_line_col">
	
	                <h2 style="text-align: center; font-variant:small-caps;">Politique en entier</h2>
	
	              </div> <!-- /one_line_col -->
	
	             
             

            
<div class="one_line_col">

  <h2>Responsable des données et Propriétaire</h2>


</div> <!-- /one_line_col -->


<div class="one_line_col">

  <h2>Types de Données collectées</h2>

	  <p>
	  	Figurent parmi les types de Données personnelles que cette Application collecte directement ou en recourant à des tiers : 
       Autorisation de la localisation précise (non continue), Autorisation de la localisation approximative (non continue) et Autorisation du téléphone.
	  </p>
 

    <p>Les détails complets sur chaque type de Données personnelles collectées sont fournis dans les parties dédiées de la présente politique de confidentialité ou par des textes d’explication spécifiques publiés avant la collecte des Données.<br />Les Données personnelles peuvent être librement fournies par l’Utilisateur, ou, en cas de Données d’utilisation, collectées automatiquement lorsque vous utilisez cette Application.<br />Toutes les Données demandées par cette Application sont obligatoires et leur absence peut rendre impossible la fourniture des services par cette Application. Dans le cas où cette Application précise que certaines Données ne sont pas obligatoires, les Utilisateurs sont libres de ne pas les communiquer sans entraîner de conséquences sur la disponibilité ou le fonctionnement du service.<br />Les Utilisateurs qui ne sont pas sûrs de savoir quelles sont les Données personnelles obligatoires sont invités à contacter le Propriétaire.<br />Toute utilisation des Cookies – ou d’autres outils de suivi – par cette Application ou par les propriétaires de services de tiers utilisés par cette Application a pour objectif de fournir le service requis par l’Utilisateur, en plus d’autres finalités décrites dans le présent document et dans la Politique relative aux cookies, si elle est disponible.</p>
    <p>Les Utilisateurs sont responsables de toute Donnée personnelle de tiers obtenue, publiée ou communiquée par l’intermédiaire de cette Application et confirment qu’ils obtiennent le consentement du tiers pour fournir les Données au Propriétaire.</p>

</div> <!-- /one_line_col -->


<div class="one_line_col">

  <h2>Mode et lieu de traitement des Données</h2>

  <h3>Méthodes de traitement</h3>

  <p>Le Responsable des données traite les Données de l’Utilisateur d’une manière appropriée et prend toutes les mesures de sécurité nécessaires pour empêcher l’accès, la divulgation, la modification ou la destruction non autorisés des Données. Le Traitement des données est effectué à l’aide d’ordinateurs ou d’outils informatiques et en suivant les procédures et les modes organisationnels étroitement liés aux finalités indiquées. L’accès, outre celui réservé au Responsable du traitement des données, peut dans certains cas être accordé à certaines catégories de personnes en charge des opérations du site (administration, ventes, marketing, service juridique, administration du système) ou à des parties externes (telles que les fournisseurs tiers de services techniques, les services de messagerie, les fournisseurs d’hébergement, les entreprises informatiques, les agences de communication) désignées, le cas échéant, comme sous-traitants des Données par le Propriétaire. La liste mise à jour de ces parties peut être demandée à tout moment au Responsable du traitement des données.</p>

  <h3>Lieu de traitement</h3>

  <p>Les Données sont traitées au siège du Responsable des données et en tout autre lieu où les parties responsables du traitement sont situées. Veuillez contacter le Responsable des données pour de plus amples informations.</p>

  <h3>Temps de conservation</h3>

  <p>Les Données seront conservées le temps qu’il sera nécessaire pour fournir le service demandé par l’Utilisateur, ou tel qu’énoncé dans les objectifs décrits dans le présent document. L’Utilisateur peut toujours demander au Responsable des données leur suspension ou leur suppression.</p>

</div> <!-- /one_line_col -->



  <div class="one_line_col">

    <h2>Utilisation des Données collectées</h2>

      <p>
      Les Données relatives à l’Utilisateur sont collectées afin de permettre au Propriétaire de fournir ses services ainsi que pour les objectifs suivants : 
         Autorisations du dispositif pour accéder aux Données personnelles.
      </p>
     

    <p>Les Données personnelles utilisées pour chaque finalité sont décrites dans les parties spécifiques du présent document.</p>


  </div> <!-- /one_line_col -->
 



  <div class="one_line_col">

    <h2>Autorisations du dispositif pour accéder aux Données personnelles</h2>
  		<p>Selon le dispositif particulier de l'Utilisateur, cette Application pourrait demander certaines autorisations pour lui autoriser l'accès aux Données du dispositif de l'Utilisateur comme décrit ci-dessous.</p>
      <p>Par défaut, ces autorisations doivent être accordées par l’Utilisateur avant que les informations respectives soient accessibles. Une fois que l’autorisation a été donnée, elle peut être révoquée par l’Utilisateur à tout moment. Afin de révoquer ces autorisations, les Utilisateurs peuvent consulter les paramètres du dispositif ou contacter le Propriétaire aux coordonnées fournies dans le présent document.<br />La procédure exacte pour contrôler les permissions des applications peut dépendre du dispositif et du logiciel de l’Utilisateur.</p>
      <p>Veuillez noter que la révocation de ces autorisations peut affecter le bon fonctionnement de cette Application.</p>
      <p>Si l’Utilisateur accorde l’une des autorisations répertoriées ci-dessous, ces Données personnelles respectives peuvent être traitées (c’est-à-dire accessibles, modifiées ou supprimées) par cette Application.</p>


        <h3>Autorisation de la localisation approximative (non continue)</h3>
        <p>Utilisée pour accéder à la localisation approximative du dispositif de l’Utilisateur. Cette Application peut collecter, utiliser et partager les Données de localisation de l’Utilisateur aux fins de fournir des services basés sur la localisation.<br/>
La localisation géographique de l’Utilisateur est déterminée de façon non continue. Cela signifie qu’il est impossible pour cette Application d’obtenir la position approximative de l’Utilisateur de façon continue.</p>



        <h3>Autorisation de la localisation précise (non continue)</h3>
        <p>Utilisée pour accéder à la localisation précise du dispositif de l’Utilisateur. Cette Application peut collecter, utiliser et partager les Données de localisation de l’Utilisateur aux fins de fournir des services basés sur la localisation.<br/>
La localisation géographique de l’Utilisateur est déterminée de façon non continue. Cela signifie qu’il est impossible pour cette Application d’obtenir la position exacte de l’Utilisateur de façon continue.</p>



        <h3>Autorisation du téléphone</h3>
        <p>Utilisée pour accéder à une multitude de fonctionnalités typiques liées à la téléphonie. Cela permet, par exemple, l’accès en lecture seule à l’« État du téléphone », ce qui signifie qu’elle autorise l’accès au numéro de téléphone du dispositif, aux actualités du réseau mobile actuel ou au statut des appels en cours.</p>



  </div>




    <div class="one_line_col">

      <h2>Informations détaillées sur le traitement des Données personnelles</h2>
      <p>Les Données personnelles sont collectées pour les raisons suivantes en utilisant plusieurs services : </p>

      <ul class="for_boxes">


           <li>
            <div class="box_primary box_10 expand">
               <h3 class="expand-click w_icon_24 policyicon_purpose_4043707">Autorisations du dispositif pour accéder aux Données personnelles</h3>
               <div class="expand-content">

                   <p>Cette Application nécessite certaines autorisations des Utilisateurs qui lui permettent d’accéder aux Données du dispositif des Utilisateurs, présentées ci-après.</p>


                   <h4>Autorisations du dispositif pour accéder aux Données personnelles (Cette Application)</h4>

                   <p>Cette Application nécessite certaines autorisations des Utilisateurs qui lui permettent d’accéder aux Données du dispositif des Utilisateurs, présentées dans le présent document.</p>



                     <p>
                      Données personnelles collectées :
                       Autorisation de la localisation approximative (non continue), Autorisation de la localisation précise (non continue) et Autorisation du téléphone.
                     </p>



                  

               </div> <!-- /expand-content -->
             </div> <!-- /expand -->
           </li>

         

      </ul>

    </div> <!-- /one_line_col -->

   

 



 

	

<div class="one_line_col">

  <h2>Informations supplémentaires sur le traitement et la collecte des Données</h2>

  <h3>Action en justice</h3>
  <p>
    Les Données personnelles de l’Utilisateur peuvent être utilisées à des fins juridiques par le Responsable des données devant les tribunaux ou à toute étape pouvant conduire à une action en justice résultant d’une utilisation inappropriée de cette Application ou des services connexes.<br />L’Utilisateur est conscient du fait que les autorités publiques peuvent exiger du Responsable des données la divulgation des Données personnelles.
  </p>

  <h3>Informations supplémentaires concernant les Données personnelles de l’Utilisateur</h3>
  <p>
    Outre les informations contenues dans la présente politique de confidentialité, cette Application peut fournir à l’Utilisateur des renseignements complémentaires et des informations contextuelles concernant des services particuliers ou la collecte et le traitement des Données personnelles.
  </p>

  <h3>Journaux système et maintenance</h3>
  <p>
    À des fins d’exploitation et de maintenance, cette Application et tout autre service tiers peuvent collecter des fichiers qui enregistrent les interactions avec cette Application (Journaux système) ou utiliser à cette fin d’autres Données personnelles, telle que l’adresse IP.
  </p>

  <h3>Informations non incluses dans la présente politique</h3>
  <p>
    De plus amples renseignements concernant la collecte ou le traitement des Données personnelles peuvent à tout moment être demandés au Responsable des données. Veuillez consulter les informations de contact au début de ce document.
  </p>

  <h3>Droits de l’Utilisateur</h3>
  <p>
    L’Utilisateur a, à tout moment, le droit de savoir si ses Données personnelles ont été stockées et peut consulter le Responsable des données pour connaître leurs contenus et leur origine, vérifier leur exactitude ou demander à ce qu’elles soient complétées, annulées, mises à jour ou rectifiées. Il peut aussi demander à ce qu’elles soient transformées en un format anonyme ou à ce que toute donnée obtenue en violation de la loi soit bloquée, ou s’opposer à leur traitement pour tout motif légitime que ce soit. Les demandes doivent être transmises au Responsable des données à l’adresse indiquée ci-dessus.
  </p>
	  <p>
	    cette Application ne prend pas en charge les demandes « Interdire le suivi ».<br />Référez-vous à la politique de confidentialité des services tiers pour déterminer s’ils respectent ou non l’option « Interdire le suivi ».
	  </p>

  <h3>Modifications de la présente politique de confidentialité</h3>
  <p>
    Le Responsable des données se réserve le droit de modifier à tout moment la présente politique de confidentialité en en informant l’Utilisateur sur cette page. Il est recommandé de consulter souvent cette page en se référant à la date de la dernière modification indiquée au bas de cette page. Si un Utilisateur s’oppose à une quelconque modification apportée à cette Politique, il doit cesser d’utiliser cette Application et peut demander au Responsable des données de supprimer ses Données personnelles. Sauf mention contraire, la politique de confidentialité alors en vigueur s’applique à toutes les Données personnelles que le Responsable des données détient au sujet de l’Utilisateur.
  </p>

  <h3>Informations sur la présente politique de confidentialité</h3>
  <p>
    Le Responsable des données est responsable de la présente politique de confidentialité, préparée à partir des modules fournis par Iubenda et hébergés sur les serveurs d’Iubenda.
  </p>

</div> <!-- /one_line_col -->

<div class="one_line_col">

  <div class="box_primary box_10 definitions expand">

    <h3 class="expand-click w_icon_24 icon_ribbon">
    	Définitions et références légales
    </h3>

    <div class="expand-content">

      <h4>Données personnelles (ou Données)</h4>
      <p>Toute information concernant une personne physique ou morale, une institution ou une association qui est, ou peut être identifiée, même indirectement, par référence à une autre information, y compris un numéro d’identification personnelle.</p>

      <h4>Données d’utilisation</h4>
      <p>Les informations collectées automatiquement à partir de cette Application (ou de services tiers employés par cette Application), qui peuvent inclure les adresses IP ou les noms de domaines des ordinateurs utilisés par l'Utilisateur qui utilise cette Application, les adresses URI (Uniform Resource Identifier ou identifiant uniforme de ressource), l’heure de la demande, la méthode utilisée pour soumettre la demande au serveur, la taille du fichier reçu en réponse, le code numérique indiquant le statut de la réponse du serveur (résultat favorable, erreur, etc.), le pays d’origine, les caractéristiques du navigateur et du système d’exploitation utilisés par l’Utilisateur, les différents détails relatifs au temps par visite (p. ex. temps passé sur chaque page dans l’Application) et les détails relatifs au chemin suivi dans l’Application avec une référence spéciale à la séquence des pages visitées, et d’autres paramètres concernant le système d’exploitation ou l’environnement informatique de l’Utilisateur.</p>

      <h4>Utilisateur</h4>
      <p>La personne utilisant cette Application, qui doit correspondre à la Personne concernée ou être autorisée par celle-ci, à laquelle les Données personnelles se réfèrent.</p>

      <h4>Personne concernée</h4>
      <p>La personne physique ou morale à laquelle les Données personnelles se réfèrent.</p>

      <h4>Service chargé de la mise en œuvre du traitement des données (ou Responsable du traitement)</h4>
      <p>Personne physique ou morale, administration publique ou toute autre entité, association ou organisation autorisée par le Responsable des données à traiter les Données personnelles en conformité avec la présente politique de confidentialité.</p>

      <h4>Responsable des données (ou Propriétaire)</h4>
      <p>La personne physique ou morale, l’administration publique ou toute autre entité, association ou organisation étant habilitée, même conjointement avec un autre Responsable des données, à prendre des décisions concernant les objectifs et les méthodes de traitement des Données personnelles et les moyens utilisés, y compris les mesures de sécurité concernant l’exploitation et l’utilisation de cette Application. Sauf mention contraire, le Responsable des données est le Propriétaire de cette Application.</p>

      <h4>Cette Application</h4>
      <p>Le matériel informatique ou outil logiciel avec lequel les Données personnelles de l’Utilisateur sont collectées.</p>


      <hr />

      <h4>Informations légales</h4>
      <p>Avis aux Utilisateurs européens : la présente politique de confidentialité a été préparée en exécution des obligations définies à l’article 10 de de la directive européenne n°95/46/CE et en vertu des dispositions de la directive 2002/58/CE, telle que révisée par la directive 2009/136/CE portant sur les cookies.</p>
      <p>Cette politique de confidentialité s’applique exclusivement à cette Application.</p>

    </div> <!-- /expand-content -->

  </div> <!-- /box_primary -->

</div> <!-- /one_line_col -->


           

          <div class="iub_footer">

  <p>
    Derni&egrave;re mise à jour :  7 Septembre 2017
  </p>

	 
		<!--<p>
			<a href="//www.iubenda.com" title="iubenda – Générateur de Politique de Confidentialité">iubenda</a> héberge cette page et collecte
			<a href="//www.iubenda.com/privacy-policy/877900">certaines données à caractère personnel</a> sur les Utilisateurs.
		</p>-->


</div> <!-- /footer -->

<script type="text/javascript">
  function tryFunc(fName,args){
    if(typeof window[fName]==='function'){
      window[fName](args);
    }else{
      if(args){
        /* default behaviour is link */
        if(args.href){
          /* default link is target='_blank' */
          window.open(args.href)
        }
      }
    }
    return false; /* inhibit default behaviour */
  }
</script>


	      </div> <!-- /content -->
	    </div> <!-- /wbars -->


	  </div> <!-- /container base_container -->
	</div> <!-- /wbars_wrapper -->



	
 

  <script type="text/javascript">

    var privacyPolicy = new PrivacyPolicy({
      id:936369,
      noBrand:true
    })

    $(document).ready(function() {

      privacyPolicy.start();

			$(".expand-content").hide();
			$(".expand").addClass("collapsed");
			$(".expand .expand-click").click(function () {
				$(this).parents(".expand").toggleClass("collapsed");
				$(this).parents(".expand").toggleClass("expanded");
				$(this).parents(".expand-item").toggleClass("hover");
				$(this).children('.icon-17').toggleClass("icon-expand");
				$(this).children('.icon-17').toggleClass("icon-collapse");
				$(this).parents('.expand').children('.expand-content').slideToggle("fast");
			});

    });

  </script>

</body>
</html>

