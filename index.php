
<?php
header('Access-Control-Allow-Origin: *');
 
$id = $_GET['id_venta'];
$ticket = $_POST['ticket'];
$ticket_cocina = $_POST['ticket_cocina'];
$impresora1 = $_GET['impresora1'];
$impresora2 = $_GET['impresora2'];
$servidor1 = $_GET['servidor1'];
$servidor2 = $_GET['servidor2'];
$nombre=$id."_ticket.pdf";
$nombre_cocina=$id."_ticket_cocina.pdf";
 
 if(isset($_GET['id_venta'])){
	 // a route is created, (it must already be created in its repository(pdf)).
	$ruta    = "ticket/".$nombre;
	$ruta_cocina    = "ticket/".$nombre_cocina;

	//remplazar ' ' por +
	$ticket=str_replace(" ", "+", $ticket);
	$ticket_cocina=str_replace(" ", "+", $ticket_cocina);
	// decode base64
	$pdf_b64 = base64_decode($ticket);
	$pdf_b64_cocina = base64_decode($ticket_cocina);

	// you record the file in existing folder
	if(file_put_contents($ruta, $pdf_b64)){
	    //just to force download by the browser
	   echo "Guardado correctamente<br>";  
	   echo $ruta."<br>";
	   echo "PDF: ".$ticket;
	  
		if($_GET['impresora1']!=""){
		 //exec('lpr -S '.$servidor1.' -P '.$impresora1.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe '.$ruta.' "'.$impresora1.'"  ');
		}

	}else{
		echo "Error, al guardar el Ticker";
	}
	// you record the file in existing folder
	if(file_put_contents($ruta_cocina, $pdf_b64_cocina)){
	    //just to force download by the browser
	   echo "Guardado correctamente Cocina<br>";  
	   echo $ruta."<br>";
	   echo "PDF: ".$ticket_cocina;
	   

		if($_GET['impresora2']!=""){
			//exec('lpr -S '.$servidor2.' -P '.$impresora2.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe '.$ruta_cocina.' "'.$impresora2.'"  ');
		}

	}else{
		echo "Error, al guardar el Ticker Cocina";
	}
 }


?>