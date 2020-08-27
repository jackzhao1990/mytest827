<!DOCTYPE html>
<html>
<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "mytest";
	$connect = mysqli_connect($server, $username, $password, $database);


 	$results = $connect->query("SELECT users.id, GROUP_CONCAT( teams.name ) as team_names, CONCAT( users.first_name, ' ', users.last_name ) as full_name FROM users LEFT JOIN teams_users ON users.id = teams_users.user_id LEFT JOIN teams ON teams_users.team_id = teams.id where users.id<0 GROUP BY users.id");

 	$users = array();  // define Users array
 	while($user = $results->fetch_assoc()) {        // insert data into users array by using "while"
		$users[] = $user;
	}
?>

<head>
	<title>My Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<style>
		div.location{
			margin-top: 10%;
		}
		th {
			font-size: 30px;
			color: #008000;
		}
		td {
			font-size: 20px;
		}
		h1 {
			text-align: center;
			color: #ff0000;
		}
	</style>
</head>
<body>
	<div class="container location">
		<h1>Thank You For Sharing The Test</h1>
		<table class="table table-bordered">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Teams</th>
			</tr>
			<!-- confirm the array's data  -->
			<?php if(count($users) > 0) {             
				foreach($users as $id=>$user) {  ?>
					<tr>
						<td><?php echo $user['id'] ?></td>
						<td><?php echo $user['full_name'] ?></td>
						<td><?php echo $user['team_names'] ?></td>
					</tr>
	    	<?php } } ?>	
	    	<!-- in case of no data -->
	    	<?php if(count($users) === 0) { ?>
	    		<tr>
	    			<td colspan="3">Sorry, Please check your data.</td>
	    		</tr>
	    	<?php } ?>
		</table>
	</div>		
</body>
</html>