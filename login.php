<?php
$uname_login = $_POST['userlogin'];


$inp = file_get_contents('test.json');
$tempArray = json_decode($inp, true);
$tempArray["userLogin"] = $uname_login;


$jsonData = json_encode($tempArray);
file_put_contents('test.json', $jsonData);
?>

<?php
