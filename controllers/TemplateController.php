<?php
namespace app\controllers;
use Yii;

class TemplateController extends \yii\web\Controller
{
    public function actionTemplate()
    {
    	//In order to access the data in $params identifier params is used in return $twig->render('msg', ['params'=>$params]) username must be used to call.
    	
    	$message1 = "{# Accessing variable by {{ }} #}
    				<span><b>Hello</b></span> {{ username }} {{ lastname }} hello231";
        $params1  = ['username'=>'Max','lastname'=>'Bajra'];
        $output1  = Yii::$app->templateRenderer->render($message1,$params1);

        $message2 = "{# if elseif else Condition #}
        			{% if age < 25 %}
        				{{ username }} is still too young.
        			{% elseif age > 25 %}
        				{{ username }} is getting old now.
        			{% else %}
        				{{ username }} is 25 years old.
        			{% endif %}
        			";
        $params2  = ['username'=>'Max','age'=>25];
        $output2  = Yii::$app->templateRenderer->render($message2,$params2);

        $message3 = "{# for loop 1 #}
        			<h5><b>Users List:</b></h5>
		 			<ul>
		 				{% for user in params %}
		 					<li>{{ user.username }} {{ user.lastname }}</li>
		 				{% endfor %}
		 			</ul>";
        $params3  = array(['username'=>'Max','lastname'=>'Larson'],
        				  ['username'=>'Billy','lastname'=>'Talent'],
        			      ['username'=>'James','lastname'=>'Bond']);
        $output3  = Yii::$app->templateRenderer->render($message3,$params3);

        $message4 = "{# dump requires twig extension #}
        			params length : {{params|length}}
        			{{ dump(params) }}";
        $params4  = ['username'=>'Sagin','lastname'=>'Bajracharya'];
        $output4  = Yii::$app->templateRenderer->render($message4,$params4);

        $message5 = "{# for loop 2 #}
        			{% for topic, messages in params %}
						* {{ loop.index }}: {{ topic }}<br>
						{% for message in messages %}
							<li>{{ loop.parent.loop.index }}.{{ loop.index }}: {{ message }}</li>
						{% endfor %}
					{% endfor %}";
        $params5  = array(
							'topic1' => array('Message 1 of topic 1', 'Message 2 of topic 1'),
							'topic2' => array('Message 1 of topic 2', 'Message 2 of topic 2'),
					);
        $output5  = Yii::$app->templateRenderer->render($message5,$params5);

        $message6 = "{# for loop with else #}
        			{% for user in params %}
						<li>{{ user.username }}</li>
					{% else %}
						<li>no user found</li>
					{% endfor %}";
        $params6  =array();
        $output6  = Yii::$app->templateRenderer->render($message6,$params6);

        $message7 = "{# for loop with if condition #}
        			<h4>Active Members</h4>
					{% for user in params if user.active %}
						<li>{{ user.username|e }}</li>
					{% endfor %}";
        $params7  =array(['username'=>'Max','lastname'=>'Larson','active'=>true],
        				 ['username'=>'Billy','lastname'=>'Talent','active'=>true],
        			     ['username'=>'James','lastname'=>'Bond','active'=>false]);
        $output7  = Yii::$app->templateRenderer->render($message7,$params7);

        $message8 = "{# for loop Iterating over Keys #}
					{% for key in params|keys %}
						<li>{{ key }}</li>
					{% endfor %}";
        $params8  =array(['username'=>'Max','lastname'=>'Larson','active'=>true],
        				 ['username'=>'Billy','lastname'=>'Talent','active'=>true],
        			     ['username'=>'James','lastname'=>'Bond','active'=>false]);
        $output8  = Yii::$app->templateRenderer->render($message8,$params8);

        $message9 = "{# for loop Iterating over Keys & Values #}
        			<h4>Members Role No.</h4>
					{% for key,user in params %}
						<li>{{ key }} : {{ user.username }}</li>
					{% endfor %}";
        $params9  =array(['username'=>'Max','lastname'=>'Larson','active'=>true],
        				 ['username'=>'Billy','lastname'=>'Talent','active'=>true],
        			     ['username'=>'James','lastname'=>'Bond','active'=>false]);
        $output9  = Yii::$app->templateRenderer->render($message9,$params9);

        $message10 = "{# for loop Iterating over Keys & Values #}
					<h4>Top Three Members</h4>
					{% for user in params|slice(0, 3) %}
						<li>{{ user.username|e }}</li>
					{% endfor %}";
        $params10  =array(['username'=>'Max','lastname'=>'Larson','active'=>true],
        				 ['username'=>'Billy','lastname'=>'Talent','active'=>true],
        			     ['username'=>'James','lastname'=>'Bond','active'=>false],
        			     ['username'=>'Karl','lastname'=>'San','active'=>false]
        			 );
        $output10  = Yii::$app->templateRenderer->render($message10,$params10);

        $message11 = "{# Filter #}
        				lowerCase Filter : {{ username|lower }}<br>
        				upperCase Filter : {{ lastname|upper }}";
        $params11  = array('username'=>'SAGIN','lastname'=>'Bajracharya');
        $output11  = Yii::$app->templateRenderer->render($message11,$params11);

        $message12 = "{# Filter #}
        				{% for user in params %}
							{{ loop.index }} - {{ user.username }} {{ user.lastname }}<br>
						{% endfor %}";
        $params12  = array(['username'=>'Sagin','lastname'=>'Bajracharya'],
        				   ['username'=>'John','lastname'=>'Terry'],
        				   ['username'=>'Frank','lastname'=>'Lampard'],
        				   ['username'=>'Fernando','lastname'=>'Toress'],
    					);
        $output12  = Yii::$app->templateRenderer->render($message12,$params12);

        return $this->render('template',[
        								'output1'=>$output1,
        								'output2'=>$output2,
        								'output3'=>$output3,
        								'output4'=>$output4,
        								'output5'=>$output5,
        								'output6'=>$output6,
        								'output7'=>$output7,
        								'output8'=>$output8,
        								'output9'=>$output9,
        								'output10'=>$output10,
        								'output11'=>$output11,
        								'output12'=>$output12,
        							]);
    }

}
