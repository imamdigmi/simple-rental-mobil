<?php
if (!isset($_SESSION["pelanggan"])) {
  header('location: login.php');
}
?>
  <div class="panel panel-info">
    <div class="panel-heading"><h3 class="text-center">Detail Transaksi</h3></div>
    <div class="panel-body">
      <table class="table table-hover">
          <tbody>
							<?php $query = $connection->query("SELECT t.id_transaksi, m.nama_mobil, t.lama, t.jaminan, t.total_harga, t.tgl_sewa, t.tgl_ambil, t.tgl_kembali, t.jatuh_tempo, t.status, t.konfirmasi, t.pembatalan FROM transaksi t JOIN pelanggan p USING(id_pelanggan) JOIN mobil m ON t.id_mobil=m.id_mobil WHERE id_transaksi=$_GET[id]");?>
							<?php while ($r = $query->fetch_assoc()): ?>
								<tr>
									<th>Mobil</th>
									<td>: <?=$r['nama_mobil']?></td>
								</tr>
								<tr>
									<th>Lama</th>
									<td>: <?=$r['lama']?> Hari</td>
								</tr>
								<tr>
									<th>Jaminan</th>
									<td>: <?=$r['jaminan']?></td>
								</tr>
								<tr>
									<th>Total</th>
									<td>: Rp.<?=number_format($r['total_harga'])?>,-</td>
								</tr>
								<tr>
									<th>Tanggal Sewa</th>
									<td>: <?=date("d-m-Y H:i:s", strtotime($row['tgl_sewa']))?></td>
								</tr>
								<tr>
									<th>Tanggal Ambil</th>
									<td>: <?=($r['tgl_ambil']) ? date("d-m-Y H:i:s", strtotime($r['tgl_ambil'])) : "<b>Belum</b>"?></td>
								</tr>
								<tr>
									<th>Tanggal Kembali</th>
									<td>: <?=($r['tgl_kembali']) ? date("d-m-Y H:i:s", strtotime($r['tgl_kembali'])) : "<b>Belum</b>"?></td>
								</tr>
								<tr>
									<th>Jatuh Tempo</th>
									<td>: <?=date("d-m-Y H:i:s", strtotime($r['jatuh_tempo']))?></td>
								</tr>
								<tr>
									<th>Konfirmasi</th>
									<td>: <span class="label label-<?=($r['konfirmasi']) ? "success" : "danger"?>"><?=($r['konfirmasi']) ? "Sudah" : "Belum"?></span></td>
								</tr>
								<tr>
									<th>Kembali</th>
									<td>: <span class="label label-<?=($r['status']) ? "success" : "danger"?>"><?=($r['status']) ? "Sudah" : "Belum"?></span></td>
								</tr>
								<tr>
									<th>Pembatalan</th>
									<td>: <span class="label label-<?=($r['pembatalan']) ? "danger" : "success"?>"><?=($r['pembatalan']) ? "Ya" : "Tidak"?></span></td>
								</tr>
								<tr class="hidden-print">
									<th></th>
									<td> &nbsp;
    								<?php if (!$r['konfirmasi']): ?>
                      <a href="?page=konfirmasi&id=<?= $r['id_transaksi'] ?>" class="btn btn-primary">Konfirmasi Sekarang</a>
                    <?php endif ?>
                    <?php if ($r['konfirmasi'] == 1 AND $r['tgl_kembali'] == NULL AND $r["pembatalan"] != 1): ?>
                      <a href="?page=perpanjang&id=<?= $r['id_transaksi'] ?>" class="btn btn-success">Perpanjang Sekarang</a>
                    <?php endif ?>
									</td>
								</tr>
							<?php endwhile; ?>
          </tbody>
      </table>
    </div>
    <div class="panel-footer hidden-print ">
        <a onClick="window.print();return false" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
    </div>
</div>
