//nd_cases_chatuser表添加语言字段
ALTER TABLE `nd_cases_chatuser`
ADD COLUMN `language`  int(11) NOT NULL DEFAULT 1 COMMENT '//1为中文简体 2为中文繁体 3为英文' AFTER `idnumber`;

//nd_cases_chatuser表添加字段
ALTER TABLE `nd_cases_chatuser`
ADD COLUMN `start_time`  date NULL AFTER `language`;
ALTER TABLE `nd_cases_chatuser`
ADD COLUMN `stop_time`  date NULL AFTER `start_time`;
ALTER TABLE `nd_cases_chatuser`
ADD COLUMN `change_content`  text NULL AFTER `stop_time`;


//nd_cases_company表添加字段
ALTER TABLE `nd_cases_company`
ADD COLUMN `default`  text NULL COMMENT '//默认' AFTER `type`;


//nd_cases_case表添加字段
ALTER TABLE `nd_cases_case`
ADD COLUMN `ks_type`  int(11) NOT NULL DEFAULT 1 COMMENT '//科室' AFTER `options`;

//nd_cases_company表添加字段
ALTER TABLE `nd_cases_company`
ADD COLUMN `abbreviation`  varchar(10) NULL AFTER `default`;
ALTER TABLE `nd_cases_company`
ADD COLUMN `apiid`  varchar(100) NULL COMMENT '//公司api Id' AFTER `abbreviation`,
ADD COLUMN `apipwd`  varchar(255) NULL COMMENT '//公司API密码' AFTER `apiid`;


//新建表
CREATE TABLE `nd_cases_chatuser_ks` (
`id`  int(10) NOT NULL AUTO_INCREMENT COMMENT '//id' ,
`user_id`  int(10) NOT NULL COMMENT 'casemanagerid' ,
`ks_id`  int(10) NOT NULL COMMENT '//科室id',
`status`  int(2) NOT NULL DEFAULT 1 COMMENT '//状态' ,
PRIMARY KEY (`id`)
)
;


//预约信息表
DROP TABLE IF EXISTS `nd_appointment_info`;
CREATE TABLE `nd_appointment_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '预约信息表id',
  `phone` varchar(255) NOT NULL COMMENT '联系电话',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `advisory_details` text NOT NULL COMMENT '咨询内容简介',
  `time_qid` int(11) NOT NULL COMMENT '关联预约时间段id',
  `submitdate` varchar(255) NOT NULL DEFAULT '' COMMENT '预约日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;



//webex预约视频表
DROP TABLE IF EXISTS `nd_appointment_meeting`;
CREATE TABLE `nd_appointment_meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'webex预约视频表 id',
  `meetmeetingkey` varchar(255) NOT NULL COMMENT '会议id',
  `hostmeetingurl` text NOT NULL COMMENT '主持人开会地址  ',
  `joinmeetingurl` text NOT NULL COMMENT '加会地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


//预约时间段表
DROP TABLE IF EXISTS `nd_appointment_time_quantum`;
CREATE TABLE `nd_appointment_time_quantum` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '预约时间段表 id',
  `time_quantum` time NOT NULL COMMENT '时间段',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;



//添加表字段
ALTER TABLE `nd_cases_chatuser`
ADD COLUMN `workid`  int(10) NOT NULL DEFAULT 0 COMMENT '//casemanager额外信息id' AFTER `u_status`;

//添加语言表
CREATE TABLE `nd_cases_lang` (
`id`  int(10) NOT NULL AUTO_INCREMENT COMMENT '//语言编号' ,
`l_name`  varchar(255) NOT NULL COMMENT '//语言名称' ,
`sort`  int(10) NOT NULL COMMENT '//语言排序' ,
PRIMARY KEY (`id`)
)
;
//添加语言和用户关联中间表
CREATE TABLE `nd_cases_chatuser_lang` (
`id`  int(10) NOT NULL AUTO_INCREMENT COMMENT '//语言中间表id' ,
`lang_id`  int(10) NOT NULL ,
`user_id`  int(10) NOT NULL COMMENT '//用户id' ,
PRIMARY KEY (`id`)
)
;

ALTER TABLE `nd_cases_lang`
ADD COLUMN `l_ename`  varchar(255) NOT NULL COMMENT '//英文名称' AFTER `id`;

//加入国家简称
ALTER TABLE `nd_cases_country`
ADD COLUMN `abbreviation`  char(4) NOT NULL COMMENT '//简称' AFTER `sort`;
//加入国家英文名称
ALTER TABLE `nd_cases_country`
ADD COLUMN `ename`  varchar(255) NOT NULL DEFAULT '' COMMENT '//英文名称' AFTER `abbreviation`;

ALTER TABLE `nd_cases_case`
ADD COLUMN `e_province`  varchar(255) NULL COMMENT '//国外州/省' AFTER `ks_type`;
