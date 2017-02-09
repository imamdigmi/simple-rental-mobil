<div class="page-header">
	<h2>Monggo</small></h2>
</div>
<div class="row">
	<?php $query = $connection->query("SELECT * FROM mobil JOIN jenis USING(id_jenis)"); while ($row = $query->fetch_assoc()): ?>
		<div class="col-xs-6 col-md-3">
			<div class="thumbnail">
				<a href="assets/img/mobil/<?=$row['gambar']?>" class="fancybox">
				<img src="assets/img/mobil/<?=$row['gambar']?>" style="height:250px; width:100%" alt="<?=$row['judul']?>">
			</a>
	      <div class="caption text-center">
	        <h4><?=$row["nama_mobil"]?></h4>
	        <h5>Rp.<?=$row["harga"]?>,- <?=$row["nama"]?> - <?=$row["merk"]?></h5>
	        <h6><?=$row["no_mobil"]?></h6>
			<span class="label label-<?=($row['status']) ? "success" : "danger" ?>"><?=($row['status']) ? "Tersedia" : "Tidak Tersedia" ?></span>
	        <p>
				<br>
				<a href="<?=($row['status']) ? "?page=transaksi&id=$row[id_mobil]" : "#" ?>" class="btn btn-primary" <?=($row['status']) ?: "disabled" ?>>Sewa Sekarang!</a>
			</p>
	      </div>
	    </div>
	  </div>
	<?php endwhile; ?>
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
