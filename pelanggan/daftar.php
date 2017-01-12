<?php

$update = ((isset($_GET['action']) AND $_GET['action'] == 'update') OR isset($_SESSION["is_pelanggan"])) ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_SESSION[id]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE pelanggan SET no_ktp='$_POST[no_ktp]', nama='$_POST[nama]', email='$_POST[email]', no_telp='$_POST[no_telp]', alamat='$_POST[alamat]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='".md5($_POST["password"])."'";
		}
		$sql .= " WHERE id_pelanggan='$_SESSION[id]'";
	} else {
		$sql = "INSERT INTO pelanggan VALUES (NULL, '$_POST[no_ktp]', '$_POST[nama]', '$_POST[email]', '$_POST[no_telp]', '$_POST[alamat]', '$_POST[username]', '".md5($_POST["password"])."')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil! Silahkan login", "login.php");
  } else {
		echo alert("Gagal!", "?page=pelanggan");
  }
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM pelanggan WHERE id_pelanggan='$_SESSION[id]'");
	echo alert("Berhasil!", "?page=pelanggan");
}
?>
<div class="container">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="page-header">
				<?php if ($update): ?>
					<h2>Update <small>data pelanggan!</small></h2>
				<?php else: ?>
					<h2>Daftar <small>sebegai pelanggan!</small></h2>
				<?php endif; ?>
			</div>
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" name="nama" class="form-control" autofocus="on" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="no_ktp">No KTP</label>
					<input type="text" name="no_ktp" class="form-control" <?= (!$update) ?: 'value="'.$row["no_ktp"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="no_telp">No Telp</label>
					<input type="text" name="no_telp" class="form-control" <?= (!$update) ?: 'value="'.$row["no_telp"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea rows="2" name="alamat" class="form-control"><?= (!$update) ? "" : $row["alamat"] ?></textarea>
				</div>
				<div class="form-group">
					<label for="email">email</label>
					<input type="email" name="email" class="form-control" <?= (!$update) ?: 'value="'.$row["email"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" <?= (!$update) ?: 'value="'.$row["username"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<?php if ($update): ?>
					<div class="row">
							<div class="col-md-10">
								<button type="submit" class="btn btn-warning btn-block">Update</button>
							</div>
							<div class="col-md-2">
								<a href="?page=kriteria" class="btn btn-default btn-block">Batal</a>
							</div>
					</div>
				<?php else: ?>
					<button type="submit" class="btn btn-primary btn-block">Register</button>
				<?php endif; ?>
		</form>
		</div>
		<div class="col-md-2"></div>
</div>
