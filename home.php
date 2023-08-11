<?php

    $ch = curl_init("https://trefle.io/api/v1/plants?token=Jm-LvrQIkJMxSh3sDnIopfGysqm7nuudtkTzdKDZZ9s");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $results = json_decode($response, true);
    
        foreach ($results as $data) {
        foreach($data as $plant){
            echo $plant,"<br/> <hr/>";
        }

    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example REST API</title>
</head>
<body>
    <h1>Example REST API</h1>

   
</body>
</html>