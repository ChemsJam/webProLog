<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Venta De Peliculas Online</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="csscopy/stylesEd.css" rel="stylesheet"/>
        <style>
        .carrusel {
    display: flex;
    overflow: hidden;
    width: 100%;
    scroll-behavior: smooth;
  }
  .carrusel2 {
    display: flex;
    overflow: hidden;
    width: 100%;
    scroll-behavior: smooth;
  }

  .carrusel3 {
    display: flex;
    overflow: hidden;
    width: 100%;
    scroll-behavior: smooth;
  }
  

.carta {
    padding: 10px;
    margin: 10px;
    border: 2px solid white;
    border-radius: 10px;
    flex: 0 0 calc(18.5%);
    color: white;
    
}

.carta img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  margin-bottom: 10px;
}

.carta h2 {
  margin: 0;
  font-size: 18px;
  font-weight: bold;
}

.carta p {
  margin: 5px 0;
}
h2{
  color:white;
}


    </style>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container"> 
    <a class="navbar-brand" href="index.php">Pelitropolis</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="categoria.php?categoria=drama">Drama</a></li>
              <li><a class="dropdown-item" href="categoria.php?categoria=accion">Acción</a></li>
              <li><a class="dropdown-item" href="categoria.php?categoria=romance">Romance</a></li>
              <li><a class="dropdown-item" href="categoria.php?categoria=suspenso">Suspenso</a></li>
              <li><a class="dropdown-item" href="categoria.php?categoria=fantasia">Fantasia</a></li>
              <li><a class="dropdown-item" href="categoria.php?categoria=comedia">Comedia</a></li>
              <li><a class="dropdown-item" href="categoria.php?categoria=ciencia_ficcion">Ciencia Ficcion</a></li>
              <li><a class="dropdown-item" href="categoria.php?categoria=animacion">Animación</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

        <!-- Header - set the background image for the header in the line below-->
        <header class="py-5 bg-image-full" style="background-image: url('https://source.unsplash.com/wfh8dDlNFOk/1600x900')">
            <div class="text-center my-5">
                <h1 class="text-white fs-3 fw-bolder">Estrenos</h1>
                <div class="carrusel">

                <?php
  // Conexión y consulta a Prolog
  $prologQuery = "estrenos(si)."; // Consulta para obtener películas de la categoría 'accion'
  $result = prologQuery($prologQuery); // Función para ejecutar la consulta en Prolog y obtener los resultados

  // Obtener todas las películas y guardarlas en un array
  $peliculas = array();
  foreach ($result as $row) {
    $peliculas[] = $row;
  }

  // Mostrar las primeras 5 cartas
  for ($i = 0; $i < 5; $i++) {
    if (isset($peliculas[$i])) {
      $pelicula = $peliculas[$i];
      generarCarta($pelicula);
    }
  }
  
  // Función para generar una carta con los datos de la película
  function generarCarta($pelicula) {
    $id = $pelicula['ID'];
    $titulo = $pelicula['Titulo'];
    $categoria = $pelicula['Categoria'];
    $anio = $pelicula['Anio'];
    $sinopsis = $pelicula['Sinopsis'];
    $duracion = $pelicula['Duracion'];
    $actores = $pelicula['Actores'];
    $idioma = $pelicula['Idioma'];
    $enlaces = $pelicula['Enlaces'];
    $costo = $pelicula['Costo'];
    $estreno = $pelicula['Estreno'];

    // Generar la carta con los datos de la película
    echo '<div class="carta bg-dark">';
    echo '<img src="img/' . $id . '.jpeg" alt="' . $titulo . '">';
    echo '<h2><a href="infopelic.php?id=' . $id . '&titulo=' . urlencode($titulo) . '&categoria=' . urlencode($categoria) . '&anio=' . $anio . '&sinopsis=' . urlencode($sinopsis) . '&duracion=' . $duracion . '&actores=' . urlencode($actores) . '&idioma=' . urlencode($idioma) . '&costo=' . $costo . '&enlaces=' . urlencode($enlaces) . '&estreno=' . urlencode($estreno) . '">' . $titulo . '</a></h2>';
    echo '<p>Categoría: ' . $categoria . '</p>';
    echo '<p>Año: ' . $anio . '</p>';
    echo '<p>Costo: $' . $costo . '</p>';
    echo '</div>';
  }
?>
</div>

<?php
function prologQuery($query) {
  // Comando para ejecutar la consulta en Prolog y capturar la salida
  $command = 'swipl -s peliculas.pl -g "' . $query . '" -g halt';
  $output = shell_exec($command);

  // Procesar la salida para obtener los datos de cada película
  $pattern = "/ID: (\d+)\nTítulo: (.+)\nCategoría: (.+)\nAño: (\d+)\nSinopsis: (.+)\nDuración: (\d+) minutos\nActores: (.+)\nIdioma: (.+)\nCosto: (.+)\nEnlaces: (.+)\nEstreno: ([^\n]+)/";
  preg_match_all($pattern, $output, $matches, PREG_SET_ORDER);


  // Crear un arreglo con los datos de cada película
  $result = [];
  foreach ($matches as $match) {
      $row = [
          'ID' => $match[1],
          'Titulo' => $match[2],
          'Categoria' => $match[3],
          'Anio' => $match[4],
          'Sinopsis' => $match[5],
          'Duracion' => $match[6],
          'Actores' => $match[7],
          'Idioma' => $match[8],
          'Costo' => $match[9],
          'Enlaces' => $match[10],
          'Estreno' => $match[11]

      ];
      $result[] = $row;
  }

  return $result;
}
?>


  </div>

            </div>
        </header>
        <!-- Content section-->
        <section class="bg-black">
                    <div class="text-center my-5">
                        <h2 class="text-center ">Peliculas en general</h2>
                        <?php
  // Conexión y consulta a Prolog
                        $prologQuery = "todas_las_peliculas."; // Consulta para obtener películas de la categoría 'accion'
                        $result = prologQuery($prologQuery); // Función para ejecutar la consulta en Prolog y obtener los resultados

  // Obtener todas las películas y guardarlas en un array
                        $peliculas = array();
                        foreach ($result as $row) {
                        $peliculas[] = $row;
                        }
                        // Mostrar las primeras 5 cartas


                        echo '<div class="carrusel3">';
                        for ($i = 0; $i < 5; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';
                        echo '<div class="carrusel3">';
                        for ($i = 10; $i < 15; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';
                        echo '<div class="carrusel3">';
                        for ($i = 20; $i < 25; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';
                        echo '<div class="carrusel3">';
                        for ($i = 30; $i < 35; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';
                        echo '<div class="carrusel3">';
                        for ($i = 40; $i < 45; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';

                        echo '<div class="carrusel3">';
                        for ($i = 50; $i < 55; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';

                        echo '<div class="carrusel3">';
                        for ($i = 60; $i < 65; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';

                        echo '<div class="carrusel3">';
                        for ($i = 65; $i < 70; $i++) {
                        if (isset($peliculas[$i])) {
                        $pelicula = $peliculas[$i];
                        generarCarta($pelicula);
                                    }                      
                        }
                        echo '</div>';


  ?>


                   
            </div>
        </section>
        <!-- Image element - set the background image for the header in the line below-->
        <div class="py-5 bg-image-full" style="background-image: url('https://source.unsplash.com/4ulffa6qoKA/1200x800')">
        <h1 class="text-white fs-3 fw-bolder text-center">Estrenos</h1>
        <div class="carrusel2">
  <?php
  // Mostrar las siguientes 5 cartas
  for ($i = 5; $i < 10; $i++) {
    if (isset($peliculas[$i])) {
      $pelicula = $peliculas[$i];
      generarCarta($pelicula);
    }
  }
  ?>
</div>
            <div style="height: 20rem"></div>
        </div>
        <!-- Content section-->
        
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script>
  function moveCarousel() {
    var carrusel = document.querySelector('.carrusel');
    var primerCarta = carrusel.firstElementChild;
    carrusel.removeChild(primerCarta);
    carrusel.appendChild(primerCarta);
  }

  function moveCarousel2() {
    var carrusel2 = document.querySelector('.carrusel2');
    var primerCarta = carrusel2.firstElementChild;
    carrusel2.removeChild(primerCarta);
    carrusel2.appendChild(primerCarta);
  }

  // Intervalo de tiempo para desplazar el carrusel (cada 3 segundos)
 setInterval(moveCarousel, 4500);
  setInterval(moveCarousel2, 4500);
</script>
        
    </body>
</html>
