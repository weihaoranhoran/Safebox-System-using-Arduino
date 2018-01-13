<html>
<head>
    <title>Application Result</title>
    </head>
<body style="background-image: url(white0002.png);background-repeat: no_repeat;">
<?php
if (isset($_REQUEST["act"]) && $_REQUEST["act"]=="reload")
{
    echo '<meta http-equiv="refresh" content="1; url=./switch1.php?act=reload" />';
}
?>

<table border="0"><tr hidden="hidden">
<td><a href="./switch1.php?act=on&d_id=00000001">ON</a></td>
<td>&nbsp;</td>
<td><a href="./switch1.php?act=off&d_id=00000001">OFF</a></td>
<td>&nbsp;</td>
<td><a href="./switch1.php?act=change">Toggle</a></td>
<td>&nbsp;</td>
<td><a href="./switch1.php">Status</a></td>
<td>&nbsp;</td></tr>
<tr>
<td><a href="./switch1.php?act=reoff">reset</a></td>
<td><a href="./switch1.php?act=reload">Auto Update</a></td>
<td><a href="./history.htm"> History</td>
<td><a href="./report.pdf"> Report</td>
</tr>
<tr><td colspan="9">

<?php
//echo 'device id='.htmlspecialchars($_GET["d_id"]);
$file = "../IERG4230exp/blub.txt";
if (isset($_REQUEST["act"]))
{

$num=mysql_numrows($result);
echo $result;
  $year=date("Y");
  $month=date("m");
  $day=date("d");
  $hour=date("H");
  $minute=date("i");
  $second=date("s");
  $is_safe='yes';
 // $test='a';
  //var_dump($test);
 	if ($_REQUEST["act"] == "on") 
		{
		$handle = fopen($file, "w");
		echo 'your belonging is threathen, at the time '.date("Y-m-d h:i:sa");
		fclose($handle);
		$device_id=htmlspecialchars($_GET["d_id"]);
		$servername = 'mysql.ie.cuhk.edu.hk';
		$username = 'ly216';
		$password = 'eiloo1Wo';
		$dbuser='ly216';
		echo '\ndevice id = '.$device_id;
				try {
		$conn = new PDO("mysql:host=$servername;dbname=ly216", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully"; 
		$is_safe='no';
		$sql = "INSERT INTO  history (year, month,day, hour, minute, second,device_id,is_safe) VALUES ($year, $month,$day, $hour, $minute, $second,'$device_id','$is_safe')";
		 $conn->exec($sql);
   		 //echo "New record created successfully";
		}
		catch(PDOException $e)
		{
		echo "Connection failed: " . $e->getMessage();}
		$conn=null;}
		
	elseif ($_REQUEST["act"] == "off")
	{
		$is_safe='yes';
		
		unlink($file); 
		$servername = 'mysql.ie.cuhk.edu.hk';
		$username = 'ly216';
		$password = 'eiloo1Wo';
		$dbuser='ly216';
		$device_id=htmlspecialchars($_GET["d_id"]);
		try {
		$conn = new PDO("mysql:host=$servername;dbname=ly216", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully"; 
		$sql = "INSERT INTO  history (year, month,day, hour, minute, second,device_id,is_safe) VALUES ($year, $month,$day, $hour, $minute, $second,'$device_id','$is_safe')";
        	 $conn->exec($sql);
    		//echo "New record created successfully";
		}
		catch(PDOException $e)
		{
		echo "Connection failed: " . $e->getMessage();}
		$conn=null;}
	elseif ($_REQUEST["act"] == "reoff")
		{
		unlink($file);
		}
	
	elseif ($_REQUEST["act"] =="change")
		{
		if (file_exists($file)) unlink($file); 
		else 
			{
			$handle = fopen($file, "w");
			fclose($handle);
			}
		}
	
	}
if (file_exists($file)) echo '<img src="./blub_on.jpg">';
else  echo '<img src="./blub_off.jpg">';

?>
</td>
</tr></table>
</body>
</html>