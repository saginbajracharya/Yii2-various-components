<?php

    /* @var $this yii\web\View */
    $this->title = 'YII 2';
    
    // set api key for last.fm
    // CallerFactory::getDefaultCaller()->setApiKey(b8df012a8db97ed3d6f0bfbe14434250);
    // search for the Coldplay band
    // $artistName = "Coldplay";
    // $limit = 1;
    // $results = Artist::search($artistName, $limit);

    // echo "<ul>";
    // while ($artist = $results->current()) {
    //     echo "<li><div>";
    //     echo "Artist URL: " . $artist->getUrl() . "<br>";
    //     echo '<img src="' . $artist->getImage(4) . '">';
    //     echo "</div></li>";
    //     $artist = $results->next();
    // }
    // echo "</ul>";

    //API for Weather
    $apiKey = "7edfb7f14a4ae86fe86871ac5c0a6d02";
    $cityId = "1283240";
    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $currentTime = time();
    //end weather
?>
<script type="text/javascript">
    function aZero(n) 
    {
        return n.toString().length == 1 ?  n = '0' + n: n;
    }
    function nowTime()
    {   
        var now = new Date();
        var hour = now.getHours();
        var min = now.getMinutes();
        var sec = now.getSeconds();
        var am = " AM";
        var pm = " PM";
        if (hour<12) //hour is less than 12 ( 0 1 2 3 4 5 6 7 8 9 10 11 ) then AM
        {
            if (hour==0)// 0 means 12 o'clock 12am + 12pm =24
            {
                document.getElementById('idForTime').innerHTML ="12"+ ":" +
                aZero(min)+":"+aZero(sec)+ am;
                setTimeout('nowTime()',1000);   
            }
            else// if hour is not 0 then it is less than 12 ( 1 2 3 4 5 6 7 8 9 10 11 )
            {
            document.getElementById('idForTime').innerHTML =aZero(hour)  + ":" +
            aZero(min)+":"+aZero(sec)+ am;
            setTimeout('nowTime()',1000);
            }
        
        }
        else if (hour>=12)//hour is bigger than 12 (13 14 15 16 17 18 19 20 21 22 23 24) or eqal to 12 to change am to pm when it strikes 12
        {
            document.getElementById('idForTime').innerHTML =aZero(hour)  + ":" +
            aZero(min)+":"+aZero(sec)+ pm;
            setTimeout('nowTime()',1000);
            
            if (hour>=13)//to show pm in 12 hour format we use subtraction to hour which increments from 13-24 by 12 so 13-12=1 14-12=2 15-12=3... 
            {
                var h = hour-12;
                document.getElementById('idForTime').innerHTML =aZero(h)  + ":" +
                aZero(min)+":"+aZero(sec)+ pm;
                setTimeout('nowTime()',1000);
            }   
        }
    }
    window.onload=nowTime;
</script>
<div class="report-container">
    <h2><?php echo $data->name; ?> Weather</h2>
    <div class="time">
        <div id="idForTime"></div>
        <div><?php echo Yii::$app->timeZone; ?></div>
        <div><?php echo date("h:i:s"); ?></div>
        <div><?php echo date("jS F, Y",$currentTime); ?></div>
        <div><?php echo ucwords($data->weather[0]->description); ?></div>
    </div>
    <div class="weather-forecast">
        <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
             class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
             class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
    </div>
    <div class="time">
        <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
        <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
    </div>
</div>

