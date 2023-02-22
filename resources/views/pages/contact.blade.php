@extends('layouts.app1')

      @section('content')
		<!-- Page loader -->
<script type="text/javascript">
jQuery(document).ready(function(){

jQuery('form#contact-form').on('submit', function(e){
e.preventDefault();
var action = jQuery(this).attr('action');
var formdata = new FormData(this);//create an instance for the form input fields

if(jQuery.trim(jQuery('#name').val()) == ""){
  jQuery('#name').css('border', 'solid 1px red');
  jQuery('.contact-name-error').show();

}else if(jQuery.trim(jQuery('#email').val()) == ""){
  jQuery('#email').css('border', 'solid 1px red');
  jQuery('.contact-email-error').show();
  jQuery('.contact-email-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#phone').val()) == ""){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.contact-phone-error').show();

}else if(!Number(jQuery('#phone').val())){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.contact-phone-error').show();
  jQuery('.resort-phone-error').html('(phone field requires numeric data only)');
}else if(jQuery.trim(jQuery('#subject').val()) == "" ){
  jQuery('#subject').css('border', 'solid 1px red');
  jQuery('.contact-subject-error').show();
  jQuery('.contact-subject-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#message').val()) == "" ){
  jQuery('#message').css('border', 'solid 1px red');
  jQuery('.contact-message-error').show();
  jQuery('.contact-message-error').html('(*Enter your message)');

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
              jQuery("#contact-btn").prop('disabled', true);
              jQuery(".alert-danger").hide();
              jQuery(".alert-success").show();
              jQuery(".alert-success").html(data.message); 
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

});
</script>
    </head>
    <body class="page-template page-template-elementor_header_footer page page-id-569 wp-embed-responsive foxuries-full-width-content foxuries-footer-builder elementor-default elementor-template-full-width elementor-kit-75 elementor-page elementor-page-569">
		@include('inc.header1')

<div class="foxuries-breadcrumb">
    <h1 class="breadcrumb-heading">
    Contact Us	</h1>
    
    </div>
    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div data-elementor-type="wp-page" data-elementor-id="569" class="elementor elementor-569" data-elementor-settings="[]">
    <div class="elementor-inner">
    <div class="elementor-section-wrap">
    <div class="elementor-element elementor-element-498ac01 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="498ac01" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-background-overlay"></div>
    <div class="elementor-container elementor-column-gap-no">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-e634fa2 elementor-column elementor-col-50 elementor-top-column" data-id="e634fa2" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-023f373 elementor-widget elementor-widget-heading" data-id="023f373" data-element_type="widget" data-widget_type="heading.default">
    <div class="elementor-widget-container">
    <h1 class="elementor-heading-title elementor-size-default">Get in touch</h1> </div>
    </div>
    <div class="elementor-element elementor-element-82dee8c elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="82dee8c" data-element_type="widget" data-widget_type="text-editor.default">
    <div class="elementor-widget-container">
    <div class="elementor-text-editor elementor-clearfix">
        @foreach ($contents as $content)
            @if ($content->name == "contact_us")
                {!!$content->value!!}
            @endif
        @endforeach
       </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-746ad5e elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="746ad5e" data-element_type="section">
    <div class="elementor-container elementor-column-gap-no">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-87a22e3 elementor-column elementor-col-50 elementor-inner-column" data-id="87a22e3" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-1f5176d elementor-view-default elementor-widget elementor-widget-icon" data-id="1f5176d" data-element_type="widget" data-widget_type="icon.default">
    <div class="elementor-widget-container">
    <div class="elementor-icon-wrapper">
    <div class="elementor-icon">
    <i aria-hidden="true" class="foxuries-icon- foxuries-icon-map-marker-alt"></i> </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-7db8541 elementor-widget elementor-widget-text-editor" data-id="7db8541" data-element_type="widget" data-widget_type="text-editor.default">
    <div class="elementor-widget-container">
    <div class="elementor-text-editor elementor-clearfix">ADDRESS</div>
    </div>
    </div>
    <div class="elementor-element elementor-element-f38291a elementor-widget elementor-widget-heading" data-id="f38291a" data-element_type="widget" data-widget_type="heading.default">
    <div class="elementor-widget-container">
    <h3 class="elementor-heading-title elementor-size-default">{{$settings[0]->address}}</h3> </div>
    </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-0d0da7c elementor-column elementor-col-50 elementor-inner-column" data-id="0d0da7c" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-43cc670 elementor-view-default elementor-widget elementor-widget-icon" data-id="43cc670" data-element_type="widget" data-widget_type="icon.default">
    <div class="elementor-widget-container">
    <div class="elementor-icon-wrapper">
    <div class="elementor-icon">
    <i aria-hidden="true" class="foxuries-icon- foxuries-icon-mobile"></i> </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-4e5f3bf elementor-widget elementor-widget-text-editor" data-id="4e5f3bf" data-element_type="widget" data-widget_type="text-editor.default">
    <div class="elementor-widget-container">
    <div class="elementor-text-editor elementor-clearfix">PHONE</div>
    </div>
    </div>
    <div class="elementor-element elementor-element-42f8a5e elementor-widget elementor-widget-heading" data-id="42f8a5e" data-element_type="widget" data-widget_type="heading.default">
    <div class="elementor-widget-container">
    <h3 class="elementor-heading-title elementor-size-default">{{$settings[0]->tel}}<br> {{$settings[0]->phone}}</h3> </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-9e38113 elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="9e38113" data-element_type="section">
    <div class="elementor-container elementor-column-gap-no">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-0031a2d elementor-column elementor-col-50 elementor-inner-column" data-id="0031a2d" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-e52fdb8 elementor-view-default elementor-widget elementor-widget-icon" data-id="e52fdb8" data-element_type="widget" data-widget_type="icon.default">
    <div class="elementor-widget-container">
    <div class="elementor-icon-wrapper">
    <div class="elementor-icon">
    <i aria-hidden="true" class="foxuries-icon- foxuries-icon-envelope"></i> </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-7325a03 elementor-widget elementor-widget-text-editor" data-id="7325a03" data-element_type="widget" data-widget_type="text-editor.default">
    <div class="elementor-widget-container">
    <div class="elementor-text-editor elementor-clearfix">EMAIL</div>
    </div>
    </div>
    <div class="elementor-element elementor-element-47c80ef elementor-widget elementor-widget-heading" data-id="47c80ef" data-element_type="widget" data-widget_type="heading.default">
    <div class="elementor-widget-container">
    <h3 class="elementor-heading-title elementor-size-default">{{$settings[0]->email}}</h3> </div>
    </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-4bcc610 elementor-column elementor-col-50 elementor-inner-column" data-id="4bcc610" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-50b2df2 elementor-view-default elementor-widget elementor-widget-icon" data-id="50b2df2" data-element_type="widget" data-widget_type="icon.default">
    <div class="elementor-widget-container">
    <div class="elementor-icon-wrapper">
    <div class="elementor-icon">
    <i aria-hidden="true" class="foxuries-icon- foxuries-icon-clock"></i> </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-7b9ef38 elementor-widget elementor-widget-text-editor" data-id="7b9ef38" data-element_type="widget" data-widget_type="text-editor.default">
    <div class="elementor-widget-container">
    
    </div>
    </div>
    <div class="elementor-element elementor-element-a08ab71 elementor-widget elementor-widget-heading" data-id="a08ab71" data-element_type="widget" data-widget_type="heading.default">
    
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-2205447 elementor-column elementor-col-50 elementor-top-column" data-id="2205447" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-c940480 elementor-widget elementor-widget-heading" data-id="c940480" data-element_type="widget" data-widget_type="heading.default">
     <div class="elementor-widget-container">
    <h1 class="elementor-heading-title elementor-size-default">Send us a message</h1> </div>
    </div>
    <div class="elementor-element elementor-element-1630982 elementor-widget elementor-widget-text-editor" data-id="1630982" data-element_type="widget" data-widget_type="text-editor.default">
    <div class="elementor-widget-container">
    <div class="elementor-text-editor elementor-clearfix"><p>If you have any concerns please do not hesitate to send us a message</p></div>
    </div>
    </div>
    <div class="elementor-element elementor-element-46d032b elementor-widget elementor-widget-foxuries-contactform" data-id="46d032b" data-element_type="widget" data-widget_type="foxuries-contactform.default">
    <div class="elementor-widget-container">
    <div role="form" class="wpcf7" id="wpcf7-f5-p569-o1" lang="en-US" dir="ltr">
    <div class="screen-reader-response" role="alert" aria-live="polite"></div>
    <form id="contact-form" action="{{ action('App\Http\Controllers\AjaxRequestController@post_contact_message') }}" method="post" class="wpcf7-form init" >
    
    <div><span class="wpcf7-form-control-wrap your-name">
        <span style="color: red; display: none" class="contact-name-error">(*Required)</span>
    <input type="text" name="name" id="name" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" placeholder="Your name" />
</span></div>
    <div class="row">
    <div class="column-6"><span class="wpcf7-form-control-wrap your-email">
        <span style="color: red; display: none" class="contact-email-error">(*Required)</span>
<input type="email" name="email" id="email" placeholder="Your Email" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" />
</span></div>
    <div class="column-6"><span class="wpcf7-form-control-wrap phone-number">
        <span style="color: red; display: none" class="contact-phone-error">(*Required)</span>
<input type="tel" name="phone" id="phone" placeholder="Phone Number" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" />
</span></div>
    </div>
    <div><span class="wpcf7-form-control-wrap your-subject">
        <span style="color: red; display: none" class="contact-subject-error">(*Required)</span>
    <input type="text" name="subject" id="subject" placeholder="Enter Subject" size="40" class="wpcf7-form-control wpcf7-text" />
    </span></div>
    <div><span class="wpcf7-form-control-wrap your-message">
        <span style="color: red; display: none" class="contact-message-error">(*Required)</span>
    <textarea name="message" id="message" cols="40" rows="6" class="wpcf7-form-control wpcf7-textarea" placeholder="Your Messages"></textarea></span></div>
    <div><button class=" button alt btn req-btn" type="submit" id="contact-btn"><i class="foxuries-icon-long-arrow-right"></i><span>Send Message</span></button>
    <span class="alert alert-danger" style="display: none"></span><span class="alert alert-success" style="display: none"></span>
    </div>
    
</form></div> </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="elementor-element elementor-element-63fa781 elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="63fa781" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
    <div class="elementor-container elementor-column-gap-no">
    <div class="elementor-row">
    <div class="elementor-element elementor-element-502d148 elementor-column elementor-col-100 elementor-top-column" data-id="502d148" data-element_type="column">
    <div class="elementor-column-wrap  elementor-element-populated">
    <div class="elementor-widget-wrap">
    <div class="elementor-element elementor-element-914fe57 elementor-widget elementor-widget-google_maps" data-id="914fe57" data-element_type="widget" data-widget_type="google_maps.default">
    <div class="elementor-widget-container">
    <div class="elementor-custom-embed">
        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{$settings[0]->address}}&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near" aria-label="{{$settings[0]->address}}"></iframe></div> </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    @include('inc.footer1')
		<script src="{{ asset('wp-content/cache/min/1/26ca0b884dacc351c317d05fa6222447.js') }}" data-minify="1" defer></script>
		@endsection