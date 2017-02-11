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
			<div class="panel-heading"><h3 class="text-center">LAPORAN DENDA</h3><h4 class="text-center">tgl: <?=$_POST['start']?> s/d <?=$_POST['stop']?></h4></div>
			<div class="panel-body">
					<table class="table table-condensed">
							<thead>
									<tr>
											<th>No</th>
											<th>Nama Pelanggan</th>
											<th>Tanggal Ambil</th>
											<th>Tanggal Kembali</th>
											<th>Terlambat</th>
											<th>Total Harga</th>
											<th>Denda</th>

									</tr>
							</thead>
							<tbody>
									<?php $no = 1; ?>
									<?php if ($query = $connection->query("SELECT p.nama, t.total_harga, t.denda, t.tgl_sewa, t.tgl_ambil, t.tgl_kembali, (TIMESTAMPDIFF(HOUR, ADDDATE(t.tgl_ambil, INTERVAL t.lama DAY), t.tgl_kembali)) AS terlambat FROM transaksi t JOIN pelanggan p USING(id_pelanggan) WHERE t.denda != 0 AND t.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")): ?>
											<?php while($row = $query->fetch_assoc()): ?>
											<tr>
													<td><?=$no++?></td>
													<td><?=$row['nama']?></td>
													<td><?=date("d-m-Y H:i:s", strtotime($row['tgl_ambil']))?></td>
													<td><?=date("d-m-Y H:i:s", strtotime($row['tgl_kembali']))?></td>
													<td><?=$row['terlambat']?> jam</td>
													<td>Rp.<?=number_format($row['total_harga'])?>,-</td>
													<td>Rp.<?=number_format($row['denda'])?>,-</td>
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
