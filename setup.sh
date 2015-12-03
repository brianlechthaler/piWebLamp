#!/bin/bash
function initial_setup ()
{
	echo "Updating apt"
	echo ""
		apt-get update
	echo ""
	echo "Installing Apache2"
		apt-get install apache2
	echo "Installing WiringPi"
		apt-get install wiringpi
	echo ""
	echo "Enabling CGI in Apache"
		a2enmod cgi
	setup
}
function setup ()
{
	echo "Run this script using sudo or as root."
		sleep 0.5
	echo "Press Ctl+C in the next 5 seconds if you do not wish for the script to be installed."
	echo "5"
		sleep 1
	echo "4"
		sleep 1
	echo "3"
		sleep 1
	echo "2"
		sleep 1
	echo "1"
		sleep 1
	echo "0"
		sleep 0.5
	echo "Installing..."
	echo ""
	
	echo "Copying lamphtml.sh to /usr/lib/cgi-bin/"
		cp weblamp/apache2/cgi-bin/lamphtml.sh /usr/lib/cgi-bin/lamphtml.sh
		cp weblamp/apache2/cgi-bin/iframe.txt  /usr/lib/cgi-bin/iframe.txt
		cp weblamp/apache2/cgi-bin/iframe.html /usr/lib/cgi-bin/iframe.html
		cp weblamp/apache2/cgi-bin/output.sh   /usr/lib/cgi-bin/output.sh

	echo "Copying index.html to /var/www/html/"
		cp weblamp/apache2/index.html          /var/www/html/index.html 
	echo "Copying lampctl to /usr/local/bin/"
		cp weblamp/apache2/lampctl /usr/local/bin/lampctl
	echo ""
	echo "Copying configuration file to /etc/apache2/apache2.conf"
		cp weblamp/apache2/etc/apache2.conf /etc/apache2/apache2.conf
	echo "Changing permissions of /usr/lib/cgi-bin/"
		chmod 777 /usr/lib/cgi-bin/
		chmod 777 /usr/lib/cgi-bin/*
	echo "Restarting Apache"
		service apache2 restart
	echo ""
	echo "Done."
		sleep 0.5
	echo ""
	echo "To uninstall, run uninstall.sh"
	exit 0
}
case $1 in
	"-i"|"--initial-setup")
		initial_setup
	;;
	*)
		setup
	;;
esac
