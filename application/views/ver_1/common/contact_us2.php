
<!--Page contetn-->
<div class="span8">
    <section>
        <div class="row">
                <div class="span8">
                    <div class="well">
                        <h4><span class="colored">///</span> Silahkan Isi  Buku Tamu</h4>
                        <p>Valera is designed to help people of all skill levels designer or developer, huge nerd or early beginner. Use it as a complete kit or use to start something more complex.</p>
                        <hr>
                        <span><strong class="colored"> Aress:</strong> 123456 Street Name, Los Angeles</span>
                        <br>
                        <span><strong class="colored">Phone:</strong> (1800) 765-4321</span>
                        <br>
                        <span><strong class="colored">Fax:</strong> (1800) 765-4321</span>
                        <br>
                        <span><strong class="colored">Website:</strong> http://yoursitename.com</span>
                        <br>
                        <span><strong class="colored">Email:</strong> info@yoursitename.com</span>
                    </div>
                </div>
                <div class="span8">
                    <h3><span class="colored">///</span> Punya Pertanyaan, Komentar, Silakan isi Form Berikut</h3>
                    <div id="note"></div>
                    <div id="fields">
                        <form class="form" id="ajax-contact-form" action="">
                            <input type="text" id="nama" name="nama" class="span4" style="margin-right:25px;" placeholder="Nama" />
                            <input class="span4" id="email" name="email" placeholder="Email, tidak akan ditampilkan" />
                            <input class="span8" id="subject" name="subject" placeholder="Subject" />
                            <textarea type="text" id="message" name="message" placeholder="Pesan" rows="8" class="span8"></textarea>
                            <button type="submit" class="btn btn-success" id="btn_bukutamu">Send message</button>
                        </form>
                    </div>
                </div>

                <div id="list_bukutamu"></div>

        </div>
    </section>
</div>

<script type="text/javascript">
    get_list_comment = function (){
        jQuery.get(base_index + 'common/list_pesan_bukutamu',{},function(resp){
            jQuery("#list_bukutamu").html(resp).fadeIn();
        });
    }
    jQuery(document).ready(function($){
        get_list_comment();
        $('#btn_bukutamu').click(function(e){
            e.preventDefault();

            $.post(base_index + 'post/buku_tamu/simpan_komentar',
                    $("#ajax-contact-form").serialize(),
                    function(resp){
                        $(".alert").remove();
                        if (resp.status == "success"){
                            $("#fields").prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>"+ resp.message +"</div>");
                            get_list_comment();
                        }
                        else{
                            $("#fields").prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>"+ resp.message +"</div>");
                        }
                        $(':input','#ajax-contact-form')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .removeAttr('checked')
                            .removeAttr('selected');
                    }, 'json');

        });
    });

</script>
<!--/Page contetn-->