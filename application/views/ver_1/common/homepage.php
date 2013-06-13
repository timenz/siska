
<!--Page contetn-->
<div class="span8">
    <?php
        $str = '';
        foreach($pengumuman as $item){
            $str .= '<section>
                <div class="row">
                    <div class="span6">
                        <div class="blog_item">
                            <div class="blog_head">
                                <h3><a href="blog_single.html">'.$item->judul.'</a></h3>
                            </div>
                            <!--<div class="view view-first">
                                <img src="'.$assets_url.'img/no_image.jpg" alt="Hanging Note Sign Psd" /></a>
                            </div>-->
                            <p>'.nl2br($item->deskripsi).'</p>
                        </div>
                    </div>
                    <div class="span2">
                        <div class="ddate">
                            <h5><i class="icon-calendar"></i> '.date('d M / Y', to_epochtime($item->tgl_kegiatan)).'</h5>
                            <div class="firstA"></div>
                        </div>
                        <div class="meta">
                            <span><strong><i class="icon-comment"></i> Jam Kegiatan:</strong> <a href="#">'.$item->jam.'</a></span>
                            <span><strong><i class="icon-list-alt"></i> Category:</strong> <a href="#">Pengumuman</a></span>
                            <span><strong><i class="icon-user"></i> Author:</strong> <a href="#">OrangeIdea</a></span>
                        </div>
                        <hr>
                    </div>
                </div>
            </section>';
        }
        echo $str;
    ?>
</div>

<!--/Page contetn-->