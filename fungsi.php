<?php 
function bersihkan($inputan){
    $inputan = htmlspecialchars($inputan);
    return $inputan;
}
function is_gambar($type_file){
    $array_gambar = array('image/png','image/jpeg','image/gif','image/bmp');
    if(in_array($type_file,$array_gambar)){
        return true;
    }else{
        return false;
    }
}

function is_dokumen($type_file){
    $array_dokumen = array('application/pdf','application/msword','application/vnd.ms-excel','application/vnd.ms-powerpoint','application/octet-stream');
    if(in_array($type_file,$array_dokumen)){
        return true;
    }else{
        return false;
    }
}

function tgl_indo($parameter){
    //2020-11-01 23:59:01
    $arr_bulan = array(
        01=>'Jan',02=>'Feb',03=>'Mar',
        04=>'Apr',05=>'Mei',06=>'Jun',
        07=>'Jul',08=>'Aug',09=>'Sep',
        10=>'Okt',11=>'Nop',12=>'Des'
    );
    $explode = explode(" ",$parameter);
    $tanggal = $explode[0];
    $waktu = $explode[1];
    $explode2 = explode("-",$tanggal);
    return $explode2[2]." ".$arr_bulan[$explode2[1]]." ".$explode2[0];
}