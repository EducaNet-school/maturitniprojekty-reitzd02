<!DOCTYPE html>
<html>

<?php
include '../utils/navbar.php';
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
if (!isset($_SESSION['Username']) || $_SESSION['usertype'] == 2 || $_SESSION['usertype'] == 3) {
    header("Location: http://zbanedata.jednoduse.cz/hlavni/reg-log/login.php");
    exit();
}
include '../utils/connectToDB.php';
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT zbran.ID, zbran.nazev, druh.druh, raze.raze, zbran.cena, firma.firma, zbran.popis
    FROM zbran 
    JOIN raze ON zbran.raze=raze.ID 
    JOIN firma ON zbran.firma=firma.ID 
    JOIN druh ON zbran.druh=druh.ID 
    WHERE druh.druh = 'Samopal' AND nazev LIKE '%$search%'";
} else {
    $sql = "SELECT zbran.ID, zbran.nazev, druh.druh, raze.raze, zbran.cena, firma.firma, zbran.popis
    FROM zbran 
    JOIN raze ON zbran.raze=raze.ID 
    JOIN firma ON zbran.firma=firma.ID 
    JOIN druh ON zbran.druh=druh.ID 
    WHERE druh.druh = 'Samopal'";
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<div class = select>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Název</th>";
    echo "<th>Ráže</th>";
    echo "<th>Cena v kč</th>";
    echo "<th>Výrobce</th>";
    echo "<th>Druh</th>";
    echo "<th>Popis</th>";
    echo "</tr>";
    echo "</div>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['nazev'] . "</td>";
        echo "<td>" . $row['raze'] . "</td>";
        echo "<td>" . $row['cena'] . "</td>";
        echo "<td>" . $row['firma'] . "</td>";
        echo "<td>" . $row['druh'] . "</td>";
        echo "<td>" . $row['popis'] . "</td>";
        echo '<td><a href="?edit_id=' . $row['ID'] . '">edit</a></td>';
        echo '<td><a href="?delete_id=' . $row['ID'] . '">delete</a></td>';
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
    if (isset($_GET['delete_id'])) {
        $getID = mysqli_real_escape_string($conn, $_GET['delete_id']);
        $sql = "delete from zbran where ID = $getID ";
        mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            header("http: http://zbranedata.jednoduse.cz/hlavni/admin/adminsamopal.php");
            exit;
        } else {
        }
    }
    if (isset($_GET['edit_id'])) {
        $getID = mysqli_real_escape_string($conn, $_GET['edit_id']);

        echo '<form method="POST" action="">';
        echo '<label for="nazev">New nazev:</label>';
        echo '<input type = "text" name = "nazev">';
        echo '<p>';
        echo '<label for="raze">New raze:</label>';
        echo '<select id="raze" name="raze">';
        $sqlr = "select id, raze from raze";
        $result =  mysqli_query($conn, $sqlr);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['raze'] . "</option>";
        }
        echo '</select>';
        echo '<p>';
        echo '<label for="cena">New cena:</label>';
        echo '<input type = "number" name = "cena">';
        echo '<p>';
        echo '<label for="firma">New firma:</label>';
        echo '<select id="firma" name="firma">';
        $sqlf = "select id, firma from firma";
        $result =  mysqli_query($conn, $sqlf);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['firma'] . "</option>";
        }
        echo '</select>';
        echo '<p>';
        echo '<label for="druh">New druh:</label>';
        echo '<select id="druh" name="druh">';
        $sqld = "select id, druh from druh";
        $result =  mysqli_query($conn, $sqld);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['druh'] . "</option>";
        }
        echo '</select>';
        echo '<p>';
        echo '<p>Popis:</p>';
        echo '<textarea rows="10" cols="50" name="popis"></textarea>';
        echo '<p>';
        echo '<input type="submit" name="submit" value="Update">';
        echo '</form>';

        if (isset($_POST['submit'])) {
            $new_nazev = $_POST['nazev'];
            $new_raze = $_POST['raze'];
            $new_cena = $_POST['cena'];
            $new_firma = $_POST['firma'];
            $new_druh = $_POST['druh'];
            $new_popis = $_POST['popis'];
            $sql1 = "UPDATE zbran SET nazev='$new_nazev', raze='$new_raze', cena='$new_cena', firma='$new_firma', druh='$new_druh', popis='$new_popis' WHERE ID='$getID'";
            if (mysqli_query($conn, $sql1)) {
                header("Location:http://zbranedata.jednoduse.cz/hlavni/admin/adminsamopal.php");
            }
        }
    }
}

?>