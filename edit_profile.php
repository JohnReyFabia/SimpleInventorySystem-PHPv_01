<?php require_once 'includes/S_header.php'; ?>
<?php require_once 'php_action/db_connect.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-check"></i> Edit Profile
            </div>
            <!-- /panel-heading -->
            <div class="panel-body">
                <form class="form-horizontal" id="editProfileForm" action="updateProfile.php" method="post">
                    <!-- Fetch user data from the database and assign it to variables -->
                    <?php
                    // Assuming you have a user ID, fetch user data using a query
					 $userId = 15;
                    // Fetch user data from the database
                    $userData = getUserData($userId);

                    // Assign user data to variables
                    $studentNumber = $userData['emailadd'];
                    $lastName = $userData['lname'];
                    $firstName = $userData['fname'];
                    $college = $userData['college'];
                    $program = $userData['program'];
                    $yearLevel = $userData['year_level'];
                    ?>

                    <div class="form-group">
                        <label for="studentNumber" class="col-sm-3 control-label">Student Number </label>
                        <div class="col-sm-8">
						
                            <input type="text" class="form-control" id="studentNumber" name="studentNumber" value="<?php 
							$year = substr($studentNumber, 0, 4);
							$semester = substr($studentNumber, 4, 1);
							$serialNumber = substr($studentNumber, 5, 4);
							$formattedStudentNumber = $year . '-' . $semester . '-' . $serialNumber;

						 echo $formattedStudentNumber ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="col-sm-3 control-label">Last name </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstName" class="col-sm-3 control-label">First name </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="college" class="col-sm-3 control-label">College </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="college" name="college" value="<?php echo $college; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="program" class="col-sm-3 control-label">Program </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="program" name="program" value="<?php echo $program; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="yearLevel" class="col-sm-3 control-label">Year Level </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="yearLevel" name="yearLevel" value="<?php echo $yearLevel ." Year"; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /panel-body -->
        </div>
    </div>
    <!-- /col-md-12 -->
</div>
<!-- /row -->

<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>

<?php
// Function to fetch user data from the database
function getUserData($userId) {
    global $connect; // Access the global $connect variable

    // Replace this query with your actual database query to fetch user data
    $query = "SELECT * FROM s_users WHERE user_id = $userId";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        // Fetch the user data as an associative array
        $userData = $result->fetch_assoc();
        return $userData;
    } else {
        // Handle the case where no user data is found
        return null;
    }
}
?>
