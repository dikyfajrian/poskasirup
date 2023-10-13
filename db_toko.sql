/*
 Navicat Premium Data Transfer

 Source Server         : mahasiswa
 Source Server Type    : MySQL
 Source Server Version : 100425
 Source Host           : localhost:3306
 Source Schema         : db_toko

 Target Server Type    : MySQL
 Target Server Version : 100425
 File Encoding         : 65001

 Date: 22/01/2023 10:59:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `merk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_beli` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_jual` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `satuan_barang` int(11) NOT NULL,
  `f_delete` int(11) NULL DEFAULT 0,
  `tgl_input` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_update` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES (1, 'BR001', 1, 'pulpen', 'faster', '5000', '7000', 1, 0, '4 January 2023, 22:44', NULL);
INSERT INTO `barang` VALUES (2, 'BR002', 2, 'minyak goreng', 'bimoli', '10000', '15000', 1, 0, '4 January 2023, 22:45', NULL);
INSERT INTO `barang` VALUES (3, 'BR003', 3, 'meja belajar', 'ikea', '200000', '230000', 4, 0, '4 January 2023, 22:46', '4 January 2023, 23:18');
INSERT INTO `barang` VALUES (5, 'BR004', 2, 'ice cream', 'ice', '5000', '7500', 1, 0, '14 January 2023, 8:47', NULL);
INSERT INTO `barang` VALUES (6, 'BR005', 2, 'zcxad', 'asdad', '222', '222', 3, 0, '14 January 2023, 8:48', NULL);
INSERT INTO `barang` VALUES (7, 'BR006', 2, 'kkkk', 'kkkk', '999', '999', 2, 1, '14 January 2023, 8:49', NULL);
INSERT INTO `barang` VALUES (8, 'BR007', 2, 'VIT Gelas', 'Danone', '999', '999', 2, 0, '14 January 2023, 8:49', '14 January 2023, 9:05');

-- ----------------------------
-- Table structure for gudang
-- ----------------------------
DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'pembelian, rusak, kadaluarsa',
  `no_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `hitung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'ditambah, dikurang',
  `id_barang` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int(25) NULL DEFAULT NULL,
  `id_supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tgl_input` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gudang
-- ----------------------------
INSERT INTO `gudang` VALUES (1, 'pembelian', '0', 'in', 'BR001', 100, 'SP001', NULL, '2023-01-04 10:45:02');
INSERT INTO `gudang` VALUES (2, 'pembelian', '0', 'in', 'BR002', 100, 'SP002', NULL, '2023-01-04 10:46:03');
INSERT INTO `gudang` VALUES (3, 'pembelian', '0', 'in', 'BR003', 100, 'SP003', NULL, '2023-01-04 10:47:07');
INSERT INTO `gudang` VALUES (4, 'rusak', '0', 'out', 'BR003', 10, 'SP003', NULL, '2023-01-04 11:18:30');
INSERT INTO `gudang` VALUES (5, 'pembelian', '0', 'in', 'BR003', 10, 'SP003', NULL, '2023-01-04 11:18:59');
INSERT INTO `gudang` VALUES (6, 'pembelian', '0', 'in', 'BR004', 3, 'SP002', NULL, '2023-01-05 12:42:48');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `f_delete` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'ATK', '4 January 2023, 22:29', 0);
INSERT INTO `kategori` VALUES (2, 'Sembako', '4 January 2023, 22:29', 0);
INSERT INTO `kategori` VALUES (3, 'Furniture', '4 January 2023, 22:29', 0);
INSERT INTO `kategori` VALUES (4, 'Makanan', '14 January 2023, 9:11', 0);
INSERT INTO `kategori` VALUES (5, 'Minuman', '14 January 2023, 9:11', 0);
INSERT INTO `kategori` VALUES (6, 'Alat Listrik', '14 January 2023, 9:15', 0);

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES (1, 'Admin');
INSERT INTO `level` VALUES (2, 'Kasir');

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `nama_profile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` char(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` int(11) NOT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `f_delete` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id_login`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES (1, 'Dandy', 'admin', '654321', 1, '16740817342020-04-18.jpg', '0838', 'dandy@dah.ta', 'jl raya', 0);
INSERT INTO `login` VALUES (4, 'Zarkasih', 'kasir', '123', 2, 'unnamed1.jpg', '0878', NULL, 'jl tol', 0);

-- ----------------------------
-- Table structure for nota
-- ----------------------------
DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota`  (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_member` int(11) NOT NULL,
  `jumlah` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_input` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `periode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_nota`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_in
-- ----------------------------
DROP TABLE IF EXISTS `order_in`;
CREATE TABLE `order_in`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'pembelian/bonus',
  `id_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_beli` decimal(11, 2) NULL DEFAULT NULL,
  `harga_jual` decimal(11, 2) NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `discount_qty` decimal(11, 2) NULL DEFAULT NULL,
  `discount_order` decimal(11, 2) NULL DEFAULT NULL,
  `harga_total` decimal(11, 2) NULL DEFAULT NULL,
  `pengirim` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `f_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'unpaid',
  `f_delete` int(11) NULL DEFAULT 0,
  `tanggal_input` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_in
-- ----------------------------
INSERT INTO `order_in` VALUES (1, '0001-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR004', 5000.00, 7500.00, 200, 0.00, 0.00, 1000000.00, 'SP001', '', 'paid', 0, '2023-01-19 08:58:21');
INSERT INTO `order_in` VALUES (2, '0001-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR001', 5000.00, 7000.00, 200, 0.00, 0.00, 1000000.00, 'SP001', '', 'paid', 0, '2023-01-19 08:58:21');
INSERT INTO `order_in` VALUES (3, '0001-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR003', 200000.00, 230000.00, 200, 0.00, 0.00, 40000000.00, 'SP001', '', 'paid', 0, '2023-01-19 08:58:21');
INSERT INTO `order_in` VALUES (4, '0002-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR007', 999.00, 999.00, 200, 99.00, 154000.00, 26000.00, 'SP003', 'pembelian 2', 'paid', 0, '2023-01-19 09:00:08');
INSERT INTO `order_in` VALUES (5, '0002-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR005', 222.00, 222.00, 200, 22.00, 154000.00, -114000.00, 'SP003', 'pembelian 2', 'paid', 0, '2023-01-19 09:00:08');
INSERT INTO `order_in` VALUES (6, '0002-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR004', 5000.00, 7500.00, 60, 0.00, 154000.00, 146000.00, 'SP003', 'pembelian 2', 'paid', 0, '2023-01-19 09:00:08');
INSERT INTO `order_in` VALUES (7, '0002-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR002', 10000.00, 15000.00, 100, 0.00, 154000.00, 846000.00, 'SP003', 'pembelian 2', 'paid', 0, '2023-01-19 09:00:08');
INSERT INTO `order_in` VALUES (8, '0002-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR001', 5000.00, 7000.00, 50, 0.00, 154000.00, 96000.00, 'SP003', 'pembelian 2', 'paid', 0, '2023-01-19 09:00:08');
INSERT INTO `order_in` VALUES (9, '0003-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR003', 200000.00, 230000.00, 100, 0.00, 500000.00, 19500000.00, 'SP002', 'pembelian 3', 'paid', 0, '2023-01-19 09:01:05');
INSERT INTO `order_in` VALUES (10, '0003-PEM-19-01-23', '2023-01-19', 'pembelian', 'BR002', 10000.00, 15000.00, 100, 0.00, 500000.00, 500000.00, 'SP002', 'pembelian 3', 'paid', 0, '2023-01-19 09:01:05');
INSERT INTO `order_in` VALUES (13, '0004-PEM-22-01-23', '2023-01-22', 'pembelian', 'BR005', 222.00, 222.00, 200, 22.00, 20000.00, 20000.00, 'SP003', 'pembelian yang ke 4', 'paid', 0, '2023-01-22 10:06:20');
INSERT INTO `order_in` VALUES (14, '0004-PEM-22-01-23', '2023-01-22', 'pembelian', 'BR004', 5000.00, 7500.00, 50, 0.00, 20000.00, 230000.00, 'SP003', 'pembelian yang ke 4', 'paid', 0, '2023-01-22 10:06:20');

-- ----------------------------
-- Table structure for order_out
-- ----------------------------
DROP TABLE IF EXISTS `order_out`;
CREATE TABLE `order_out`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'penjualan/retur/rusak/hilang',
  `id_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_beli` decimal(11, 2) NULL DEFAULT NULL,
  `harga_jual` decimal(11, 2) NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `discount_qty` decimal(11, 2) NULL DEFAULT NULL,
  `discount_order` decimal(11, 2) NULL DEFAULT NULL,
  `harga_total` decimal(11, 2) NULL DEFAULT NULL,
  `penerima` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `f_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'paid',
  `f_delete` int(11) NULL DEFAULT 0,
  `tanggal_input` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_out
-- ----------------------------
INSERT INTO `order_out` VALUES (1, '0001-INV-19-01-23', '2023-01-19', 'penjualan', 'BR003', 200000.00, 230000.00, 100, 0.00, 116666.67, 22883333.33, '0000', 'penjualan 1', 'paid', 0, '2023-01-19 08:27:07');
INSERT INTO `order_out` VALUES (2, '0001-INV-19-01-23', '2023-01-19', 'penjualan', 'BR004', 5000.00, 7500.00, 20, 500.00, 116666.67, 23333.33, '0000', 'penjualan 1', 'paid', 0, '2023-01-19 08:27:07');
INSERT INTO `order_out` VALUES (3, '0001-INV-19-01-23', '2023-01-19', 'penjualan', 'BR004', 5000.00, 7500.00, 30, 500.00, 116666.67, 93333.33, '0000', 'penjualan 1', 'paid', 0, '2023-01-19 08:27:07');
INSERT INTO `order_out` VALUES (4, '0002-INV-19-01-23', '2023-01-19', 'penjualan', 'BR004', 5000.00, 7500.00, 10, 0.00, 12500.00, 62500.00, '0000', 'penjualan 2', 'paid', 0, '2023-01-19 08:29:26');
INSERT INTO `order_out` VALUES (5, '0002-INV-19-01-23', '2023-01-19', 'penjualan', 'BR001', 5000.00, 7000.00, 50, 0.00, 12500.00, 337500.00, '0000', 'penjualan 2', 'paid', 0, '2023-01-19 08:29:26');
INSERT INTO `order_out` VALUES (6, '0001-OUT-19-01-23', '2023-01-19', 'rusak', 'BR005', 222.00, 222.00, 200, 22.00, 45000.00, -5000.00, 'SP001', 'rusak 1', 'paid', 0, '2023-01-19 09:42:37');
INSERT INTO `order_out` VALUES (7, '0001-OUT-19-01-23', '2023-01-19', 'rusak', 'BR004', 5000.00, 7500.00, 50, 500.00, 45000.00, 180000.00, 'SP001', 'rusak 1', 'paid', 0, '2023-01-19 09:42:37');

-- ----------------------------
-- Table structure for satuan
-- ----------------------------
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_input` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `f_delete` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of satuan
-- ----------------------------
INSERT INTO `satuan` VALUES (1, 'PCS', NULL, 0);
INSERT INTO `satuan` VALUES (2, 'BOTOL', NULL, 0);
INSERT INTO `satuan` VALUES (3, 'PACK', NULL, 0);
INSERT INTO `satuan` VALUES (4, 'UNIT', NULL, 0);
INSERT INTO `satuan` VALUES (5, 'SACHET', '14 January 2023, 9:23', 0);

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_input` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_update` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `f_delete` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'SP001', 'PT AA', 'jl Pedurenan Mesjid 2', '(021) 7577895', 'Supplier Sembako', '4 January 2023, 22:27', '10 January 2023, 16:25', 0);
INSERT INTO `supplier` VALUES (2, 'SP002', 'PT Hanjaya Mandala Sampoerna Tbk', 'Jl. Rungkut Industri Raya No. 18 Surabaya, Jawa Timur', '(021) 5151234', 'Supplier Rokok', '4 January 2023, 22:28', '10 January 2023, 16:20', 0);
INSERT INTO `supplier` VALUES (3, 'SP003', 'PT. Aice Ice Cream', 'The Suites Tower, Lt. 18 Jl. Boulevard Pantai Indah Kapuk No.1 Penjaringan', '(021) 22511112', 'Supplier Ice Cream', '4 January 2023, 22:28', '10 January 2023, 16:31', 0);
INSERT INTO `supplier` VALUES (5, 'SP004', 'PT ABC', 'jl bukit duri tanjakan', '0838', 'Distributor Air Mineral', '14 January 2023, 7:01', '14 January 2023, 7:02', 1);

-- ----------------------------
-- Table structure for toko
-- ----------------------------
DROP TABLE IF EXISTS `toko`;
CREATE TABLE `toko`  (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_toko` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tlp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pemilik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `f_delete` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id_toko`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of toko
-- ----------------------------
INSERT INTO `toko` VALUES (1, 'SRC ICO', 'JL. PEDURENAN MASJID 4 02/04 NO.40,  SETIABUDI, JAKARTA SELATAN', '081228283811', 'Muhammad Shodri', 0);

SET FOREIGN_KEY_CHECKS = 1;
