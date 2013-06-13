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
                    <th><center>No.</center></th>
                    <th><center>Matakuliah</center></th>
                    <th><center>SKS</center></th>
                    <th><center>Ruang</center></th>
                    <th><center>Dosen</center></th>
                    <th><center>Waktu</center></th>
                </tr>
            </thead>
            <?php $no=1;foreach($krs as $data) : ?>
            <tbody>
                <tr>
                    <td><center><?php echo $no; ?></center></td>
                    <td><?php echo $data->nama; ?></td>
                    <td><center><?php echo $data->sks; ?></center></td>
                    <td><center><?php echo $data->ruang; ?></center></td>
                    <td><?php echo $data->nama_dosen; ?></td>
                    <td><center><?php echo $data->jam_in; echo " - "; echo $data->jam_out?></center></td>
                </tr>
            </tbody>
            <?php $no++;endforeach; ?>
        </table>
    </div>
</div>