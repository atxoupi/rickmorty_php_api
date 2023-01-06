<?php

$curl = curl_init(); //inicia la sesión cURL

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://rickandmortyapi.com/api/character", //url a la que se conecta
	CURLOPT_RETURNTRANSFER => true, //devuelve el resultado como una cadena del tipo curl_exec
	CURLOPT_FOLLOWLOCATION => true, //sigue el encabezado que le envíe el servidor
	CURLOPT_ENCODING => "", // permite decodificar la respuesta y puede ser"identity", "deflate", y "gzip", si está vacío recibe todos los disponibles.
	CURLOPT_MAXREDIRS => 10, // Si usamos CURLOPT_FOLLOWLOCATION le dice el máximo de encabezados a seguir
	CURLOPT_TIMEOUT => 30, // Tiempo máximo para ejecutar
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // usa la versión declarada
	CURLOPT_CUSTOMREQUEST => "GET", // el tipo de petición, puede ser PUT, POST, GET o Delete dependiendo del servicio
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: covid-19-coronavirus-statistics.p.rapidapi.com",
		"x-rapidapi-key: XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
	), //configura las cabeceras enviadas al servicio
)); //curl_setopt_array configura las opciones para una transferencia cURL

$response = curl_exec($curl);// respuesta generada
$err = curl_error($curl); // muestra errores en caso de existir
curl_close($curl); // termina la sesión 

function JSON2Array($data){
    return  (array) json_decode(stripslashes($data));
}

if ($err) {
	echo "cURL Error #:" . $err; // mostramos el error
} else {
	// echo $response; // en caso de funcionar correctamente
    $decoded_json=json_decode($response, false);
    $characters = $decoded_json->results;    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Rick & Morty</title>
</head>

<body>
    <div class="container">
    <div class="row row-cols-3">
    <?php
    // Aquí empezamos a crear Cards con los datos de cada personaje...
    foreach($characters as $character) {

        echo '<div class="card col-4 m-2 border border-warning bg-warning text-dark" style="width: 18rem;">';
        echo "<img src=$character->image class='card-img-top' alt='...'>";
        echo '<div class="card-body">';
        echo "<h5 class='card-title'>$character->name</h5>";
        echo "<p class='card-text'>Sexo:$character->gender Status:$character->status Especie:$character->species.</p>";
        echo '<a href="#" class="btn btn-outline-secondary">Mais Info</a>';
        echo '</div>';
        echo '</div>';
    
    }
    ?>
    </div>
    </div>
</body>
</html>