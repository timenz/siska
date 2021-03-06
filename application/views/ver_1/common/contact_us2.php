
<!--Page contetn-->
<div class="span8">
    <section>
        <div class="row">
                <div class="span8">
                    <div class="well">
                        <h4><span class="colored">///</span> Hubungi Kami</h4>
                        <p>Universitas Tugu Muda Semarang, adalah universitas elite yang terletak di tengah kota, silakan kunjungi kami di alamat ini, atau telepon, atau email dll.</p>
                        <hr>
                        <span><strong class="colored">Alamat:</strong> Tugu Muda Blfd.</span>
                        <br>
                        <span><strong class="colored">Phone:</strong> 0124 12371</span>
                        <br>
                        <span><strong class="colored">Fax:</strong> 0124 12371</span>
                        <br>
                        <span><strong class="colored">Website:</strong> http://untumu.ac.id</span>
                        <br>
                        <span><strong class="colored">Email:</strong> info@untumu.ac.id</span>
                    </div>
                </div>
                <div class="span8">
                    <h3><span class="colored">///</span> Punya Pertanyaan, Komentar, Silakan isi Form Buku Tamu Berikut</h3>
                    <div id="note"></div>
                    <div id="fields">
                        <form class="form" id="ajax-contact-form" action="">
                            <input type="text" id="nama" name="nama" class="span4" style="margin-right:25px;" placeholder="Nama" />
                            <input class="span4" id="email" name="email" placeholder="Email, tidak akan ditampilkan" />
                            <input type="text" id="alamat" name="alamat" class="span4" style="margin-right:25px;" placeholder="Alamat" />
                            <input class="span4" id="telp" name="telp" placeholder="Nomor yang bisa dihubungi" />
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