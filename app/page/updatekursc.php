<?
// Requested file
// Could also be e.g. 'currencies.json' or 'historical/2011-01-01.json'
$file = 'latest.json';
$appId = '0cb299b2ad2c46e8b96a28e3783d5312';

/* gets the data from a URL */
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
if(filemtime('data.json') + 86400 < time())
{
// Open CURL session:
$ch = get_data("http://openexchangerates.org/api/{$file}?app_id={$appId}");
$fp = fopen('data.json', 'w');
fwrite($fp, $ch);
fclose($fp);
echo ">.<";
}
echo "aaaa";?>