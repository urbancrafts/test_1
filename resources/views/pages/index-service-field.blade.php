<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <div data-elementor-type="wp-page" data-elementor-id="73" class="elementor elementor-73" data-elementor-settings="[]">
    <div class="elementor-inner">
    <div class="elementor-section-wrap">
    <div class="elementor-element elementor-element-6c67700 elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="6c67700" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-container elementor-column-gap-no">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-6e552d2 elementor-column elementor-col-100 elementor-top-column" data-id="6e552d2" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-8395949 elementor-widget elementor-widget-foxuries-revslider" data-id="8395949" data-element_type="widget" data-widget_type="foxuries-revslider.default">
    <div class="elementor-widget-container">
    <p class="rs-p-wp-fix"></p>
    <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery" style="background:transparent;padding:0;">
    <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.2.1">
    <rs-slides>
        @foreach ($services as $service)
    <rs-slide data-key="rs-{{$service->id}}" data-title="Slide" data-thumb="{{ $service->img_url }}" data-anim="ei:d,d;eo:d,d;s:2420,d;r:0,0;t:fade,zoomout;sl:0,d;">
    <img src="{{ $service->img_url }}" alt="foxuries" title="rev_slider-1" width="1920" height="840" data-parallax="15" data-panzoom="d:10000;ss:110%;se:100;" class="rev-slidebg" data-no-retina>
    <rs-group id="slider-1-slide-1-layer-0" data-type="group" data-rsp_ch="on" data-xy="x:c;y:m;yo:-50px,-41px,-31px,-19px;" data-text="w:normal;s:20,16,12,7;l:0,20,15,9;" data-dim="w:900px,743px,564px,450px;h:380px,313px,280px,240px;" data-frame_0="o:1;" data-frame_999="o:0;st:w;sR:8700;sA:9000;" style="z-index:12;"><rs-layer id="slider-1-slide-1-layer-1" data-type="image" data-rsp_ch="on" data-xy="x:c;" data-text="w:normal;s:20,16,12,7;l:0,20,15,9;" data-dim="w:411px,350px,290px,240px;h:154px,131px,109px,90px;" data-frame_0="sX:0.9;sY:0.9;" data-frame_1="st:1780;sp:1000;sR:1780;" data-frame_999="o:0;st:w;sR:6220;" style="z-index:8;"><img src="{{ asset('storage/img/site_icon/'.$settings[0]->icon) }}" alt="Slider Decor" width="411" height="154" data-no-retina>
    </rs-layer><rs-layer id="slider-1-slide-1-layer-2" data-type="text" data-rsp_ch="on" data-xy="x:c;yo:40px,33px,25px,15px;" data-text="w:normal;s:18;l:23,18,18,18;ls:0,0,0,0px;a:center;" data-frame_0="rX:70deg;oZ:-50;" data-frame_0_chars="y:cyc(-100||100);o:0;" data-frame_1="oZ:-50;e:power4.inOut;st:390;sp:1750;sR:390;" data-frame_1_chars="e:power4.inOut;dir:middletoedge;d:10;" data-frame_999="o:0;st:w;sR:5260;" style="z-index:9;font-family:Inter;">{{$service->category}}
    </rs-layer><rs-layer id="slider-1-slide-1-layer-3" data-type="text" data-rsp_ch="on" data-xy="x:c;yo:80px,66px,60px,50px;" data-text="w:normal;s:80,66,50,40;l:90,74,56,46;ls:4px,3px,2px,1px;fw:800;a:center;" data-frame_0="sX:2;sY:2;" data-frame_0_mask="u:t;" data-frame_1="e:power2.out;st:20;sp:1200;sR:20;" data-frame_1_mask="u:t;" data-frame_999="o:0;st:w;sR:7780;" style="z-index:10;font-family:Nanum Myeongjo;text-transform:uppercase;">{{$service->name}}
    </rs-layer><a id="slider-1-slide-1-layer-4" class="rs-layer rev-btn" href="{{ $service->url }}" target="_blank" rel="nofollow" data-type="button" data-rsp_ch="on" data-xy="x:c;yo:314px,259px,210px,200px;" data-text="w:normal;s:22;l:15;ls:2.4px,2.4px,1.5px,1.2px;fw:700;" data-dim="minh:0px,none,none,none;" data-padding="t:25,21,18,15;r:35,29,25,20;b:25,21,18,15;l:35,29,25,20;" data-frame_0="y:50,41,31,19;" data-frame_1="st:890;sp:1200;sR:890;" data-frame_999="o:0;st:w;sR:6910;" data-frame_hover="c:#fff;bgc:#000;bor:0px,0px,0px,0px;" style="z-index:11;background-color:#0b2e4f;font-family:Inter;text-transform:uppercase;font-size:28px !important;"><i class="fa-long-arrow-right"></i> &nbsp; @if($service->category == "Resort" || $service->category == "Boat")
        BOOK NOW
        @elseif($service->category == "Shop")
        ORDER NOW
        @else
        SEE INFO
        @endif
    </a></rs-group> 
   </rs-slide>
   @endforeach
    

   </rs-slides>
    <rs-progress class="rs-bottom" style="visibility: hidden !important;"></rs-progress>
    </rs-module>
    <script type="text/javascript">
                        setREVStartSize({c: 'rev_slider_1_1',rl:[1240,1024,778,480],el:[840,768,660,520],gw:[1240,1024,778,480],gh:[840,768,660,520],type:'standard',justify:'',layout:'fullscreen',offsetContainer:'',offset:'107px',mh:"0"});
                        var	revapi1,
                            tpj;
                        jQuery(function() {
                            tpj = jQuery;
                            if(tpj("#rev_slider_1_1").revolution == undefined){
                                revslider_showDoubleJqueryError("#rev_slider_1_1");
                            }else{
                                revapi1 = tpj("#rev_slider_1_1").show().revolution({
                                    jsFileLocation:"{{ asset('wp-content/plugins/revslider/public/assets/js/') }}",
                                    sliderLayout:"fullscreen",
                                    visibilityLevels:"1240,1024,778,480",
                                    gridwidth:"1240,1024,778,480",
                                    gridheight:"840,768,660,520",
                                    spinner:"spinner0",
                                    editorheight:"840,768,660,520",
                                    responsiveLevels:"1240,1024,778,480",
                                    fullScreenOffset:"107px",
                                    disableProgressBar:"on",
                                    navigation: {
                                        onHoverStop:false,
                                        arrows: {
                                            enable:true,
                                            tmp:"<div class=\"tp-arr-allwrapper\">	<div class=\"tp-arr-imgholder\"></div></div>",
                                            style:"hades",
                                            hide_onmobile:true,
                                            hide_under:"900px",
                                            animSpeed:"1ms",
                                            animDelay:"1ms",
                                            left: {
                                                h_offset:30
                                            },
                                            right: {
                                                h_offset:30
                                            }
                                        }
                                    },
                                    parallax: {
                                        levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,100,30],
                                        type:"scroll",
                                        origo:"slidercenter",
                                        speed:0
                                    },
                                    fallbacks: {
                                        allowHTML5AutoPlayOnAndroid:true
                                    },
                                });
                            }
                            
                        });
                    </script>
    </rs-module-wrap>
    
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>