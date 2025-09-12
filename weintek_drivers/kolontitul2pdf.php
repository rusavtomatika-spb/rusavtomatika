<?php
require_once( 'tcpdf/tcpdf.php' );
require_once( 'tcpdf/tcpdi.php' );
require_once( 'fpdf/fpdi.php' );
// Original file with multiple pages 
$fullPathToFile = $_SERVER[ 'DOCUMENT_ROOT' ] . 'weintek_drivers__/ABB_AC500.pdf';
$fullPath = $_SERVER[ 'DOCUMENT_ROOT' ] . 'weintek_drivers__/';

class MYPDF extends FPDI {
  //шапка
  public function Header() {}
  //подвал
  public function Footer() {
    global $fullPathToFile;
    if ( is_null( $this->_tplIdx ) ) {
      // берём кол-во страниц в исходнике
      $this->numPages = $this->setSourceFile( $fullPathToFile );
      $this->_tplIdx = $this->importPage( 1 );
    }
    $this->useTemplate( $this->_tplIdx );
    // 15 mm от низа стр
    $this->SetY( -10 );
    $this->SetFont( "dejavusans", "N", 9 );
    $this->ralink = $this->Write( 10, 'Документ предоставлен компанией "Русавтоматика". WWW.RUSAVTOMATIKA.COM', 'https://www.rusavtomatika.com/', false, 'C', true );
    $this->Cell( 0, 15, $ralink, 0, false, 'C', 0, '', 0, false, 'T', 'M' );
    $style3 = array( 'width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array( 0, 173, 97 ) );
    $this->Line( 0, 285, 210, 285, $style3 );
  }
}


$pdf = new MYPDF();
$pdf->setFontSubsetting( true );
$pdf->numPages = $pdf->setSourceFile( $fullPathToFile );
if ( $pdf->numPages > 1 ) {
  for ( $i = 1; $i <= $pdf->numPages; $i++ ) {
    $pdf->endPage();
    $pdf->_tplIdx = $pdf->importPage( $i );
    $pdf->AddPage();
  }
}
$fullPathResult = $fullPath.'pdfdump.pdf';

// выводим. I - в браузерю. D - в файл
$pdf->Output( $pdfdump, 'S' );
  file_put_contents( $fullPathResult, $pdfdump );
?>