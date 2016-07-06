<?php

require_once "lib/nusoap.php";

// Funcion normalizar nombre
function NormalizarNombre($name)
{
	//$str = $name;


	$explode = explode(" ",$name);
	
	
	
	
	$normalice='';
	
	for ($i = 0; $i <= (count($explode) -1); $i++) {
		
		if (trim($explode[$i]) != '')
			$normalice=$normalice.$explode[$i].' ';
	}
	
	
	return $normalice;

}

// La funcion que se va a exportar
function test($nombre)
{
        return "Hola ".$nombre;
}

function CrearLocalidad($nombre,$fechafallecimiento)
{
	include('');
	return "Hola ".$nombre;
}

function ConsultaSepelios()
{
	include('conexion.php');
	$contar = "SELECT * FROM sepelio"; 
	$contarok= mysql_query($contar);
	$total_records = mysql_num_rows($contarok);

	return "Cantidad de sepelios: ".$total_records;
}

//Funcion Crear Sepelio
function CrearSepelio($nombre,$fechafallecimiento,$fechasepelio,$hora,$localidad,$nombrelocalidad,$lugar,$sala,$nombresala,$fechamisa,$horamisa,$iglesiaid,$nombreiglesia,$otrolugarmisa,$lugarinhumacion,$nombrelugarinhumacion,$fechanacimiento,$opcion,$lugarcremacion,$nombrelugarcremacion,$otrasala,$domiciliootrasala,$oracion,$nombreoracion,$contenidooracion,$idcocheria,$domiciliosala)
{
	$nombre = NormalizarNombre($nombre);
	include('conexion.php');
	//Resguardo el sepelio entrante para control
	$sql = "insert into ResguardoWs 
	(IdInterno, 
	DateTime, 
	Nombre, 
	FechaFallecimiento, 
	FechaSepelio, 
	Hora, 
	Localidad, 
	NombreLocalidad, 
	Lugar, 
	Sala, 
	NombreSala, 
	FechaMisa, 
	HoraMisa, 
	IglesiaId, 
	NombreIglesia, 
	OtroLugarMisa, 
	LugarInhumacion, 
	NombreLugarInhumacion, 
	FechaNacimiento, 
	Opcion, 
	LugarCremacion, 
	NombreLugarCremacion, 
	OtraSala, 
	DomicilioOtraSala, 
	Oracion, 
	NombreOracion, 
	ContenidoOracion, 
	IdCocheria, 
	DomicilioSala
	)
	VALUES
	(0, 
	DATE(NOW()),
	'$nombre',
	'$fechafallecimiento',
	'$fechasepelio',
	'$hora',
	'$localidad',
	'$nombrelocalidad',
	'$lugar',
	'$sala',
	'$nombresala',
	'$fechamisa',
	'$horamisa',
	'$iglesiaid',
	'$nombreiglesia',
	'$otrolugarmisa',
	'$lugarinhumacion',
	'$nombrelugarinhumacion',
	'$fechanacimiento',
	'$opcion',
	'$lugarcremacion',
	'$nombrelugarcremacion',
	'$otrasala',
	'$domiciliootrasala',
	'$oracion',
	'$nombreoracion',
	'$contenidooracion',
	'$idcocheria',
	'$domiciliosala'
	)";
	mysql_query($sql);
	
	//Controlo si existe para hacer insert
	$sql = "SELECT * FROM sepelio where IdCocheria = $idcocheria"; 
	$wssepelio = mysql_query($sql);
	$wssepelio = mysql_fetch_array($wssepelio);
	if ($wssepelio['IdCocheria'] != $idcocheria){
		//INSERT SEPELIO
		
		
		//localidad
		$sql = "SELECT * FROM wsLocalidad where IdCocheria = '$localidad'"; 
		$wslocalidad = mysql_query($sql);
		$wslocalidad = mysql_fetch_array($wslocalidad);
		
		if ($wslocalidad['IdInterno'] == "")
		{
			//Crear localidad nueva e insertar también en tabla ws localidad
			$sql = "INSERT INTO localidad(Nombre,date_time) VALUES ('$nombrelocalidad',NOW())";
			mysql_query($sql);
			
			$sql = "SELECT id from localidad where Nombre = '$nombrelocalidad'";
			$interno = mysql_query($sql);
			$interno = mysql_fetch_array($interno);
			$interno = $interno['id'];
			
			$sql = "INSERT INTO wsLocalidad(Descripcion, IdCocheria, IdInterno,date_time) VALUES ('$nombrelocalidad','$localidad',$interno,NOW())";
			mysql_query($sql);
		}
		else{
			$interno= $wslocalidad['IdInterno'];
			if ($wslocalidad['Descripcion']!= $nombrelocalidad)
			{
				//actualizar descripcion de wslocalidad y Localidad
				$sql = "UPDATE `localidad` SET Nombre='$nombrelocalidad',date_time=NOW() WHERE id = $interno"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsLocalidad` SET `Descripcion`='$nombrelocalidad',date_time=NOW() WHERE IdInterno=$interno";
				mysql_query($sql);
			}
		}
		//fin macheo localidad
		
		//sala
			//controlo que no venga con sala particular
		if ($otrasala==""){
			//Sala de cochería
			
			$sql = "SELECT * FROM wsSalas where IdCocheria = $sala"; 
			$wssala = mysql_query($sql);
			$wssala = mysql_fetch_array($wssala);
			
			if ($wssala['IdInterno'] == ""){
				//Crear sala nueva e insertar también en tabla wssala
				$sql = "INSERT INTO salas(Sala,date_time,Localidad,Direccion) VALUES ('$nombresala',NOW(),$interno,'$domiciliosala')";
				mysql_query($sql);
				
				$sql = "SELECT id from salas where Sala = '$nombresala'";
				$interno_sala = mysql_query($sql);
				$interno_sala = mysql_fetch_array($interno_sala);
				$interno_sala = $interno_sala['id'];
				
				$sql = "INSERT INTO wsSalas(Descripcion, IdCocheria, IdInterno,date_time,Direccion) VALUES ('$nombresala',$sala,$interno_sala,NOW(),'$domiciliosala')";
				mysql_query($sql);
				}
			else{
				$interno_sala= $wssala['IdInterno'];
				if ($wssala['Descripcion']!= $nombresala)
				{
					//actualizar descripcion de wssalas y salas
					$sql = "UPDATE `salas` SET Sala='$nombresala',date_time=NOW() WHERE id = $interno_sala"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsSalas` SET `Descripcion`='$nombresala',date_time=NOW() WHERE IdInterno=$interno_sala";
					mysql_query($sql);
				}
				
				//chequeo si hay cambio de domicilio
				if ($wssala['Direccion']!= $domiciliosala)
				{
					//actualizar descripcion de wssalas y salas
					$sql = "UPDATE `salas` SET Direccion='$domiciliosala',date_time=NOW() WHERE id = $interno_sala"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsSalas` SET `Direccion`='$domiciliosala',date_time=NOW() WHERE IdInterno=$interno_sala";
					mysql_query($sql);
				}
			}
		}
		else
		{
			//Sala particular
			$interno_sala=20;
		}
		// macheo sala
		
		//iglesia
		$sql = "SELECT * FROM wsIglesias where IdCocheria = $iglesiaid"; 
		$wsiglesia = mysql_query($sql);
		$wsiglesia = mysql_fetch_array($wsiglesia);
		
		if ($wsiglesia['IdInterno'] == ""){
			//Crear sala nueva e insertar también en tabla wssala
			$sql = "INSERT INTO iglesias(Nombre,date_time,Localidad) VALUES ('$nombreiglesia',NOW(),$interno)";
			mysql_query($sql);
			
			$sql = "SELECT id from iglesias where Nombre = '$nombreiglesia'";
			$interno_iglesia = mysql_query($sql);
			$interno_iglesia = mysql_fetch_array($interno_iglesia);
			$interno_iglesia = $interno_iglesia['id'];
			
			$sql = "INSERT INTO wsIglesias(Descripcion, IdCocheria, IdInterno,date_time) VALUES ('$nombreiglesia',$iglesiaid,$interno_iglesia,NOW())";
			mysql_query($sql);
			}
		else{
			$interno_iglesia= $wsiglesia['IdInterno'];
			if ($wsiglesia['Descripcion']!= $nombreiglesia)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `iglesias` SET Nombre='$nombreiglesia',date_time=NOW() WHERE id = $interno_iglesia"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsIglesias` SET `Descripcion`='$nombreiglesia',date_time=NOW() WHERE IdInterno=$interno_iglesia";
				mysql_query($sql);
			}
		}
		// macheo iglesia
		
		//oracion
		$sql = "SELECT * FROM wsOraciones where IdCocheria = $oracion"; 
		$wsoracion = mysql_query($sql);
		$wsoracion = mysql_fetch_array($wsoracion);
		
		if ($wsoracion['IdInterno'] == ""){
			//if si existe en mi tabla interna
			
			//else
			//Crear sala nueva e insertar también en tabla wssala
			$sql = "INSERT INTO oracion(Titulo,date_time,Texto) VALUES ('$nombreoracion',NOW(),'$contenidooracion')";
			mysql_query($sql);
			
			$sql = "SELECT id from oracion where Titulo = '$nombreoracion'";
			$interno_oracion = mysql_query($sql);
			$interno_oracion = mysql_fetch_array($interno_oracion);
			$interno_oracion = $interno_oracion['id'];
			
			$sql = "INSERT INTO wsOraciones(Titulo, IdCocheria, IdInterno,date_time,Texto) VALUES ('$nombreoracion',$oracion,$interno_oracion,NOW(),'$contenidooracion')";
			mysql_query($sql);
			}
		else{
			$interno_oracion= $wsoracion['IdInterno'];
			if ($wsoracion['Titulo']!= $nombreoracion)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `oracion` SET Titulo='$nombreoracion',date_time=NOW() WHERE id = $interno_oracion"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsOraciones` SET `Titulo`='$nombreoracion',date_time=NOW() WHERE IdInterno=$interno_oracion";
				mysql_query($sql);
			}
			
			if ($wsoracion['Texto']!= $contenidooracion)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `oracion` SET Texto='$contenidooracion',date_time=NOW() WHERE id = $interno_oracion"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsOraciones` SET `Texto`='$contenidooracion',date_time=NOW() WHERE IdInterno=$interno_oracion";
				mysql_query($sql);
			}
		}
		// macheo oracion
			
		//Macheo lugar inhumacion o cremacion
		if ($opcion == 1)
		{
			// inhumacion
			$interno_cremacion=0;	//esto seteo porque no me deja hacer insert con la variable vacía	
			$sql = "SELECT * FROM wsCementerios where IdCocheria = $lugarinhumacion"; 
			$wsinhumacion = mysql_query($sql);
			$wsinhumacion = mysql_fetch_array($wsinhumacion);
		
			if ($wsinhumacion['IdInterno'] == ""){
				//Creo el cementerio y wscementerio
				$sql = "INSERT INTO lugarinhumacion(Lugar,date_time,Localidad) VALUES ('$nombrelugarinhumacion',NOW(),$interno)";
				mysql_query($sql);
				
				$sql = "SELECT id from lugarinhumacion where Lugar = '$nombrelugarinhumacion'";
				$interno_inhumacion = mysql_query($sql);
				$interno_inhumacion = mysql_fetch_array($interno_inhumacion);
				$interno_inhumacion = $interno_inhumacion['id'];
				
				$sql = "INSERT INTO wsCementerios(Descripcion, IdCocheria, IdInterno,date_time,Opcion) VALUES 				('$nombrelugarinhumacion',$lugarinhumacion,$interno_inhumacion,NOW(),$opcion)";
				mysql_query($sql);
				}
			else{
				$interno_inhumacion= $wsinhumacion['IdInterno'];
				if ($wsinhumacion['Descripcion']!= $nombrelugarinhumacion)
				{
					//actualizar descripcion de wssCementerios y lugarinhumacion
					$sql = "UPDATE `lugarinhumacion` SET Lugar='$nombrelugarinhumacion',date_time=NOW() WHERE id = $interno_inhumacion"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsCementerios` SET `Descripcion`='$nombrelugarinhumacion',date_time=NOW(),Opcion=$opcion WHERE 	IdInterno=$interno_inhumacion";
					mysql_query($sql);
				}		
			}
		}
		
		else
		{
			// cremacion
			$interno_inhumacion=0; //esto seteo porque no me deja hacer insert con la variable vacía
			$sql = "SELECT * FROM wsCementerios where IdCocheria = $lugarcremacion"; 
			$wscremacion = mysql_query($sql);
			$wscremacion = mysql_fetch_array($wscremacion);
		
			if ($wscremacion['IdInterno'] == ""){
				//Creo el crematorio y wscementerio
				$sql = "INSERT INTO lugarcremacion(Lugar,date_time,Localidad) VALUES ('$nombrelugarcremacion',NOW(),$interno)";
				mysql_query($sql);
				
				$sql = "SELECT id from lugarcremacion where Lugar = '$nombrelugarcremacion'";
				$interno_cremacion = mysql_query($sql);
				$interno_cremacion = mysql_fetch_array($interno_cremacion);
				$interno_cremacion = $interno_cremacion['id'];
				
				$sql = "INSERT INTO wsCementerios(Descripcion, IdCocheria, IdInterno,date_time,Opcion) VALUES 				('$nombrelugarcremacion',$lugarcremacion,$interno_cremacion,NOW(),$opcion)";
				mysql_query($sql);
				}
			else{
				$interno_cremacion= $wscremacion['IdInterno'];
				if ($wscremacion['Descripcion']!= $nombrelugarcremacion)
				{
					//actualizar descripcion de wssCementerios y lugarinhumacion
					$sql = "UPDATE `lugarcremacion` SET Lugar='$nombrelugarcremacion',date_time=NOW() WHERE id = $interno_cremacion"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsCementerios` SET `Descripcion`='$nombrelugarcremacion',date_time=NOW(),Opcion=$opcion WHERE 	IdInterno=$interno_cremacion";
					mysql_query($sql);
				}		
			}
		}
		
		//Fin Macheo lugar inhumacion o cremacion
		
		//insertar el sepelio
		$insertar="INSERT INTO sepelio 
			(date_time,
			FechaFallecimiento,
			FechaSepelio,
			Hora,
			Localidad,
			Lugar,
			Nombre,
			Salon,
			Dia,
			HoraMisa,
			LugarMisa,
			OtroLugar,
			LugarInhumacion,
			FechaNacimiento,
			opcion,
			LugarCremacion,
			Oracion,
			OtroSalon,
			DomicilioOtroSalon,
			Aprobado,
			IdCocheria,
			DireccionSala) 
	
			VALUES 
	
			(DATE(NOW()), /* date_time Fecha y hora de alta OK*/
			'$fechafallecimiento', /* fecha de fallecimiento* OK*/
			'$fechasepelio', /* fecha de sepelio */
			'$hora', /*  Hora */
			$interno, /* Localidad */
			'$lugar', /* Lugar (para cuando se coloca otro lugar de Cremacion o Inhumacion) */
			'$nombre', /* Nombre*/
			$interno_sala, /* Sala */
			'$fechamisa', /* Fecha de misa*/
			'$horamisa', /*  Hora de misa*/
			$interno_iglesia, /* Lugar de misa */
			'$otrolugarmisa', /* Otro lugar de misa */
			$interno_inhumacion, /*  Cementerio - Lugar de inhumacion */
			'$fechanacimiento', /* Fecha de nacimiento*/
			$opcion, /* Opcion: 1: Inhumacion 2: Cremacion*/
			$interno_cremacion, /* Lugar de cremacion */
			$interno_oracion, /* Lugar de cremacion */
			'$otrasala', /* Otro salon*/
			'$domiciliootrasala', /* Domicilio otro salon*/
			0, /*Aprobado*/
			$idcocheria, /*Id Cocheria*/
			'$domiciliosala' 
			) 
			";
		$insert= mysql_query($insertar);
		
		//Fin insercion sepelio
		
		//Respuesta
		$contar = mysql_insert_id(); 
		return $contar;
		//Respuesta
	}
	else
	{
	// Update SEPELIO
		$sql = "SELECT * FROM wsLocalidad where IdCocheria = '$localidad'"; 
		$wslocalidad = mysql_query($sql);
		$wslocalidad = mysql_fetch_array($wslocalidad);
		
		if ($wslocalidad['IdInterno'] == ""){
			//Crear localidad nueva e insertar también en tabla ws localidad
			$sql = "INSERT INTO localidad(Nombre,date_time) VALUES ('$nombrelocalidad',NOW())";
			mysql_query($sql);
			
			$sql = "SELECT id from localidad where Nombre = '$nombrelocalidad'";
			$interno = mysql_query($sql);
			$interno = mysql_fetch_array($interno);
			$interno = $interno['id'];
			
			$sql = "INSERT INTO wsLocalidad(Descripcion, IdCocheria, IdInterno,date_time) VALUES ('$nombrelocalidad','$localidad',$interno,NOW())";
			mysql_query($sql);
			}
		else{
			$interno= $wslocalidad['IdInterno'];
			if ($wslocalidad['Descripcion']!= $nombrelocalidad)
			{
				//actualizar descripcion de wslocalidad y Localidad
				$sql = "UPDATE `localidad` SET Nombre='$nombrelocalidad',date_time=NOW() WHERE id = $interno"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsLocalidad` SET `Descripcion`='$nombrelocalidad',date_time=NOW() WHERE IdInterno=$interno";
				mysql_query($sql);
			}
		}
		//fin macheo localidad
		
		//sala
			//controlo que no venga con sala particular
		if ($otrasala==""){
			//Sala de cochería
			
			$sql = "SELECT * FROM wsSalas where IdCocheria = $sala"; 
			$wssala = mysql_query($sql);
			$wssala = mysql_fetch_array($wssala);
			
			if ($wssala['IdInterno'] == ""){
				//Crear sala nueva e insertar también en tabla wssala
				$sql = "INSERT INTO salas(Sala,date_time,Localidad,Direccion) VALUES ('$nombresala',NOW(),$interno,'$domiciliosala')";
				mysql_query($sql);
				
				$sql = "SELECT id from salas where Sala = '$nombresala'";
				$interno_sala = mysql_query($sql);
				$interno_sala = mysql_fetch_array($interno_sala);
				$interno_sala = $interno_sala['id'];
				
				$sql = "INSERT INTO wsSalas(Descripcion, IdCocheria, IdInterno,date_time,Direccion) VALUES ('$nombresala',$sala,$interno_sala,NOW(),'$domiciliosala')";
				
				mysql_query($sql);
				}
			else{
				$interno_sala= $wssala['IdInterno'];
				if ($wssala['Descripcion']!= $nombresala)
				{
					//actualizar descripcion de wssalas y salas
					$sql = "UPDATE `salas` SET Sala='$nombresala',date_time=NOW() WHERE id = $interno_sala"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsSalas` SET `Descripcion`='$nombresala',date_time=NOW() WHERE IdInterno=$interno_sala";
					mysql_query($sql);
				}
				
				//chequeo si hay cambio de domicilio
				if ($wssala['Direccion']!= $domiciliosala)
				{
					//actualizar descripcion de wssalas y salas
					$sql = "UPDATE `salas` SET Direccion='$domiciliosala',date_time=NOW() WHERE id = $interno_sala"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsSalas` SET `Direccion`='$domiciliosala',date_time=NOW() WHERE IdInterno=$interno_sala";
					mysql_query($sql);
				}
			}
		}
		else
		{
			//Sala particular
			$interno_sala =20;
		}
		// macheo sala
		
		//iglesia
		$sql = "SELECT * FROM wsIglesias where IdCocheria = $iglesiaid"; 
		$wsiglesia = mysql_query($sql);
		$wsiglesia = mysql_fetch_array($wsiglesia);
		
		if ($wsiglesia['IdInterno'] == ""){
			//Crear sala nueva e insertar también en tabla wssala
			$sql = "INSERT INTO iglesias(Nombre,date_time,Localidad) VALUES ('$nombreiglesia',NOW(),$interno)";
			mysql_query($sql);
			
			$sql = "SELECT id from iglesias where Nombre = '$nombreiglesia'";
			$interno_iglesia = mysql_query($sql);
			$interno_iglesia = mysql_fetch_array($interno_iglesia);
			$interno_iglesia = $interno_iglesia['id'];
			
			$sql = "INSERT INTO wsIglesias(Descripcion, IdCocheria, IdInterno,date_time) VALUES ('$nombreiglesia',$iglesiaid,$interno_iglesia,NOW())";
			mysql_query($sql);
			}
		else{
			$interno_iglesia= $wsiglesia['IdInterno'];
			if ($wsiglesia['Descripcion']!= $nombreiglesia)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `iglesias` SET Nombre='$nombreiglesia',date_time=NOW() WHERE id = $interno_iglesia"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsIglesias` SET `Descripcion`='$nombreiglesia',date_time=NOW() WHERE IdInterno=$interno_iglesia";
				mysql_query($sql);
			}
		}
		// macheo iglesia
		
		//oracion
		$sql = "SELECT * FROM wsOraciones where IdCocheria = $oracion"; 
		$wsoracion = mysql_query($sql);
		$wsoracion = mysql_fetch_array($wsoracion);
		
		if ($wsoracion['IdInterno'] == ""){
			//if si existe en mi tabla interna
			
			//else
			//Crear sala nueva e insertar también en tabla wssala
			$sql = "INSERT INTO oracion(Titulo,date_time,Texto) VALUES ('$nombreoracion',NOW(),'$contenidooracion')";
			mysql_query($sql);
			
			$sql = "SELECT id from oracion where Titulo = '$nombreoracion'";
			$interno_oracion = mysql_query($sql);
			$interno_oracion = mysql_fetch_array($interno_oracion);
			$interno_oracion = $interno_oracion['id'];
			
			$sql = "INSERT INTO wsOraciones(Titulo, IdCocheria, IdInterno,date_time,Texto) VALUES ('$nombreoracion',$oracion,$interno_oracion,NOW(),'$contenidooracion')";
			mysql_query($sql);
			}
		else{
			$interno_oracion= $wsoracion['IdInterno'];
			if ($wsoracion['Titulo']!= $nombreoracion)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `oracion` SET Titulo='$nombreoracion',date_time=NOW() WHERE id = $interno_oracion"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsOraciones` SET `Titulo`='$nombreoracion',date_time=NOW() WHERE IdInterno=$interno_oracion";
				mysql_query($sql);
			}
			
			if ($wsoracion['Texto']!= $contenidooracion)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `oracion` SET Texto='$contenidooracion',date_time=NOW() WHERE id = $interno_oracion"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsOraciones` SET `Texto`='$contenidooracion',date_time=NOW() WHERE IdInterno=$interno_oracion";
				mysql_query($sql);
			}
		}
		// macheo oracion
			
		//Macheo lugar inhumacion o cremacion
		if ($opcion == 1)
		{
			// inhumacion
			$interno_cremacion=0;	//esto seteo porque no me deja hacer insert con la variable vacía	
			$sql = "SELECT * FROM wsCementerios where IdCocheria = $lugarinhumacion"; 
			$wsinhumacion = mysql_query($sql);
			$wsinhumacion = mysql_fetch_array($wsinhumacion);
		
			if ($wsinhumacion['IdInterno'] == ""){
				//Creo el cementerio y wscementerio
				$sql = "INSERT INTO lugarinhumacion(Lugar,date_time,Localidad) VALUES ('$nombrelugarinhumacion',NOW(),$interno)";
				mysql_query($sql);
				
				$sql = "SELECT id from lugarinhumacion where Lugar = '$nombrelugarinhumacion'";
				$interno_inhumacion = mysql_query($sql);
				$interno_inhumacion = mysql_fetch_array($interno_inhumacion);
				$interno_inhumacion = $interno_inhumacion['id'];
				
				$sql = "INSERT INTO wsCementerios(Descripcion, IdCocheria, IdInterno,date_time,Opcion) VALUES 				('$nombrelugarinhumacion',$lugarinhumacion,$interno_inhumacion,NOW(),$opcion)";
				mysql_query($sql);
				}
			else{
				$interno_inhumacion= $wsinhumacion['IdInterno'];
				if ($wsinhumacion['Descripcion']!= $nombrelugarinhumacion)
				{
					//actualizar descripcion de wssCementerios y lugarinhumacion
					$sql = "UPDATE `lugarinhumacion` SET Lugar='$nombrelugarinhumacion',date_time=NOW() WHERE id = $interno_inhumacion"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsCementerios` SET `Descripcion`='$nombrelugarinhumacion',date_time=NOW(),Opcion=$opcion WHERE 	IdInterno=$interno_inhumacion";
					mysql_query($sql);
				}		
			}
		}
		
		else
		{
			// cremacion
			$interno_inhumacion=0; //esto seteo porque no me deja hacer insert con la variable vacía
			$sql = "SELECT * FROM wsCementerios where IdCocheria = $lugarcremacion"; 
			$wscremacion = mysql_query($sql);
			$wscremacion = mysql_fetch_array($wscremacion);
		
			if ($wscremacion['IdInterno'] == ""){
				//Creo el crematorio y wscementerio
				$sql = "INSERT INTO lugarcremacion(Lugar,date_time,Localidad) VALUES ('$nombrelugarcremacion',NOW(),$interno)";
				mysql_query($sql);
				
				$sql = "SELECT id from lugarcremacion where Lugar = '$nombrelugarcremacion'";
				$interno_cremacion = mysql_query($sql);
				$interno_cremacion = mysql_fetch_array($interno_cremacion);
				$interno_cremacion = $interno_cremacion['id'];
				
				$sql = "INSERT INTO wsCementerios(Descripcion, IdCocheria, IdInterno,date_time,Opcion) VALUES 				('$nombrelugarcremacion',$lugarcremacion,$interno_cremacion,NOW(),$opcion)";
				mysql_query($sql);
				}
			else{
				$interno_cremacion= $wscremacion['IdInterno'];
				if ($wscremacion['Descripcion']!= $nombrelugarcremacion)
				{
					//actualizar descripcion de wssCementerios y lugarinhumacion
					$sql = "UPDATE `lugarcremacion` SET Lugar='$nombrelugarcremacion',date_time=NOW() WHERE id = $interno_cremacion"; 
					mysql_query($sql);
				
					$sql= "UPDATE `wsCementerios` SET `Descripcion`='$nombrelugarcremacion',date_time=NOW(),Opcion=$opcion WHERE 	IdInterno=$interno_cremacion";
					mysql_query($sql);
				}		
			}
		}
		
		//Fin Macheo lugar inhumacion o cremacion
		
		//insertar el sepelio - CONTROLO QUE EXISTA EL SEPELIO 
		
		
		$actualizar="UPDATE sepelio SET
			FechaFallecimiento='$fechafallecimiento',
			FechaSepelio='$fechasepelio',
			Hora='$hora',
			Localidad=$interno,
			Lugar='$lugar',
			Nombre='$nombre',
			Salon=$interno_sala,
			Dia='$fechamisa',
			HoraMisa='$horamisa',
			LugarMisa='$interno_iglesia',
			OtroLugar='$otrolugarmisa',
			LugarInhumacion=$interno_inhumacion,
			FechaNacimiento='$fechanacimiento',
			opcion=$opcion,
			LugarCremacion=$interno_cremacion,
			Oracion=$interno_oracion,
			OtroSalon='$otrasala',
			DomicilioOtroSalon='$domiciliootrasala',
			IdCocheria=$idcocheria,
			DireccionSala='$domiciliosala' 
			
			WHERE IdCocheria=$idcocheria";
		$insert= mysql_query($actualizar);
		
		//Fin insercion sepelio
		
		//Respuesta
		$contar = $wssepelio['id']; 
		return $contar;
		//Respuesta
		
	//FIN UPDATE
	}
}
//Fin Funcion Crar Sepelio


//Funcion Actualizar Sepelio
function ActualizarSepelio($nombre,$fechafallecimiento,$fechasepelio,$hora,$localidad,$nombrelocalidad,$lugar,$sala,$nombresala,$fechamisa,$horamisa,$iglesiaid,$nombreiglesia,$otrolugarmisa,$lugarinhumacion,$nombrelugarinhumacion,$fechanacimiento,$opcion,$lugarcremacion,$nombrelugarcremacion,$otrasala,$domiciliootrasala,$oracion,$nombreoracion,$contenidooracion,$idcocheria,$domiciliosala)
{
	include('conexion.php');
	$nombre = NormalizarNombre($nombre);
	//localidad
	$sql = "SELECT * FROM sepelio where IdCocheria = $idcocheria"; 
	$wssepelio = mysql_query($sql);
	$wssepelio = mysql_fetch_array($wssepelio);
if ($wssepelio['IdCocheria'] == $idcocheria){
	
	
	$sql = "SELECT * FROM wsLocalidad where IdCocheria = $localidad"; 
	$wslocalidad = mysql_query($sql);
	$wslocalidad = mysql_fetch_array($wslocalidad);
	
	if ($wslocalidad['IdInterno'] == ""){
		//Crear localidad nueva e insertar también en tabla ws localidad
		$sql = "INSERT INTO localidad(Nombre,date_time) VALUES ('$nombrelocalidad',NOW())";
		mysql_query($sql);
		
		$sql = "SELECT id from localidad where Nombre = '$nombrelocalidad'";
		$interno = mysql_query($sql);
		$interno = mysql_fetch_array($interno);
		$interno = $interno['id'];
		
		$sql = "INSERT INTO wsLocalidad(Descripcion, IdCocheria, IdInterno,date_time) VALUES ('$nombrelocalidad',$localidad,$interno,NOW())";
		mysql_query($sql);
		}
	else{
		$interno= $wslocalidad['IdInterno'];
		if ($wslocalidad['Descripcion']!= $nombrelocalidad)
		{
			//actualizar descripcion de wslocalidad y Localidad
			$sql = "UPDATE `localidad` SET Nombre='$nombrelocalidad',date_time=NOW() WHERE id = $interno"; 
			mysql_query($sql);
		
			$sql= "UPDATE `wsLocalidad` SET `Descripcion`='$nombrelocalidad',date_time=NOW() WHERE IdInterno=$interno";
			mysql_query($sql);
		}
	}
	//fin macheo localidad
	
	//sala
		//controlo que no venga con sala particular
	if ($otrasala==""){
		//Sala de cochería
		
		$sql = "SELECT * FROM wsSalas where IdCocheria = $sala"; 
		$wssala = mysql_query($sql);
		$wssala = mysql_fetch_array($wssala);
		
		if ($wssala['IdInterno'] == ""){
			//Crear sala nueva e insertar también en tabla wssala
			$sql = "INSERT INTO salas(Sala,date_time,Localidad,Direccion) VALUES ('$nombresala',NOW(),$interno,'$domiciliosala')";
			mysql_query($sql);
			
			$sql = "SELECT id from salas where Sala = '$nombresala'";
			$interno_sala = mysql_query($sql);
			$interno_sala = mysql_fetch_array($interno_sala);
			$interno_sala = $interno_sala['id'];
			
			$sql = "INSERT INTO wsSalas(Descripcion, IdCocheria, IdInterno,date_time,Direccion) VALUES ('$nombresala',$sala,$interno_sala,NOW(),'$domiciliosala')";
			
			mysql_query($sql);
			}
		else{
			$interno_sala= $wssala['IdInterno'];
			if ($wssala['Descripcion']!= $nombresala)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `salas` SET Sala='$nombresala',date_time=NOW() WHERE id = $interno_sala"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsSalas` SET `Descripcion`='$nombresala',date_time=NOW() WHERE IdInterno=$interno_sala";
				mysql_query($sql);
			}
			
			//chequeo si hay cambio de domicilio
			if ($wssala['Direccion']!= $domiciliosala)
			{
				//actualizar descripcion de wssalas y salas
				$sql = "UPDATE `salas` SET Direccion='$domiciliosala',date_time=NOW() WHERE id = $interno_sala"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsSalas` SET `Direccion`='$domiciliosala',date_time=NOW() WHERE IdInterno=$interno_sala";
				mysql_query($sql);
			}
		}
	}
	else
	{
		//Sala particular
		$interno_sala =20;
	}
	// macheo sala
	
	//iglesia
	$sql = "SELECT * FROM wsIglesias where IdCocheria = $iglesiaid"; 
	$wsiglesia = mysql_query($sql);
	$wsiglesia = mysql_fetch_array($wsiglesia);
	
	if ($wsiglesia['IdInterno'] == ""){
		//Crear sala nueva e insertar también en tabla wssala
		$sql = "INSERT INTO iglesias(Nombre,date_time,Localidad) VALUES ('$nombreiglesia',NOW(),$interno)";
		mysql_query($sql);
		
		$sql = "SELECT id from iglesias where Nombre = '$nombreiglesia'";
		$interno_iglesia = mysql_query($sql);
		$interno_iglesia = mysql_fetch_array($interno_iglesia);
		$interno_iglesia = $interno_iglesia['id'];
		
		$sql = "INSERT INTO wsIglesias(Descripcion, IdCocheria, IdInterno,date_time) VALUES ('$nombreiglesia',$iglesiaid,$interno_iglesia,NOW())";
		mysql_query($sql);
		}
	else{
		$interno_iglesia= $wsiglesia['IdInterno'];
		if ($wsiglesia['Descripcion']!= $nombreiglesia)
		{
			//actualizar descripcion de wssalas y salas
			$sql = "UPDATE `iglesias` SET Nombre='$nombreiglesia',date_time=NOW() WHERE id = $interno_iglesia"; 
			mysql_query($sql);
		
			$sql= "UPDATE `wsIglesias` SET `Descripcion`='$nombreiglesia',date_time=NOW() WHERE IdInterno=$interno_iglesia";
			mysql_query($sql);
		}
	}
	// macheo iglesia
	
	//oracion
	$sql = "SELECT * FROM wsOraciones where IdCocheria = $oracion"; 
	$wsoracion = mysql_query($sql);
	$wsoracion = mysql_fetch_array($wsoracion);
	
	if ($wsoracion['IdInterno'] == ""){
		//if si existe en mi tabla interna
		
		//else
		//Crear sala nueva e insertar también en tabla wssala
		$sql = "INSERT INTO oracion(Titulo,date_time,Texto) VALUES ('$nombreoracion',NOW(),'$contenidooracion')";
		mysql_query($sql);
		
		$sql = "SELECT id from oracion where Titulo = '$nombreoracion'";
		$interno_oracion = mysql_query($sql);
		$interno_oracion = mysql_fetch_array($interno_oracion);
		$interno_oracion = $interno_oracion['id'];
		
		$sql = "INSERT INTO wsOraciones(Titulo, IdCocheria, IdInterno,date_time,Texto) VALUES ('$nombreoracion',$oracion,$interno_oracion,NOW(),'$contenidooracion')";
		mysql_query($sql);
		}
	else{
		$interno_oracion= $wsoracion['IdInterno'];
		if ($wsoracion['Titulo']!= $nombreoracion)
		{
			//actualizar descripcion de wssalas y salas
			$sql = "UPDATE `oracion` SET Titulo='$nombreoracion',date_time=NOW() WHERE id = $interno_oracion"; 
			mysql_query($sql);
		
			$sql= "UPDATE `wsOraciones` SET `Titulo`='$nombreoracion',date_time=NOW() WHERE IdInterno=$interno_oracion";
			mysql_query($sql);
		}
		
		if ($wsoracion['Texto']!= $contenidooracion)
		{
			//actualizar descripcion de wssalas y salas
			$sql = "UPDATE `oracion` SET Texto='$contenidooracion',date_time=NOW() WHERE id = $interno_oracion"; 
			mysql_query($sql);
		
			$sql= "UPDATE `wsOraciones` SET `Texto`='$contenidooracion',date_time=NOW() WHERE IdInterno=$interno_oracion";
			mysql_query($sql);
		}
	}
	// macheo oracion
		
	//Macheo lugar inhumacion o cremacion
	if ($opcion == 1)
	{
		// inhumacion
		$interno_cremacion=0;	//esto seteo porque no me deja hacer insert con la variable vacía	
		$sql = "SELECT * FROM wsCementerios where IdCocheria = $lugarinhumacion"; 
		$wsinhumacion = mysql_query($sql);
		$wsinhumacion = mysql_fetch_array($wsinhumacion);
	
		if ($wsinhumacion['IdInterno'] == ""){
			//Creo el cementerio y wscementerio
			$sql = "INSERT INTO lugarinhumacion(Lugar,date_time,Localidad) VALUES ('$nombrelugarinhumacion',NOW(),$interno)";
			mysql_query($sql);
			
			$sql = "SELECT id from lugarinhumacion where Lugar = '$nombrelugarinhumacion'";
			$interno_inhumacion = mysql_query($sql);
			$interno_inhumacion = mysql_fetch_array($interno_inhumacion);
			$interno_inhumacion = $interno_inhumacion['id'];
			
			$sql = "INSERT INTO wsCementerios(Descripcion, IdCocheria, IdInterno,date_time,Opcion) VALUES 				('$nombrelugarinhumacion',$lugarinhumacion,$interno_inhumacion,NOW(),$opcion)";
			mysql_query($sql);
			}
		else{
			$interno_inhumacion= $wsinhumacion['IdInterno'];
			if ($wsinhumacion['Descripcion']!= $nombrelugarinhumacion)
			{
				//actualizar descripcion de wssCementerios y lugarinhumacion
				$sql = "UPDATE `lugarinhumacion` SET Lugar='$nombrelugarinhumacion',date_time=NOW() WHERE id = $interno_inhumacion"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsCementerios` SET `Descripcion`='$nombrelugarinhumacion',date_time=NOW(),Opcion=$opcion WHERE 	IdInterno=$interno_inhumacion";
				mysql_query($sql);
			}		
		}
	}
	
	else
	{
		// cremacion
		$interno_inhumacion=0; //esto seteo porque no me deja hacer insert con la variable vacía
		$sql = "SELECT * FROM wsCementerios where IdCocheria = $lugarcremacion"; 
		$wscremacion = mysql_query($sql);
		$wscremacion = mysql_fetch_array($wscremacion);
	
		if ($wscremacion['IdInterno'] == ""){
			//Creo el crematorio y wscementerio
			$sql = "INSERT INTO lugarcremacion(Lugar,date_time,Localidad) VALUES ('$nombrelugarcremacion',NOW(),$interno)";
			mysql_query($sql);
			
			$sql = "SELECT id from lugarcremacion where Lugar = '$nombrelugarcremacion'";
			$interno_cremacion = mysql_query($sql);
			$interno_cremacion = mysql_fetch_array($interno_cremacion);
			$interno_cremacion = $interno_cremacion['id'];
			
			$sql = "INSERT INTO wsCementerios(Descripcion, IdCocheria, IdInterno,date_time,Opcion) VALUES 				('$nombrelugarcremacion',$lugarcremacion,$interno_cremacion,NOW(),$opcion)";
			mysql_query($sql);
			}
		else{
			$interno_cremacion= $wscremacion['IdInterno'];
			if ($wscremacion['Descripcion']!= $nombrelugarcremacion)
			{
				//actualizar descripcion de wssCementerios y lugarinhumacion
				$sql = "UPDATE `lugarcremacion` SET Lugar='$nombrelugarcremacion',date_time=NOW() WHERE id = $interno_cremacion"; 
				mysql_query($sql);
			
				$sql= "UPDATE `wsCementerios` SET `Descripcion`='$nombrelugarcremacion',date_time=NOW(),Opcion=$opcion WHERE 	IdInterno=$interno_cremacion";
				mysql_query($sql);
			}		
		}
	}
	
	//Fin Macheo lugar inhumacion o cremacion
	
	//insertar el sepelio - CONTROLO QUE EXISTA EL SEPELIO 
	
	
	$actualizar="UPDATE sepelio SET
		FechaFallecimiento='$fechafallecimiento',
		FechaSepelio='$fechasepelio',
		Hora='$hora',
		Localidad=$interno,
		Lugar='$lugar',
		Nombre='$nombre',
		Salon=$interno_sala,
		Dia='$fechamisa',
		HoraMisa='$horamisa',
		LugarMisa='$interno_iglesia',
		OtroLugar='$otrolugarmisa',
		LugarInhumacion=$interno_inhumacion,
		FechaNacimiento='$fechanacimiento',
		opcion=$opcion,
		LugarCremacion=$interno_cremacion,
		Oracion=$interno_oracion,
		OtroSalon='$otrasala',
		DomicilioOtroSalon='$domiciliootrasala',
		IdCocheria=$idcocheria,
		DireccionSala='$domiciliosala' 
		
		WHERE IdCocheria=$idcocheria";
	$insert= mysql_query($actualizar);
	
	//Fin insercion sepelio
	
	//Respuesta
	$contar = $wssepelio['id']; 
	return $contar;
	//Respuesta
	}
	//aca termina el control de sepelio si no existe devuelvo 0 abajo.
	else
	return 0;
}
//Fin funcion actualizar Sepelio


// Se crea el objeto para el webservice
$servicio = new soap_server();
// Se inicializa el webservice
$servicio->configureWSDL("webserv", "urn:webserv");
// Se registra la funcion que se va a exportar, con el tipo de datos de entrada y el tipo de dato de salida


$servicio->register("ConsultaSepelios",array(),array("return" => "xsd:string"));

$servicio->register("CrearSepelio",array("Nombre" =>"xsd:string"
						,"FechaFallecimiento" => "xsd:date"
						,"FechaSepelio" =>"xsd:date"
						,"HoraInhumacion" =>"xsd:string"
						,"Localidad" =>"xsd:string"
						,"NombreLocalidad" => "xsd:string"
						,"OtroCementerioCrematorio" =>"xsd:string"
						,"Sala" =>"xsd:int"
						,"NombreSala" => "xsd:string"
						,"FechaMisa" =>"xsd:date"
						,"HoraMisa" =>"xsd:string"
						,"IglesiaId" =>"xsd:int"
						,"NombreIglesia" => "xsd:string"
						,"OtroLugarMisa" =>"xsd:string"
						,"LugarInhumacion" =>"xsd:int"
						,"NombreLugarInhumacion" => "xsd:string" 
						,"FechaNacimiento" =>"xsd:date"
						,"OpcionInhumacionCremacion" =>"xsd:int"
						,"LugarCremacion" =>"xsd:int"
						,"NombreLugarCremacion" => "xsd:string"
						,"NombreOtraSala" =>"xsd:string"
						,"DomicilioOtraSala" =>"xsd:string"
						,"IdOracion"  =>"xsd:int"
						,"NombreOracion" => "xsd:string"
						,"ContenidoOracion" => "xsd:string"
						,"IdCocheria" => "xsd:int"
						,"DomicilioSala" => "xsd:string"
					
						),array("return" => "xsd:string"));
						
// Registro de función para hacer UPDATE del sepelio
$servicio->register("ActualizarSepelio",array("Nombre" =>"xsd:string"
						,"FechaFallecimiento" => "xsd:date"
						,"FechaSepelio" =>"xsd:date"
						,"HoraInhumacion" =>"xsd:string"
						,"Localidad" =>"xsd:int"
						,"NombreLocalidad" => "xsd:string"
						,"OtroCementerioCrematorio" =>"xsd:string"
						,"Sala" =>"xsd:int"
						,"NombreSala" => "xsd:string"
						,"FechaMisa" =>"xsd:date"
						,"HoraMisa" =>"xsd:string"
						,"IglesiaId" =>"xsd:int"
						,"NombreIglesia" => "xsd:string"
						,"OtroLugarMisa" =>"xsd:string"
						,"LugarInhumacion" =>"xsd:int"
						,"NombreLugarInhumacion" => "xsd:string" 
						,"FechaNacimiento" =>"xsd:date"
						,"OpcionInhumacionCremacion" =>"xsd:int"
						,"LugarCremacion" =>"xsd:int"
						,"NombreLugarCremacion" => "xsd:string"
						,"NombreOtraSala" =>"xsd:string"
						,"DomicilioOtraSala" =>"xsd:string"
						,"IdOracion"  =>"xsd:int"
						,"NombreOracion" => "xsd:string"
						,"ContenidoOracion" => "xsd:string"
						,"IdCocheria" => "xsd:int"
						,"DomicilioSala" => "xsd:string"
					
						),array("return" => "xsd:string"));




// Como el servicio es proveedo por un servidor WEB la informacion del webservice sera recibida en METHOD POST
$servicio->service($HTTP_RAW_POST_DATA);
?>
