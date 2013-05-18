<link href="{assets_url}css/validationEngine.jquery.css" rel="stylesheet">
<script src="{assets_url}js/jquery.validationEngine.js"></script>
<script src="{assets_url}js/jquery.validationEngine-en.js"></script>

<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 $(document).ready(function(){
     $('#recaptcha_response_field').addClass('validate[required]');
     $('#form_bukutamu').validationEngine();
 });
 
 </script>
 <style>
img#recaptcha_logo{
    display:none;
}
img#recaptcha_tagline{
    display:none;
}
 </style>
<form class="form-bukutamu" id="form_bukutamu" method="post" action="{action}">
<h2 class="form-bukutamu-heading">Isi buku tamu</h2>
<input type="text" name="nama" id="nama" class="input validate[required,minSize[6]]" placeholder="Nama" ><br>
<input type="text" name="email" id="email" class="input validate[required,custom[email]]" placeholder="Email" ><br>
<textarea class="textarea validate[required,minSize[20]]" placeholder="Komentar / saran / kritik" rows="6"></textarea><br>
<?php echo re_captcha(); ?><br>
<button class="btn btn-large btn-primary" type="submit">submit</button>
</form>