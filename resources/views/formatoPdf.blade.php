<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/lib/datatable/dataTables.bootstrap.min.css">
	<title>Reporte de reposición de material</title>
</head>

<body>
	<h1>Reposición de material</h1>	
	<p>El alumno {{ $formatoPdf -> nombre }} perteneciente a la carrera de gastronomia</p>
	<p>Daño {{ $formatoPdf -> cantidad }} {{ $formatoPdf -> nombre }} del material usado en la carrera de gastronomia</p>
	<p> por lo cual alumno tendrá que reponer dicho material o pagar el valor equivalente al material dañado</p>

</body>
</html>