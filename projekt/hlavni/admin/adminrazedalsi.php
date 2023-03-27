<!DOCTYPE html>
<html>

<?php
include '../utils/navbar.php';
?>

<body>
    <div class="razevlozeni">
        <form method="POST">
            <p>
            <p>Ráže:</p>
            <input type="text" id="raze" name="raze" placename="raze">
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
if (!isset($_SESSION['Username'])) {
    header("location: http://zbranedata.jednoduse.cz/hlavni/reg-log/login.php");
}
include '../utils/connectToDB.php';
if (isset($_POST["submit"]) and isset($_POST["raze"]) and isset($_POST["historie"])) {
    $raze = $_POST["raze"];
    $historie = $_POST["historie"];

    $sqlc = "select * from raze where raze = '" . $raze . "'";
    $Cresult = mysqli_query($conn, $sqlc);
    if (mysqli_num_rows($Cresult) > 0) {
        echo "omlouváme se, ráže už existuje.";
    } else {
        $sql = "insert into raze (raze, historie) values ('$raze','$historie')";
        $result = mysqli_query($conn, $sql);
        header('location: http://zbranedata.jednoduse.cz/hlavni/admin/adminraze.php');
    }
    echo "$sql";
} else {
}
