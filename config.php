<?php
date_default_timezone_set('Asia/Jakarta');
$now = date("Y-m-d H:00:00");
/**
 * Database connection setup
 */
 if (!$connection = new Mysqli("localhost", "root", "", "mobil")) {
// if (!$connection = new Mysqli("mysql.idhostinger.com", "u366092382_cal", "calysta", "u366092382_cal")) {
  echo "<h3>ERROR: Koneksi database gagal!</h3>";
}
/**
 * Page initialize
 */
if (isset($_GET["page"])) {
  $_PAGE = $_GET["page"];
  $_ADMINPAGE = $_GET["page"];
} else {
  $_PAGE = "home";
  $_ADMINPAGE = "home";
}
/**
 * Page setup
 * @param page
 * @return page filename
 */
function page($page) {
  return "pelanggan/" . $page . ".php";
}
/**
 * Page setup
 * @param page
 * @return page filename
 */
function adminPage($page) {
  return "page/" . $page . ".php";
}
/**
 * Alert notification
 * @param message, redirection
 * @return alert notify
 */
function alert($msg, $to = null) {
  $to = ($to) ? $to : $_SERVER["PHP_SELF"];
  return "<script>alert('{$msg}');window.location='{$to}';</script>";
}

// Pembatalan otomatis
$query = $connection->query("SELECT jatuh_tempo, id_transaksi, id_mobil FROM transaksi WHERE konfirmasi='0'");
while ($data = $query->fetch_assoc()) { //mengeluarkan data dari query diatas
  if ($now > $data["jatuh_tempo"]) {// jika jatuh tempo lebih dari tgl skrg maka 
    $connection->query("UPDATE transaksi SET pembatalan='1' WHERE id_transaksi=$data[id_transaksi]");
    $connection->query("UPDATE mobil SET status='1' WHERE id_mobil=$data[id_mobil]");
    $query = $connection->query("SELECT id_supir FROM detail_transaksi WHERE id_transaksi=$data[id_transaksi]");
    if ($query->num_rows) {
      $connection->query("UPDATE supir SET status='1' WHERE id_supir=".$query->fetch_assoc()["id_supir"]);
      $connection->query("DELETE FROM detail_transaksi WHERE id_transaksi=$data[id_transaksi]");
    }
  }
}

// Perhitungan deneda otomatis CONTOH : ADDDATE('2017-01-01', INTERVAL 1 DAY)
$sql = "SELECT
          a.id_transaksi,
          (
            TIMESTAMPDIFF(
              HOUR, 
              ADDDATE(a.tgl_ambil, INTERVAL a.lama DAY), 
              a.tgl_kembali
            )
          ) AS terlambat,
          35000 * (TIMESTAMPDIFF(HOUR, ADDDATE(a.tgl_ambil, INTERVAL a.lama DAY), a.tgl_kembali)) AS denda
        FROM transaksi a
        WHERE a.tgl_kembali <> ''";
$query = $connection->query($sql);
while ($a = $query->fetch_assoc()) { //
  if ($a["denda"] > 0) { //
      if (!$connection->query("UPDATE transaksi SET denda=$a[denda] WHERE id_transaksi=$a[id_transaksi]")) {
        die("Hitung denda otomatis gagal.");
      }
  }
}