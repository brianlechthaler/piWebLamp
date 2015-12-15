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
	echo "Enabling HTTP2"
		a2enmod h2
	setup
}
function human_setup ()
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
	setup
}
function setup ()
{
	echo "Installing..."
	echo ""
	
	echo "Copying files to /usr/lib/cgi-bin/"
		cp weblamp/apache2/cgi-bin/lamphtml.sh  /usr/lib/cgi-bin/lamphtml.sh
		cp weblamp/apache2/cgi-bin/iframe.txt   /usr/lib/cgi-bin/iframe.txt
		cp weblamp/apache2/cgi-bin/iframe.html  /usr/lib/cgi-bin/iframe.html
		cp weblamp/apache2/cgi-bin/output.sh    /usr/lib/cgi-bin/output.sh
	echo "Copying files to /var/www/html/"
		cp weblamp/apache2/lamp.html            /var/www/html/lamp.html
		cp weblamp/apache2/menu.js              /var/www/html/menu.js
		cp weblamp/apache2/jquery-2.1.4.js      /var/www/html/jquery-2.1.4.js
		cp weblamp/apache2/.htaccess            /var/www/html/.htaccess
	echo "Copying lampctl to /usr/local/bin/"
		cp weblamp/apache2/lampctl              /usr/local/bin/lampctl
	echo ""
	echo "Copying configuration files to /etc/apache2/"
		cp weblamp/apache2/etc/apache2.conf     /etc/apache2/apache2.conf
		cp weblamp/apache2/etc/000-default.conf /etc/apache2/sites-enabled/000-default.conf
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
	"-n"|"--no-delay")
		setup
	;;
	*)
		human_setup
	;;
esac
