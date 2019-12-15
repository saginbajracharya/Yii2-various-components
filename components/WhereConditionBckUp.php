<?php 
namespace app\components;
use Yii;
use yii\base\Component;

class WhereCondition extends Component
{
	public function generate($conditions){//[{"property":"fld_3_101","value":"2190610348,22222222"}]
		$output = "";
		$i=0;
  		$conditionArray = json_decode($conditions, true);
		foreach ($conditionArray as $con) {
  			if($i > 0 ){
  				$output = $output .' AND '. $this->getQueryString($con);
  			}else{
  				$output = $this->getQueryString($con);
  			}
			$i++;
		}
		return $output;
	}

	public function getQueryString($condition){//{"property":"fld_3_101","value":"2190610348,22222222"}
		
		$QueryString="(";
		$operator = " ::TEXT iLIKE "; //normal filter
		$operator2 = " IS NULL";

		if($condition['value']){	//not empty value
			$values = explode(",",$condition['value']);//explode values by comma
			echo "<br><br>";
			var_dump($condition['value']);
			var_dump($values);
			for ($x = 0; $x < sizeof($values); $x++) {
				if(strpos($values[$x],'!#') !== false){
					$values[$x] = str_replace("!#", "",$values[$x]);//remove != from value string
					$operator = " is not null AND trim"; //change operator to	
				}
				else if(strpos($values[$x],'!=') !== false){
					$values[$x] = str_replace("!=", "",$values[$x]);//remove != from value string
					$operator = " ::TEXT != "; //change operator to	
				}
				else if(strpos($values[$x],'<=') !== false){
					$values[$x] = str_replace("<=", "",$values[$x]);//remove <= from value string
					$operator = " <= "; //change operator to	
				}
				else if(strpos($values[$x],'>=') !== false){
					$values[$x] = str_replace(">=", "",$values[$x]);//remove >= from value string
					$operator = " >= "; //change operator to	
				}
				else if(strpos($values[$x],'=') !== false ){ //has = in value
					$values[$x] = str_replace("=", "",$values[$x]);//remove = from value string
					$operator = " ::TEXT = "; //change operator to
				}
				else if(strpos($values[$x],'!') !== false){
					$values[$x] = str_replace("!", "",$values[$x]);//remove ! from value string
					$operator = " ::TEXT NOT iLIKE "; //change operator to	
				}
				else if(strpos($values[$x],'<') !== false){
					$values[$x] = str_replace("<", "",$values[$x]);//remove < from value string
					$operator = " < "; //change operator to	
				}
				else if(strpos($values[$x],'>') !== false){
					$values[$x] = str_replace(">", "",$values[$x]);//remove > from value string
					$operator = " > "; //change operator to	
				}
				else if(strpos($values[$x],'#') !== false){
					$operator = " is null OR trim"; //change operator to	
				}
				if($x == sizeof($values)-1){//for last value
					var_dump(sizeof($values));
					var_dump($operator);
					var_dump($QueryString);
					var_dump($values[$x]);
					if($operator == " ::TEXT NOT iLIKE "){
						$QueryString .= '("'.$condition['property'].'"'.$operator."'%".$values[$x]."%'".' OR '.'"'.$condition['property'].'"'.$operator2.")";
					}
					else if($operator == " ::TEXT = "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."')";
					}
					else if($operator == " ::TEXT != "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."')";
					}
					else if($operator == " <= "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."')";
					}
					else if($operator == " < "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."')";
					}
					else if($operator == " > "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."')";
					}
					else{
						$QueryString .= '"'.$condition['property'].'"'.$operator."'%".$values[$x]."%'".')';
					}
				}else{
					if($operator == " ::TEXT NOT iLIKE "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'%".$values[$x]."%'".' OR '.'"'.$condition['property'].'"'.$operator2.")".' OR ';
					}
					else if($operator == " ::TEXT = "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."'".' OR ';
					}
					else if($operator == " ::TEXT != "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."'".' OR ';	
					}
					else if($operator == " <= "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."'".' OR ';
					}
					else if($operator == " < "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."'".' OR ';
					}
					else if($operator == " > "){
						$QueryString .= '"'.$condition['property'].'"'.$operator."'".$values[$x]."'".' OR ';
					}
					else{
						$QueryString .= '"'.$condition['property'].'"'.$operator."'%".$values[$x]."%'".' OR ';
					}
				}
				$operator = " ::TEXT iLIKE ";
			}
			var_dump($QueryString);
			return $QueryString;
		}
	}
}
?>


// }
// else{ 
// 	// non comma separated values condition
// 	if($operator == " ::TEXT iLIKE ")//single value
// 	{
// 		$QueryString = '("'.$condition['property'].'"'.$operator."'%".$condition['value']."%')";
// 	}
// 	else if($operator == " ::TEXT NOT iLIKE ")
// 	{
// 		$QueryString = '("'.$condition['property'].'"'.$operator."'%".$condition['value']."%'".' OR '.'"'.$condition['property'].'"'.$operator2.")";
// 	}
// 	else if($operator == " ::TEXT = ")//single value
// 	{
// 		$QueryString = '("'.$condition['property'].'"'.$operator."'".$condition['value']."')";
// 	}
// 	else if($operator == " is null OR trim"){ //("fld_3_101" is null OR trim("fld_3_101"::text) = '')
// 		$QueryString = '("'.$condition['property'].'"'.$operator.'('.'"'.$condition['property'].'"::text)='."' '".")"; 
// 	}
// 	else if($operator == " is not null AND trim"){
// 		$QueryString = '("'.$condition['property'].'"'.$operator.'('.'"'.$condition['property'].'"::text)='."' '".")"; 	
// 	}
// 	else
// 	{
// 		$QueryString = '("'.$condition['property'].'"'.$operator."'".$condition['value']."')";	
// 	}
// }