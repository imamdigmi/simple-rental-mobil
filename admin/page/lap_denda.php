	<div class="panel panel-info">
		<div class="panel-heading"><h3 class="text-center">LAPORAN DENDA</h3></div>
		<div class="panel-body">
				<table class="table table-condensed">
						<thead>
								<tr>
										<th>No</th>
										<th>Nama Pelanggan</th>
										<th>Total Harga</th>
										<th>Denda</th>
								</tr>
						</thead>
						<tbody>
								<?php $no = 1; ?>
								<?php if ($query = $connection->query("SELECT p.nama, t.total_harga, t.denda FROM transaksi t JOIN pelanggan p USING(id_pelanggan) WHERE t.denda != 0")): ?>
										<?php while($row = $query->fetch_assoc()): ?>
										<tr>
												<td><?=$no++?></td>
												<td><?=$row['nama']?></td>
												<td>Rp.<?=number_format($row['total_harga'])?>,-</td>
												<td>Rp.<?=number_format($row['denda'])?>,-</td>
										</tr>
										<?php endwhile ?>
								<?php endif ?>
						</tbody>
				</table>
		</div>
	</div>
