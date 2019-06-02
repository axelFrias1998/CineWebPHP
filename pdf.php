<?php
    
    require "fpdf/fpdf.php";
    function creaPDF($usuario, $correo, $total, $boletos){
        ob_start();
        $pdf = new FPDF();

        $pdf -> AddPage();
        $pdf -> Image('img/Cinezone.png', 10, 8, 33);
        $pdf->SetFont('Arial','B',24);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Boleto Cinezona',0, 1,'C');
        $pdf->Ln(20);
        $pdf -> SetFont('Arial', '', '13');
        $pdf -> Cell(50, 10, "Correo del comprador: ".utf8_decode($correo), 0, 1, 'L');
        $pdf -> Cell(50, 10, "Nombre: ".utf8_decode($usuario), 0, 1, 'L');
        
        $pdf -> Cell(50, 10, "Cantidad de boletos: ".$boletos, 0, 1, 'L');
        $pdf -> Cell(50, 10, "Costo total: $".$total, 0, 1, 'L');
        $pdf -> Cell(50, 10, utf8_decode("Lleva el siguiente código QR el día de la función"), 0, 1, 'L');
        $pdf -> Image('img/qr.jpg', 10, null, 33);
        // Arial italic 8
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(0,10,'NO REVENDAS TUS ENTRADAS.',0,0,'C');
        $pdf -> Output();
        ob_end_flush();
    }
    
?>