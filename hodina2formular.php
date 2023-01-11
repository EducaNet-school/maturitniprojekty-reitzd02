<html>
    <body>
        <form method = post>
            <p>jmeno a prijmeni:
            <p>
                <input type = text id=jmeno name = "jmeno"> <br>
            <p>adresa:
            <p>
                <input type = text id =adresa name = "adresa"> <br>
            <p>
                <input type =  submit id = submit name = "submit"> <br>
        </form>
    </body>
</html>
<?php
 if(isset($_POST['submit'])){
    $name = $_POST['jmeno'];
    if (strpos($name, ' ') !== false) {
        echo "jmeno fungujde";
    } else {
        echo "nejde";
    }
    $name = $_POST['adresa'];
    if (strpos($name, ' ') !== false) {
        echo "adresa funguje";
    } else {
        echo "nejde";
    }

 }
?>