
<?php

 
$id = $_GET['id_venta'];
$ticket = $_GET['ticket'];
$impresora1 = $_GET['impresora1'];
$impresora2 = $_GET['impresora2'];
$servidor1 = $_GET['servidor1'];
$servidor2 = $_GET['servidor2'];
$nombre=$id."_ticket.pdf";
 
 if(isset($_GET['id_venta'])){
	 // a route is created, (it must already be created in its repository(pdf)).
	$ruta    = "ticket/".$nombre;

	//remplazar ' ' por +
	$ticket=str_replace(" ", "+", $ticket);
	// decode base64
	$pdf_b64 = base64_decode($ticket);

	// you record the file in existing folder
	if(file_put_contents($ruta, $pdf_b64)){
	    //just to force download by the browser
	   echo "Guardado correctamente<br>";  
	   echo $ruta."<br>";
	   echo "PDF: ".$ticket;
	  
		if(isset($_GET['servidor1'])){
		 //exec('lpr -S '.$servidor1.' -P '.$impresora1.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe "'.$ruta.'" "'.$impresora1.'"  ');
		}

		if(isset($_GET['servidor2'])){
			//exec('lpr -S '.$servidor2.' -P '.$impresora2.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe "'.$ruta.'" "'.$impresora2.'"  ');
		}

	}else{
		echo "Error, al guardar el Ticker";
	}
 }


?>