#!/bin/bash
if [ $? -ne 0 ]; then
    echo "An error occurred."
    exit 1
fi

echo "testing testninfhh"
# Capture 2000 packets and save to packets.pcap
tcpdump -ne -c 2000 -w packets.pcap
if [ $? -ne 0 ]; then
    echo "An error occurred."
    exit 1
fi


# Filter and save ARP, UDP, and TCP packets into separate pcap files
tcpdump -ne -r packets.pcap arp -w arp_packets.pcap
tcpdump -ne -r packets.pcap udp -w udp_packets.pcap
tcpdump -ne -r packets.pcap tcp -w tcp_packets.pcap
if [ $? -ne 0 ]; then
    echo "An error occurred."
    exit 1
fi


# Convert pcap files to text for further processing
tcpdump -ne -r arp_packets.pcap > arp_packets.txt
tcpdump -ne -r udp_packets.pcap > udp_packets.txt
tcpdump -ne -r tcp_packets.pcap > tcp_packets.txt

# Process ARP packets
cut -d " " -f 1 arp_packets.txt > timestamp_arp
cut -d " " -f 2 arp_packets.txt > sourcemac_arp
cut -d " " -f 4 arp_packets.txt > dmac_arp
cut -d "," -f 1 dmac_arp > destinationmac_arp
cut -d " " -f 12 arp_packets.txt > sourceip_arp
cut -d " " -f 14 arp_packets.txt > dip_arp
cut -d "," -f 1 dip_arp > destinationip_arp
cut -d " " -f 9 arp_packets.txt > plength_arp

# Process UDP packets
cut -d " " -f 1 udp_packets.txt > timestamp_udp
cut -d " " -f 2 udp_packets.txt > sourcemac_udp
cut -d " " -f 4 udp_packets.txt > dmac_udp
cut -d "," -f 1 dmac_udp > destinationmac_udp
cut -d " " -f 10 udp_packets.txt > Sourceip_udp
cut -d " " -f 12 udp_packets.txt > dip_udp
cut -d "." -f 1-4 dip_udp > destinationip_udp
cut -d "." -f 5 dip_udp > d_port_udp
cut -d ":" -f 1 d_port_udp > destinationport_udp
cut -d " " -f 9 udp_packets.txt > plength_udp
cut -d ":" -f 1 plength_udp > pack_length_udp
cut -d "." -f 5 Sourceip_udp > sourceport_udp
cut -d "." -f 1-4 Sourceip_udp > sourceip_udp

# Process TCP packets
cut -d " " -f 1 tcp_packets.txt > timestamp_tcp
cut -d " " -f 2 tcp_packets.txt > sourcemac_tcp
cut -d " " -f 4 tcp_packets.txt > dmac_tcp
cut -d "," -f 1 dmac_tcp > destinationmac_tcp
cut -d " " -f 10 tcp_packets.txt > Sourceip_tcp
cut -d " " -f 12 tcp_packets.txt > dip_tcp
cut -d "." -f 1-4 dip_tcp > destinationip_tcp
cut -d "." -f 5 dip_tcp > d_port_tcp
cut -d ":" -f 1 d_port_tcp > destinationport_tcp
cut -d " " -f 9 tcp_packets.txt > plength_tcp
cut -d ":" -f 1 plength_tcp > pack_length_tcp
cut -d "." -f 5 Sourceip_tcp > sourceport_tcp
cut -d "." -f 1-4 Sourceip_tcp > sourceip_tcp
