<!doctype html>
<html lang="en-US" data-wf-domain="www.raily.app" data-wf-page="64e30c9fd1d1b88ce6ef39a8" data-wf-site="64aceaf9cb10fc1c8e4efdbc" lang="en" class=" w-mod-js w-mod-ix"><head>
    <style class="vjs-styles-defaults">
    .video-js {
      width: 300px;
      height: 150px;
    }

    .vjs-fluid:not(.vjs-audio-only-mode) {
      padding-top: 56.25%
    }
  </style><style class="vjs-styles-dimensions">
    .vjs_video_1118-dimensions {
      width: 1440px;
      height: 800px;
    }

    .vjs_video_1118-dimensions.vjs-fluid:not(.vjs-audio-only-mode) {
      padding-top: 55.55555555555556%;
    }
  </style><style class="vjs-styles-dimensions">
    .vjs_video_569-dimensions {
      width: 1440px;
      height: 800px;
    }

    .vjs_video_569-dimensions.vjs-fluid:not(.vjs-audio-only-mode) {
      padding-top: 55.55555555555556%;
    }
  </style><style class="vjs-styles-dimensions">
    .xr-video-dimensions {
      width: 1440px;
      height: 800px;
    }

    .xr-video-dimensions.vjs-fluid:not(.vjs-audio-only-mode) {
      padding-top: 55.55555555555556%;
    }
  </style>
  <style>
   .wf-force-outline-none[tabindex="-1"]:focus{outline:none;}
</style>
<meta charset="utf-8">
<title>Raily - Meets on the Move</title>
<link href="{{ asset('css/railybeta.webflow.5fc711443.min.css')}}" rel="stylesheet" type="text/css">


<link rel="stylesheet" href="{{ asset('css/library.css') }}" >

    
    <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
	<link href="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ad5758771455690c6cd002_favicon-32x32.png" rel="shortcut icon" type="image/x-icon">
	<link href="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ad57b8cfe4b6d03ca2342c_111.png" rel="apple-touch-icon">
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=G-K0DRW11MFK"></script><script type="text/javascript">window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('set', 'developer_id.dZGVlNj', true);gtag('config', 'G-K0DRW11MFK');</script><!-- Стили чата -->
<link rel="stylesheet" href="{{ asset('css/embed.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<!-- Стили видео-проигрывателя -->
<link rel="stylesheet" href="{{ asset('css/video-js.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

<script>
       window.rlyApp = window.rlyApp || {};
  window.SenjaCollectorConfig = {
    project: "raily", form: "IESt8p",
    trigger: {"type":"none"}
  };
  window.rlyApp.isMobile = window.innerWidth < 900;
       // Загрузка видеопроигрывателя
 (function () {
   // disable stats requests
   window.HELP_IMPROVE_VIDEOJS = false;
   const script = document.createElement('script');
   const videoPlaylistPlugin = document.createElement('script');
   script.src = 'https://azure.raily.app/files/video.min.js';
   videoPlaylistPlugin.src = "https://cdn.jsdelivr.net/npm/videojs-playlist@5.1.0/dist/videojs-playlist.min.js";
   
   const videoScriptLoader = new Promise((done, reject) => {
      script.addEventListener('load', done);
   });
   const videoPluginLoader = new Promise((done, reject) => {
       videoPlaylistPlugin.addEventListener('load', done);
   });
   
   script.async = true;
   videoPlaylistPlugin.async = true;
   setTimeout(() => {
     document.head.appendChild(script);
     videoScriptLoader.then(() => {
      document.head.appendChild(videoPlaylistPlugin);
     });
   }, 4000);     
   
   Promise.all([videoScriptLoader, videoPluginLoader]).then(() => {
        document.dispatchEvent(new CustomEvent('videojs-loaded'));
        window.rlyApp.videoJsReady = true;
  });
   
 })(window);
 // Загрузка виджета формы
 (function () {
   const script = document.createElement('script');
   const queryStringForWidjet = document.createElement('script');
   script.src = 'https://getlaunchlist.com/js/widget.js';
   queryStringForWidjet.src = "https://getlaunchlist.com/js/widget-diy.js";
   script.async = true;
   queryStringForWidjet.async = true;
   setTimeout(() => {
     document.head.appendChild(script);
     document.head.appendChild(queryStringForWidjet);
   }, 4000)
 })(window);
 
 const removeDisabledWidjetBlock = (block) => {
         if(window.rlyApp.isMobile && !block.classList.contains('is-show-mobile')) {
      delete block.dataset.dataId;
      block.classList.remove('senja-embed');
    }
    if(!window.rlyApp.isMobile && !block.classList.contains('is-show-desktop')) {
        delete block.dataset.dataId;
      block.classList.remove('senja-embed');
    }
 };
 
 document.addEventListener("DOMContentLoaded", function() {
   // Загрузка формы опроса и обратной связи по клику
    $('#early-access-button').click( () => {
        gtag('event', 'early_access');
        const $form = $('#early-access-form');
        if($form.attr('src')) {
            return;
        }
        const src = $form.data('src');
        // Насильная перерисовка нужна чтобы обойти баг в
        $form
        .attr('src', src)
        .css('display', 'none')
        .css('display', 'inline');
    });
    $('#ask-raily-button').click(() => {
        gtag('event', 'ask_rally');
        const $script = $('#ask-raily-script');
        const src = $script.data('src');
        $script.attr('src', src);
    });

    // события аналитики для навигации
    $('#nav-wrapper a').click((event) => {
        const button = event.currentTarget;
        gtag('event', 'navigation', {
            value: button.innerText
        });
    });
    
    // Запоминаем страницу перед переходом в попап
    $('[data-popup-initiator]').click((event) => {
      const button = event.currentTarget;
      const popupContext = button.dataset.popupInitiator;
      sessionStorage.setItem('popupInitiator', popupContext);
    });
    
    $.get('https://get.geojs.io/v1/ip/country.json', (resp) => {
              const country = resp.country.toLowerCase();
      $('body').addClass(`country-${country}`);
    });
    
  });
 
</script>

<style>
/* AUDIO PLAYER */
audio[data-name] {
  pointer-events: none;
  opacity: 0;
  visibility: hidden;
  overflow: hidden;
  position: absolute;
  width: 0px;
  height: 0px;
}

/* SVG Bubbles */
.svg-bubbles-animation {
  max-width: 100%;
max-height: 100%;
width: 100%;
height: 100%;
}

/* Footer contacts */
.country-pt .footer-contacts > div:not(.footer-contacts--is-portuguese),
.country-de .footer-contacts > div:not(.footer-contacts--is-germany) {
  display: none;
}

/* VIDEO PLAYER */
@media (min-width: 901px) {
[data-vjs-player][data-player-id="TickerPlayerMobile"] {
      display: none;
  }
}
@media (max-width: 900px) {
  [data-vjs-player].vjs-raily:not([data-is-mobile]) {
      display: none;
  }
}
[data-vjs-player][data-is-no-fluid] {
width: 100%;
height: 100%;
background-size: cover;
}
[data-vjs-player][data-is-mobile] {
max-width: 100%;
max-height: 100%;
}
.video-js {
  background: transparent;
}
.box-text-xr1 {
  pointer-events: none;
}
.vjs-raily .vjs-control-bar {
background-color: transparent; 
width: calc(100% - 2.5rem);
margin: auto;
bottom: 1.5rem;
}
.vjs-raily .vjs-play-progress {
background-color: #A7F9C3;
}
.vjs-raily .vjs-load-progress {
background-color: rgba(255,0,0,0.1);
}
.vjs-raily .vjs-slider {
background-color: #fff;
}
.vjs-raily .vjs-load-progress div {
background-color: rgba(0,0,0,0.5);
}
.vjs-raily .vjs-big-play-button {
background-color: transparent !important;
border: none;
}
.vjs-raily .vjs-icon-play:before, 
.vjs-raily .vjs-play-control .vjs-icon-placeholder:before, 
.vjs-raily .vjs-big-play-button .vjs-icon-placeholder:before {
background-color: transparent !important;
border-radius: 10px;
transform: scale(2,2);
}

.vjs-raily.vjs-playing .vjs-big-play-button .vjs-icon-placeholder:before {
content: "\f103";
display: block;
}
.vjs-raily .vjs-big-play-button {
transition: all 0.5s ease-in-out !important;  
}
.vjs-raily .vjs-big-play-button:hover {
color: #A7F9C3;
}
.vjs-raily.vjs-playing.vjs-user-active .vjs-big-play-button {
opacity: 1;
}
.vjs-raily.vjs-playing.vjs-user-inactive .vjs-big-play-button {
opacity: 0;
}

.vjs-raily .vjs-time-control {
    font-size: 1.25em;
  line-height: 2.65em;
}
.vjs-raily.vjs-has-started .vjs-big-play-button,
.vjs-raily.vjs-playing .vjs-big-play-button,
.vjs-raily .vjs-duration {
display: block;
}
[data-player-id="TickerPlayerMobile"] .vjs-big-play-button,
.vjs-raily.vjs-controls-disabled .vjs-big-play-button {
  display: none;
}
.embet-video-ticket.embet-video-ticket-mobile {
  margin-top: -1.75em;
}
video,
[class="embet-video-*"] {
  outline: none !important;
}

/* FORMS */

:-internal-autofill-previewed {
  font-size: 1.8em !important;
}
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
-webkit-text-fill-color: #eee;
-webkit-box-shadow: inherit;
transition: background-color 5000s ease-in-out 0s;
font-size: inherit;
color: inherit !important;
line-height: inherit;
height: inherit;
padding-left: 2em;
}

input:-webkit-autofill::first-line {
font-size: 1.8em !important;
font-weight: normal
}

@media only screen and (max-width: 500px) {
  :-internal-autofill-previewed,
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    font-size: 1.6em !important;
}
input:-webkit-autofill::first-line {
  font-size: 1.6em !important;
  font-weight: normal
  }
.vjs-raily .vjs-control-bar {
  width: calc(100% - 12px);
  bottom: 0.75em;
  padding-left: 0px;
  padding-right: 4px;
}
.video-js .vjs-time-control {
    padding-left: 0.2em;
  padding-right: 0.2em;
}
.video-js .vjs-control {
    width: 3em;
}
.video-js .vjs-progress-control .vjs-progress-holder {
    margin: 0 8px; 
}

}

/* UTILS */
@media (max-width: 500px) {
.is-show-desktop {
      display: none;
}
}

@media (min-width: 501px) {
.is-show-mobile {
      display: none;
}
}
.no-pointer-events {
pointer-events: none;
}
.transform-ready {
will-change: transform;
}

/* SENJA */
.senja-embed :is(.rounded-full) {
      border-color: rgba(240,240,240,0.3) !important;
}
@media (min-width: 769px) {
.rly-app-senja .sj-avatar-container img {
  width: 4.5em !important;
  height: 4.5em !important;
}
}
#collector-container :is(.h-full) {
  display: flex;
align-items: center;
justify-content: center;
flex: 1 1 auto;
max-height: 100%;
}
</style>

<!-- свайпер -->
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css')}}">
<script src="{{ asset('css/video.min.js')}}" async=""></script>
<script src="https://getlaunchlist.com/js/widget.js" async=""></script>
<script src="https://getlaunchlist.com/js/widget-diy.js" async=""></script>
<style type="text/css">
@font-face {
font-weight: 400;
font-style:  normal;
font-family: circular;

src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Book.woff2') format('woff2');
}

@font-face {
font-weight: 700;
font-style:  normal;
font-family: circular;

src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Bold.woff2') format('woff2');
}</style>
<script src="https://static.senja.io/dist/platform.js" async=""></script>
<script src="https://widget.senja.io/js/collector.js" async=""></script>
<script src="https://cdn.jsdelivr.net/npm/videojs-playlist@5.1.0/dist/videojs-playlist.min.js" async=""></script>

</head>
<body class="body country-ng">
<iframe allow="join-ad-interest-group" data-tagging-id="G-K0DRW11MFK" data-load-time="1717794748037" height="0" width="0" src="https://td.doubleclick.net/td/ga/rul?tid=G-K0DRW11MFK&amp;gacid=1854463201.1717794748&amp;gtm=45je4650v9137457046za200&amp;dma=0&amp;gcd=13l3l3l3l1&amp;npa=0&amp;pscdl=noapi&amp;aip=1&amp;fledge=1&amp;frm=0&amp;z=2035338179" style="display: none; visibility: hidden;"></iframe>
<div class="page-wrapper">
   <div data-animation="default" class="navbar w-nav" data-easing2="ease" data-easing="ease" data-collapse="medium" data-w-id="00dfbd8a-10b2-f50b-769d-e57d76eb66ed" role="banner" data-duration="400" id="w-node-_00dfbd8a-10b2-f50b-769d-e57d76eb66ed-e6ef39a8" style="background-color: rgba(0, 0, 0, 0);">
	
	<nav id="w-node-d215a018-b744-ad0a-7a5f-733e90fb71cd-e6ef39a8" class="naw-container">
		<a href="#Home" class="brand w-nav-brand w--current">
			<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efdc7_Frame%201948757362.svg" loading="eager" alt="Logo" class="image-logo">
		</a>
			<nav role="navigation" id="nav-wrapper" class="nav-menu w-nav-menu">
				<div class="box-menu">
					<a href="#meetups" class="nav-link dtsctop w-nav-link">Meetups</a>
					<a href="#" class="nav-link non-desctop w-nav-link">Date</a>
					<a href="#" class="nav-link dtsctop non w-nav-link">AR</a>
					<a href="#Ai" class="nav-link w-nav-link">AI</a>
					<a href="#Gamification" class="nav-link w-nav-link">Gamification</a>
					<a href="#Rewards" class="nav-link w-nav-link">Rewards</a>
					<a href="#web-3" class="nav-link w-nav-link">Web 3</a>
					<a href="#" class="nav-link non-desctop non w-nav-link">AR</a>
					<a href="#xr" class="nav-link dtsctop non w-nav-link">XR</a>
					<a href="#" class="nav-link non-desctop non w-nav-link">XR</a>
					<a href="#concierge" class="nav-link w-nav-link">Concierge</a>
					<a href="#charity" class="nav-link w-nav-link">Charity</a>
					<a href="#all-features" class="nav-link w-nav-link">All Features</a>
				    </div></nav>

					<div class="menu-button w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
						<div class="box-burger">
							<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64cce1822d31503d831c2cfb_Group%201948757647%20(1).svg" loading="lazy" alt="" class="image-73">
						</div></div>
					<div class="div-block-320">
					  <div>
					     <a data-popup-initiator="home" href="/press" class="link-contact-naw w-inline-block">
							<div>Contact us</div></a>
						</div>
					</div>
				</nav>				
            <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
		</div>

<main class="main-wrapper">
		<section id="Home" data-w-id="55cfadf7-0a41-17ba-4c48-856c093a6722" class="section-home-header">
			<div class="box-h1">
				<h1 class="h1">MEETS ON THE MOVE</h1>
				<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631d86a95ad5d2eb221b3f0_Group%201948758760%20(2).webp" alt="" class="im-h1 ps" style="transform: translate3d(0px, 0em, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;">
				<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6638783548557141c4d3b698_Frame%201948759872.webp" alt="" class="im-h1 mob" style="transform: translate3d(0px, 0em, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;">
			</div>
			<div class="container pl-no-pading">
				<div class="box-m-d-55">
					<div class="text-32 central mob-non" style="transform: translate3d(0px, 0em, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;">AI-Driven + Gamify</div></div>
					<div class="wrapper-hiro-phon">
						<div class="block-phone-hiro">
							<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631db853a4d4ddd2899de73_Group%201948758758%20(1).webp" alt="" style="transform: translate3d(0px, 0em, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d; opacity: 1;" data-w-id="1a96d08e-5873-b9f1-f1f5-68ea1f0a45b4" class="im-hiro-phon">
							<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631dbfb1e4bcda548dc3722_Group%201948758757.webp" alt="" style="opacity: 1; transform: translate3d(0px, 0em, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;" data-w-id="8c49d045-780c-7c01-c5ef-03214d6ab319" class="im-hiro-phon">
							<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631def06d2da1138a4982b7_Group%201948758759.webp" alt="" style="opacity: 1; transform: translate3d(0px, 0em, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;" data-w-id="6b483e82-083c-0d98-733b-42797312bdf5" class="im-hiro-phon"></div></div>
							<div class="wrapper-form-hiro">
								<div class="box-h-form">
									<div class="form-block-3 w-form">
										<form id="email-form" name="email-form" data-name="Email Form" action="https://getlaunchlist.com/s/S9IPAB" method="post" class="form-3" data-wf-page-id="64e30c9fd1d1b88ce6ef39a8" data-wf-element-id="57ee8a38-81c6-86e4-9cb0-f3685c2bcb80" aria-label="Email Form">
											<input class="text-field-3 w-input" maxlength="256" name="email" data-name="email" placeholder="Enter your email" type="email" id="email-16" required="">
											<input type="submit" data-wait="Please wait..." class="form-button-3 w-button" value="Ask for Early Access"></form>
											<div class="w-form-done" tabindex="-1" role="region" aria-label="Email Form success">
											<div>Thank you! Your submission has been received!</div>
										</div>
										<div class="w-form-fail" tabindex="-1" role="region" aria-label="Email Form failure">
											<div>Oops! Something went wrong while submitting the form.</div>
										</div></div></div></div>
											<div class="wrapper-planet">
												<div style="opacity: 1;" class="block-planet">
													<div class="box-im-planet">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663a44549271ce0bcea7cf9f_1%20(1).webp" alt="" class="im-planet _1" style="will-change: opacity; opacity: 1;">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663a4470c0ab6b7dc709769a_2%20(1).webp" alt="" class="im-planet _2" style="will-change: opacity; opacity: 0;">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663a447f9ff7b3840f804025_3%20(1).webp" alt="" class="im-planet _3" style="will-change: opacity; opacity: 0;">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663a447a4ab4bb2e92ff303c_4%20(1).webp" alt="" class="im-planet _4" style="will-change: opacity; opacity: 0;">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663b25271c164df3680a75f2_5%20(1).webp" alt="" class="im-planet _5" style="will-change: opacity; opacity: 0;">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663a4492795361db873309b1_6%20(1).webp" alt="" class="im-planet _6" style="will-change: opacity; opacity: 0;">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663a44df99dfda807f1f0022_7.webp" alt="" class="im-planet _7" style="will-change: opacity; opacity: 0;">
														<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/663a44d8713affb37a7d02e4_8.webp" alt="" class="im-planet _8" style="will-change: opacity; opacity: 0;"></div>
														<div class="wraapper-h2" style="will-change: width, height; width: 0vw;">
															<div class="box-h2"><h2 class="h2-hiro">TRAVEL. CONNECT. </h2></div>
															<div class="box-h2"><h2 class="h2-hiro">EXPLORE.</h2></div></div>
															<div class="box-logo-hiro">
																<div class="text-16 pl-s-14">Trusted by <br>industry <br>leaders</div>
																<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631eab0d8356cb70198ba08_Frame%201948757889.svg" loading="lazy" alt="" class="im-logo-compani">
																<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631ea6747fe3bf053110162_Frame%201948757893.svg" loading="lazy" alt="" class="im-logo-compani">
																<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631ea68e78668b308f8c4d1_Frame%201948757890.svg" loading="lazy" alt="" class="im-logo-compani">
																<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631ead47bdbb31c3c6abe38_Google_for_Startups_logo%203.svg" loading="lazy" alt="" class="im-logo-compani">
																<div class="div-block-303">
																	<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631ec218159be68f27588cb_Union.webp" loading="lazy" alt="" class="im-logo-compani smol">
																	<div class="text-11">RocketFuel Semi-<br>Finalist 2024</div></div>
																	<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66348561a7732b4667e316b3_ws_beta2024_raily%201.webp" loading="lazy" alt="" class="im-logo-compani"></div></div></div>
																	<div class="wrapper-lovedloved non">
																		<div class="div-block-239 div-block-240 div-block-241 div-block-242 box-loved">
																			<h2 class="heading-5">Loved by</h2>
																			<div class="blok-star">
																				<a href="https://wall.raily.app/" target="_blank" class="w-inline-block">
																					<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64e8dd4adb50321dff161eb2_Group%201948757768.svg" loading="lazy" alt="" class="image-star"></a>
																					<div class="text-20 w500 planset-14">5.0</div></div>
																					<a data-show-review-button="" href="#" class="btn-reviews visibol w-inline-block"><div class="text-16 planset-14 w300 mob-1-2">Spill Your Thoughts</div></a></div>
																					<div class="div-block-244">
																						<div class="html-embed-13 rly-app-senja w-embed">
																							<div class="senja-embed is-show-desktop rly-app-senja" data-id="f9f143c4-042f-4251-a0a2-e613a4f5c2e1" data-lazyload="false">
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</section>

																			<section id="meetups" data-w-id="8ceb9fc6-7084-b683-5a7d-4ab2e8272d67" class="section-meet-raily">
																				<div class="container">
																					<div data-w-id="aba9a469-e014-f68d-0f11-90b7174c9a27" class="box-text-audio-meet" style="">
																						<h2 class="h3 central ps">Meet Raily where you can</h2>
																						<h2 class="h3 central mob">With Raily you can</h2>
																						<div class="block-btn-audio-with">
																							<a data-player-control="" href="#" class="btn-play w-inline-block">
																								<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64c133be39629431f9894b8c_%D0%97%D0%B2%D1%83%D0%BA%D0%98%D0%BA%D0%BE%D0%BD%D0%BA%D0%B0.svg" loading="lazy" alt="" class="image-play-animacia">
																								<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64c0c69c3cd3a8d0d1100648_Group%201948757684.svg" loading="lazy" alt="" class="image-play"></a>
																								<div class="html-embed-5 w-embed">
																									<audio controls="" preload="none" data-name="Meet Raily">
																										<source src="https://azure.raily.app/voices/Meet_Raily.mp3" type="audio/mpeg">
																										</audio>
																									</div>
																								</div>
																							</div>
																							<div class="w-layout-grid wrapper-meet">
																								<div id="w-node-cd9d25c8-3306-5886-feb2-e15afec3a7cb-e6ef39a8" class="block-cart-meet">
																									<div class="box-im-fon">
																										<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6631fe3f0bf3a22cc527941b_Frame%201948759809%20(2).webp" loading="lazy" alt="" class="im-bg-slide">
																									</div>
																										<div id="w-node-_73efce49-0e08-e800-c908-a88c49399e9e-e6ef39a8" class="wrapper-cart-meet">
																											<div id="w-node-c4cd6c7f-a25f-91db-3f81-e7b942b2d46d-e6ef39a8" class="block-text-meet pl">
																												<div class="text-40-mit">Connect</div>
																												<div class="text-20-col-w50">Meet interesting people anywhere with our AI matchmaker.</div></div>
																												<div data-w-id="1d764b4a-4cff-a390-c0cf-d2cbaaa73cb5" class="cart-bg-meet" style="">
																													<div class="bg-black-meet-phone"></div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6634d3b2b4e6d4578fe4fdad_Group%201948758837.webp" loading="lazy" data-w-id="061330ac-a08d-4b26-72b6-7b07478b831f" alt="" class="image-meet" style="">
																													<div data-w-id="a12fb146-e539-261e-8a3a-e5bd734906f4" class="zatemenie" style="">
																													</div>
																												</div>
																											</div>
																													<div id="w-node-_8b048d84-1f4e-8c5a-e433-fdebaaaeeee1-e6ef39a8" class="wrapper-cart-meet">
																														<div id="w-node-_2fcb7b46-76f2-3940-477c-e2bee9b698a6-e6ef39a8" class="block-text-meet pl">
																															<div class="text-40-mit">Discover</div>
																															<div class="text-20-col-w50">See who's at your destination or&nbsp;nearby that shares your interests.</div></div>
																															<div data-w-id="8b048d84-1f4e-8c5a-e433-fdebaaaeeee7" class="cart-bg-meet-2" style="">
																																<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6638df67702c3e7be4535247_Group%201948758760%20(3).webp" loading="lazy" data-w-id="8b048d84-1f4e-8c5a-e433-fdebaaaeeee8" alt="" class="image-meet-2" style="">
																																<div style="background-color: rgba(0, 0, 0, 0.08);" class="zatemenie"></div>
																															</div></div>
																															<div id="w-node-_7ef26704-5a71-ada6-7a23-ad3c305ef0df-e6ef39a8" class="wrapper-cart-meet">
																																<div id="w-node-f8551021-3d25-b5e7-f430-77ca0fdb17bd-e6ef39a8" class="block-text-meet pl">
																																	<div class="text-40-mit">Bond</div>
																																	<div class="text-20-col-w50">Moving or relaxing, our AI magically finds your connections.</div></div>
																																	<div data-w-id="7ef26704-5a71-ada6-7a23-ad3c305ef0e5" class="cart-bg-meet-3" style="">
																																		<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320919e3516775b88c36de_Group%201948758757%20(1).webp" loading="lazy" data-w-id="7ef26704-5a71-ada6-7a23-ad3c305ef0e6" alt="" class="image-meet-3" style="">
																																		<div data-w-id="8b4fbad0-5b3b-8df2-15e5-437ff6b6f833" class="zatemenie" style=""></div></div></div>
																																		<div id="w-node-ebcc0491-18ae-4fb2-581e-d9dbc3dda22c-e6ef39a8" class="wrapper-cart-meet">
																																			<div id="w-node-_5385c4c3-84a4-730c-41db-e39a36b54973-e6ef39a8" class="block-text-meet block-cart-meet pl">
																																				<div class="text-40-mit">Explore</div>
																																				<div class="text-20-col-w50">Journey together to new places and&nbsp;experiences with Raily AI concierge.</div></div>
																																				<div data-w-id="ebcc0491-18ae-4fb2-581e-d9dbc3dda232" class="cart-bg-meet-4" style="">
																																				<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6632091d1380259f50c99cdb_Group%201948758712.webp" loading="lazy" data-w-id="ebcc0491-18ae-4fb2-581e-d9dbc3dda233" alt="" class="image-meet-4" style="">
																																				<div data-w-id="9414723c-acc3-6374-63d7-f47133ea0dd4" class="zatemenie" style=""></div></div></div></div>
																																				<div class="block-slid-bar">
																																					<div class="wrapper-slid-bar">
																																						<img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efdef_Group%201948757466.svg" loading="lazy" alt="" class="image-16">
																																						<div class="line"></div><div class="line"></div>
																																						<div class="circul _1">
																																							<div class="line-circul"></div>
																																							<div class="div-block-128">
																																								</div>
																																							</div>
																																							<div class="circul _2">
																																								<div class="line-circul">
																																									</div>
																																								</div>
																																								<div class="circul _3">
																																									<div class="line-circul">
																																										</div>
																																									</div>
																																									<div class="circul _4">
																																										<div class="line-circul">
																																											</div>
																																											<div class="div-block-128-copy">
																																												</div>
																																											</div>
																																										</div>
																																									</div>
																																								</div>
																																								<div class="w-layout-grid wrapper-meet-2">
																																									<div class="block-cart-meet mar178">
																																										<div id="w-node-d94f97af-5b52-8fb0-d64a-e9a4e21e26a3-e6ef39a8" class="block-text-meet">
																																											<div class="text-40-mit">Connect</div>
																																											<div class="text-20-col-w50">Meet interesting people anywhere with our AI matchmaker.</div>
																																										</div>
																																										<div id="w-node-_99ff7805-2041-c481-8aa2-fdaeca30ede6-e6ef39a8" class="block-text-meet">
																																											<div class="text-40-mit">Discover</div>
																																											<div class="text-20-col-w50">See who's at your destination or&nbsp;nearby that shares your interests.</div>
																																										</div>
																																										<div id="w-node-_14650177-afdb-d0e4-4da5-898955112310-e6ef39a8" class="block-text-meet">
																																											<div class="text-40-mit">Bond</div>
																																											<div class="text-20-col-w50">Moving or relaxing, our AI magically finds your connections.</div>
																																										</div>
																																										<div id="w-node-ccc445a2-e32b-5e0a-9858-59ff1d3205d3-e6ef39a8" class="block-text-meet block-cart-meet"><div class="text-40-mit">Explore</div><div class="text-20-col-w50">Journey together to new places and&nbsp;experiences with Raily AI concierge.</div></div></div></div><div class="box-embet-meet"><div class="box-h-form"><div class="form-block-3 w-form"><form id="email-form" name="email-form" data-name="Email Form" action="https://getlaunchlist.com/s/S9IPAB" method="post" class="form-3" data-wf-page-id="64e30c9fd1d1b88ce6ef39a8" data-wf-element-id="03616a81-5bce-bd57-5f0e-eb109197945b" aria-label="Email Form"><input class="text-field-3 w-input" maxlength="256" name="email" data-name="email" placeholder="Enter your email" type="email" id="email-11" required=""><input type="submit" data-wait="Please wait..." class="form-button-3 w-button" value="Ask for Early Access"></form><div class="w-form-done" tabindex="-1" role="region" aria-label="Email Form success"><div>Thank you! Your submission has been received!</div></div><div class="w-form-fail" tabindex="-1" role="region" aria-label="Email Form failure"><div>Oops! Something went wrong while submitting the form.</div></div></div></div></div></div></section><section class="section-ecosystem"><div class="container-0"><div class="box-text-audio-meet"><h2 class="h3 central">Raily ecosystem</h2><div class="block-btn-audio-raily"><a data-player-control="" href="#" class="btn-play w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64c133be39629431f9894b8c_%D0%97%D0%B2%D1%83%D0%BA%D0%98%D0%BA%D0%BE%D0%BD%D0%BA%D0%B0.svg" loading="lazy" alt="" class="image-play-animacia"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64c0c69c3cd3a8d0d1100648_Group%201948757684.svg" loading="lazy" alt="" class="image-play"></a><div class="html-embed-5 w-embed"><audio controls="" preload="none" data-name="Meet Raily">
  <source src="https://azure.raily.app/voices/Meet_Raily.mp3" type="audio/mpeg">
</audio></div></div></div><div class="wrapper-ecosystem"><div class="div-block-328"><div class="box-imag-orbita"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6639c7160d5ea969bc5d5857_%D1%8D%D0%BB%D0%BB%D0%B8%D0%BF%D1%81%D1%8B.svg" loading="lazy" alt="" class="im-orbita ps"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6639cb5fb22452d9e8bf6891_%D1%8D%D0%BB%D0%BB%D0%B8%D0%BF%D1%81%D1%8B.svg" loading="lazy" alt="" class="im-orbita mob"></div></div><div class="block-mach"><div class="teg-mach"><div class="text-24 pl-18 mob-14">Matchmaking</div></div><div class="box-logo-mach"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320bcf516544ad2f76431b_Group%201948757823.svg" loading="lazy" alt="" class="icon-mach"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320bbd04137d13051111e1_Group%201948758717.webp" loading="lazy" alt="" class="im-ligo-mach"><div class="text-24">AI Raily</div></div><div class="teg-mach _9a5bff"><div class="text-24 pl-18 mob-14">Concierge</div></div></div><div class="block-mach-absolut"><div class="teg-mach-ar pl-absolut"><div class="text-29">AR</div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320bec42874fc2c379d8f1_Group%201948758571.svg" loading="lazy" alt="" class="icon-teg"></div><div class="box-im-mach"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320b3bdbdcfd73b6efc8dd_Group%201948758718%20(1).webp" loading="lazy" alt="" class="in-mach"></div></div><div class="block-mach-2"><div class="box-im-mach-2"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320b66a3f96d85f32c61f0_Group%201948758576%20(1).webp" loading="lazy" alt="" class="in-mach-2"></div><div class="teg-mach-smart"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320c0cdbdcfd73b6f0b608_Group%201948758575%20(1).svg" loading="lazy" alt="" class="icon-teg"><div class="text-29">Smartwatches</div></div></div><div class="div-block-326"><div class="div-block-327"><div class="block-mach-3"><div class="teg-mach-smart app"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320c0a46af4dde082831f6_Group%201948758575.svg" loading="lazy" alt="" class="icon-teg"><div class="text-29">Mobile App</div></div><div class="box-im-mach-3"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320b93a3f96d85f32c7886_Group%201948758719.webp" loading="lazy" alt="" class="in-mach-3"></div></div></div></div><div class="div-block-324"><div class="div-block-325"><div class="block-mach-4"><div class="teg-mach-xr"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320c05ac2b58c3877b7aec_Group%201948758574.svg" loading="lazy" alt="" class="icon-teg ochki"><div class="text-29">XR</div></div><div class="box-im-mach-3"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66320b9a11ed170344e75fdb_Frame%201948759401.webp" loading="lazy" alt="" class="i-4n-mach"></div></div></div></div></div></div></section>



















</main>


<footer id="footer" class="sectio-footer">
    <div class="box-embet-footer">
        <div class="box-h-form">
            <div id="email-form-4" class="form-block-3 w-form">
                <form id="wf-form-Email-Form-4" name="wf-form-Email-Form-4" data-name="Email Form 4" action="https://getlaunchlist.com/s/S9IPAB" method="post" class="form-3" data-wf-page-id="64e30c9fd1d1b88ce6ef39a8" data-wf-element-id="d0839ec0-8d24-f8ca-7fba-b63d2e4b2e94" aria-label="Email Form 4">
                    <input class="text-field-3 w-input" maxlength="256" name="email" data-name="email" placeholder="Enter your email" type="email" id="email-6" required="">
                    <input type="submit" data-wait="Please wait..." class="form-button-3 w-button" value="Ask for Early Access">
                </form>
                <div class="w-form-done" tabindex="-1" role="region" aria-label="Email Form 4 success">
                    <div>Thank you! Your submission has been received!</div></div>
                    <div class="w-form-fail" tabindex="-1" role="region" aria-label="Email Form 4 failure"><div>Oops! Something went wrong while submitting the form.</div></div></div></div></div>
                    <div class="carusel_wrapper"><div style="transform: translate3d(-32.904%, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d; will-change: transform;" class="carusel-blokc"><div class="text-190">Ask for Early Access * Ask for Early Access*</div></div><div class="carusel-blokc margen0" style="transform: translate3d(-32.904%, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d; will-change: transform;"><div class="text-190">Ask for Early Access * Ask for Early Access*</div></div></div><div class="container footer"><div class="w-layout-grid grid-footer"><div id="w-node-c351c25d-6807-2fa4-4c8b-cb934f9cc1b6-e6ef39a8" class="wrapper-linck-footer"><div class="text-18">Company</div></div><div id="w-node-_07a2ad38-c9c2-698d-e3a5-1f34171ce2b3-e6ef39a8" class="box-link-footer-2"><div class="text-18">Help Center</div></div><div id="w-node-_85bc50ee-0bf6-bfd3-5dc6-6e90b5ba939c-e6ef39a8" class="box-link-footer-3"><div class="text-18">Legal</div></div><a id="w-node-_897cf1f4-0bb0-edec-1433-a9575bb271c1-e6ef39a8" href="#" class="link-social pozition-left w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efdf0_raily%20logo%20small.svg" loading="lazy" alt="" class="image-socila-mono logo" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efdcf_utp.svg" loading="lazy" id="w-node-_22897fde-7e3e-fd27-5863-7bd1a5161a20-e6ef39a8" alt="" class="image-socila-color logo" style="opacity: 0;"></a><div id="w-node-db246425-d9f8-d9be-8e97-4aa73ae7b680-e6ef39a8" class="block-reviews-footer"><div id="w-node-_17b73272-7d48-1739-2a21-c50f918a3dae-e6ef39a8" class="box-link-footer"><a href="/mission" class="linck-footer">Mission</a><a data-popup-initiator="footer" href="/press" class="linck-footer hiden">Press</a><div class="blok-podcasts"><a href="#" class="linck-footer">Podcasts</a><div class="box-social"><a href="https://rb.gy/u4zfs" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe3f_Podcast%20icons.svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe42_Podcast%20icons%20(3).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a><a href="https://rb.gy/mh90p" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe40_Podcast%20icons%20(1).svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe43_Podcast%20icons%20(4).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a><a href="https://rb.gy/bz92u" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe41_Podcast%20icons%20(2).svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe44_Podcast%20icons%20(5).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a><a href="https://rb.gy/bz92u" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64e0f364ae37c018183a88d3_US-EN_ListenOn_AmazonMusic_Button_SQUARE_Charcoal_RGB.svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64e0f37914f492b3dfec5560_US-EN_ListenOn_AmazonMusic_Button_SQUARE_Charcoal_RGB%20(1).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a></div></div></div></div><div id="w-node-_658cb10a-c485-b200-2fab-8ccdcdd58685-e6ef39a8" class="box-link-footer-2"><a href="/safety-tips" class="linck-footer">Trust &amp; Safety</a><a href="/cookie-policy" class="linck-footer">Cookies Policy</a><a href="/raily-community-guidelines" class="linck-footer _110">Guidlines</a></div><div id="w-node-_4f8d0614-d152-fcd4-2979-232089903ae1-e6ef39a8" class="box-link-footer-3"><a href="https://raily.canny.io/bug-reports" target="_blank" class="linck-footer">Support</a><a href="https://raily.canny.io/features" target="_blank" class="linck-footer">Features</a><a href="mailto:raily@raily.app ?subject=Hi" class="linck-footer">Contact</a><a href="/privacy-policy" class="linck-footer">Privacy</a><a href="/terms-and-conditions-of-use" class="linck-footer">Terms</a></div><address id="w-node-_698aba40-d7b5-1293-2982-eb2a5d469670-e6ef39a8"><div class="box-social no-margen pozition-left"><a href="https://raily.medium.com" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbb80634a1b4e1a6fdc1b_Frame%201948757844%20(1).svg" loading="lazy" alt="" class="image-socila-color w33" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbb72e04994ad31c0bd50_Frame%201948757844.svg" loading="lazy" alt="" class="image-socila-mono w33" style="opacity: 1;"></a><a href="https://www.linkedin.com/company/railyapp" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbbfff114f531d14f2205_Frame%201948757544%20(1).svg" loading="lazy" alt="" class="image-socila-color w30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbbf0634a1b4e1a7066e5_Frame%201948757544.svg" loading="lazy" alt="" class="image-socila-mono w30" style="opacity: 1;"></a><a href="https://raily.quora.com" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbc4974c80ca086dd9b5f_Component%2011%20(3).svg" loading="lazy" alt="" class="image-socila-color w30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbc3674c80ca086dd76c0_Component%2011%20(2).svg" loading="lazy" alt="" class="image-socila-mono w30" style="opacity: 1;"></a><a href="http://facebook.com/raily" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbcc2e4c1cd47c0bb49e8_Facebook%20icon%20(1).svg" loading="lazy" alt="" class="image-socila-color w29-30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbc69b83c59b66cd1bb09_Facebook%20icon.svg" loading="lazy" alt="" class="image-socila-mono w29-30" style="opacity: 1;"></a><a href="http://twitter.com/raily" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbd0089aeb93f160a1132_Twitter%20icon%20(1).svg" loading="lazy" alt="" class="image-socila-color w1-9" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbce4320e53e4e2dcf042_Twitter%20icon.svg" loading="lazy" alt="" class="image-socila-mono w19" style="opacity: 1;"></a></div></address><div id="w-node-_20babc5d-68ac-b155-de53-5b093d20085c-e6ef39a8" class="line-foote"></div><div id="w-node-bcaf743e-6f1e-193a-1750-1df48a4a4cb4-e6ef39a8" class="blok-logo-text"><div class="box-text-footer1"><div class="div-block-140"><div class="box-social no-margen"><a href="#Home" class="link-social w-inline-block w--current"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64cb67a4d4f6301b862bfec7_Raily%20sign%20small%20(1).svg" loading="lazy" alt="" class="image-socila-color w30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64cb6773a1ba8a68d77247e3_Raily%20sign%20small.svg" loading="lazy" alt="" class="image-socila-mono w30" style="opacity: 1;"></a></div><div class="div-block-317"><div class="text-14">Raily® - Meets on the move<br>The ultimate AI-driven social travel hub. Unleash the traveler in you with an AI-guided concierge designed to provide personalized bookings, while augmented reality and gamification turn your journey into a magical one. It's not just an app - it's a companion! Raily®. Connect, Travel, Friends.</div></div><div id="w-node-_0a40dcf2-d1e0-765c-e1c4-b4482160df34-e6ef39a8" class="box-link-footer-4"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ca3ba64d0f2160aa658e15_Frame%201948757724.webp" loading="lazy" alt="" class="mic1"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6500bcf2fd3291abdcdc7bd6_nvidia-logo.webp" loading="lazy" alt="" class="image-89"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6500bcfb2d820a599088a46f_aws-logo.webp" loading="lazy" alt="" class="image-90"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/658bb92fd6a454cb5e1e7222_Google_for_Startups_logo%203.svg" loading="lazy" alt="" class="image-90-1"></div></div></div></div><div id="w-node-f3d472a2-8681-901c-5757-2f6a6255e531-e6ef39a8" class="box-text-footer3 footer-contacts"><div class="div-block-231 footer-contacts--is-portuguese"><div class="text-14 _9b9b9b">Portugal, Lisboa,<br>Campo Grande, 28, 7C,<br>1700-093. NIPC: 516343653</div></div><div class="div-block-231 footer-contacts--is-uae"><div class="text-14 _9b9b9b">UAE, Dubai, DWC Business Center, L3 3A,Dubai South Business Park, 390667, License Nr. 10710, Reg. Nr. 10248.</div></div><div class="div-block-231 footer-contacts--is-germany"><div class="text-14 _9b9b9b">Germany, München, Straßlach-Dingharting,Frundsbergstraße 58a, 82064. Amtsgericht &nbsp;HRB 237306. USt-IdNr.: DE280049701</div></div><div class="div-block-231 footer-contacts--is-uae"><a href="http://status.raily.app" target="_blank" class="block-uptime w-inline-block"><div class="text-16 _9b9b9b margen-app">Uptime</div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64e455460351d74d44bebf3e_Frame%201948757850.webp" loading="lazy" alt="" class="image-82"></a><div class="text-14 _9b9b9b">Qatar, Doha, 9th Floor QFC Tower 1, West Bay, QFC Nr. 0246.</div></div></div></div><div class="w-layout-grid grid-footer-mob"><div id="w-node-eb4b5c7b-0861-6131-333a-3be95c5acd07-e6ef39a8" class="wrapper-linck-footer"><div class="blok-link-footer fert"><div class="text-20 planset-14 mob14">Company</div><div id="w-node-eb4b5c7b-0861-6131-333a-3be95c5acd13-e6ef39a8" class="box-link-footer"><a href="/mission" class="link-block-3 w-inline-block"><div class="text-block-11">Mission</div></a><a data-popup-initiator="footer" href="/press" class="link-block-3 w-inline-block"><div class="text-block-11">Press</div></a><div class="link-block-3"><div class="text-block-11">Podcasts</div></div><div class="blok-podcasts"><div class="box-social"><a href="https://rb.gy/u4zfs" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe3f_Podcast%20icons.svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe42_Podcast%20icons%20(3).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a><a href="https://rb.gy/mh90p" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe40_Podcast%20icons%20(1).svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe43_Podcast%20icons%20(4).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a><a href="https://rb.gy/bz92u" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe41_Podcast%20icons%20(2).svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe44_Podcast%20icons%20(5).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a><a href="https://rb.gy/bz92u" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe41_Podcast%20icons%20(2).svg" loading="lazy" alt="" class="image-socila-mono" style="opacity: 1;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64e0f37914f492b3dfec5560_US-EN_ListenOn_AmazonMusic_Button_SQUARE_Charcoal_RGB%20(1).svg" loading="lazy" alt="" class="image-socila-color" style="opacity: 0;"></a></div></div></div></div><div class="blok-link-footer"><div class="text-20 planset-14 mob14">Help Center</div><div id="w-node-eb4b5c7b-0861-6131-333a-3be95c5acd25-e6ef39a8" class="box-link-footer-5"><a href="/safety-tips" class="link-block-3 w-inline-block"><div class="text-block-11">Trust &amp; Safety</div></a><a href="/cookie-policy" class="link-block-3 w-inline-block"><div class="text-block-11">Cookies Policy</div></a><a href="/raily-community-guidelines" class="link-block-3 w-inline-block"><div class="text-block-11">Guidlines</div></a></div></div><div class="blok-link-footer"><div class="text-20 planset-14 mob14">Legal</div><div id="w-node-eb4b5c7b-0861-6131-333a-3be95c5acd2e-e6ef39a8" class="box-link-footer-3"><a href="https://raily.canny.io/bug-reports" target="_blank" class="link-block-3 w-inline-block"><div class="text-block-11">Support</div></a><a href="https://raily.canny.io/features" target="_blank" class="link-block-3 w-inline-block"><div class="text-block-11">Features</div></a><a href="mailto:raily@raily.app ?subject=Hi" class="link-block-3 w-inline-block"><div class="text-block-11">Contact</div></a><a href="/privacy-policy" class="link-block-3 w-inline-block"><div class="text-block-11">Privacy</div></a><a href="/terms-and-conditions-of-use" class="link-block-3 w-inline-block"><div class="text-block-11">Terms</div></a></div></div></div><div class="box-social lin-app-mob"><div class="html-embed-13 rly-app-senja w-embed"><div class="senja-embed is-show-mobile rly-app-senja" data-id="8ff23a15-7265-4a47-84c6-e54a7f1998d8" data-lazyload="false"></div></div><a data-show-review-button="" href="#" class="btn-reviews visibol w-inline-block"><div class="text-16 planset-14 w300">Spill Your Thoughts</div></a></div><div id="w-node-_44f1e70f-1b54-3e3a-3030-55629c215137-e6ef39a8" class="box-social lin-app-mob"><a href="https://raily.medium.com" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbb80634a1b4e1a6fdc1b_Frame%201948757844%20(1).svg" loading="lazy" alt="" class="image-socila-color w33" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ca37ee345caf8e595683e0_Component%2012.svg" loading="lazy" alt="" class="image-socila-mono w33" style="opacity: 1;"></a><a href="https://www.linkedin.com/company/railyapp" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbbfff114f531d14f2205_Frame%201948757544%20(1).svg" loading="lazy" alt="" class="image-socila-color w30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe48_Frame%201948757543.webp" loading="lazy" alt="" class="image-socila-mono w30" style="opacity: 1;"></a><a href="https://raily.quora.com" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbc4974c80ca086dd9b5f_Component%2011%20(3).svg" loading="lazy" alt="" class="image-socila-color w30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ca388c6eaa1e4171231229_Component%2011%20(1).svg" loading="lazy" alt="" class="image-socila-mono w30" style="opacity: 1;"></a><a href="http://facebook.com/raily" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbcc2e4c1cd47c0bb49e8_Facebook%20icon%20(1).svg" loading="lazy" alt="" class="image-socila-color w29-30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64aceaf9cb10fc1c8e4efe45_Facebook%20icon.webp" loading="lazy" alt="" class="image-socila-mono w29-30" style="opacity: 1;"></a><a href="http://twitter.com/raily" target="_blank" class="link-social w-inline-block"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ddbd0089aeb93f160a1132_Twitter%20icon%20(1).svg" loading="lazy" alt="" class="image-socila-color w1-9" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ca39512eb0f357ac4a9454_Group%201948757707%20(1).svg" loading="lazy" alt="" class="image-socila-mono w19" style="opacity: 1;"></a></div><div class="block-microsoft"><div id="w-node-_29f1df38-05e6-41eb-54ad-79215731081b-e6ef39a8" class="div-block-230"><div id="w-node-eb4b5c7b-0861-6131-333a-3be95c5acd59-e6ef39a8" class="box-link-footer-4"><div class="box-footer-central"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6638ffe8912102b283bdc102_Frame%201948757862.webp" loading="lazy" alt="" class="image-91"></div><div class="box-footer-central"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6638fffbd5a6510f139e66c7_Frame%201948757893.webp" loading="lazy" alt="" class="im-nvideo"></div><div class="box-footer-central"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/6639000ad5a6510f139e711d_Frame%201948757890.webp" loading="lazy" alt="" class="image-94"></div><div class="box-footer-central"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/66390017f4b17bbfaa48e4a9_Google_for_Startups_logo%203.webp" loading="lazy" alt="" class="im-google"></div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64ca3ba64d0f2160aa658e15_Frame%201948757724.webp" loading="lazy" alt="" class="mic-2"></div></div></div><div class="block-microsoft block-ai-logos"><div class="box-text-footer2"><div class="text-20 margen-app-copy">Powered by</div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64cc9cb25ae66c58463ce399_Frame%201948757722.svg" loading="lazy" alt="" class="image-25"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64cb68015630fcc809a30eba_Frame%201948757659.svg" loading="lazy" alt="" class="image-26"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/658d0cee6f7007cb927d3288_Frame%201948758950.svg" loading="lazy" alt="" class="image-26-1"></div></div><div id="w-node-eb4b5c7b-0861-6131-333a-3be95c5acd49-e6ef39a8" class="blok-logo-text"><div class="box-text-footer1"><div class="div-block-140"><div class="box-social no-margen"><a href="#Home" class="link-social w-inline-block w--current"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64cb67a4d4f6301b862bfec7_Raily%20sign%20small%20(1).svg" loading="lazy" alt="" class="image-socila-color w30" style="opacity: 0;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64cb6773a1ba8a68d77247e3_Raily%20sign%20small.svg" loading="lazy" alt="" class="image-socila-mono w30" style="opacity: 1;"></a></div><div class="text-16 _9b9b9b w88">Raily® - Meets on the move<br>The ultimate AI-driven social travel hub. Unleash the traveler in you with an AI-guided concierge designed to provide personalized bookings, while augmented reality and gamification turn your journey into a magical one. It's not just an app - it's a companion! Raily®. Connect, Travel, Friends.</div></div></div></div><div class="box-text-footer3"><div class="div-block-232"><a href="#" class="link-social-2 non w-inline-block"><div class="box-social no-margen"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e567823e7bbc80e95a77_Summatus%20logo1.svg" loading="lazy" alt="" class="image-socila-mono w100"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e621492cef83cc68fb75_Summatus%20logo2.svg" loading="lazy" alt="" class="image-socila-color w100"></div></a><div class="text-16 _9b9b9b pozition-right mob-12">Portugal, Lisboa,Campo Grande, 28, 7C,1700-093. NIPC: 516343653</div></div><div class="div-block-232"><a href="#" class="link-social-2 non w-inline-block"><div class="box-social no-margen"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e567823e7bbc80e95a77_Summatus%20logo1.svg" loading="lazy" alt="" class="image-socila-mono w100"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e621492cef83cc68fb75_Summatus%20logo2.svg" loading="lazy" alt="" class="image-socila-color w100"></div></a><div class="text-16 _9b9b9b pozition-right mob-12">Germany, München, Straßlach-Dingharting,Frundsbergstraße 58a, 82064. Amtsgericht &nbsp;HRB 237306. USt-IdNr.: DE280049701</div></div><div class="div-block-232"><a href="#" class="link-social-2 non w-inline-block"><div class="box-social no-margen"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e567823e7bbc80e95a77_Summatus%20logo1.svg" loading="lazy" alt="" class="image-socila-mono w100"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e621492cef83cc68fb75_Summatus%20logo2.svg" loading="lazy" alt="" class="image-socila-color w100"></div></a><div class="text-16 _9b9b9b pozition-right mob-12">UAE, Dubai, DWC Business Center, L3 3A,Dubai South Business Park, 390667, License Nr. 10710, Reg. Nr. 10248.</div></div><div class="div-block-232"><a href="#" class="link-social-2 non w-inline-block"><div class="box-social no-margen"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e567823e7bbc80e95a77_Summatus%20logo1.svg" loading="lazy" alt="" class="image-socila-mono w100"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64b4e621492cef83cc68fb75_Summatus%20logo2.svg" loading="lazy" alt="" class="image-socila-color w100"></div></a><div class="text-16 _9b9b9b pozition-right mob-12">Qatar, Doha, 9th Floor QFC Tower 1, West Bay, QFC Nr. 0246.</div></div><a href="http://status.raily.app" target="_blank" class="block-uptime w-inline-block"><div class="text-16 _9b9b9b margen-app mob10">Uptime</div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64e455460351d74d44bebf3e_Frame%201948757850.webp" loading="lazy" alt="" class="image-82"></a></div></div></div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64e78ba081eb2becc6e03113_Group%201948757679.webp" loading="lazy" alt="" class="image-83"></footer><div data-w-id="a16c2325-1d68-3fd1-5f27-e4ae123d7ba9" class="block-chat-1" style="transform: translate3d(0em, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;"><div class="wrapper-chat1"><div id="ask-raily-button" data-w-id="10943cac-e302-4d53-ab06-19916568e2e1" class="btn-grin"><div data-w-id="186a6439-c508-4051-512a-d27144f7fdea" class="box-cross" style="display: none;"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64fababddeed167eba2e1cc2_Vector%20(6).svg" loading="lazy" alt="" class="image-cross"><div class="box-text-coluse"><div class="text-19 _3d clouse color-black">Close</div></div></div><div data-w-id="10943cac-e302-4d53-ab06-19916568e2e2" class="text-19 _3d color-blak" style="display: flex;">Raily Mate</div></div><div class="box-html"><div class="html-embed w-embed"><div class="mottle-bot-container">
  <div class="mottle-bot mottle-chat mottle-chat-flex" style="height: 50vh;">
    <div class="mottle-top-bar">
      <div class="mottle-minimized-msg">
        Do you have a question?
      </div>
    </div>
    <div class="mottle-conversation">
      <div class="mottle-messages"></div>
    </div>
    <form>
      <fieldset>
        <input type="hidden" name="bot" value="O9KezsQn4LPUUsutFvF4DfNqV283-qmxQEle57X9YKXqyBy3h">
        <input type="hidden" name="welcome" value="Hello, I'm Raily Mate and I'm here to answer any questions you may have about the Raily App. Feel free to ask me anything!">
         <input type="text" class="mottle-query" name="q" placeholder="Ask Raily a question...">
        <button type="submit" class="mottle-button"><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/65527846ed538d0070a5ad60_enter-key.svg" alt="Иконка" width="20" height="20"></button>
      </fieldset>
      
    </form>
  </div>
</div>

<style>
.mottle-bot-container {
/* padding: 20px; */
/* position: fixed; */
/* bottom: 50%; */
width: 100%;
height: 40vh;
max-width: 100%;
margin: 0 auto;
/* left: 50%;
transform: translateX(-50%); */
/* transform: translateY(-50%); */
/* box-shadow: none !important; */
}

.mottle-bot,
.mottle-bot input {
font-family: "Inter", sans-serif;
}
.mottle-button {
background: transparent;
font-size: 1.2em;
color: black;
}
.mottle-button img {
  width: 36px;
height: 36px;
}
.mottle-conversation {
padding: 20px;
height: 1500px;
box-shadow: none !important;
overflow-y: scroll;
overflow-x: hidden;
background: #fbfbfb;
border: 1px solid #dedede;
border-radius: 12px;
margin-top: 0;
}

.mottle-conversation::-webkit-scrollbar {
/* padding-right: 40px; */
width: 5px; /* width of the entire scrollbar */
height: 20px;
}

.mottle-conversation::-webkit-scrollbar-track {
background: transparent; /* color of the tracking area */
}

.mottle-conversation::-webkit-scrollbar-thumb {
background-color: #d9d9d9; /* color of the scroll thumb */
border-radius: 31px; /* roundness of the scroll thumb */
border: 10px solid transparent; /* creates padding around scroll thumb */
}

/* .mottle-conversation::-webkit-scrollbar {
width: 40px;
} */

.mottle-bot {
border: none;
box-shadow: none;
margin: 0;
padding: 1rem;
border-radius: 0;
min-width: auto !important;
}
.mottle-msg-bot, .mottle-msg-user {
font-size: 14px;
line-height: 20px;
}

.mottle-messages {
/* border: salmon solid; */
}

.mottle-msg-bot div {
background: #edeff7;
border-radius: 0px 20px 20px 10px;
}

.mottle-msg-user div {
background: #b4f7cb;
border-radius: 20px 10px 0px 20px;
}

button {
background: transparent;
}

button.mottle-button {
position: absolute;
/* transform: translateX(-100%); */
top: 50%;
right: 20px;
transform: translateY(-50%);
}

.mottle-chat .mottle-query {
border: 1px solid #dedede;
border-radius: 12px;
width: 100%;
padding: 20px;
/* font-family: "Inter"; */
font-style: normal;
font-weight: 400;
font-size: 14px;
line-height: 120%;
/* identical to box height, or 17px */

color: #8e90a4;
}

.mottle-bot fieldset {
margin-right: 0;
position: relative;
}

.grecaptcha-badge {
display: none;
}

@media (max-width: 768px) {
.mottle-bot-container {
  /* padding: 20px; */
  /* position: fixed; */
  /* bottom: 50%; */
  width: 600px;
  height: 40vh;
  max-width: 100%;
  margin: 0 auto;
  /* left: 50%;
  transform: translateX(-50%); */
  /* transform: translateY(-50%); */
  /* box-shadow: none !important; */
}

.mottle-bot,
.mottle-bot input {
  font-family: "Inter", sans-serif;
}
.mottle-button {
  background: transparent;
  font-size: 1.2em;
  color: black;
}
.mottle-conversation {
  padding: 20px;
  height: 1500px;
  box-shadow: none !important;
  overflow-y: scroll;
  overflow-x: hidden;
  background: #fbfbfb;
  border: 1px solid #dedede;
  border-radius: 12px;
  margin-top: 0;
}

.mottle-conversation::-webkit-scrollbar {
  /* padding-right: 40px; */
  width: 5px; /* width of the entire scrollbar */
  height: 20px;
}

.mottle-conversation::-webkit-scrollbar-track {
  background: transparent; /* color of the tracking area */
}

.mottle-conversation::-webkit-scrollbar-thumb {
  background-color: #d9d9d9; /* color of the scroll thumb */
  border-radius: 31px; /* roundness of the scroll thumb */
  border: 10px solid transparent; /* creates padding around scroll thumb */
}

/* .mottle-conversation::-webkit-scrollbar {
  width: 40px;
} */

.mottle-bot {
  border: none;
  box-shadow: none;
  margin-top: 0;
}

.mottle-messages {
  /* border: salmon solid; */
}

.mottle-msg-bot div {
  background: #edeff7;
  border-radius: 0px 20px 20px 10px;
}

.mottle-msg-user div {
  background: #b4f7cb;
  border-radius: 20px 10px 0px 20px;
}

button {
  background: transparent;
}

button.mottle-button {
  position: absolute;
  /* transform: translateX(-100%); */
  top: 50%;
  right: 20px;
  transform: translateY(-50%);
}

.mottle-chat .mottle-query {
  border: 1px solid #dedede;
  border-radius: 12px;
  width: 100%;
  padding: 20px;
  /* font-family: "Inter"; */
  font-style: normal;
  font-weight: 400;
  font-size: 14px;
  line-height: 120%;
  /* identical to box height, or 17px */

  color: #8e90a4;
}

.mottle-bot fieldset {
  margin-right: 0;
  position: relative;
}

.grecaptcha-badge {
  display: none;
}
}
</style></div></div></div></div><img src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/64beaeed9cf849ee2c62d7d1_%D0%97%D0%90%D0%93%D0%9B%D0%A3%D0%A8%D0%9A%D0%903.webp" loading="lazy" alt="" class="image-68"><div class="set-all-components-to-display-none-and-use-this-div-to-create-a-symbol"><div fs-cc="banner" class="fs-cc-banner_component" style="display: none; transform: translate3d(0px, 100%, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;"><div class="fs-cc-banner_container"><div class="fs-cc-banner_text">By clicking <strong>“Accept”</strong>, you agree to the storing of cookies on your device to enhance site navigation, analyze site usage, and assist in our marketing efforts. View our <a href="/cookie-policy" class="fs-cc-banner_text-link">Privacy Policy</a> for more information.</div><div class="fs-cc-banner_buttons-wrapper"><a fs-cc="open-preferences" href="#" class="fs-cc-banner_text-link _2">Preferences</a><a fs-cc="deny" href="#" class="fs-cc-banner_button fs-cc-button-alt w-button">Deny</a><a fs-cc="allow" href="#" class="fs-cc-banner_button w-button">Accept</a><div fs-cc="close" class="fs-cc-banner_close"><div class="fs-cc-banner_close-icon w-embed"><svg fill="currentColor" aria-hidden="true" focusable="false" viewBox="0 0 16 16">
  <path d="M9.414 8l4.293-4.293-1.414-1.414L8 6.586 3.707 2.293 2.293 3.707 6.586 8l-4.293 4.293 1.414 1.414L8 9.414l4.293 4.293 1.414-1.414L9.414 8z"></path>
</svg></div></div></div></div><div fs-cc="interaction" class="fs-cc-banner_trigger"></div></div><div fs-cc-scroll="disable" fs-cc="preferences" class="fs-cc-prefs_component w-form" style="display: none; transform: translate3d(0px, 20px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d; opacity: 0;"><form id="cookie-preferences" name="wf-form-Cookie-Preferences" data-name="Cookie Preferences" method="get" class="fs-cc-prefs_form" data-wf-page-id="64e30c9fd1d1b88ce6ef39a8" data-wf-element-id="b206178c-f5a1-b732-3b8a-eee8e96e41b3" aria-label="Cookie Preferences"><div fs-cc="close" class="fs-cc-prefs_close"><div class="fs-cc-prefs_close-icon w-embed"><svg fill="currentColor" aria-hidden="true" focusable="false" viewBox="0 0 16 24">
  <path d="M9.414 8l4.293-4.293-1.414-1.414L8 6.586 3.707 2.293 2.293 3.707 6.586 8l-4.293 4.293 1.414 1.414L8 9.414l4.293 4.293 1.414-1.414L9.414 8z"></path>
</svg></div></div><div class="fs-cc-prefs_content"><div class="fs-cc-prefs_space-small"><div class="fs-cc-prefs_title">Privacy Preference Center</div></div><div class="fs-cc-prefs_space-small"><div class="fs-cc-prefs_text">When you visit websites, they may store or retrieve data in your browser. This storage is often necessary for the basic functionality of the website. The storage may be used for marketing, analytics, and personalization of the site, such as storing your preferences. Privacy is important to us, so you have the option of disabling certain types of storage that may not be necessary for the basic functioning of the website. Blocking categories may impact your experience on the website.</div></div><div class="fs-cc-prefs_space-medium"><a fs-cc="deny" href="#" class="fs-cc-prefs_button fs-cc-button-alt w-button">Reject all cookies</a><a fs-cc="allow" href="#" class="fs-cc-prefs_button w-button">Allow all cookies</a></div><div class="fs-cc-prefs_space-small"><div class="fs-cc-prefs_title">Manage Consent Preferences by Category</div></div><div class="fs-cc-prefs_option"><div class="fs-cc-prefs_toggle-wrapper"><div class="fs-cc-prefs_label">Essential</div><div class="fs-cc-prefs_text"><strong>Always Active</strong></div></div><div class="fs-cc-prefs_text">These items are required to enable basic website functionality.</div></div><div class="fs-cc-prefs_option"><div class="fs-cc-prefs_toggle-wrapper"><div class="fs-cc-prefs_label">Marketing</div><label class="w-checkbox fs-cc-prefs_checkbox-field"><input type="checkbox" id="marketing" name="marketing" data-name="Marketing" fs-cc-checkbox="marketing" class="w-checkbox-input fs-cc-prefs_checkbox"><span for="marketing" class="fs-cc-prefs_checkbox-label w-form-label">Essential</span><div class="fs-cc-prefs_toggle"></div></label></div><div class="fs-cc-prefs_text">These items are used to deliver advertising that is more relevant to you and your interests. They may also be used to limit the number of times you see an advertisement and measure the effectiveness of advertising campaigns. Advertising networks usually place them with the website operator’s permission.</div></div><div class="fs-cc-prefs_option"><div class="fs-cc-prefs_toggle-wrapper"><div class="fs-cc-prefs_label">Personalization</div><label class="w-checkbox fs-cc-prefs_checkbox-field"><input type="checkbox" id="personalization" name="personalization" data-name="Personalization" fs-cc-checkbox="personalization" class="w-checkbox-input fs-cc-prefs_checkbox"><span for="personalization" class="fs-cc-prefs_checkbox-label w-form-label">Essential</span><div class="fs-cc-prefs_toggle"></div></label></div><div class="fs-cc-prefs_text">These items allow the website to remember choices you make (such as your user name, language, or the region you are in) and provide enhanced, more personal features. For example, a website may provide you with local weather reports or traffic news by storing data about your current location.</div></div><div class="fs-cc-prefs_option"><div class="fs-cc-prefs_toggle-wrapper"><div class="fs-cc-prefs_label">Analytics</div><label class="w-checkbox fs-cc-prefs_checkbox-field"><input type="checkbox" id="analytics" name="analytics" data-name="Analytics" fs-cc-checkbox="analytics" class="w-checkbox-input fs-cc-prefs_checkbox"><span for="analytics" class="fs-cc-prefs_checkbox-label w-form-label">Essential</span><div class="fs-cc-prefs_toggle"></div></label></div><div class="fs-cc-prefs_text">These items help the website operator understand how its website performs, how visitors interact with the site, and whether there may be technical issues. This storage type usually doesn’t collect information that identifies a visitor.</div></div><div class="fs-cc-prefs_buttons-wrapper"><a fs-cc="submit" href="#" class="fs-cc-prefs_button w-button">Confirm my preferences and close</a></div><input type="submit" data-wait="Please wait..." class="fs-cc-prefs_submit-hide w-button" value="Submit"><div class="w-embed"><style>
/* smooth scrolling on iOS devices */
.fs-cc-prefs_content{-webkit-overflow-scrolling: touch}
</style></div></div></form><div class="w-form-done" tabindex="-1" role="region" aria-label="Cookie Preferences success"></div><div class="w-form-fail" tabindex="-1" role="region" aria-label="Cookie Preferences failure"></div><div fs-cc="close" class="fs-cc-prefs_overlay"></div><div fs-cc="interaction" class="fs-cc-prefs_trigger"></div></div></div></div><script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=64aceaf9cb10fc1c8e4efdbc" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script><script src="https://cdn.prod.website-files.com/64aceaf9cb10fc1c8e4efdbc/js/webflow.bc871d3a5.js" type="text/javascript"></script><script defer="" src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js" integrity="sha256-huW7yWl7tNfP7lGk46XE+Sp0nCotjzYodhVKlwaNeco=" crossorigin="anonymous"></script>
<script async="" id="ask-raily-script" data-src="https://embed.mottle.com/embed.js"></script>

<script>
      window.rlyApp = window.rlyApp || {};   

  // воспроизведения аудио по кнопке
  const $playerControl = $('[data-player-control]');
  $playerControl.click(function(event) {
      const $playButton = $(event.currentTarget);
      const $audioElement = $playButton.siblings().find('audio');
      const player = $audioElement[0];
      gtag('event', 'podcast_play', {
          value: $audioElement.data('name')
      });
      const $videoIconPlayed = $playButton.find('.image-play-animacia');
      const $videoIconPaused = $playButton.find('.image-play');
      let isPlaying = false;
  
      const showPlayIcon = () => {
          window.tram($videoIconPlayed).set({ opacity: 0 }).start({ opacity: 1 });
          window.tram($videoIconPaused).set({ opacity: 1 }).start({ opacity: 0 });
      }
      const showPausedIcon = () => {
          window.tram($videoIconPaused).set({ opacity: 0 }).start({ opacity: 1 });
          window.tram($videoIconPlayed).set({ opacity: 1 }).start({ opacity: 0 });
      }
      if (player.paused && !isPlaying) {
          showPlayIcon();
          player.play();
          isPlaying = true;
      } else {
          showPausedIcon();
          player.pause();
          isPlaying = false;
      }
      $audioElement.on("ended", () => {
          showPausedIcon();
          isPlaying = false;
      });
  });

  document.addEventListener( "DOMContentLoaded", function() {
  SmoothScroll({
    animationTime    : 800,
    stepSize         : 75,
    accelerationDelta : 30,
    accelerationMax   : 2,
    keyboardSupport   : true,
    arrowScroll       : 50,
    // Pulse (less tweakable)
    // ratio of "tail" to "acceleration"
    pulseAlgorithm   : true,
    pulseScale       : 4,
    pulseNormalize   : 1,
    touchpadSupport   : true
  });
  
  // запуск svg с падающими словами
  let bubblesCallback = (entries, observer) => {
      entries.forEach((entry) => {
        if(entry.isIntersecting) {
          const svgBubblesEl = document.getElementById('svgBubbles');
                  svgBubblesEl.dispatchEvent(new Event('click'));
        }
      });
  };
  let bubblesObserver = new IntersectionObserver(bubblesCallback, {
      root: null,
      rootMargin: '0px',
      threshold: 0.1
  });
  bubblesObserver.observe(document.getElementById('place-for-bubbles'));

  // Подгрузка аудио при попадании в экран
  let audioPlayerCallback = (entries, observer) => {
      entries.forEach((entry) => {
          if(entry.isIntersecting) {
              $(entry.target).attr('preload', 'auto');
          }
      });
  };
  let audioPlayerObserver = new IntersectionObserver(audioPlayerCallback, {
      root: null,
      rootMargin: '0px',
      threshold: 0.5
  });
  document.querySelectorAll('audio[data-name]').forEach((i) => {
      if (i) audioPlayerObserver.observe(i);
  });
});
  window.onload = () => {
  const $pageNode = $("#place-for-bubbles");
  if(!$pageNode) return;
  // const path = 'https://azure.raily.app/files/logos.svg';
    $.get({
    url: $pageNode.data('svg-url'),
    type: 'get',
    dataType: 'xml',
  }, function(data){
    const $svgNode = $("svg", data);
    const docNode = document.adoptNode($svgNode[0]);
          setTimeout(() => {
    $(docNode).attr('id', 'svgBubbles')
        .addClass('svg-bubbles-animation')
      .find('animate, animateTransform')
      .attr('repeatCount', 1)
        .attr('begin', 'svgBubbles.click');
    $pageNode.append(docNode);
    }, 3000);
  }, 'xml');

}

// Запуск логики проигрывателя, после загрузки
document.addEventListener("videojs-loaded", videoPlayerInit);
 if(window.rlyApp.videoJsReady) {
   videoPlayerInit();
 };
 function videoPlayerInit() {
   if(window.rlyApp.videoPlayerReady) return;
   let videoPlayerOptions = {
     controls: true,
     autoplay: false,
     muted: true,
     preload: "none",
     loop: true,
     fluid: true,
     controlBar: {
       pictureInPictureToggle: false,
       fullscreenToggle: false,
       playToggle: false
     }
   };
   function playToggle(e, player) {
           e.preventDefault();
      e.stopPropagation();
     if (!player.hasClass('vjs-has-started')) return false;
     if(player.hasClass('vjs-paused')) {
       player.play();
     } else {
       player.pause();
     }
   };
   document.querySelectorAll('[data-vjs-player]').forEach( videoEl => {
     if (!videoEl.dataset.hasOwnProperty('isMobile') &&  window.rlyApp.isMobile) return;
     if (videoEl.dataset.hasOwnProperty('isMobile') && ! window.rlyApp.isMobile) return;
     if(videoEl.dataset.hasOwnProperty('isMobile') &&  window.rlyApp.isMobile) {
             Object.assign(videoPlayerOptions, { preload: 'meta' })
     }
     if (videoEl.dataset.hasOwnProperty('isNoFluid')) {
       Object.assign(videoPlayerOptions, { fluid: false })
     }
     if (videoEl.dataset.hasOwnProperty('isNoControls')) {
       Object.assign(videoPlayerOptions.controlBar, { controls: false, controlBar: false })
     }
     if (videoEl.dataset.hasOwnProperty('sources')) {
          Object.assign(videoPlayerOptions, { loop: false, autoplay: false });
     }
     const player = videojs(videoEl, videoPlayerOptions);
     const playerName = videoEl.dataset.playerId;
     
     if (videoEl.dataset.hasOwnProperty('sources')) {
        player.playlist(JSON.parse(videoEl.dataset.sources), 0);
        player.playlist.autoadvance();
        player.playlist.repeat(true);
        player.on('ended', function() {
          player.playlist.next();
        });
        if(videoEl.dataset.hasOwnProperty('sourcesAutoplay')) {
          player.on('playlistitem', function() {
            setTimeout(() => {
              player.play()
            }, 50);
          });
        } else {
          player.on('playlistitem', function() {
            setTimeout(() => {
              player.pause()
            }, 50);
          });
        }
     };
     
     window.rlyApp = {
       ...window.rlyApp,
       [playerName]: player
     };
     player.ready(() => {
             if(window.rlyApp.isMobile) {
               player.bigPlayButton.el_.addEventListener('touchend', function(e) { playToggle.apply(this, [e, player]); });
       } else {
               player.bigPlayButton.el_.addEventListener('click', function(e) { playToggle.apply(this, [e, player]); });
       }
     });
   });

   // Воспроизведение видео при попадании в экран
   let videoPlayerCallback = (entries, observer) => {
     entries.forEach((entry) => {
       const playerId = entry.target.dataset.playerId;
       const isVideoAutoplay = entry.target.dataset.hasOwnProperty('isAutoplay');
       const playerInst = window.rlyApp[playerId];
       if(!playerInst) return;
       if(entry.isIntersecting && isVideoAutoplay) {
               console.log(`${playerId} play`);
         playerInst?.play();
       } else {
               console.log(`${playerId} pause`);
         playerInst?.pause();
       }
     });
   };
   let videoPlayerObserver = new IntersectionObserver(videoPlayerCallback, {
     root: null,
     rootMargin: '0px',
     threshold: 0.01
   });
   document.querySelectorAll('[data-player-id]').forEach((i) => {
     if (i) videoPlayerObserver.observe(i);
   });
   window.rlyApp.videoPlayerReady = true;
  }

    // Senja scripts
  document.addEventListener("senja-collector-ready", () => {
    console.log("senja-collector-ready");
     $('[data-show-review-button]').click(() => {
     console.log("data-show-review-button");
        window.SenjaCollector.open({
          fields: { 
            project: "raily",
            form: "IESt8p",
            trigger: {"type":"none"}
          } 
        });
      });
  });
 (function () {
   const scriptPlatform = document.createElement('script');
   const scriptCollector = document.createElement('script');
   scriptPlatform.src = 'https://static.senja.io/dist/platform.js';
   scriptCollector.src = 'https://widget.senja.io/js/collector.js';
   scriptPlatform.async = true;
   scriptCollector.async = true;
   setTimeout(() => {
      document.head.appendChild(scriptPlatform);
      document.head.appendChild(scriptCollector);
   }, 3000);
   scriptCollector.addEventListener('load', () => {
     document.dispatchEvent(new CustomEvent('senja-collector-ready'));
   });
   scriptPlatform.addEventListener('load', () => {
     const widjets = document.querySelectorAll('senja-embed');
     document.dispatchEvent(new CustomEvent('senja-platform-ready'));
   });
 })(window);
</script>

<!--swiper-->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
$(".slider-main_component").each(function(index) {
const swiper = new Swiper($(this).find(".swiper")[0], {
  speed: 700,
  loop: true,
  autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
  slidesPerView: 1,
  spaceBetween: "2%",
  pagination: {
    el: $(this).find(".swiper-bullet-wrapper")[0],
    bulletActiveClass: "is-active",
    bulletClass: "swiper-bullet",
    bulletElement: "button",
    clickable: true
  },
  navigation: {
    nextEl: $(this).find(".btn-next")[0],
    prevEl: $(this).find(".btn-prev")[0],
    disabledClass: "is-disabled"
  },
});
});
</script>

<script>$(document).ready(function () {

  var show = true;
  var countbox = $(".gridnumbers");
  $(window).on("scroll load resize", function () {
      if (!show) return false; // Отменяем показ анимации, если она уже была выполнена
      var w_top = $(window).scrollTop(); // Количество пикселей на которое была прокручена страница
      var e_top = $(countbox).offset().top; // Расстояние от блока со счетчиками до верха всего документа
      var w_height = $(window).height(); // Высота окна браузера
      var d_height = $(document).height(); // Высота всего документа
      var e_height = $(countbox).outerHeight(); // Полная высота блока со счетчиками
      if (w_top + 1000 >= e_top || w_height + w_top == d_height || e_height + e_top < w_height) {
          $('.anim').css('opacity', '1');
          $('.anim').spincrement({
              thousandSeparator: "",
              duration: 2200
          });

          show = false;
      }
  });

});
      !function(t){t.extend(t.easing,{spincrementEasing:function(t,a,e,n,r){return a===r?e+n:n*(-Math.pow(2,-10*a/r)+1)+e}}),t.fn.spincrement=function(a){function e(t,a){if(t=t.toFixed(a),a>0&&"."!==r.decimalPoint&&(t=t.replace(".",r.decimalPoint)),r.thousandSeparator)for(;o.test(t);)t=t.replace(o,"$1"+r.thousandSeparator+"$2");return t}var n={from:0,to:null,decimalPlaces:null,decimalPoint:".",thousandSeparator:",",duration:1e3,leeway:50,easing:"spincrementEasing",fade:!0,complete:null},r=t.extend(n,a),o=new RegExp(/^(-?[0-9]+)([0-9]{3})/);return this.each(function(){var a=t(this),n=r.from;a.attr("data-from")&&(n=parseFloat(a.attr("data-from")));var o;if(a.attr("data-to"))o=parseFloat(a.attr("data-to"));else if(null!==r.to)o=r.to;else{var i=t.inArray(r.thousandSeparator,["\\","^","$","*","+","?","."])>-1?"\\"+r.thousandSeparator:r.thousandSeparator,l=new RegExp(i,"g");o=parseFloat(a.text().replace(l,""))}var c=r.duration;r.leeway&&(c+=Math.round(r.duration*(2*Math.random()-1)*r.leeway/100));var s;if(a.attr("data-dp"))s=parseInt(a.attr("data-dp"),10);else if(null!==r.decimalPlaces)s=r.decimalPlaces;else{var d=a.text().indexOf(r.decimalPoint);s=d>-1?a.text().length-(d+1):0}a.css("counter",n),r.fade&&a.css("opacity",0),a.animate({counter:o,opacity:1},{easing:r.easing,duration:c,step:function(t){a.html(e(t*o,s))},complete:function(){a.css("counter",null),a.html(e(o,s)),r.complete&&r.complete(a)}})})}}(jQuery);
</script>
<iframe allow="join-ad-interest-group" data-tagging-id="G-K0DRW11MFK" data-load-time="1717794850063" height="0" width="0" src="https://td.doubleclick.net/td/ga/rul?tid=G-K0DRW11MFK&amp;gacid=1854463201.1717794748&amp;gtm=45je4650v9137457046za200&amp;dma=0&amp;gcd=13l3l3l3l1&amp;npa=0&amp;pscdl=noapi&amp;aip=1&amp;fledge=1&amp;frm=0&amp;z=780327617" style="display: none; visibility: hidden;"></iframe><div id="loom-companion-mv3" ext-id="liecbddmkiiihnedobmlmillhodjkdmb"><section id="shadow-host-companion"></section></div></body><div id="vimeo-record-extension">

</div></html>