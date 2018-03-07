<?php
include 'config.php';
// memanggil library FPDF
require('phpfpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);

$sql = "SELECT * FROM tblm_prov WHERE kd_prov = '".$_GET['prov']."'";
				$result = $con->query($sql);
				$nm_prov= "";					
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					$nm_prov= $row['nm_prov'];
					}						
				} 

$sql = "SELECT * FROM tblm_kab WHERE kd_kab = '".$_GET['kabu']."'";
$result = $con->query($sql);
$nm_kabu= "";					
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$nm_kabu= $row['nm_kab'];
	}						
} 				

$sql = "SELECT * FROM tblm_bulan WHERE kd_bulan = '".$_GET['bulan']."'";
				$result = $con->query($sql);
				$nm_bulan= "";					
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					$nm_bulan= $row['nm_bulan'];
					}						
				}

// mencetak string 
$pdf->Cell(190,7,'Laporan Rencana Panen Kabupaten Bulanan',0,1,'C');
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',12);

$pdf->Cell(20,7,'Provinsi',0,0);
$pdf->Cell(20,7,': '.$nm_prov,0,1);

$pdf->Cell(20,7,'Kabupaten',0,0);
$pdf->Cell(20,7,': '.$nm_kabu,0,1);

$pdf->Cell(20,7,'Komoditi',0,0);
$pdf->Cell(20,7,': '.$_GET['komoditi'],0,1);

$pdf->Cell(20,7,'Bulan',0,0);
$pdf->Cell(20,7,': '.$nm_bulan,0,1);

$pdf->Cell(20,7,'Tahun',0,0);
$pdf->Cell(20,7,': '.$_GET['tahun'],0,1);
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No.',1,0);
$pdf->Cell(85,6,'Nama Kecamatan',1,0,'C');
$pdf->Cell(40,6,'Luas Panen (Ha)',1,0,'C');
$pdf->Cell(40,6,'Produktivitas (Ku/Ha)',1,1,'C');
 
$pdf->SetFont('Arial','',10);
 				
 $query = mysqli_query($con,"SELECT nm_kec, 
						SUM(luas) AS SUMPanen,
						AVG(provitas) AS AVGPanen
						FROM  tbld_rpanen 
						WHERE kd_kab =  '".$_GET['kabu']."'
						AND DATE_FORMAT( waktu,  '%Y' ) =  '".$_GET['tahun']."'
						AND DATE_FORMAT( waktu,  '%m' ) =  '".$_GET['bulan']."'
						GROUP BY nm_kec ORDER BY nm_kec");

$no = 1;
	$nobar  = 0;
	$isiavg = 0;
	$totsum = 0;
	$totavg = 0;
while ($row = mysqli_fetch_array($query)){
	$nobar = $nobar + 1;
	$totsum = $totsum + $row['SUMPanen'];  
	$totavg = $totavg + $row['AVGPanen'];
	if ($row['AVGPanen']>0) {
		$isiavg = $isiavg + 1;
	}	
    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(85,6,$row['nm_kec'],1,0);
    $pdf->Cell(40,6,$row['SUMPanen'],1,0,'R');
    $pdf->Cell(40,6,number_format($row['AVGPanen'],1),1,1,'R');
}
	$nasavg = 0;
	if ($isiavg > 0) {							
		$nasavg = $totavg/$isiavg;
	} 
	$pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,6,' ',1,0);
    $pdf->Cell(85,6,'Kabupaten',1,0);
    $pdf->Cell(40,6,$totsum,1,0,'R');
    $pdf->Cell(40,6,number_format($nasavg,1),1,1,'R');	
$pdf->Output();
?>