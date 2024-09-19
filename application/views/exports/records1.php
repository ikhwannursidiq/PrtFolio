<?php

include 'model1.php';

$model1 = new Model1();

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $rows = $model1->date_range($start_date, $end_date);
} else {
    $rows = $model1->fetch1();
	

}

echo json_encode($rows);