<?php
require_once 'db_connect.php';

if($_POST) {
    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $emailadd = $_POST["emailadd"];
    $password = $_POST["password"];
    $college = $_POST["college"];
    $program = $_POST["program"];
    $yearlevel = $_POST["yearlevel"];

	// Validate the data (you can add more robust validation)
	if (empty($firstname) || empty($lastname) || empty($emailadd) || empty($password) || empty($college) || empty($program) || empty($yearlevel)) {
		die("Please fill in all fields.");
	}

	$sql = "SELECT * FROM users WHERE username = '$emailadd'";
		
	// Execute the query
	$result = $connect->query($sql);

	if($result->num_rows > 0) {
		echo '<script>alert("Email Address already existed");window.location.href = "../signup.php";</script>';
		return;
	}
	
	$hashedPassword = md5($password);
		// Insert into users table without sanitization (vulnerable to SQL injection)
		$sql = "INSERT INTO users (username, password, email, role) 
				VALUES ('$emailadd', '$hashedPassword', '$emailadd', 'user')";
		if ($connect->query($sql) === FALSE) {
			echo "Error: " . $connect->error;
		}

		// Get the last inserted user ID
		$user_id = $connect->insert_id;

		// Insert into s_users table without sanitization (vulnerable to SQL injection)
		$sql = "INSERT INTO s_users (user_id, fname, lname, college, program, year_level) 
				VALUES ('$user_id', '$firstname', '$lastname', '$college', '$program', '$yearlevel')";

		if ($connect->query($sql) === FALSE) {
			echo "Error: " . $connect->error;
			return;
		}

	echo '<script>alert("' . $valid['messages'] . '"); window.location.href = "../signup.php";</script>';
} $connect->close();


?>
