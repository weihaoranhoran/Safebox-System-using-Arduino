<html>
<head><title> the test </title></head>
<body>
 "bitch: begin";
<?php

$servername = 'mysql.ie.cuhk.edu.hk';
$username = 'ly216';
$password = 'eiloo1Wo';
$dbuser='ly216';

try {
    $conn = new PDO("mysql:host=$servername;dbname=ly216", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();}

    ?>
bitch: end
</body>
</html>