<?php
    // get the value we are using to identify the repo from the query string
    $full_name = $_GET["full_name"];
    // our fetch request requires headers to access the information 
    // from the api
    $headers = [
        "User-Agent: Example REST API Client",
        "Authorization: token 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"
    ];
    // initiate a curl session
    $ch = curl_init("https://api.github.com/repos/$full_name");
    // passing the url of this end point which returns a handle to the 
    // curl session so we assign that value to a variable
    // to attach the header to the reuqest we use the curl set opt
    // where we pass in the curl handle, the curl opt http header function
    // and the headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // we need to aviod the request data from being sent directly to the browser
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // this will make the response body return as a string when we call the curl exec function
    
    // to send the request we use the curl exec function and pass in the 
    // variable
    $response = curl_exec($ch);

  

    // call curl close to close the session, to free up any resources
    curl_close($ch);

    // will show the response data in on the browser
    // var_dump($response);

    // to decode the response we can use json_decode
    // returns the data in an array of associative arrays
    // without true it would be an object
    $data = json_decode($response, true);

    // foreach ($data as $repository) {

    //     echo $repository["full_name"], " ",
    //      $repository["name"], " ",
    //      $repository["description"], "<br>";

    // };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example REST API</title>
</head>
<body>
    <h1>Repository</h1>
        <dl>
            <dt>Name</dt>
            <dd><?= $data["name"];?></dd>
            <dt>Description</dt>
            <dd><?= htmlspecialchars($data["description"]);?></dd>
        </dl>
   
</body>
</html>