import RPi.GPIO as GPIO
from flask import Flask, render_template, request
app = Flask(__name__)

GPIO.setmode(GPIO.BCM)

pins = {
25 : {'name' : 'lamp', 'state' : GPIO.LOW}
}

for pin in pins:
    GPIO.setup(pin, GPIO.OUT)
    GPIO.setup(pin, GPIO.LOW)

@app.route("/")
def main():
        for pin in pins:
            pins[pin]['state'] = GPIO.input(pin)
        templateData = {
            'pins' : pins
        }
        return render_template('main.html', **templateData)

@app.route("/<changepin>/<action>")
def action(changePin, action):
    changepin = int(changePin)
    deviceName = pins[changePin]['name']
    if action == "on":
        GPIO.output(changepin, GPIO.HIGH)
        message = "Turned " + deviceName + " ON!"
    if action == "off":
        GPIO.output(changePin, GPIO.LOW)
        message = "Turned " + deviceName + " OFF!"
    if action == "toggle":
        GPIO.output(changePin, not GPIO.input(changePin))
        message = "Toggled " + deviceName + "!"

    for pin in pins:
            pins[pin]['state'] = GPIO.input(pin)

    templateData = {
        'message' : message,
        'pins' : pins
    }

    return render_template('main.html', **templateData)

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=80, debug=True)
