<!--<div class="row-fluid">-->
<!--    <div class="span12">-->
<!--        <h3 class="heading">Dashboard</h3>-->
<!--        <div class="row-fluid">-->
<!--            <div class="span8">-->
<!--                <div class="vcard">-->
<!--                    <img class="thumbnail" src="{base_url}assets/ver_1/admin/images/foto.gif" alt="">-->
<!--                    <ul>-->
<!--                        <li class="v-heading">-->
<!--                            Identitas-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">Nama Lengkap</span>-->
<!--                            <div class="vcard-item">[label]</div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">N I M</span>-->
<!--                            <div class="vcard-item">[label]</div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">Semester</span>-->
<!--                            <div class="vcard-item">[label]</div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">Dosen Wali</span>-->
<!--                            <div class="vcard-item">[label]</div>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<br>-->
<!---->
<!--<br>-->
<!---->
<!--<div class="row-fluid">-->
<!--    <div class="span12">-->
<!--        <h3 class="heading">Jadwal Kuliah Semester [label]</h3>-->
<!--        <button class="btn btn-inverse">PRINT<img src="{base_url}assets/ver_1/admin/images/gCons/print.png" alt=""></button><br><br>-->
<!--        <table class="table table-bordered table-striped" id="smpl_tbl">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th class="table_checkbox">No</th>-->
<!--                <th>Kode MK</th>-->
<!--                <th>Nama Mata Kuliah</th>-->
<!--                <th>SKS</th>-->
<!--                <th>Kelas</th>-->
<!--                <th>Ruang</th>-->
<!--                <th>Dosen</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <th class="table_checkbox">1</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="table_checkbox">2</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="table_checkbox">3</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="table_checkbox">4</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th class="table_checkbox">5</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--                <th>[label]</th>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </table>-->
<!---->
<!--    </div>-->
<!--</div>-->
<!---->
<!---->

<style>
    ul.ule li {
        padding: 10px 10px 10px 0px;
        border-bottom: 1px dashed #ccc;
    }
    ul.ule li label {
        display: inline;
    }
</style>

<div class="row-fluid">
    <div class="span12">
        <h2 style="border-bottom: 1px solid #eee;text-align: center;">KARTU RENCANA STUDI</h2>
        <div class="form-horizontal">
            <ul class="ule" style="list-style-type: none;margin-left: 0px;">
                <li><label>Nama Lengkap </label>: <?php echo $mhs['nama']; ?></li>
                <li><label>NIM </label>: <?php echo $mhs['nim']; ?></li>
            </ul>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Ruang</th>
                    <th>Dosen</th>
                </tr>
            </thead>
            <?php $no=1;foreach($krs as $data) : ?>
            <tbody>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->nama; ?></td>
                    <td><?php echo $data->sks; ?></td>
                    <td><?php echo $data->ruang; ?></td>
                    <td><?php echo $data->nama_dosen; ?></td>
                </tr>
            </tbody>
            <?php $no++;endforeach; ?>
        </table>
    </div>
</div>