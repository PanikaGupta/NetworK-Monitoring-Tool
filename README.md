                                                                            Network Monitoring Tool
Introduction
This Network Monitoring Tool is designed to capture and analyze network traffic on a local area network (LAN). It captures TCP, UDP, and ARP packets and allows users to filter specific fields such as timestamp, source IP, MAC address, destination IP, port, and packet length. The tool provides real-time network traffic data through a web interface, helping users monitor network activity efficiently.

Features
Packet Capture: Capture TCP, UDP, and ARP packets using tcpdump.
Field Selection: Choose specific fields such as source/destination IP, MAC addresses, ports, and packet length for analysis.
Web Interface: Easy-to-use web-based interface built with HTML, CSS, and PHP.
Real-Time Monitoring: View real-time packet information directly from the web interface.
Custom Filters: Apply custom filters to display specific packet information.
Modular Design: Easily extensible and customizable to add more protocols and fields.
Tech Stack
Frontend: HTML, CSS, JavaScript
Backend: PHP, Shell scripting
Database: MySQL (optional, depending on usage)
Packet Capture Tool: tcpdump
Server: Apache HTTP Server
Operating System: Linux (Ubuntu/Debian)
Setup and Installation
Prerequisites
Linux environment (tested on Ubuntu)
Apache server installed
PHP installed (version 7.0 or above)
tcpdump installed
MySQL (if storing user details or logs)
Installation
Clone the repository:

bash
Copy code
git clone https://github.com/<your-username>/network-monitoring-tool.git
cd network-monitoring-tool
Configure Apache:
Make sure the project files are placed in /var/www/html/nvt (or your preferred directory).

Update Apache configuration to point to this directory if necessary:

bash
Copy code
sudo cp -r ./nvt /var/www/html/
sudo chmod -R 755 /var/www/html/nvt
Set Permissions: Ensure that appropriate permissions are set for the nvt folder.

bash
Copy code
sudo chown -R www-data:www-data /var/www/html/nvt
Install tcpdump:

bash
Copy code
sudo apt-get install tcpdump
Configure MySQL (if applicable): Create a MySQL database and table to store user data (optional).

Run the Web Server: Start the Apache web server:

bash
Copy code
sudo service apache2 start
Access the Web Interface: Open your browser and go to:

arduino
Copy code
http://localhost/nvt
Usage
Select Protocol: Choose between TCP, UDP, or ARP.

Choose Fields: Select fields such as source/destination IP, MAC address, port, packet length, etc.

Monitor Network: Click the "Monitor" button to begin capturing and displaying real-time network traffic.

Apply Filters: Use the filter options to refine the packet data displayed.

Example of running a packet capture script:

bash
Copy code
sudo ./process_packetss.sh
File Structure
/nvt/: Main directory for the web interface.
index.html: Main page for network monitoring.
read_content.php: Reads and processes captured packet data.
process_packetss.sh: Bash script to capture and filter packets.
/packet_info/: Directory where packet information is stored in individual files for different fields (e.g., timestamp_tcp, sourceip_udp, etc.).
Security
Ensure that your tcpdump tool is executed with the correct permissions and security precautions, as it requires superuser privileges.
Limit access to the web interface through proper authentication (e.g., HTTP basic auth or OAuth).
License
This project is licensed under the MIT License - see the LICENSE file for details.

Contributing
Feel free to fork the repository, create a new branch, and submit a pull request for any enhancements or bug fixes.

Contact
For any questions, issues, or feature requests, please contact:

Name: Panika Gupta
Email: panikagupta25@gmail.com
