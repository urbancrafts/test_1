@extends('layouts.app1')

      @section('content')
		<!-- Page loader -->

        <style id='foxuries-style-inline-css' type='text/css'>
            div.foxuries-service{
              background-image: url({{$services[0]->img_1 }});
            }
            </style>    

    </head>
    <body class="hb_room-template-default single single-hb_room postid-50 wp-embed-responsive wp-hotel-booking wp-hotel-booking-room-page has-post-thumbnail foxuries-footer-builder elementor-default elementor-kit-75 elementor-page elementor-page-50">    
		@include('inc.header1')


<div class="foxuries-service foxuries-breadcrumb">
    <h1 class="breadcrumb-heading">
    
        {{$services[0]->title}}
   
    	</h1>

    
</div>
    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div id="room-50" class="hb_single_room tp-hotel-booking post-50 hb_room type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view">
    <div class="room-entry-header">
    <div class="single-room-meta">
    
    
    
    </div>
    
    
         @if ($services[0]->price != "")
         <div class="single-room-price-wrap">
            <div class="price">
            <span class="title-price">Price</span>
            <span class="price_value price_min" style="font-size: 36px;">{{$services[0]->curr}}{{$services[0]->price}}</span>
            <span class="unit">{{$services[0]->duration}}</span>
            </div>
           </div>
         @endif

    
    

    </div>


    <div id="secondary" class="widget-area single-room-sidebar">

    
    
   
    
            @if ($services[0]->price != "")
            @if($services[0]->available == 1)
            <div id="hb_widget_search-2" class="widget widget_hb_widget_search"><span class="gamma widget-title">Hire Now</span>
                <div id="hotel-booking-search-602ae1e0dd25b" class="hotel-booking-search">
                
                <form name="hb-search-form" id="service-booking-form" action="{{ action('App\Http\Controllers\ReservationController@post_service_booking') }}" >
                <ul class="hb-form-table">
                    <input type="hidden" name="service" id="service" value="{{$services[0]->id}}" />
                    @if (Auth::user())
                    <input type="hidden" name="name" id="name" class="hb_input_date_check form-control" value="{{ Auth::user()->name }}" />
                    <input type="hidden" name="phone" id="phone" class="hb_input_date_check form-control" value="{{ Auth::user()->phone }}" />
                    <input type="hidden" name="email" id="email" class="hb_input_date_check form-control" value="{{ Auth::user()->email }}" />
                    @else
                    <li class="hb-form-field">
                        <label>Full Name</label> <div>
                            <span style="color: red; display: none" class="resort-name-error">(*Required)</span>
                        <input type="text" name="name" id="name" class="hb_input_date_check form-control" placeholder="Full Name" />
                        </div>
                        </li>
                        <li class="hb-form-field">
                            <label>Phone Number</label> <div>
                                <span style="color: red; display: none" class="resort-phone-error">(*Required)</span>
                            <input type="number" name="phone" id="phone" class="hb_input_date_check form-control" placeholder="Phone Number" />
                            </div>
                            </li>
                            <li class="hb-form-field">
                                <label>Email Address</label> <div class="hb_input_field">
                                    <span style="color: red; display: none" class="resort-email-error">(*Required)</span>
                                <input type="email" name="email" id="email" class="hb_input_date_check form-control" placeholder="Email Address" />
                                </div>
                                </li>
                                <li class="hb-form-field">
                                    <label>ID Number</label> <div class="hb_input_field">
                                        <span style="color: red; display: none" class="resort-idno-error">(*Required)</span>
                                    <input type="text" name="id-no" id="id-no" class="hb_input_date_check form-control" placeholder="ID/Passport No." />
                                    </div>
                                    </li>   
                    @endif
                    <input type="hidden" name="curr" id="curr" value="{{$services[0]->curr}}" />
                    <input type="hidden" name="price" id="price" value="{{$services[0]->price}}" />
                    
                    <input type="hidden" name="type" id="type" value="{{$services[0]->category}}" /> 
                   
                    
                    
                <li class="hb-form-field">
                <label>duration</label> <div class="hb-form-field-input hb_input_field">
                    <span style="color: red; display: none" class="resort-duration-error">(*Required)</span>
                <input type="number" name="duration" id="duration" class="form-control" placeholder="Duration(hours)" />
                </div>
                </li>
                <li class="hb-form-field">
                <label>Booking date</label> <div class="hb-form-field-input hb_input_field">
                    <span style="color: red; display: none" class="resort-checkin-error">(*Required)</span>
                <input type="text" name="booking_date" id="check_in_date_602ae1e0dd259" class="hb_input_date_check form-control" placeholder="Booking date" />
                </div>
                </li>
                
                </ul>
                
                <p class="hb-submit">
                <button type="submit" id="reserv-btn" class="button alt btn req-btn">Book</button>
                </p>
                <span class="alert alert-danger" style="display: none"></span><span class="alert alert-success" style="display: none"></span>
                </form>
                </div></div> 

            @else
            <div id="hb_widget_cart-2" class="widget widget_hb_widget_cart"> 
                <div id="hotel_booking_mini_cart_602ae1e0dcd30" class="hotel_booking_mini_cart">
                <h3>Unavailable</h3>
                <p class="hb_mini_cart_empty">Sorry, {{$services[0]->title}} is unavailable for bookings at the moment</p>
                </div>
                </div>
            @endif

            @endif



    


</div>
    <div class="summary entry-summary">
    <div class="hb_room_gallery" id="hb_single_room_gallery">

        @if($services[0]->images)
        @foreach ($servicesImg as $key => $pimg)
        <div class="inner">
            <img src="{{ $pimg }}" alt=" Image {{ $key + 1}}">
            </div>  
            @endforeach
            @endif

        
    
    
    </div>
    <div class="hb_room_thumbnail" id="hb_single_room_thumbnail">

        @if($services[0]->images)
        @foreach ($servicesImg as $key => $pimg)
        <div class="thumbnail-inner">
            <img src="{{ $pimg }}" alt=" Image {{ $key + 1}}">
            </div>  
            @endforeach
            @endif

        

    </div>
    <div class="clear"></div>
    <div class="hb_single_room_content"> <div data-elementor-type="wp-post" data-elementor-id="50" class="elementor elementor-50" data-elementor-settings="[]">
    <div class="elementor-inner">
    <div class="elementor-section-wrap">
    <section class="elementor-element elementor-element-ea25359 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="ea25359" data-element_type="section">
    <div class="elementor-container elementor-column-gap-no">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-384d0cb elementor-column elementor-col-100 elementor-top-column" data-id="384d0cb" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-bfc478d elementor-widget elementor-widget-heading" data-id="bfc478d" data-element_type="widget" data-widget_type="heading.default">
    
    
    
    
    
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    <section class="elementor-element elementor-element-4d685f2 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="4d685f2" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-2aada9d elementor-column elementor-col-100 elementor-top-column" data-id="2aada9d" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-7a4c763 elementor-widget elementor-widget-text-editor" data-id="7a4c763" data-element_type="widget" data-widget_type="text-editor.default">
    <div class="elementor-widget-container">
    <div class="elementor-text-editor elementor-clearfix">
        
            {{ $services[0]->about }}
        
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    </div>
    </div>
    </div>
    
    



    <div class="hb_single_room_details">
        <ul class="hb_single_room_tabs">
        <li>
            <a href="#hb_location_tab">
            Location </a>
        </li>

        @if($services[0]->youtube != "")
        <li>
            <a href="#hb_video_feed_tab">
            Video </a>
        </li>
        @endif

        </ul>
        <div class="hb_single_room_tabs_content">
       
     

        

        <div id="hb_location_tab" class="hb_single_room_tab_details">
            {{$services[0]->location}}
            <div class="elementor-custom-embed">
                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{$services[0]->location}}&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near" aria-label="{{$services[0]->location}}" style="width: 100%; height: 300px;"></iframe></div> </div>
            </div>
        </div>

        @if($services[0]->youtube != "")

        <div id="hb_video_feed_tab" class="hb_single_room_tab_details">
            
            <div class="elementor-custom-embed">
                {!!$services[0]->youtube!!}
                
            </div> 
        </div>

        
        @endif

    </div>
</div>

</div>
</div>
    



    </div>
    </div>
    <div class="hb_related_other_room has_slider hb_room_carousel_container">
    <h3 class="title">List of services</h3>
    <div class="navigation">
    <span class="foxuries-icon-long-arrow-left prev"></span>
    <span class="foxuries-icon-long-arrow-right next"></span>
    </div>
    <ul class="rooms tp-hotel-booking hb-catalog-column-3">
        
        @if (count($services2) > 0)
            
        @foreach ($services2 as $service)

        @if($service->id != $services[0]->id)
    
        <li id="room-{{$service->id}}" class="hb_room post-49 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-lake-view">
            <div class="summary entry-summary">
            <div class="media">
            <a href="{{ url('services/service/'.$service->id) }}">
            <img src="{{ $service->img_1}}" width="500" height="575" alt="" /> </a>
            </div>
            <div class="room-caption">
            <div class="title">
            <h4>
            <a href="{{ url('services/service/'.$service->id) }}">{{$service->title}}</a>
            </h4>
            </div>
            <div class="room-meta"><span class="room-acreage"></span></div>
            <div class="price">
            <span class="title-price">Price from</span>
            <span class="price_value price_min">{{$service->curr}}{{$service->price}}</span>
            </div>
            <div class="rating">
            <div itemprop="reviewRating" itemscope itemtype="" class="star-rating">
            <span style="width:93.333333333333%"></span>
            </div>
            </div>
            <a href="{{ url('service/'.$service->id) }}" class="room-button"><i class="foxuries-icon-long-arrow-right"></i><span>View Service</span></a> </div>
            </div>
            </li> 
       @else
       <h4> There are no other services by this vendor.  </h4>

       @endif
        @endforeach

        @endif

    
    
    
    
    
    </ul>
    </div>
    </div>
    </div>
    
    <div class="modal" id="modal-elemet">
        
    </div>

    @include('inc.footer1')

    <script src="{{ asset('wp-content/cache/min/1/9157e18fa4f35485d82a0174d093076e.js') }}" data-minify="1" defer></script>
		@endsection