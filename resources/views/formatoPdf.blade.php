
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<style>
        html  {
		  font: normal 13px arial,helvetica,sans-serif;
		  }

		h1  {
		  text-align: center;
		  color: black;
		  }

		p {
		  color: black;
		  }

        div#contenido {
		  border: solid 1px #000000;
		  position: center;
		  overflow: hidden;
		  top: 80px;
		  width: 90%;
		  height: 80%;
		  padding: 5%;
		}


    </style>

	<title>Reporte de reposición de material</title>
</head>

<body>
	<div id="contenido">
		<div id="marco">
			<p align="right">Manzanillo,col. &nbsp; Fecha: <?php echo date("m/d/Y"); ?></p>
			<h1>Reposición de material</h1><br>

			aqui va {{$danados[1]->id_danados}}
		</div>
	</div>
</body>
</html>
