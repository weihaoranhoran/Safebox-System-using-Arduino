<html>
<head>
<title>history</title>
</head>
<body background="1181834702.gif">
<center>
<h3 align="center"> Security History Record</h3>
<?php
if($_POST)
{
echo "<table style='border: solid 1px black;'>";
echo "<tr><th> Year </th><th> Month </th><th> Day </th><th> Hour </th><th> Minute </th><th> second </th><th> device id </th><th> is safe? </th></tr>";
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 
		$year=$_POST['year'];
		$month=$_POST['month'];
		$servername = 'mysql.ie.cuhk.edu.hk';
		$username = 'ly216';
		$password = 'eiloo1Wo';
		$dbuser='ly216';

		try {
		$conn = new PDO("mysql:host=$servername;dbname=ly216", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE year=2017");$stmt->execute(); 
	if(!isset($_POST["filtered"])){
		if($year!=""&&$month!=""){
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE year=$year AND month=$month"); 
		$stmt->execute();}
		else if($year!=""&&month==""){
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE year=$year"); $stmt->execute();}
		else if($month!=""&&$year==""){
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE month=$month"); $stmt->execute(); }
		else
		{
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history"); 
		$stmt->execute();}
	}
	else{
		if($year!=""&&$month!=""){
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE year=$year AND month=$month AND is_safe='no' "); 
		$stmt->execute();}
		else if($year!=""&&month==""){
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE year=$year AND is_safe='no' "); $stmt->execute();}
		else if($month!=""&&$year==""){
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE month=$month AND is_safe='no' "); $stmt->execute(); }
		else
		{
		$stmt = $conn->prepare("SELECT year, month,day,hour,minute,second,device_id,is_safe FROM history WHERE is_safe='no' "); 
		$stmt->execute();}

	}
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
			echo $v;}
		}
	
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		echo "</table>";	
}

?>
</center>
<p>Click  <a href="switch1.php">here</a> Back to host page.</p>
<p>Click  <a href="history.htm">here</a> Back to history option page.</p>
</body>
</html>

