<form class="form-inline hidden-print" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
	<label>Periode</label>
	<input type="text" class="form-control" name="start">
	<label>s/d</label>
	<input type="text" class="form-control" name="stop">
	<button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
</form>
<br>
<?php if ($_POST): ?>
<div class="panel panel-info">
		<div class="panel-heading"><h3 class="text-center">LAPORAN PELANGGAN DENDA TERBANYAK PERPERIODE</h3></div>
		<div class="panel-body">
				<table class="table table-condensed">
						<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Jumlah</th>
								</tr>
						</thead>
						<tbody>
								<?php $no = 1; ?>
								<?php if ($query = $connection->query("SELECT p.nama, (SELECT COUNT(t.id_transaksi)) AS jumlah FROM transaksi t JOIN pelanggan p USING(id_pelanggan) WHERE t.denda <> '' AND t.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")): ?>
										<?php while($row = $query->fetch_assoc()): ?>
										<tr>
											<td><?=$no++?></td>
											<td><?=$row['nama']?></td>
											<td><?=$row['jumlah']?></td>
										</tr>
										<?php endwhile ?>
								<?php endif ?>
						</tbody>
				</table>
		</div>
    <div class="panel-footer hidden-print">
        <a onClick="window.print();return false" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
    </div>
</div>
<?php endif; ?>