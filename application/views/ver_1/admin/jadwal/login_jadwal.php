
<div class="login_box">

    <form action="{action}" method="post" id="login_form">
        <div class="top_b">{lang_please_singin}</div>
        <div class="alert alert-info alert-login">
            {lang_notification}
        </div>
        <div class="cnt_b">
            <div class="formRow">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span><input type="text" id="username" name="username" placeholder="{lang_email_address}" value="" />
                </div>
            </div>
            <div class="formRow">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="{lang_password}" value="" />
                </div>
            </div>
            <div class="formRow">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-eject"></i></span>
                    <select>
                        <option>--Status--</option>
                        <option>Mahasiswa</option>
                        <option>Admin</option>
                    </select>
                </div>
            </div>
            <!--
            <div class="formRow clearfix">
                <label class="checkbox"><input type="checkbox" /> {lang_remember}</label>
            </div>
            -->
        </div>
        <div class="btm_b clearfix">
            <button class="btn btn-inverse pull-right" type="submit">{lang_login}</button>
        </div>
    </form>



</div>