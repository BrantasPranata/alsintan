<?php
class Paging{
		// Fungsi untuk mencek halaman dan posisi data
		function cariPosisi($batas) {
			if(empty($_GET['page'])) {
				$posisi = 0;
				$_GET['page'] = 1;
			} else {
				$posisi = ($_GET['page'] - 1) * $batas;
			}
			return $posisi;
		}
		
		// Fungsi untuk menghitung total halaman
		function jumlahHalaman($jmldata, $batas) {
			$jmlhalaman = ceil($jmldata/$batas);
			return $jmlhalaman;
		}
		
		// Fungsi untuk link halaman 1,2,3 
		function navHalaman($halaman_aktif, $jmlhalaman) {
			global $link;
			
			$link_halaman = "";
		
			// Link ke halaman pertama (first) dan sebelumnya (prev)
			if($halaman_aktif > 1) {
				$prev = $halaman_aktif - 1;
	
				if($prev > 1) { 
					$link_halaman .= "<a class=\"first\" href=\"page-1.html\"></a>";
				}			
				$link_halaman .= "<a class=\"previouspostslink\" href=\"page-".$prev.".html\"></a>";
			}
		
			// Link halaman 1,2,3, ...
			$angka = ($halaman_aktif > 3 ? "<span>...</span>" : " "); 
			for($i = $halaman_aktif-2;$i < $halaman_aktif;$i++) {
				if ($i < 1) continue;
				$angka .= "<a href=\"page-".$i.".html\">".$i."</a>";
			}
			$angka .= "<span class=\"current\">".$halaman_aktif."</span>";
			  
			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++) {
				if($i > $jmlhalaman) break;
				$angka .= "<a href=\"page-".$i.".html\">".$i."</a>";
			}
			$angka .= ($halaman_aktif+2 < $jmlhalaman ? "<span>...</span><a href=\"page-".$jmlhalaman.".html\">".$jmlhalaman."</a>" : " ");
		
			$link_halaman .= $angka;
			
			// Link ke halaman berikutnya (Next) dan terakhir (Last) 
			if($halaman_aktif < $jmlhalaman) {
				$next = $halaman_aktif + 1;
				$link_halaman .= "<a class=\"nextpostslink\" href=\"page-".$next.".html\"></a>";
				
				if($halaman_aktif != $jmlhalaman - 1) {
					$link_halaman .= "<a class=\"last\" href=\"page-".$jmlhalaman.".html\"></a>";
				}
			}
			
			return $link_halaman;
		}
	}	
	

}
