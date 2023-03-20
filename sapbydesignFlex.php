<?php

// Create variable username & pass & dbname in database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flex";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//------------------------------------------------------------------------------------------------------------------------------------

$accessTokens = array(
    'X60pZY7wrDmox5r3KAmID7Cfc6pIXAjIiFYq6WbAS/8jHngD92fzTUqE4LqUot46NhC72PFCLQv8rcWYz4fO4eBICY/XgHriUsi9kT9e9gvr9ezXr6trVwPGNvLeOJprq/QDQK4FQjHdqOk5c8MS4QdB04t89/1O/w1cDnyilFU=',
    'Fvz1VqPIqZjAFlZuM+m8G79PJxLndN014t2SfCtoTr6a6DMzJUXt4GHp6SB31xN8tVQLn/BreKrat2DNtWtHMRPNhdnmIqjKZjFzlSkP71NsFnOqy+qW/sl3V1ZxnKNpwHr7qh3Apw3r0FvDqjS+kwdB04t89/1O/w1cDnyilFU=',
    'pgvSNyyx0qI2BJfO5Flq0dphv47A3ZystqmSjJmbF5JB3CiFwfkPvW21dOvvsaecp8L6UG/KpB52DPV3/lF5Hivf8O7fsL1dZjaXmaMNEW1ud0kX4z+BeXjk56SvvCogdZqNP3u7p47l69ich41SJwdB04t89/1O/w1cDnyilFU=',
);
$userIds = array(
    'Ubc3a95ba6527385cc8c2212c42ad5090', //เคน
    'U4072e7dae4fe9428181793dc397a3ec3', //กอล์ฟ
    'U04edb82fd90e4d5c8f79424a1848bbfe', //พี่ฟาอิส
    'U86e5a8c8dc3643de567128e9733c7830', //แบงค์
);

// set API endpoint and query parameters
$url = 'https://my358611.sapbydesign.com/sap/byd/odata/ana_businessanalytics_analytics.svc/RPZD606136405415E98FE8C0CQueryResults';
$params = array(
    '$select' => 'CCO_UUID,CLOG_AREA_UUID,TLOG_AREA_UUID,CMATERIAL_UUID,TMATERIAL_UUID,KCs1ANs556A4FF848FA1E6,KCON_HAND_STOCK',
    '$filter' => '(CSITE_UUID eq \'YKUR_SN\')',
    '$format' => 'json',
    '$top' => 12, //maximum 12, if >= 13 it can't send flex message
);


// set authentication credentials
$username = 'DDD00236';
$password = 'Welcome001';

// create HTTP Basic Auth header
$auth = base64_encode("$username:$password");
$headers = array(
    'Authorization: Basic ' . $auth,
);

// initialize curl session
$ch = curl_init();

// set curl options
curl_setopt($ch, CURLOPT_URL, "$url?" . http_build_query($params));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// execute curl request and get response data
$response = curl_exec($ch);

// check if there was an error with the request
if ($response === false) {
    echo 'Curl error: ' . curl_error($ch);
    exit;
}

// decode JSON response data
$data = json_decode($response, true);

// check if there was an error with the JSON decoding
if (is_null($data)) {
    echo 'JSON error: ' . json_last_error_msg();
    exit;
}

// sort inventory data based on CCO_UUID field
usort($data['d']['results'], function ($a, $b) {
    return strcmp($a['CCO_UUID'], $b['CCO_UUID']);
});

// create an array of the data to display in Flex
$flexData = array();
foreach ($data['d']['results'] as $result) {
    $flexData[] = array(
        'type' => 'bubble',
        'hero' => array(
            'type' => 'image',
            'url' => 'https://i.imgur.com/0zzmh83.png',
            'size' => 'full',
            'aspectRatio' => '20:13',
            'aspectMode' => 'cover',
        ),
        'body' => array(
            'type' => 'box',
            'layout' => 'vertical',
            'contents' => array(
                array(
                    'type' => 'text',
                    'text' => 'CCO UUID',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#0D47A1',
                    'decoration' => 'underline'
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
                    'color' => '#0D47A1',
                    'decoration' => 'underline'
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
                    'color' => '#0D47A1',
                    'decoration' => 'underline'
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
                    'color' => '#0D47A1',
                    'decoration' => 'underline'
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
                    'color' => '#0D47A1',
                    'decoration' => 'underline'
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
                    'color' => '#0D47A1',
                    'decoration' => 'underline'
                ),
                array(
                    'type' => 'text',
                    'text' => number_format($result['KCs1ANs556A4FF848FA1E6'], 2),
                    'size' => 'sm',
                    'wrap' => true
                ),
                array(
                    'type' => 'text',
                    'text' => 'KCON HAND STOCK',
                    'weight' => 'bold',
                    'size' => 'sm',
                    'color' => '#0D47A1',
                    'decoration' => 'underline'
                ),
                array(
                    'type' => 'text',
                    'text' => number_format($result['KCON_HAND_STOCK'], 2),
                    'size' => 'sm',
                    'wrap' => true
                ),
            ),
        ),
    );
}

// display Flex data
echo json_encode(
    array(
        'type' => 'flex',
        'altText' => 'Inventory Data',
        'contents' => array(
            'type' => 'carousel',
            'contents' => $flexData
        )
    )
);

// Parse API response
$data = json_decode($response, true);

// Store data in database
foreach ($data['d']['results'] as $result) {
    $cco_uuid = $result['CCO_UUID'];
    $clog_area_uuid = $result['CLOG_AREA_UUID'];
    $tlog_area_uuid = $result['TLOG_AREA_UUID'];
    $cmaterial_uuid = $result['CMATERIAL_UUID'];
    $tmaterial_uuid = $result['TMATERIAL_UUID'];
    $kcs1ans556a4ff848fa1e6 = $result['KCs1ANs556A4FF848FA1E6'];
    $kcon_hand_stock = $result['KCON_HAND_STOCK'];

    $sql = "INSERT INTO inventory_data (CCO_UUID, CLOG_AREA_UUID, TLOG_AREA_UUID, CMATERIAL_UUID, TMATERIAL_UUID, KCs1ANs556A4FF848FA1E6, KCON_HAND_STOCK) 
VALUES ('$cco_uuid', '$clog_area_uuid', '$tlog_area_uuid', '$cmaterial_uuid', '$tmaterial_uuid', '$kcs1ans556a4ff848fa1e6', '$kcon_hand_stock')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();

// loop through each access token and send the Flex message to each user
foreach ($accessTokens as $accessToken) {
    foreach ($userIds as $userId) {
        // set API endpoint and query parameters
        $url = "https://api.line.me/v2/bot/message/push";
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $accessToken,
        );

        // create Flex message
        $message = array(
            'type' => 'flex',
            'altText' => 'Inventory Data',
            'contents' => array(
                'type' => 'carousel',
                'contents' => $flexData,
            ),
        );

        // create JSON data for API request body
        $data = array(
            'to' => $userId,
            'messages' => array($message),
        );
        $postData = json_encode($data);

        // initialize curl session
        $ch = curl_init();

        // set curl options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // execute curl request and get response data
        $response = curl_exec($ch);

        // check if there was an error with the request
        if ($response === false) {
            echo 'Curl error: ' . curl_error($ch);
            exit;
        }

        // decode JSON response data
        $responseData = json_decode($response, true);

        // check if there was an error with the JSON decoding
        if (is_null($responseData)) {
            echo 'JSON error: ' . json_last_error_msg();
            exit;
        }

        // check if there was an error with the API request
        if (isset($responseData['message'])) {
            echo 'API error: ' . $responseData['message'];
            exit;
        }

        // close curl session
        curl_close($ch);
    }
}

?>
