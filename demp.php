<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Content Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .content {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fff;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>File Content Demo</h1>
    <div class="container">
        <?php
        // Define a sample file path
        $filePath = '/var/www/html/nvt/timestamp_tcp'; // Change this path to your test file

        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            echo '<div class="content"><h2>Content of ' . htmlspecialchars(basename($filePath)) . ':</h2><pre>' . htmlspecialchars($content) . '</pre></div>';
        } else {
            echo '<div class="error">File not found: ' . htmlspecialchars($filePath) . '</div>';
        }
        ?>
    </div>
</body>
</html>

