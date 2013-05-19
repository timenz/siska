<div  class="span12">
    <h3 class="heading">{page_title}</h3>
    <div style="margin-bottom: 10px;">
        <a class="btn btn-success" href="<?php echo base_index(); ?>admin/zdev_permission/form_add_permission">Tambah Permission</a>
    </div>
    <div style="margin-bottom: 10px;">
        <form method="get" action="{filter_action}" >
        Role :<select name="role"><option value="">all role</option>
            <?php
            $rl = '';
            foreach($role as $item){
                $sel = '';
                if(isset($_GET['role'])){
                    if($_GET['role'] == $item->role){$sel = 'selected="selected"';}
                }
                $rl .= '<option '.$sel.' value="'.$item->role.'">'.$item->role.'</option>';
            }
            echo $rl;
            ?>
        </select>
        <input type="submit" value="filter" /></form>
    </div>
    <div>
        <table class="table table-striped">
            <thead><tr><?php
                foreach($heading as $item){ ?>
                    <th><?php echo $item; ?></th>
                <?php }?></tr></thead>
            <tbody><?php
            foreach($konten as $items){ ?>
                <tr><?php foreach($items as $item){ ?>
                        <td><?php echo $item; ?></td>
                    <?php } ?></tr>
            <?php }?></tbody>
        </table>
    </div>

</div>