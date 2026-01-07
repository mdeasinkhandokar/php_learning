<!DOCTYPE html>
<html>
<head>
    <title>Student Grade Calculator</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        .box { width:400px; margin:40px auto; background:#fff; padding:20px; }
        input, button { width:100%; padding:8px; margin:6px 0; }
        button { background:#007bff; color:white; border:none; }
        a { display:block; margin-top:10px; text-align:center; }
    </style>
</head>
<body>

<div class="box">
    <h2>Enter Student Marks</h2>

    <form method="POST" action="calculate.php">
        <input type="text" name="name" placeholder="Student Name">

        <input type="number" name="m1" placeholder="Subject 1 Marks">
        <input type="number" name="m2" placeholder="Subject 2 Marks">
        <input type="number" name="m3" placeholder="Subject 3 Marks">
        <input type="number" name="m4" placeholder="Subject 4 Marks">
        <input type="number" name="m5" placeholder="Subject 5 Marks">

        <button type="submit">Calculate Grade</button>
    </form>

    <a href="results.php">View All Results</a>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Student Grade Calculator</title>
</head>
<body>

<h2>Student Grade Calculator</h2>

<nav>
    <a href="index.php">Add Student</a> |
    <a href="results.php">View Results</a>
</nav>
<hr>

<form action="calculate.php" method="post">
    <label>Student Name:</label><br>
    <input type="text" name="name" required><br><br>

    <?php for ($i = 1; $i <= 5; $i++): ?>
        <label>Subject <?= $i ?> Marks:</label><br>
        <input type="number" name="marks[]" min="0" max="100" required><br><br>
    <?php endfor; ?>

    <button type="submit">Calculate Grade</button>
</form>

</body>
</html>
