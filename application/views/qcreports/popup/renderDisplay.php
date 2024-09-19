<?php
    $nama = $idInfo['nama'] ? $idInfo['nama'] : '';
    $tgl = $idInfo['tgl'] ? $idInfo['tgl'] : '';
    $ok = $idInfo['ok'] ? $idInfo['ok'] : '';
    $ng = $idInfo['ng'] ? $idInfo['ng'] : '';
   
?>
<div class="row">   
    <div class="col-lg-12">
        <p><strong>First Name: </strong><?php print $nama?></p>
        <p><strong>Last Name: </strong><?php print $tgl?></p>
        <p><strong>Email: </strong><?php print $ok?></p>
        <p><strong>Address: </strong><?php print $ng?></p>
     
    </div>
</div><!-- /.row -->
