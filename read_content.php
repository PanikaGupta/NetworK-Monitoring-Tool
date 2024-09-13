<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Content</title>
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
            width: 50%;
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
    
    <div class="container">
        <?php
        // Define file names for different protocols
        $files = [
            'TCP' => [
                'TimeStamp' => 'timestamp_tcp',
                'SourceMac' => 'sourcemac_tcp',
                'DestinationMac' => 'destinationmac_tcp',
                'SourceIP' => 'Sourceip_tcp',
                'DestinationIP' => 'destinationip_tcp',
                'SourcePort' => 'sourceport_tcp',
                'DestinationPort' => 'destinationport_tcp',
                'PacketLength' => 'pack_length_tcp',
            ],
            'UDP' => [
                'TimeStamp' => 'timestamp_udp',
                'SourceMac' => 'sourcemac_udp',
                'DestinationMac' => 'destinationmac_udp',
                'SourceIP' => 'Sourceip_udp',
                'DestinationIP' => 'destinationip_udp',
                'SourcePort' => 'sourceport_udp',
                'DestinationPort' => 'destinationport_udp',
                'PacketLength' => 'pack_length_udp',
            ],
            'ARP' => [
                'TimeStamp' => 'timestamp_arp',
                'SourceMac' => 'sourcemac_arp',
                'DestinationMac' => 'destinationmac_arp',
                'SourceIP' => 'Sourceip_arp',
                'DestinationIP' => 'destinationip_arp',
                'SourcePort' => '', // ARP doesn't use SourcePort
                'DestinationPort' => '', // ARP doesn't use DestinationPort
                'PacketLength' => 'pack_length_arp',
            ],
        ];

        // Handle form submission
        $protocol = isset($_POST['protocol']) ? $_POST['protocol'] : '';
        $field = isset($_POST['field']) ? $_POST['field'] : '';

        if (empty($protocol) || empty($field)) {
            echo '<div class="error">Please select both protocol and field.</div>';
        } else {
            $protocol = strtoupper($protocol); // Convert to uppercase to match the array keys

            if (isset($files[$protocol][$field]) && !empty($files[$protocol][$field])) {
                $fileName = $files[$protocol][$field];
                $filePath = '/var/www/html/nvt/' . $fileName;

                if (file_exists($filePath)) {
                    $content = file_get_contents($filePath);

                    if (empty($content)) {
                        echo '<div class="content">The file is empty: ' . htmlspecialchars($protocol)." " .htmlspecialchars($field) .'</div>';
                    } else {
                        echo '<div class="content"><h2 style="text-align:center;">' . htmlspecialchars($protocol) . ' - ' . htmlspecialchars($field) . ':</h2><pre>' . htmlspecialchars($content) . '</pre></div>';
                    }
                } else {
                    echo '<div class="error">File not found: ' . htmlspecialchars($filePath) . '</div>';
                }
            } else {
                echo '<div class="error">Selected field is not available for this protocol.</div>';
            }
        }
        ?>
    </div>
</body>
</html>

