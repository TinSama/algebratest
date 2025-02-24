<?php
$tableRows = '';

if (file_exists('words.json')) {
    $words = json_decode(file_get_contents('words.json'), true);

    if (is_array($words)) {
        foreach ($words as $word) {
            if (
                isset($word['word']) &&
                isset($word['letterCount']) &&
                isset($word['consonantCount']) &&
                isset($word['vowelCount'])
            ) {
                $tableRows .= "<tr>
                                <td>{$word['word']}</td>
                                <td>{$word['letterCount']}</td>
                                <td>{$word['consonantCount']}</td>
                                <td>{$word['vowelCount']}</td>
                              </tr>";
            } else {
                $tableRows .= "<tr><td colspan='4'>Nevažeći podaci o riječi.</td></tr>";
            }
        }
    } else {
        $tableRows .= "<tr><td colspan='4'>Nema analiziranih riječi.</td></tr>";
    }
} else {
    $tableRows .= "<tr><td colspan='4'>Nema analiziranih riječi.</td></tr>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = $_POST['word'];

    if (empty($word)) {
        echo "<p>Polje ne smije biti prazno!</p>";
    } else {
        $letterCount = strlen($word);
        $vowelCount = preg_match_all('/[aeiouAEIOU]/', $word);
        $consonantCount = $letterCount - $vowelCount;

        $wordData = [
            'word' => $word,
            'letterCount' => $letterCount,
            'consonantCount' => $consonantCount,
            'vowelCount' => $vowelCount
        ];

        $words = [];
        if (file_exists('words.json')) {
            $words = json_decode(file_get_contents('words.json'), true);
            if (!is_array($words)) {
                $words = [];
            }
        }

        $words[] = $wordData;
        file_put_contents('words.json', json_encode($words));

        header('Location: logic.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Analiza riječi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        input[type="text"] {
            width: 150px;
        }
        button {
            margin-left: 10px;
        }
        .form-container {
            border: none; 
        }
    </style>
</head>
<body>
    <h1>Analiza riječi</h1>
    <table>
        <tr>
            <td class="form-container" style="vertical-align: top; width: 200px;">
                <form method="post" action="">
                    <label for="word">Upišite riječ:</label><br>
                    <input type="text" id="word" name="word" required>
                    <button type="submit">Analiziraj</button>
                </form>
            </td>
            <td style="vertical-align: top;">
                <table>
                    <tr>
                        <th>Riječ</th>
                        <th>Broj slova</th>
                        <th>Broj suglasnika</th>
                        <th>Broj samoglasnika</th>
                    </tr>
                    <?php echo $tableRows; ?>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>