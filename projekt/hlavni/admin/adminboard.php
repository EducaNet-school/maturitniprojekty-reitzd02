<html>
<?php
include '../utils/navbar.php';
?>

<body>
    <form method="post">
        <input type="text" name="search" placeholder="Vyhledat uživatele....">
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
    $sql = "select * from email where username like '%$search%'";
    $searchResult = mysqli_query($conn, $sql);
} else {
    $sql = "select * from email";
    $searchResult = mysqli_query($conn, $sql);
}

if (mysqli_num_rows($searchResult) > 0) {
    echo "<div class='select'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Email</th>";
    echo "<th>Username</th>";
    echo "<th>Usertype</th>";
    echo "</tr>";
    echo "</div>";
    while ($row = mysqli_fetch_array($searchResult)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
        echo "<td>" . $row['Username'] . "</td>";
        echo "<td>" . $row['usertype'] . "</td>";
        echo '<td><a href="?delete_id=' . $row['ID'] . '">delete</a></td>';
        echo '<td><a href="?edit_id=' . $row['ID'] . '">edit</a></td>';
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($searchResult);

    if (isset($_GET['delete_id'])) {
        $getID = mysqli_real_escape_string($conn, $_GET['delete_id']);
        $sql = "delete from email where ID = $getID ";
        mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            header("Location: http://zbranedata.jednoduse.cz/hlavni/hlavni/admin/adminboard.php");
            exit;
        } else {
        }
    }
    if (isset($_GET['edit_id'])) {
        $getID = mysqli_real_escape_string($conn, $_GET['edit_id']);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_usertype = $_POST['usertype'];
        }
        if ((!empty($new_usertype))) {
            $sql = "UPDATE email SET usertype='$new_usertype' WHERE ID='$getID'";
            if (mysqli_query($conn, $sql)) {
                header("Location: http://zbranedata.jednoduse.cz/hlavni/hlavni/admin/adminboard.php");
            } else {
            }
        } else {
            echo '<form method="post" action="">';
            echo '<label for="usertype">New usertype:</label>';
            echo '<select id="usertype" name="usertype">';
            $sqlu = "select type from usertype";
            $result =  mysqli_query($conn, $sqlu);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['type'] . "'>" . $row['type'] . "</option>";
            }
            echo '</select>';
            echo '<p>';
            echo '<input type="submit" value="Update">';
            echo '</form>';
        }
    }
}
