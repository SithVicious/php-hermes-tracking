<?php
header('Content-Type: application/json');
require_once('classes/class.hermes.php');


$tracking = new Tracking_Hermes();

# Will return basic, redacted results
print_r($tracking->getTracking("1234567890123456")); 

# Providing postcode will give full results, address details, GPS coords of delivery and photos if available.
print_r($tracking->getTracking("1234567890123456", "S9 1XX")); 
