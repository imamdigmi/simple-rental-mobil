<?php
if (!isset($_SESSION["pelanggan"])) {
  header('location: login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(($_FILES['bukti']['name'] == "")){
      echo alert("File bukti transaksi harus ada!", "?page=konfirmasi&id=".$_GET['id']);
      exit;
    }
    $x = explode('.', $_FILES['bukti']['name']);
    $bukti = $_SESSION["pelanggan"]["id"].date('dmYHis').'.'.strtolower(end($x));
    @move_uploaded_file($_FILES['bukti']['tmp_name'], 'assets/img/bukti/'.$bukti);
    if ($connection->query("INSERT INTO konfirmasi VALUES(NULL, $_POST[_id], '$bukti')")) {
        $connection->query("UPDATE transaksi SET konfirmasi='1' WHERE id_transaksi=$_POST[_id]");
        echo alert("Konfirmasi Berhasil!", "?page=profil");
    } else {
        echo alert("Konfirmasi Gagal!", "?page=konfirmasi&id=".$_GET['id']);
    }
}
?>
<div class="panel panel-info">
    <div class="panel-heading"><h3 class="text-center">Konfirmasi Pembayaran</h3></div>
    <div class="panel-body">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bukti">Bukti Pembayaran</label>
                <input type="file" name="bukti" class="form-control">
            </div>
            <button type="submit" class="btn btn-info btn-block">Konfirmasi</button>
            <input type="hidden" name="_id" value="<?=$_GET['id']?>">
        </form>
    </div>
</div>