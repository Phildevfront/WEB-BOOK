<?php

define('DB_SERVER', 'localhost'); // mask.o2switch.net
define('DB_USERNAME', 'root'); // baph4737
define('DB_PASSWORD', 'root'); // RMRvNgmAVYNv
define('DB_NAME', 'registration'); //baph4737_registration
 

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>