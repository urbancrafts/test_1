<!-- google map area end -->

<div id="zoomInDown1" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="modal-login-form-inner">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="alert alert-danger login-alert-error" style="display: none"></span>
                            <span class="alert alert-success login-status" style="display: none"></span>
                            <div class="basic-login-inner modal-basic-inner">
                                
                                
                                <form id="model-request-form" action="{{ action('App\Http\Controllers\API\RegisterController@login') }}" method="POST">
                                    <h3>Login Form</h3>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="login2">Email:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="email" id="login-email" class="form-control wpcf7-form-control" placeholder="Email Address" name="login-email"   />
                                                <span class="require-name"></span>
                                                
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="login2">Password:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="password" id="login-password" class="form-control wpcf7-form-control" placeholder="Password" name="login-password" />
                                                <span class="require-email"></span>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                    <div class="login-btn-inner">
                                        
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="login-horizental">
                                                    <a href="#" class=" alt btn req-btn" id="recover-link" title="Click to recover your password">Forgot your password?</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="login-horizental">
                                                    <button class=" button alt btn req-btn" type="submit">Login</button>    | <a href="#" class=" alt btn req-btn" id="signup-link" title="Click this link to create an account">Signup</a>
                                                </div> 

                                            </div>
                                            
                                            
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            
                                            <span id="login-status"></span>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-8">
                                             
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </form>

                                <form id="recover-form" action="{{ action('App\Http\Controllers\API\RegisterController@forgot_password') }}" method="POST" style="display: none">
                                    <h4>Enter your email address to receive an OTP code.</h4>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="login2">Email:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="email" id="email" class="form-control wpcf7-form-control" placeholder="Email Address" name="email"   />
                                                <span class="require-email"></span>
                                                
                                            </div>
                                        </div>

                                        <div class="login-btn-inner">
                                        
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="login-horizental">
                                                        <a href="#" class=" alt btn req-btn" id="login-recocer-link">Login</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="login-horizental">
                                                        <button class=" button alt btn req-btn" type="submit">Submit</button>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form id="mem_signup" action="{{ action('App\Http\Controllers\API\RegisterController@register') }}" method="post" class="wpcf7-form init"  style="display: none">
                
                                    <h3>Signup Form</h3>
                                    <input type="hidden" id="site_url">
                                 
                                <div class="row">
                                <div class="column-6"><span class="wpcf7-form-control-wrap your-first-name"><input type="text" name="first_name" id="first_name"  size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" placeholder="First name"  /></span></div>
                                <div class="column-6"><span class="wpcf7-form-control-wrap your-last-name"><input type="text" name="last_name" id="last_name"  size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" placeholder="Last name" /></span></div>
                                </div>
                                <div class="row">
                                <div class="column-6"><span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" id="email" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" placeholder="Email" /></span></div>
                                <div class="column-6"><span class="wpcf7-form-control-wrap phone-number"><input type="tel" name="phone" id="phone" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" placeholder="phone number" /></span></div>
                                </div>
                                <div class="row">
                                <div class="column-6"><span class="wpcf7-form-control-wrap your-password"><input type="password" name="password" id="pass"  size="40" class="wpcf7-form-control wpcf7-text" placeholder="Password" /></span></div>
                                <div class="column-6"><span class="wpcf7-form-control-wrap your-cofirm-password"><input type="password" name="cpassword" id="cpass"  size="40" class="wpcf7-form-control wpcf7-text" placeholder="Confirm password" /></span></div>
                                </div>

                                <div>
                                    <fieldset>

                                        <legend class="account-type-header">User Account Type</legend>

                                        <div><span class="wpcf7-form-control-wrap your-name">
                                            <select id="account_type" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required">
                                            <option value="Customer" selected>Customer Account</option>
                                            <option value="Business">Business Account</option>
                                            </select>
                                            </span></div> 

                                      </fieldset>
                                    
                                    </div>
                                <div><span><input type="checkbox" id="terms" style="right:80px !important;"  />Check this box if you've read and agreed with our <a href="{{url('pages/terms')}}">terms</a> and <a href="{{url('pages/privacy')}}">privacy</a>.</span></div>
                                
                                <div>
                                      
                                    <button type="submit" class="button" id="register-btn" disabled><i class="foxuries-icon-long-arrow-right"></i> <span>Signup</span></button>
                                    <a href="#" class=" alt btn req-btn" id="sign-in-link" title="Click to go back to signin">Signin</a>
                                </div><br />
                               
                            </form>
                            
                            <form id="otp-form" action="{{ action('App\Http\Controllers\API\RegisterController@verify_email_code') }}" method="post" class="wpcf7-form init"  style="display: none">
                            


                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>