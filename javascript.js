function konfirmasi(DestURL){
    var ok = confirm("Anda yakin mau melakukan proses delete?");
    if(ok){
        location.href = DestURL;
    }else{
        return false;
    }
}