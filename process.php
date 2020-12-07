<html>
<!--This file will add the data to the table.  To add the student supplied by user from html form-->
<head>
</head>

<body>
<a href="index.html">Back</a>
  
<?php
	//To check that this page was reached when form was submitted
	if(isset($_POST['submit']))
	{
		//To verify that all info. was passed. Array will store any missing data.
		$data_missing = array();
		
			if(empty($_POST['FLName']))
			{
				//If empty, store inside data_missing array.
				$data_missing[] = 'FLName';
				
			}//end if
			else
			{
				//If it was not empty, store it and trim off any white space that exists.
				$FLName = trim($_POST['FLName']);
				
			}//end else
			if(empty($_POST['Email']))
			{
				//If empty, store inside data_missing array.
				$data_missing[] = 'Email';
				
			}//end if
			else
			{
				//If it was not empty, store it and trim off any white space that exists. $POST will allow us to get access to that data.
				$Email = trim($_POST['Email']);
				
			}//end else
		
			if(empty($_POST['Phone_Number']))
			{
				//If empty, store inside data_missing array.
				$data_missing[] = '4099882042';
				
			}//end if
			else
			{
				//If it was not empty, store it and trim off any white space that exists.
				$Phone_Number = trim($_POST['Phone_Number']);
				
			}//end else
				
			if(empty($_POST['Text_Message']))
			{
				//If empty, store inside data_missing array.
				$data_missing[] = 'Text_Message';
				
			}//end if
			else
			{
				//If it was not empty, store it and trim off any white space that exists.
				$Text_Message = trim($_POST['Text_Message']);
				
			}//end else
			
				
		//To check that all info. was passed.
		if(empty($data_missing))
		{
			//Check if array is empty. If empty, then no errors occurred & all info. was passed in. Locate file with DB connection in it.
			//require_once() statement can be used to include a php file in another one
			require_once('mysql_connect.php');
			
			/*The following is not needed if importing the "mysql_connect.php" connection file
			$dbc = new mysqli("localhost", "studentweb", "turtledove", "test3");
			
			if(mysqli_connect_errno()) {
				printf("Cannot connect: %s\n", mysqli_connect_error());
				exit();
				}
			*/
											
			/*Create a prepared statement that will insert records. To autocreate PK values, use NULL. The ?'s will have mySQL put in info. for every other field.*/
			$query = $dbc->prepare("INSERT INTO messages(FLName, Email, Phone_number, Text_Message)VALUES(?,?,?,?)");
				
			/*Represent a data type for each value to pass in.
			i Integers
			d Doubles
			s Everything Else
			
			Pass in the actual info. that will replace ? marks. Bind the variables to ? marks.*/
			$query->bind_param("ssss", $FLName, $Email, $Phone_Number, $Text_Message);
			
			//To execute query.
			$query->execute();
			
			//The # of rows affected should always come back as 1. In other words, it will execute only one at a time.
			$affected_rows=mysqli_stmt_affected_rows($query);
			
			//To ensure it was one affected row.
			if($affected_rows==1)
			{
				echo 'Submission Complete';
				
				$query->close(); //close statement
				mysqli_close($dbc);  //close DB
				
			}//end if
			
			else
			{
				echo 'Error occurred <br />';
				echo mysqli_error();  //The actual error that occurred.
				
				$query->close();  //close statement
				mysqli_close($dbc);  //close DB
				
			}//end else
				
		}//end if
		
		//If data was missing, and data that we wanted was not passed in.
		else
		{
			echo 'You need to enter the following data <br />';
			
			//To display each piece of data. Take each piece of the array and temporarily store it in missing. 
			foreach($data_missing as $missing)
			{
				echo "$missing <br />";
			}//end foreach
		}//end else
		
	}//end if
  header('Location: http://localhost/VirsyaVardhani_Project1/formcomplete.html');

?>

<!--To allow the user to enter the information again, copy and paste form data-->
	<!-- <form action="http://localhost/studentadded.php" method="post">
		<b>Add a Student:</b>
		
		<p>Student ID:
			<input FLName="FLName" size="5" value="" pattern="^\d{3}" required autofocus />
		</p>
		
		<p>First FLName:
			<input type="text" FLName="Email" size="30" value=""/>
		</p>
			
		<p>Last FLName:
			<input type="text" FLName="Phone_Number" size="30" value=""/>
		</p>
		
		<p>Text_Message:
			<input type="text" FLName="Text_Message" size="30" value=""/>
		</p>
		
		<p>
			<input type="submit" FLName="submit" value="Send"/>
		</p>
	</form> -->
	
</body>
</html>