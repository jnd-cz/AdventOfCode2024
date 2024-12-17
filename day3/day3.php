<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advent of code 2024, day 3</title>
</head>
<body>
    <h1>Text Processing</h1>
    
    <?php
    // Initialize variables
    $inputText = '';
    $result = '';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the input text from the form
        if (isset($_POST['inputText'])) {
            $inputText = $_POST['inputText'];
            //$lines = explode("\n", $_POST['inputText']);
            preg_match_all('/mul\(\d{1,3}\,\d{1,3}\)/', $inputText, $mulFunctions);

            //subtask 1
            $result1 = 0;
            
            foreach ($mulFunctions[0] as $mulFunction) {
                preg_match('/(\d{1,3})\,(\d{1,3})/', $mulFunction, $numbers);
                $result1 += $numbers[1] * $numbers[2];
            }

            //subtask 2
            $result2 = 0;
            
            
        }
    }
    ?>

    <!-- Form for text input -->
    <form method="POST" action="">
        <label for="inputText">Enter your Day 3 input:</label><br>
        <textarea id="inputText" name="inputText" rows="6" cols="50"><?= htmlspecialchars($inputText) ?></textarea><br><br>
        <button type="submit">Submit</button>
    </form>

    <!-- Display the result -->
    <?php if (!empty($result1) or !empty($result2)): ?>
        <h2>First task:</h2>
        <p><?= htmlspecialchars($result1) ?></p>
        <h2>Second task:</h2>
        <p><?= htmlspecialchars($result2) ?></p>
    <?php endif; ?>
</body>
</html>
