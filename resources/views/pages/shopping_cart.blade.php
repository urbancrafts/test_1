@extends('layouts.app1')

      @section('content')
		<!-- Page loader -->
	    <style id='foxuries-style-inline-css' type='text/css'>
            div.foxuries-shop{
              max-height: 200px;
              background-repeat: no-repeat;
              background-position: center bottom -10px ;
              background-image: url({{ asset('storage/img/bg/banner2.png') }});   
            }
            </style>
  <link rel="stylesheet" href="{{asset('shopping/css/bootstrap.min.css')}}">
    
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('shopping/css/font-awesome.min.css')}}">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{asset('shopping/css/owl.carousel.css')}}">
  <link rel="stylesheet" href="{{asset('shopping/style.css')}}">
  <link rel="stylesheet" href="{{asset('shopping/css/responsive.css')}}">
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
   
        Cart
    
    	</h1>

    
</div>
    

<div class="single-product-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
      <div class="row">



        <div class="col-md-8">
          <div class="product-content-right">
              <div class="woocommerce">
                  <form method="post" action="#">
                      <table cellspacing="0" class="shop_table cart">
                          <thead>
                              <tr>
                                  <th class="product-remove">&nbsp;</th>
                                  <th class="product-thumbnail">&nbsp;</th>
                                  <th class="product-name">Product</th>
                                  <th class="product-price">Price</th>
                                  <th class="product-quantity">Quantity</th>
                                  <th class="product-subtotal">Total</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr class="cart_item">
                                  <td class="product-remove">
                                      <a title="Remove this item" class="remove" href="#">×</a> 
                                  </td>

                                  <td class="product-thumbnail">
                                      <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="img/product-thumb-2.jpg"></a>
                                  </td>

                                  <td class="product-name">
                                      <a href="single-product.html">Ship Your Idea</a> 
                                  </td>

                                  <td class="product-price">
                                      <span class="amount">£15.00</span> 
                                  </td>

                                  <td class="product-quantity">
                                      <div class="quantity buttons_added">
                                          <input type="button" class="minus" value="-">
                                          <input type="number" size="4" class="input-text qty text" title="Qty" value="1" min="0" step="1">
                                          <input type="button" class="plus" value="+">
                                      </div>
                                  </td>

                                  <td class="product-subtotal">
                                      <span class="amount">£15.00</span> 
                                  </td>
                              </tr>
                              <tr>
                                  <td class="actions" colspan="6">
                                      <div class="coupon">
                                          <label for="coupon_code">Coupon:</label>
                                          <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">
                                          <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                      </div>
                                      <input type="submit" value="Update Cart" name="update_cart" class="button">
                                      <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </form>

                  <div class="cart-collaterals">


                  <div class="cross-sells">
                      <h2>You may be interested in...</h2>
                      <ul class="products">
                          <li class="product">
                              <a href="single-product.html">
                                  <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-2.jpg">
                                  <h3>Ship Your Idea</h3>
                                  <span class="price"><span class="amount">£20.00</span></span>
                              </a>

                              <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                          </li>

                          <li class="product">
                              <a href="single-product.html">
                                  <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-4.jpg">
                                  <h3>Ship Your Idea</h3>
                                  <span class="price"><span class="amount">£20.00</span></span>
                              </a>

                              <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                          </li>
                      </ul>
                  </div>


                  <div class="cart_totals ">
                      <h2>Cart Totals</h2>

                      <table cellspacing="0">
                          <tbody>
                              <tr class="cart-subtotal">
                                  <th>Cart Subtotal</th>
                                  <td><span class="amount">£15.00</span></td>
                              </tr>

                              <tr class="shipping">
                                  <th>Shipping and Handling</th>
                                  <td>Free Shipping</td>
                              </tr>

                              <tr class="order-total">
                                  <th>Order Total</th>
                                  <td><strong><span class="amount">£15.00</span></strong> </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>


                  <form method="post" action="#" class="shipping_calculator">
                      <h2><a class="shipping-calculator-button" data-toggle="collapse" href="#calcalute-shipping-wrap" aria-expanded="false" aria-controls="calcalute-shipping-wrap">Calculate Shipping</a></h2>

                      <section id="calcalute-shipping-wrap" class="shipping-calculator-form collapse">

                      <p class="form-row form-row-wide">
                      <select rel="calc_shipping_state" class="country_to_state" id="calc_shipping_country" name="calc_shipping_country">
                          <option value="">Select a country…</option>
                          <option value="AX">Åland Islands</option>
                          <option value="AF">Afghanistan</option>
                          <option value="AL">Albania</option>
                          <option value="DZ">Algeria</option>
                          <option value="AD">Andorra</option>
                          <option value="AO">Angola</option>
                          <option value="AI">Anguilla</option>
                          <option value="AQ">Antarctica</option>
                          <option value="AG">Antigua and Barbuda</option>
                          <option value="AR">Argentina</option>
                          <option value="AM">Armenia</option>
                          <option value="AW">Aruba</option>
                          <option value="AU">Australia</option>
                          <option value="AT">Austria</option>
                          <option value="AZ">Azerbaijan</option>
                          <option value="BS">Bahamas</option>
                          <option value="BH">Bahrain</option>
                          <option value="BD">Bangladesh</option>
                          <option value="BB">Barbados</option>
                          <option value="BY">Belarus</option>
                          <option value="PW">Belau</option>
                          <option value="BE">Belgium</option>
                          <option value="BZ">Belize</option>
                          <option value="BJ">Benin</option>
                          <option value="BM">Bermuda</option>
                          <option value="BT">Bhutan</option>
                          <option value="BO">Bolivia</option>
                          <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                          <option value="BA">Bosnia and Herzegovina</option>
                          <option value="BW">Botswana</option>
                          <option value="BV">Bouvet Island</option>
                          <option value="BR">Brazil</option>
                          <option value="IO">British Indian Ocean Territory</option>
                          <option value="VG">British Virgin Islands</option>
                          <option value="BN">Brunei</option>
                          <option value="BG">Bulgaria</option>
                          <option value="BF">Burkina Faso</option>
                          <option value="BI">Burundi</option>
                          <option value="KH">Cambodia</option>
                          <option value="CM">Cameroon</option>
                          <option value="CA">Canada</option>
                          <option value="CV">Cape Verde</option>
                          <option value="KY">Cayman Islands</option>
                          <option value="CF">Central African Republic</option>
                          <option value="TD">Chad</option>
                          <option value="CL">Chile</option>
                          <option value="CN">China</option>
                          <option value="CX">Christmas Island</option>
                          <option value="CC">Cocos (Keeling) Islands</option>
                          <option value="CO">Colombia</option>
                          <option value="KM">Comoros</option>
                          <option value="CG">Congo (Brazzaville)</option>
                          <option value="CD">Congo (Kinshasa)</option>
                          <option value="CK">Cook Islands</option>
                          <option value="CR">Costa Rica</option>
                          <option value="HR">Croatia</option>
                          <option value="CU">Cuba</option>
                          <option value="CW">CuraÇao</option>
                          <option value="CY">Cyprus</option>
                          <option value="CZ">Czech Republic</option>
                          <option value="DK">Denmark</option>
                          <option value="DJ">Djibouti</option>
                          <option value="DM">Dominica</option>
                          <option value="DO">Dominican Republic</option>
                          <option value="EC">Ecuador</option>
                          <option value="EG">Egypt</option>
                          <option value="SV">El Salvador</option>
                          <option value="GQ">Equatorial Guinea</option>
                          <option value="ER">Eritrea</option>
                          <option value="EE">Estonia</option>
                          <option value="ET">Ethiopia</option>
                          <option value="FK">Falkland Islands</option>
                          <option value="FO">Faroe Islands</option>
                          <option value="FJ">Fiji</option>
                          <option value="FI">Finland</option>
                          <option value="FR">France</option>
                          <option value="GF">French Guiana</option>
                          <option value="PF">French Polynesia</option>
                          <option value="TF">French Southern Territories</option>
                          <option value="GA">Gabon</option>
                          <option value="GM">Gambia</option>
                          <option value="GE">Georgia</option>
                          <option value="DE">Germany</option>
                          <option value="GH">Ghana</option>
                          <option value="GI">Gibraltar</option>
                          <option value="GR">Greece</option>
                          <option value="GL">Greenland</option>
                          <option value="GD">Grenada</option>
                          <option value="GP">Guadeloupe</option>
                          <option value="GT">Guatemala</option>
                          <option value="GG">Guernsey</option>
                          <option value="GN">Guinea</option>
                          <option value="GW">Guinea-Bissau</option>
                          <option value="GY">Guyana</option>
                          <option value="HT">Haiti</option>
                          <option value="HM">Heard Island and McDonald Islands</option>
                          <option value="HN">Honduras</option>
                          <option value="HK">Hong Kong</option>
                          <option value="HU">Hungary</option>
                          <option value="IS">Iceland</option>
                          <option value="IN">India</option>
                          <option value="ID">Indonesia</option>
                          <option value="IR">Iran</option>
                          <option value="IQ">Iraq</option>
                          <option value="IM">Isle of Man</option>
                          <option value="IL">Israel</option>
                          <option value="IT">Italy</option>
                          <option value="CI">Ivory Coast</option>
                          <option value="JM">Jamaica</option>
                          <option value="JP">Japan</option>
                          <option value="JE">Jersey</option>
                          <option value="JO">Jordan</option>
                          <option value="KZ">Kazakhstan</option>
                          <option value="KE">Kenya</option>
                          <option value="KI">Kiribati</option>
                          <option value="KW">Kuwait</option>
                          <option value="KG">Kyrgyzstan</option>
                          <option value="LA">Laos</option>
                          <option value="LV">Latvia</option>
                          <option value="LB">Lebanon</option>
                          <option value="LS">Lesotho</option>
                          <option value="LR">Liberia</option>
                          <option value="LY">Libya</option>
                          <option value="LI">Liechtenstein</option>
                          <option value="LT">Lithuania</option>
                          <option value="LU">Luxembourg</option>
                          <option value="MO">Macao S.A.R., China</option>
                          <option value="MK">Macedonia</option>
                          <option value="MG">Madagascar</option>
                          <option value="MW">Malawi</option>
                          <option value="MY">Malaysia</option>
                          <option value="MV">Maldives</option>
                          <option value="ML">Mali</option>
                          <option value="MT">Malta</option>
                          <option value="MH">Marshall Islands</option>
                          <option value="MQ">Martinique</option>
                          <option value="MR">Mauritania</option>
                          <option value="MU">Mauritius</option>
                          <option value="YT">Mayotte</option>
                          <option value="MX">Mexico</option>
                          <option value="FM">Micronesia</option>
                          <option value="MD">Moldova</option>
                          <option value="MC">Monaco</option>
                          <option value="MN">Mongolia</option>
                          <option value="ME">Montenegro</option>
                          <option value="MS">Montserrat</option>
                          <option value="MA">Morocco</option>
                          <option value="MZ">Mozambique</option>
                          <option value="MM">Myanmar</option>
                          <option value="NA">Namibia</option>
                          <option value="NR">Nauru</option>
                          <option value="NP">Nepal</option>
                          <option value="NL">Netherlands</option>
                          <option value="AN">Netherlands Antilles</option>
                          <option value="NC">New Caledonia</option>
                          <option value="NZ">New Zealand</option>
                          <option value="NI">Nicaragua</option>
                          <option value="NE">Niger</option>
                          <option value="NG">Nigeria</option>
                          <option value="NU">Niue</option>
                          <option value="NF">Norfolk Island</option>
                          <option value="KP">North Korea</option>
                          <option value="NO">Norway</option>
                          <option value="OM">Oman</option>
                          <option value="PK">Pakistan</option>
                          <option value="PS">Palestinian Territory</option>
                          <option value="PA">Panama</option>
                          <option value="PG">Papua New Guinea</option>
                          <option value="PY">Paraguay</option>
                          <option value="PE">Peru</option>
                          <option value="PH">Philippines</option>
                          <option value="PN">Pitcairn</option>
                          <option value="PL">Poland</option>
                          <option value="PT">Portugal</option>
                          <option value="QA">Qatar</option>
                          <option value="IE">Republic of Ireland</option>
                          <option value="RE">Reunion</option>
                          <option value="RO">Romania</option>
                          <option value="RU">Russia</option>
                          <option value="RW">Rwanda</option>
                          <option value="ST">São Tomé and Príncipe</option>
                          <option value="BL">Saint Barthélemy</option>
                          <option value="SH">Saint Helena</option>
                          <option value="KN">Saint Kitts and Nevis</option>
                          <option value="LC">Saint Lucia</option>
                          <option value="SX">Saint Martin (Dutch part)</option>
                          <option value="MF">Saint Martin (French part)</option>
                          <option value="PM">Saint Pierre and Miquelon</option>
                          <option value="VC">Saint Vincent and the Grenadines</option>
                          <option value="SM">San Marino</option>
                          <option value="SA">Saudi Arabia</option>
                          <option value="SN">Senegal</option>
                          <option value="RS">Serbia</option>
                          <option value="SC">Seychelles</option>
                          <option value="SL">Sierra Leone</option>
                          <option value="SG">Singapore</option>
                          <option value="SK">Slovakia</option>
                          <option value="SI">Slovenia</option>
                          <option value="SB">Solomon Islands</option>
                          <option value="SO">Somalia</option>
                          <option value="ZA">South Africa</option>
                          <option value="GS">South Georgia/Sandwich Islands</option>
                          <option value="KR">South Korea</option>
                          <option value="SS">South Sudan</option>
                          <option value="ES">Spain</option>
                          <option value="LK">Sri Lanka</option>
                          <option value="SD">Sudan</option>
                          <option value="SR">Suriname</option>
                          <option value="SJ">Svalbard and Jan Mayen</option>
                          <option value="SZ">Swaziland</option>
                          <option value="SE">Sweden</option>
                          <option value="CH">Switzerland</option>
                          <option value="SY">Syria</option>
                          <option value="TW">Taiwan</option>
                          <option value="TJ">Tajikistan</option>
                          <option value="TZ">Tanzania</option>
                          <option value="TH">Thailand</option>
                          <option value="TL">Timor-Leste</option>
                          <option value="TG">Togo</option>
                          <option value="TK">Tokelau</option>
                          <option value="TO">Tonga</option>
                          <option value="TT">Trinidad and Tobago</option>
                          <option value="TN">Tunisia</option>
                          <option value="TR">Turkey</option>
                          <option value="TM">Turkmenistan</option>
                          <option value="TC">Turks and Caicos Islands</option>
                          <option value="TV">Tuvalu</option>
                          <option value="UG">Uganda</option>
                          <option value="UA">Ukraine</option>
                          <option value="AE">United Arab Emirates</option>
                          <option selected="selected" value="GB">United Kingdom (UK)</option>
                          <option value="US">United States (US)</option>
                          <option value="UY">Uruguay</option>
                          <option value="UZ">Uzbekistan</option>
                          <option value="VU">Vanuatu</option>
                          <option value="VA">Vatican</option>
                          <option value="VE">Venezuela</option>
                          <option value="VN">Vietnam</option>
                          <option value="WF">Wallis and Futuna</option>
                          <option value="EH">Western Sahara</option>
                          <option value="WS">Western Samoa</option>
                          <option value="YE">Yemen</option>
                          <option value="ZM">Zambia</option>
                          <option value="ZW">Zimbabwe</option>
                      </select>
                      </p>

                      <p class="form-row form-row-wide"><input type="text" id="calc_shipping_state" name="calc_shipping_state" placeholder="State / county" value="" class="input-text"> </p>

                      <p class="form-row form-row-wide"><input type="text" id="calc_shipping_postcode" name="calc_shipping_postcode" placeholder="Postcode / Zip" value="" class="input-text"></p>


                      <p><button class="button" value="1" name="calc_shipping" type="submit">Update Totals</button></p>

                      </section>
                  </form>


                  </div>
              </div>                        
          </div>                    
      </div>


          <div class="col-md-4">
              
              
              <div class="single-sidebar">
                  <h2 class="sidebar-title">Products</h2>
                  <div class="thubmnail-recent">
                      <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                      <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                      <div class="product-sidebar-price">
                          <ins>$700.00</ins> <del>$800.00</del>
                      </div>                             
                  </div>
                  <div class="thubmnail-recent">
                      <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                      <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                      <div class="product-sidebar-price">
                          <ins>$700.00</ins> <del>$800.00</del>
                      </div>                             
                  </div>
                  <div class="thubmnail-recent">
                      <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                      <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                      <div class="product-sidebar-price">
                          <ins>$700.00</ins> <del>$800.00</del>
                      </div>                             
                  </div>
                  <div class="thubmnail-recent">
                      <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                      <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                      <div class="product-sidebar-price">
                          <ins>$700.00</ins> <del>$800.00</del>
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