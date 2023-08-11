<?php
$breed = $_GET["breed"];
$urlSafeBreed = str_replace(' ', '%20', $breed);

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://dog-breeds2.p.rapidapi.com/dog_breeds/breed/$urlSafeBreed",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: dog-breeds2.p.rapidapi.com",
        "X-RapidAPI-Key: 1bb1ef268fmshb7f3da6426b134fp1b085cjsn4b3c4ff4b564"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$data = []; // Initialize an empty array to hold data

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example REST API</title>
</head>
<body>
    <h1>Dog</h1>
    <?php if (!empty($data)) { ?>
        <dl>
            <?php 
                foreach($data as $info){
            ?>
            <dt>Name</dt>
            <dd><?= $info["breed"]; ?></dd>
            <dt>Description</dt>
            <img src="<?= $info["img"] ?>" alt="Dog Image">
            <dd><?= htmlspecialchars($info["origin"]); ?></dd>
            <?php } ?>
        </dl>
    <?php } ?>
</body>
</html>
