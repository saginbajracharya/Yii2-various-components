<?php 
namespace app\components;
use Yii;
use yii\base\Component;

class WhereCondition extends Component
{
	/* 
	- Takes 1 parameter $condition 
	- Sends $conditionArray as $filterCondition[x] to fx getQueryString()
	- when $conditionArray length is greater than 0 then concat prevQuery.'AND'.nextQuery
	- return $where_sql
	*/
	public function generate($conditions)
	{
		$where_sql = "";
		$i=0;
  		$conditionArray = json_decode($conditions, true);
		foreach ($conditionArray as $filterCondition) 
		{
  			if($i > 0 )
  			{
  				$where_sql = $where_sql .' AND '. $this->getQueryString($filterCondition);
  			}
  			else
  			{
  				$where_sql = $this->getQueryString($filterCondition);
  			}
			$i++;
		}
		return $where_sql;
	}

	/*
	- Takes 1 parameter $condition with property and value
	- First Explode values or Array
	- for loop values[x] as per size of $values sizeof(1,2,..)
	- strpos(haystack, needle) check characters/symbols in values & replace by str_replace(search, replace, subject)
	- set the operator $op
	- if single value set QueryString as per data & conditions
	- if multiple values set QueryString as per data & conditions with OR and loop until end  
	*/
	public function getQueryString($condition)
	{
		$QueryString="(";
		$op = " ::TEXT iLIKE ";
		$op2 = " IS NULL";

		//Explode values and create value arrays
		if((strpos($condition['value'],'{') !== false && strpos($condition['value'],'}') !== false)||
		   (strpos($condition['value'],'[') !== false && strpos($condition['value'],']') !== false))
		{
			if(strpos($condition['value'],'},') !== false)
			{
				$values = explode("},",$condition['value']);	
			}
			else
			{
				$values = [$condition['value']];
			}
		}
		else
		{
			$values = explode(",",$condition['value']);
		}
		for ($x = 0; $x < sizeof($values); $x++) 
		{
			//BETWEEN {} 
			//NOT BETWEEN 
			if(strpos($condition['value'],'{') !== false && strpos($condition['value'],'}') !== false)
			{
				if(strpos($condition['value'],'!{') !== false)
				{
					$op = " notbetween ";
					$values[$x] = str_replace("!", "",$values[$x]);
				}
				else
				{
					$op = " between ";
				}
				$values[$x] = str_replace("{", "",$values[$x]);
				$values[$x] = str_replace("}", "",$values[$x]);
				$val_arr = explode(",",$values[$x]);
				$val1 = $val_arr[0];
				$val2 = $val_arr[1];
			}
			//IN LIST []
			//NOT IN LIST
			else if(strpos($condition['value'],'[') !== false && strpos($condition['value'],']') !== false)
			{
				if(strpos($condition['value'],'![') !== false)
				{
					$op = " NOT IN ";
					$values[$x] = str_replace("!", "",$values[$x]);
				}
				else
				{
					$op = " IN ";
				}
				$values[$x] = str_replace("[", "",$values[$x]);
				$values[$x] = str_replace("]", "",$values[$x]);
				$list_arr = explode(',', $values[$x]);
				$str = "";
				foreach ($list_arr as $key => $value) {
					$value = "'".$value."'";
					$str .=$value.',';
				}
				$str = rtrim($str,',');
			}
			//DOSE NOT BEGINS/ENDS WITH
			else if(strpos($values[$x],'*') !== false && strpos($values[$x],'!') !== false) 
			{
				$values[$x] = str_replace("*", "%",$values[$x]);
				$op = " ::TEXT NOT iLIKE ";
			}
			//IS NOT NULL/NOT EMPTY
			else if(strpos($values[$x],'!#') !== false)
			{
				$values[$x] = str_replace("!#", "",$values[$x]);
				$op = " is not null AND trim";
			}
			//NOT EMPTY
			else if(strpos($values[$x],'<>') !== false)
			{
				$values[$x] = str_replace("<>", " ",$values[$x]);
				$op = " <> ";
			}
			//NOT EQUALS TO
			else if(strpos($values[$x],'!=') !== false)
			{
				$values[$x] = str_replace("!=", "",$values[$x]);
				$op = " ::TEXT != ";
			}
			//NOT LESS THAN
			else if(strpos($values[$x],'!<') !== false)
			{
				$values[$x] = str_replace("!<", "",$values[$x]);
				$op = ">";
			}
			//NOT GREATER THAN
			else if(strpos($values[$x],'!>') !== false)
			{
				$values[$x] = str_replace("!>", "",$values[$x]);
				$op = "<";
			}
			//LESS THAN OR EQUALS TO
			else if(strpos($values[$x],'<=') !== false)
			{
				$values[$x] = str_replace("<=", "",$values[$x]);
				$op = " <= ";
			}
			//GREATER THAN OR EQUALS TO
			else if(strpos($values[$x],'>=') !== false)
			{
				$values[$x] = str_replace(">=", "",$values[$x]);
				$op = " >= ";
			}
			//EQUALS TO
			else if(strpos($values[$x],'=') !== false )
			{
				$values[$x] = str_replace("=", "",$values[$x]);
				$op = " ::TEXT = ";
			}
			//NOT 
			else if(strpos($values[$x],'!') !== false)
			{
				$values[$x] = str_replace("!", "",$values[$x]);
				$op = " ::TEXT NOT iLIKE ";
			}
			//LESS THAN
			else if(strpos($values[$x],'<') !== false)
			{
				$values[$x] = str_replace("<", "",$values[$x]);
				$op = " < ";
			}
			//GREATER THAN
			else if(strpos($values[$x],'>') !== false)
			{
				$values[$x] = str_replace(">", "",$values[$x]);
				$op = " > ";
			}
			//IS NULL/IS EMPTY
			else if(strpos($values[$x],'#') !== false)
			{
				$op = " is null OR trim";
			}
			//BEGINS/ENDS WITH
			else if(strpos($values[$x],'*') !== false) 
			{
				$values[$x] = str_replace("*", "%",$values[$x]);
			}
			// Single values
			if($x == sizeof($values)-1)
			{
				if($op ==  " ::TEXT iLIKE ")
				{
					if(strpos($values[$x],'%') !== false) //for BEGINS/ENDS WITH
					{
						$QueryString .= '"'.$condition['property'].'"'.$op."'".$values[$x]."'".')';
					}
					else//normal
					{
						$QueryString .= '"'.$condition['property'].'"'.$op."'%".$values[$x]."%'".')';
					}
				}
				else if($op == " ::TEXT NOT iLIKE ")
				{
					if(strpos($values[$x],'%') !== false && strpos($values[$x],'!') !== false) //for DOSE NOT BEGINS/ENDS WITH !com%
					{
						$values[$x] = str_replace("!", "",$values[$x]);
						$QueryString .= '"'.$condition['property'].'"'.$op."'".$values[$x]."'".')';
					}
					else
					{
						$QueryString .= '"'.$condition['property'].'"'.$op."'%".$values[$x]."%'".' OR '.'"'.$condition['property'].'"'.$op2.")";
					}
				}
				else if($op ==" is null OR trim")
				{
					$QueryString .= '"'.$condition['property'].'"'.$op.'('.'"'.$condition['property'].'"::text)='."' '".")";
				}
				else if($op ==" is not null AND trim")
				{
					$QueryString .= '"'.$condition['property'].'"'.$op.'('.'"'.$condition['property'].'"::text) !='."' '".")";
				}
				else if($op ==" between ")
				{
					$QueryString .= '"'.$condition['property'].'"'.$op."'".$val1."'".' AND '."'".$val2."'".")";
				}
				else if($op ==" notbetween ")
				{
					$QueryString .= '"'.$condition['property'].'" < '."'".$val1."'".' OR '.'"'.$condition['property'].'" > '."'".$val2."'".")";
				}
				else if($op ==" IN " || $op == " NOT IN ")//for is in LIST / is not in LIST
				{
					$QueryString .= '"'.$condition['property'].'"'.$op.'('.$str.')'.")";
				}
				else
				{
					$QueryString .= '"'.$condition['property'].'"'.$op."'".$values[$x]."')";	
				}
			}
			//for multiple values
			else
			{
				if($op == " ::TEXT iLIKE ")
				{
					if(strpos($values[$x],'%') !== false)
					{
						$QueryString .= '"'.$condition['property'].'"'.$op."'".$values[$x]."'".' OR ';
					}
					else
					{
						$QueryString .= '"'.$condition['property'].'"'.$op."'%".$values[$x]."%'".' OR ';
					}
				}
				else if($op == " ::TEXT NOT iLIKE ")
				{
					if(strpos($values[$x],'%') !== false && strpos($values[$x],'!') !== false) //for DOSE NOT BEGINS/ENDS WITH
					{
						$values[$x] = str_replace("!", "",$values[$x]);
						$QueryString .= '"'.$condition['property'].'"'.$op."'".$values[$x]."'".' OR ';	
					}
					else
					{
						$QueryString .= '"'.$condition['property'].'"'.$op."'%".$values[$x]."%'".' OR '.'"'.$condition['property'].'"'.$op2.")".' OR (';
					}
				}
				else if($op ==" is null OR trim")
				{
					$QueryString .= '"'.$condition['property'].'"'.$op.'('.'"'.$condition['property'].'"::text)='."' '".")".' OR ';
				}
				else if($op ==" is not null AND trim")
				{
					$QueryString .= '"'.$condition['property'].'"'.$op.'('.'"'.$condition['property'].'"::text) !='."' '".")".' OR ';
				}
				else if($op ==" between ")
				{
					$QueryString .= '"'.$condition['property'].'"'.$op."'".$val1."'".' AND '."'".$val2."'".")".' OR (';
				}
				else if ($op ==" notbetween " ) 
				{
					$QueryString .= '"'.$condition['property'].'" < '."'".$val1."'".' OR '.'"'.$condition['property'].'" > '."'".$val2."')".' OR (';
				}
				else if($op ==" IN " || $op == " NOT IN ")
				{
					$QueryString .= '"'.$condition['property'].'"'.$op.'('.$str.'))'.' OR ';
				}
				else
				{
					$QueryString .= '"'.$condition['property'].'"'.$op."'".$values[$x]."'".' OR ';
				}
			}
			$op = " ::TEXT iLIKE ";
		}
		return $QueryString;
	}
}
?>