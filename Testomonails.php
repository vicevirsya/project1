<?php
$con=mysqli_connect("localhost","root","","code");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM code");

echo "<table border='1'>
<tr>
<th>name</th>
<th>email</th>
<th>Phone Number</th>
<th>Comments</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['number'] . "</td>";
echo "<td>" . $row['comments'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>