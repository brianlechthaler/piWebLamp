echo “Run this as root.”
sleep 1
echo “I’ll wait a sec before I start in case you accidentally did not run this as root”
sleep 5
apt update
apt upgrade
apt install python-pip
pip freeze --local | grep -v '^\-e' | cut -d = -f 1  | xargs -n1 pip install -U
pip instal flask
echo “Done!”
echo “Rebooting in 10 seconds…”
echo “Press Ctrl+C to cancel.”
sleep 10
reboot