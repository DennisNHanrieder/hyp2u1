<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Money Counter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <hgroup>
        <h1>Money Counter</h1>
        <p>Using Regular Expressions</p>
    </hgroup>

    <h2>Counting Results</h2>
    <?php
    // All the regex processing happens within this PHP block.
    // Everything outside is just static HTML that gets sent back to the client as well.

    // TODO: Declare and initialize a variable that holds the total sum of money.
    $sumMoney = 0;
    // TODO: Get the POST data from the <textarea> that was sent along, when this file was called.
    $message = $_POST['message'];
    // TODO: Create a regular expression that satisfies the money counting conditions from README or the test string.
    // TODO: Start simple by using https://regex101.com/, paste the test string and start with a simple regex first.
    // TODO: Make your regex more extensive until it finds a few amounts of money in the text.
    $pattern = "/^\d+(?:\.\d{2})?(?:.-)? EUR$/";
    preg_match_all($pattern, $message, $matches);
    // TODO: Time to use the regex here in your code. Add a variable for the pattern and add it with a delimiter.
    // TODO: Run it on your input data. You need preg_match_all() because you need to find multiple occurrences of the pattern.
    // TODO: Be sure to add the 3rd parameter $matches so you can get the actual matched strings.
    // TODO: You can use var_dump() to see what $matches holds. https://www.phpliveregex.com/ also shows $matches output.
    for ($i = 0; $i < count($matches[0]); $i++) {
        $sumMoney += floatval($matches[$i]);
    }

    // TODO: Build the sum of your found amounts of money. Create a foreach loop over your $matches array.
    // TODO: Add everything to your total sum. Since the regex returns strings, use floatval() to convert it to decimal numbers.

    // TODO: Last step: Return output.
    // TODO: Return the entered text and the total amount of money.
    return $sumMoney;
    // TODO: To convert the line breaks from the <textarea> (\n) to HTML linebreaks (<br>), use nl2br().
    // TODO: Use number_format() to format the total sum with two decimal digits, "," as thousands separator and "." as the decimal separator.
    number_format($sumMoney, ",", "." );
    echo $sumMoney;
    echo $message;
    // TODO: After you got your first output (probably with an incorrect sum), fine-tune your regex until it matches everything as required.
    // TODO: TODO: You can use (the included) Bootstrap classes to format everything visually if you want.
    ?>
    <p><a href="index.html" class="btn btn-primary">Start Over</a></p>
</div>
</body>
</html>
