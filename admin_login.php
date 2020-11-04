<?php 
require_once("admin_header.php");
$username = "";
$password = "";
$err = "";

if(isset($_SESSION['login_id'])){
    header("location:admin_tulisan.php");
}
$submit = isset($_POST['submit'])?$_POST['submit']:'';
if($submit){
    $username = stripslashes($_POST['username']);
    $password = stripslashes($_POST['password']);
    if(empty($username) or empty($password)){
        $err = $err."<li>Username dan password harus diisi.</li>";
    }else{
        $sql1 = "select * from d_login where username = '$username'";
        $query1 = mysqli_query($koneksi,$sql1);
        $result1 = mysqli_fetch_array($query1);
        if($result1['password'] != md5($password)){
            $err = $err."<li>Username dan password tidak sesuai.</li>";
        }else{
            $_SESSION['login_id'] = $result1['login_id'];
            $_SESSION['username'] = $result1['username'];
            header("location:admin_tulisan.php");
        }

    }
}
?>
<h1>Login Area</h1>
<?php 
if($err){
    ?>
    <div class="alert alert-danger">
        <ul><?php echo $err ?></ul>
    </div>
    <?php
}
?>
<form action="" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username ?>" />
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" />
    </div>
    <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
</form>
<?php 
require_once("admin_footer.php");
?>