@extends('layouts.app1')

      @section('content')
		<!-- Page loader -->
	    <style id='foxuries-style-inline-css' type='text/css'>
            div.foxuries-shop{
              background-image: url({{ asset('storage/img/bg/banner2.png') }});
            }
            </style>
        <script type="text/javascript">
        jQuery(document).ready(function(){
      
          jQuery("#shop-category").on("change", function(e){
           
            if(jQuery.trim(jQuery(this).val()) == ""){
               alert('Please select a resort');
               }else{
               jQuery.ajax({
                headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
             },
                 type: "POST",
               dataType: "json",
               url: "{{ action('App\Http\Controllers\AjaxRequestController@load_shop_category') }}",
               data: {"shopCat": jQuery(this).val()},
               beforeSend:function(){
                   jQuery(".alert-success").show();
                   jQuery(".alert-danger").hide();
                   jQuery(".alert-success").html("<div class='load'><img src='{{ asset('loaders/bx_loader.gif')}}'/ > Loading...</div>");
               },
               complete:function(){
                   jQuery(".alert").hide();
               },
               error:function(){
               jQuery(".alert-success").hide();
               jQuery(".alert-danger").show();
               jQuery(".alert-danger").html("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
               },
               success:function(data){
                  if(data.success == true){
                   jQuery("#load").html(data.data);
                  }else if(data.success == false){
                    jQuery(".alert-success").hide();
                    jQuery(".alert-danger").show();
                    jQuery(".alert-danger").html(data.message);
                  }else{
                    jQuery(".alert-success").hide();
                    jQuery(".alert-danger").show();
                    jQuery(".alert-danger").html(data);
                  }
                    
               }
               });
               }
      
          });
    
jQuery('form#shop-order-form').on('submit', function(e){
    e.preventDefault();
var action = jQuery(this).attr('action');
var formdata = new FormData(this);//create an instance for the form input fields

if(jQuery.trim(jQuery('#name').val()) == ""){
  jQuery('#name').css('border', 'solid 1px red');
  jQuery('.resort-name-error').show();

}else if(jQuery.trim(jQuery('#phone').val()) == ""){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();

}else if(!Number(jQuery('#phone').val())){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();
  jQuery('.resort-phone-error').html('(phone field requires numeric data only)');
}else if(jQuery.trim(jQuery('#email').val()) == ""){
  jQuery('#email').css('border', 'solid 1px red');
  jQuery('.resort-email-error').show();
  jQuery('.resort-email-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#qnty').val()) == "" ){
  jQuery('#qnty').css('border', 'solid 1px red');
  jQuery('.resort-qnty-error').show();
  jQuery('.resort-qnty-error').html('(*Required)');

}else if(!Number(jQuery('#qnty').val()) || jQuery('#qnty').val() < 1){
  jQuery('#qnty').css('border', 'solid 1px red');
  jQuery('.resort-qnty-error').show();
  jQuery('.resort-qnty-error').html('(*Cannot accept less than 1 nor none integer value.)');
}else{
     jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: action,
         data: formdata,
         cache: false,
         contentType: false,
         processData: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              jQuery("#reserv-btn").prop('disabled', true);
              jQuery(".alert-danger").hide();
              jQuery(".alert-success").css('display', 'block !important');
              jQuery(".alert-success").html(data.message);
              
              //reservationPaymentModal(data.data.id, data.data.shelter_id, data.data.room_id, data.data.curr, data.data.price, data.data.name, data.data.type);
              //window.location = "{{ url('payment/reservations') }}/"+data.data.id;

            }else if(data.success == false){
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data.data);
            }else{
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data);
            }
              
         }
         });

}
});
      
        })
        </script>
        </head>
        <body class="page-template-default page page-id-518 wp-embed-responsive foxuries-full-width-content foxuries-footer-builder elementor-default elementor-kit-75 elementor-page elementor-page-518">  
		@include('inc.header1')


<div class="foxuries-shop foxuries-breadcrumb">
    <h1 class="breadcrumb-heading">
   
        {{$shops[0]->item_name}}
    
    	</h1>

    
</div>
    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div id="room-50" class="hb_single_room tp-hotel-booking post-50 hb_room type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view">
    <div class="room-entry-header">
    <div class="single-room-meta">
    
    
    
    </div>
   
         <div class="single-room-price-wrap">
            <div class="price">
            <span class="title-price">Unit Price</span>
            <span class="price_value price_min" style="font-size: 36px;">{{$shops[0]->curr}}{{$shops[0]->price}}</span>
            <span class="unit">
                @if ($shops[0]->available == 1)
                    Available
                    @else
                  Out of stock
                @endif
            </span>
            </div>
           </div>
        
    

    </div>


    <div id="secondary" class="widget-area single-room-sidebar">

    
    
    @foreach ($shops as $shop)
    
            
            
            @if ($shop->available == 1)
 
            <div id="hb_widget_search-2" class="widget widget_hb_widget_search"><span class="gamma widget-title">Order</span>
                <div id="hotel-booking-search-602ae1e0dd25b" class="hotel-booking-search">
                <h3>Order</h3>
                <form name="hb-search-form" id="shop-order-form" action="{{ action('App\Http\Controllers\AjaxRequestController@post_shop_order') }}" >
                <ul class="hb-form-table">
                    <input type="hidden" name="item-id" id="item-id" value="{{$shop->id}}" />
                    <input type="hidden" name="item-name" id="item-name" value="{{$shop->item_name}}" />
                    
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
                                  
                    @endif
                    <input type="hidden" name="curr" id="curr" value="{{$shop->curr}}" />
                    <input type="hidden" name="price" id="price" value="{{$shop->price}}" />
                    <li class="hb-form-field">
                    <span style="color: red; display: none" class="resort-qnty-error">(*Required)</span>
                    <input type="number" name="qnty" id="qnty" class="form-control" placeholder="Quantity" />
                    </li>
                
                
                </ul>
                
                <p class="hb-submit">
                <button type="submit" id="reserv-btn" class="button alt btn req-btn">Make Order</button>
                </p>
                <span class="alert alert-danger" style="display: none"></span><span class="alert alert-success" style="display: none"></span>
                </form>
                </div></div>
            @else
            
            <div id="hb_widget_cart-2" class="widget widget_hb_widget_cart"> 
                <div id="hotel_booking_mini_cart_602ae1e0dcd30" class="hotel_booking_mini_cart">
                <h3>Out of stock</h3>
                <p class="hb_mini_cart_empty">Sorry, {{$shop->item_name}} is out of stock at the moment</p>
                </div>
                </div>



            @endif

    @endforeach

    


</div>
    <div class="summary entry-summary">
    <div class="hb_room_gallery" id="hb_single_room_gallery">

      @if($shops[0]->images)
        @foreach ($shopImg as $key => $pimg)
        <div class="inner">
            <img src="{{ $pimg }}" alt=" Image {{ $key + 1}}">
            </div>  
            @endforeach
            @endif

    </div>
    <div class="hb_room_thumbnail" id="hb_single_room_thumbnail">

      @if($shops[0]->images)
        @foreach ($shopImg as $key => $pimg)
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
       
            {{ $shops[0]->desc }}
        
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
    
    
    </div>
    </div>
    
    </div>
    </div>

    <div class="modal" id="modal-elemet">
        
    </div>


    @include('inc.footer1')

    <script src="{{ asset('wp-content/cache/min/1/9157e18fa4f35485d82a0174d093076e.js') }}" data-minify="1" defer></script>
		@endsection