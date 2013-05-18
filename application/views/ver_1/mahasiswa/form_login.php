<style type="text/css">

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        background-color: #fff;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
<link rel="stylesheet" href="{assets_url}/js/validation_engine/validationEngine.jquery.css" type="text/css"/>
<script src="{assets_url}/js/validation_engine/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="{assets_url}/js/validation_engine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<form class="form-signin" method="post" action="{action}" id="form_login">
<h2 class="form-signin-heading">{lang_please_singin}</h2>
<input type="text" class="input-block-level validate[required]" placeholder="{lang_email_address}" name="email">
<input type="password" class="input-block-level validate[required]" placeholder="{lang_password}" name="password">
<label class="checkbox">
  <input type="checkbox" value="1" name="is_calon"> Saya Calon Mahasiswa
</label>
<button class="btn btn-large btn-primary" type="submit">{lang_login}</button>
</form>
<script>
    jQuery(document).ready(function($){
        $("#form_login").validationEngine();
    });
</script>