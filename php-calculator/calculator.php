<?php
// Initialize variables
$num1 = $num2 = "";
$operation = "";
$result = "";
$error = "";

// Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capture POST data
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operation = $_POST["operation"];

    // Validate numeric values
    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = "Please enter valid numbers.";
    } else {
        // Perform operation
        switch ($operation) {
            case "+":
                $result = $num1 + $num2;
                break;

            case "-":
                $result = $num1 - $num2;
                break;

            case "*":
                $result = $num1 * $num2;
                break;

            case "/":
                if ($num2 == 0) {
                    $error = "Cannot divide by zero.";
                } else {
                    $result = $num1 / $num2;
                }
                break;

            default:
                $error = "Please select an operation.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculator</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
        }
        .calculator {
            width: 300px;
            margin: 60px auto;
            background: #222;
            padding: 20px;
            border-radius: 10px;
            color: white;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            font-size: 16px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .result {
            background: #000;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
        }
        .error {
            background: #ff4d4d;
            padding: 8px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="calculator">
    <h2 style="text-align:center;">Calculator</h2>

    <!-- Calculator Form -->
    <form method="POST" action="">
        <input type="text" name="num1" placeholder="First Number" value="<?php echo $num1; ?>">
        <input type="text" name="num2" placeholder="Second Number" value="<?php echo $num2; ?>">

        <select name="operation">
            <option value="">Select Operation</option>
            <option value="+" <?php if($operation=="+") echo "selected"; ?>>+</option>
            <option value="-" <?php if($operation=="-") echo "selected"; ?>>-</option>
            <option value="*" <?php if($operation=="*") echo "selected"; ?>>×</option>
            <option value="/" <?php if($operation=="/") echo "selected"; ?>>÷</option>
        </select>

        <button type="submit">Calculate</button>
    </form>

    <!-- Display Error -->
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Display Result -->
    <?php if ($result !== "" && !$error): ?>
        <div class="result">
            Result: <?php echo $result; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
