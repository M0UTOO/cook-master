
<?php
use Fpdf\Fpdf;
// ob_start();

// $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// $pdf->SetCreator('Your Name');
// $pdf->SetAuthor('Your Name');
// $pdf->SetTitle('Sample PDF');
// $pdf->SetSubject('Sample PDF using TCPDF');
// $pdf->SetKeywords('TCPDF, PDF, example, guide');

// $pdf->AddPage();

// $pdf->SetFont('helvetica', 'B', 16);
// $pdf->Cell(0, 10, 'Cook Master Certificate', 0, 1, 'C');

// $pdf->SetFont('helvetica', '', 16);
// $html = '<div style="text-align:center">';
// $html .= '<br><br><br><br><br><br><br><br>';
// $html .= '<p>This certificate is awarded to : ' . $client['firstname'] . ' ' . $client['lastname'] . '</p>';
// $html .= '<p>For the completion of the formation : ' . $formation['name'] . '</p>';
// $html .= '<p>Thank you from all the Cook Master team !</p>';
// $html .= '</div>';
// $pdf->writeHTML($html, true, false, true, false, '');

// $imagePath = base_url("assets/images/dog.png");
// $pdf->Image($imagePath, 50, 50, 100, 100);


// $pdf->Output('sample.pdf', 'D');

ob_start();

$pdf = new Fpdf();
$pdf->AddPage('L', 'A4');

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 20, 'Cook Master Certificate', 0, 1, 'C');

$imagePath = "./assets/images/certificate.png";
$pdf->Image($imagePath, 0, 0, 297, 210);

$pdf->SetFont('Arial', '', 16);
$logoPath = "./assets/images/logo-medium.png";
$pdf->Image($logoPath, 132, 35, 30, 30);
$pdf->Cell(0, 50, '', 0, 1, 'C');
$pdf->Cell(0, 20, 'This certificate is awarded to: ' . $client['firstname'] . ' ' . $client['lastname'], 0, 1, 'C');
$pdf->Cell(0, 20, 'For the completion of the formation: ' . $formation['name'], 0, 1, 'C');
$pdf->Cell(0, 20, 'Thank you from all the Cook Master team!', 0, 1, 'C');

$pdf->Output('cerficate.pdf', 'D');

ob_end_flush();

?>
