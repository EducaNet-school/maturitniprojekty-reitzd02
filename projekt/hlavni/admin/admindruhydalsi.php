<!DOCTYPE html>
<html>

<?php
include '../utils/navbar.php';
?>

<body>
    <div class="razevlozeni">
        <form method="POST">
            <p>
            <p>Druh:</p>
            <input type="text" name="druh" placename="druh">
            <p>
            <p>Popis:</p>
            <textarea rows="10" cols="50" name="historie"></textarea>
            <p>
                <input type="submit" name="submit">
        </form>
    </div>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['usertype'] == 2 || $_SESSION['usertype'] == 3) {
    header("Location: http://zbanedata.jednoduse.cz/hlavni/reg-log/login.php");
    exit();
}
include '../utils/connectToDB.php';
if (isset($_POST["submit"]) and isset($_POST["druh"]) and isset($_POST["historie"])) {
    $druh = $_POST["druh"];
    $historie = $_POST["historie"];

    $sqlc = "select * from druh where druh = '" . $druh . "'";
    $Cresult = mysqli_query($conn, $sqlc);
    if (mysqli_num_rows($Cresult) > 0) {
        echo "omlouváme se, druh už existuje.";
    } else {
        $sql = "insert into druh (druh, historie) values ('$druh','$historie')";
        $result = mysqli_query($conn, $sql);
        header('location: http://zbranedata.jednoduse.cz/hlavni/hlavni/admin/admindruhy.php');
    }
} else {
}
