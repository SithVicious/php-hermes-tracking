# php-hermes-tracking
Scrapes tracking data from UK Hermes website



```php
<?php
header('Content-Type: application/json');
require_once('classes/class.hermes.php');


$tracking = new Tracking_Hermes();

print_r($tracking->getTracking("0840683668518683")); # Will return redacted results
print_r($tracking->getTracking("0840683668518683", "S9 1XX")); # Providing postcode will give full results, address details, GPS coords of delivery and photos if available.
```
