<?php
// set API endpoint and query parameters
$url = 'https://my358611.sapbydesign.com/sap/byd/odata/ana_businessanalytics_analytics.svc/RPZD606136405415E98FE8C0CQueryResults';
$params = array(
    '$select' => 'CCO_UUID,CLOG_AREA_UUID,TLOG_AREA_UUID,CMATERIAL_UUID,TMATERIAL_UUID,KCs1ANs556A4FF848FA1E6,KCON_HAND_STOCK',
    '$filter' => '(CSITE_UUID eq \'YDDM_SN\')',
    '$format' => 'json',
);

// set authentication credentials
$username = 'DDD00236';
$password = 'Welcome001';

// create HTTP Basic Auth header
$auth = base64_encode("$username:$password");
$headers = array(
    'Authorization: Basic '.$auth,
);

// initialize curl session
$ch = curl_init();

// set curl options
curl_setopt($ch, CURLOPT_URL, "$url?".http_build_query($params));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// execute curl request and get response data
$response = curl_exec($ch);

// check if there was an error with the request
if ($response === false) {
    echo 'Curl error: '.curl_error($ch);
    exit;
}

// decode JSON response data
$data = json_decode($response, true);

// check if there was an error with the JSON decoding
if (is_null($data)) {
    echo 'JSON error: '.json_last_error_msg();
    exit;
}

// sort inventory data based on CCO_UUID field
usort($data['d']['results'], function($a, $b) {
    return strcmp($a['CCO_UUID'], $b['CCO_UUID']);
});

// create an array of the data to display in Flex
$flexData = array();
foreach ($data['d']['results'] as $result) {
    $flexData[] = array(
        'type' => 'bubble',
        'body' => array(
            'type' => 'box',
            'layout' => 'vertical',
            'contents' => array(
                array(
                    'type' => 'text',
                    'text' => 'CCO UUID',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#000000'
                ),
                array(
                    'type' => 'text',
                    'text' => $result['CCO_UUID'],
                    'size' => 'sm',
                    'wrap' => true
                ),
                array(
                    'type' => 'text',
                    'text' => 'CLOG AREA UUID',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#000000'
                ),
                array(
                    'type' => 'text',
                    'text' => $result['CLOG_AREA_UUID'],
                    'size' => 'sm',
                    'wrap' => true
                ),
                array(
                    'type' => 'text',
                    'text' => 'TLOG AREA UUID',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#000000'
                ),
                array(
                    'type' => 'text',
                    'text' => $result['TLOG_AREA_UUID'],
                    'size' => 'sm',
                    'wrap' => true
                    ),
                    array(
                    'type' => 'text',
                    'text' => 'CMATERIAL UUID',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#000000'
                    ),
                    array(
                    'type' => 'text',
                    'text' => $result['CMATERIAL_UUID'],
                    'size' => 'sm',
                    'wrap' => true
                    ),
                    array(
                    'type' => 'text',
                    'text' => 'TMATERIAL UUID',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#000000'
                    ),
                    array(
                    'type' => 'text',
                    'text' => $result['TMATERIAL_UUID'],
                    'size' => 'sm',
                    'wrap' => true
                    ),
                    array(
                    'type' => 'text',
                    'text' => 'KCs1ANs556A4FF848FA1E6',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#000000'
                    ),
                    array(
                    'type' => 'text',
                    'text' => $result['KCs1ANs556A4FF848FA1E6'],
                    'size' => 'sm',
                    'wrap' => true
                    ),
                    array(
                    'type' => 'text',
                    'text' => 'KCON HAND STOCK',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#000000'
                    ),
                    array(
                    'type' => 'text',
                    'text' => $result['KCON_HAND_STOCK'],
                    'size' => 'sm',
                    'wrap' => true
                    ),
                ),
            ),
        );
    }
                    
                    // display Flex data
                    echo json_encode(array(
                    'type' => 'flex',
                    'altText' => 'Inventory Data',
                    'contents' => array(
                    'type' => 'carousel',
                    'contents' => $flexData
                )
            ));
// set LINE Messaging API endpoint
$url = 'https://api.line.me/v2/bot/message/push';

// set LINE Messaging API access token and user ID
$accessToken = 'X60pZY7wrDmox5r3KAmID7Cfc6pIXAjIiFYq6WbAS/8jHngD92fzTUqE4LqUot46NhC72PFCLQv8rcWYz4fO4eBICY/XgHriUsi9kT9e9gvr9ezXr6trVwPGNvLeOJprq/QDQK4FQjHdqOk5c8MS4QdB04t89/1O/w1cDnyilFU=';
$userId = 'Ubc3a95ba6527385cc8c2212c42ad5090';

// create HTTP headers for LINE Messaging API request
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$accessToken,
);

// create LINE Messaging API message payload
$message = array(
    'type' => 'flex',
    'altText' => 'Inventory Data',
    'contents' => array(
        'type' => 'carousel',
        'contents' => $flexData,
    ),
);

// create LINE Messaging API request payload
$data = array(
    'to' => $userId,
    'messages' => array($message),
);

// convert payload to JSON format
$jsonData = json_encode($data);

// initialize curl session
$ch = curl_init();

// set curl options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// execute curl request and get response data
$response = curl_exec($ch);

// check if there was an error with the request
if ($response === false) {
    echo 'Curl error: '.curl_error($ch);
    exit;
}

// close curl session
curl_close($ch);
 ?> 
