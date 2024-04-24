<?php

const API_URL = "https://whenisthenextmcufilm.com/api";
# Initialize a new sesion in cURL; ch = cURL handle
$ch = curl_init(API_URL);

// Indicate that we want fetch the result of fetch and no show it at screen
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// To skip the certificates
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// Alternative is using file_get_contents
// $result = file_get_contents(API_URL); // If only want do a GET in an API

/**
 * Execute the query
 * and saved the result
 */
$result = curl_exec($ch);

// Hepfully to check the problem tha I had
if ($result === false) {
	echo "Curl error: " . curl_error($ch);
}
// else {
// 	echo "Operation completed without any errors, you have the response<br/>";
// }

$data = json_decode($result, true);

curl_close($ch);

?>

<head>
	<meta charset="UTF-8" />
	<title>La próxima película de Marvel</title>
	<meta name="description" content="La próxima película de Marvel" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>

<main>
	<!-- <pre style="font-size: 8px; overflow: scroll; height: 200px; padding: 10px 10px;">
		<?php var_dump($data); ?>
	</pre> -->

	<section>
		<img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data["title"]; ?>" style="border-radius: 14px;" />
	</section>

	<hgroup>
		<h3><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h3>
		<p>Fecha de estreno: <?= $data["release_date"] ?></p>
		<p>La siguiente película es: <?= $data["following_production"]["title"] ?></p>
	</hgroup>

</main>




<style>
	:root {
		color-scheme: light dark;
	}

	body {
		display: grid;
		place-content: center;
	}

	section {
		display: flex;
		justify-content: center;
		text-align: center;
	}

	hgroup {
		display: flex;
		flex-direction: column;
		justify-content: center;
		text-align: center;
	}

	img {
		margin: 0 auto;
	}
</style>