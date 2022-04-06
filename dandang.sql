/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : dandang

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 06/04/2022 15:10:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_about
-- ----------------------------
DROP TABLE IF EXISTS `m_about`;
CREATE TABLE `m_about`  (
  `id_about` int NOT NULL,
  `type` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '0=Tentang Kami, 1=Visi, 2=Misi',
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` timestamp NULL DEFAULT NULL,
  `updated_by` timestamp NULL DEFAULT NULL,
  `deleted_by` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_about`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic STATS_AUTO_RECALC = 0;

-- ----------------------------
-- Records of m_about
-- ----------------------------

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu`  (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '0=Tunggal, 1=parent, 2=child_parent, 3=sub_parent, 4=child_sub_parent',
  `parent_id` int NULL DEFAULT NULL,
  `sub_parent_id` int NULL DEFAULT NULL,
  `is_aktif` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '0=Tidak Aktif, 1=Aktif',
  `urutan` int NULL DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint NULL DEFAULT NULL,
  `updated_by` bigint NULL DEFAULT NULL,
  `deleted_by` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES (1, 'Master', '1', NULL, NULL, '1', 2, 'fab fa-buffer', '/master', '2022-02-01 14:58:37', NULL, NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (2, 'Menu', '4', 1, 11, '1', 1, NULL, '/master/hak-akses/menu', '2022-02-11 15:01:12', '2022-03-02 08:08:28', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (3, 'Dashboard', '0', NULL, NULL, '1', 1, 'fas fa-chalkboard', '/dashboard', '2022-02-14 10:14:03', '2022-02-16 04:06:11', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (4, 'Role User', '4', 1, 11, '1', 2, NULL, 'master/hak-akses/role-user', '2022-02-14 08:51:01', '2022-02-25 09:02:01', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (7, 'Menu Ho', '0', NULL, NULL, '1', 4, NULL, '/master/menuho', '2022-02-16 02:27:50', '2022-02-16 02:28:29', '2022-02-16 02:28:29', 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (8, 'Menu Ho', '2', 1, NULL, '1', 4, NULL, '/master/menuho', '2022-02-16 04:08:27', '2022-02-16 04:08:38', '2022-02-16 04:08:38', 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (9, 'Menu Coba', '0', NULL, NULL, '1', 7, NULL, '/master/menuho', '2022-02-16 04:09:17', '2022-02-16 04:09:39', '2022-02-16 04:09:39', 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (10, 'User', '4', 1, 11, '1', 3, NULL, 'master/hak-akses/user', '2022-02-16 06:25:09', '2022-02-24 04:04:04', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (11, 'Hak Akses', '3', 1, NULL, '1', 1, 'fa fa-fingerprint', '/hak-akses', '2022-02-24 03:39:51', '2022-02-24 04:02:46', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (12, 'Menu Ho', '0', NULL, NULL, '1', 3, 'fas fa-chalkboard', '/dashboard/ho', '2022-02-25 07:09:14', '2022-02-25 07:13:32', '2022-02-25 07:13:32', 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (13, 'Keuangan', '5', NULL, NULL, '1', 3, 'far fa-money-bill-alt', 'keuangan', '2022-03-15 07:37:45', '2022-03-16 00:44:27', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (14, 'Pemasukan', '6', 13, NULL, '1', 1, NULL, 'keuangan/pemasukan', '2022-03-15 07:45:57', '2022-03-15 07:45:57', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (15, 'Klinik', '3', 1, NULL, '1', 2, 'fa fa-hospital', 'master/klinik', '2022-03-19 21:42:08', '2022-03-20 17:13:30', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (16, 'Barang', '2', 1, NULL, '1', 4, 'fa fa-box', 'master/barang', '2022-03-19 21:57:30', '2022-03-19 21:59:14', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (17, 'Pegawai', '3', 1, NULL, '1', 3, 'fa fa-users', 'master/pegawai', '2022-03-19 21:59:05', '2022-03-20 16:17:47', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (18, 'jabatan', '4', 1, 17, '1', 1, NULL, 'master/pegawai/jabatan', '2022-03-19 22:05:44', '2022-03-20 16:18:12', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (19, 'Data Pasien', '3', 1, NULL, '1', 6, 'fa fa-user', 'master/data-pasien', '2022-03-19 22:15:26', '2022-03-20 17:22:47', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (20, 'Status Klinik', '4', 1, 15, '1', 1, NULL, 'master/klinik/status', '2022-03-20 17:14:20', '2022-03-20 17:14:20', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (21, 'Data Klinik', '4', 1, 15, '1', 2, NULL, 'master/klinik/daftar', '2022-03-20 17:14:48', '2022-03-20 17:14:48', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (22, 'Rekanan', '3', 1, NULL, '1', 4, 'fas fa-american-sign-language-interpreting', 'master/rekanan', '2022-03-20 17:17:05', '2022-03-22 00:35:33', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (23, 'Laboratorium', '4', 1, 22, '1', 1, NULL, 'master/rekanan/laboratorium', '2022-03-20 17:18:32', '2022-03-20 17:18:32', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (24, 'Apotik', '4', 1, 22, '1', 2, NULL, 'master/rekanan/apotik', '2022-03-20 17:18:47', '2022-03-20 17:18:47', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (25, 'Data Pegawai', '4', 1, 17, '1', 2, NULL, 'master/pegawai/data', '2022-03-20 17:21:52', '2022-03-20 17:21:52', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (26, 'Setting No. RM', '4', 1, 19, '1', 1, NULL, 'master/data-pasien/no-rm', '2022-03-20 17:23:41', '2022-03-20 17:23:41', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (27, 'Data Pasien', '4', 1, 19, '1', 2, NULL, 'master/data-pasien/', '2022-03-20 17:24:08', '2022-03-20 17:24:08', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (28, 'Kasir', '0', NULL, NULL, '1', 4, 'fa fa-calculator', 'kasir', '2022-03-20 17:28:18', '2022-03-20 17:28:18', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (29, 'Devisi', '4', 1, 15, '1', 3, NULL, 'master/klinik/devisi', '2022-03-22 00:41:29', '2022-03-22 00:41:29', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (30, 'CMS Website', '1', NULL, NULL, '1', 4, 'fas fa-chalkboard', 'cms-website', '2022-04-06 04:48:04', '2022-04-06 04:48:04', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (31, 'Tentang Kami', '2', 30, NULL, '1', 1, 'fas fa-quote-left', '/cms-website/tentang-kami', '2022-04-06 04:49:59', '2022-04-06 06:38:55', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_menu_user
-- ----------------------------
DROP TABLE IF EXISTS `m_menu_user`;
CREATE TABLE `m_menu_user`  (
  `id_menu_user` bigint NOT NULL AUTO_INCREMENT,
  `id_menu` int NULL DEFAULT NULL,
  `id_role` int NULL DEFAULT NULL,
  `create_btn` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `edit_btn` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete_btn` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_menu_user
-- ----------------------------
INSERT INTO `m_menu_user` VALUES (1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (4, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (5, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (6, 11, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (7, 12, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (8, 13, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (10, 14, 1, NULL, NULL, NULL, '2022-03-17 08:09:00', '2022-03-17 08:09:00', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (11, 13, 4, NULL, NULL, NULL, '2022-03-17 08:26:31', '2022-03-17 08:26:31', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (12, 14, 4, NULL, NULL, NULL, '2022-03-17 08:26:32', '2022-03-17 08:26:32', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (13, 15, 1, NULL, NULL, NULL, '2022-03-19 21:50:32', '2022-03-19 21:50:32', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (14, 16, 1, NULL, NULL, NULL, '2022-03-19 21:57:50', '2022-03-19 21:57:50', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (15, 17, 1, NULL, NULL, NULL, '2022-03-19 21:59:26', '2022-03-19 21:59:26', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (16, 18, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (17, 19, 1, NULL, NULL, NULL, '2022-03-19 22:15:37', '2022-03-19 22:15:37', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (18, 20, 1, NULL, NULL, NULL, '2022-03-20 17:15:34', '2022-03-20 17:15:34', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (19, 21, 1, NULL, NULL, NULL, '2022-03-20 17:15:35', '2022-03-20 17:15:35', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (20, 22, 1, NULL, NULL, NULL, '2022-03-20 17:17:31', '2022-03-20 17:17:31', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (21, 23, 1, NULL, NULL, NULL, '2022-03-20 17:20:24', '2022-03-20 17:20:24', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (22, 24, 1, NULL, NULL, NULL, '2022-03-20 17:20:24', '2022-03-20 17:20:24', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (23, 25, 1, NULL, NULL, NULL, '2022-03-20 17:24:41', '2022-03-20 17:24:41', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (24, 26, 1, NULL, NULL, NULL, '2022-03-20 17:24:41', '2022-03-20 17:24:41', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (25, 27, 1, NULL, NULL, NULL, '2022-03-20 17:24:41', '2022-03-20 17:24:41', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (26, 28, 1, NULL, NULL, NULL, '2022-03-20 17:28:28', '2022-03-20 17:28:28', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (27, 29, 1, NULL, NULL, NULL, '2022-03-22 00:41:44', '2022-03-22 00:41:44', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (28, 30, 1, NULL, NULL, NULL, '2022-04-06 04:48:21', '2022-04-06 04:48:21', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (29, 31, 1, NULL, NULL, NULL, '2022-04-06 04:50:16', '2022-04-06 04:50:16', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role`  (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_aktif` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint NULL DEFAULT NULL,
  `updated_by` bigint NULL DEFAULT NULL,
  `deleted_by` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'Admin', 'Admin Aplikasi', '1', '2022-02-16 11:47:34', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (2, 'User', 'User Aplikasi', '1', '2022-02-16 06:22:54', '2022-02-16 06:23:05', '2022-02-16 06:23:05', NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (3, 'User Iku', 'User Aplikasi', '1', '2022-02-16 06:23:11', '2022-02-16 06:23:48', '2022-02-16 06:23:48', NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (4, 'Admin Keuangan', 'Untuk Cek Keuangan', '1', '2022-03-17 08:23:25', '2022-03-17 08:23:25', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_status
-- ----------------------------
DROP TABLE IF EXISTS `m_status`;
CREATE TABLE `m_status`  (
  `id_status` int NOT NULL,
  `nama_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_status
-- ----------------------------

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id_user` bigint NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_aktif` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '0=Tidak Aktif, 1=Aktif',
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `password_old` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `see_password_old` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `see_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 'Testing', 'testing', '$2y$10$MyOX7gXGa4ugkmgWa7NkuexnbK3z59H1OP4kOGk7I1oIQWvH146cm', '1', 1, '2022-02-11 14:31:39', NULL, NULL, NULL, NULL, NULL, '$2y$10$MyOX7gXGa4ugkmgWa7NkuexnbK3z59H1OP4kOGk7I1oIQWvH146cm', '728uql', '728uql');
INSERT INTO `m_user` VALUES (2, 'Wahyu', 'wahyu', '$2y$10$JrTYxI5cqiEITgJByDIlZu3CZjnL4x7KLX6ajRgYTsrDUOEh2lIPe', '1', 4, '2022-03-17 08:32:05', '2022-03-17 08:32:05', NULL, NULL, NULL, NULL, '$2y$10$wcmsWNQ74TvcBcTGMeVMEOJ0BBj6/F.NKgME5ikI9OoNwPtGieFW.', '123456', '123456');

SET FOREIGN_KEY_CHECKS = 1;
