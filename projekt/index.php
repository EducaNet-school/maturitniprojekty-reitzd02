<html>

<head>
  <link rel="stylesheet" href="./hlavni/reg-log/stylerl.css" type="text/css" media="screen" />
  <ul>
  </ul>
</head>

<body>
  <div class=vlozeni>
    <form method="post">
      <p style="font-family: Arial; font-size: 24px; font-weight: bold; color: #fff;">Registrace</p>
      <p>E-mail:</p>
      <p>
        <input type="email" id="Email" name="Email" placeholder="email"><br>
      <p>Heslo:</p>
      <input type="password" id="Password" name="Password" placeholder="password"><br>
      <p>Username:</p>
      <input type="text" id="Username" name="Username" placeholder="Username"><br>
      <p>
        <input type="hidden" name="usertype" id="usertype" value=2>
      <p>
        <input type="submit" name="submit">
      <p>
        <a href="http://zbranedata.jednoduse.cz/hlavni/reg-log/login.php" style=" background-color:#fff; font-family: Arial; font-size: 24px; font-weight: bold; color: #000; border-Width: 12px #000 ">jste zaregistrován?</a>
  </div>
</body>

</html>
<?php
session_start();
include 'hlavni/utils/connectToDB.php';
if (!empty($_POST["submit"]) and !empty($_POST["Email"]) and !empty($_POST["Password"]) and !empty($_POST["Username"])) {
  $email = $_POST["Email"];
  $password = $_POST["Password"];
  $username = $_POST["Username"];
  $usertype = $_POST["usertype"];

  if (preg_match('/\.(cz|sk|com|centrum|post|net)$/', $email)) {


    $sqlCe = "select email from email where email = '" . $email . "'";
    $sqlCu = "select username from email where username = '" . $username . "'";
    $resultCe = mysqli_query($conn, $sqlCe);
    $resultCu = mysqli_query($conn, $sqlCu);
    if (mysqli_num_rows($resultCe) > 0) {
      echo "<p class = 'NEP'>omlouváme se, E-mail už je zaregistrován.";
    } else if (mysqli_num_rows($resultCu) > 0) {
      echo "<p class = 'NEP'><omlouváme se, Username už je zaregistrován></p>.";
    } else {
      $sql = "insert into email (email, password,Username, Usertype) values ('$email','$password','$username','$usertype')";
      $result = mysqli_query($conn, $sql);
      header('location: http://zbranedata.jednoduse.cz/hlavni/reg-log/login.php');
    }
  } else {
  }
} else {
}
