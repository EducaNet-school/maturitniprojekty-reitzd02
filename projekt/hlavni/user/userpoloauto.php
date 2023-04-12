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
  $sql = "SELECT zbran.ID, zbran.nazev, druh.druh, raze.raze, zbran.cena, firma.firma ,zbran.popis
  FROM zbran 
  JOIN raze ON zbran.raze=raze.ID 
  JOIN firma ON zbran.firma=firma.ID 
  JOIN druh ON zbran.druh=druh.ID 
  WHERE druh.druh = 'Semi-auto' AND nazev LIKE '%$search%'";
} else {
  $sql = "SELECT zbran.ID, zbran.nazev, druh.druh, raze.raze, zbran.cena, firma.firma ,zbran.popis
      FROM zbran 
      JOIN raze ON zbran.raze=raze.ID 
      JOIN firma ON zbran.firma=firma.ID 
      JOIN druh ON zbran.druh=druh.ID 
      WHERE druh.druh = 'Semi-auto'";
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  echo "<div class = 'select'>";
  echo "<table>";
  echo "<tr>";
  echo "<th>Nazev</th>";
  echo "<th>Ráže</th>";
  echo "<th>Cena v kč</th>";
  echo "<th>Výrobce</th>";
  echo "<th>Druh</th>";
  echo "<th>Popis</th>";
  echo "</tr>";
  echo "</div>";
  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['nazev'] . "</td>";
    echo "<td>" . $row['raze'] . "</td>";
    echo "<td>" . $row['cena'] . "</td>";
    echo "<td>" . $row['firma'] . "</td>";
    echo "<td>" . $row['druh'] . "</td>";
    echo "<td>" . $row['popis'] . "</td>";
    echo "</tr>";
  }
}
echo "</table>";
mysqli_free_result($result);
?>