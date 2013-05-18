
<!--Page contetn-->
<div class="span8">
    <section>
        <div class="row">
                <div class="span8">
                    <div class="well">
                        <h4><span class="colored">///</span> Fontact information</h4>
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
                            <input type="text" id="name" class="span4" style="margin-right:25px;" placeholder="Nama" />
                            <input class="span4" id="email" placeholder="Email, tidak akan ditampilkan" />
                            <textarea type="text" id="message" placeholder="Pesan" rows="8" class="span8"></textarea>
                            <button type="submit" class="btn btn-success" id="btn_bukutamu">Send message</button>
                        </form>
                    </div>
                </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function(){
        $('#btn_bukutamu').click(function(e){
            e.preventDefault();
            var input = {name : $('#name').val(), email : $('#email').val(), message : $('#message').val()};
            $.post(base_index + 'post/buku_tamu/simpan_komentar',input, function(data){}, 'json');
        });
    });

</script>
<!--/Page contetn-->