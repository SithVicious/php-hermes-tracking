<?php

class Tracking_Hermes
{

	var $apiKey = 'R6xkX4kqK4U7UxqTNraxmXrnPi8cFPZ6'; # Hard coded, but we are being naughty and using Hermes own api key

    public function getTracking($tracking_code, $postcode=NULL)
    {

        if ($tracking_code=='') {
            return array("success" => false,
                "response" => array("error" => "Tracking code is empty.")
            );
        }

        if (!is_numeric($tracking_code)) {
            return array("success" => false,
                "response" => array("error" => "Tracking code is not a number.")
            );
        }

        if (strlen($tracking_code) != 16) {
            return array("success" => false,
                "response" => array("error" => "Tracking code is not 16 digits.")
            );
        }

        # Step 1: Get URN
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hermesworld.co.uk/enterprise-tracking-api/v1/parcels/search/'.$tracking_code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' . $this->apiKey
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        if ($response['error']) {
            return array("success" => false, "response" => $response);
        } else {
            $URN = $response[0];
        }


        # Step 2: Get Tracking Data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hermesworld.co.uk/enterprise-tracking-api/v1/parcels/?uniqueIds='.$URN.'&postcode='.$postcode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: '. $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if (!$response) {
            return array("success" => false);
        } else {
            $data = $response;
        }


        return json_decode($data, true);
    }
}
