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
ob_start();
session_start();
if (!isset($_SESSION['Username']) || $_SESSION['usertype'] == 2 || $_SESSION['usertype'] == 3) {
    header("Location: http://zbanedata.jednoduse.cz/hlavni/reg-log/login.php");
    exit();
}
include '../utils/connectToDB.php';

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "select * from druh where druh like '%$search%'";
    $result = mysqli_query($conn, $sql);
} else {
    $sql = "select * from druh";
    $result = mysqli_query($conn, $sql);
}
if (mysqli_num_rows($result) > 0) {
    echo "<div class = select>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Druh</th>";
    echo "<th>Popis durhu</th>";
    echo "</tr>";
    echo "</div>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['druh'] . "</td>";
        echo "<td>" . $row['historie'] . "</td>";
        echo '<td><a href="?edit_id=' . $row['ID'] . '">edit</a></td>';
        echo '<td><a href="?delete_id=' . $row['ID'] . '">delete</a></td>';
        echo "</tr>";
    }
}
echo "</table>";
mysqli_free_result($result);
if (isset($_GET['delete_id'])) {
    $getID = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $sql = "delete druh from druh where ID = $getID ";
    mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) > 0) {
        header("Location: http://zbranedata.jednoduse.cz/hlavni/admin/admindruhy.php");
        exit;
    } else {
    }
}
if (isset($_GET['edit_id'])) {
    $getID = mysqli_real_escape_string($conn, $_GET['edit_id']);
    if (isset($_POST['druh']) && isset($_POST['historie'])) {
        $new_druh = $_POST['druh'];
        $new_historie = $_POST['historie'];
        if ((!empty($new_druh)) and (!empty($new_historie))) {
            $sql1 = "UPDATE druh SET historie='$new_historie' WHERE ID='$getID'";
            $sql2 = "UPDATE druh SET druh='$new_druh' WHERE ID='$getID'";
            if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql1)) {
                header("Location: http://zbranedata.jednoduse.cz/hlavni/admin/admindruhy.php");
            } else {
            }
        }
    } else {
        echo '<form method="post" action="">';
        echo '<label for="historie" Popis:</label>';
        echo '<br>';
        echo '<textarea rows="10" cols="50" name="historie"></textarea>';
        echo '<br>';
        echo '<label for="druh">Druh:</label>';
        echo '<br>';
        echo '<input type="text" name = "druh">';
        echo '<p>';
        echo '<input type="submit" value="Update">';
        echo '</form>';
    }
}
ob_end_flush();
?>