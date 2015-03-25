<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>
  		Hospital Login Page
  	</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="profile.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


<?php
	include_once("navbar.php"); 
	require 'vendor/autoload.php';
	use Parse\ParseClient;
	use Parse\ParseUser;
	use Parse\ParseException;
	use Parse\ParseQuery;
	use Parse\ParseSessionStorage;
	
	session_start();
	
	ParseClient::initialize('kHbyXSdw4DIXw4Q0DYDcdM8QTDQnOewKJhc9ppAr', '9h80LHVDFOSAgVQ1NSPf5IgaWAaDnHdPoJWt2CDc', '3q1HVOiiywyBdtalMN1sozceJbNXuD9WKZSSmgvI');
	
	ParseClient::setStorage( new ParseSessionStorage() );
	
	$currentUser = ParseUser::getCurrentUser();
	
	if($currentUser)
	{
		echo <<<EOL
		    </head>
		    <body>
		  	<body>
			  <a href="editprofile.php">
				<h3>Edit Profile</h3>
		  		<h1>
			  </a>
EOL;
				echo $currentUser->get("firstname") . "'s Profile";
				echo <<<EOL
		  		</h1>
EOL;
    if($currentUser->get("sex") == "male")
	{
		echo '<img src="bgs/MaleStockPhoto.png"/>';
	}
	else if($currentUser->get("sex") == "female")
	{
		echo '<img src="bgs/FemaleStockPhoto.jpg"/>';
	}
	if($currentUser->get("position") == "patient")
	{
		$query=new ParseQuery("Patient");
		$query->equalTo("email", $currentUser->get("email"));
		$patient=$query->first();
		echo "<h2> Name: " . $patient->get("first_name") . " " . $patient->get("last_name") . "</br>";
		echo "Home: " . $patient->get("address") . ", " . $patient->get("citystate") . "<br>";
		echo "</h2>";
	}
}
	echo <<<EOL
		  		</h2>
		  	</body>

		      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		      <!-- Include all compiled plugins (below), or include individual files as needed -->
		      <script src="js/bootstrap.min.js"></script>
		    </body>
		  </html>
EOL;
?>