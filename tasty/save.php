<?php
$json_array = json_decode(file_get_contents('test.json'), true);

$json_array[] = array('number' => $_POST['number'], 'color' => $_POST['color']);
file_put_contents('test.json', json_encode($json_array));
?>
