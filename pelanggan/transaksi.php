<div class="panel panel-info">
    <div class="panel-heading"><h3 class="text-center">Sewa</h3></div>
    <div class="panel-body">
        <form action="?page=selesai" method="POST">
            <input type="hidden" name="id_mobil" value="<?=$_GET["id"]?>">
            <div class="form-group">
                <label for="lama">Lama Sewa</label>
                <select name="lama" class="form-control">
										<?php for ($i=1; $i<=7; $i++): ?>
											<option value="<?=$i?>"><?=$i?> Hari</option>
										<?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Pakai supir?</label>
                <?php $query = $connection->query("SELECT id_supir FROM supir WHERE status='1' LIMIT 1"); if ($query->num_rows == 0): ?>
                  <input type="text" class="form-control" disabled value="Maaf saat ini supir belum tersedia...">
                  <input type="hidden" name="status" value="0">
                <?php else: ?>
                  <select name="status" class="form-control">
                      <option value="1">Ya</option>
                      <option value="0">Tidak</option>
                  </select>
               <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="jaminan">Jaminan</label>
                <select name="jaminan" class="form-control">
                    <option value="STNK">STNK</option>
                    <option value="Sertifikat Rumah">Sertifikat Rumah</option>
                </select>
            </div>
            <button type="submit" class="btn btn-info btn-block">Bayar!</button>
        </form>
    </div>
</div>
