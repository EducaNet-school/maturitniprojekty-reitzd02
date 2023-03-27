<!DOCTYPE html>
<html>

<?php
include '../utils/navbar.php';
?>

<body>
    <div class="razevlozeni">
        <form method="POST">
            <p>
            <p>Firma:</p>
            <input type="text" id="raze" name="firma" placename="firma">
            <p>
            <p>Popis:</p>
            <textarea rows="10" cols="50" name="popis"></textarea>
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
if (isset($_POST["submit"]) and isset($_POST["firma"]) and isset($_POST["popis"])) {
    $firma = $_POST["firma"];
    $popis = $_POST["popis"];

    $sqlc = "select firma from firma where firma = '" . $firma . "'";
    $Cresult = mysqli_query($conn, $sqlc);
    if (mysqli_num_rows($Cresult) > 0) {
        echo "omlouváme se, firma už existuje.";
    } else {
        $sql = "insert into firma (firma, popis) values ('$firma','$popis')";
        $result = mysqli_query($conn, $sql);
        header('location: http://zbranedata.jednoduse.cz/hlavni/admin/adminfirma.php');
    }
} else {
}
