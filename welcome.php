<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Analyzer</title>
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
	    background-color: #f4f4f4;
            
        }

        h1 {
            text-align: center;
            margin-top: 100px;
            color: #333;
        }

        .container {
            padding: 20px;
	    width: 60%;
            margin: 0 auto;
            border: 2px solid rgb(36, 23, 42);
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #333;
        }

        .radio-group {
            display: ;
            justify-content: space-around;
            margin-bottom: 15px;
        }

        .radio-group label {
            margin-right: 15px;
        }

        select {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f1f1f1;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #525309;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            margin-top: 15px;
        }

        button:hover {
            background-color: #93944a;
        }

        .alert {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Network Management Tool</h1>
    <div class="container">
        <form action="read_content.php" method="POST">
            <div class="form-group">
                <label for="protocol">Select Protocol:</label>
                <div class="radio-group">
                    <label><input type="radio" name="protocol" value="tcp"> TCP</label>
                    <label><input type="radio" name="protocol" value="udp"> UDP</label>
                    <label><input type="radio" name="protocol" value="arp"> ARP</label>
                </div>
            </div>

            <div class="form-group">
                <label for="fields"style="margin:4px;" >Select Field:</label>
                <select name="field" id="fields">
                    <option value="">Select an option</option>
                    <option value="TimeStamp">Timestamp</option>
                    <option value="SourceIP">Source IP</option>
                    <option value="SourceMac">Source MAC</option>
                    <option value="DestinationIP">Destination IP</option>
                    <option value="DestinationMac">Destination MAC</option>
                    <option value="SourcePort">Source Port</option>
                    <option value="DestinationPort">Destination Port</option>
                    <option value="PacketLength">Packet Length</option>
                </select>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Display errors -->
    <?php 
    if (!empty($error)) {
        echo '<div class="alert">' . $error . '</div>';
    }
    ?>
</body>
</html>

