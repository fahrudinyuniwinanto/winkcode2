/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : winkcode2

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 07/05/2021 15:47:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for instansi
-- ----------------------------
DROP TABLE IF EXISTS `instansi`;
CREATE TABLE `instansi`  (
  `id_instansi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_instansi` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_instansi` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kepala_instansi` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `no_telp` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `update_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `isactive` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_instansi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 390 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of instansi
-- ----------------------------
INSERT INTO `instansi` VALUES (365, '48', 'SMK NEGERI 5 KENDAL', 'AGUS BASUKI', 'Jalan Raya Bogosari, Tambahrejo, Pageruyung, Bogosari, Tambahrejo, Kabupaten Kendal, Jawa Tengah 51361', '(0294) 451581', 1, 1, '2018-08-20 08:55:48', '2018-08-20 08:55:48', 1);
INSERT INTO `instansi` VALUES (366, '49', 'AL FATH MUSLIM LIFESTYLE', 'John Doe', 'Ruko Mall Ciputra no. C 26 dan 27 Simpang Lima Semarang', '(024) 8440812', 1, 1, '2018-08-20 09:05:07', '2018-08-20 09:05:07', 1);
INSERT INTO `instansi` VALUES (367, '50', 'INSTITUT TRANSPORTASI DAN LOGISTIK TRISAKTI', 'Dr. Ir Tjuk Sukardiman, M.Si', 'Jl. IPN Kebon Nanas No.2, RT.9/RW.6, Cipinang Besar Sel., Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13410', '(021) 8516050', 1, 1, '2018-08-21 14:35:03', '2018-08-21 14:35:03', 1);
INSERT INTO `instansi` VALUES (368, '51', 'DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN CILACAP', 'Drs. M. Wijaya, MM', 'Jl. Sindoro No.36, Cilacap, Sidanegara, Cilacap Tengah, Kabupaten Cilacap, Jawa Tengah 53212', '(0282) 5563111', 1, 1, '2018-08-27 11:32:38', '2018-08-27 11:32:38', 1);
INSERT INTO `instansi` VALUES (369, '52', 'KEMENTERIAN DALAM NEGERI REPUBLIK INDONESIA', 'Tjahjo Kumolo', 'Jalan Medan Merdeka Utara No. 7 Jakarta Pusat 10110 DKI Jakarta', '(021) 3450038', 1, 1, '2018-08-28 13:52:07', '2018-08-28 13:52:07', 1);
INSERT INTO `instansi` VALUES (370, '53', 'PEMBERDAYAAN DAN KESEJAHTERAAN KELUARGA (PKK) KAB TEMANGGUNG', 'Dra. Ny. Hj. SRI KUSDIYANTI SUDARYANTO, MM', 'Jl. Jend. A. Yani No. 32 Temanggung', '(0293) 491004', 1, 1, '2018-08-30 08:16:54', '2018-08-30 08:16:54', 1);

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id_kat` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `for_modul` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (9, 'ISLAM', NULL, 'AGAMA');
INSERT INTO `kategori` VALUES (10, 'KRISTEN', '', 'AGAMA');
INSERT INTO `kategori` VALUES (11, 'HINDU', NULL, 'AGAMA');
INSERT INTO `kategori` VALUES (12, 'A', NULL, 'GOLDAR');
INSERT INTO `kategori` VALUES (13, 'B', NULL, 'GOLDAR');
INSERT INTO `kategori` VALUES (14, 'AB', NULL, 'GOLDAR');
INSERT INTO `kategori` VALUES (15, 'O', NULL, 'GOLDAR');

-- ----------------------------
-- Table structure for konsultasi
-- ----------------------------
DROP TABLE IF EXISTS `konsultasi`;
CREATE TABLE `konsultasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_telepon` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `skpd` int(3) NULL DEFAULT NULL,
  `permasalahan` int(3) NULL DEFAULT NULL,
  `uraian_permasalahan` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `isactive` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of konsultasi
-- ----------------------------

-- ----------------------------
-- Table structure for master_access
-- ----------------------------
DROP TABLE IF EXISTS `master_access`;
CREATE TABLE `master_access`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nm_access` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of master_access
-- ----------------------------
INSERT INTO `master_access` VALUES (1, 'M_USERS', 'MENU USER', '0000-00-00 00:00:00', 0);
INSERT INTO `master_access` VALUES (4, 'M_LAPORAN', 'MENU LAPORAN', NULL, NULL);
INSERT INTO `master_access` VALUES (5, 'M_SY_CONFIG', 'MENU SISTEM', '0000-00-00 00:00:00', 0);
INSERT INTO `master_access` VALUES (16, 'M_SY_CONFIG', '', '2019-06-12 07:48:03', 1);
INSERT INTO `master_access` VALUES (102, 'M_MUTASI_D', '', '2020-03-04 06:02:56', 1);
INSERT INTO `master_access` VALUES (103, 'M_BERANDA', '', '2021-05-07 09:50:48', 1);
INSERT INTO `master_access` VALUES (104, 'M_KONSULTASI', '', '2021-05-07 09:51:08', 1);
INSERT INTO `master_access` VALUES (105, 'M_BERTEMU', '', '2021-05-07 09:51:14', 1);
INSERT INTO `master_access` VALUES (106, 'M_DITANYAKAN', '', '2021-05-07 09:51:20', 1);
INSERT INTO `master_access` VALUES (107, 'M_PERMASALAHAN', '', '2021-05-07 14:34:40', 1);
INSERT INTO `master_access` VALUES (108, 'C_PERMASALAHAN', '', '2021-05-07 14:34:45', 1);
INSERT INTO `master_access` VALUES (109, 'R_PERMASALAHAN', '', '2021-05-07 14:34:50', 1);
INSERT INTO `master_access` VALUES (110, 'U_PERMASALAHAN', '', '2021-05-07 14:34:56', 1);
INSERT INTO `master_access` VALUES (111, 'D_PERMASALAHAN', '', '2021-05-07 14:35:02', 1);

-- ----------------------------
-- Table structure for permasalahan
-- ----------------------------
DROP TABLE IF EXISTS `permasalahan`;
CREATE TABLE `permasalahan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permasalahan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type` int(3) NULL DEFAULT NULL COMMENT 'jika masalah akan dikategorikan',
  `note` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `isactive` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permasalahan
-- ----------------------------
INSERT INTO `permasalahan` VALUES (1, 'TEMPAT PARKIR TIDAK MEMADAHI', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `permasalahan` VALUES (2, 'ASN DATANG TERLAMBAT', 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for sy_config
-- ----------------------------
DROP TABLE IF EXISTS `sy_config`;
CREATE TABLE `sy_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `conf_val` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sy_config
-- ----------------------------
INSERT INTO `sy_config` VALUES (3, 'APP_NAME', 'Winkcode 2 Framework', '');
INSERT INTO `sy_config` VALUES (8, 'OPD_NAME', 'Peternak Kode', '');
INSERT INTO `sy_config` VALUES (9, 'LEFT_FOOTER', '<strong>Copyright</strong> <a href=\"youtube.com/peternakkode\" target=\"_blank\">Peternak Kode</a>  © 2020', '');
INSERT INTO `sy_config` VALUES (10, 'RIGHT_FOOTER', 'Peternak Kode Channel', '');
INSERT INTO `sy_config` VALUES (11, 'APP_DESC', 'Codeigniter 3 + AngularJs', '-');
INSERT INTO `sy_config` VALUES (12, 'OPD_ADDR', 'Peternak Kode', '');
INSERT INTO `sy_config` VALUES (13, 'VISI_MISI', 'Lets show what code can do', '');
INSERT INTO `sy_config` VALUES (14, 'APP_TELP', '089636xxx456', '');
INSERT INTO `sy_config` VALUES (15, 'APP_EMAIL', ' fahrudinyewe@gmail.com', '');
INSERT INTO `sy_config` VALUES (16, 'APP_FB', 'https://www.facebook.com', '');
INSERT INTO `sy_config` VALUES (17, 'APP_TWITTER', 'https://twitter.com', '');
INSERT INTO `sy_config` VALUES (18, 'APP_IG', 'https://instagram.com', '');

-- ----------------------------
-- Table structure for user_access
-- ----------------------------
DROP TABLE IF EXISTS `user_access`;
CREATE TABLE `user_access`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NULL DEFAULT NULL,
  `kd_access` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_access` varbinary(100) NULL DEFAULT NULL,
  `is_allow` int(1) NULL DEFAULT NULL COMMENT '0=false,1=true',
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 188 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_access
-- ----------------------------
INSERT INTO `user_access` VALUES (5, 2, '1', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (8, 1, '1', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (9, 3, '5', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (10, 3, '1', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (11, 3, '3', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (12, 4, '4', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (13, 1, '2', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (14, 1, '3', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (15, 1, '4', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (16, 1, '5', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (17, 1, '6', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (18, 3, '4', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (19, 2, '5', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (20, 4, '5', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (21, 4, '6', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (22, 3, '2', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (23, 4, '2', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (24, 1, '7', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (25, 1, '8', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (26, 1, '9', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (27, 1, '10', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (28, 5, '10', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (29, 5, '9', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (30, 2, '2', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (31, 2, '3', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (32, 1, '14', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (33, 2, '14', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (34, 1, '12', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (35, 2, '12', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (36, 1, '13', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (37, 1, '11', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (38, 5, '3', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (39, 5, '2', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (40, 2, '8', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (41, 2, '9', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (42, 3, '6', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (43, 3, '7', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (44, 3, '8', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (45, 3, '9', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (46, 3, '10', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (47, 3, '11', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (48, 3, '12', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (49, 3, '13', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (50, 4, '3', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (51, 4, '8', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (52, 4, '9', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (53, 5, '15', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (54, 1, '15', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (55, 1, '16', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (56, 6, '2', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (57, 6, '3', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (58, 6, '4', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (59, 6, '8', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (60, 6, '9', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (61, 6, '14', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (62, 6, '15', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (63, 5, '16', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (64, 5, '17', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (65, 5, '18', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (66, 5, '19', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (67, 5, '21', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (68, 6, '18', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (69, 1, '17', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (70, 1, '18', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (71, 1, '19', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (72, 1, '21', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (73, 1, '22', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (74, 2, '22', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (75, 6, '22', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (76, 5, '4', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (77, 5, '8', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (78, 5, '22', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (79, 2, '4', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (80, 1, '23', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (81, 1, '24', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (82, 1, '25', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (83, 1, '26', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (84, 1, '27', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (85, 1, '28', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (86, 1, '29', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (87, 1, '30', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (88, 1, '31', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (89, 1, '32', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (90, 1, '33', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (91, 1, '34', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (92, 1, '35', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (93, 2, '24', NULL, 0, NULL);
INSERT INTO `user_access` VALUES (94, 1, '36', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (95, 1, '37', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (96, 1, '38', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (97, 1, '39', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (98, 1, '40', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (99, 1, '41', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (100, 1, '42', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (101, 1, '43', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (102, 1, '44', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (103, 1, '45', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (104, 1, '46', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (105, 1, '50', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (106, 1, '49', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (107, 1, '48', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (108, 1, '47', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (109, 1, '51', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (110, 1, '52', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (111, 1, '53', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (112, 1, '54', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (113, 1, '55', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (114, 2, '56', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (115, 2, '57', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (116, 2, '58', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (117, 2, '59', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (118, 2, '60', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (119, 1, '56', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (120, 1, '57', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (121, 1, '58', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (122, 1, '59', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (123, 1, '60', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (124, 2, '61', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (125, 2, '62', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (126, 2, '63', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (127, 2, '64', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (128, 2, '65', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (129, 1, '61', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (130, 1, '62', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (131, 1, '63', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (132, 1, '64', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (133, 1, '65', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (134, 1, '66', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (135, 1, '67', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (136, 1, '68', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (137, 1, '69', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (138, 1, '70', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (139, 1, '71', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (140, 1, '72', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (141, 1, '73', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (142, 1, '74', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (143, 1, '75', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (144, 1, '76', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (145, 1, '77', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (146, 1, '78', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (147, 1, '79', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (148, 1, '80', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (149, 1, '81', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (150, 1, '82', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (151, 1, '83', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (152, 1, '84', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (153, 1, '85', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (154, 1, '86', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (155, 1, '87', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (156, 1, '88', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (157, 1, '89', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (158, 1, '90', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (159, 1, '91', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (160, 1, '92', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (161, 1, '93', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (162, 1, '94', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (163, 3, '95', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (164, 4, '96', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (165, 5, '98', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (166, 6, '99', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (167, 7, '100', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (168, 1, '95', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (169, 1, '96', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (170, 1, '97', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (171, 1, '98', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (172, 1, '99', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (173, 1, '100', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (174, 1, '101', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (175, 1, '102', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (176, 5, '97', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (177, 2, '46', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (178, 2, '85', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (179, 1, '106', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (180, 1, '105', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (181, 1, '104', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (182, 1, '103', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (183, 1, '107', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (184, 1, '108', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (185, 1, '109', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (186, 1, '110', NULL, 1, NULL);
INSERT INTO `user_access` VALUES (187, 1, '111', NULL, 1, NULL);

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES (1, 'Developer', '-', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');
INSERT INTO `user_group` VALUES (2, 'Administrator', '-', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_group` int(11) NULL DEFAULT NULL COMMENT 'fk dari tabel user_group',
  `foto` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `note_1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `ip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Developer', 'dev', '227edf7c86c02a44d17eec9aa5b30cd1', 'dev@email.com', 1, 'a4.jpg', '085643242654', 'full akses', 1, 1, '2018-03-13 03:06:55', '2020-04-03 09:50:11', '', '', '2019-08-27 20:12:45');
INSERT INTO `users` VALUES (2, 'Administrator', 'sekretaris', '6ad14ba9986e3615423dfca256d04e3f', 'fahrudinyewe@gmail.com', 2, 'a4.jpg', '085643242656', 'Verifikasi', 1, 1, '2018-03-13 03:06:55', '2019-08-18 14:25:27', '', '', '2019-08-27 20:12:45');

SET FOREIGN_KEY_CHECKS = 1;
