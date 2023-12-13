<?php require_once 'php_action/db_connect.php' ?>

<!DOCTYPE html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            padding: 20px;
            width: 100%;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Sign Up</h2>
    <form id="signupForm"  action="php_action/createAccount.php" method="post" >
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>

        <label for="emailadd">Email Address:</label>
        <input type="emailadd" id="emailadd" name="emailadd" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>

        <label for="college">College:</label>
        <select type="dropdown" id="college" name="college" required onchange="onChangeCollege(this.value)">
            <option disabled selected>Select College</option> 
            <option>College of Arts and Humanities</option>
             <option>College of Business and Accountancy</option>
             <option>College of Engineering, Architecture and Technology</option>
             <option>College of Nursing and Health Sciences </option>
             <option>College of Hospitality Management and Tourism</option>
             <option>College of Teacher Education</option>
             <option>College of Sciences</option>
             <option>College of Criminal Justice Education</option>
    </select>

        <label for="program">Program:</label>
        <select type="text" id="program" name="program" required>

    </select>

        <label for="yearlevel">Year Level:</label>
        <select type="text" id="yearlevel" name="yearlevel" required>
            <option value="1" >1st Year</option>
             <option value="2">2nd Year</option>
             <option value="3">3rd Year</option>
             <option value="4">4th Year </option>
             <option value="5">5th Year</option>
    </select>
        <button type="submit">Sign Up</button>

        <p class="error-message" id="passwordError"></p>
    </form>
</div>


</body>
<!-- </html>
```

This code adds a "Confirm Password" input field and a paragraph element to display an error message if the passwords do not match. The JavaScript code has been updated to check for password matching and display an error message accordingly.<script src="custom/js/product.js"></script> -->
<?php require_once 'includes/footer.php'; ?>

<script defer>

function onChangeCollege(college) {
    const programSelect = document.getElementById("program");

    // Clear existing options
    programSelect.innerHTML = '';

    // Define programs based on the selected college
    const programs = getProgramsForCollege(college);
    console.log(programs)

    // Add default option
    const defaultOption = document.createElement("option");
    defaultOption.text = 'Select a Program';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    programSelect.add(defaultOption);

    // Add program options
    programs.forEach(program => {
        const option = document.createElement("option");
        option.text = program;
        programSelect.add(option);
    });
}

// Function to return programs based on the selected college
function getProgramsForCollege(college) {
    switch (college) {
        case "College of Arts and Humanities":
            return ["Bachelor of Science in Social Work", "Bachelor of Science in Psychology", "Bachelor of Science in Political Science", "Bachelor of Arts in Communication", "Bachelor of Arts in Philippine Study"];
        case "College of Business and Accountancy":
            return ["BS Accountancy/BSBA Mgt. Accounting", "BSBA - Human Resource Management", "BSBA - Business Economics", "BSBA - Financial Management", "BSBA - Marketing Management", "BS Entrep - Franchising and Trading", "BS Entrep - Agribusiness", "BS Entrep - Innovation and Technology", "Bachelor of Science in Public Administration"];
        case "College of Engineering, Architecture and Technology":
            return ["Bachelor of Science in Architecture", "Bachelor of Science in Civil Engineering", "Bachelor of Science in Electrical Engineering", "Bachelor of Science in Mechanical Engineering", "Bachelor of Science in Petroleum Engineering"];    
        case "College of Nursing and Health Sciences":
            return ["Bachelor of Science in Nursing", "Bachelor of Science in Midwifery", "Diploma in Midwifert"];
        case "College of Hospitality Management and Tourism":
            return ["Bachelor of Science in Hospitality Management - Cul Arts", "Bachelor of Science in Hospitality Management - Hotel Resort", "Bachelor of Scinece in Tourism Management"];
        case "College of Teacher Education":
            return ["Bachelor of Elementary Education", "Bachelor of Secondary Education - English", "Bachelor of Secondary Education - Filipino", "Bachelor of Secondary Education - Math", "Bachelor of Secondary Education - Science", "Bachelor of Secondary Education - Social Science", "Bachelor of Secondary Education - Values Education", "Bachelor of Physical Education"];
        case "College of Sciences":
            return ["Bachelor of Science in Biology", "Bachelor of Science in Marine Biology", "Bachelor of Scinece in Environmental Science", "Bachelor of Science in Information and Technology", "Bachelor of Science in Computer Science"];
        case "College of Criminal Justice Education":
            return ["Bachelor of Science in Criminology"];  
        
            // Add cases for other colleges as needed
        default:
            return [];
    }
}


</script>