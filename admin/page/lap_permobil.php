	<form class="form-inline" action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
		<select class="form-control" name="id_mobil">
			<option>---</option>
			<?php $query = $connection->query("SELECT * FROM mobil"); while ($r = $query->fetch_assoc()): ?>
				<option value="<?=$r["id_mobil"]?>"><?=$r["nama_mobil"]?> | <?=$r["no_mobil"]?></option>
			<?php endwhile; ?>
		</select>
		<button type="submit" class="btn btn-primary">Tampilkan</button>
	</form>
	<br>
	<?php if ($_POST): ?>
	  <div class="panel panel-info">
	    <div class="panel-heading"><h3 class="text-center">LAPORAN PENYEWAAN PERMOBIl</h3></div>
	    <div class="panel-body">
	        <table class="table table-condensed">
	            <thead>
	                <tr>
	                    <th>No</th>
	                    <th>Nama Pelanggan</th>
	                    <th>Nomor Mobil</th>
	                    <th>Nama Mobil</th>
	                    <th>Merk</th>
	                    <th>Harga Sewa</th>
	                    <th></th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php $no = 1; ?>
	                <?php if ($query = $connection->query("SELECT b.nama, d.no_mobil, d.nama_mobil, d.merk, d.harga FROM transaksi a JOIN pelanggan b USING(id_pelanggan) JOIN mobil d USING(id_mobil) WHERE d.id_mobil=$_POST[id_mobil]")): ?>
	                    <?php while($row = $query->fetch_assoc()): ?>
	                    <tr>
	                        <td><?=$no++?></td>
													<td><?=$row['nama']?></td>
													<td><?=$row['no_mobil']?></td>
													<td><?=$row['nama_mobil']?></td>
													<td><?=$row['merk']?></td>
													<td><?=$row['harga']?></td>
	                    </tr>
	                    <?php endwhile ?>
	                <?php endif ?>
	            </tbody>
	        </table>
	    </div>
	  </div>
	<?php endif; ?>
