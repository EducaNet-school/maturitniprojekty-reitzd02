<html>

<head>
    <link rel="stylesheet" href="stylerl.css?rnd=23" media="screen" />
</head>

<body>
    <div class=vlozeni>
        <form method="post">
            <p style="font-family: Arial; font-size: 40px; font-weight: bold; color: #fff;">login</p>
            <p>email:</p>
            <p>
                <input type="email" id="Email" name="Email" placeholder="Email"><br>
            <p>heslo:</p>
            <input type="password" id="Password" name="Password" placeholder="Password"><br>
            <p>
            <p>username:</p>
            <input type="text" id="Username" name="Username" placeholder="Username"><br>
            <p>
                <button style="font-family: Arial; font-size: 24px; font-weight: bold; color: #000;" type="submit" name="submit" id="submit">Login</button>
            <p>
                <a href="http://zbranedata.jednoduse.cz/hlavni/hlavni/reg-log/register.php" style=" background-color:#fff; font-family: Arial; font-size: 24px; font-weight: bold; color: #000; border-Width: 12px #000 ">Nejste zaregistrován?</a>

    </div>
</body>

</html>
<?php
session_start();
if (isset($_POST["submit"]) and isset($_POST["Email"]) and isset($_POST["Password"])) {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Username = $_POST['Username'];


    include '../utils/connectToDB.php';

    $sql = "select * from email where Email = '" . $Email . "'AND Password = '" . $Password . "' AND Username = '" . $Username . "'";
    $GetUsertype = "select usertype from email where Email = '" . $Email . "'AND Password = '" . $Password . "' AND Username = '" . $Username . "'";
    $f1 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $f2 = mysqli_fetch_assoc(mysqli_query($conn, $GetUsertype));
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        if ($f2["usertype"] == 2) {
            $_SESSION['Username'] = $Username;
            $_SESSION['usertype'] = 2;
            header('location: http://zbranedata.jednoduse.cz/hlavni/hlavni/user/usermainmenu.php');
            exit;
        } elseif ($f2["usertype"] == 1) {
            $_SESSION['Username'] = $Username;
            $_SESSION['usertype'] = 1;
            header('location: http://zbranedata.jednoduse.cz/hlavni/hlavni/admin/adminboard.php');
        } elseif ($f2["usertype"] == 3) {
            $_SESSION['Username'] = $Username;
            $_SESSION['usertype'] = 3;
            header('location: http://zbranedata.jednoduse.cz/hlavni/hlavni/reg-log/ban.php');
        }
    } else {
        echo "<p class = NP>Bohužel nejste zaregistrovaný, či jste vloži špatný E-mail/Heslo.</p>";
    }
}
?>