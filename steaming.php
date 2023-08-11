<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="GET">
        <input type="text" placeholder="search show or movie" name="search" value="<?php echo isset($search) ? $search : ''; ?>"/>
        <input type="submit" name="submit" value="Search" class="btn btn-secondary"/>
    </form>
    <?php
    if(isset($_GET['submit'])){
        $search = $_GET['search'];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://streaming-availability.p.rapidapi.com/search/title?country=us&title=$search&output_language=en&show_type=all",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: streaming-availability.p.rapidapi.com",
                "X-RapidAPI-Key: 1bb1ef268fmshb7f3da6426b134fp1b085cjsn4b3c4ff4b564"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $results = json_decode($response, true);
        ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Streaming Services</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $data) { 
                    foreach ($data as $media) {
                ?>
                <tr>
                    <td><?= $media["title"]; ?></td>
                    <td>
                        <?php foreach ($media["streamingInfo"] as $country) {
                            foreach ($country as $service) {
                                echo $service['service'] . "<br>";
                            }
                        } ?>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        }
    }
    ?>
</body>
</html>
