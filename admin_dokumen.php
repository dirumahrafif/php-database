<?php
function normal(){
    global $koneksi;
    $aksi = isset($_GET['aksi'])?$_GET['aksi']:'';
    if($aksi == 'delete'){
        $sql1 = "select * from d_dokumen where dokumen_id = '".$_GET['id']."'";
        $query1 = mysqli_query($koneksi,$sql1);
        $result1 = mysqli_fetch_array($query1);
        @unlink($result1['dokumen']);

        $sql1 = "delete from d_dokumen where dokumen_id = '".$_GET['id']."'";
        mysqli_query($koneksi,$sql1);
    }
    $sql1 = "select * from d_dokumen order by tgl_isi desc";
    $query1 = mysqli_query($koneksi,$sql1);
    ?>
    <div style="text-align: right;">
        <a href="admin_dokumen.php?op=tambah">
        <button class="btn btn-primary">Tambah Dokumen</button>
        </a>
        <br/><br/>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th><th>Judul</th><th>Tgl. Isi</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while($result1 = mysqli_fetch_array($query1)){
                ?>
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $result1['judul']?></td>
                    <td><?php echo tgl_indo($result1['tgl_isi'])?></td>
                    <td><a href='admin_dokumen.php?op=tambah&id=<?php echo $result1['dokumen_id']?>'>Edit</a> | <a href='#' onclick="konfirmasi('admin_dokumen.php?aksi=delete&id=<?php echo $result1['dokumen_id']?>')">Delete</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
function tambah(){
    global $koneksi,$login_id;
    $judul = "";$isi = "";$err = "";$success="";$dokumen_nama_db='';
    $status_edit = false;
    $status_update_dokumen = true;
    ?>
    <div>
        <a href="admin_dokumen.php">&lsaquo; kembali ke halaman admin dokumen</a>
    </div>
    <?php
    $simpan = isset($_POST['simpan']) ? $_POST['simpan']:'';
    if(isset($_GET['id']) != ''){
        $id = $_GET['id'];
        $sql1 = "select * from d_dokumen where dokumen_id = '$id'";
        $query1 = mysqli_query($koneksi,$sql1);
        $num1 = mysqli_num_rows($query1);
        if($num1 < 1){
            $err = "<li>Data tidak ditemukan</li>";
        }else{
            $status_edit = true;
        }
        $result1 = mysqli_fetch_array($query1);
        $judul = $result1['judul'];
        $isi = $result1['isi'];
        $dokumen_nama_db = $result1['dokumen'];
    }

    if($simpan){
        $judul = bersihkan($_POST['judul']);
        $isi = bersihkan($_POST['isi']);

        $dokumen_nama = $_FILES['dokumen']['name'];
        $dokumen_type = $_FILES['dokumen']['type'];
        $dokumen_file = $_FILES['dokumen']['tmp_name'];

        if($judul == '' or $isi == ''){
            $err = $err."<li>Judul dan isian wajib diisi.</li>";
        }
        if(is_dokumen($dokumen_type) == false && $dokumen_nama != ''){
            $err = $err."<li>Dokumen yang dimasukkan tidak diperbolehkan</li>";
        }
        if($err == ''){
            if($status_edit == true){
                
                if($dokumen_nama == ''){
                    $dokumen_nama = $dokumen_nama_db;
                    $status_update_dokumen = false;
                }else{
                    $dokumen_nama = time()."_".$dokumen_nama;
                }
                $sql1 = "update d_dokumen set judul = '$judul',isi='$isi',dokumen='$dokumen_nama',login_id='$login_id',tgl_update=now() where dokumen_id = '$id'";
            }else{
                $sql1 = "insert into d_dokumen(judul,isi,dokumen,login_id) values ('$judul','$isi','$dokumen_nama','$login_id')";
            }
            $query1 = mysqli_query($koneksi,$sql1);
            if($query1){
                if($dokumen_nama){
                    if($status_update_dokumen == true){
                        @unlink($dokumen_nama_db);
                        $dokumen_nama_db = $dokumen_nama;
                    }
                    move_uploaded_file($dokumen_file,$dokumen_nama);
                }
                $success = "Data berhasil disimpan. <a href='admin_dokumen.php'>Kembali ke halaman admin dokumen</a>";
            }
        }

    }
    if($err){
        ?>
        <div class="alert alert-danger">
            <ul><?php echo $err ?></ul>
        </div>
        <?php
    }
    if($success){
        ?>
        <div class="alert alert-primary">
            <?php echo $success?>
        </div>
        <?php
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $judul ?>"/>
        </div>
        <div class="form-group">
            <label for="isi">isi</label>
            <textarea class="form-control summernote" id="isi" name="isi"><?php echo $isi?></textarea>
        </div>
        <div class="form-group">
            <?php 
            if($dokumen_nama_db != ''){
                echo "<a href='$dokumen_nama_db' target='blank'>$dokumen_nama_db</a><br/>";
            }
            ?>
            <label for="dokumen">Dokumen</label>
            <input type="file" id="dokumen" name="dokumen"/>
        </div>
        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
    </form>
    <?php
}
require_once("admin_header.php");
$login_id = $_SESSION['login_id'];
$op = isset($_GET['op']) ? $_GET['op']:'';
switch($op){
    case '':normal();break;
    case 'tambah':tambah();break;
    default:normal();break;
}
require_once("admin_footer.php");