<?php
session_start();
include_once './func/config.php';

class Pclass
{
	//Database connect
    public function __construct()
    {
    $db = new DB_Class();
    }
	
	function select_all($userid,$kom,$tabel,$lahan,$ket,$prop,$kab)
	{
		$role = $_SESSION['login'];
		$subinputkab = substr($userid,0,4);
		$subinputprop = substr($userid,0,2);
		
		$subprop = substr($prop,0,2);
		$subkab = substr($kab,0,4);
		
		//echo $userid.'<br>'.$kom.'<br>'.$tabel.'<br>'.$lahan.'<br>'.$ket.'<br>'.$prop.'<br>'.$kab;
		//exit;
		$where = "";
		
		if($prop == "")
		{
			if($kab == "")
			{
				if($role == '2')
				{
					$where .= "and right(Kode_wil,3) = '000' and Kode_wil LIKE '$subinputprop%' and right(kode_wil,5) <> '00000'";
					//echo 'a';
				}else
				{
					$where = "";
				}
			}else
			{
				$where .= "and right(Kode_wil,3) <> '000' and Kode_wil LIKE '$subkab%'";
				//echo 'b';
			}
		}
		else
		{
			if($kab == "")
			{
				$where .= "and right(Kode_wil,3) = '000' and left(kode_wil,2) = '$subprop' and right(kode_wil,5) <> '00000'";
				//echo 'c';
			}else
			{
				$where .= "and right(Kode_wil,3) <> '000' and kode_wil like '$subkab%'";
				//echo 'd';
			}
		}
		
		//echo $where;
		//exit;

		if($role == '1')
		{
			
				if($tabel == '1')
				{
					if($prop == "" && $kab == "")
					{	
						if($kom == '22'){
							if($lahan == '3'){
								$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '3' and keterangan = '1'  
										and right(kode_wil,5) = '00000') or (Tanaman = '6' and keterangan = '1' 
										and right(kode_wil,5) = '00000') GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										//echo $query;
							}else{
							$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '3' and keterangan = '1'  
										and right(kode_wil,5) = '00000') or (Tanaman = '6' and keterangan = '1' 
										and right(kode_wil,5) = '00000') and Lahan = '$lahan' GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										//echo $query;
									}								
						}elseif($kom == '23'){
						
							if($lahan == '3'){
								$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '4' and keterangan = '1'  
										and right(kode_wil,5) = '00000') or (Tanaman = '7' and keterangan = '1' 
										and right(kode_wil,5) = '00000') GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										//echo $query;
							}else{
							$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '4' and keterangan = '1'  
										and right(kode_wil,5) = '00000') or (Tanaman = '7' and keterangan = '1' 
										and right(kode_wil,5) = '00000') and Lahan = '$lahan' GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										//echo $query;
									}
						}
						else{
							if($lahan == '3'){
							/*
							$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,sum(L_panen12) as data12
										FROM Isi_data 
										WHERE Tanaman = '$kom' and keterangan = '$ket' and right(kode_wil,5) = '00000' $where GROUP BY Kode_wil,Nama_wil
										ORDER BY Kode_wil";	
							*/
								$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,sum(L_panen12) as data12
										FROM Isi_data 
										WHERE Tanaman = '$kom' and keterangan = '$ket' $where GROUP BY Kode_wil,Nama_wil
										ORDER BY Kode_wil";			
							
										echo $query;
							}else{
								/*
								$query = "SELECT Kode_wil,Nama_wil,L_panen01 as data1,L_panen02 as data2,L_panen03 as data3,L_panen04 as data4,L_panen05 as data5,L_panen06 as data6,L_panen07 as data7,L_panen08 as data8,L_panen09 as data9,L_panen10 as data10,L_panen11 as data11,L_panen12 as data12
								FROM Isi_data 
								WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' and right(kode_wil,5) = '00000' $where	ORDER BY Kode_wil";	
								*/
								$query = "SELECT Kode_wil,Nama_wil,L_panen01 as data1,L_panen02 as data2,L_panen03 as data3,L_panen04 as data4,L_panen05 as data5,L_panen06 as data6,L_panen07 as data7,L_panen08 as data8,L_panen09 as data9,L_panen10 as data10,L_panen11 as data11,L_panen12 as data12
								FROM Isi_data 
								WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' $where	ORDER BY Kode_wil";	
								echo $query;
							}
						}
							
						
					}else
					{
					/* Kalo propinsi atau kabupaten tidak kosong*/
					
						if($kom == '22'){
							if($lahan == '3'){
								$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '3' and keterangan = '1') 
										or (Tanaman = '6' and keterangan = '1') $where GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										echo $query;
							}else{
							$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '3' and keterangan = '1') 
										or (Tanaman = '6' and keterangan = '1') $where and Lahan = '$lahan' GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										echo $query;
									}								
						}elseif($kom == '23'){
						
							if($lahan == '3'){
								$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '4' and keterangan = '1') 
										or (Tanaman = '7' and keterangan = '1') $where GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										//echo $query;
							}else{
							$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,
										sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,
										sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,
										sum(L_panen12) as data12 FROM Isi_data WHERE (Tanaman = '4' and keterangan = '1') 
										or (Tanaman = '7' and keterangan = '1') $where 
										and Lahan = '$lahan'  GROUP BY Kode_wil,Nama_wil ORDER BY Kode_wil";	
										//echo $query;
									}
						}
						else{
							if($lahan == '3'){
							$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,sum(L_panen12) as data12
										FROM Isi_data 
										WHERE Tanaman = '$kom' and keterangan = '$ket' $where GROUP BY Kode_wil,Nama_wil
										ORDER BY Kode_wil";	
									echo $query;
							}else{
							$query = "SELECT Kode_wil,Nama_wil,L_panen01 as data1,L_panen02 as data2,L_panen03 as data3,L_panen04 as data4,L_panen05 as data5,L_panen06 as data6,L_panen07 as data7,L_panen08 as data8,L_panen09 as data9,L_panen10 as data10,L_panen11 as data11,L_panen12 as data12
							FROM Isi_data 
							WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' $where
							ORDER BY Kode_wil";	
							echo $query;
							}
						}
					}
					
				}
				
				/* Luas Tanam*/
				if($tabel == '2')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_tanam01) as data1,sum(L_tanam02) as data2,sum(L_tanam03) as data3,sum(L_tanam04) as data4,sum(L_tanam05) as data5,sum(L_tanam06) as data6,sum(L_tanam07) as data7,sum(L_tanam08) as data8,sum(L_tanam09) as data9,sum(L_tanam10) as data10,sum(L_tanam11) as data11,sum(L_tanam12) as data12
									FROM Isi_data
									WHERE Tanaman = '$kom' and keterangan = '$ket' $where
									GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
								echo $query;
					}else{									
						$query = "SELECT Kode_wil,Nama_wil,L_tanam01 as data1,L_tanam02 as data2,L_tanam03 as data3,L_tanam04 as data4,L_tanam05 as data5,L_tanam06 as data6,L_tanam07 as data7,L_tanam08 as data8,L_tanam09 as data9,L_tanam10 as data10,L_tanam11 as data11,L_tanam12 as data12
						FROM Isi_data 
						WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' $where
						ORDER BY Kode_wil";	
						echo $query;
					}
				}
				
				if($tabel == '3')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_puso01) as data1,sum(L_puso02) as data2,sum(L_puso03) as data3,sum(L_puso04) as data4,sum(L_puso05) as data5,sum(L_puso06) as data6,sum(L_puso07) as data7,sum(L_puso08) as data8,sum(L_puso09) as data9,sum(L_puso10) as data10,sum(L_puso11) as data11,sum(L_puso12) as data12
									FROM Isi_data
									WHERE Tanaman = '$kom' and keterangan = '$ket' $where
									GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
					}else{	
						$query = "SELECT Kode_wil,Nama_wil,L_puso01 as data1,L_puso02 as data2,L_puso03 as data3,L_puso04 as data4,L_puso05 as data5,L_puso06 as data6,L_puso07 as data7,L_puso08 as data8,L_puso09 as data9,L_puso10 as data10,L_puso11 as data11,L_puso12 as data12
						FROM Isi_data 
						WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' $where
						ORDER BY Kode_wil";	
					}
				}
				
		}
		else if($role == '2')
		{
				if($tabel == '1')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,sum(L_panen12) as data12
									FROM Isi_data 
									WHERE Tanaman = '$kom' and keterangan = '$ket' $where GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
								echo $query;
						}else{
					$query = "SELECT Kode_wil,Nama_wil,L_panen01 as data1,L_panen02 as data2,L_panen03 as data3,L_panen04 as data4,L_panen05 as data5,L_panen06 as data6,L_panen07 as data7,L_panen08 as data8,L_panen09 as data9,L_panen10 as data10,L_panen11 as data11,L_panen12 as data12
					FROM Isi_data 
					WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' $where
					ORDER BY Kode_wil";	
					echo $query;
					}
				}
				
				if($tabel == '2')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_tanam01) as data1,sum(L_tanam02) as data2,sum(L_tanam03) as data3,sum(L_tanam04) as data4,sum(L_tanam05) as data5,sum(L_tanam06) as data6,sum(L_tanam07) as data7,sum(L_tanam08) as data8,sum(L_tanam09) as data9,sum(L_tanam10) as data10,sum(L_tanam11) as data11,sum(L_tanam12) as data12
									FROM Isi_data
									WHERE Tanaman = '$kom' and keterangan = '$ket' $where
									GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
					}else{	
					$query = "SELECT Kode_wil,Nama_wil,L_tanam01 as data1,L_tanam02 as data2,L_tanam03 as data3,L_tanam04 as data4,L_tanam05 as data5,L_tanam06 as data6,L_tanam07 as data7,L_tanam08 as data8,L_tanam09 as data9,L_tanam10 as data10,L_tanam11 as data11,L_tanam12 as data12
					FROM Isi_data 
					WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' $where
					ORDER BY Kode_wil";
					}						
				}
				
				if($tabel == '3')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_puso01) as data1,sum(L_puso02) as data2,sum(L_puso03) as data3,sum(L_puso04) as data4,sum(L_puso05) as data5,sum(L_puso06) as data6,sum(L_puso07) as data7,sum(L_puso08) as data8,sum(L_puso09) as data9,sum(L_puso10) as data10,sum(L_puso11) as data11,sum(L_puso12) as data12
									FROM Isi_data
									WHERE Tanaman = '$kom' and keterangan = '$ket' $where
									GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
					}else{	
					$query = "SELECT Kode_wil,Nama_wil,L_puso01 as data1,L_puso02 as data2,L_puso03 as data3,L_puso04 as data4,L_puso05 as data5,L_puso06 as data6,L_puso07 as data7,L_puso08 as data8,L_puso09 as data9,L_puso10 as data10,L_puso11 as data11,L_puso12 as data12
					FROM Isi_data 
					WHERE Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' $where
					ORDER BY Kode_wil";	
					}
				}
		}
		else if($role == '3')
		{
				if($tabel == '1')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_panen01) as data1,sum(L_panen02) as data2,sum(L_panen03) as data3,sum(L_panen04) as data4,sum(L_panen05) as data5,sum(L_panen06) as data6,sum(L_panen07) as data7,sum(L_panen08) as data8,sum(L_panen09) as data9,sum(L_panen10) as data10,sum(L_panen11) as data11,sum(L_panen12) as data12
									FROM Isi_data 
									WHERE kode_wil 
									LIKE '$subinputkab%' and Tanaman = '$kom' and keterangan = '$ket' and right(Kode_wil,3) <> '000'
									GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
								//echo $query;
						}else{					
					$query = "SELECT Kode_wil,Nama_wil,L_panen01 as data1,L_panen02 as data2,L_panen03 as data3,L_panen04 as data4,L_panen05 as data5,L_panen06 as data6,L_panen07 as data7,L_panen08 as data8,L_panen09 as data9,L_panen10 as data10,L_panen11 as data11,L_panen12 as data12
					FROM Isi_data 
					WHERE kode_wil 
					LIKE '$subinputkab%' and Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' and right(Kode_wil,3) <> '000'
					ORDER BY Kode_wil";	
					//echo $query;
					}
				}
				
				if($tabel == '2')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_tanam01) as data1,sum(L_tanam02) as data2,sum(L_tanam03) as data3,sum(L_tanam04) as data4,sum(L_tanam05) as data5,sum(L_tanam06) as data6,sum(L_tanam07) as data7,sum(L_tanam08) as data8,sum(L_tanam09) as data9,sum(L_tanam10) as data10,sum(L_tanam11) as data11,sum(L_tanam12) as data12
									FROM Isi_data 
									WHERE kode_wil 
									LIKE '$subinputkab%' and Tanaman = '$kom' and keterangan = '$ket' and right(Kode_wil,3) <> '000'
									GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
								//echo $query;
						}else{					
						$query = "SELECT Kode_wil,Nama_wil,L_tanam01 as data1,L_tanam02 as data2,L_tanam03 as data3,L_tanam04 as data4,L_tanam05 as data5,L_tanam06 as data6,L_tanam07 as data7,L_tanam08 as data8,L_tanam09 as data9,L_tanam10 as data10,L_tanam11 as data11,L_tanam12 as data12
						FROM Isi_data 
						WHERE kode_wil 
						LIKE '$subinputkab%' and Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' and right(Kode_wil,3) <> '000'
						ORDER BY Kode_wil";	
					}
				}
				
				if($tabel == '3')
				{
					if($lahan == '3'){
						$query = "SELECT Kode_wil,Nama_wil,sum(L_puso01) as data1,sum(L_puso02) as data2,sum(L_puso03) as data3,sum(L_puso04) as data4,sum(L_puso05) as data5,sum(L_puso06) as data6,sum(L_puso07) as data7,sum(L_puso08) as data8,sum(L_puso09) as data9,sum(L_puso10) as data10,sum(L_puso11) as data11,sum(L_puso12) as data12
									FROM Isi_data 
									WHERE kode_wil 
									LIKE '$subinputkab%' and Tanaman = '$kom' and keterangan = '$ket' and right(Kode_wil,3) <> '000'
									GROUP BY Kode_wil,Nama_wil
									ORDER BY Kode_wil";	
								//echo $query;
						}else{		
							$query = "SELECT Kode_wil,Nama_wil,L_puso01 as data1,L_puso02 as data2,L_puso03 as data3,L_puso04 as data4,L_puso05 as data5,L_puso06 as data6,L_puso07 as data7,L_puso08 as data8,L_puso09 as data9,L_puso10 as data10,L_puso11 as data11,L_puso12 as data12
							FROM Isi_data 
							WHERE kode_wil 
							LIKE '$subinputkab%' and Tanaman = '$kom' and Lahan = '$lahan' and keterangan = '$ket' and right(Kode_wil,3) <> '000'
							ORDER BY Kode_wil";
						}					
				}
		}
		//echo $query;
		//exit;		
		$rs = mssql_query($query) or die('Error');
		return $rs;
	}
	

}
