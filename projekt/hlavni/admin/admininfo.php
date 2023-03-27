<html>
<?php
include '../utils/navbar.php';
?>

<body>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("location: http://zbranedata.jednoduse.cz/hlavni/reg-log/login.php");
}
include '../utils/connectToDB.php';
echo '<body>';
echo '<div class="vlozeni">';
echo '<form method="post">';
echo '<p>Název zbraně:</p>';
echo '<p>';
echo '<input type="text" id="nazev" name="nazev" placeholder="nazev zbrane"><br>';
echo '<p>Ráže:</p>';
echo '<select id="raze" name="raze">';
$sqlr = "select id,raze from raze";
$result =  mysqli_query($conn, $sqlr);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['raze'] . "</option>";
}
echo '</select>';
echo '<p>cena:</p>';
echo '<input type="number" id="cena" name="cena" placeholder="cena"><br>';
echo '<p>';
echo '<p>Výrobce:</p>';
echo '<p>';
echo '<select id="firma" name="firma">';
$sqlf = "select id,firma from firma";
$result =  mysqli_query($conn, $sqlf);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['firma'] . "</option>";
}
echo '</select>';
echo '<p>';
echo '<p>';
echo '<p>Druh zbraně:</p>';
echo '<p>';
echo '<select id="druh" name="druh">';
$sqld = "select id,druh from druh";
$result =  mysqli_query($conn, $sqld);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['druh'] . "</option>";
}
echo '</select>';
echo '<p>';
echo '<p>Popis:</p>';
echo '<p>';
echo '<textarea rows="10" cols="50" name="popis"></textarea>';
echo '<p>';
echo '<input type="submit" name="submit">';
echo '<p>';
echo '</div>';
echo '</body>';
if (!empty($_POST['submit']) and !empty($_POST['nazev']) and !empty($_POST['raze']) and !empty($_POST['cena']) and !empty($_POST['firma']) and !empty($_POST['druh']) and !empty($_POST['popis'])) {

    $nazev = $_POST['nazev'];
    $raze = $_POST['raze'];
    $cena = $_POST['cena'];
    $firma = $_POST['firma'];
    $druh = $_POST['druh'];
    $popis = $_POST['popis'];

    $sql = "INSERT INTO zbran (nazev, raze, cena, firma, druh, popis) values ('$nazev','$raze','$cena','$firma','$druh','$popis')";
    $result = mysqli_query($conn, $sql);
} else {
}
?>