<table>
<thead>
<tr>
<th>no</th>
<th>nama</th>
</tr>
</thead>
<tbody>
    <?php
    $no=1;
    foreach($customer as $row){
        ?>
    
    <tr>
    <td><?php echo $no ?></td>
    <td><?php echo $row['name'] ?></td>


</tr>
<?php
$no++;
    }
    ?>
</tbody>


</table>