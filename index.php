<?php
    // our fetch request requires headers to access the information 
    // from the api
    $headers = [
        "User-Agent: Example REST API Client",
        "Authorization: token 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"
    ];
    // initiate a curl session
    $ch = curl_init("https://api.github.com/user/repos");
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
    <h1>Repositories</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($data as $repo): ?>

            <tr>
                <td>
                    <a href="show.php?full_name=<?= $repo["full_name"]?>">
                        <?= $repo["name"]?>
                    </a>
                </td>
                <td><?= htmlspecialchars($repo["description"])?></td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>