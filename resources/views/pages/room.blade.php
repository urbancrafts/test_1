@extends('layouts.app1')

      @section('content')
		<!-- Page loader -->
  
<style id='foxuries-style-inline-css' type='text/css'>
            div.foxuries-room{
              background-image: url({{ $rooms[0]->img_1 }});
            }
    </style>


<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('dist/js/jquery-ui.js') }}"></script>


<script type="text/javascript">
jQuery( document ).ready(function() {
jQuery( function() {
  var dateToday = new Date();
  var dates = jQuery("#check_in_date_602ae1e0dd259, #check_out_date_602ae1e0dd259").datepicker({
    defaultDate: "+2d",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "check_in_date_602ae1e0dd259" ? "minDate" : "maxDate",
        instance = jQuery(this).data("datepicker"),
        date = jQuery.datepicker.parseDate(instance.settings.dateFormat || 		jQuery.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
  });
});
});
    
    const dp = new DayPilot.Scheduler("dp");


    function loadRoomData(resort_id, room_id){
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "{{ action('App\Http\Controllers\ResortController@sub_room') }}",
         data: {resort_id: resort_id, room_id: room_id},
         cache: false,
         
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
          dp.resources = data;
          dp.update();
          
             //alert(data.data[0]);
         }
         });
}


function loadRoomReservation(resort_id, room_id){
  
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "{{ action('App\Http\Controllers\ReservationController@load_admin_room_reservation') }}",
         data: {resort_id: resort_id, room_id: room_id},
         cache: false,
         
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
          //dp.events.add(data[4]);
          //dp.events.load(data);
          for(var i = 0; i < data.length; i++){
            dp.events.add(data[i]);
          }
          
           
             //alert(data.data[0]);
         }
         });
}

</script>


</head>
<body class="hb_room-template-default single single-hb_room postid-50 wp-embed-responsive wp-hotel-booking wp-hotel-booking-room-page has-post-thumbnail foxuries-footer-builder elementor-default elementor-kit-75 elementor-page elementor-page-50">    
	    @include('inc.header1')


<div class="foxuries-room foxuries-breadcrumb">
    <h1 class="breadcrumb-heading">
        <i aria-hidden="true" class="foxuries-icon- foxuries-icon-home"></i>{{$resorts2[0]->name}} | 
    @foreach ($rooms as $room)
        {{$room->room_no}}
    @endforeach
    	</h1>

    
</div>
    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div id="room-50" class="hb_single_room tp-hotel-booking post-50 hb_room type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view">
    <div class="room-entry-header">
    <div class="single-room-meta">
    
    
    
    </div>
    @foreach ($rooms as $room)
    
         @if ($room->amount != "")
         <div class="single-room-price-wrap">
            <div class="price">
            <span class="title-price">Price from</span>
            <span class="price_value price_min" style="font-size: 36px;">{{$room->curr}}{{$room->amount}}</span>
            <span class="unit">{{$room->duration}}</span>
            </div>
            <a href="#" data-id="50" data-name="Budget Room" class="hb_button hb_primary" id="hb_room_load_booking_form">
                Check Availability Calendar</a>
           </div>
         @endif

    @endforeach
    

    </div>


    <div id="secondary" class="widget-area single-room-sidebar">

    
    
    @foreach ($rooms as $room)
    
            @if ($room->amount != "")
            
            @if ($room->available == 1)
 
            <div id="hb_widget_search-2" class="widget widget_hb_widget_search"><span class="gamma widget-title">Your Reservation</span>
                <div id="hotel-booking-search-602ae1e0dd25b" class="hotel-booking-search">
                <h3>Check Availability</h3>
                <form name="hb-search-form" id="reservation-form" action="{{ action('App\Http\Controllers\ReservationController@post_reservation') }}" >
                <ul class="hb-form-table">
                    <input type="hidden" name="resort" id="resort" value="{{$rooms[0]->shelter_id}}" />
                    <input type="hidden" name="room" id="room" value="{{$rooms[0]->id}}" />
                    @if (Auth::user())
                    <input type="hidden" name="uid" id="uid" class="hb_input_date_check form-control" value="{{ Auth::user()->id }}" />
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
                    <input type="hidden" name="curr" id="curr" value="{{$rooms[0]->curr}}" />
                    <input type="hidden" name="price" id="price" value="{{$rooms[0]->amount}}" />
                    <input type="hidden" name="type" id="type" value="room" />
                    <input type="hidden" name="qnty" id="qnty" value="{{$rooms[0]->qnty}}" />
                    
                <li class="hb-form-field">
                <label>Arrival Date</label> <div class="hb-form-field-input hb_input_field">
                    <span style="color: red; display: none" class="resort-checkin-error">(*Required)</span>
                <input type="text" name="check_in_date" id="check_in_date_602ae1e0dd259" class="hb_input_date_check form-control" placeholder="Arrival Date" />
                </div>
                </li>
                <li class="hb-form-field">
                <label>Departure Date</label> <div class="hb-form-field-input hb_input_field">
                    <span style="color: red; display: none" class="resort-checkout-error">(*Required)</span>
                <input type="text" name="check_out_date" id="check_out_date_602ae1e0dd259" class="hb_input_date_check form-control" placeholder="Departure Date" />
                </div>
                </li>
                <li class="hb-form-field">
                <label>Adults</label> <div class="hb-form-field-input">
                    <span style="color: red; display: none" class="resort-adults-error">(*Required)</span>
                    <input type="number" name="adults_capacity" id="adults" class="hb_input_date_check form-control" placeholder="Enter number of adults" min="1" max="10" />
                     </div>
                </li>
                <li class="hb-form-field">
                <label>Children</label> <div class="hb-form-field-input">
                    <span style="color: red; display: none" class="resort-children-error">(*Required)</span>
                    <input type="number" name="max_child" id="children" class="hb_input_date_check form-control" placeholder="Enter number of children" max="10" />
                    </div>
                </li>
                </ul>
                
                <p class="hb-submit">
                <button type="submit" id="reserv-btn" class="button alt btn req-btn">Make Reservation</button>
                </p>
                <span class="alert alert-danger" style="display: none"></span><span class="alert alert-success" style="display: none"></span>
                </form>
                </div></div>
            @else
            
            <div id="hb_widget_cart-2" class="widget widget_hb_widget_cart"> 
                <div id="hotel_booking_mini_cart_602ae1e0dcd30" class="hotel_booking_mini_cart">
                <h3>Unavailable</h3>
                <p class="hb_mini_cart_empty">Sorry, {{$room->room_no}} is booked at the moment</p>
                </div>
                </div>

            @endif


            @endif

    @endforeach

    


</div>
    <div class="summary entry-summary">
    <div class="hb_room_gallery" id="hb_single_room_gallery">
        @if($rooms[0]->images)
        @foreach ($roomImages as $key => $img)  
       
        <div class="inner">
            <img src="{{ $img }}" alt=" Images {{$img}}">
            </div>  
        @endforeach
        @endif
    
    
    </div>
    <div class="hb_room_thumbnail" id="hb_single_room_thumbnail">

        @if($rooms[0]->images)
        @foreach ($roomImages as $key => $img)  
        <div class="thumbnail-inner">
            <img src="{{ $img }}" alt=" Images {{$img}}">
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
        @foreach ($rooms as $room)
            {{ $room->descr }}
        @endforeach
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
    
    <a href="{{url('resorts/resort/'.$resorts2[0]->id)}}"><i aria-hidden="true" class="foxuries-icon- foxuries-icon-home"></i>Go to Resort Page<<-----</a>
    </div>
    </div>
    
    </div>
    </div>

    <div class="modal" id="modal-elemet">
        
    </div>


    @include('inc.footer1')

    <div class="foxuries-hb-room-sticky">
        <div class="col-full">
        <div class="foxuries-hb-room-sticky-wrap">
        <img width="75" height="65" src="{{ $rooms[0]->img_1 }}" class="attachment-foxuries-recent-post size-foxuries-recent-post wp-post-image" alt="" /> <div class="foxuries-hb-room-sticky-content">
        <span class="title">{{$rooms[0]->room_no}}</span>
        <span>
        <div class="price">
        <span class="title-price">Price</span>
        <span class="price_value price_min">{{$rooms[0]->curr}}{{$rooms[0]->amount}}</span>
        <span class="unit">{{$rooms[0]->duration}}</span>
        </div>
        </span>
        </div>
        <a href="#" data-id="51" data-name="Premium Room" class="hb_button hb_primary" id="hb_room_load_booking_form">
        Check Availability Calendar</a> </div>
        </div>


        <script type="text/html" id="tmpl-hb-minicart-empty">
            <p class="hb_mini_cart_empty">Your cart is empty.</p>
        </script>
        <div id="hotel_booking_room_hidden"></div>
        
        <script type="text/html" id="tmpl-hb-room-load-form">
          <div class="form-inner">
            <div class="svg-decor-heading">
              <svg enable-background="new 0 0 244 50" viewBox="0 0 244 50" xmlns="http://www.w3.org/2000/svg">
                <g fill="#7ab1c7">
                  <path d="m104.5 8.7c-.9-.1-1.8-.2-2.7-.3-3.3-.5-6.6-1.1-9.1-3.3-.7-.6-1.7-.2-1.7.7-.1 2.5-.1 4.7 1.9 5.9-.7-.4-4.9 3.1-5.5 3.6-1.9 1.4-3.6 3-5.3 4.6-2.9 2.9-6.2 5.6-8.9 8.7-1.2 1.3-2.4 2.5-3.7 3.7-.6.3-1.3.6-1.9.8-2.6.7-6 .5-7.9-1.7-2-2.4-1.7-4.6 1.1-6.5 2.5-1.7 3.7-.9 3.5 2.4-1.8-.1-1.8 2.9 0 2.8 3.9-.2 5.6-4.7 2.5-7.3-3.6-3-9.8 0-10.7 4.3-.5 2.2.3 4.1 1.6 5.5-.7-.1-1.4-.1-2.1 0-.8.1-3.5.5-3.5 1.7 0 1 1.6 1 2.3 1 1.9.1 3.7-.3 5.3-1 1.6.9 3.5 1.4 5.3 1.3-3.8 2.5-8.1 4.1-12.8 3.9-1.5 0-2.9-.2-4.4-.5-.1-.1-.2-.2-.3-.2-.2 0-.3 0-.4 0-.7-.2-1.4-.4-2.1-.6 0-.5 0-1 .1-1.5.2-1.1.6-2.1 1.1-3.1.5-1.1 1.8-2.6 1.6-3.9-.5-2.7-4.1-.4-5.2.4-2.2 1.7-2.5 4.1-1.5 6.5-.6-.3-1.1-.6-1.6-.9-2.1-1.3-4.3-3.2-4.8-5.8-.5-2.4-.1-5.6 2.8-6.1.8-.2 1.9.2 2.1 1 0 .2 0 .4.1.7.5 3.1 6.5 1.1 6.8-1.5.3-2.7-3.4-4.5-5.6-4.6-5.1-.2-9.5 4-9.7 9.1 0 .9.1 1.8.2 2.7-2-.5-4.2-.3-6 .4-.2.1-.4.2-.7.3-.2 0-.3 0-.5 0-.6-1.9-1.9-3.4-3.6-4.4-.9-.6-4.1-2.4-4.6-.4-.2.8.5 1.4.9 1.9.9 1.1 1.9 2.2 3.1 3 .9.6 1.9.9 2.8 1.1-1.6 1-3 2.2-4.7 3-2.9 1.3-5.7 1.3-8.5.7-.5-1-.9-2.1-1.6-3-.8-1.1-1.9-1.9-3-2.7-1-.7-3.4-1.9-4-.1-.6 1.9 1 4.2 2.5 5.2 1 .7 2.2 1.2 3.5 1.5 2.6 1.8 5.8 2.3 8.9 1.7-.8 1.5-1.3 3.1-1.3 4.5 0 .5.5 1 1 1 2.2-.1 3.9-1.9 5.2-3.7 1-1.5 2.5-3.7 2.8-5.6.2-.1.3-.2.5-.3 3.8-2.3 6-1.7 9.2 0 .4.5.9 1 1.4 1.5-2.5-.5-4.7-.4-4.9 1.6-.1 1.5 1.5 2.1 2.7 2.3 2.1.3 5.6.6 7.7-.5 6.3 2.6 14.4 3 19.2 1.7 2.8-.8 5.3-2 7.6-3.5 0 .3-.1.5-.1.8-.2 1.5-.1 5 1.4 5.9 1.7 1 2.7-1.9 3.2-3.1.9-2.4 1-4.9.6-7.4 3.2-2.9 6.1-6.2 9.1-9.4v1.6c.3 3 2.5 5.9 5.7 5.9 2.2 0 5.3-2.4 4.3-4.9-.6-1.6-1.8-1.1-3.1-1.4-1.6-.3-2.8-1.6-3.3-3.2-.2-.8-.1-1.4.1-2 1.9-1.8 3.9-3.5 6-4.9 3.8-2.5 8.7-4.4 13.4-4.4-.6.2-1.3.5-1.9.8-1.5.8-4 2.6-3.4 4.6.5 1.6 1.8 1.4 3 .8 2.5-1.3 4.7-2.8 7.7-3 3.6-.1 5.8 1.4 7.2 4.2.1 1.3-.1 2.5-.9 3.9-1.2 1.9-3.1 3.1-4.8 4.3-.9.6-.7 2.3.6 2.2 1.7 0 4.1-.5 5.9-1.5-.3.9-.7 1.8-1.2 2.7-1 1.7-2.1 3.4-3.7 4.7-1.3 1.2-2.8 1.8-4.6 2-2.2-.5-4-1.4-3.9-4 0-.4.1-.9.5-1.1.6-.3 1.2.2 1.8.3 2.5.4 2.4-6.3-2.6-3.8-3.6 1.8-4.4 6.3-1.7 9.3 7.8 8.8 18.2-4.7 19.3-11.9 1.8-10.4-7.8-17.6-17.1-17.7z"/>
                  <path d="m242.9 30.9c-.6-1.8-2.9-.6-4 .1-1.1.8-2.2 1.6-3 2.7-.7.9-1.1 1.9-1.6 3-2.8.7-5.7.7-8.5-.7-1.7-.8-3.2-2-4.7-3 1-.1 1.9-.4 2.8-1.1 1.2-.8 2.2-1.9 3.1-3 .4-.5 1.1-1.1.9-1.9-.5-2-3.7-.2-4.6.4-1.8 1.1-3 2.6-3.6 4.4-.2 0-.3 0-.5 0-.2-.1-.4-.2-.7-.3-1.8-.7-4-.8-6-.4.2-.8.3-1.7.2-2.7-.2-5.1-4.5-9.3-9.7-9.1-2.2.1-5.9 1.9-5.6 4.6.3 2.6 6.3 4.6 6.8 1.5 0-.2 0-.4.1-.7.2-.8 1.3-1.2 2.1-1 2.8.5 3.2 3.8 2.8 6.1-.5 2.6-2.7 4.4-4.8 5.8-.5.3-1.1.6-1.6.9 1-2.4.7-4.8-1.5-6.5-1.1-.9-4.7-3.2-5.2-.4-.2 1.2 1.1 2.8 1.6 3.9.5 1 .9 2 1.1 3.1.1.5.1 1 .1 1.5-.7.2-1.4.4-2.1.6-.1 0-.3 0-.4 0s-.2.1-.3.2c-1.5.3-2.9.5-4.4.5-4.8.1-9-1.5-12.8-3.9 1.8 0 3.7-.4 5.3-1.3 1.7.8 3.5 1.2 5.3 1 .7 0 2.4 0 2.3-1 0-1.2-2.7-1.6-3.5-1.7-.7-.1-1.4-.1-2.1 0 1.3-1.4 2.1-3.3 1.6-5.5-.9-4.3-7.1-7.3-10.7-4.3-3.1 2.6-1.4 7.1 2.5 7.3 1.8.1 1.8-3 0-2.8-.2-3.3 1-4.1 3.5-2.4 2.8 1.9 3.2 4.1 1.1 6.5-1.9 2.2-5.3 2.4-7.9 1.7-.7-.2-1.3-.5-1.9-.8-1.3-1.2-2.5-2.4-3.7-3.7-2.7-3-6-5.8-8.9-8.7-1.7-1.6-3.4-3.2-5.3-4.6-.6-.5-4.9-4-5.5-3.6 2.1-1.2 2-3.5 1.9-5.9 0-.8-1-1.2-1.6-.7-2.5 2.3-5.9 2.9-9.1 3.3-.9.1-1.8.2-2.7.3-9.4.1-19 7.2-17.3 17.5 1.1 7.3 11.6 20.7 19.3 11.9 2.6-3 1.9-7.5-1.7-9.3-5-2.5-5 4.1-2.6 3.8.6-.1 1.3-.6 1.8-.3.4.2.5.7.5 1.1 0 2.6-1.7 3.5-3.9 4-1.8-.1-3.3-.8-4.6-2-1.5-1.3-2.7-3-3.7-4.7-.5-.9-.9-1.8-1.2-2.7 1.9 1 4.2 1.4 5.9 1.5 1.3 0 1.5-1.6.6-2.2-1.8-1.2-3.7-2.5-4.8-4.3-.9-1.4-1-2.6-.9-3.9 1.5-2.8 3.6-4.3 7.2-4.2 3 .1 5.1 1.7 7.7 3 1.2.6 2.5.8 3-.8.6-2-2-3.8-3.4-4.6-.6-.3-1.2-.6-1.9-.8 4.7.1 9.6 1.9 13.4 4.4 2.2 1.4 4.2 3.1 6 4.9.3.6.4 1.2.1 2-.5 1.6-1.7 2.8-3.3 3.2-1.2.3-2.5-.2-3.1 1.4-.9 2.5 2.1 4.9 4.3 4.9 3.3 0 5.4-2.9 5.7-5.9.1-.6.1-1.1 0-1.6 3 3.2 5.9 6.5 9.1 9.4-.5 2.5-.3 5 .6 7.4.4 1.2 1.4 4.1 3.2 3.1 1.5-.9 1.6-4.4 1.4-5.9 0-.3-.1-.5-.1-.8 2.3 1.5 4.8 2.7 7.6 3.5 4.9 1.3 13 1 19.2-1.7 2 1.1 5.5.8 7.7.5 1.2-.2 2.8-.8 2.7-2.3-.2-2.1-2.4-2.2-4.9-1.6.5-.5 1-1 1.4-1.5 3.2-1.6 5.4-2.2 9.2 0 .2.1.3.2.5.3.3 1.9 1.8 4.2 2.8 5.6 1.2 1.7 2.9 3.5 5.2 3.7.5 0 1-.5 1-1 0-1.4-.5-3-1.3-4.5 3.1.6 6.4 0 8.9-1.7 1.3-.3 2.5-.9 3.5-1.5 1.6-.9 3.2-3.1 2.6-5z"/>
                </g>
              </svg>
            </div>
            <div class="svg-decor-right">
              <svg enable-background="new 0 0 260 180" viewBox="0 0 260 180" xmlns="http://www.w3.org/2000/svg">
                <path d="m12.1 6.5c.7 1.1.3 2.9-1 3.3.6-.4.6-1.2.3-1.8-.4-.5-1.1-.8-1.7-.8-.7.2-1.3.5-1.8 1-2.6 2.9 2.7 3.6 4.4 3 .7-.2 1.3-.7 2-.8.6-.1 1.3-.1 2 0 7.3 1 14.4.9 21.8.9h98.2 19.5c-.3-1.6.2-3.3 1.3-4.6 1.4-1.7 3.6-2.8 5.8-2.7 1.3 0 2.6.4 3.5 1.2 1 .8 1.5 2.2 1.3 3.4-1.1-1.3-2.9-1.9-4.4-1.2s-2.3 2.7-1.5 4.1c1 1.6 3.3 1.7 5.2 1.4 3.2-.5 6.4-1.4 9.5-2.4 5.1-1.7 10.4-3.2 15.9-2.7 10.4.9 18.1 8.6 27.6 11.8.4.1.8.3 1.3.4-1-.9-2-2-2.5-3.1-.8-1.6-1-3.6 0-5 .5 1.4 1.3 2.7 2.2 3.8-1-1.8-.8-4.1.4-5.8 1.2-1.6 3.4-2.4 5.4-2.1s3.8 1.7 4.7 3.5c.4.8.6 1.7.5 2.5-.1.9-.6 1.7-1.4 2.1-.9.4-1.8.2-2.7 0 1-.2 1.5-1.3 1.3-2.3-.2-.9-1.1-1.6-2-2-1.3-.4-2.9-.1-3.8.9-2.3 2.7.1 6.6 2.9 8.6 3.2.5 6.5.5 9.7-.1.9-4.2 2.7-8.9 6-11.4 1.2-.9 2.8-1.6 4.4-1.6.9-.3 1.8-.2 2.9.5 2.9 1.9 2.2 6.1.4 8.5-2.6 3.3-7.5 5.1-11.8 6v.2c-.6 3.2-.5 6.6-.1 9.8 2 2.7 5.9 5.2 8.6 2.9 1-.9 1.4-2.5.9-3.8-.3-.9-1-1.8-2-2-.9-.2-2.1.3-2.3 1.3-.2-.9-.4-1.9 0-2.7s1.2-1.3 2.1-1.4 1.7.1 2.5.5c1.8.9 3.2 2.7 3.5 4.7s-.5 4.2-2.1 5.4-4 1.4-5.8.4c1.1.9 2.4 1.7 3.8 2.2-1.5 1-3.5.8-5 0-1.1-.6-2.2-1.5-3.1-2.5.1.4.3.9.4 1.3 3.3 9.5 11 17.3 11.8 27.6.5 5.4-1 10.8-2.7 15.9-1 3.1-1.9 6.2-2.4 9.5-.3 1.9-.2 4.2 1.4 5.2 1.4.9 3.4 0 4.1-1.5s.1-3.4-1.2-4.4c1.2-.3 2.6.3 3.4 1.3s1.2 2.3 1.2 3.5c0 2.2-1 4.4-2.7 5.8-1.3 1.1-3.2 1.7-4.8 1.2-.7-.2-1.4-.6-2-1 0 0-.1-.1-.1-.1v18.4 22.3c0 7.3-.1 14.5.9 21.8.1.7.2 1.3 0 2s-.6 1.3-.8 2c-.6 1.7.1 6.9 3 4.4.5-.4.8-1.1.8-1.8s-.2-1.4-.8-1.7c-.5-.4-1.4-.3-1.8.3.5-1.2 2.2-1.6 3.3-1 1.1.7 1.7 2.1 1.7 3.4 0 1.1-.4 2.3-1.3 2.9-.4.3-.9.5-1.4.6-1 .3-2 .3-2.9.1-2.9-.8-2.4-3.6-2.4-5.9.1-3.6 0-7.3 0-10.9 0-10.1 0-20.2 0-30.3 0-8.8 0-17.7 0-26.5 0-.6 0-1.2 0-1.8-1.1-1.9-1.6-4.3-1.8-6.3-.3-3.5.7-7 2-10.1 2.4-5.6 4.4-10.8 4.6-17.1 0-1.1 0-2.3-.2-3.4-.2-.9-.5-1.8-.8-2.7-.1 3.1-.4 5.9-2.9 8.3-.2.2-.5.5-.9.5-.8.1-1.4-.7-1.6-1.5-.3-1.6.3-3.2.9-4.7.7-1.8 1.5-3.7 2.6-5.3.2-.3.4-.5.5-.6-1.1-2.4-2.4-4.7-3.9-6.8-2.5-3.4-4.3-8-5.6-12-1.5-4.8-1.9-10-1.3-15 0-.1 0-.3.1-.4h-.1c-5 .7-10.1.2-15-1.3-4-1.2-8.6-3.1-12-5.6-2.1-1.6-4.4-2.9-6.8-3.9-.2.2-.4.3-.6.5-1.6 1.2-3.5 1.9-5.3 2.6-1.5.6-3.1 1.2-4.7.9-.8-.1-1.7-.8-1.5-1.6.1-.3.3-.6.5-.9 2.4-2.5 5.2-2.8 8.3-2.9-.9-.3-1.8-.5-2.7-.8-1.1-.3-2.3-.3-3.4-.2-6.2.2-11.4 2.3-17.1 4.6-2.4 1-4.2 1.6-6.8 1.8-4.1.2-8.9.4-11.5-3.3-.1-.2-.3-.4-.4-.6-.6 0-1.2 0-1.7 0-8.8 0-17.7 0-26.5 0-10.1 0-96.1 0-106.2 0-3.6 0-7.3 0-10.9 0-2.3 0-5.1.5-5.9-2.4-.3-1-.2-2 .1-2.9.1-.5.3-1 .6-1.4.7-.9 1.8-1.3 2.9-1.3 1.5 0 2.9.6 3.5 1.7zm234.8 8.9c.7-.9 1.2-2.3.6-3.2-.7-.9-2.1-.9-3.2-.6-.3.1-.6.2-.9.3-1.3.6-2.1 1.8-2.8 3.1-.9 1.7-1.7 3.6-2.2 5.5 3.4-.8 6.4-2.4 8.5-5.1z"
                    fill="#86b6cd"/>
              </svg>
            </div>
            <div class="svg-decor-left">
              <svg enable-background="new 0 0 260 180" viewBox="0 0 260 180" xmlns="http://www.w3.org/2000/svg">
                <path d="m247.9 6.5c-.7 1.1-.3 2.9 1 3.3-.6-.4-.6-1.2-.3-1.8.4-.5 1.1-.8 1.7-.8.7 0 1.3.3 1.8.8 2.6 2.9-2.7 3.6-4.4 3-.7-.2-1.3-.7-2-.8-.6-.1-1.3-.1-2 0-7.3 1-14.4.9-21.8.9s-90.8 0-98.2 0c-6.5 0-13 0-19.5 0 .3-1.6-.2-3.3-1.3-4.6-1.4-1.7-3.6-2.8-5.8-2.7-1.3 0-2.6.4-3.5 1.2-1 .8-1.5 2.2-1.3 3.4 1.1-1.3 2.9-1.9 4.4-1.2s2.3 2.7 1.5 4.1c-1 1.6-3.3 1.7-5.2 1.4-3.2-.5-6.4-1.4-9.5-2.4-5.1-1.7-10.4-3.2-15.9-2.7-10.4.9-18.1 8.6-27.6 11.8-.4.1-.8.3-1.3.4 1-.9 2-2 2.5-3.1.8-1.6 1-3.6 0-5-.5 1.4-1.3 2.7-2.2 3.8 1-1.8.8-4.1-.4-5.8-1.2-1.6-3.4-2.4-5.4-2.1s-3.8 1.7-4.7 3.5c-.4.8-.6 1.7-.5 2.5.1.9.6 1.7 1.4 2.1.9.4 1.8.2 2.7 0-1-.2-1.5-1.3-1.3-2.3.2-.9 1.1-1.6 2-2 1.3-.4 2.9-.1 3.8.9 2.3 2.7-.1 6.6-2.9 8.6-3.2.5-6.5.5-9.7-.1-.9-4.2-2.7-8.9-6-11.4-1.1-.7-2.8-1.4-4.4-1.4-.9-.3-1.8-.2-2.9.5-2.9 1.9-2.2 6.1-.4 8.5 2.6 3.3 7.5 5.1 11.8 6v.2c.6 3.2.5 6.6.1 9.8-2 2.7-5.9 5.2-8.6 2.9-1-.9-1.4-2.5-.9-3.8.3-.9 1-1.8 2-2 .9-.2 2.1.3 2.3 1.3.2-.9.4-1.9 0-2.7s-1.2-1.3-2.1-1.4-1.7.1-2.5.5c-1.8.9-3.2 2.7-3.5 4.7s.5 4.2 2.1 5.4 4 1.4 5.8.4c-1.1.9-2.4 1.7-3.8 2.2 1.5 1 3.5.8 5 0 1.1-.6 2.2-1.5 3.1-2.5-.1.4-.3.9-.4 1.3-3.3 9.5-11 17.3-11.8 27.6-.5 5.4 1 10.8 2.7 15.9 1 3.1 1.9 6.2 2.4 9.5.3 1.9.2 4.2-1.4 5.2-1.4.9-3.4 0-4.1-1.5s-.1-3.4 1.2-4.4c-1.2-.3-2.6.3-3.4 1.3s-1.2 2.3-1.2 3.5c0 2.2 1 4.4 2.7 5.8 1.3 1.1 3.2 1.7 4.8 1.2.7-.2 1.4-.6 2-1 0 0 .1-.1.1-.1v18.4 22.3c0 7.3.1 14.5-.9 21.8-.1.7-.2 1.3 0 2s.6 1.3.8 2c.6 1.7-.1 6.9-3 4.4-.5-.4-.8-1.1-.8-1.8s.2-1.4.8-1.7c.5-.4 1.4-.3 1.8.3-.5-1.2-2.2-1.6-3.3-1-1.1.7-1.7 2.1-1.7 3.4 0 1.1.4 2.3 1.3 2.9.4.3.9.5 1.4.6 1 .3 2 .3 2.9.1 2.9-.8 2.4-3.6 2.4-5.9-.1-3.6 0-7.3 0-10.9 0-10.1 0-20.2 0-30.3 0-8.8 0-17.7 0-26.5 0-.6 0-1.2 0-1.8 1.1-1.9 1.6-4.3 1.8-6.3.3-3.5-.7-7-2-10.1-2.4-5.6-4.4-10.8-4.6-17.1 0-1.1 0-2.3.2-3.4.2-.9.5-1.8.8-2.7.1 3.1.4 5.9 2.9 8.3.2.2.5.5.9.5.8.1 1.4-.7 1.6-1.5.3-1.6-.3-3.2-.9-4.7-.7-1.8-1.5-3.7-2.6-5.3-.2-.3-.4-.5-.5-.6 1.1-2.4 2.4-4.7 3.9-6.8 2.5-3.4 4.3-8 5.6-12 1.5-4.8 1.9-10 1.3-15 0-.1 0-.3-.1-.4h.1c5 .7 10.1.2 15-1.3 4-1.2 8.6-3.1 12-5.6 2.1-1.6 4.4-2.9 6.8-3.9.2.2.4.3.6.5 1.6 1.2 3.5 1.9 5.3 2.6 1.5.6 3.1 1.2 4.7.9.8-.1 1.7-.8 1.5-1.6-.1-.3-.3-.6-.5-.9-2.4-2.5-5.2-2.8-8.3-2.9.9-.3 1.8-.5 2.7-.8 1.1-.3 2.3-.3 3.4-.2 6.2.2 11.4 2.3 17.1 4.6 2.4 1 4.2 1.6 6.8 1.8 4.1.2 8.9.4 11.5-3.3.1-.2.3-.4.4-.6h1.7 26.5 106.2 10.9c2.3 0 5.1.5 5.9-2.4.3-1 .2-2-.1-2.9-.1-.5-.3-1-.6-1.4-.7-.9-1.8-1.3-2.9-1.3-1.5 0-2.9.6-3.5 1.7zm-234.8 8.9c-.7-.9-1.2-2.3-.6-3.2.7-.9 2.1-.9 3.2-.6.3.1.6.2.9.3 1.3.6 2.1 1.8 2.8 3.1.9 1.7 1.7 3.6 2.2 5.5-3.4-.8-6.4-2.4-8.5-5.1z"
                    fill="#7ab1c7"/>
              </svg>
            </div>
            <form action="POST" name="hb-search-single-room" class="hb-search-room-results hotel-booking-search hotel-booking-single-room-action" autocomplete="off">
              <svg class="item-background" enable-background="new 0 0 538 548" viewBox="0 0 538 548" xmlns="http://www.w3.org/2000/svg">
                <g fill="#f5f7f8">
                  <path d="m263.3 64.9c28.5 0 56.1 5.5 82 16.4 25.1 10.5 47.6 25.6 66.9 44.8s34.5 41.5 45.1 66.3c10.9 25.7 16.5 53 16.5 81.1s-5.6 55.4-16.5 81.1c-10.6 24.8-25.8 47.1-45.1 66.3s-41.9 34.3-66.9 44.8c-26 10.9-53.6 16.4-82 16.4s-56.1-5.5-82-16.4c-25.1-10.5-47.6-25.6-66.9-44.8s-34.5-41.5-45.1-66.3c-10.9-25.7-16.5-53-16.5-81.1s5.6-55.4 16.5-81.1c10.6-24.8 25.8-47.1 45.1-66.3s41.9-34.3 66.9-44.8c26-10.9 53.5-16.4 82-16.4m0-30c-132.8 0-240.5 106.8-240.5 238.6s107.7 238.6 240.5 238.6 240.5-106.8 240.5-238.6-107.6-238.6-240.5-238.6z"/>
                  <g clip-rule="evenodd" fill-rule="evenodd">
                    <path d="m7.2 189.8c-.9-.2-1.8-.2-2.6.1-.9.3-1.7.9-2.3 1.6-.7.8-1.2 1.8-1.5 2.8s-.4 2.1-.3 3.2c.1 1 .5 1.9 1.1 2.7s1.4 1.3 2.3 1.6c1.1.4 2.2.2 3.2-.3 1.1-.7 2-1.6 2.7-2.7l1.3-2c.3-.5.7-1 1.1-1.5.3-.4.8-.8 1.3-1s1.1-.2 1.6-.1c.6.2 1.1.5 1.5 1.1s.6 1.2.6 1.9c.1.8 0 1.5-.3 2.3-.2.7-.5 1.3-.9 1.8s-.8.9-1.4 1.2-1.2.3-1.8.2l-.7 2.2c.9.2 1.9.2 2.8-.1s1.7-.9 2.3-1.6c.7-.9 1.3-1.9 1.6-3 .4-1.2.5-2.4.4-3.6-.1-1-.5-1.9-1.2-2.7-.6-.7-1.4-1.2-2.3-1.5-.7-.2-1.5-.3-2.2-.1-.6.2-1.2.4-1.8.9-.5.4-1 .8-1.3 1.3-.3.4-.7.9-1 1.4l-1 1.6c-.2.3-.4.6-.7 1-.3.3-.6.7-.9.9-.3.3-.7.5-1.1.6s-.9.1-1.3 0c-.5-.2-1-.5-1.3-.9-.4-.5-.6-1.1-.6-1.7-.1-.7 0-1.4.2-2.1.3-.9.8-1.8 1.5-2.4s1.5-.8 2.4-.6zm33.3-53.6c.7.4 1.3 1 1.7 1.7s.6 1.5.5 2.3c-.2 1.8-1.2 3.5-2.7 4.5-.7.4-1.5.6-2.3.6s-1.6-.3-2.3-.7l-10.2-6.1-1.1 1.9 10.4 6.2c1 .6 2.1.9 3.3 1 1.1 0 2.3-.3 3.2-.9 2.2-1.4 3.6-3.8 3.8-6.4.1-1.1-.2-2.3-.7-3.3-.6-1-1.4-1.9-2.4-2.5l-10.4-6.2-1.1 1.9zm36.7-37.2 1.5-1.4-9.7-9.8.1-.1 13.8 5.8 1.4-1.4-5.7-13.8.1-.1 9.7 9.8 1.5-1.5-12.8-13-1.9 1.8 6.2 15.1-.2.2-15.1-6.4-1.8 1.8zm51.8-42.1 1.8-1-6.9-12 .2-.1 11.8 9.2 1.7-1-1.9-14.8.2-.1 6.9 12 1.8-1-9-15.8-2.3 1.3 2.1 16.2-.2.1-12.9-10-2.3 1.3zm71.8-30.1-.5-1.9-8.6 2.4-1.6-6 7.9-2.2-.5-1.9-7.9 2.2-1.6-5.9 8.5-2.3-.5-1.9-10.6 2.9 4.9 17.5zm49.7-7.3-.6-16.2 3.9-.1c.8-.1 1.6.1 2.4.4.6.2 1 .7 1.4 1.2.3.6.5 1.2.5 1.9 0 .6-.1 1.3-.3 1.9-.3.5-.7 1-1.3 1.3-.7.3-1.5.5-2.3.5l-4.9.2.1 2 5-.2c1.2 0 2.4-.3 3.5-.8.8-.5 1.5-1.2 2-2 .4-.9.6-1.9.6-2.9s-.3-2-.8-2.8-1.2-1.5-2.1-1.9c-1.1-.5-2.3-.7-3.5-.6l-6.2.2.6 18.2zm3.6-8.3 4.7 8 2.6-.1-4.8-8zm110.1 8.8-1 19.3 2.1.9 13.4-14.1-2.1-.9-11 11.9-.2-.1 1.1-16.2zm61 37.2.1.1-4.8 15.5 1.9 1.4 5.5-18.6-1.8-1.4-16.3 10.6 1.9 1.4zm-9.8 5.4 7.5 5.6 1.2-1.6-7.5-5.6zm61.1 44.7c.3-.8.4-1.6.4-2.4s-.2-1.7-.5-2.4c-.3-.8-.8-1.6-1.3-2.2-.9-1.1-2.1-2-3.5-2.5-1.4-.4-2.9-.5-4.3-.1-3.3 1-6.1 3.2-7.7 6.3-.6 1.3-.9 2.8-.7 4.3.2 1.4.8 2.8 1.8 3.9.6.7 1.2 1.3 2 1.7.7.4 1.5.8 2.3.9.8.2 1.7.2 2.5.1.9-.1 1.7-.4 2.5-.9l-1.4-1.7c-1 .6-2.3.7-3.4.4-.6-.1-1.1-.4-1.5-.7-.5-.3-.9-.7-1.3-1.2-.7-.8-1.1-1.8-1.3-2.8-.1-1.1.1-2.2.5-3.2 1.3-2.4 3.5-4.3 6.2-5.1 1.1-.3 2.2-.3 3.3.1 1 .3 1.9 1 2.6 1.8.4.5.7 1 .9 1.5s.4 1.1.4 1.6c0 .6 0 1.1-.2 1.7s-.5 1.1-.9 1.6l1.4 1.7c.4-.8.9-1.5 1.2-2.4zm31.2 49.2.1.1-11.5 11.6 1 2.1 13.5-13.9-1-2-19.4 1.9 1 2.1zm-11.2.3 4.1 8.4 1.8-.9-4.1-8.4zm32.3 57.1-15.9 3.5.5 2.1 15.9-3.5 1.2 5.6 1.9-.4-3-13.3-1.9.4zm8.7 58.2-18.2.3v2.2l18.2-.3zm-12.3 68.2c1.4-.3 2.7-1 3.8-2.1 2-2.1 2.7-5.2 1.8-8.1-.5-1.4-1.4-2.6-2.5-3.5-2.8-2-6.3-2.8-9.7-2.2-1.4.3-2.7 1-3.8 2.1-2 2.1-2.7 5.2-1.8 8.1.5 1.4 1.4 2.6 2.5 3.5 2.8 2.1 6.3 2.9 9.7 2.2zm-8.4-3.8c-.9-.7-1.6-1.6-1.9-2.6-.7-2-.2-4.3 1.3-5.8.8-.8 1.8-1.3 2.9-1.5 2.7-.5 5.5.2 7.8 1.8.9.7 1.6 1.6 1.9 2.6.7 2 .2 4.3-1.3 5.8-.8.8-1.8 1.3-2.9 1.5-2.7.4-5.5-.2-7.8-1.8zm-11.5 66.1-12.8-6.5.1-.2 17.3-2.3 1-1.9-16.3-8.3-1 2 12.8 6.5-.1.2-17.3 2.3-1 1.9 16.3 8.3zm-42.3 52c.7.6 1.5.9 2.4 1s1.9-.1 2.7-.5c1-.5 1.8-1.1 2.5-2 .7-.8 1.3-1.8 1.6-2.8.3-.9.3-1.9.1-2.9-.2-.9-.7-1.8-1.5-2.4-.8-.8-2-1.1-3.1-1-1.3.2-2.5.7-3.5 1.4l-2 1.3c-.5.4-1.1.7-1.6.9s-1 .4-1.6.4c-.5 0-1.1-.2-1.5-.6-.5-.4-.8-1-.9-1.6-.1-.7-.1-1.3.2-2s.7-1.4 1.2-2c.4-.5 1-1 1.6-1.3.5-.3 1.1-.5 1.8-.5.6 0 1.2.2 1.7.6l1.5-1.7c-.7-.6-1.6-.9-2.6-1s-1.9.1-2.8.5c-1 .5-2 1.2-2.7 2.1-.8.9-1.5 2-1.8 3.2-.3 1-.3 2 0 2.9s.8 1.7 1.5 2.3c.6.5 1.2.9 2 1 .7.1 1.3.1 2-.1.6-.2 1.2-.4 1.8-.7.5-.3 1-.5 1.4-.9l1.6-1.1c.3-.2.6-.4 1-.6s.8-.4 1.2-.5.8-.2 1.2-.1.8.3 1.2.6c.4.4.7.9.8 1.4.1.6.1 1.2-.1 1.8-.2.7-.6 1.3-1.1 1.8-.6.8-1.5 1.3-2.4 1.6-.8.3-1.7.1-2.4-.4zm-90.5 50.2-1.9.8 5.5 12.7-.2.1-10.7-10.4-1.8.8.2 14.9-.2.1-5.5-12.7-1.9.8 7.2 16.7 2.4-1-.3-16.3.2-.1 11.7 11.4 2.4-1zm-74.8 21.9.3 1.9 8.8-1.4 1 6.1-8.1 1.3.3 1.9 8.1-1.3 1 6.1-8.7 1.4.3 1.9 10.9-1.7-2.8-18zm-48 2-2.1-.2-1.2 13.8h-.2l-4.5-14.2-2-.2-6.9 13.3h-.2l1.2-13.8-2.1-.2-1.6 18.1 2.6.2 7.5-14.5h.2l4.9 15.6 2.6.2zm-84-3.8c.1 1.5.7 2.8 1.6 4 1.9 2.3 4.9 3.4 7.8 2.8 1.4-.3 2.7-1 3.8-2.1 2.4-2.5 3.6-5.9 3.4-9.4-.1-1.5-.7-2.8-1.6-4-1.9-2.3-4.9-3.4-7.8-2.8-1.4.3-2.7 1-3.8 2.1-2.4 2.6-3.6 6-3.4 9.4zm4.8-7.8c.8-.8 1.8-1.3 2.8-1.6 2.1-.4 4.3.3 5.6 2 .7.9 1.1 1.9 1.2 3 .1 2.8-.8 5.5-2.7 7.5-.8.8-1.8 1.3-2.8 1.6-2.1.4-4.3-.3-5.6-2-.7-.9-1.1-1.9-1.2-3-.1-2.7.9-5.4 2.7-7.5zm-45.9-28.8-9 13.5-3.2-2.1c-.7-.4-1.3-1-1.7-1.7-.3-.5-.5-1.2-.4-1.8.1-.7.3-1.3.7-1.8.3-.6.8-1 1.4-1.3.5-.3 1.2-.4 1.8-.3.8.2 1.5.5 2.2.9l4.1 2.7 1.1-1.7-4.2-2.8c-1-.7-2.1-1.2-3.3-1.3-1-.1-1.9.1-2.8.5-.9.5-1.6 1.2-2.1 2-.6.8-.9 1.8-1 2.8s.1 1.9.6 2.8c.6 1 1.5 1.9 2.5 2.5l5.1 3.4 10.1-15.1zm-7.7 4.6.9-9.2-2.1-1.4-.8 9.3zm-50.6-29 13.2-12.6-1.5-1.6-13.2 12.6zm-24.5-62.1-1.7 1 4.7 7.6-5.3 3.2-4.3-7-1.7 1 4.3 7-5.3 3.2-4.6-7.5-1.7 1 5.7 9.4 15.6-9.5zm-36.8-50.6c-.8.3-1.6.8-2.1 1.6s-.9 1.7-1 2.6c-.1 1.1 0 2.1.4 3.2.3 1 .9 2 1.6 2.8.6.7 1.5 1.3 2.4 1.6s1.9.3 2.8 0c1.1-.3 2-1.1 2.5-2.1.5-1.2.7-2.5.6-3.7l-.1-2.3c0-.6 0-1.3 0-1.9 0-.5.2-1.1.5-1.6s.7-.8 1.2-.9c.6-.2 1.2-.2 1.8 0s1.2.6 1.6 1.2c.5.6.9 1.3 1.1 2s.3 1.3.3 2c0 .6-.2 1.2-.5 1.8-.3.5-.8 1-1.4 1.2l.7 2.2c.9-.3 1.6-.9 2.2-1.7s.9-1.7 1-2.7c.1-2.4-.7-4.8-2.2-6.6-.7-.7-1.5-1.3-2.5-1.5-.9-.2-1.9-.2-2.8.1-.7.2-1.4.6-1.9 1.2-.4.5-.8 1.1-1 1.7s-.3 1.2-.3 1.9v1.7l.1 1.9v1.2c0 .4-.1.9-.2 1.3s-.3.8-.5 1.1c-.3.3-.7.6-1.1.7-.5.2-1.1.2-1.6 0-.6-.2-1.1-.5-1.5-1-.5-.6-.8-1.2-1-1.9-.3-.9-.4-1.9-.2-2.9.2-.8.8-1.5 1.6-1.9z"/>
                    <path d="m158.4 260c-7.3 0-13.2 6-13.1 13.3s6 13.2 13.3 13.1c7.3 0 13.1-6 13.1-13.2 0-7.3-6-13.2-13.3-13.2m209.2 0c7.3.1 13.2 6 13.1 13.3s-6 13.2-13.3 13.1-13.1-6-13.1-13.2c0-7.3 5.9-13.2 13.3-13.2zm-91.2 141.5c.1 7.4-5.9 13.4-13.2 13.4-7.4.1-13.4-5.9-13.4-13.2-.1-7.4 5.9-13.4 13.2-13.4h.1c7.3 0 13.3 5.9 13.3 13.2zm0-256.2c0-7.4-5.9-13.4-13.2-13.4-7.4 0-13.4 5.9-13.4 13.2 0 7.4 5.9 13.4 13.2 13.4h.1c7.3 0 13.3-5.9 13.3-13.2zm-118 49.7c-2.4 39.6 28.8 75 68.1 77.2 1.8-20.6-10.9-42.7-30.1-50.6 7.5 6.1 17.3 22.9 17 32.8-19.7-5-38.2-26.6-39.4-46.5 38 2.5 61.9 25.4 61.9 65.2 0 38.9-22.9 62.6-61.9 65.2 1.2-19.9 19.7-41.5 39.4-46.5.3 9.8-9.5 26.6-17 32.8 19.2-7.9 31.9-30 30.1-50.6-39.3 2.3-70.6 37.7-68.1 77.2 11.7 1.7 23.5 1 34.9-2-8.4 16-11.5 34.2-8.9 52.1 39.8 2.4 75.5-28.6 77.8-67.7-20.7-1.8-43 10.8-50.9 29.9 6.2-7.4 23.1-17.2 33-16.9-5.1 19.6-26.8 37.9-46.8 39.1 1.5-21.9 9.7-38.7 23.7-49.2l.5-.4c16.7-12.3 27.4-31.3 30-55.1h22.5c2.6 23.9 13.6 42.9 30.4 55.2.2.1.4.3.5.4 13.9 10.5 22.1 27.2 23.6 49.1-20-1.2-41.8-19.5-46.8-39.1 9.9-.3 26.8 9.5 33 16.9-8-19.1-30.2-31.7-50.9-29.9 2.3 39 38 70.1 77.8 67.7 2.6-17.8-.4-36.1-8.8-52 11.3 2.9 23.1 3.5 34.6 1.9 2.4-39.5-28.8-75-68.1-77.2-1.8 20.6 10.9 42.7 30.1 50.6-7.5-6.1-17.3-22.9-17-32.8 19.7 5 38.2 26.6 39.4 46.5-39-2.6-61.9-26.3-61.9-65.2 0-38.8 23.5-62.7 61.9-65.2-1.2 19.9-19.7 41.5-39.4 46.5-.3-9.8 9.5-26.6 17-32.8-19.2 7.9-31.9 30-30.1 50.6 39.3-2.3 70.6-37.7 68.1-77.2-11.5-1.6-23.2-1-34.4 1.9 8.2-15.9 11.2-33.9 8.6-51.6-39.8-2.4-75.5 28.6-77.8 67.7 20.7 1.8 43-10.8 50.9-29.9-6.2 7.4-23.1 17.2-33 16.9 5.1-19.6 26.8-37.9 46.8-39.1-1.5 22.1-9.9 39-24.1 49.4-.1 0-.1.1-.1.1-16.5 12.3-27.8 31.2-30.3 54.8h-22.5c-2.6-23.5-13.6-42.4-30-54.8l-.2-.1c-14.2-10.4-22.6-27.3-24-49.4 20 1.2 41.8 19.5 46.8 39.1-9.9.3-26.8-9.5-33-16.9 8 19.1 30.2 31.7 50.9 29.9-2.3-39-38-70.1-77.8-67.7-2.6 17.7.4 35.8 8.7 51.7-11.4-2.9-23.2-3.6-34.7-2z"/>
                  </g>
                </g>
              </svg>
              <div class="hb-booking-room-form-head">
                <h2>Availability Calendar</h2>
                <p class="description">Please note .</p>
              </div>
        
              
              <div >

                <div id="external-events">
                <div style="width:220px; float:left;">
                  <div id="nav"></div>
              </div>
              </div>
        
                <div id="dp"></div>
        
            </div>
    
                
                
              </div>
            </form>
          </div>
        
        </script>


        <script type="text/javascript">
            const nav = new DayPilot.Navigator("nav");
            nav.selectMode = "month";
            nav.showMonths = 3;
            nav.skipMonths = 3;
            nav.onTimeRangeSelected = function(args) {
                loadTimeline(args.start);
                dp.update();
                loadReservations();
            };
            nav.init();
          
          </script>
          
          <script>
            
          
            dp.allowEventOverlap = false;
          
            dp.days = dp.startDate.daysInMonth();
            loadTimeline(DayPilot.Date.today().firstDayOfMonth());
          
            dp.eventDeleteHandling = "Update";
          
            dp.timeHeaders = [
                { groupBy: "Month", format: "MMMM yyyy" },
                { groupBy: "Day", format: "d" }
            ];
          
            dp.eventHeight = 80;
            dp.cellWidth = 60;
          
            dp.rowHeaderColumns = [
                {title: "Room", display: "name", sort: "name"},
                {title: "Capacity", display: "capacity", sort: "capacity"},
                {title: "Status", display: "status", sort: "status"}
            ];
          
            dp.separators = [
                { location: DayPilot.Date.now(), color: "red" }
            ];
          
            dp.contextMenuResource = new DayPilot.Menu({
              
                items: [
                    { text: "Edit...", onClick: async (args) => {
                           const room_capacity = "{{$rooms[0]->capacity}}";
                            const capacities = [
                                {name: "{{$rooms[0]->capacity}}", id: room_capacity},
                                
                            ];
          
                            const statuses = [
                                {name: "Ready", id: "Ready"},
                                {name: "Cleanup", id: "Cleanup"},
                                {name: "Dirty", id: "Dirty"},
                            ];
          
                            const form = [
                                {name: "Room Number", id: "name"},
                                {name: "Capacity", id: "capacity", options: capacities},
                                {name: "Status", id: "status", options: statuses}
                            ];
          
                            const data = args.source.data;
          
                            const modal = await DayPilot.Modal.form(form, data);
                            if (modal.canceled) {
                                return;
                            }
          
                            const room = modal.result;
                            const sub_id = modal.result.id;
                            const name = modal.result.name;
                            const capacity = modal.result.capacity;
                            const status = modal.result.status;
                            updateRoom(sub_id, name, capacity, status);
                            //await DayPilot.Http.post("backend_room_update.php", room);
                            //dp.rows.update(room);
                        }},
                    { text: "Delete", onClick: async (args) => {
                            const id = args.source.id;
                            const name = args.source.name;
                            const str = confirm('Do you really want to delete '+name+'?');
                            if(str == true){
                            deleteRoom(id, name);
                            }
                            //await DayPilot.Http.post("backend_room_delete.php", {id: id});
                            //dp.rows.remove(id);
                        }
                    }
                ]
            });
          
            dp.onBeforeRowHeaderRender = (args) => {
                const beds = (count) => {
                    return count + " person" + (count > 1 ? "s" : "");
                };
          
                args.row.columns[1].html = beds(args.row.data.capacity);
                switch (args.row.data.status) {
                    case "Dirty":
                        args.row.cssClass = "status_dirty";
                        break;
                    case "Cleanup":
                        args.row.cssClass = "status_cleanup";
                        break;
                }
          
                args.row.columns[0].areas = [
                    {right: 3, top: 3, width: 16, height: 16, cssClass: "area-menu", action: "ContextMenu", visibility: "Hover"}
                ];
          
            };
          
            // http://api.daypilot.org/daypilot-scheduler-oneventmoved/
            dp.onEventMoved = async (args) => {
              /**************************************
                const params = {
                    id: args.e.id(),
                    newStart: args.newStart,
                    newEnd: args.newEnd,
                    newResource: args.newResource
                };
            ******************************************/
                    const id = args.e.id();
                    const newStart = args.newStart;
                    const newEnd = args.newEnd;
                    const newResource = args.newResource;
          
                //const {data} = await DayPilot.Http.post("backend_reservation_move.php", params);
                
                moveRoomReservation(id, newStart, newEnd, newResource);
          
                //dp.message(data.message);
          
            };
          
            // http://api.daypilot.org/daypilot-scheduler-oneventresized/
            dp.onEventResized = async (args) => {
                /**************************************
                const params = {
                    id: args.e.id(),
                    newStart: args.newStart,
                    newEnd: args.newEnd
                };
              ****************************************/
                
                //const id = params.id;
                //const start = params.newStart;
                //const end = params.newEnd;
          
                    const id = args.e.id();
                    const newStart = args.newStart;
                    const newEnd = args.newEnd;
                resizeRoomReservation(id, newStart, newEnd);
                //const {data} = await DayPilot.Http.post("{{ action('App\Http\Controllers\ReservationController@admin_room_reservation_resize') }}", {id: params.id, start: params.newStart, end: params.newEnd});
                
                //dp.message("Resized");
          
            };
          
            dp.onEventDeleted = async (args) => {
                await DayPilot.Http.post("backend_reservation_delete.php", {id: args.e.id()});
                dp.message("Deleted.");
            };
          
            // event creating
            // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
            dp.onTimeRangeSelected = async (args) => {
          
                const rooms = dp.resources.map((item) => {
                    return {
                        name: item.name,
                        id: item.id
                    };
                });
          
                const form = [
                    {name: "Customer", id: "text"},
                    {name: "Start", id: "start", dateFormat: "MM/dd/yyyy HH:mm tt"},
                    {name: "End", id: "end", dateFormat: "MM/dd/yyyy HH:mm tt"},
                    {name: "Room", id: "resource", options: rooms},
                ];
          
                const data = {
                    start: args.start,
                    end: args.end,
                    resource: args.resource
                };
          
                const modal = await DayPilot.Modal.form(form, data);
          
                dp.clearSelection();
                if (modal.canceled) {
                    return;
                }
                const e = modal.result;
                const start = modal.result.start;
                const end = modal.result.end;
                const sub_room_id = modal.result.resource;
                const customer = modal.result.text;
                const resort_id = "{{$rooms[0]->shelter_id}}";
                const room_id =  "{{$rooms[0]->id}}";
                //const {data: result} = await DayPilot.Http.post("backend_reservation_create.php", e);
          
                createRoomReservation(resort_id, room_id, start, end, sub_room_id, customer, e);
                //e.id = result.id;
                //e.paid = result.paid;
                //e.status = result.status;
                //dp.events.add(e);
          
            };
          
            dp.onEventClick = async (args) => {
                const rooms = dp.resources.map((item) => {
                    return {
                        name: item.name,
                        id: item.id
                    };
                });
          
                const statuses = [
                    {name: "New", id: "New"},
                    {name: "Confirmed", id: "Confirmed"},
                    {name: "Arrived", id: "Arrived"},
                    {name: "CheckedOut", id: "CheckedOut"}
                ];
          
                const paidoptions = [
                    {name: "0%", id: 0},
                    {name: "50%", id: 50},
                    {name: "100%", id: 100},
                ]
          
                const form = [
                    {name: "Text", id: "text"},
                    {name: "Start", id: "start", dateFormat: "MM/dd/yyyy h:mm tt"},
                    {name: "End", id: "end", dateFormat: "MM/dd/yyyy h:mm tt"},
                    {name: "Room", id: "resource", options: rooms},
                    {name: "Status", id: "status", options: statuses},
                    {name: "Paid", id: "paid", options: paidoptions},
                ];
          
                const data = args.e.data;
          
                const modal = await DayPilot.Modal.form(form, data);
          
                dp.clearSelection();
                if (modal.canceled) {
                    return;
                }
                const e = modal.result;
          
                const id = modal.result.id;
                const name = modal.result.text;
                const start = modal.result.start;
                const end = modal.result.end;
                const resource = modal.result.resource;
                const status = modal.result.status;
                const paid = modal.result.paid;
                const bubble = modal.result.bubbleHtml;
          
                updateRoomReservation(id, name, start, end, resource, status, paid, bubble, e);
          
                //await DayPilot.Http.post("backend_reservation_update.php", e);
                //dp.events.update(e);
            };
          
            dp.onBeforeEventRender = (args) => {
                const start = new DayPilot.Date(args.data.start);
                const end = new DayPilot.Date(args.data.end);
                const resort_id = "{{$rooms[0]->shelter_id}}";
                const room_id =  "{{$rooms[0]->id}}";
          
                const today = DayPilot.Date.today();
                const now = new DayPilot.Date();
          
                args.data.html = DayPilot.Util.escapeHtml(args.data.text) + " (" + start.toString("M/d/yyyy") + " - " + end.toString("M/d/yyyy") + ")";
          
                switch (args.data.status) {
                    case "New":
                        const in2days = today.addDays(1);
          
                        if (start < in2days) {
                            args.data.barColor = '#cc0000';
                            args.data.toolTip = 'Expired (not confirmed in time)';
                        }
                        else {
                            args.data.barColor = '#e69138';
                            args.data.toolTip = 'New';
                        }
                        break;
                    case "Confirmed":
                        const arrivalDeadline = today.addHours(18);
          
                        if (start < today || (start.getDatePart() === today.getDatePart() && now > arrivalDeadline)) { // must arrive before 6 pm
                            args.data.barColor = "#cc4125";  // red
                            args.data.toolTip = 'Late arrival';
                        }
                        else {
                            args.data.barColor = "#38761d";
                            args.data.toolTip = "Confirmed";
                        }
                        break;
                    case 'Arrived': // arrived
                        const checkoutDeadline = today.addHours(10);
          
                        if (end < today || (end.getDatePart() === today.getDatePart() && now > checkoutDeadline)) { // must checkout before 10 am
                            args.data.barColor = "#cc4125";  // red
                            args.data.toolTip = "Late checkout";
                        }
                        else
                        {
                            args.data.barColor = "#1691f4";  // blue
                            args.data.toolTip = "Arrived";
                        }
                        break;
                    case 'CheckedOut': // checked out
                        args.data.barColor = "gray";
                        args.data.toolTip = "Checked out";
                        break;
                    default:
                        args.data.toolTip = "Unexpected state";
                        break;
                }
          
                args.data.html = "<div>" + args.data.html + "<br /><span style='color:gray'>" + args.data.toolTip + "</span></div>";
          
                const paid = args.data.paid;
                const paidColor = "#aaaaaa";
          
                args.data.areas = [
                    { bottom: 10, right: 4, html: "<div style='color:" + paidColor + "; font-size: 8pt;'>Paid: " + paid + "%</div>", v: "Visible"},
                    { left: 4, bottom: 8, right: 4, height: 2, html: "<div style='background-color:" + paidColor + "; height: 100%; width:" + paid + "%'></div>", v: "Visible" }
                ];
          
            };
          
          
            dp.init();
          
            const elements = {
                filter: document.querySelector("#filter"),
                timerange: document.querySelector("#timerange"),
                autocellwidth: document.querySelector("#autocellwidth"),
                addroom: document.querySelector("#addroom"),
            };
          
            loadRooms();
            loadReservations();
          
            function loadTimeline(date) {
                dp.scale = "Manual";
                dp.timeline = [];
                const start = date.getDatePart().addHours(12);
          
                for (let i = 0; i < dp.days; i++) {
                    dp.timeline.push({start: start.addDays(i), end: start.addDays(i+1)});
                }
            }
          
            function loadReservations() {
                
                const resort_id = "{{$rooms[0]->shelter_id}}";
                const room_id =  "{{$rooms[0]->id}}";
                //dp.events.load("{{ action('App\Http\Controllers\ReservationController@load_admin_room_reservation') }}");
              loadRoomReservation(resort_id, room_id);
          
          
            }
          
            async function loadRooms() {
                  const resort_id = "{{$rooms[0]->shelter_id}}";
                  const room_id =  "{{$rooms[0]->id}}";
                //const {data} = loadRoomData(resort_id, room_id);
                //const {data} = await DayPilot.Http.get("{{ action('App\Http\Controllers\ResortController@sub_room') }}", { resort_id: resort_id, room_id: room_id });
                //dp.resources = data;
                //dp.update();
          
                loadRoomData(resort_id, room_id);
                
            }
          
            elements.filter.addEventListener("change", (e) => {
                loadRooms();
            });
          
            elements.timerange.addEventListener("change", () => {
                switch (this.value) {
                    case "week":
                        dp.days = 7;
                        nav.selectMode = "Week";
                        nav.select(nav.selectionDay);
                        break;
                    case "month":
                        dp.days = dp.startDate.daysInMonth();
                        nav.selectMode = "Month";
                        nav.select(nav.selectionDay);
                        break;
                }
            });
          
            elements.autocellwidth.addEventListener("click", () => {
                dp.cellWidth = 60;  // reset for "Fixed" mode
                dp.cellWidthSpec = this.checked ? "Auto" : "Fixed";
                dp.update();
            });
          
            
            elements.addroom.addEventListener("click", async (ev) => {
                  ev.preventDefault();
                  const room_capacity = "{{$rooms[0]->capacity}}";
                  const capacities = [
                      {name: "{{$rooms[0]->capacity}}", id: room_capacity},
                      
                  ];
          
                  const form = [
                      {name: "Room Number", id: "name"},
                      {name: "Capacity", id: "capacity", options: capacities}
                  ];
          
                  const data = {
                      capacity: room_capacity
                  };
          
                  const modal = await DayPilot.Modal.form(form, data);
                  if (modal.canceled) {
                      return;
                  }
          
                  const room = modal.result;
                  const resort_id = "{{$rooms[0]->shelter_id}}";
                  const room_id =  "{{$rooms[0]->id}}";
                  const name = modal.result.name;
                  const capacity = modal.result.capacity;
          
                  createRoom(resort_id, room_id, name, capacity);
                  
                  //room.id = result.id;
                  //room.status = result.status;
                  
              });
          
          </script>
    <script src="{{ asset('content/cache/min/1/9157e18fa4f35485d82a0174d093076e.js') }}" data-minify="1" defer></script>
		
    @endsection