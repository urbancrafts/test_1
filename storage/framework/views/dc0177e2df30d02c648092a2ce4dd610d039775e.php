

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->

<style type="text/css">
body {
    
}


.payment-option {
    
    
    margin: -200;
    padding: 0;
    
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-line-pack: center;
        align-content: center;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    
    -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    font-family: 'Raleway';
}
.payment-option ul li{
    float: left !important;
}
.req-btn{
    color: aliceblue !important;
}
</style>

<link rel="stylesheet" href="<?php echo e(asset('payment/css/style.css')); ?>">


           <script src="<?php echo e(asset('payment/js/jquery.min2.js')); ?>"></script>

     	  <script src="<?php echo e(asset('payment/js/bootstrap.js')); ?> "></script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <!--<script src="https://apis.google.com/js/platform.js" async defer></script>-->
    	  <script src="<?php echo e(asset('payment/js/creditCardValidator.js')); ?>"></script>   


<script type="text/javascript">

function createTransactionRecord(trn_type,ref_id,gateway,name,email,phone,user_id,curr,amount,status,msg){
                     jQuery.ajax({
                     headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                      type:"POST",
                      url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@create_subscription_transaction_record')); ?>",
                      dataType: "json",
                      data: {'trn_type': trn_type, 'ref_id': ref_id, 'gateway': gateway, 'name': name, 'email': email, 'phone': phone, 'user_id': user_id, 'curr': curr, 'amount': amount, 'status': status, 'msg': msg},
                      beforeSend: function(){
                          //jQuery("#cardSubmitBtn").prop('disabled', true);
                          //jQuery("#cardSubmitBtn").val('Processing....');
                      },
                      success:function(data){
                          if(data.success == true){
                           window.location = "<?php echo e(url('member_dashboard')); ?>/"+user_id; 
                          }else{
                              alert('Error occured trying to create transaction record');
                              //jQuery("#cardSubmitBtn").prop('disabled', false);
                              //jQuery("#cardSubmitBtn").val('Proceed');
                              //jQuery('#paymentSection').prepend('<p class="status-msg error">Transaction has been failed, please try again.</p>');
                          }
                      }
                  });
            
}


function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_test_59f0ea3fedf1c45ca7559d443f19810fe34f04f8',
      email: "<?php echo e(Auth::user()->email); ?>",
      amount: <?php echo e($settings[0]->membership_fee); ?> * 100,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo e(Auth::user()->name); ?>",
                variable_name: "mobile_number",
                value: "+234<?php echo e(Auth::user()->phone); ?>"
            }
         ]
      },
      callback: function(response){
          
          createTransactionRecord('Membership',response.reference,'paystack','<?php echo e(Auth::user()->name); ?>','<?php echo e(Auth::user()->email); ?>','<?php echo e(Auth::user()->phone); ?>','<?php echo e(Auth::user()->id); ?>','<?php echo e($settings[0]->curr); ?>','<?php echo e($settings[0]->membership_fee); ?>','success','test transaction');
          alert('success. transaction ref is ' + response.reference);     
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }

    function cardFormValidate(){
          var cardValid = 0;
          
          //Card validation
          jQuery('#card_number').validateCreditCard(function(result) {
              var cardType = (result.card_type == null)?'':result.card_type.name;
              if(cardType == 'Visa'){
                  var backPosition = result.valid?'2px -163px, 260px -87px':'2px -163px, 260px -61px';
              }else if(cardType == 'MasterCard'){
                  var backPosition = result.valid?'2px -247px, 260px -87px':'2px -247px, 260px -61px';
              }else if(cardType == 'Maestro'){
                  var backPosition = result.valid?'2px -289px, 260px -87px':'2px -289px, 260px -61px';
              }else if(cardType == 'Discover'){
                  var backPosition = result.valid?'2px -331px, 260px -87px':'2px -331px, 260px -61px';
              }else if(cardType == 'Amex'){
                  var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
              }else{
                  var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
              }
              jQuery('#card_number').css("background-position", backPosition);
              if(result.valid){
                jQuery("#card_type").val(cardType);
                jQuery("#card_number").removeClass('required');
                  cardValid = 1;
              }else{
                jQuery("#card_type").val('');
                jQuery("#card_number").addClass('required');
                  cardValid = 0;
              }
          });
          
          //Form validation
          var cardName = jQuery("#name_on_card").val();
          var expMonth = jQuery("#expiry_month").val();
          var expYear = jQuery("#expiry_year").val();
          var cvv = jQuery("#cvv").val();
          var regName = /^[a-z ,.'-]+$/i;
          var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
          var regYear = /^2016|2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
          var regCVV = /^[0-9]{3,3}$/;
          if (cardValid == 0) {
            jQuery("#card_number").addClass('required');
            jQuery("#card_number").focus();
              return false;
          }else if (!regMonth.test(expMonth)) {
            jQuery("#card_number").removeClass('required');
            jQuery("#expiry_month").addClass('required');
            jQuery("#expiry_month").focus();
              return false;
          }else if (!regYear.test(expYear)) {
            jQuery("#card_number").removeClass('required');
            jQuery("#expiry_month").removeClass('required');
            jQuery("#expiry_year").addClass('required');
            jQuery("#expiry_year").focus();
              return false;
          }else if (!regCVV.test(cvv)) {
            jQuery("#card_number").removeClass('required');
            jQuery("#expiry_month").removeClass('required');
            jQuery("#expiry_year").removeClass('required');
            jQuery("#cvv").addClass('required');
            jQuery("#cvv").focus();
              return false;
          }else if (!regName.test(cardName)) {
            jQuery("#card_number").removeClass('required');
            jQuery("#expiry_month").removeClass('required');
            jQuery("#expiry_year").removeClass('required');
            jQuery("#cvv").removeClass('required');
            jQuery("#name_on_card").addClass('required');
            jQuery("#name_on_card").focus();
              return false;
          }else{
            jQuery("#card_number").removeClass('required');
            jQuery("#expiry_month").removeClass('required');
            jQuery("#expiry_year").removeClass('required');
            jQuery("#cvv").removeClass('required');
            jQuery("#name_on_card").removeClass('required');
            jQuery('#cardSubmitBtn').prop('disabled', false);  
              return true;
          }
      }
        
      jQuery(document).ready(function() {

          //Demo card numbers
          jQuery('.card-payment .numbers li').wrapInner('<a href="javascript:void(0);"></a>').click(function(e) {
            e.preventDefault();
            jQuery('.card-payment .numbers').slideUp(100);
            cardFormValidate()
            return jQuery('#card_number').val(jQuery(this).text()).trigger('input');
          });
          jQuery('body').click(function() {
            return jQuery('.card-payment .numbers').slideUp(100);
          });
          jQuery('#sample-numbers-trigger').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            return jQuery('.card-payment .numbers').slideDown(100);
          });
          
          //Card form validation on input fields
          jQuery('#paymentForm input[type=text]').on('keyup',function(){
              cardFormValidate();
          });
          
          //Submit card form
          jQuery("#cardSubmitBtn").on('click',function(){
              if (cardFormValidate()) {
                  var formData = jQuery('#paymentForm').serialize();
                  jQuery.ajax({
                      type:'POST',
                      url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@process_card_payment')); ?>",
                      dataType: "json",
                      data:formData,
                      beforeSend: function(){
                          jQuery("#cardSubmitBtn").prop('disabled', true);
                          jQuery("#cardSubmitBtn").val('Processing....');
                      },
                      success:function(data){
                          if(data.status == 1){
                              jQuery('#paymentSection').html('<p class="status-msg success">The transaction was successful. Order ID: <span>'+data.orderID+'</span></p>');
                          }else{
                              jQuery("#cardSubmitBtn").prop('disabled', false);
                              jQuery("#cardSubmitBtn").val('Proceed');
                              jQuery('#paymentSection').prepend('<p class="status-msg error">Transaction has been failed, please try again.</p>');
                          }
                      }
                  });
              }
          });


    jQuery('input[type=radio][name=gateway]').on('change', function () {
        var getVal = jQuery(this).val();
        if(getVal == "paystack"){
       jQuery('.'+getVal).show();
       jQuery('.paypal').hide();
       jQuery('.interswitch').hide();
        }else if(getVal == "paypal"){
        jQuery('.'+getVal).show();
        jQuery('.paystack').hide();
        jQuery('.interswitch').hide();
        }else if(getVal == "interswitch"){
        jQuery('.'+getVal).show();
        jQuery('.paystack').hide();
        jQuery('.paypal').hide();
        }
        
    
    });

          
      });
    

    
    </script>
    
    </head>
    <body class="hb_room-template-default single single-hb_room postid-50 wp-embed-responsive wp-hotel-booking wp-hotel-booking-room-page has-post-thumbnail foxuries-footer-builder elementor-default elementor-kit-75 elementor-page elementor-page-50">    
    
    <div class="payment-option"><ul><li><img src="<?php echo e(asset('payment/images/paystack.png')); ?>" width="100" /><input type="radio" id="paystack" name="gateway" value="paystack" checked /></li> <li><img src="<?php echo e(asset('payment/images/paypal.png')); ?>" width="100" /><input type="radio" id="paypal" name="gateway" value="paypal" /></li> <li><img src="<?php echo e(asset('payment/images/interswitch.svg')); ?>" width="100" /><input type="radio" id="interswitch" name="gateway" value="interswitch" /></li></ul></div><br />
 <!-- Checkout Start-->
 <div class="login-form-area mg-t-30 mg-b-40">
     
    <div class="container-fluid">
        
        <div class="row">
    
            <div class="card-payment paystack">

             <div id="paymentSection">
                <form class="adminpro-form">
                    <h4>Subscription: Membership fee</h4>
              <h4><?php echo e($settings[0]->curr); ?><?php echo e($settings[0]->membership_fee); ?> / </h4>
                    <script src="https://js.paystack.co/v1/inline.js"></script>
                    <button type="button" onclick="payWithPaystack()" class="alt btn req-btn"> Pay Now</button> 
                  </form>
             </div>
            </div>

            <div class="card-payment paypal" style="display: none">
                <div id="paymentSection">
                    <form method="post" id="paymentForm" class="adminpro-form paypal_payment_form">
                    <div class="row">
                                      <div class="col-lg-12">
                                          <div class="logo">
          
                                              <a href="#"><img src="public/images/credit/mastercard.png" alt="" />
                                              
                                              
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                                  <h4>Subscription: Membership fee</h4>
              <h4><?php echo e($settings[0]->curr); ?><?php echo e($settings[0]->membership_fee); ?> / </h4>
                        <ul>
                            <input type="hidden" name="card_type" id="card_type" value=""/>
                            <li>
                                <input type="hidden" value="" name="gateway" id="gateway" />
                                
                                <input type="hidden" value="<?php echo e($settings[0]->curr); ?>" name="curr" id="curr" />
                                <input type="hidden" value="<?php echo e($settings[0]->membership_fee); ?>" name="amount" id="amount" />
                               
                                <input type="hidden" value="0" name="recurring" id="recurring" />
                                <label for="card_number">Card number</label>
                                
                                <input type="text" placeholder="1234 5678 9012 3456" id="card_number" name="card_number" class="">
                                
                            </li>
                
                            <li class="vertical">
                                <ul>
                                    <li>
                                        <label for="expiry_month">Expiry month</label>
                                        <input type="text" placeholder="MM" maxlength="5" id="expiry_month" name="expiry_month">
                                    </li>
                                    <li>
                                        <label for="expiry_year">Expiry year</label>
                                        <input type="text" placeholder="YYYY" maxlength="5" id="expiry_year" name="expiry_year">
                                    </li>
                                    <li>
                                        <label for="cvv">CVV</label>
                                        <input type="text" placeholder="123" maxlength="3" id="cvv" name="cvv">
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <label for="name_on_card">Name on card</label>
                                <input type="text" placeholder="Codex World" id="name_on_card" name="name_on_card">
                            </li>
                            <li><input type="button" name="card_submit" id="cardSubmitBtn" value="Proceed" class="payment-btn" disabled="true" ></li>
                            <p style="color:#EA0075;">Note: To use this medium, be sure your card/account is valid and eligible for this transaction.</p>
                        </ul>
                    </form>
                  </div>
            </div>

            <div class="card-payment interswitch" style="display: none">
        <div id="paymentSection">
          <form method="post" id="paymentForm" class="adminpro-form">
          <div class="row">
                            <div class="col-lg-12">
                                <div class="logo">

                                    <a href="#"><img src="public/images/credit/mastercard.png" alt="" />
                                    
                                    
                                    </a>
                                </div>
                            </div>
                        </div>
                        <h4>Subscription: Membership fee</h4>
              <h4><?php echo e($settings[0]->curr); ?><?php echo e($settings[0]->membership_fee); ?> / </h4>
              <ul>
                  <input type="hidden" name="card_type" id="card_type" value=""/>
                  <li>
                      <input type="hidden" value="" name="gateway" id="gateway" />
                      
                      <input type="hidden" value="<?php echo e($settings[0]->curr); ?>" name="curr" id="curr" />
                      <input type="hidden" value="<?php echo e($settings[0]->membership_fee); ?>" name="amount" id="amount" />
                      
                      <input type="hidden" value="0" name="recurring" id="recurring" />
                      <label for="card_number">Card number</label>
                      
                      <input type="text" placeholder="1234 5678 9012 3456" id="card_number" name="card_number" class="">
                      
                  </li>
      
                  <li class="vertical">
                      <ul>
                          <li>
                              <label for="expiry_month">Expiry month</label>
                              <input type="text" placeholder="MM" maxlength="5" id="expiry_month" name="expiry_month">
                          </li>
                          <li>
                              <label for="expiry_year">Expiry year</label>
                              <input type="text" placeholder="YYYY" maxlength="5" id="expiry_year" name="expiry_year">
                          </li>
                          <li>
                              <label for="cvv">CVV</label>
                              <input type="text" placeholder="123" maxlength="3" id="cvv" name="cvv">
                          </li>
                      </ul>
                  </li>
                  <li>
                      <label for="name_on_card">Name on card</label>
                      <input type="text" placeholder="Codex World" id="name_on_card" name="name_on_card">
                  </li>
                  <li><input type="button" name="card_submit" id="cardSubmitBtn" value="Proceed" class="payment-btn" disabled="true" ></li>
                  <p style="color:#EA0075;">Note: To use this medium, be sure your card/account is valid and eligible for this transaction.</p>
              </ul>
          </form>
        </div>
    </div>
            
            
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>
<!-- Checkout End-->
</div>
</div>        
   
        
    <script src="<?php echo e(asset('wp-content/cache/min/1/9157e18fa4f35485d82a0174d093076e.js')); ?>" data-minify="1" defer></script>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/membership_payment.blade.php ENDPATH**/ ?>