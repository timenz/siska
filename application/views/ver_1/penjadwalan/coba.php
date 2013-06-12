    <?php
    echo "Ini hasilnya ya, tinggal di save ke DB<br>";
    echo "Mata Kuliah yang dipilih adalah sbb : <br><br>";
    $makul=$_POST['id'];
    foreach ($makul as $item){
    echo "$item <br>";
    }
    ?>

