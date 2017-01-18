<?php

if (isset($_GET["action"])) {
	$now = date("Y-m-d H").":00:00";
	$sql = "UPDATE transaksi";
	if ($_GET["action"] == "ambil") {
		$sql .= " SET tgl_ambil='$now'";
	} elseif ($_GET["action"] == "kembali") {
		$query = $connection->query("SELECT * FROM transaksi JOIN detail_transaksi USING(id_transaksi) WHERE id_transaksi=$_GET[key]");
		$r = $query->fetch_assoc();
		$sql .= " SET tgl_kembali='$now', status='1'";

		$connection->query("UPDATE mobil SET status='1' WHERE id_mobil=".$r["id_mobil"]);
		$connection->query("UPDATE supir SET status='1' WHERE id_supir=".$r["id_supir"]);
	}
	$sql .= " WHERE id_transaksi=$_GET[key]";
	if ($connection->query($sql)) {
		echo alert("Berhasil", "?page=lap_perperiode");
	}
}
?>
<form class="form-inline" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
	<label>Periode</label>
	<input type="text" name="start">
	<label>s/d</label>
	<input type="text" name="stop">
	<button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
</form>
<br>
<?php if ($_POST): ?>
	<div class="panel panel-info">
		<div class="panel-heading"><h3 class="text-center">LAPORAN PENYEWAAN PERPERIODE</h3></div>
		<div class="panel-body">
				<table class="table table-condensed">
						<thead>
								<tr>
										<th>No</th>
										<th>Nama Pelanggan</th>
										<th>Nama Mobil</th>
										<th>Nomor Mobil</th>
										<th>Tanggal Sewa</th>
										<th>Tanggal Ambil</th>
										<th>Tanggal Kembali</th>
										<th>Lama Sewa</th>
										<th>Total Harga</th>
										<th></th>
								</tr>
						</thead>
						<tbody>
								<?php $no = 1; ?>
								<?php if ($query = $connection->query("SELECT * FROM transaksi t JOIN mobil m USING(id_mobil) JOIN pelanggan p ON t.id_pelanggan=p.id_pelanggan WHERE t.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")): ?>
										<?php while($row = $query->fetch_assoc()): ?>
										<tr>
												<td><?=$no++?></td>
												<td><?=$row['nama']?></td>
												<td><?=$row['nama_mobil']?></td>
												<td><?=$row['no_mobil']?></td>
												<td><?=$row['tgl_sewa']?></td>
												<td><?=($row['tgl_ambil']) ? $row['tgl_ambil'] : "<b>Belum Diambil</b>" ?></td>
												<td><?=($row['tgl_kembali']) ? $row['tgl_kembali'] : "<b>Belum Dikembalikan</b>" ?></td>
												<td><?=$row['lama']?> Hari</td>
												<td>Rp.<?=number_format($row['total_harga'])?>,-</td>
												<td>
														<div class="btn-group">
															<?php if (!$row["tgl_ambil"]): ?>
																<a href="?page=lap_perperiode&action=ambil&key=<?=$row['id_transaksi']?>" class="btn btn-success btn-xs">Ambil</a>
															<?php endif; ?>
															<?php if ($row["tgl_ambil"]): ?>
																<a href="?page=lap_perperiode&action=kembali&key=<?=$row['id_transaksi']?>" class="btn btn-primary btn-xs <?=($row["tgl_kembali"]) ? "disabled" : ""?>">Dikembalikan</a>
															<?php endif; ?>
														</div>
												</td>
										</tr>
										<?php endwhile ?>
								<?php endif ?>
						</tbody>
				</table>
		</div>
	</div>
<?php endif; ?>
