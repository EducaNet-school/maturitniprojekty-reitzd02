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
    $sql = "select * from raze where raze like '%$search%'";
    $result = mysqli_query($conn, $sql);
} else {
    $sql = "select * from raze";
    $result = mysqli_query($conn, $sql);
}
if (mysqli_num_rows($result) > 0) {
    echo "<div class='select'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Ráže</th>";
    echo "<th>Popis</th>";
    echo "</tr>";
    echo "</div>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['raze'] . "</td>";
        echo "<td>" . $row['historie'] . "</td>";
        echo '<td><a href="?edit_id=' . $row['ID'] . '">edit</a></td>';
        echo '<td><a href="?delete_id=' . $row['ID'] . '">delete</a></td>';
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
    if (isset($_GET['delete_id'])) {
        $getID = mysqli_real_escape_string($conn, $_GET['delete_id']);
        $sql = "delete from raze where ID = $getID ";
        mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            header("Location: http://zbranedata.jednoduse.cz/hlavni/admin/adminraze.php ");
            exit;
        } else {
        }
    }
}
if (isset($_GET['edit_id'])) {
    $getID = mysqli_real_escape_string($conn, $_GET['edit_id']);
    if (isset($_POST['raze']) && isset($_POST['historie'])) {
        $new_raze = $_POST['raze'];
        $new_historie = $_POST['historie'];
        if ((!empty($new_raze)) and (!empty($new_historie))) {
            $sql1 = "UPDATE raze SET raze='$new_raze' WHERE ID='$getID'";
            $sql2 = "UPDATE raze SET historie='$new_historie' WHERE ID='$getID'";
            if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
                header("Location: http://zbranedata.jednoduse.cz/hlavni/admin/adminraze.php ");
            } else {
            }
        }
    } else {
        echo '<form method="post" action="">';
        echo '<label for="historie"Historie:</label>';
        echo '<br>';
        echo '<textarea rows="10" cols="50" name="historie"></textarea>';
        echo '<br>';
        echo '<label for="raze">Ráže:</label>';
        echo '<br>';
        echo '<input type="text" name = "raze">';
        echo '<p>';
        echo '<input type="submit" value="Update">';
        echo '</form>';
    }
}
?>