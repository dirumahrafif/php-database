<?php
function normal(){
    global $koneksi;
    $aksi = isset($_GET['aksi'])?$_GET['aksi']:'';
    if($aksi == 'delete'){
        $sql1 = "select * from d_galeri where galeri_id = '".$_GET['id']."'";
        $query1 = mysqli_query($koneksi,$sql1);
        $result1 = mysqli_fetch_array($query1);
        @unlink($result1['foto']);

        $sql1 = "delete from d_galeri where galeri_id = '".$_GET['id']."'";
        mysqli_query($koneksi,$sql1);
    }
    $sql1 = "select * from d_galeri order by tgl_isi desc";
    $query1 = mysqli_query($koneksi,$sql1);
    ?>
    <div style="text-align: right;">
        <a href="admin_galeri.php?op=tambah">
        <button class="btn btn-primary">Tambah galeri</button>
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
                    <td><a href='admin_galeri.php?op=tambah&id=<?php echo $result1['galeri_id']?>'>Edit</a> | <a href='#' onclick="konfirmasi('admin_galeri.php?aksi=delete&id=<?php echo $result1['galeri_id']?>')">Delete</a></td>
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
    $judul = "";$isi = "";$jenis_galeri = "";$err = "";$success="";$foto_nama_db = '';$kategori_galeri_id='';
    $status_edit = false;
    $status_update_foto = true;
    ?>
    <div>
        <a href="admin_galeri.php">&lsaquo; kembali ke halaman admin galeri</a>
    </div>
    <?php
    $simpan = isset($_POST['simpan']) ? $_POST['simpan']:'';
    if(isset($_GET['id']) != ''){
        $id = $_GET['id'];
        $sql1 = "select * from d_galeri where galeri_id = '$id'";
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
        $kategori_galeri_id = $result1['kategori_galeri_id'];
        $foto_nama_db = $result1['foto'];
       
    }

    if($simpan){
        $judul = bersihkan($_POST['judul']);
        $isi = bersihkan($_POST['isi']);
        $kategori_galeri_id = bersihkan($_POST['kategori_galeri_id']);

        if($judul == ''){
            $err = $err."<li>Judul wajib diisi.</li>";
        }
        $foto_nama = $_FILES['foto']['name'];
        $foto_type = $_FILES['foto']['type'];
        $foto_file = $_FILES['foto']['tmp_name'];
        
        if(is_gambar($foto_type)==false && $foto_nama != ''){
            $err = $err."<li>Gambar yang dimasukkan tidak diperbolehkan</li>";
        }
        
        if($err == ''){
            if($status_edit == true){
                if($foto_nama == ''){
                    $foto_nama = $foto_nama_db;
                    $status_update_foto = false;
                }else{
                    $foto_nama = time()."_".$foto_nama;
                }
                
                $sql1 = "update d_galeri set judul = '$judul',isi='$isi',foto='$foto_nama',kategori_galeri_id='$kategori_galeri_id',login_id='$login_id',tgl_update=now() where galeri_id = '$id'";
            }else{
                $sql1 = "insert into d_galeri(judul,isi,foto,kategori_galeri_id,login_id) values ('$judul','$isi','$foto_nama','$kategori_galeri_id','$login_id')";
            }
            $query1 = mysqli_query($koneksi,$sql1);
            if($query1){
                if($foto_nama){
                    if($status_update_foto == true){
                        @unlink($foto_nama_db);
                        $foto_nama_db = $foto_nama;
                    }
                    move_uploaded_file($foto_file,$foto_nama);
                }
                
                $success = "Data berhasil disimpan. <a href='admin_galeri.php'>Kembali ke halaman admin galeri</a>";
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
            <label for="kategori_galeri_id">Kategori Galeri</label>
            <select name="kategori_galeri_id" class="form-control">
                <?php 
                $sql1 = "select * from d_kategori_galeri order by judul asc";
                $query1 = mysqli_query($koneksi,$sql1);
                while($result1 = mysqli_fetch_array($query1)){
                    ?>
                    <option <?php if($result1['kategori_galeri_id'] == $kategori_galeri_id) echo "selected"?> value="<?php echo $result1['kategori_galeri_id']?>">
                        <?php echo $result1['judul']?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <?php 
            if($foto_nama_db != ''){
                echo "<img src='$foto_nama_db' width='150'/><br/>";
            }
            ?>
            <label for="foto">Foto</label>
            <input type="file" id="foto" name="foto"/>
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