<?php

require "connection.php";


$query = "SELECT * FROM appointment";
$rs = Database::search($query);

while ($row = mysqli_fetch_assoc($rs)) {

$pName = $row["pName"];
$email = $row["email"];

echo $pName;

}


?>