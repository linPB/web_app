CREATE DATABASE IF NOT EXISTS `webman` DEFAULT CHARACTER SET utf8;

USE `webman`;

/*Table structure for table `admin_permission` */

DROP TABLE IF EXISTS `admin_permission`;

CREATE TABLE `admin_permission` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(100) NOT NULL COMMENT '权限名',
`path` varchar(100) NOT NULL COMMENT '路由',
`type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型，''1''菜单,''2''操作',
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_r_p` */

DROP TABLE IF EXISTS `admin_r_p`;

CREATE TABLE `admin_r_p` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`role_id` int(11) NOT NULL COMMENT '角色id',
`permission_id` int(11) NOT NULL COMMENT '权限id',
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_role` */

DROP TABLE IF EXISTS `admin_role`;

CREATE TABLE `admin_role` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`role_name` varchar(100) NOT NULL DEFAULT '' COMMENT '角色名',
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_u_r` */

DROP TABLE IF EXISTS `admin_u_r`;

CREATE TABLE `admin_u_r` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户id',
`role_id` int(11) NOT NULL COMMENT '角色id',
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `admin_user` */

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
`password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
`phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机',
`email` varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱',
`avatar_url` varchar(255) NOT NULL DEFAULT '' COMMENT '头像地址',
`login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
`last_login_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最近登陆时间',
`last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最近登陆ip',
`created_at` datetime NOT NULL COMMENT '创建时间',
`updated_at` datetime NOT NULL COMMENT '更新时间',
PRIMARY KEY (`id`),
UNIQUE KEY `mail` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Table structure for table `amdin_menu` */

DROP TABLE IF EXISTS `amdin_menu`;

CREATE TABLE `amdin_menu` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级菜单id',
`permission_id` int(11) NOT NULL COMMENT '权限id',
`sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序id',
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `smp_region_game` */

DROP TABLE IF EXISTS `smp_region_game`;

CREATE TABLE `smp_region_game` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`game_name` varchar(50) NOT NULL DEFAULT '' COMMENT '游戏名',
`game_mark` varchar(50) NOT NULL DEFAULT '' COMMENT '游戏简写',
`region_name` varchar(50) NOT NULL DEFAULT '' COMMENT '地区名',
`region_mark` varchar(50) NOT NULL DEFAULT '' COMMENT '地区简写',
`web_url` varchar(255) NOT NULL DEFAULT '' COMMENT '后台同步url',
`jump_url` varchar(255) NOT NULL DEFAULT '' COMMENT '生成的后台跳转url',
`sort` smallint(4) NOT NULL DEFAULT '0' COMMENT '排序',
`db_name` varchar(255) NOT NULL DEFAULT '' COMMENT '数据库名',
`exchange_rate` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '汇率配比，单位%',
`is_sync` smallint(1) NOT NULL DEFAULT '0' COMMENT 'erlang是否同步',
`status` smallint(1) NOT NULL DEFAULT '0' COMMENT '后台是否开启调用游戏接口',
`created_at` varchar(19) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`nick_name` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
`password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
`user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
`phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机',
`mail` varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱',
`login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
`login_time` datetime NOT NULL COMMENT '最近登陆时间',
`created_at` datetime NOT NULL COMMENT '创建时间',
`updated_at` datetime NOT NULL COMMENT '更新时间',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
