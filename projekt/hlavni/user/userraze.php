<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="stylesheet.css?rnd=23" media="screen" />
</head>
<?php
include '../utils/usernavbar.php';
?>

<body>
    <form method="post">
        <input type="text" name="search" placeholder="vyhledat....">
        <button type="submit">vyhledat</button>
    </form>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location: http://zbranedata.jednoduse.cz/hlavni/reg-log/login.php");
}
include '../utils/connectToDB.php';
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "select * from raze where raze like '%$search%'";
    $result = mysqli_query($conn, $sql);
} else {
    $sql = "select * from raze";
    $result = mysqli_query($conn, $sql);
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<div class='select'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Ráže</th>";
    echo "<th>Popis</th>";
    echo "</tr>";
    echo "</div>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['raze'] . "</td>";
        echo "<td>" . $row['historie'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}
?>