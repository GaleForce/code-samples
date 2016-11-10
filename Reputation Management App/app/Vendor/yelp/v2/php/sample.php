<?php
 
require_once('lib/OAuth.php');
$CONSUMER_KEY = "0SvTmxIVvSdoHupqtaty1g";
$CONSUMER_SECRET = "tumO5-EFnDWxvHIEpbXg5MExAN0";
$TOKEN = "srTc6fMg9sIYuMqLgkXkVS3ql0ncsgha";
$TOKEN_SECRET = "y4ztc56nft-fYPC3YBJtijPFGD4";
$API_HOST = 'api.yelp.com';
$DEFAULT_TERM = 'amtech';
$DEFAULT_LOCATION = 'Allentown, PA';
$SEARCH_LIMIT = 3;
$SEARCH_PATH = '/v2/search/';
$BUSINESS_PATH = '/v2/business/';
 
function request($host, $path) {
    $unsigned_url = "http://" . $host . $path;
    $token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);
    $consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
    $oauthrequest = OAuthRequest::from_consumer_and_token(
        $consumer, 
        $token, 
        'GET', 
        $unsigned_url
    );
    $oauthrequest->sign_request($signature_method, $consumer, $token);
    $signed_url = $oauthrequest->to_url();
    $ch = curl_init($signed_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    //echo "<pre>";
    //print_r(json_decode($data));
   
    curl_close($ch);
    return $data;
}

function search($term, $location) {
    $url_params = array();
    
    $url_params['term'] = $term ?: $GLOBALS['DEFAULT_TERM'];
    $url_params['location'] = $location?: $GLOBALS['DEFAULT_LOCATION'];
    $url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];
    $search_path = $GLOBALS['SEARCH_PATH'] . "?" . http_build_query($url_params);
    return request($GLOBALS['API_HOST'], $search_path);
}

function get_business($business_id) {
    $business_path = $GLOBALS['BUSINESS_PATH'] . $business_id;
    return request($GLOBALS['API_HOST'], $business_path);
}

function query_api($term, $location) {     
    $response = json_decode(search($term, $location));
    $business_id = $response->businesses[0]->id;
    $response = get_business($business_id);
    print "$response\n";
}

$longopts  = array(
    "term::",
    "location::",
);
    
$options = getopt("", $longopts);

$term = $options['term'] ?: '';
$location = $options['location'] ?: '';

query_api($term, $location);
get_business($business_id);
?>
