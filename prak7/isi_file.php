<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data Tersimpan</title>
    <style>
        /* Style untuk tampilan konten */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 700px;
            width: 90%;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            color: #444;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .file-content {
            background-color: #f7f9fc;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
        .file-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .message {
            color: #777;
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
        }
        .redirect-button {
            width: 20%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Data Tersimpan</h2>
        <button class="redirect-button" onclick="window.location.href='index.php';">Kembali</button>
        <?php
        // Direktori folder tempat file disimpan
        $uploadFolder = __DIR__ . "/uploads/";

        // Cek apakah folder uploads ada dan tidak kosong
        if (is_dir($uploadFolder) && $handle = opendir($uploadFolder)) {
            $filesFound = false;

            // Loop untuk membaca setiap file .txt dalam folder
            while (($file = readdir($handle)) !== false) {
                $filePath = $uploadFolder . $file;

                // Cek apakah file adalah file .txt
                if (pathinfo($filePath, PATHINFO_EXTENSION) === 'txt') {
                    $filesFound = true;
                    echo "<div class='file-content'>";
                    echo "<p class='file-name'>File: $file</p>";
                    echo "<p>" . nl2br(file_get_contents($filePath)) . "</p>";
                    echo "</div>";
                }
            }
            closedir($handle);

            // Jika tidak ada file .txt di folder
            if (!$filesFound) {
                echo "<p class='message'>Tidak ada file .txt yang ditemukan di folder uploads.</p>";
            }
        } else {
            echo "<p class='message'>Folder uploads tidak ditemukan atau kosong.</p>";
        }
        ?>
    </div>
</body>
</html>
