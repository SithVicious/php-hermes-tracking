# php-hermes-tracking
Scrapes tracking data from UK Hermes website

# Introduction
This uses the official Hermes website to gather tracking details, however does so in a clandestine way.
Hermes tracking site includes their own API key to make calls and simply returns JSON, everything is wide open for us to see

# Installation
Nothing fancy, just copy/paste the class and tailor your code around the example.

# Usage
Check example.php

```php
header('Content-Type: application/json');
require_once('classes/class.hermes.php');


$tracking = new Tracking_Hermes();

# Will return basic, redacted results
print_r($tracking->getTracking("1234567890123456")); 

# Providing postcode will give full results, address details, GPS coords of delivery and photos if available.
print_r($tracking->getTracking("1234567890123456", "S9 1XX")); 
```

# Will it always work?
Probably not - Hermes could cycle their API key at any time, or change how their system works, 
but we should be able to see the new API key and update it here.
