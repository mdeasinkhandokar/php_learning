<?php
// Initialize variables
$name = $email = $subject = $message = "";
$errors = [];
$success = false;

// Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get input values
    $name    = trim($_POST["name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $subject = $_POST["subject"] ?? "";
    $message = trim($_POST["message"] ?? "");

    // 1. Validate required fields
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // 2. Validate email format
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // 3. Validate message length
    if (!empty($message) && strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters.";
    }

    // 4. Validate file upload (optional)
    if (!empty($_FILES["attachment"]["name"])) {
        $allowedTypes = ["image/jpeg", "image/png", "application/pdf"];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($_FILES["attachment"]["type"], $allowedTypes)) {
            $errors[] = "Only JPG, PNG, or PDF files are allowed.";
        }

        if ($_FILES["attachment"]["size"] > $maxSize) {
            $errors[] = "File size must be less than 2MB.";
        }
    }

    // If no errors → sanitize data
    if (empty($errors)) {
        $name    = htmlspecialchars($name);
        $email   = htmlspecialchars($email);
        $subject = htmlspecialchars($subject);
        $message = htmlspecialchars($message);

        // Simulate email sent
        $success = true;

        // Clear form
        $name = $email = $subject = $message = "";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
        textarea {
            height: 100px;
        }
        .error {
            background: #ffe0e0;
            color: red;
            padding: 8px;
            margin-bottom: 10px;
        }
        .success {
            background: #e0ffe0;
            color: green;
            padding: 10px;
            margin-bottom: 10px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Contact Us</h2>

    <!-- Error Messages -->
    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='error'>$error</div>";
        }
    }
    ?>

    <!-- Success Message -->
    <?php if ($success): ?>
        <div class="success">
            Email sent successfully!
        </div>
    <?php endif; ?>

    <!-- Contact Form -->
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Your Name" value="<?php echo $name; ?>">
        <input type="text" name="email" placeholder="Your Email" value="<?php echo $email; ?>">

        <select name="subject">
            <option value="General">General</option>
            <option value="Support">Support</option>
            <option value="Feedback">Feedback</option>
        </select>

        <textarea name="message" placeholder="Your Message"><?php echo $message; ?></textarea>

        <input type="file" name="attachment">

        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>
