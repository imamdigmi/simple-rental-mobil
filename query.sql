CREATE TABLE admin (
	id_admin INT(4) AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nama VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL,
	alamat VARCHAR(50) NOT NULL,
	telp VARCHAR(12) NOT NULL,
	username VARCHAR(15) NOT NULL,
	password VARCHAR(32) NOT NULL
);

CREATE TABLE pelanggan (
	id_pelanggan INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	no_ktp CHAR(16) NOT NULL,
	nama VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL,
	no_telp CHAR(12) NOT NULL,
	alamat VARCHAR(50),
	username VARCHAR(10) NOT NULL,
	password VARCHAR(32) NOT NULL
);

CREATE TABLE jenis (
	id_jenis INT(4) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	nama VARCHAR(30) NOT NULL
);

CREATE TABLE mobil (
	id_mobil INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	id_jenis INT(4) NOT NULL,
	no_mobil VARCHAR(10) NOT NULL,
	nama_mobil VARCHAR(30) NOT NULL,
	gambar VARCHAR(100) NOT NULL,
	harga INT(7) NOT NULL,
	status ENUM("0", "1") NOT NULL,
	FOREIGN KEY fk_jenis(id_jenis) REFERENCES jenis(id_jenis) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE supir (
	id_supir INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nama VARCHAR(30) NOT NULL,
	no_telp CHAR(12) NOT NULL,
	alamat VARCHAR(50) NOT NULL,
	status ENUM("0", "1") NOT NULL
);

CREATE TABLE transaksi (
	id_transaksi INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_pelanggan INT NOT NULL,
	tgl_sewa DATETIME NOT NULL,
	tgl_kembali DATETIME NOT NULL,
	total_har INT(7) NOT NULL,
	status ENUM("0", "1") NOT NULL,
	jaminan VARCHAR(30) NOT NULL,
	denda INT(7),
	jatuh_tempo DATETIME NOT NULL,
	FOREIGN KEY fk_pelanggan(id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE detail_transaksi (
	id_detail INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_transaksi INT NOT NULL,
	id_mobil INT NOT NULL,
	id_supir INT NOT NULL,
	FOREIGN KEY fk_transaksi(id_transaksi) REFERENCES transaksi(id_transaksi) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY fk_mobil(id_mobil) REFERENCES mobil(id_mobil) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY fk_supir(id_supir) REFERENCES supir(id_supir) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE konfirmasi (
	id_konfirmasi INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	id_transaksi INT NOT NULL,
	status ENUM("0", "1") NOT NULL,
	FOREIGN KEY fk_transaksi(id_transaksi) REFERENCES transaksi(id_transaksi) ON UPDATE CASCADE ON DELETE CASCADE
);
