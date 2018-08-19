<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*	type untuk success||danger||warning||
*	title untuk penamaan alert
*	bold untuk bold
*	message untuk pesannya
*/
function alert($title, $type, $bold, $message,$php = true)
{
	$CI =& get_instance();
	if ($php) {
		$CI->session->set_flashdata($title,"
											<div class='alert alert-".$type."' alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>".$bold." </strong>".$message."</div>
		");
	}
	else{
		echo "<div class='alert alert-".$type." alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>".$bold."</strong> ".$message."</div>";
	}
}

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln)
		{
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}

if ( ! function_exists('hitung_mundur'))
{
	function hitung_mundur($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}
if ( ! function_exists('int_to_word'))
{
	function int_to_words($x) {
		$nwords = array( "nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh",
		                   "delaan", "sembilan", "sepuluh", "sebelas", "dua belas", "tiga belas",
		                   "empat belas", "lima belas", "enam belas", "tujuh belas", "delapan belas",
		                   "sembilan belas", "dua puluh", 30 => "tiga puluh", 40 => "empat puluh",
		                   50 => "lima puluh", 60 => "enam puluh", 70 => "tujuh puluh", 80 => "delapan puluh",
		                   90 => "sembilan puluh" );

	   if(!is_numeric($x))
	      $w = '#';
	   else if(fmod($x, 1) != 0)
	      $w = '#';
	   else {
	      if($x < 0) {
	         $w = 'minus ';
	         $x = -$x;
	      } else
	         $w = '';
	      // ... now $x is a non-negative integer.

	      if($x < 21)   // 0 to 20
	         $w .= $nwords[$x];
	      else if($x < 100) {   // 21 to 99
	         $w .= $nwords[10 * floor($x/10)];
	         $r = fmod($x, 10);
	         if($r > 0)
	            $w .= '-'. $nwords[$r];
	      }
	   }
	   return $w;
	}
}