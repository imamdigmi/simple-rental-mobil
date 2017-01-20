<div class="row">
  <div class="panel panel-info">
      <div class="panel-heading"><h3 class="text-center">LAPORAN KONFIRMASI</h3></div>
      <div class="panel-body">
          <table class="table table-condensed">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Tgl Sewa</th>
                      <th>Total Harga</th>
                      <th class="hidden-print"></th>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = 1; ?>
                  <?php if ($query = $connection->query("SELECT * FROM transaksi JOIN pelanggan USING(id_pelanggan) JOIN konfirmasi USING(id_transaksi)")): ?>
                      <?php while($row = $query->fetch_assoc()): ?>
                      <tr>
                          <td><?=$no++?></td>
													<td><?=$row['nama']?></td>
													<td><?=$row['tgl_sewa']?></td>
													<td><?=$row['total_harga']?></td>
                          <td class="hidden-print">
														<a  href="../assets/img/bukti/<?=$row['bukti']?>" class="btn btn-info btn-xs fancybox">Lihat Bukti</a>
                          </td>
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
</div>

<script type="text/javascript">
$(document).ready(function(){
	$(".fancybox").fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		iframe : {
			preload: false
		}
	});
	$(".various").fancybox({
		maxWidth    : 800,
		maxHeight    : 600,
		fitToView    : false,
		width        : '70%',
		height        : '70%',
		autoSize    : false,
		closeClick    : false,
		openEffect    : 'none',
		closeEffect    : 'none'
	});
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
});
</script>
