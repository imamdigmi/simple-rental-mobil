-- Query untuk menampilkan denda perhari/pertanggal
SELECT
  a.id_transaksi,
  (DATEDIFF(a.tgl_kembali, DATE_ADD(a.tgl_ambil, INTERVAL a.lama DAY))) AS hari,
  35000 * (DATEDIFF(a.tgl_kembali, DATE_ADD(a.tgl_ambil, INTERVAL a.lama DAY))) AS denda
FROM transaksi a
WHERE tgl_kembali <> ''


-- Query untuk menmpilkan denda perjam
SELECT
  a.id_transaksi,
  35000 * (TIMESTAMPDIFF(HOUR, ADDDATE(a.tgl_ambil, INTERVAL a.lama DAY), a.tgl_kembali)) AS denda
FROM transaksi a
WHERE tgl_kembali <> ''

-- nampilin 3 tabel(pelanggan yg batal transaksi)
SELECT p.nama, t.pembatalan, t.tgl_sewa, m.nama_mobil 
FROM pelanggan p JOIN transaksi t USING(id_pelanggan) JOIN mobil m USING(id_mobil) 
WHERE pembatalan='0'

-- query utk menampilkan nama supir pelanggan tertentu (4tabel)
SELECT pelanggan.nama, transaksi.tgl_sewa, detail_transaksi.jasa_supir, supir.nama 
FROM pelanggan JOIN transaksi ON pelanggan.id_pelanggan = transaksi.id_pelanggan 
JOIN detail_transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi 
JOIN supir ON detail_transaksi.id_supir = supir.id_supir 
WHERE pelanggan.nama = 'Telolet' 

-- dg USING (g pake inisial)
SELECT pelanggan.nama, transaksi.tgl_sewa, detail_transaksi.jasa_supir, supir.nama 
FROM pelanggan  JOIN transaksi USING (id_pelanggan)
JOIN detail_transaksi USING(id_transaksi)
JOIN supir USING (id_supir)
WHERE pelanggan.nama = 'Telolet'

SELECT p.nama, t.tgl_sewa, d.jasa_supir, s.nama 
FROM pelanggan p JOIN transaksi t USING (id_pelanggan) 
JOIN detail_transaksi d USING(id_transaksi) 
JOIN supir s USING (id_supir) WHERE p.nama = 'Telolet' 

