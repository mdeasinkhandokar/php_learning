<?php
session_start();

// Get data
$name = trim($_POST["name"] ?? "");
$marks = [
    $_POST["m1"] ?? "",
    $_POST["m2"] ?? "",
    $_POST["m3"] ?? "",
    $_POST["m4"] ?? "",
    $_POST["m5"] ?? ""
];

$errors = [];

// Validate name
if (empty($name)) {
    $errors[] = "Student name is required.";
}

// Validate marks
foreach ($marks as $m) {
    if ($m === "" || $m < 0 || $m > 100) {
        $errors[] = "Marks must be between 0 and 100.";
        break;
    }
}

// If error → show message
if (!empty($errors)) {
    echo "<h3>Error</h3>";
    foreach ($errors as $e) {
        echo "<p>$e</p>";
    }
    echo "<a href='index.php'>Go Back</a>";
    exit;
}

// Calculate total & average
$total = array_sum($marks);
$average = $total / 5;

// Determine grade
if ($average >= 90) $grade = "A";
elseif ($average >= 80) $grade = "B";
elseif ($average >= 70) $grade = "C";
elseif ($average >= 60) $grade = "D";
else $grade = "F";

// Store in session
$_SESSION["students"][] = [
    "name" => htmlspecialchars($name),
    "total" => $total,
    "average" => round($average, 2),
    "grade" => $grade
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
    <style>
        body { font-family: Arial; }
        table { border-collapse: collapse; width:50%; margin:40px auto; }
        th, td { border:1px solid #000; padding:8px; text-align:center; }
        a { display:block; text-align:center; margin-top:20px; }
    </style>
</head>
<body>

<table>
    <tr>
        <th>Name</th>
        <th>Total</th>
        <th>Average</th>
        <th>Grade</th>
    </tr>
    <tr>
        <td><?php echo $name; ?></td>
        <td><?php echo $total; ?></td>
        <td><?php echo round($average,2); ?></td>
        <td><?php echo $grade; ?></td>
    </tr>
</table>

<a href="index.php">Add Another Student</a>
<a href="results.php">View All Results</a>

</body>
</html>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

/* Sanitization */
$name = trim(htmlspecialchars($_POST['name']));
$marks = $_POST['marks'];

/* Validation */
$errors = [];

if (empty($name)) {
    $errors[] = "Student name is required.";
}

if (count($marks) !== 5) {
    $errors[] = "All 5 subjects are required.";
}

$total = 0;
foreach ($marks as $m) {
    if (!is_numeric($m) || $m < 0 || $m > 100) {
        $errors[] = "Marks must be between 0 and 100.";
        break;
    }
    $total += $m;
}

if (!empty($errors)) {
    echo "<h3>Error</h3><ul>";
    foreach ($errors as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul><a href='index.php'>Go Back</a>";
    exit;
}

/* Calculation */
$average = $total / 5;

if ($average >= 90) $grade = "A";
elseif ($average >= 80) $grade = "B";
elseif ($average >= 70) $grade = "C";
elseif ($average >= 60) $grade = "D";
else $grade = "F";

/* Store in Session */
$_SESSION['results'][] = [
    'name' => $name,
    'total' => $total,
    'average' => round($average, 2),
    'grade' => $grade
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
</head>
<body>

<nav>
    <a href="index.php">Add Another Student</a> |
    <a href="results.php">View All Results</a>
</nav>
<hr>

<h2>Student Result</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Total</th>
        <th>Average</th>
        <th>Grade</th>
    </tr>
    <tr>
        <td><?= $name ?></td>
        <td><?= $total ?></td>
        <td><?= round($average, 2) ?></td>
        <td><?= $grade ?></td>
    </tr>
</table>

</body>
</html>
