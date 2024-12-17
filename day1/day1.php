<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advent of code, day 1</title>
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
            $lines = explode("\n", $_POST['inputText']);
            $columnA = array();
            $columnB = array();
            for ($i = 0; $i < count($lines); $i++) {
                if (preg_match('/(\d+)\s+(\d+)/', $lines[$i], $numbers)) {
                    $columnA[] = $numbers[1];
                    $columnB[] = $numbers[2];
                }
            }

            //subtask 2
            $numberFrequency = array();
            foreach ($columnB as $numberB) {
                if (isset($numberFrequency[$numberB])) {
                    $numberFrequency[$numberB] += 1;
                } else {
                    $numberFrequency[$numberB] = 1;
                }
            }
            $similarity = 0;
            foreach ($columnA as $numberA) {
                if (isset($numberFrequency[$numberA])) {
                    $similarity += $numberA * $numberFrequency[$numberA];
                }
            }
            
            $result2 = $similarity;
            
            //subtask 1
            sort($columnA);
            sort($columnB);
            $distance = 0;
            
            //echo var_dump($columnA), " ", var_dump($columnB);
            for ($i = 0; $i < count($columnA); $i++) {
                $distance += abs($columnB[$i] - $columnA[$i]);
            }
            
            $result1 = $distance;
        }
    }
    ?>

    <!-- Form for text input -->
    <form method="POST" action="">
        <label for="inputText">Enter your Day 1 input:</label><br>
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
