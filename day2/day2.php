<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advent of code 2024, day 2</title>
</head>
<body>
    <h1>Text Processing</h1>
    
    <?php
    // Initialize variables
    $inputText = '';
    $result = '';

    function CheckNumbers($numberLine) {
        $increasing = false;
        
        for ($i = 0; $i < count($numberLine); $i++) {
            if ($i == 0) {
                continue;
            } elseif ($i == 1) {
                if ($numberLine[$i] == $numberLine[$i-1] || abs($numberLine[$i] - $numberLine[$i-1]) > 3) {
                    return 0;
                }
                if ($numberLine[1] > $numberLine[0]) {
                    $increasing = true;
                } else {
                    $increasing = false;
                }
            } else {
                if ($numberLine[$i] == $numberLine[$i-1] || abs($numberLine[$i] - $numberLine[$i-1]) > 3) {
                    return 0;
                } 
                if (($numberLine[$i] > $numberLine[$i-1] && !$increasing) || ($numberLine[$i] < $numberLine[$i-1] && $increasing)) {
                    return 0;
                }
                if ($i == count($numberLine) -1) { //last element
                    return 1;
                }
            }
        }
    }

    function ProblemDampener($lineArray) {
        $result = 0;
        for ($i = 0; $i < count($lineArray); $i++) {
            //cut array around index: 0 to $i, $i+1 to end
            $newArray = $lineArray;
            array_splice($newArray, $i, 1);
            $result = CheckNumbers($newArray);
            //echo var_dump($lineArray), "; ", $i, "; ", $result, "<br>\n";
            if ($result) return 1;
        }
        return $result;
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the input text from the form
        if (isset($_POST['inputText'])) {
            $inputText = $_POST['inputText'];
            $lines = explode("\n", $_POST['inputText']);
            $numberMatrix = array();
            
            foreach ($lines as $line) {
                $numberMatrix[] = explode(" ", $line);
            }

            //subtask 1
            //The levels are either all increasing or all decreasing.
            //Any two adjacent levels differ by at least one and at most three.
            $result1 = 0;
            
            foreach ($numberMatrix as $numberLine) {
                $result1 += CheckNumbers($numberLine);
            }

            //subtask 2
            $result2 = 0;

            foreach ($numberMatrix as $numberLine) {
                $result2 += ProblemDampener($numberLine);
            }
        }
    }
    ?>

    <!-- Form for text input -->
    <form method="POST" action="">
        <label for="inputText">Enter your Day 2 input:</label><br>
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
