<?php


$fname = $_POST['fullname'];
$name = $_POST['username'];
$email = $_POST['email'];
$address = $_POST['address'];
$hp = $_POST['hp'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

echo $data;
$inp = file_get_contents('test.json');
$tempArray = json_decode($inp, true);
$tempArray["users"][] = ['fname' => $id, 'username' => $name, 'email' => $email, 'address' => $address, 'phoneNumber' => $hp, 'password' => $pass ];


$jsonData = json_encode($tempArray);
file_put_contents('test.json', $jsonData);
?>

<?php
// $arr = '[
//    {
//       "id":1,
//       "name":"Charlie"
//    },
//    {
//       "id":2,
//       "name":"Brown"
//    },
//    {
//       "id":3,
//       "name":"Subitem",
//       "children":[
//          {
//             "id":4,
//             "name":"Alfa"
//          },
//          {
//             "id":5,
//             "name":"Bravo"
//          }
//       ]
//    },
//    {
//       "id":8,
//       "name":"James"
//    }
// ]';
// $arr = json_decode($arr, TRUE);
// $arr[] = ['id' => '9999', 'name' => 'kakuta'];
// $json = json_encode($arr);
//
// echo '<pre>';
// print_r($json);
// echo '</pre>';
?>
