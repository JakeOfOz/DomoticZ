<?php
require ('km200.php');

//The base of this script was created by Phoenix_X, and posted on Tweakers.net
//I only made small adjustments to get it working and for readability


/*

1. Remember to place km200.php in the same directory as this file.

2. Make sure you fill in your IP-address and Private key in km200.php

3. In this file, you can select which values you want to pass to Domoticz. If you would pass all of it, the request will take very long and it has little value.

4. In the table below, you add/remove values by adding a line line:
        "nameindomoticz" => km200_GetData("/location/in/km200module")->value,
  
5. Make sure you add the trailing comma.

A full list of location data in the km200 is available at the bottom of this file. 

You can also run km200-allcommands.php to get a full output. 
This will take a little while, but will show you everything that is available including value, min/max$
To test, Firefox will display pretty (readable, tabled) output by default.
For Chrome / Edge, use an extention by searching for something like "JSON view" in the add-on installers.

Use the Lua-script in domoticz to read the values:
domoticz.devices('Temperatuur buiten').updateTemperature(item.json.tempoutdoor)
The last part (item.json.tempoutdoor) is what is specified in this file as:
"tempoutdoor" => km200_GetData("/system/sensors/temperatures/outdoor_t1")->value,

*/

$OutputJSON = array (
        // Add, edit or remove lines below to select data to pass to Domoticz
    //MAKE SURE you add a trailing comma at the end
        "temphc1setpoint" => km200_GetData("/heatingCircuits/hc1/manualRoomSetpoint")->value,
        "temphotwater" => km200_GetData("/dhwCircuits/dhw1/actualTemp")->value,
        "sethotwatercharge" => km200_GetData("/dhwCircuits/dhw1/charge")->value,
        "temphc1supply" => km200_GetData("/heatingCircuits/hc1/actualSupplyTemperature")->value,
        "modulationhc1pump" => km200_GetData("/heatingCircuits/hc1/pumpModulation")->value,
        "temphc1roomactual" => km200_GetData("/heatingCircuits/hc1/roomtemperature")->value,
        "tempappliancesupply" => km200_GetData("/heatSources/applianceSupplyTemperature")->value,
        "sysnumberofstarts" => km200_GetData("/heatSources/numberOfStarts")->value,
        "tempappliancereturn" => km200_GetData("/heatSources/returnTemperature")->value,
        "tempappliancesupplysetpoint" => km200_GetData("/heatSources/supplyTemperatureSetpoint")->value,
        "syshealth" => km200_GetData("/system/healthStatus")->value,
        "tempoutdoor" => km200_GetData("/system/sensors/temperatures/outdoor_t1")->value,
        "syspowerconsumption" => km200_GetData("/heatSources/energyMonitoring/consumption")->value,
        "hotwatercharge" => km200_GetData("/dhwCircuits/dhw1/charge")->value,
        
        "actualCHPower" => km200_GetData("/heatSources/actualCHPower")->value,
        "actualDHWPower" => km200_GetData("/heatSources/actualDHWPower")->value,
        "actualModulation" => km200_GetData("/heatSources/actualModulation")->value,        
        "actualPower" => km200_GetData("/heatSources/actualPower")->value,
        "powerusage" => km200_GetData("/recordings/heatSources/hs1/actualPower")->value
        // Do not modify below.
        );
header('Content-Type: application/json');
echo (json_encode($OutputJSON));

/*
/dhwCircuits/dhw1
/dhwCircuits/dhw1/actualTemp
/dhwCircuits/dhw1/charge
/dhwCircuits/dhw1/chargeDuration
/dhwCircuits/dhw1/cpStartph
/dhwCircuits/dhw1/currentSetpoint
/dhwCircuits/dhw1/operationMode
/dhwCircuits/dhw1/singleChargeSetpoint
/dhwCircuits/dhw1/status
/dhwCircuits/dhw1/switchPrograms
/dhwCircuits/dhw1/tdMode
/dhwCircuits/dhw1/tdsetPoint
/dhwCircuits/dhw1/temperatureLevels
/dhwCircuits/dhw1/temperatureLevels/high
/dhwCircuits/dhw1/temperatureLevels/off
/dhwCircuits/dhw1/waterFlow
/dhwCircuits/dhw1/workingTime
/gateway/boschSHPassword
/gateway/DateTime
/gateway/firmware
/gateway/haiPassword
/gateway/instAccess
/gateway/instPassword
/gateway/instWriteAccess
/gateway/knxPassword
/gateway/portalPassword
/gateway/update
/gateway/userpassword
/gateway/uuid
/gateway/version
/gateway/versionFirmware
/gateway/versionHardware
/heatingCircuits
/heatingCircuits/hc1
/heatingCircuits/hc1/activeSwitchProgram
/heatingCircuits/hc1/actualSupplyTemperature
/heatingCircuits/hc1/controlType
/heatingCircuits/hc1/currentOpModeInfo
/heatingCircuits/hc1/currentRoomSetpoint
/heatingCircuits/hc1/designTemp
/heatingCircuits/hc1/fastHeatupFactor
/heatingCircuits/hc1/heatCurveMax
/heatingCircuits/hc1/heatCurveMin
/heatingCircuits/hc1/manualRoomSetpoint
/heatingCircuits/hc1/nextSetpoint
/heatingCircuits/hc1/operationMode
/heatingCircuits/hc1/pumpModulation
/heatingCircuits/hc1/roomInfluence
/heatingCircuits/hc1/roomtemperature
/heatingCircuits/hc1/roomTempOffset
/heatingCircuits/hc1/setpointOptimization
/heatingCircuits/hc1/solarInfluence
/heatingCircuits/hc1/status
/heatingCircuits/hc1/suWiSwitchMode
/heatingCircuits/hc1/suWiThreshold
/heatingCircuits/hc1/switchPrograms
/heatingCircuits/hc1/switchPrograms/A
/heatingCircuits/hc1/switchPrograms/B
/heatingCircuits/hc1/temperatureLevels
/heatingCircuits/hc1/temperatureLevels/comfort2
/heatingCircuits/hc1/temperatureLevels/eco
/heatingCircuits/hc1/temperatureRoomSetpoint
/heatingCircuits/hc1/temporaryRoomSetpoint
/heatingCircuits/hc1/timeToNextSetpoint
/heatSources
/heatSources/actualCHPower
/heatSources/actualDHWPower
/heatSources/actualModulation
/heatSources/actualPower
/heatSources/actualSupplyTemperature
/heatSources/applianceSupplyTemperature
/heatSources/burnerModulationSetpoint
/heatSources/burnerPowerSetpoint
/heatSources/ChimneySweeper
/heatSources/CHpumpModulation
/heatSources/flameCurrent
/heatSources/flameStatus
/heatSources/gasAirPressure
/heatSources/hs1
/heatSources/hs1/actualCHPower
/heatSources/hs1/actualDHWPower
/heatSources/hs1/actualModulation
/heatSources/hs1/actualPower
/heatSources/hs1/CHpumpModulation
/heatSources/flameCurrent
/heatSources/flameStatus
/heatSources/gasAirPressure
/heatSources/hs1
/heatSources/hs1/actualCHPower
/heatSources/hs1/actualDHWPower
/heatSources/hs1/actualModulation
/heatSources/hs1/actualPower
/heatSources/hs1/CHpumpModulation
/heatSources/hs1/energyReservoir
/heatSources/hs1/flameStatus
/heatSources/hs1/fuel
/heatSources/hs1/fuel/caloricValue
/heatSources/hs1/fuel/density
/heatSources/hs1/fuelConsmptCorrFactor
/heatSources/hs1/info
/heatSources/hs1/nominalCHPower
/heatSources/hs1/nominalDHWPower
/heatSources/hs1/nominalFuelConsumption
/heatSources/hs1/numberOfStarts
/heatSources/hs1/reservoirAlert
/heatSources/hs1/supplyTemperatureSetpoint
/heatSources/hs1/type
/heatSources/info
/heatSources/nominalCHPower
/heatSources/nominalDHWPower
/heatSources/numberOfStarts
/heatSources/powerSetpoint
/heatSources/returnTemperature
/heatSources/supplyTemperatureSetpoint
/heatSources/systemPressure
/heatSources/workingTime
/heatSources/workingTime/centralHeating
/heatSources/workingTime/secondBurner
/heatSources/workingTime/totalSystem
/notifications
/recordings
/recordings/heatingCircuits
/recordings/heatingCircuits/hc1
/recordings/heatingCircuits/hc1/roomtemperature
/recordings/heatSources
/recordings/heatSources/actualCHPower
/recordings/heatSources/actualDHWPower
/recordings/heatSources/actualPower
/recordings/heatSources/hs1
/recordings/heatSources/hs1/actualPower
/recordings/system
/recordings/system/heatSources
/recordings/system/heatSources/hs1
/recordings/system/heatSources/hs1/actualPower
/recordings/system/sensors
/recordings/system/sensors/temperatures
/recordings/system/sensors/temperatures/outdoor_t1
/solarCircuits
/solarCircuits/sc1/collectorTemperature
/solarCircuits/sc1/pumpModulation
/solarCircuits/sc1/solarYield
/solarCircuits/sc1/status
/system
/system/appliance
/system/appliance/actualPower
/system/appliance/actualSupplyTemperature
/system/appliance/ChimneySweeper
/system/appliance/CHpumpModulation
/system/appliance/flameCurrent
/system/appliance/gasAirPressure
/system/appliance/nominalBurnerLoad
/system/appliance/numberOfStarts
/system/appliance/powerSetpoint
/system/appliance/systemPressure
/system/appliance/workingTime
/system/appliance/workingTime/centralHeating
/system/appliance/workingTime/secondBurner
/system/appliance/workingTime/totalSystem
/system/brand
/system/bus
/system/healthStatus
/system/heatSources
/system/heatSources/hs1
/system/heatSources/hs1/actualModulation
/system/heatSources/hs1/actualPower
/system/heatSources/hs1/energyReservoir
/system/heatSources/hs1/fuel
/system/heatSources/hs1/fuel/caloricValue
/system/heatSources/hs1/fuel/density
/system/heatSources/hs1/fuelConsmptCorrFactor
/system/heatSources/hs1/nominalFuelConsumption
/system/heatSources/hs1/reservoirAlert
/system/holidayModes
/system/holidayModes/hm1
/system/holidayModes/hm1/assignedTo
/system/holidayModes/hm1/delete
/system/holidayModes/hm1/dhwMode
/system/holidayModes/hm1/hcMode
/system/holidayModes/hm1/startStop
/system/holidayModes/hm2
/system/holidayModes/hm2/assignedTo
/system/holidayModes/hm2/delete
/system/holidayModes/hm2/dhwMode
/system/holidayModes/hm2/hcMode
/system/holidayModes/hm2/startStop
/system/holidayModes/hm3
/system/holidayModes/hm3/assignedTo
/system/holidayModes/hm3/delete
/system/holidayModes/hm3/dhwMode
/system/holidayModes/hm3/hcMode
/system/holidayModes/hm3/startStop
/system/holidayModes/hm4
/system/holidayModes/hm4/assignedTo
/system/holidayModes/hm4/delete
/system/holidayModes/hm4/dhwMode
/system/holidayModes/hm4/hcMode
/system/holidayModes/hm4/startStop
/system/holidayModes/hm5
/system/holidayModes/hm5/assignedTo
/system/holidayModes/hm5/delete
/system/holidayModes/hm5/dhwMode
/system/holidayModes/hm5/hcMode
/system/holidayModes/hm5/startStop
/system/info
/system/minOutdoorTemp
/system/sensors
/system/sensors/temperatures
/system/sensors/temperatures/chimney
/system/sensors/temperatures/hotWater_t1
/system/sensors/temperatures/hotWater_t2
/system/sensors/temperatures/outdoor_t1
/system/sensors/temperatures/return
/system/sensors/temperatures/supply_t1
/system/sensors/temperatures/supply_t1_setpoint
/system/sensors/temperatures/switch
/system/systemType
*/
?>
