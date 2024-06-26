<!DOCTYPE html>
<html>
<body>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "martin11";
$dbname = "stockexplorer";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }

$user_id = 10000;
$sid = "8b42e";

$sql = "
select 
	c.company_id,
	c.cname, 
    c.sector, 
    c.ebitda, 
    s.sentiment, 
    s.date_shortlisted
from shortlist_contains s
left join public_companies c
	on c.company_id = s.company_id
where s.user_id = '$user_id' and s.sid = '$sid'
";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the data of each row
    echo "<table border='1'>";
    echo "<tr><th>Company ID</th><th>Company Name</th><th>Sector</th><th>EBITDA</th><th>Sentiment</th><th>Date Shortlisted</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['cname'] . "</td>";
        echo "<td>" . $row['sector'] . "</td>";
        echo "<td>" . "$" . $row['ebitda'] . "</td>";
        echo "<td>" . $row['sentiment'] . "</td>";
        echo "<td>" . $row['date_shortlisted'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

;
$conn->close();
?>
</body>
</html>