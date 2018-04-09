$( document ).on( 'submit', '#signinForm', function(e){
  e.preventDefault();
  // controlPlate
  var  datas = $("#signinForm").serializeArray();
  var $button = $("#signinForm [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  url: window.apiUrl+"users/login",
                  data: datas
                })
                .done(function(xhr) {
                  console.log(JSON.stringify(xhr));
                  window.location="/home";
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{
                    toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                 }
                })
                .always(function(){
                  $button.button('reset');
                });
});
// signupForm
$( document ).on( 'submit', '#signupForm', function(e){
  e.preventDefault();
  // controlPlate
  // passwordSignUp passwordSignUpRepeat
  if($("#passwordSignUp").val().length<6){
    simpleAlert("Al menos 6 caracteres","La contraseña tiene que tener por lo menos 6 caracteres.");
    return false;
  }
  if($("#passwordSignUp").val()!=$("#passwordSignUpRepeat").val()){
    simpleAlert("Las contraseñas no coinciden","La contraseña y la repetición de la misma no coinciden.");
    return false;
  }
  var  datas = $("#signupForm").serializeArray();
  var $button = $("#signupForm [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  url: window.apiUrl+"users/register",
                  data: datas
                })
                .done(function(xhr) {
                  console.log(JSON.stringify(xhr));
                    window.location="/home";
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{
                    toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                 }
                })
                .always(function(){
                  $button.button('reset');
                });
});
//
$( document ).on( 'submit', '#recoverForm', function(e){
  e.preventDefault();
  // controlPlate
  var  datas = $("#recoverForm").serializeArray();
  var $button = $("#recoverForm [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  url: window.apiUrl+"users/recover",
                  data: datas
                })
                .done(function(xhr) {
                  console.log(JSON.stringify(xhr));
                  simpleAlert("Mail enviado","Se envió un mail a <b>"+$("#recoverEmail").val()+"</b>para que pueda recuperar su contraseña");
                  $('#recoverAccount').modal('toggle');
                  $( '#recoverForm' )[0].reset();
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{
                    toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                 }
                })
                .always(function(){
                  $button.button('reset');
                });
});
