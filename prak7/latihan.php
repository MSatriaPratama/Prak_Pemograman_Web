<?php
$fav_color = '';
$fav_food = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve data from the POST request
    $fav_color = htmlspecialchars($_POST['fav_color']);
    $fav_food = htmlspecialchars($_POST['fav_food']);
}

// Check if data is passed via GET
if (isset($_GET['fav_color']) && isset($_GET['fav_food'])) {
    $fav_color = htmlspecialchars($_GET['fav_color']);
    $fav_food = htmlspecialchars($_GET['fav_food']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit Color dan Makanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #e7f3fe;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Favorit Color dan Makanan</h2>
        <form action="" method="post">
            <label for="fav_color">Warna Favorit:</label>
            <input type="text" id="fav_color" name="fav_color" required>
            
            <label for="fav_food">Makanan Favorit:</label>
            <input type="text" id="fav_food" name="fav_food" required>
            
            <input type="submit" value="Kirim">
        </form>

        <?php if ($fav_color && $fav_food): ?>
        <div class="result">
            <h3>Data yang Diterima:</h3>
            <p><strong>Warna Favorit:</strong> <?php echo $fav_color; ?></p>
            <p><strong>Makanan Favorit:</strong> <?php echo $fav_food; ?></p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
