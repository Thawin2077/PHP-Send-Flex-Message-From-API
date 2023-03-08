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

// close curl session
curl_close($ch);

// organize inventory data in a table format
$table = '<table><tr><th>CCO UUID</th><th>CLOG AREA UUID</th><th>TLOG AREA UUID</th><th>CMATERIAL UUID</th><th>TMATERIAL UUID</th><th>KCs1ANs556A4FF848FA1E6</th><th>KCON HAND STOCK</th></tr>';
foreach ($data['d']['results'] as $result) {
    $table .= "<tr><td>{$result['CCO_UUID']}</td><td>{$result['CLOG_AREA_UUID']}</td><td>{$result['TLOG_AREA_UUID']}</td><td>{$result['CMATERIAL_UUID']}</td><td>{$result['TMATERIAL_UUID']}</td><td>{$result['KCs1ANs556A4FF848FA1E6']}</td><td>{$result['KCON_HAND_STOCK']}</td></tr>";
}
$table .= '</table>';

// display inventory data on screen
echo $table;
?>