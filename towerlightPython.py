import os
from datetime import datetime
import RPi.GPIO as GPIO
import serial
import urllib.request
from urllib.request import urlopen
from time import sleep
import json
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
GPIO.setup(11, GPIO.OUT, initial=GPIO.LOW)                  # t.light green
GPIO.setup(13, GPIO.OUT, initial=GPIO.LOW)                  # t.light red
GPIO.setup(15, GPIO.OUT, initial=GPIO.LOW)                  # buzzer
GPIO.setup(18, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)         # button

# init
x = 400
isBypass = False
isFlag = False
sms = "ALERT! \nResin alarms at: \n"
smsDate = ""
port = serial.Serial('/dev/ttyS0', baudrate=9600, timeout=1)

# SMS Init
port.write(b'AT\r')
sleep(1)

# Sensor / Button
def button_callback(channel):
    global isBypass
    isBypass = True
    print("Stop alarm pressed.")

# Sensor / Button
GPIO.add_event_detect(18,GPIO.RISING,callback=button_callback)

# logic loop
while True :
    # Vars
    isError = False

    # Check Error
    try :
        # Request #Change 127 to IP Address of Guardhouse or SERVER
        target_url = "http://127.0.0.1/project-equipment/server/api.php?mode=20&a=0"
        response = urlopen(target_url)
        dataJson = json.loads(response.read())

        for data in dataJson["data"]["cabinet_info"] :
            if data["dev_status"] == "0" :
                # Set
                isError = True
                isFlag = True

                # Log Time
                if smsDate == "":
                    smsDate = str(datetime.now().strftime("%Y-%m-%d %H:%M:%S"))

                # Log Device
                if not data["dev_name"] in sms :
                    sms += "\n" + data["dev_name"]
    except :
        print("JSON Malfunction or Http failed.")
        sleep(1)
        continue

    # Alarm
    if isError == True :
        # Sensor / Button
        if isBypass == False :
            GPIO.output(11, GPIO.LOW)
            GPIO.output(13, GPIO.HIGH)
            GPIO.output(15, GPIO.HIGH)
        else :
            GPIO.output(11, GPIO.LOW)
            GPIO.output(13, GPIO.HIGH)
            GPIO.output(15, GPIO.LOW)
    else :
        GPIO.output(11, GPIO.HIGH)
        GPIO.output(13, GPIO.LOW)
        GPIO.output(15, GPIO.LOW)
        isBypass = False

    # Debounce
    if x > 300 :
        # SMS
        if isFlag == True :
            # number
            #smsNumber = ["+639988421016", "+639988420964", "+639988420961", "+639988420960", "+639988420977", "+639988420985", "+639988421023", "+639985894347", "+639190662468", "+639992232507", "+639088904134", "+639988420947", "+639988452593", "+639985849330", "+639985849331", "+639988420917", "+639988452590", "+639988421052", "+639209813552", "+639614335484"]
            smsNumber = ["+639614335484"]

            for smsData in smsNumber:
                # time
                smsFull = sms + "\n\n" + smsDate

                # sending
                port.write(b'AT+CMGF=1\r')
                sleep(1)
                port.write(b'AT+CMGS="' + str.encode(smsData) + b'"\r')
                sleep(2)
                port.write(str.encode(smsFull+chr(26)))
                sleep(2)
                print("message sent.")    

            # reset
            x = 1
            isFlag = False
            sms = "ALERT! \nResin alarms at: \n"
            smsDate = ""
    else :
        x = x + 1
    
    # Cycle
    sleep(1)