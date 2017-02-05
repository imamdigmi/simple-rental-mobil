<?php
if (!isset($_SESSION["pelanggan"])) {
  header('location: login.php');
  exit;
}
$query = $connection->query("SELECT * FROM mobil WHERE id_mobil=$_POST[id_mobil]");
$data  = $query->fetch_assoc();

$id          = $_SESSION["pelanggan"]["id"]; // id user yang sedang login
$jatuhtempo  = date('Y-m-d H:00:00', strtotime('+3 hours')); //jam skrg + 3 jam
$hargasupir  = 0; // 
if ($_POST["status"]) {
    $hargasupir = (30000 * $_POST["lama"]);
}
$totalbayar = $hargasupir + ($data["harga"] * $_POST["lama"]);

$connection->query("INSERT INTO transaksi VALUES (NULL, $id, $_POST[id_mobil], '$now', NULL, NULL, $_POST[lama], $totalbayar, '0', '$_POST[jaminan]', NULL, '$jatuhtempo', '0', '0')");
$idtransaksi = $connection->insert_id;

if ($_POST["status"]) {
    $hargasupir = 30000;
    $supir      = $connection->query("SELECT id_supir FROM supir WHERE status='1' LIMIT 1");
    $s          = $supir->fetch_assoc();
    $connection->query("INSERT INTO detail_transaksi VALUES (NULL, $idtransaksi, $s[id_supir], $hargasupir)");
    $connection->query("UPDATE supir SET status='0' WHERE id_supir=$s[id_supir]");
}
$connection->query("UPDATE mobil SET status='0' WHERE id_mobil=$data[id_mobil]");
?>

<div class="panel panel-info">
    <div class="panel-heading"><h3 class="text-center">Transaksi Berhasil</h3></div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>: <?=$_SESSION["pelanggan"]["nama"]?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: <?=$_SESSION["pelanggan"]["email"]?></td>
                </tr>
                <tr>
                    <th>Harga Sewa</th>
                    <td>: Rp.<?=number_format($data["harga"])?>,-/hari</td>
                </tr>
                <tr>
                    <th>Harga Supir</th>
                    <td>: Rp.<?=number_format($hargasupir)?>,-/hari</td>
                </tr>
                <tr>
                    <th>Lama Sewa</th>
                    <td>: <?=$_POST["lama"]?> hari</td>
                </tr>
                <tr>
                    <th>Total Bayar</th>
                    <td>: Rp.<?=number_format($totalbayar)?>,-</td>
                </tr>
                <tr>
                    <th>Jatuh Tempo pembayaran</th>
                    <td>: <?=$jatuhtempo?></td>
                </tr>
                <tr>
                    <th>Jaminan</th>
                    <td>: <?=$_POST["jaminan"]?></td>
                </tr>
            </thead>
        </table>
        <hr>
        <h3>Terimakasih</h3>
        <p>
            Transaksi pembelian anda telah berhasil<br>
            Silahkan anda membayar tagihan anda dengan cara transfer via Bank BRI di nomor Rekening : <br>
            <strong>(0986-01-025805-53-8 a/n SEWA MOBIL)</strong> untuk menyelesaikan pembayaran. dan untuk uang muka minimal setengah dari harga sewa.
        </p>
        <p>
            Jika anda sudah melakukan transfer silahkan anda melakukan konfirmasi pembayaran dengan mengunjungi halaman profil akun anda lalu tekan tombol. <i><b>Lihat Profil</b></i>.
        </p>
        <p> Batas Konfirmasi 3 jam, jika lebih dari 3 jam anda tidak melakukan konfirmasi maka sistem akan membatalkan pesanan secara otomatis.
        </p>
    </div>
    <div class="panel-footer">
        <a href="?page=profil" class="btn btn-primary btn-sm">Lihat Profil</a>
    </div>
</div>