<!DOCTYPE html>
<html>
<head>
	  <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>A*</title>
</head>
<header>
<h1>
	<center><strong>Algoritmo A* Para resolver Laberintos</strong>
</center></header>
</h1>

<body>
<center>
<div class="container">

    <div class="row">
      <div class="col-lg-8"  style="background-color:#aaa">
        <h1>Algoritmo A*: </h1> 
        <p align="justify">El algoritmo de búsqueda A* (pronunciado "A asterisco", "A estrella" o "Astar" en inglés) se clasifica dentro de los algoritmos de búsqueda en grafos de tipo heurístico o informado. Presentado por primera vez en 1968 por Peter E. Hart, Nils J. Nilsson y Bertram Raphael, el algoritmo A* encuentra, siempre y cuando se cumplan unas determinadas condiciones, el camino de menor coste entre un nodo origen y uno objetivo.</p>
      </div>
      <div class="col-lg-4"  style="background-color:#bbb">
      		<h1>Ingreso de datos: </h1> 
            <form name="form1"  action="LabA.php" method="post">
				Dimension (NxN) del laberinto
			<input type="text" size ="3" name="tam"/>
			<Br>
				Numero de Paredes
			<input type="text" size= "3" name="wall"/>
			<br>
			<input name=b1 type=submit value="Mostrar">
			</form>  
      </div>
  </div> 
</div>
</center>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

