<div class="container">
	<div class="page-header">
		<h2>Mobil <small>data mobil!</small></h2>
	</div>
	<?php $query = $connection->query("SELECT * FROM mobil"); while ($row = $query->fetch_assoc()): ?>
		<div class="col-xs-6 col-md-3">
	    <a href="assets/img/<?=$row['gambar']?>" class="thumbnail fancybox">
	      <img src="assets/img/<?=$row['gambar']?>" alt="<?=$row['judul']?>">
	    </a>
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
