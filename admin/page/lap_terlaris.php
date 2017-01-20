	<div class="panel panel-info">
		<div class="panel-heading"><h3 class="text-center">LAPORAN PENYEWAAN TERLARIS</h3></div>
		<div class="panel-body">
				<table class="table table-condensed">
						<thead>
								<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Nomor</th>
										<th>Merk</th>
										<th>Total Penyewa</th>
								</tr>
						</thead>
						<tbody>
								<?php $no = 1; ?>
								<?php if ($query = $connection->query("SELECT m.no_mobil, m.merk, m.nama_mobil, (SELECT COUNT(*) FROM transaksi WHERE id_mobil=t.id_mobil) AS jml FROM transaksi t JOIN mobil m USING(id_mobil) GROUP BY t.id_mobil")): ?>
										<?php while($row = $query->fetch_assoc()): ?>
										<tr>
												<td><?=$no++?></td>
												<td><?=$row['nama_mobil']?></td>
												<td><?=$row['no_mobil']?></td>
												<td><?=$row['merk']?></td>
												<td><?=$row['jml']?></td>
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
