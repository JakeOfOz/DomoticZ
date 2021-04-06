# DomoticZ
For (php) scripts in DomoticZ

I have not created any of the files in this repo, I just combined and edited them to present day versions of firmware, and to work on a Raspberry Pi.


Requirements:
1. Raspberry Pi (tested on model 4B, should also work on newer models)
2. Your Raspberry Pi connected to your local network
3. Your KM200 device connected to your local network
4. Working instance of DomoticZ on your Raspberry Pi  (use: "curl -L https://install.domoticz.com | bash" as the easy way to install)
5. Nginx running on your Raspberry Pi (follow this guide https://www.raspberrypi.org/documentation/remote-access/web-server/nginx.md )
6. 

Steps:

1. place km200.php in your php folder (on my machine it was located in /var/www/html but it might be different on your pi)
  1b. Edit the IP-address and private key in the km200.php file
  
2. place the km200-output.php in the same folder
  2b. Edit the file to which values you want to read
  
3. In Domoticz, create dummy hardware
  Go to Setup > Hardware, create a device with name KM200 (or whatever you like) of the type 'Dummy'
  
4. In the hardware table, under your new device, create new devices by clicking on 'Create Virtual Sensors'
  The names you specify here are used in the Lua-script of the next step!

5. In Domoticz, create a dzVents-Lua-script to read the km200
  Go to Setup > More Options > Events
  Click on the '+' at the top, and select dzVents > Minimal
  Replace all the content with the content in 'km200-read' of this repo

6. Make sure that the names in the dzVents script correspond with the names given in step 4
  
