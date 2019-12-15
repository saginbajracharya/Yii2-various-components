<?php 
/**
 * Gets the Main URL
 * @return string
 */

if (!function_exists('getMainUrl')) {
	// function getMainUrl() {
	// 	return Yii::$app->request->getBaseUrl(false) . DS; // baseUrl();
	// }

	function getMainUrl($file=true) {
	    $protocol = isset($_SERVER['HTTPS']) ? "https" : "http";
	    $currentPath = $_SERVER['PHP_SELF'];

	    //give something like: /main_app/index.php
	    $pathInfo = pathinfo($currentPath);

	    $hostName = $_SERVER['HTTP_HOST'];
	    //gives something like: localhost
	    $appArray = explode('/', $pathInfo['dirname'], -1); //remove bl
	    $appPath = implode('/', $appArray); //join
	    //return $protocol."://".$hostName.$appPath."/index.php";
	    $retVal = $protocol . "://" . $hostName . $appPath . "/";
	    return ($file === false) ? ($retVal) : ($retVal . "index.php");
	}
}

/**
 * Get url for module
 * @param  string $module [module name, defaults to ADMIN_MODULE defined in app.settings.php]
 * @return string         [description]
 */
if (!function_exists('getAdminUrl')) {
	function getAdminUrl($module = ADMIN_MODULE)
	{
		return getMainUrl() . $module . '/';
	}
}
/**
 * Ram Pukar
 * Date: 2018-Sep-05
 * TO DEBUG AND DIE.
 */

if(!function_exists('dd')) {
	function dd($arrayData, $exit=true) { //Debug with die.
		echo "<pre>"; print_r($arrayData);echo "</pre>";
		if($exit===true) die();
	}
}


if (!function_exists('getDateChange')) {
	function getDateChange($date, $day, $type='next') {
		$getDate	  	= new DateTime($date);
		$getType = '';
		if($type=='next'){
			$getType = '+'.$day.' day';
			$getDate->modify($getType);
		} else {
			$getType = '-'.$day.' day';
			$getDate->modify($getType);
		}
		return $getDate->format('Y-m-d');
	}
}

/**
 * Decrypt BASE64 encoded string hash using SECRET key.
 * @param $encrypted_string BASE64 encoded string hash
 * @return decrypted string.
 */
if (!function_exists('decryptByKey')) {
	function decryptByKey($encrypted_string) {
		return Yii::$app->security->decryptByKey(base64_decode($encrypted_string), SECRET_KEY);
	}
}

/**
 * Encode and encrypt string using SECRET key.
 * @return BASE64 encoded string hash.
 */
if (!function_exists('encryptByKey')) {
	function encryptByKey($string) {
		return base64_encode(Yii::$app->security->encryptByKey($string, SECRET_KEY));
	}
}

/**
 * Converts exponentail format numbers such as 2.5E6 or 1.2E-6 to its decimal equivalance.
 * @return decimal precision value.
 */
if (!function_exists('exponentToDecimalNumber')) {
	function exponentToDecimalNumber($string) {
		return number_format($string, $decimals = 8);
	}
}

/**
 * Validate if the provided date string is a valid date or not
 * @return [boolean]  TRUE => if valid date else FALSE
 */
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}
/**
 * To send CURL request
 *@param array $data ["url","header","param"]
 *@return array $response
*/
function doCurl($data=NULL, $request = "POST", $xml = false) {


	if (!$data){
		return false;
	}
	$request = (!empty($data['request'])? $data['request']:$request);
	$url = $data['url'];
	$header = $data['header'];
	$param = $data['param'];

	//var_dump($data);die;
	// 必要に応じてオプションを追加してください。
	$ch = curl_init();
	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER,     $header);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  $request);
	curl_setopt($ch, CURLOPT_URL,            $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if ($request == "POST") {
		curl_setopt($ch, CURLOPT_POST, true);
		if (!$xml){
			$param = http_build_query($param);
		}

		curl_setopt($ch, CURLOPT_POSTFIELDS, $param );
	}
	
	$response = curl_exec($ch);
	// writeLog($response);die;

	if (curl_error($ch)) {
	    $error_msg = curl_error($ch);
	    var_dump($error_msg);
	}
	curl_close($ch);
	//$ret = xmlToArray($response);
	$ret = $response;


	return $ret;

}

?>