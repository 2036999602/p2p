INSERT INTO `z_menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES (1, '会员管理', NULL, NULL, 1, NULL);
INSERT INTO `z_menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES (2, '会员列表', 1, '/admin/index/user-index', 2, 0x24636C6173733D227375626D656E75223B);
INSERT INTO `z_menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES (3, '增加会员', 1, '/admin/index/user-add', 3, 0x24636C6173733D227375626D656E75223B);
INSERT INTO `z_menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES (4, '企业管理', NULL, NULL, 4, NULL);
INSERT INTO `z_menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES (5, '企业列表', 4, '/admin/index/cooperation-index', 5, NULL);
