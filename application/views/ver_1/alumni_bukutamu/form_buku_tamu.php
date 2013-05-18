<link href="{assets_url}css/validationEngine.jquery.css" rel="stylesheet" />
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
    <div class="span4">
    	<div class="well">
		<h4><span class="colored">///</span> Contact information</h4>
        <p>Valera is designed to help people of all skill levels designer or developer, huge nerd or early beginner. Use it as a complete kit or use to start something more complex.</p>
    	<hr />
        <span><strong class="colored"> Aress:</strong> 123456 Street Name, Los Angeles</span>
        <br />
        <span><strong class="colored">Phone:</strong> (1800) 765-4321</span>
        <br />
        <span><strong class="colored">Fax:</strong> (1800) 765-4321</span>
        <br />
        <span><strong class="colored">Website:</strong> http://yoursitename.com</span>
        <br />
        <span><strong class="colored">Email:</strong> info@yoursitename.com</span>
    	</div>
    </div>
    <div class="span8">
        <h3><span class="colored">///</span> Silahkan Isi buku tamu</h3>
        <div id="note"></div>
        <div id="fields">
            <form class="form" id="ajax-contact-form" action="{action}">
                <input type="text" name="nama" class="span4 input validate[required,minSize[6]]" style="margin-right:25px;" placeholder="Name" />
                <input  class="span4" name="email" class="input validate[required,custom[email]]" placeholder="Email" />
                <input  class="span8" name="subject" class="input validate[required]" placeholder="Subject" />
                <textarea name="message" placeholder="Komentar / saran / kritik" rows="8" class="span8"></textarea>
                <?php echo re_captcha(); ?><br />
                <button type="submit"  class="btn btn-success">Send message</button>
            </form>
        </div>
    </div>
    <!--
    <h2 class="form-bukutamu-heading">Buku Tamu</h2>
    <input type="text" name="nama" id="nama" class="input validate[required,minSize[6]]" placeholder="Nama" ><br />
    <input type="text" name="email" id="email" class="input validate[required,custom[email]]" placeholder="Email" ><br />
    <textarea class="textarea validate[required,minSize[20]]" placeholder="Komentar / saran / kritik" rows="6"></textarea><br />
    <?php echo re_captcha(); ?><br />
    <button class="btn btn-large btn-primary" type="submit">submit</button>
    -->
</form>