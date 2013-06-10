<div  class="span12">
    <h3 class="heading">{page_title}</h3>
    <div style="margin-bottom: 10px;">
        <?php if(count($link_add) > 1){ ?>
            <a class="btn btn-success" href="<?php echo $link_add['link']; ?>"><?php echo $link_add['name']; ?></a>
        <?php } ?>
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

<script>
    $(document).ready(function(){
        $('.input_du').click(function(e){
            var id = $(this).attr('data'), kom = confirm('Yakin sudah daftar ulang ?');
            if(!kom){return;}
            $.post(base_index + 'admin/json_print/admin_pendaftaran/save_daftar_ulang',{id:id}, function(data){
                if(data.valid){
                    $(e.target).closest('tr').slideUp();
                    $.sticky("Data berhasil dimasukkan;", {autoclose : 2000, position: "top-right", type: "st-success" });
                }
            }, 'json');
        });
    });
</script>