<div class="span6">
    <form class="well form-horizontal" action="" method="post">
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
        <?php endif; ?>
        <p class="f_legend">Input Jadwal</p>
        <div class="control-group">
            <label class="control-label">Matakuliah</label>
            <div class="controls">
                <select name="matkul_dosen_id">
                    <option></option>
                    <?php foreach($makul as $data) : ?>
                    <option value="<?php echo $data->id ?>"><?php echo $data->nama; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Jadwal</label>
            <div class="controls">
                <select name="penjadwalan_id">
                    <option></option>
                    <?php foreach($jadwal as $jadwal1) : ?>
                    <option value="<?php echo $jadwal1->id ?>"><?php echo $jadwal1->jadwal; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="action">
            <button type="submit" class="btn">Simpan</button>
        </div>        
    </form>
</div>

<div class="span6">
    <table data-rowlink="a" class="table table-striped">
        <thead>
        <tr>
            <th><center>Matakuliah</center></th>
            <th><center>Dosen</center></th>
            <th><center>Ruang</center></th>
            <th><center>Waktu</center></th>
            <th><center>Hari</center></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($jadwal_krs as $jadwal) : ?>
            <tr>
                <td><?php echo $jadwal->nama; ?></td>
                <td><?php echo $jadwal->nama_dosen; ?></td>
                <td><?php echo $jadwal->ruang; ?></td>
                <td><?php echo $jadwal->jam_in; ?></td>
                <td><?php echo $jadwal->hari; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>