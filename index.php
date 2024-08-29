<?php
    const API_URL = "https://whenisthenextmcufilm.com/api";
   #Inicializar una nueva sesion de cURL; ch = cURL handle
   $ch =curl_init(API_URL);
   //Indicar que queremos recibir el resultado de la petición y no mostrarla en pantalla
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   // Omitir la verificación del certificado SSL (SOlO PARA PRUEBAS)
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

   /*Ejecutar la petición y
        guardar el resultado
   */
  $result = curl_exec($ch);

  /* 
    Una alternativa seria utilizar file_get_contents
    $result = file_get_contents(API_URL);  //Solo si quieres hacer un GET de una api
  */
  
  #Convierte el resultado en json y lo guarda en un array asociativo
  $data = json_decode($result, true);

  if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

  #Cerrar la conexion
  curl_close($ch);
  //var_dump($data);
?>

<head>
    <meta charset="UTF-8" />
    <title>La próxima película de Marvel</title>
    <meta name="description" content="La próxima película de Marvel" />
    <meta name="viewport" content="width=device-width, inicial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >
</head>

<main>
    <!-- <pre style="font-size: 12px; overflow:scroll; height:150px;">
        <?php var_dump($data); ?>
    </pre> -->
    <section>
        <!-- <h3>La proxima película de Marvel</h3> -->
        <img src="<?= $data["poster_url"]?>" width="200" 
             alt="Poster de <?=$data["title"]?>"
             style="border-radius:16px;"
        />
    </section>

    <hgroup>
        <h2><?= $data["title"] ?> se estrena en <?= $data["days_until"]; ?> días</h2>
        <p> Fecha de estreno:  <?= $data["release_date"] ?> </p>
        <p>La siguiente es: <?= $data["following_production"]["title"] ?> </p>
    </hgroup>
    
</main>

<style>
    :root{
        color-scheme: light dark;
    }

    body{
        display: grid;
        place-content: center;
    }

    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }
    
    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    img{
        margin: 0 auto;
    }
</style>