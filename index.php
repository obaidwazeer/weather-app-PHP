<?php

$curl = curl_init();

if (isset($_POST['city'])) {
    $city = $_POST['city'];
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://open-weather13.p.rapidapi.com/city/" . $city . "/%7Blang%7D",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: open-weather13.p.rapidapi.com",
            "x-rapidapi-key: 47f61005f9mshffa680fc6ce66efp19229fjsned5a10607e5f"
        ],
    ]);
} else {
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://open-weather13.p.rapidapi.com/city/islamabad/%7Blang%7D",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: open-weather13.p.rapidapi.com",
            "x-rapidapi-key: 47f61005f9mshffa680fc6ce66efp19229fjsned5a10607e5f"
        ],
    ]);
}





$response = curl_exec($curl);
$response = json_decode($response);
$err = curl_error($curl);

curl_close($curl);

// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     echo "<pre>";
//     print_r($response);
//     echo "</pre>"
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-bottom: 60px;
            /* Height of the footer */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 60px;
            /* Height of the footer */
            background-color: #f5f5f5;
        }

        p.card-text {
            margin-top: -10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Weather App</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-5 mb-4">Weather Application</h1>
        <div class="input-group mb-3">
            <form action="" method="post" class="form-inline">
                <div class="d-flex">
                    <div class="form-group">
                        <select class="form-select" name="city" id="city">
                            <option value="-1">-- Select City --</option>
                            <option value="karachi">Karachi</option>
                            <option value="lahore">Lahore</option>
                            <option value="faisalabad">Faisalabad</option>
                            <option value="rawalpindi">Rawalpindi</option>
                            <option value="gujranwala">Gujranwala</option>
                            <option value="peshawar">Peshawar</option>
                            <option value="multan">Multan</option>
                            <option value="islamabad">Islamabad</option>
                            <option value="quetta">Quetta</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" style="margin-left: 20px;"
                        class="btn btn-primary">Search</button>
                </div>
            </form>

        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Looks Like</h5>
                        <br>
                        <?php if (isset($response->weather[0]->icon)) { ?>
                            <img src="https://openweathermap.org/img/wn/<?php echo $response->weather[0]->icon; ?>@2x.png"
                                alt="Weather Icon">
                        <?php } else { ?>
                            <span>--</span>
                        <?php } ?>
                        <br>
                        <?php if (isset($response->weather[0]->description)) { 
                            echo $response->weather[0]->description;
                         } else { 
                            echo '--';
                         } ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Location Details</h5>
                        <br>
                        <p class="card-text">Country: <?php if (isset($response->sys->country)) {
                            echo $response->sys->country;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Name: <?php if (isset($response->name)) {
                            echo $response->name;
                        } else {
                            echo '--';
                        } ?></p>
                        </p>
                        <p class="card-text">Latitude: <?php if (isset($response->coord->lat)) {
                            echo $response->coord->lat;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Longitude: <?php if (isset($response->coord->lon)) {
                            echo $response->coord->lon;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Sunrise: <?php if (isset($response->sys->sunrise)) {
                            echo $response->sys->sunrise;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Sunset: <?php if (isset($response->sys->sunset)) {
                            echo $response->sys->sunset;
                        } else {
                            echo '--';
                        } ?></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Temperature &deg; C | &deg; F</h5>
                        <br>
                        <p class="card-text">Temp: <?php if (isset($response->main->temp)) {
                            echo $response->main->temp;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Min Temp: <?php if (isset($response->main->temp_min)) {
                            echo $response->main->temp_min;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Max Temp: <?php if (isset($response->main->temp_max)) {
                            echo $response->main->temp_max;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Feels Like: <?php if (isset($response->main->feels_like)) {
                            echo $response->main->feels_like;
                        } else {
                            echo '--';
                        } ?></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Precipitation &percnt;</h5>
                        <br>
                        <p class="card-text">Humidity: <?php if (isset($response->main->humidity)) {
                            echo $response->main->humidity;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Pressure: <?php if (isset($response->main->pressure)) {
                            echo $response->main->pressure;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Sea Level: <?php if (isset($response->main->sea_level)) {
                            echo $response->main->sea_level;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Ground Level: <?php if (isset($response->main->grnd_level)) {
                            echo $response->main->grnd_level;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Visibility: <?php if (isset($response->visibility)) {
                            echo $response->visibility;
                        } else {
                            echo '--';
                        } ?></p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Wind m/h</h5>
                        <br>
                        <p class="card-text">Speed: <?php if (isset($response->wind->speed)) {
                            echo $response->wind->speed;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Degree: <?php if (isset($response->wind->deg)) {
                            echo $response->wind->deg;
                        } else {
                            echo '--';
                        } ?></p>
                        <p class="card-text">Gust: <?php if (isset($response->wind->gust)) {
                            echo $response->wind->gust;
                        } else {
                            echo '--';
                        } ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br><br>
    <footer class="footer">
        <div class="container">
            <span class="text-muted">© 2024 Weather App. All rights reserved.</span>
        </div>
    </footer>
</body>

</html>