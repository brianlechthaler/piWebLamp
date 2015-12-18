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
		cp -r weblamp/apache2/cgi-bin/          /usr/lib/cgi-bin/
	echo "Copying files to /var/www/html/"
		cp -r weblamp/apache2/html            /var/www/html/
	echo "Copying lampctl to /usr/local/bin/"
		cp weblamp/apache2/lampctl              /usr/local/bin/lampctl
	echo ""
	echo "Copying configuration files to /etc/apache2/"
		cp weblamp/apache2/etc/apache2.conf     /etc/apache2/apache2.conf
		cp weblamp/apache2/etc/000-default.conf /etc/apache2/sites-enabled/000-default.conf
	echo "Restarting Apache"
		service apache2 reload
	echo ""
	echo "Done."
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
