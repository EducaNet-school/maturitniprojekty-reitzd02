<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="stylesheet.css?rnd=23" media="screen" />
</head>
<?php
include '../utils/usernavbar.php';
?>

<body>
  <script>
    if (window.history.replace) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>

<?php
session_start();
if (!isset($_SESSION['Username'])) {
  header("location: http://zbranedata.jednoduse.cz/hlavni/reg-log/login.php");
}
include '../utils/connectToDB.php';
?>