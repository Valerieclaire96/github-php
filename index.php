<?php
    // our fetch request requires headers to access the information 
    // from the api
    $headers = [
        "User-Agent: Example REST API Client"
    ];
    // initiate a curl session
    $ch = curl_init("https://api.github.com/user/repos");
    // passing the url of this end point which returns a handle to the 
    // curl session so we assign that value to a variable
    // to attach the header to the reuqest we use the curl set opt
    // where we pass in the curl handle, the curl opt http header function
    // and the headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    // to send the request we use the curl exec function and pass in the 
    // variable
    curl_exec($ch);

  

    // call curl close to close the session, to free up any resources
    curl_close($ch);
?>