#!/bin/sh

# creates directory
mkdir /boot/router
cp /home/pi/install.sh /boot/router

# upgrade and install needed program
apt-get update
apt-get upgrade
apt-get install zip iwlist iwconfig wpasupplicant hostapd dnsmasq iptables lighttpd php5-common php5-cgi php5 vim screen git -y
apt-get purge wolfram-engine

# enable php5 on webserver
lighty-enable-mod fastcgi-php
service lighttpd force-reload

# create and backup config files
mkdir /boot/router/backup
touch /etc/wpa.conf
cp /etc/network/interfaces /boot/router/backup
cp /etc/default/hostapd /boot/router/backup
cp /etc/hostapd/hostapd.conf /boot/router/backup
cp /etc/sysctl.conf /boot/router/backup
cp /boot/cmdline.txt /boot/router/backup
cp /etc/wpa.conf /boot/router/backup

# download router frontend 

# overclock
rm_freq=950 >> /boot/config.txt
core_freq=250 >> /boot/config.txt
sdram_freq=450 >> /boot/config.txt
over_voltage=6 >> /boot/config.txt

# Fix for Edimax usb card
wget http://www.daveconroy.com/wp3/wp-content/uploads/2013/07/hostapd.zip
unzip hostapd.zip 
mv /usr/sbin/hostapd /usr/sbin/hostapd.orig
mv hostapd /usr/sbin/hostapd.edimax 
ln -sf /usr/sbin/hostapd.edimax /usr/sbin/hostapd 
chown root:root /usr/sbin/hostapd 
chmod 755 /usr/sbin/hostapd
