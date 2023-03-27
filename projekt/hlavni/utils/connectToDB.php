<?php
$servername = "sql.endora.cz:3307";
$username = "zbranedatajednod";
$pass = "kDe_d0m0v_muj";
$dbname = "xx";
$conn = mysqli_connect($servername, $username, $pass, $dbname);
if (!$conn) {
    echo "error";
}
