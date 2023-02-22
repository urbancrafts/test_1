
window.addEventListener('load',function(){
    document.getElementById('fb-login-btn').addEventListener("click",fbLogin);
    document.getElementById('fb-register-btn').addEventListener("click",fbRegistration);
});

window.fbAsyncInit = function() {
    FB.init({
      appId      : '280780920045432',
      cookie     : true,
      xfbml      : true,
      version    : 'v9.0'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

    async function sendRequest(url,data,method){
        console. log(data)
        var csrftoken = $.cookie("csrftoken");
        const response = await fetch(url,{
            method: method ,
            mode:"cors",
            headers:{
                'Content-Type':'application/json',
                'X-CSRFToken' : csrftoken
            },
            body: JSON.stringify(data)

        })
        return response.json();
    }

    function LoginSuccess(SuccessData){
        if(SuccessData.status == 'success'){
            if(decodeURIComponent(window.location).includes("flat/registration-form")){
                window.location.href = '/flat/registration-form';
            }else if(decodeURIComponent(window.location).includes("rent-flat-registration/form/")){
                window.location.href = '/rent-flat-registration/form/';
            }
            else if (decodeURIComponent(window.location).includes("user/account/#user-property")){
                window.location.href = "/user/account#user-property/";
                location.reload();
            }
          else if (decodeURIComponent(window.location).includes("/properties/")) {
            if (
              /\/properties\/[0-9]+/.test(decodeURIComponent(window.location.pathname))
            ) {
              window.location.href = decodeURIComponent(window.location);
            } else {
              window.location.href = "/user/account/";
            }
          }



          else if (
            decodeURIComponent(window.location).includes("/share-flat-details/")
          ) {
            if (
              /\/share-flat-details\/[0-9]+/.test(
                decodeURIComponent(window.location.pathname)
              )
            ) {
              window.location.href = decodeURIComponent(window.location);
            } else {
              window.location.href = "/user/account/";
            }
          }




          else if (
            decodeURIComponent(window.location).includes("/rent-flat-details/")
          ) {
            if (
              /\/rent-flat-details\/[0-9]+/.test(
                decodeURIComponent(window.location.pathname)
              )
            ) {
              window.location.href = decodeURIComponent(window.location);
            } else {
              window.location.href = "/user/account/";
            }
          }



            else{
                window.location.href = '/user/account/';
            }

        }
        else {
            $('#login-error').removeClass('hidden');
            $('#login-error-message').text(SuccessData.message)
            $('#form-user-login').reset

        }
    };

function googleAuthInit() {

gapi.load('auth2', function() {
    // Library loaded.
    var googleAuthObject = gapi.auth2.init({
        client_id: "612801917943-bl54vo9uga6csitm2s5ql512lms806gf.apps.googleusercontent.com"
    });
     attachSignUp(document.getElementById('google-register-btn'));
        attachSignIn(document.getElementById('google-login-btn'));

     function attachSignUp(sign_up_element)
     {
     googleAuthObject.attachClickHandler(sign_up_element, {},
        function(googleUser) {
        googleSignUp(googleUser)
        }, function(error) {
//          alert(JSON.stringify(error, undefined, 2));
        if(error.error==="popup_closed_by_user"){
            $("#error-social-login-message").text("Popup blocked. Please enable or allow the third party cookies to access this application")
        }
       else if(error.error==="access_denied"){
            $("#error-social-login-message").text("Error loggin in. The user denied the permission to the scopes required.")
        }
       else{
            $("#error-social-login-message").html(JSON.stringify(error.error, undefined, 2));
       }

          $("#error-social-login-message").removeClass("hidden");
          setTimeout(function() {
                $("#error-social-login-message").addClass("hidden");
        }, 6000);
        });
     }

     function attachSignIn(sign_in_element)
     {
     googleAuthObject.attachClickHandler(sign_in_element, {},
        function(googleUser) {
        googleLogin(googleUser)
        }, function(error) {
//          alert(JSON.stringify(error, undefined, 2));
  if(error.error==="popup_closed_by_user"){
            $("#error-social-login-message").text("Popup blocked. Please enable or allow the third party cookies to access this application")
        }
  else if(error.error==="access_denied"){
            $("#error-social-login-message").text("Error loggin in. The user denied the permission to the scopes required.")
        }
  else{
        $("#error-social-login-message").html(JSON.stringify(error.error, undefined, 2));
      }
          $("#error-social-login-message").removeClass("hidden");
          setTimeout(function() {
                $("#error-social-login-message").addClass("hidden");
        }, 6000);
        });
     }

  });

}

function userSocialLogin(auth_code,service_name)
{
let method = "POST";
let url = '/login/';
let payload = {is_social_login: true, auth_code: auth_code, service_name: service_name };
console.log(payload);

sendRequest(url,payload,method).then((response) => {
    LoginSuccess(response)
});
}

function googleLogin(googleUser)
{
console.log("google login ");
var profile = googleUser.getBasicProfile();
var email = profile.getEmail();
var f_name = profile.getGivenName();
var l_name = profile.getFamilyName();
var auth_code = googleUser.getAuthResponse().id_token;
console.log(googleUser.getBasicProfile());
$.ajax({
            url: '/registration/email/check/',
            method: 'POST',
            dataType:"json",
            contentType:"application/json",
            data: JSON.stringify({'email':email}),
            success: function (response){
                if(response.status == "success"){
        $('.login-modal').modal("hide");
        $('.register-modal').modal("show");

        if( $('#company-name-register').val().length>0){
        console.log("entered into check api",$('#company-name-register').val().length>0?"yes":"no")
                         $('#user-company').prop("checked", true);
                            $('.user-company-div').removeClass('hidden');
                      }
      else{
      console.log("entered into check api",$('#company-name-register').val().length>0?"yes":"no")
         $('#user-individual').prop("checked", true);
            $('.user-company-div').addClass('hidden');
      }


        $('.social-usertype').addClass('hidden');
        $('.or-sign-up').addClass('hidden');
        $('.radio').removeClass('radio-margin');
        $('.manual-registration').removeClass('hidden');
        $('#password-register').addClass('hidden');
        $('#password-register-label').addClass('hidden');
        $('#registration-modal-phone-register-div').removeClass('hidden');
        $('#registration-modal-user-type-div').removeClass('hidden');
        document.getElementById('first-name-register').value = f_name;
        document.getElementById('last-name-register').value = l_name;
        document.getElementById('email-register').value = email;
        document.getElementById('check-if-social-register').value = 'True';
        document.getElementById('social-register-auth-code').value = auth_code;
        localStorage.setItem('social_register_service_name',"google");
        console.log("user",f_name,l_name,email,auth_code);
                    }
                else {
                console.log("email already registered.. proceed to login");
                userSocialLogin(googleUser.getAuthResponse().id_token,"google");
                    }
            },
            error: function (eResponse) {
            console.log("could not login .. please check login function");
            }
        })

}

//async function fbLogin(){
//   FB.login(function(response) {
//  console.log(response)
//  if( response.authResponse.accessToken ){userSocialLogin(response.authResponse.accessToken,"facebook") }
//}, {scope: 'public_profile,email'})
//};

async function fbLogin()
{
   FB.login(function(fbLoginresponse)
   {
  console.log(fbLoginresponse)
if(fbLoginresponse.status == 'connected')
{

FB.api('/me', {fields: ['first_name','email','last_name']},
            function(fbMeresponse) {
            var f_name = fbMeresponse.first_name;
            var l_name = fbMeresponse.last_name;
            var email = fbMeresponse.email;
            var auth_code = fbLoginresponse.authResponse.accessToken;

$.ajax({
            url: '/registration/email/check/',
            method: 'POST',
            dataType:"json",
            contentType:"application/json",
            data: JSON.stringify({'email':email}),
            success: function (response){
                if(response.status == "success"){
        $('.login-modal').modal("hide");
        $('.register-modal').modal("show");

        if( $('#company-name-register').val().length>0){
        console.log("entered into check api",$('#company-name-register').val().length>0?"yes":"no")
                         $('#user-company').prop("checked", true);
                            $('.user-company-div').removeClass('hidden');
                      }
      else{
      console.log("entered into check api",$('#company-name-register').val().length>0?"yes":"no")
         $('#user-individual').prop("checked", true);
            $('.user-company-div').addClass('hidden');
      }

        $('.social-usertype').addClass('hidden');
        $('.or-sign-up').addClass('hidden');
        $('.radio').removeClass('radio-margin');
        $('.manual-registration').removeClass('hidden');
        $('#password-register').addClass('hidden');
        $('#password-register-label').addClass('hidden');
        $('#registration-modal-phone-register-div').removeClass('hidden');
        $('#registration-modal-user-type-div').removeClass('hidden');
        document.getElementById('first-name-register').value = f_name;
        document.getElementById('last-name-register').value = l_name;
        document.getElementById('email-register').value = email;
        document.getElementById('check-if-social-register').value = 'True';
        document.getElementById('social-register-auth-code').value = auth_code;
        localStorage.setItem('social_register_service_name',"facebook");
        console.log("user",f_name,l_name,email,auth_code);
                    }
                else {
                console.log("email already registered.. proceed to login");
                userSocialLogin(auth_code,"facebook");
                    }
            },
            error: function (eResponse) {
            console.log("could not login .. please check login function");
            }
        })


            });

}
},
{scope: 'public_profile,email'})
}


    function userSocialRegistration(service,auth_code,fname,lname,email) {
        console.log("check email")
        var input_data = {
            'email' : email
        };

        if( $('#company-name-register').val().length>0){
        console.log("entered into check api",$('#company-name-register').val().length>0?"yes":"no")
                         $('#user-company').prop("checked", true);
                            $('.user-company-div').removeClass('hidden');
                      }
      else{
      console.log("entered into check api",$('#company-name-register').val().length>0?"yes":"no")
         $('#user-individual').prop("checked", true);
            $('.user-company-div').addClass('hidden');
      }
        $.ajax({
            url: '/registration/email/check/',
            method: 'POST',
            dataType:"json",
            contentType:"application/json",
            data: JSON.stringify(input_data),
            success: function (response) {
                if(response.status == "success"){
        $('.social-usertype').addClass('hidden');
        $('.or-sign-up').addClass('hidden');
        $('.radio').removeClass('radio-margin');
        $('.manual-registration').removeClass('hidden');
        $('#password-register').addClass('hidden');
        $('#password-register-label').addClass('hidden');
        $('#registration-modal-phone-register-div').removeClass('hidden');
        $('#registration-modal-user-type-div').removeClass('hidden');
        var fname_field = document.getElementById('first-name-register');
        var lname_field = document.getElementById('last-name-register');
        var email_field = document.getElementById('email-register');
        var social_login_field = document.getElementById('check-if-social-register');
        var social_register_auth_code = document.getElementById('social-register-auth-code');
        fname_field.value = fname
        lname_field.value = lname
        email_field.value = email
        social_login_field.value = 'True'
        social_register_auth_code.value = auth_code;
        localStorage.setItem('social_register_service_name',service);
                    return true
                    }
                else {
                    $('#register-messages').removeClass('hidden');
                    $('#reg-msg-value').text(response.message);
                    return false
                }
            },
            error: function (eResponse) {
console.log("could not complete social registration");
console.log(eResponse);
return false
            }
        })
    };

function googleSignUp(googleUser) {
  var profile = googleUser.getBasicProfile();
  var fname = profile.hasOwnProperty('getGivenName()') ? profile.getGivenName() : " "
  var lname = profile.hasOwnProperty('getFamilyName()') ? profile.getFamilyName() : " "
  var email = profile.hasOwnProperty('getEmail()') ? profile.getEmail() : " "
  if( profile.getId() )
  {
  var register_success = userSocialRegistration("google",googleUser.getAuthResponse().id_token,profile.getGivenName(),profile.getFamilyName(),profile.getEmail());
  if( register_success )
  {
var id_token = googleUser.getAuthResponse().id_token;
if(id_token) { userSocialLogin(id_token,"google"); }
  }
  else
  {
  console.log("google registration could not be completed");
  }
  }
  else{
  console.log("Cannot connect with Google")
  }
}

function fbRegistration(){
    FB.login((fbLoginresponse) =>{
        console.log(fbLoginresponse);
        if(fbLoginresponse.status == 'connected')
        {
            FB.api('/me', {fields: ['first_name','email','last_name']},
            function(response) {
            var fname = response.hasOwnProperty('first_name') ? response.first_name : ""
            var lname = response.hasOwnProperty('last_name') ? response.last_name : " "
            var email = response.hasOwnProperty('email') ? response.email : " "
            var register_success = userSocialRegistration("facebook",fbLoginresponse.authResponse.accessToken,fname,lname,email);
            if( register_success )
            {
            userSocialLogin(response.authResponse.accessToken,"facebook");
            }
            else
            {
            console.log("facebook registration could not be completed");
            }
            });
        }
        else
        {
        console.log("Cannot connect with facebook");
        }
    })
}