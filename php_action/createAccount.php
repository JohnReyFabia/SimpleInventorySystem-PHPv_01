<?php
require_once 'core.php';

if($_POST) {
    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $emailadd = $_POST["emailadd"];
    $password = $_POST["password"];
    $college = $_POST["college"];
    $program = $_POST["program"];
    $yearlevel = $_POST["yearlevel"];

	$sql = "SELECT * FROM stuser WHERE emailadd = '$emailadd'";
		
	// Execute the query
	$result = $connect->query($sql);

	// Return true if the value exists, false otherwise
	if($result->num_rows > 0) {
		echo '<script>alert("Email Address already existed");window.location.href = "../signup.php";</script>';
		return;
	}
	$sql = "INSERT INTO stuser (firstname, lastname, emailadd, password, college, program, yearlevel) 
				VALUES ('$firstname', '$lastname', '$emailadd', '$password', $college, '$program', '$yearlevel')";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Created";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}
				
				
				// Validate the data (you can add more robust validation)
				  if (empty($firstname) || empty($lastname) || empty($emailadd) || empty($password) || empty($college) || empty($program) || empty($yearlevel)) {
					die("Please fill in all fields.");
				}

    // Hash the password before storing it (improve security)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	
} $connect->close();

echo '<script>alert("' . $valid['messages'] . '"); window.location.href = "../signup.php";</script>';

?>
