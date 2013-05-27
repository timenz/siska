<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">KRS</h3>
        <div class="row-fluid">
            <div class="span12">
                <div class="vcard">

                    <ul>
                        <li class="v-heading">
                            <center>Kartu Rencana Studi <br> Semester 2 Tahun [label]</center>
                        </li>
                        <li>
                            <span class="item-key">NIM / Nama</span>
                            <div class="vcard-item">{nim} / {nama}</div>
                        </li>
                        <li>
                            <span class="item-key">Kode / Nama Wali</span>
                            <div class="vcard-item">[label] / [label]</div>
                        </li>
                        <li>
                            <span class="item-key">Fakultas</span>
                            <div class="vcard-item">[label]</div>
                        </li>
                        <li>
                            <span class="item-key">Program Studi</span>
                            <div class="vcard-item">[label]</div>
                        </li>
                        <li>
                            <span class="item-key">Masa Studi Telah Ditempuh</span>
                            <div class="vcard-item">[label]</div>
                        </li>
                    </ul>
                    <br>
                    <form method="post" action="{action}" class="form-horizontal">
                        <fieldset>
                            <center><button class="btn btn-danger">ISI KRS</button></center>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Mata Kuliah Yang Telah Diambil</h3>
        <table class="table table-bordered table-striped" id="smpl_tbl">
            <thead>
            <tr>
            <?php
            foreach($heading as $item){ ?>
                <th><?php echo $item; ?></th>
            <?php }?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($konten as $items){ ?>
            <?php foreach($items as $item){ ?>
                <td><?php echo $item; ?></td>
            <?php } ?></tr>
            <?php }?>

            </tbody>
        </table>

    </div>
</div>