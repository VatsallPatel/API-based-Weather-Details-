<!DOCTYPE html>
<html>

    <head>

        <title>Weather App</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <style>
            
            body
            {
                margin-left : 35%;
                background-image : url(weather.jpg);
                background-size : cover;
                color : black;
            }
            
            .abc
            {
                text-align : center;
                align-items : center;
                width : 400px;
                justify-content : center;
            }
            
            h1
            {
                margin-top : 100px;
            }
        
        </style>
    
    </head>
    
    <body>
    
        <div class="abc">
            
            <h1>Search Weather</h1>
            <form method="POST">
                <label>Enter City</label>
                <input type="text" name="city" id="city" placeholder="Enter City Name">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>

                <?php
                    if (isset($_POST['submit']))
                    {
                        $city = $_POST['city'];
                        if(empty($city))
                        {
                            $error = "Input feild is empty";
                            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                        }
                        else if($city)
                        {
                            $api = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=159dc5bf35d72612c9415c1ce7da6e0a");
                            $weatherarray = json_decode($api,true);
                            if($weatherarray['cod']==200)
                            {
                                $temp = $weatherarray['main']['temp']-273;
                                $weather = "City : ".$city."<br> Temprature : ".$temp."&deg; C <br> Weather : ".$weatherarray['weather']['0']['description']."<br> Wind Speed : ".$weatherarray['wind']['speed']."meter/second <br> Cloudy : ".$weatherarray['clouds']['all']."%";
                                if($weather)
                                {
                                    echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                                }
                            }
                            else
                            {
                                $error = "Invalid city name";
                                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';    
                            }
                        }
                    }
                ?>

        </div>

    </body>

</html>