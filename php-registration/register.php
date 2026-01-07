<?php
// Initialize variables
$name = $email = "";
$errors = [];
$success = false;

// Function to sanitize input
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Form submission check
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check empty fields
    if (empty($_POST["name"])) {
        $errors[] = "Name is required";
    } else {
        $name = cleanInput($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $errors[] = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
    }

    if (empty($_POST["password"]) || empty($_POST["confirm_password"])) {
        $errors[] = "Password and Confirm Password are required";
    } elseif ($_POST["password"] !== $_POST["confirm_password"]) {
        $errors[] = "Passwords do not match";
    }

    // If no errors
    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }
        .container {
            width: 400px;
            background: white;
            padding: 20px;
            margin: 50px auto;
            border-radius: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Registration</h2>

    <!-- Display errors -->
    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='error'>* $error</div>";
        }
    }
    ?>

    <!-- Success Message -->
    <?php if ($success): ?>
        <div class="success">
            <h3>Registration Successful!</h3>
            <p><b>Name:</b> <?php echo $name; ?></p>
            <p><b>Email:</b> <?php echo $email; ?></p>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Enter Name" value="<?php echo $name; ?>">
        <input type="text" name="email" placeholder="Enter Email" value="<?php echo $email; ?>">
        <input type="password" name="password" placeholder="Enter Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
