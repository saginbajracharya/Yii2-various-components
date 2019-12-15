<?php

namespace app\controllers;
use Yii;

class SearchController extends \yii\web\Controller
{
    public function actionSearch()
    {
    	//1.single value
        // ( "fld_3_101"::TEXT iLIKE '%2190610348%' ) 
        $condition1 = '[{"property":"fld_3_101","value":"2190610348"}]';
        $result1 = Yii::$app->whereCondition->generate($condition1);
    	
    	//2.comma separated value  
        // ( "fld_3_101"::TEXT iLIKE '%2190610348%' OR "fld_3_101"::TEXT iLIKE '%22222222%' ) 
        $condition2 = '[{"property":"fld_3_101","value":"2190610348,22222222"}]';
        $result2 = Yii::$app->whereCondition->generate($condition2);

        //3.multiple filter single values
    	// ( "fld_3_101"::TEXT iLIKE '%2190610348%' ) AND ( t79."sender_name"::TEXT iLIKE '%Taro%' )
        $condition3 = '[{"property":"fld_3_101","value":"2190610348"},{"property":"t79.sender_name","value":"Taro"}]';
        $result3 = Yii::$app->whereCondition->generate($condition3);

        //4.multiple filter and comma separated value
        // ( "fld_3_101"::TEXT iLIKE '%2190610348%' OR "fld_3_101"::TEXT iLIKE '%190610014%' ) AND ( t79."sender_name"::TEXT iLIKE '%Taro%' OR t79."sender_name"::TEXT iLIKE '%James%' ) 
        $condition4 = '[{"property":"fld_3_101","value":"2190610348,190610014"},{"property":"t79.sender_name","value":"Taro,James"}]';
        $result4 = Yii::$app->whereCondition->generate($condition4);

        //5.= equal to'  EQUALS TO  =
        //("fld_3_101" ::TEXT = '190610014')
        $condition5 = '[{"property":"fld_3_101","value":"=190610014"}]';
        $result5 = Yii::$app->whereCondition->generate($condition5);

        //6. multiple filter double = equal to
        // ( "fld_3_101"::TEXT = '2190610348' ) AND ( "fld_3_158"::TEXT = '32019061210001' )
        $condition6 = '[{"property":"fld_3_101","value":"=2190610348"},{"property":"fld_3_158","value":"=32019061210001"}]';
        $result6 = Yii::$app->whereCondition->generate($condition6);

        //7.multiple value with = equal to 
        //( "fld_3_101"::TEXT = '2190610348' OR "fld_3_101"::TEXT iLIKE '%2190610401%' )  "value":"=2190610348,2190610401"
        //( "fld_3_101"::TEXT iLIKE '%2190610348%' OR "fld_3_101"::TEXT = '2190610401' )  "value":"2190610348,=2190610401"
        $condition7 = '[{"property":"fld_3_101","value":"2190610348,=2190610401"}]';
        $result7 = Yii::$app->whereCondition->generate($condition7);

        //8.! Not LIKE
        // ("fld_3_101"::TEXT NOT iLIKE '%2190610348%' OR "fld_3_101" IS NULL)
        $condition8 = '[{"property":"fld_3_101","value":"!2190610348"}]';
        $result8 = Yii::$app->whereCondition->generate($condition8);

        //9.'!= is not equal to'  NOT EQUALS TO !=
        //( "fld_3_101"::TEXT != '2190610348' )   
        $condition9 = '[{"property":"fld_3_101","value":"!=2190610348"}]';
        $result9 = Yii::$app->whereCondition->generate($condition9);

        //10.'! not like ! not like'
        //("fld_3_101"::TEXT NOT iLIKE '%2190610401%' OR "fld_3_101" IS NULL) OR ("fld_3_101"::TEXT NOT iLIKE '%2190610348%' OR "fld_3_101" IS NULL) 
        $condition10 ='[{"property":"fld_3_101","value":"!2190610401,!2190610348"}]';
        $result10 = Yii::$app->whereCondition->generate($condition10);

        //11. less than LESS THAN  <
        //( "fld_3_101" < '2190610401' )
        $condition11 = '[{"property":"fld_3_101","value":"<2190610401"}]';
        $result11 = Yii::$app->whereCondition->generate($condition11);

        //12. greater than Greater Than >
        //( "fld_3_101" > '2190610401' )
        $condition12 = '[{"property":"fld_3_101","value":">2190610401"}]';
        $result12 = Yii::$app->whereCondition->generate($condition12);

        //13. less or equals to  Less Than or Equals To  <=
        //( "fld_3_101" <= '2190610401' )
        $condition13 = '[{"property":"fld_3_101","value":"<=2190610401"}]';
        $result13 = Yii::$app->whereCondition->generate($condition13);

        // 14. greater than or equals to  Greater Than or Equal To >=
        // ("fld_3_101" >= '2190610401')
        $condition14 = '[{"property":"fld_3_101","value":">=2190610401"}]';
        $result14 = Yii::$app->whereCondition->generate($condition14);

        // 15. is null #
        // ("fld_3_101" is null OR trim("fld_3_101"::text) = '')
        $condition15 = '[{"property":"fld_3_101","value":"#"}]';
        $result15 = Yii::$app->whereCondition->generate($condition15);

        // 16. is not null !#
        // ("fld_3_101" is not null AND trim("fld_3_101"::text) != '')
        $condition16 = '[{"property":"fld_3_101","value":"!#"}]';
        $result16 = Yii::$app->whereCondition->generate($condition16);

        // 17. multiple filter as not null 
        // ("fld_3_101" is not null AND trim("fld_3_101"::text) != '') ) AND ( (t79."mail_to" is not null AND trim(t79."mail_to"::text) != '') 
        $condition17 ='[{"property":"fld_3_101","value":"!#"},{"property":"t79.mail_to","value":"!#"}]';
        $result17 = Yii::$app->whereCondition->generate($condition17);

        // 18. does not contains Case insensetive
        // (t79."mail_to"::TEXT NOT iLIKE '%TEST%' OR t79."mail_to" IS NULL)
        $condition18 = '[{"property":"t79.mail_to","value":"!TEST"}]';
        $result18 = Yii::$app->whereCondition->generate($condition18);

        // 19. ends with ENDS WITH %... // *....
        // ( t79."mail_to"::TEXT iLIKE '%com' ) 
        $condition19 = '[{"property":"t79.mail_to","value":"*com"}]';
        $result19 = Yii::$app->whereCondition->generate($condition19);

        //20. begins with  Begins With   ...% // ...*
        //( t79."mail_to"::TEXT iLIKE 'com%' )
        $condition20 = '[{"property":"t79.mail_to","value":"com*"}]';
        $result20 = Yii::$app->whereCondition->generate($condition20);

        //21. between BETWEEN {val1,val2} 
        // ("fld_38_101" BETWEEN '140' AND '155')
        $condition21 = '[{"property":"fld_38_101","value":"{140,155}"}]';
        $result21 = Yii::$app->whereCondition->generate($condition21);

        //22. double BETWEEN {val1,val2},{val1,val2}
        //("fld_38_101" BETWEEN '140' AND '155') OR ("fld_38_101" BETWEEN '160' AND '170')
        $condition22 = '[{"property":"fld_38_101","value":"{140,155},{160,170}"}]';
        $result22 = Yii::$app->whereCondition->generate($condition22);

        //23. notbetween NOT BETWEEN 
        //("fld_38_101" < '140' OR "fld_38_101" > '155')
        $condition23 = '[{"property":"fld_38_101","value":"!{140,155}"}]'; 
        $result23 = Yii::$app->whereCondition->generate($condition23);

        //24. is in list [val1,val2]
        // ( "fld_38_101" IN ('591','590','5'))
        $condition24 = '[{"property":"fld_38_101","value":"[591,590,5]"}]';
        $result24 = Yii::$app->whereCondition->generate($condition24);

        //25. is not in list ![val1,val2]
        //( "fld_38_101" NOT IN ('591','590','5') )
        $condition25 = '[{"property":"fld_38_101","value":"![591,590,5]"}]';
        $result25 = Yii::$app->whereCondition->generate($condition25);

        //26.IS EMPTY =
        //( t79."mail_to"::TEXT = '' )
        $condition26 = '[{"property":"t79.mail_to","value":"="}]';
        $result26 = Yii::$app->whereCondition->generate($condition26);

        //27.IS NOT EMPTY =
        //( t79."mail_to"::TEXT = '' )
        $condition27 = '[{"property":"t79.mail_to","value":"<>"}]';
        $result27 = Yii::$app->whereCondition->generate($condition27);

        // 28. Multiple filters and values
        // ("fld_38_101" BETWEEN '220' AND '400') 
        // AND ("fld_38_107" is not null AND trim("fld_38_107"::text) != '')
        // AND ( "fld_38_124"::TEXT = '40' ) 
        // AND ( "fld_38_126" IN ('52','46') ) 
        // AND ( "fld_38_129" < '52' ) 
        $condition28 = '[{"property":"fld_38_101","value":"{220,400}"},{"property":"fld_38_107","value":"!#"},{"property":"fld_38_124","value":"=40"},{"property":"fld_38_126","value":"[52,46]"},{"property":"fld_38_129","value":"<52"}]';
        $result28 = Yii::$app->whereCondition->generate($condition28);


        //29. not less than NOT LESS THAN  !<
        //( "fld_3_101" > '2190610401' )
        $condition29 = '[{"property":"fld_3_101","value":"!<2190610401"}]';
        $result29 = Yii::$app->whereCondition->generate($condition29);

        //30. not greater than NOT GREATER THAN  !>
        //( "fld_3_101" < '2190610401' )
        $condition30 = '[{"property":"fld_3_101","value":"!>2190610401"}]';
        $result30 = Yii::$app->whereCondition->generate($condition30);

        //31. dose not begin with DOSE NOT BEGINS WITH  !val*
        //( t79."mail_to"::TEXT NOT iLIKE 'com%' )
        $condition31 = '[{"property":"t79.mail_to","value":"!com*"}]';
        $result31 = Yii::$app->whereCondition->generate($condition31);

        //32. dose not ends with DOSE NOT END WITH  !*val
        //( t79."mail_to"::TEXT NOT iLIKE '%com' )
        $condition32 = '[{"property":"t79.mail_to","value":"!*com"}]';
        $result32 = Yii::$app->whereCondition->generate($condition32);

        return $this->render('search',['result1'  =>$result1,
                                       'result1'  =>$result1,
                                       'result2'  =>$result2,
                                       'result3'  =>$result3,
                                       'result4'  =>$result4,
                                       'result5'  =>$result5,
                                       'result6'  =>$result6,
                                       'result7'  =>$result7,
                                       'result8'  =>$result8,
                                       'result9'  =>$result9,
                                       'result10' =>$result10,
                                       'result11' =>$result11,
                                       'result12' =>$result12,
                                       'result13' =>$result13,
                                       'result14' =>$result14,
                                       'result15' =>$result15,
                                       'result16' =>$result16,
                                       'result17' =>$result17,
                                       'result18' =>$result18,
                                       'result19' =>$result19,
                                       'result20' =>$result20,
                                       'result21' =>$result21,
                                       'result22' =>$result22,
                                       'result23' =>$result23,
                                       'result24' =>$result24,
                                       'result25' =>$result25,
                                       'result26' =>$result26,
                                       'result27' =>$result27,
                                       'result28' =>$result28,
                                       'result29' =>$result29,
                                       'result30' =>$result30,
                                       'result31' =>$result31,
                                       'result32' =>$result32,
        ]);
    }
}
