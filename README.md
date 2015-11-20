
#SECTION I: ABOUT
To make a long story short, we have group projects at a school we attend, and for one of these projects our group decided to throw together a super-simple pi-based, web-controlled, lamp.



# SECTION II: SETUP/INSTALLATION


### STEP 0: PARTS LIST


*	**Raspberry Pi running Raspbian**(power supply, sd card, etc…)


*	**Pi Cobbler**


*	**Breadboard Jumper Wires**


*	**Solderless Breadboard** (or you can solder all of this if you're hardcore)


*	**Power Switch Tail II**


*	**Something to connect to the pi** (over the network, or a keyboard+mouse+display to connect directly)

### STEP 1: SETTING UP RASPBIAN

After [putting NOOBS on the Pi and installing Raspbian](https://www.raspberrypi.org/help/noobs-setup/), run the following commands in the console or LXterminal:

* `sudo apt update && sudo apt upgrade`*####Make sure any packages on the Pi are up-to date*

* `sudo reboot`*####Reboot to finish installing packages*

* (Now, wait for the Pi to power back up)
 
* `sudo apt install git python-pip`
  `sudo pip install flask`*####Install dependencies*

### STEP 2: DOWNLOAD THIS REPOSITORY TO THE PI

* `git clone "https://github.com/brianlechthaler/piWebLamp.git"`*####Grab the latest copy of this repository*

* `cd piWebLamp`*####open the repository folder*


### STEP 3: RUN THE SETUP SCRIPT

* `sudo chmod +x setup.sh`*####make sure the script is executable*

* `sudo sh setup.sh`*####run the automated setup script*

**You should be done.  The script sets up the interface to run when the pi boots up, so there is no further action needed. Occasionally you should `cd` to where you cloned the repository to, and run `git pull` to pull down any updates/changes to the repository.  After pulling, re-run the setup script to make sure any new changes are installed.**

