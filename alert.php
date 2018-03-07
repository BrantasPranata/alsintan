<?php
function writeMsg($tipe){
	if ($tipe=='save.sukses') {
		$MsgClass = "alert-success";
		$Msg = "<strong>Sukses!</strong> Data berhasil disimpan.";	
	} else 
	if ($tipe == 'save.gagal') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Oops!</strong> Data gagal disimpan!";
	}
	else 
	if ($tipe == 'save.gagalkomod') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Komoditi</strong> belum diisi!";
	}
	else 
	if ($tipe == 'save.gagalmerk') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Merek</strong> belum diisi!";
	}
	else 
	if ($tipe == 'save.gagalpoktan') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Nama Lembaga</strong> belum diisi!";
	}
	else 
	if ($tipe == 'save.gagaljenals') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Jenis Alsintan</strong> belum dipilih!";
	}
	else 
	if ($tipe == 'save.gagaljenlem') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Jenis Lembaga</strong> belum dipilih!";
	}
	else 
	if ($tipe == 'save.gagaltahun') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Tahun Pengadaan</strong> belum dipilih!";
	}
	else 
	if ($tipe == 'save.gagalsumber') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Sumber Dana</strong> belum dipilih!";
	}
	else 
	if ($tipe == 'save.gagalkondisi') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Kondisi</strong> belum dipilih!";
	}
	else 
	if ($tipe == 'save.gagaljumlah') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Jumlah Unit</strong> belum diisi!";
	}
	else 
	if ($tipe == 'save.gagalstatus') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Status</strong> belum diisi!";
	}
	else 
	if ($tipe == 'save.gagalpola') {
		$MsgClass = "alert-warning";
		$Msg = "Kolom <strong>Pola Pengelolaan</strong> belum diisi!";
	}
	else 
	if ($tipe == 'update.sukses') {
		$MsgClass = "alert-success";
		$Msg = "<strong>Sukses!</strong> Data berhasil diupdate.";
	}
	else 
	if ($tipe == 'update.gagal') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Oops!</strong> Data gagal diupdate!";
	}

echo "<div class=\"alert alert-dismissible ".$MsgClass."\">
  	  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  	  ".$Msg."
	  </div>";		  
}
?>