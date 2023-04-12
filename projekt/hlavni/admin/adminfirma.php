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
    $sql = "select * from firma where firma like '%$search%'";
    $result = mysqli_query($conn, $sql);
} else {
    $sql = "select * from firma";
    $result = mysqli_query($conn, $sql);
}
if (mysqli_num_rows($result) > 0) {
    echo "<div class = select>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Výrobce</th>";
    echo "<th>Popis</th>";
    echo "</tr>";
    echo "</div>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['firma'] . "</td>";
        echo "<td>" . $row['popis'] . "</td>";
        echo '<td><a href="?edit_id=' . $row['ID'] . '">edit</a></td>';
        echo '<td><a href="?delete_id=' . $row['ID'] . '">delete</a></td>';
        echo "</tr>";
    }
}
echo "</table>";
mysqli_free_result($result);
if (isset($_GET['delete_id'])) {
    $getID = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $sql = "delete from firma where ID = $getID ";
    mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) > 0) {
        header("Location: http://zbranedata.jednoduse.cz/hlavni/admin/adminfirma.php");
        exit;
    } else {
    }
}
if (isset($_GET['edit_id'])) {
    $getID = mysqli_real_escape_string($conn, $_GET['edit_id']);
    if (isset($_POST['firma']) && isset($_POST['popis'])) {
        $new_firma = $_POST['firma'];
        $new_popis = $_POST['popis'];
        if ((!empty($new_firma)) and (!empty($new_popis))) {
            $sql1 = "UPDATE firma SET popis='$new_popis' WHERE ID='$getID'";
            $sql2 = "UPDATE firma SET firma='$new_firma' WHERE ID='$getID'";
            if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql1)) {
                header("Location: http://zbranedata.jednoduse.cz/hlavni/admin/adminfirma.php");
            } else {
            }
        }
    } else {
        echo '<form method="post" action="">';
        echo '<label for="popis" Popis:</label>';
        echo '<br>';
        echo '<textarea rows="10" cols="50" name="popis"></textarea>';
        echo '<br>';
        echo '<label for="druh">Firma:</label>';
        echo '<br>';
        echo '<input type="text" name = "firma">';
        echo '<p>';
        echo '<input type="submit" value="Update">';
        echo '</form>';
    }
}
?>