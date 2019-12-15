<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
single value<br>
1.[{"property":"fld_3_101","value":"2190610348"}]
<h4><?= Html::decode($result1)?></h4>

comma separated value <br> 
2.[{"property":"fld_3_101","value":"2190610348,22222222"}]
<h4><?= Html::decode($result2)?></h4>

multiple filter single values<br>
3.[{"property":"fld_3_101","value":"2190610348"},{"property":"t79.sender_name","value":"Taro"}]
<h4><?= Html::decode($result3)?></h4>

multiple filter and comma separated value<br>
4.[{"property":"fld_3_101","value":"2190610348,190610014"},{"property":"t79.sender_name","value":"Taro,James"}]
<h4><?= Html::decode($result4)?></h4>

EQUALS TO  =<br>
5.[{"property":"fld_3_101","value":"=190610014"}]
<h4><?= Html::decode($result5)?></h4>]

multiple filter double = equal to<br>
6.[{"property":"fld_3_101","value":"=2190610348"},{"property":"fld_3_158","value":"=32019061210001"}]
<h4><?= Html::decode($result6)?></h4>

multiple value with = equal to <br>
7.[{"property":"fld_3_101","value":"2190610348,=2190610401"}]
<h4><?= Html::decode($result7)?></h4>

! Not LIKE<br>
8.[{"property":"fld_3_101","value":"!2190610348"}]
<h4><?= Html::decode($result8)?></h4>

NOT EQUALS TO !=<br>
9.[{"property":"fld_3_101","value":"!=2190610348"}]
<h4><?= Html::decode($result9)?></h4>

! not like ! not like<br>
10.[{"property":"fld_3_101","value":"!2190610401,!2190610348"}]
<h4><?= Html::decode($result10)?></h4>

less than LESS THAN  <<br>
11.[{"property":"fld_3_101","value":"<2190610401"}]
<h4><?= Html::decode($result11)?></h4>

Greater Than ><br>
12.[{"property":"fld_3_101","value":">2190610401"}]
<h4><?= Html::decode($result12)?></h4>

Less Than or Equals To  <=<br>
13.[{"property":"fld_3_101","value":"<=2190610401"}]
<h4><?= Html::decode($result13)?></h4>

Greater Than or Equal To >=<br>
14.[{"property":"fld_3_101","value":">=2190610401"}]
<h4><?= Html::decode($result14)?></h4>

is null #<br>
15.[{"property":"fld_3_101","value":"#"}]
<h4><?= Html::decode($result15)?></h4>

is not null !#<br>
16.[{"property":"fld_3_101","value":"!#"}]
<h4><?= Html::decode($result16)?></h4>

multiple filter as not null <br>
17.[{"property":"fld_3_101","value":"!#"},{"property":"t79.mail_to","value":"!#"}]
<h4><?= Html::decode($result17)?></h4>

does not contains Case insensetive<br>
18.[{"property":"t79.mail_to","value":"!TEST"}]
<h4><?= Html::decode($result18)?></h4>

ENDS WITH %... // *....<br>
19.[{"property":"t79.mail_to","value":"*com"}]
<h4><?= Html::decode($result19)?></h4>

Begins With   ...% // ...*<br>
20.[{"property":"t79.mail_to","value":"com*"}]
<h4><?= Html::decode($result20)?></h4>

BETWEEN {val1,val2} <br>
21.[{"property":"fld_38_101","value":"{140,155}"}]
<h4><?= Html::decode($result21)?></h4>

double BETWEEN {val1,val2},{val1,val2}<br>
22.[{"property":"fld_38_101","value":"{140,155},{160,170}"}]
<h4><?= Html::decode($result22)?></h4>

NOT BETWEEN <br>
23.[{"property":"fld_38_101","value":"!{140,155}"}]
<h4><?= Html::decode($result23)?></h4>

is in list [val1,val2]<br>
24.[{"property":"fld_38_101","value":"[591,590,5]"}]
<h4><?= Html::decode($result24)?></h4>

is not in list ![val1,val2]<br>
25.[{"property":"fld_38_101","value":"![591,590,5]"}]
<h4><?= Html::decode($result25)?></h4>

IS EMPTY =<br>
26.[{"property":"t79.mail_to","value":"="}]
<h4><?= Html::decode($result26)?></h4>

IS NOT EMPTY =<br>
27.[{"property":"t79.mail_to","value":"<>"}]
<h4><?= Html::decode($result27)?></h4>

Multiple filters and values<br>
28.[{"property":"fld_38_101","value":"{220,400}"},{"property":"fld_38_107","value":"!#"},{"property":"fld_38_124","value":"=40"},{"property":"fld_38_126","value":"[52,46]"},{"property":"fld_38_129","value":"<52"}]
<h4><?= Html::decode($result28)?></h4>

NOT LESS THAN  !<<br>
29.[{"property":"fld_3_101","value":"!<2190610401"}]
<h4><?= Html::decode($result29)?></h4>

NOT GREATER THAN  !><br>
30.[{"property":"fld_3_101","value":"!>2190610401"}]
<h4><?= Html::decode($result30)?></h4>

DOSE NOT BEGINS WITH  !val*<br>
31.[{"property":"t79.mail_to","value":"!com*"}]
<h4><?= Html::decode($result31)?></h4>

DOSE NOT END WITH  !*val<br>
32.[{"property":"t79.mail_to","value":"!*com"}]
<h4><?= Html::decode($result32)?></h4>