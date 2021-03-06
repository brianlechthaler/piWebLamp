echo “Run this as root.”
	sleep 1
echo “I’ll wait a sec before I start in case you accidentally did not run this as root”
	sleep 5
echo "Installing Apache2"
echo ""
	apt-get update
	apt-get install apache2
echo ""
echo "Enabling CGI in Apache"
	a2enmod cgi
echo "Copying lamphtml.sh to /usr/lib/cgi-bin/"
	cp weblamp/cgi-bin/lamphtml.sh /usr/lib/cgi-bin/lamphtml.sh
	cp weblamp/cgi-bin/iframe.txt /usr/lib/cgi-bin/iframe.txt
	cp weblamp/cgi-bin/iframe.html /usr/lib/cgi-bin/iframe.html
echo "Copying lampctl to /usr/local/bin/"
	cp weblamp/lampctl /usr/local/bin/lampctl
echo ""
echo "Copying configuration file to /etc/apache2/apache2.conf"
	cp weblamp/etc/apache2.conf /etc/apache2/apache2.conf
echo "Changing permissions of /usr/lib/cgi-bin/"
	chmod 777 /usr/lib/cgi-bin/
	chmod 777 /usr/lib/cgi-bin/*
echo "Done!"
echo "Rebooting in 10 seconds ..."
echo "Press Ctrl+C to cancel."
	sleep 10
	shutdown -r now
