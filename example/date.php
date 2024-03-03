<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Date Conversion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <hgroup>
        <h1>Date Conversion</h1>
        <p>Using Regular Expressions</p>
    </hgroup>

    <h2>Conversion Result</h2>
    <?php
    if (isset($_POST["date"]) && mb_strlen($_POST["date"]) !== 0) {
        $date = $_POST["date"];

        if (preg_match("/(^[0-9]{4})-(\d{1,2})-([[:digit:]]{1,2}$)/", $date, $matches)) {
            echo "<p class='text-bg-success p-3'>$matches[3].$matches[2].$matches[1]</p>";
            // This debug output shows what $matches contains
            var_dump($matches);
        } else {
            echo "<p class='text-bg-danger p-3'>Error: Invalid format \"$date\".</p>";
        }
    } else {
        echo "<p class='text-bg-danger p-3'>Error: No input specified.</p>";
    }
    ?>
    <p><a href="index.html" class="btn btn-primary">Start Over</a></p>
</div>
</body>
</html>
