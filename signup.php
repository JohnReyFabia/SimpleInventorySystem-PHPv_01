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
        <input type="text" id="college" name="college" required>

        <label for="program">Program:</label>
        <input type="text" id="program" name="program" required>

        <label for="yearlevel">Year Level:</label>
        <input type="text" id="yearlevel" name="yearlevel" required>

        <button type="submit">Sign Up</button>

        <p class="error-message" id="passwordError"></p>
    </form>
</div>


</body>
<!-- </html>
```

This code adds a "Confirm Password" input field and a paragraph element to display an error message if the passwords do not match. The JavaScript code has been updated to check for password matching and display an error message accordingly.<script src="custom/js/product.js"></script> -->
<?php require_once 'includes/footer.php'; ?>
