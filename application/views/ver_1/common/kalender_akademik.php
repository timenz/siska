<?php
//print_r($kalender_akademik);
?>
<!--Page contetn-->
<div class="span8">
    <section>
        <div class="row">
            <div class="span8">
                <h3>Kalender Akademik</h3>
                <p>Berikut adalah informasi program akademik kami di seluruh fakultas.</p>
                <table class="table">
                    <thead><tr>
                        <th>Nama Kegiatan</th>
                        <th>Mulai</th>
                        <th>Akhir</th>
                        <th>Deskripsi</th>
                    </tr></thead>
                    <tbody>
                    <?php
                    $str = '';
                    foreach($kalender_akademik as $key=>$item){
                        foreach($item as $key2=>$item2){
                            $str .= '<tr><td colspan="4"><b>'.$key.' - prodi '.$key2.'</b></td></tr>';
                            foreach($item2 as $row){
                                $str .= '<tr>
                                    <td>'.$row->judul.'</td>
                                    <td>'.date('d-m-Y', to_epochtime($row->tgl_kegiatan_start)).'</td>
                                    <td>'.date('d-m-Y', to_epochtime($row->tgl_kegiatan_end)).'</td>
                                    <td>'.$row->deskripsi.'</td>
                                    </tr>';
                            }
                            $str .= '<tr><td colspan="4"></td></tr>';
                        }
                    }
                    echo $str;
                    ?>

                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>
<!--/Page contetn-->