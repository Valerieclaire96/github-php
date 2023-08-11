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
            CURLOPT_URL => "https://dog-breeds2.p.rapidapi.com/dog_breeds/group/breed/$search",
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
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $results = json_decode($response, true);
        }
    }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Breed</th>
                    <th>Origin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $breed) { 
                ?>
                <tr>
                    <td>
                        <a href="dog_description.php?breed=<?=urlencode($breed["breed"]);?>">
                            <?= $breed["breed"]?>
                        </a>
                    </td>
                    <td><?= $breed["origin"]; ?></td>

                <?php
                    }
                ?>
            </tbody>
        </table>
     
</body>
</html>
