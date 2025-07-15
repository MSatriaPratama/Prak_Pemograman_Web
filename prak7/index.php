<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Input Form</title>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Form and content styling */
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
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"],
        .redirect-button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        input[type="submit"]:hover,
        .redirect-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Input Form</h2>

        <?php
        if (isset($_POST['submit'])) {
            // Retrieve data from the form inputs
            $name = $_POST['nama'];
            $email = $_POST['email'];
            $phone = $_POST['telepon'];
            $address = $_POST['alamat'];
            $timestamp = time();

            // Combine data into a single string
            $content = "Name: $name\nEmail: $email\nPhone: $phone\nAddress: $address\n";

            // New .txt file name
            $fileName = "data_" . date("Y-m-d", $timestamp) . ".txt";
            $uploadFolder = __DIR__ . "/uploads/";

            // Create 'uploads' folder if it doesn't exist
            if (!is_dir($uploadFolder)) {
                mkdir($uploadFolder, 0777, true);
            }

            // Path to save the .txt file
            $filePath = $uploadFolder . $fileName;

            // Save data to the .txt file
            if (file_put_contents($filePath, $content) !== false) {
                // Data successfully saved
                echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Data has been saved as $fileName in the uploads folder.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    }, 100);
                </script>";
            } else {
                // Error saving data
                echo "<script>
                    setTimeout(function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while saving data to the file.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }, 100);
                </script>";
            }
        }
        ?>

        <form action="" method="post">
            <label for="nama">Name:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telepon">Phone:</label>
            <input type="text" id="telepon" name="telepon" required>

            <label for="alamat">Address:</label>
            <textarea id="alamat" name="alamat" rows="4" required></textarea>

            <input type="submit" name="submit" value="Save as TXT">
        </form>

        <!-- Button to redirect to Isi_File.php -->
        <button class="redirec
