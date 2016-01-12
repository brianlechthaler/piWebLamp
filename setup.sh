#!/bin/bash
function initial_setup ()
{
	echo "Updating apt"
	echo ""
		apt-get update
	echo ""
	echo "Installing Apache2"
		apt-get install apache2
	echo "Installing MySQL"
		apt-get install mysql-server
	echo "Installing Php5"
		apt-get install php5
		apt-get install php5-mysql
		apt-get install php5-cli
		apt-get install php5-cgi
		apt-get install php5-json
		apt-get install php5-dev
		apt-get install libapache2-mod-php5
	echo "Installing WiringPi"
		apt-get install wiringpi
	echo ""
	echo "Enabling Php in Apache"
		a2enmod php5
	echo "Enabling HTTP2"
		a2enmod h2
	exit 0
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
	single_setup
}
function permanent_setup ()
{
	echo "Run this script using sudo or as root."
		sleep 0.5
	echo "Press Ctl+C in the next 5 seconds if you do not wish for this to be installed permanently."
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
	echo "Installing Permanently..."
	echo ""
	echo "Linking weblamp/php to /srv/www/php"
		rm -rf                                                              /srv/www/php
		ln -sT /home/mel/piWebLamp/weblamp/php/                             /srv/www/php
		chown -R www-data:www-data                                          /srv/www/php
		chmod -R 755                                                        /srv/www/php
	echo "Linking weblamp/html to /srv/www/site"
		rm -rf                                                              /srv/www/site
		ln -sT /home/mel/piWebLamp/weblamp/html/                            /srv/www/site
		chown -R www-data:www-data                                          /srv/www/site
		chmod -R 755                                                        /srv/www/site
	echo "Linking weblamp/lampctl to /usr/local/bin/lampctl"
		rm -rf                                                              /usr/local/bin/lampctl
		ln -sT /home/mel/piWebLamp/weblamp/lampctl                          /usr/local/bin/lampctl
	echo "Linking weblamp/etc/apache2.conf to /etc/apache2/apache2.conf"
		rm -rf                                                              /etc/apache2/apache2.conf
		ln -sT /home/mel/piWebLamp/weblamp/etc/apache2.conf                 /etc/apache2/apache2.conf
	echo "Linking weblamp/etc/lamp-control.conf to /etc/apache2/sites-available/lamp-control.conf"
		rm -rf                                                              /etc/apache2/sites-available/lamp-control.conf
		ln -sT /home/mel/piWebLamp/weblamp/etc/lamp-control.conf            /etc/apache2/sites-available/lamp-control.conf
	echo "Linking weblamp/etc/php.ini to /etc/php/apache2/php.ini"
		rm -rf                                                              /etc/php5/apache2/php.ini
		ln -sT /home/mel/piWebLamp/weblamp/etc/php.ini                      /etc/php5/apache2/php.ini
	echo "Enabling site"
		a2ensite lamp-control.conf
	echo "Restarting Apache"
		service apache2 restart
	echo ""
	echo "Done."
	echo ""
	echo "To uninstall, run uninstall.sh"
	exit 0
}
function single_setup ()
{
	echo "Installing..."
	echo ""
	
	echo "Copying weblamp/php to /srv/www/php"
		rm -rf                                                              /srv/www/php
		cp -r weblamp/php/                                                  /srv/www/php
		chown -R www-data:www-data                                          /srv/www/php
		chmod -R 755                                                        /srv/www/php
	echo "Copying weblamp/html to /srv/www/site"
		rm rf                                                               /srv/www/site
		cp -r weblamp/html                                                  /srv/www/site
		chown -R www-data:www-data                                          /srv/www/site
		chmod -R 755                                                        /srv/www/site
	echo "Copying weblamp/lampctl to /usr/local/bin/lampctl"
		rm -rf                                                              /usr/local/bin/lampctl
		cp weblamp/lampctl                                                  /usr/local/bin/lampctl
	echo "Copying weblamp/etc/apache2.conf to /etc/apache2/apache2.conf"
		rm -rf                                                              /etc/apache2/apache2.conf
		cp weblamp/etc/apache2.conf                                         /etc/apache2/apache2.conf
	echo "Copying weblamp/etc/lamp-control.conf to /etc/apache2/sites-available/lamp-control.conf"
		rm -rf                                                              /etc/apache2/sites-available/lamp-control.conf
		cp weblamp/etc/lamp-control.conf                                    /etc/apache2/sites-available/lamp-control.conf
	echo "Copying weblamp/etc/php.ini to /etc/php/apache2/php.ini"
		rm -rf                                                              /etc/php5/apache2/php.ini
		cp weblamp/etc/php.ini                                              /etc/php5/apache2/php.ini
	echo "Enabling site"
		a2ensite lamp-control.conf
	echo "Restarting Apache"
		service apache2 restart
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
		single_setup
	;;
	"-p"|"--permanent")
		permanent_setup
	;;
	*)
		human_setup
	;;
esac
