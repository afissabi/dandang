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

 Date: 15/03/2022 16:21:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES (1, 'Master', '1', NULL, NULL, '1', 2, 'fab fa-buffer', '/master', '2022-02-01 14:58:37', NULL, NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (2, 'Menu', '4', 1, 11, '1', 1, NULL, '/master/hak-akses/menu', '2022-02-11 15:01:12', '2022-03-02 08:08:28', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (3, 'Dashboard', '0', NULL, NULL, '1', 1, 'fas fa-chalkboard', '/dashboard', '2022-02-14 10:14:03', '2022-02-16 04:06:11', NULL, 1, NULL, NULL);
INSERT INTO `m_menu` VALUES (4, 'Role User', '4', 1, 11, '1', 2, NULL, 'master/hak-akses/role-user', '2022-02-14 08:51:01', '2022-02-25 09:02:01', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (7, 'Menu Ho', '0', NULL, NULL, '1', 4, NULL, '/master/menuho', '2022-02-16 02:27:50', '2022-02-16 02:28:29', '2022-02-16 02:28:29', NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (8, 'Menu Ho', '2', 1, NULL, '1', 4, NULL, '/master/menuho', '2022-02-16 04:08:27', '2022-02-16 04:08:38', '2022-02-16 04:08:38', NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (9, 'Menu Coba', '0', NULL, NULL, '1', 7, NULL, '/master/menuho', '2022-02-16 04:09:17', '2022-02-16 04:09:39', '2022-02-16 04:09:39', NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (10, 'User', '4', 1, 11, '1', 3, NULL, 'master/hak-akses/user', '2022-02-16 06:25:09', '2022-02-24 04:04:04', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (11, 'Hak Akses', '3', 1, NULL, '1', 1, 'fa fa-fingerprint', '/hak-akses', '2022-02-24 03:39:51', '2022-02-24 04:02:46', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (12, 'Menu Ho', '0', NULL, NULL, '1', 3, 'fas fa-chalkboard', '/dashboard/ho', '2022-02-25 07:09:14', '2022-02-25 07:13:32', '2022-02-25 07:13:32', NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (13, 'Keuangan', '5', NULL, NULL, '1', 2, 'fad fa-money-bill-wave', 'keuangan', '2022-03-15 07:37:45', '2022-03-15 07:45:00', NULL, NULL, NULL, NULL);
INSERT INTO `m_menu` VALUES (14, 'Pemasukan', '6', 13, NULL, '1', 1, NULL, 'keuangan/pemasukan', '2022-03-15 07:45:57', '2022-03-15 07:45:57', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_menu_user
-- ----------------------------
DROP TABLE IF EXISTS `m_menu_user`;
CREATE TABLE `m_menu_user`  (
  `id_menu_user` bigint NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_menu_user
-- ----------------------------
INSERT INTO `m_menu_user` VALUES (1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (2, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (3, 1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (4, 1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (5, 1, 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (6, 1, 11, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (7, 1, 12, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (8, 1, 13, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_menu_user` VALUES (9, 1, 14, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'Admin', 'Admin Aplikasi', '1', '2022-02-16 11:47:34', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (2, 'User', 'User Aplikasi', '1', '2022-02-16 06:22:54', '2022-02-16 06:23:05', '2022-02-16 06:23:05', NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (3, 'User Iku', 'User Aplikasi', '1', '2022-02-16 06:23:11', '2022-02-16 06:23:48', '2022-02-16 06:23:48', NULL, NULL, NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` time NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 'Testing', 'testing', '$2y$10$MyOX7gXGa4ugkmgWa7NkuexnbK3z59H1OP4kOGk7I1oIQWvH146cm', '1', '2022-02-11 14:31:39', NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
