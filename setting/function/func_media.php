<?php
function cek_absen($absen)
{
	if(!empty($absen)){
		$tampil = "";
	}
	elseif(empty($absen)){
		$tampil = "nopointer";
	}
	else{
		$tampil = "nopointer";
	}
	return $tampil;	
}
function potong_nilai($nilai)
{
	$tampil = substr($nilai,0,4);
	return $tampil;	
}
function nilai_mutu($nilai)
{
	if($nilai > 86){
		$tampil = "A";
	}
	elseif($nilai <= 85 AND $nilai>76 ){
		$tampil = "B";
	}
	elseif($nilai <=75 AND $nilai>65){
		$tampil = "C";
	}
	elseif($nilai <=64 AND $nilai>55){
		$tampil = "D";
	}
	elseif($nilai<=54 || $nilai<54 ){
		$tampil = "E";
	}
	else{
		$tampil = "";
	}
	return $tampil;
}
function cek_status3($status)
{
	if($status == "aktif"){
		$tampil = "Lev. Aktif";
	}elseif($status == "tidak"){
		$tampil = "Lev. Tidak Aktif";
	}else{
		$tampil = "";
	}
	
	return $tampil;
}
function cek_status2($status)
{
	if($status == "aktif"){
		$tampil = "<i class='fa fa-circle active'></i>";
	}elseif($status == "tidak"){
		$tampil = "<i class='fa fa-circle'></i>";
	}else{
		$tampil = "";
	}
	
	return $tampil;
}
function cek_status1($status)
{
	if($status == "aktif"){
		$tampil = "nopointer";
	}elseif($status == "tidak"){
		$tampil = "";
	}else{
		$tampil = "";
	}
	
	return $tampil;
}
function cek_status4($status)
{
	if($status == "pembekalan"){
		$tampil = "nopointer";
	}else{
		$tampil = "";
	}
	
	return $tampil;
}
function cek_status5($status)
{
	if($status == "hadir"){
		$tampil = "";
	}elseif($status == "tidak"){
		$tampil = "";
	}elseif($status == "" || empty($status)){
		$tampil = "nopointer";
	}
	
	return $tampil;
}
function acak_id($id){
	
	if($id) {
		$tampil = substr($id, 0, -10) . '**********';
	}else {
		$tampil = "";
	}
	return $tampil;
}
function cek_status_peserta($status){
	if($status=="sudah"){
		$tampil = "<span><i class='fa fa-check' style='margin-top:-3px;'></i> Sudah Diperiksa</span>";
	}elseif($status == "tidak"){
		$tampil = "<span><i class='fa fa-close' style='margin-top:-3px;'></i> Belum Diperiksa</span>";
	}elseif($status == "belum"){
		$tampil = "<span><i class='fa fa-minus' style='margin-top:-3px;'></i> Berkas Belum Lengkap</span>";
	}elseif($status == "ubah"){
		$tampil = "<span><i class='fa fa-edit' style='margin-top:-3px;'></i> Berkas Pengganti</span>";	
	}else{
		$tampil = "";
	}
	return $tampil;
}
function cek_nama($nama){
	if(empty($nama) || $nama == "-"){
		$tampil = "";
	}else{
		$tampil = "<i><b>(".ucwords($nama).")</b></i>";
	}	
	return $tampil;
}
function jk($jk){
	if($jk == "laki-laki") {
		$tampil = "Laki-Laki";
	}elseif($jk == "perempuan"){
		$tampil = "Perempuan";
	}else{
		$tampil = "";
	}

	return $tampil;
}
function cek_file($file)
{
	if(empty($file)) {
		$tampil = "default.pdf";
	}
	else{
		$tampil = $file;
	}
	return $tampil;
}function cek_foto($foto)
{
	if(empty($foto)) {
		$tampil = "default.png";
	}
	else{
		$tampil = $foto;
	}
	return $tampil;
}

function cek_jk($jk)
{
	if($jk == 'laki-laki'){
		$tampil = "Bpk.";
	}elseif($jk == 'perempuan'){
		$tampil = "Ibu.";
	}else{
		$tampil = "";
	}
	return $tampil;
}

function cek_isi($isi)
{
	
	if(empty($isi)){
		$tampil = "<center>-</center>";
	}else{
		$tampil = $isi;
	}
	return $tampil;
}

function cek_tgl($isi)
{
	
	if(empty($isi)){
		$tampil = "<center>-</center>";
	}else{
		$tampil = tgl_indo($isi);
	}
	return $tampil;
}

function tgl_indo($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}

function getBulan($bln)
{
	switch ($bln){
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
function hari_indo($hari){ 
	switch($hari){
		case 'Sun':
			$hari = "Minggu";
		break;
 
		case 'Mon':			
			$hari = "Senin";
		break;
 
		case 'Tue':
			$hari = "Selasa";
		break;
 
		case 'Wed':
			$hari = "Rabu";
		break;
 
		case 'Thu':
			$hari = "Kamis";
		break;
 
		case 'Fri':
			$hari = "Jumat";
		break;
 
		case 'Sat':
			$hari = "Sabtu";
		break;
		
		default:
			$hari = "Tidak di ketahui";		
		break;
	}
 
	return $hari;
 
}
?>
