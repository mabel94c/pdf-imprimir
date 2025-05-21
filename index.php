
<?php
header('Access-Control-Allow-Origin: *');
 
$id = $_GET['id_venta'];
$ticket = $_POST['ticket'];
$ticket_cocina = $_POST['ticket_cocina'];
$factura_rollo = $_POST['factura_rollo'];
$nota_venta_rollo = $_POST['nota_venta_rollo'];

$impresora1 = $_GET['impresora1'];
$impresora2 = $_GET['impresora2'];
$impresora_nota_venta = $_GET['impresora_nota_venta'];
$impresora_factura = $_GET['impresora_factura'];
$servidor1 = $_GET['servidor1'];
$servidor2 = $_GET['servidor2'];

$nombre=$id."_ticket.pdf";
$nombre_cocina=$id."_ticket_cocina.pdf";
$nombre_nota_venta_rollo=$id."_nota_venta_rollo.pdf";
$nombre_factura_rollo=$id."_factura_rollo.pdf";
 
 if(isset($_GET['id_venta'])){
	 // a route is created, (it must already be created in its repository(pdf)).
	$ruta    = "ticket/".$nombre;
	$ruta_cocina    = "ticket/".$nombre_cocina;
	$ruta_factura_rollo    = "ticket/".$nombre_factura_rollo;
	$ruta_nota_venta_rollo    = "ticket/".$nombre_nota_venta_rollo;

	//remplazar ' ' por +
	$ticket=str_replace(" ", "+", $ticket);
	$ticket_cocina=str_replace(" ", "+", $ticket_cocina);
	$factura_rollo=str_replace(" ", "+", $factura_rollo);
	$nota_venta_rollo=str_replace(" ", "+", $nota_venta_rollo);

	// decode base64
	$pdf_b64 = base64_decode($ticket);
	$pdf_b64_cocina = base64_decode($ticket_cocina);
	$pdf_b64_factura = base64_decode($factura_rollo);
	$pdf_b64_nota_venta = base64_decode($nota_venta_rollo);
	

	// you record the file in existing folder
	if(file_put_contents($ruta, $pdf_b64)){
	    //just to force download by the browser
	   echo "Guardado correctamente<br>";  
	   echo $ruta."<br>";
	   //echo "PDF: ".$ticket;
	  
		if($_GET['impresora1']!=""){
		 //exec('lpr -S '.$servidor1.' -P '.$impresora1.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe '.$ruta.' "'.$impresora1.'"  ');
		 //exec('SumatraPDF.exe -print-to '.'"'.$impresora1.'" '.$ruta);
		}

	}else{
		echo "Error, al guardar el Ticker";
	}
	// you record the file in existing folder
	if(file_put_contents($ruta_cocina, $pdf_b64_cocina)){
	    //just to force download by the browser
	   echo "Guardado correctamente Cocina<br>";  
	   echo $ruta_cocina."<br>";
	   //echo "PDF: ".$ticket_cocina;
	   

		if($_GET['impresora2']!=""){
			//exec('lpr -S '.$servidor2.' -P '.$impresora2.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe '.$ruta_cocina.' "'.$impresora2.'"  ');
		}

	}else{
		echo "Error, al guardar el Ticker Cocina";
	}
	//Imprimir Nota de Venta Automatico
	if(file_put_contents($ruta_nota_venta_rollo, $pdf_b64_nota_venta)){
	    //just to force download by the browser
	   echo "Guardado correctamente Nota Venta<br>";  
	   echo $ruta_nota_venta_rollo."<br>";
	   //echo "PDF: ".$nota_venta_rollo;
	   

		if($_GET['impresora_nota_venta']!=""){
			//exec('lpr -S '.$servidor2.' -P '.$impresora2.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe '.$ruta_nota_venta_rollo.' "'.$impresora_nota_venta.'"  ');
		}

	}else{
		echo "Error, al guardar la Factura Rollo";
	}

	//Imprimir Factura Automatico
	if(file_put_contents($ruta_factura_rollo, $pdf_b64_factura)){
	    //just to force download by the browser
	   echo "Guardado correctamente Factura<br>";  
	   echo $ruta_factura_rollo."<br>";
	   //echo "PDF: ".$factura_rollo;
	   

		if($_GET['impresora_factura']!=""){
			//exec('lpr -S '.$servidor2.' -P '.$impresora2.' "'.$ruta.'" ');
		 exec('PDFtoPrinter.exe '.$ruta_factura_rollo.' "'.$impresora_factura.'"  ');
		}

	}else{
		echo "Error, al guardar la Factura Rollo";
	}
 }


?>