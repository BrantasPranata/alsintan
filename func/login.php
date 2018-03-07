<?php 
session_start();
include_once './func/config.php';

class Login
{
	//Database connect
    public function __construct()
    {
    $db = new DB_Class();
    }
	
	function check_login($user,$pass)
	{
		
		$password = md5($pass);
		
		
		$q = "SELECT * FROM m_user WHERE u_id = '$user' and pwd = '$password' AND sts = '1' ";
		//echo $q;die();
		$r = mysql_query($q);
		$u = mysql_fetch_array($r);
		$no = mysql_num_rows($r);

		if ($no == 0)
		{	
		
			$query1 = "SELECT * FROM sms_user WHERE username = '$user' and password = '$password'";
			//echo $query;
			$result1 = mysql_query($query1);
			$user_data1 = mysql_fetch_array($result1);
			$no_rows1 = mysql_num_rows($result1);
			
			if ($no_rows1 > 0)
			{
			
				$_SESSION['login'] = 1;
				$_SESSION['user_id'] = $user_data1['username'];
				$_SESSION['user_name'] = $user_data1['username'];
				$_SESSION['user_password'] =$user_data1['password'];
				$_SESSION['user_akses'] =$user_data1['ulevel'];
				if ($user=="adminpsp")
				{
					$_SESSION['type'] ='adminpsp';
				}
				else
				{
					$_SESSION['type'] ='admin';
				}
				
				return true;
			}

			$query2 = "SELECT * FROM sms_phonebook WHERE REPLACE(noTelp,'+62','0') = '$user' and password = '$password' AND idgroup = '444'";
			//echo $query2;die();
			$result2 = mysql_query($query2);
			$user_data2 = mysql_fetch_array($result2);
			$no_rows2 = mysql_num_rows($result2);		

			if ($no_rows2 > 0)
			{
			//echo "masuk sms_user";die();
				$_SESSION['login'] = 1;
				$_SESSION['user_id'] = $user_data2['noTelp'];
				if ($user_data2['nama']!="")
				{
					$_SESSION['user_name'] = $user_data2['nama'];
				}
				else
				{
					$_SESSION['user_name']="No Name";
				}
				$_SESSION['user_password'] =$user_data2['password'];
				$_SESSION['user_akses'] ='11';
				$_SESSION['type'] = 'user';
				if($user_data2['noTelp']=='+628111106637')
				{
					$_SESSION['type'] = 'pjmonev';
				}
									
				$q2 = mysql_query("SELECT b.kd_prop,a.kd_kab, b.nm_prop 
									FROM sms_phonebook a
									JOIN tb_propinsi b ON b.kd_prop = a.kd_prop
									WHERE REPLACE(a.noTelp,'+62','0') = '".$user."' 
									LIMIT 0,1");
				$row = mysql_fetch_row($q2);

				$_SESSION['kd_prop'] = $row[0];
				$_SESSION['nm_prop'] = $row[2];
				$_SESSION['kab'] = $row[1];
				
				//echo "SELECT b.kd_prop,a.kd_kab, b.nm_prop FROM sms_phonebook a JOIN tb_propinsi b ON b.kd_prop = a.kd_prop WHERE REPLACE(a.noTelp,'+62','0') = '".$user."' LIMIT 0,1";die();
				
				return true;
			}
			
			$query3 = "SELECT * FROM ms_pj_monev WHERE REPLACE(notelp,'+62','0') = '$user' and password = '$password'";
			//echo $query2;
			$result3 = mysql_query($query3);
			$user_data3 = mysql_fetch_array($result3);
			$no_rows3 = mysql_num_rows($result3);

			if ($no_rows3 > 0)
			{
				$q2 = mysql_query("SELECT a.kd_wil,c.nm_prop FROM `pj_monev` a, ms_pj_monev b,tb_propinsi c where a.id=b.id and a.kd_wil=c.kd_prop 
									and REPLACE(b.notelp,'+62','0') = '".$user."' 
									LIMIT 0,1");
				$row = mysql_fetch_row($q2);
				
				$pj = mysql_query("select a.id,a.notelp,b.kd_wil from ms_pj_monev a, pj_monev b where a.id=b.id and REPLACE(a.notelp,'+62','0') = '".$user."' 
									");
				$rowpj = mysql_fetch_row($pj);
				$_SESSION['kd_wil'] = $rowpj[2];
				$_SESSION['login'] = 1;
				$_SESSION['user_id'] = $user;
				$_SESSION['user_name'] = $user_data3['nama'];
				$_SESSION['user_password'] = $user_data3['password'];
				$_SESSION['user_akses'] = '11';
				$_SESSION['type'] = 'pjmonev';
				$_SESSION['kd_prop'] = $row[0];
				$_SESSION['nm_prop'] = $row[1];
			
				return true;
			}
			return false;

		}
		else
		{
			// masuk pokja
			$q2 = mysql_query("SELECT b.kd_prop, b.nm_prop, a.nama,a.password
								FROM sms_phonebook a
								JOIN tb_propinsi b ON b.kd_prop = a.kd_prop
								WHERE REPLACE(a.noTelp,'+62','0') = '".$user."' 
								LIMIT 0,1");
			$row = mysql_fetch_row($q2);

			$_SESSION['login'] = 1;
			$_SESSION['user_id'] = $user;
			$_SESSION['user_name'] = $row[2];
			$_SESSION['user_password'] = $password;
			$_SESSION['user_akses'] = '11';
			$_SESSION['type'] = 'pokja';
			$_SESSION['kd_prop'] = $row[0];
			$_SESSION['prov'] = $row[0];
			$_SESSION['nm_prop'] = $row[1];

			return true;
		}
		return false;
	}
	
	function logout()
	{
		session_destroy();
		header("location:index.php");
	}
	
	function ubahpass($passbaru)
	{
		$role = $_SESSION['login'];
		
		if($role == '1')
		{
			$query = "UPDATE tbl_pusat SET katasandi = '$passbaru' WHERE kode_wil = '".$_SESSION[user_id]."'";
			//echo "admin Pusat";		
		}
		else if($role == '2')
		{
			$query = "UPDATE tbl_prop SET katasandi = '$passbaru' WHERE kode_wil = '".$_SESSION[user_id]."'";
		}
		else if($role == '3')
		{
			$query = "UPDATE tbl_kab SET katasandi = '$passbaru' WHERE kode_wil = '".$_SESSION[user_id]."'";
		}
		
		$result = mssql_query($query);
		return true;
		//$result = mssql_query($query);
	}
	
	
	
}
