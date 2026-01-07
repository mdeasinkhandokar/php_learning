<?php
session_start();

// Clear results
if (isset($_GET["clear"])) {
    session_destroy();
    header("Location: results.php");
    exit;
}

$students = $_SESSION["students"] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Results</title>
    <style>
        body { font-family: Arial; }
        table { border-collapse: collapse; width:60%; margin:40px auto; }
        th, td { border:1px solid #000; padding:8px; text-align:center; }
        a { display:block; text-align:center; margin-top:10px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">All Student Results</h2>

<?php if (empty($students)): ?>
    <p style="text-align:center;">No records found.</p>
<?php else: ?>
<table>
    <tr>
        <th>Name</th>
        <th>Total</th>
        <th>Average</th>
        <th>Grade</th>
    </tr>

    <?php foreach ($students as $s): ?>
    <tr>
        <td><?php echo $s["name"]; ?></td>
        <td><?php echo $s["total"]; ?></td>
        <td><?php echo $s["average"]; ?></td>
        <td><?php echo $s["grade"]; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<a href="index.php">Add Student</a>
<a href="results.php?clear=true">Clear Results</a>

</body>
</html>
<?php
session_start();
$results = $_SESSION['results'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Results</title>
</head>
<body>

<nav>
    <a href="form.php">Add Student</a> |
    <a href="results.php">View Results</a>
</nav>
<hr>

<h2>All Student Results</h2>

<?php if (empty($results)): ?>
    <p>No results found.</p>
<?php else: ?>
<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Total</th>
        <th>Average</th>
        <th>Grade</th>
    </tr>

    <?php foreach ($results as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r['name']) ?></td>
        <td><?= $r['total'] ?></td>
        <td><?= $r['average'] ?></td>
        <td><?= $r['grade'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="clear.php">Clear All Results</a>
<?php endif; ?>

</body>
</html>
