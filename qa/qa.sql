/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : qa

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2018-02-04 16:50:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `answer`
-- ----------------------------
DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL COMMENT '题目ID',
  `option` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '选项',
  `is_right` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否正确',
  `create_user_id` int(11) NOT NULL COMMENT '添加管理员ID',
  `update_user_id` int(11) NOT NULL COMMENT '更新管理员ID',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of answer
-- ----------------------------
INSERT INTO `answer` VALUES ('1', '1', '火箭', '0', '1', '1', '2018-02-04 16:28:59', '2018-02-04 16:28:59', null);
INSERT INTO `answer` VALUES ('2', '1', '骑士', '0', '1', '1', '2018-02-04 16:29:07', '2018-02-04 16:29:07', null);
INSERT INTO `answer` VALUES ('3', '1', '巴萨', '1', '1', '1', '2018-02-04 16:29:24', '2018-02-04 16:29:39', null);
INSERT INTO `answer` VALUES ('4', '1', '勇士', '0', '1', '1', '2018-02-04 16:29:31', '2018-02-04 16:29:31', null);
INSERT INTO `answer` VALUES ('5', '2', '火箭', '1', '1', '1', '2018-02-04 16:36:54', '2018-02-04 16:36:54', null);
INSERT INTO `answer` VALUES ('6', '2', '湖人', '0', '1', '1', '2018-02-04 16:37:04', '2018-02-04 16:37:04', null);
INSERT INTO `answer` VALUES ('7', '2', '大鲨鱼', '0', '1', '1', '2018-02-04 16:37:14', '2018-02-04 16:37:14', null);
INSERT INTO `answer` VALUES ('8', '2', '勇士', '0', '1', '1', '2018-02-04 16:38:05', '2018-02-04 16:38:05', null);

-- ----------------------------
-- Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `author` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', 'Kelsi Thiel', 'Nihil amet qui officia necessitatibus est incidunt quia modi exercitationem similique aperiam possim', 'Voluptas dolorem qui ratione voluptatibus officiis aut. Qui fugiat voluptatibus sit. Commodi qui rerum non reiciendis voluptatem eveniet aut.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('2', 'Alek Shields', 'Non architecto quia magni architecto sed quidem in.', 'Commodi magnam rerum tempora nihil. Voluptatem voluptas et cumque. Quas reprehenderit provident placeat quae.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('3', 'Mr. Oswaldo Pacocha Jr.', 'Totam optio veniam eligendi officiis quidem nihil at possimus nisi illo.', 'Architecto et repellat excepturi perferendis corporis nostrum dignissimos. Repellendus consequuntur dolore distinctio consequatur adipisci. Quis possimus harum laborum ea fugiat.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('4', 'Dr. Tatyana West Sr.', 'Ea velit earum commodi ea libero aut voluptatem explicabo.', 'Itaque consectetur a vitae suscipit impedit ea. Eius est consequuntur quaerat quo dolores laboriosam sunt. Sit quisquam totam sit dolores rem.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('5', 'Mr. Khalil Hettinger MD', 'Commodi delectus autem assumenda quos consequatur blanditiis dolores modi magnam est sint magni.', 'Nostrum consequuntur harum exercitationem ipsa beatae officia impedit corrupti. Quibusdam natus possimus ducimus minus similique est. Fuga ut quibusdam soluta similique.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('6', 'Dakota Kuphal IV', 'Animi sunt dolorem suscipit voluptas est illum voluptas qui.', 'Odit rerum accusamus qui quos vero. Quaerat harum unde ut velit quia nihil. Ut facilis ea doloremque odit soluta error in.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('7', 'Dylan Gibson Jr.', 'Sunt et voluptatem rerum ex exercitationem sint laboriosam repudiandae praesentium aut iure.', 'Nesciunt tempora aliquam et quia dolor. Est minus id voluptas autem modi necessitatibus ratione voluptas.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('8', 'Corine Sipes', 'Minima nihil nobis deleniti temporibus aspernatur non temporibus illo molestiae.', 'Et delectus assumenda ad. Reprehenderit fugiat ipsum autem est consequatur non necessitatibus.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('9', 'Yadira Deckow', 'Qui unde culpa itaque a eaque molestiae quo id quidem.', 'Nam perferendis sit qui id reiciendis. Quos quasi ipsa mollitia occaecati earum adipisci. Corrupti suscipit sapiente qui aut maxime libero rerum. Sit et atque est accusantium.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('10', 'Logan Mraz Sr.', 'Quod sit qui sunt officia repellendus ut qui vitae autem.', 'Tenetur magni similique assumenda. Nemo quaerat culpa sit veritatis est dignissimos. Fugit aut voluptates a ipsum. Maiores et modi veritatis velit excepturi ex.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('11', 'Miss Judy Mills V', 'Porro esse vel reprehenderit sed tempore sint expedita sint vel at.', 'Sunt temporibus et ipsam similique incidunt aliquam consequatur. Architecto voluptas quos quasi quaerat et. Officia dolor quis et iure quos.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('12', 'Mrs. Velva Schaefer III', 'Repellendus sequi quaerat exercitationem dolores neque at aut quis sit et et.', 'Eius error optio minus praesentium non. Iste itaque voluptas eum a sequi autem. Doloremque voluptatum fuga vel iure nesciunt exercitationem. Voluptates fugiat ipsam maxime cumque est nam accusamus.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('13', 'Mitchell Wiegand', 'Ipsam est illo et vero officiis amet facere maxime aut quisquam.', 'Expedita exercitationem et qui pariatur est iste asperiores. Aut voluptatem sunt eligendi est sit consequatur tempora. Provident est et quas quis eius architecto.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('14', 'Cortez Hackett', 'Eos eius doloremque quia quasi quisquam rem veniam.', 'Aspernatur ut soluta voluptate et. Ut illum laborum harum quam est. Vero maiores assumenda assumenda et suscipit est fugit. Sunt assumenda laborum cum doloremque.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('15', 'Jewel Hickle II', 'Consequuntur provident voluptatem omnis nihil possimus minus cum nesciunt blanditiis optio.', 'Rerum possimus quas qui autem reprehenderit aut. Sed voluptatem illo quibusdam rerum et ea et earum. Laboriosam tempora autem nisi fugit quos fugiat.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('16', 'Hans Dickinson', 'Repudiandae voluptates id sit quod consequatur dolor quas eius veritatis dolorem sed.', 'Temporibus magnam hic quam et quaerat facilis est. Magni dolores cupiditate vel ducimus in. Temporibus explicabo beatae sed sit nemo quod quos.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('17', 'Mikel Herman II', 'Quia qui asperiores et eum doloremque nulla voluptatibus.', 'Sunt distinctio illo repellendus possimus. Occaecati est unde qui suscipit ratione atque. Quibusdam voluptas voluptas ut est voluptas quae dicta cum.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('18', 'Elda Collier PhD', 'Id nesciunt quo saepe et iusto tenetur officia eum magnam sit et omnis quos.', 'Accusamus minima minima qui praesentium quas. Saepe dolorum eveniet velit quia repudiandae maxime optio. Eos voluptas autem dicta quibusdam et. Est eius et eum enim ut rerum iure.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('19', 'Ms. Emmy Bashirian', 'Temporibus et occaecati qui veniam deleniti molestiae autem.', 'Voluptate qui itaque sint corporis. Et autem omnis qui alias ratione dignissimos earum. Magnam aut esse aut.', '5', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('20', 'Miss Macy Donnelly', 'Id quaerat enim expedita ut est dolor.', 'Et culpa aut ad rerum incidunt. Voluptatem doloremque pariatur sed ab distinctio qui. Voluptatem qui dolor vitae dolorum quam.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('21', 'Ms. Julia Towne', 'Similique excepturi ratione cupiditate esse officiis eligendi recusandae fuga.', 'Sed aut aspernatur et. Eum id eos consequatur consequatur molestiae. Ut est atque molestiae non occaecati ut nulla sunt. In omnis cumque officiis numquam vero non.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('22', 'Prof. Ena Cassin IV', 'Itaque saepe ullam rerum dolores et quo.', 'Sed quis et aut veniam nobis. Voluptatibus id magnam molestiae at. Sit illum unde et minima. Illum temporibus ut nulla blanditiis consequatur qui.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('23', 'Haskell Kertzmann', 'Esse ullam nulla expedita autem aliquid amet animi ut repudiandae.', 'Voluptas dicta et autem magni velit aut quas. Maiores tempora voluptatibus perferendis et est culpa. At tempora fugiat numquam aut laudantium eligendi. Quia at asperiores neque aliquid.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('24', 'Santa Mohr', 'Iusto dolor quisquam esse excepturi libero quam et voluptatem dolorum minima nobis.', 'Nam et corrupti ratione aut reiciendis iste. Excepturi qui illum quo corrupti accusamus. Consectetur nam fugiat sunt aut omnis. Similique et omnis velit.', '5', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('25', 'Maximillian Block', 'Alias dolorem earum qui delectus qui optio quos dolor labore dolorem.', 'Porro repellat suscipit eligendi fugit et sint hic. Ut aut hic quo soluta quia. Et error impedit molestiae et doloremque. Est non eius aut ex excepturi ducimus voluptatem.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('26', 'Zoie Auer PhD', 'Officiis dicta consequuntur necessitatibus officiis vel eum voluptates numquam.', 'Aut vel amet corrupti nulla odit aut mollitia. Et quia assumenda et quidem. Omnis beatae ut voluptatibus velit officia hic. Earum rerum molestiae molestiae nulla asperiores ut autem id.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('27', 'Clyde Murray III', 'Repudiandae magnam quia ipsa id libero unde iste aut rerum perspiciatis consectetur non voluptas.', 'Natus corrupti eaque quia quidem quis sequi adipisci. Ad et eaque occaecati veritatis minima occaecati. Consequatur ab et fuga omnis voluptates quasi.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('28', 'Bennie Rodriguez Sr.', 'Ipsum consequatur repellat exercitationem itaque cumque sapiente assumenda qui voluptas.', 'Accusantium accusamus aut velit aut. Asperiores hic voluptas culpa nihil voluptatem aut. Omnis quis similique praesentium veritatis et quia et.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('29', 'Jakob Hettinger', 'Tempora id ad unde accusamus dolorem impedit error quas tempora possimus.', 'Voluptas eligendi incidunt ipsa eligendi quidem nam. Ut qui id id rerum possimus mollitia repellendus provident. Excepturi repellendus est sed odio. Quia quam sint neque natus.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('30', 'Dr. Khalil Lebsack MD', 'Eos et quia dicta ullam recusandae eum molestiae sapiente est numquam vel voluptate.', 'Ea similique eaque delectus eum accusantium natus est. Qui hic ipsum aperiam minus iste quod. Voluptates sed voluptatibus consequuntur. Ut hic corrupti laborum nam voluptatem temporibus velit.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('31', 'Ms. Tamara Lebsack Jr.', 'Voluptatem quos sequi dolorem ullam voluptatem sit consectetur deleniti aliquid iusto porro reprehen', 'Et cupiditate quasi illo sapiente vel. In placeat consectetur vero illum non. In omnis omnis iusto exercitationem eum quaerat temporibus.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('32', 'Nathanael Quigley', 'Non atque nemo consequatur aut blanditiis rerum quo aliquid et error blanditiis minus voluptas.', 'Non enim accusamus laborum quisquam numquam rerum. Dolore blanditiis expedita quia laborum eos.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('33', 'Prof. Heidi Dibbert', 'Voluptatibus repellendus et molestiae quis qui et odio.', 'Deleniti velit modi ipsa voluptatibus ea et. Modi iusto odio qui sunt molestias similique autem. Omnis sapiente nihil enim sit corporis.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('34', 'Liliane Lubowitz', 'Temporibus dolorum rerum doloremque tempore dolorem nostrum nisi.', 'Adipisci qui harum deleniti aperiam ut voluptas. Illum delectus accusantium velit dolor. Deleniti enim ducimus autem inventore est quod.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('35', 'Sabryna Jakubowski I', 'Dolorem repellendus et quis ea exercitationem sed culpa sapiente magni quae non.', 'Molestiae iste magnam excepturi et. Sit et aut consequuntur aut asperiores unde at quasi. Quae placeat ut aspernatur vel. Iure voluptas voluptatem esse ratione voluptate.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('36', 'Jarrett Reynolds PhD', 'Et ut aliquam neque sit placeat asperiores ut magni.', 'Delectus nulla tempora id non et. Dolores unde quae rerum earum omnis voluptas dicta. At sit consectetur ut ipsa voluptatem magnam.', '5', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('37', 'Aurelia Ullrich', 'Officia illo labore debitis autem perferendis atque qui amet et odio animi.', 'Voluptatem voluptatum quas fugiat. Sed consequuntur aut odit. Eos est quidem officia voluptas amet quaerat quidem. Rem adipisci ab a eos sed.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('38', 'Carlos Watsica I', 'Repellendus aperiam qui veritatis voluptates reiciendis ratione a.', 'Dignissimos et est ipsam. Id dolorum non quaerat ut cum. Consectetur harum autem quia consequatur praesentium iure.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('39', 'Douglas Satterfield I', 'Modi minima asperiores eum totam aliquam expedita fugiat earum omnis et quia.', 'Fuga aut voluptate nostrum cumque nam excepturi ullam. Numquam voluptatum quia sit assumenda dolores. Est et praesentium nesciunt itaque.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('40', 'Agustin Jerde IV', 'Nesciunt quis harum nostrum qui dolor error architecto voluptatem sed suscipit quo sint.', 'Ut quisquam tempora sit. Nam sed ipsa architecto. Et laboriosam ea est illo.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('41', 'Skyla Kihn', 'Voluptatem quibusdam aut consequatur aut enim nisi reprehenderit.', 'Aut rerum velit impedit qui ut. Repellat velit ex illo nemo alias. Consectetur voluptatem ipsam nihil sed iusto aut et.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('42', 'Miss Leda Kertzmann I', 'Nulla ut culpa et consequuntur et aut asperiores perferendis.', 'Officiis omnis ut enim veniam. Officia minus optio veniam ut.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('43', 'Dr. Rosetta Schuppe', 'Quasi id recusandae quia quisquam itaque sequi blanditiis est facere porro autem vel.', 'Et hic beatae ipsam. Consectetur velit magni nemo ab rerum suscipit. Quas dolor tempora rerum et aut dicta.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('44', 'Chadrick Ratke', 'Est ullam saepe omnis totam ullam dolorum voluptates quos minus.', 'Placeat maxime quia ad accusantium similique sapiente cupiditate quo. Laboriosam et architecto eveniet aspernatur et tempora ut. Non in et molestiae est. Deserunt quidem sit nisi sed.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('45', 'Orland Blanda', 'Et porro in inventore et nihil est sit asperiores maxime maiores.', 'Sint est exercitationem tenetur nobis. Atque ipsum ut molestiae reiciendis amet iusto. Quam delectus minus ex nulla. Nisi facere in placeat quia ipsum quis est dolor.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('46', 'Mrs. Anjali Toy', 'Eos fuga accusamus nulla architecto nihil delectus asperiores doloremque.', 'Qui sed mollitia rerum voluptates eius ipsum eos. Necessitatibus qui tenetur corporis cumque voluptatum expedita. Doloribus dolorum aut odit. Quos doloremque consequatur porro in veritatis qui.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('47', 'Harry Lind', 'Provident aut fugit itaque fugiat est aut.', 'Rerum placeat sunt quia nam aut illum. Laboriosam voluptatem at dolorum omnis reiciendis. Provident non quia molestiae id nihil.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('48', 'Luella Franecki', 'Minima maiores totam animi fugiat et officiis saepe autem.', 'Similique illum odit deleniti voluptas iure praesentium voluptatem. Nam dolore optio sint. Nam eligendi officiis est aut ipsa corporis ea.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('49', 'Prof. Finn Kohler MD', 'Incidunt cumque reiciendis quos ea molestiae magni possimus in totam eum at qui non.', 'Aut vitae eum molestiae deserunt. Tenetur eveniet esse vel porro. Esse ut illo odit exercitationem neque voluptatem nulla. Voluptates deleniti sint ab vero reprehenderit.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('50', 'Vern Davis V', 'Repudiandae aperiam porro consequuntur enim consectetur dolorem eius.', 'Facere blanditiis aspernatur atque quasi sit aliquam rerum debitis. Omnis nulla veniam quisquam ullam ea. Ab aliquid laboriosam quidem aliquid incidunt aspernatur.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('51', 'Payton Nienow', 'Molestiae eum animi et vero dolore dolores tenetur ullam.', 'Ipsam hic et corrupti aliquam esse. Consequuntur ut est nemo delectus. Neque hic labore tenetur fugit occaecati sit nihil.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('52', 'Santino Bradtke Jr.', 'Repudiandae exercitationem sed dolores praesentium aut cum aut numquam aspernatur repellendus.', 'Nihil est ipsam qui. Magnam illo consectetur et doloremque sequi et. Est omnis omnis esse cumque qui.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('53', 'Filomena Swift Sr.', 'Ut vel quos quo unde est fugiat est enim.', 'Unde voluptatem animi qui suscipit. Pariatur vero eum consequatur perspiciatis quaerat.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('54', 'Mrs. Kattie Lueilwitz V', 'Corrupti necessitatibus non et porro non in eveniet minima.', 'Dolorem totam ab totam non dolore. Accusantium voluptates autem ipsam eum. Excepturi esse dolores fugiat et dolorem officiis tenetur. Et sunt maxime sit voluptatum.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('55', 'Orpha Ledner', 'Ad architecto ut nesciunt repellendus id quas voluptatibus vero debitis dolorem est ut molestiae.', 'Et perferendis sit voluptas reprehenderit et. Nihil sapiente eius eum molestias excepturi magnam. Ratione omnis sequi voluptatem aut at.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('56', 'Ned Beier', 'Qui corrupti vel quia voluptatem est reiciendis rerum maiores.', 'Laborum sit laborum voluptas repellendus in similique. Architecto ipsa neque qui suscipit. Quo nam et nulla enim ab. Quia possimus commodi voluptatem illum voluptas aliquid corrupti.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('57', 'Heaven Okuneva', 'Et enim molestiae quo quod voluptates quia quisquam laborum laboriosam.', 'Eos recusandae corporis molestiae dicta. Ex eum vel sint repellat aut in a. Nihil odit rerum rerum molestiae. Sed accusamus a quas vitae at asperiores.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('58', 'Icie Hegmann', 'Rerum quam rerum dolores consequatur voluptatem esse perferendis assumenda ratione id.', 'Facilis repudiandae eum possimus. Laudantium at voluptate explicabo doloribus. Recusandae id soluta omnis ab iusto aperiam amet. Accusamus distinctio tempore enim non omnis.', '5', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('59', 'Ms. Aaliyah Breitenberg DVM', 'Minima repellendus dicta sed eum reiciendis reprehenderit doloremque.', 'Explicabo unde quas accusamus eius enim. Eum quis quis maiores nihil quos quidem. Cupiditate corporis quia quia sint. Ipsum sed iure ut tempora voluptas omnis eius ratione.', '5', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('60', 'Summer Jerde', 'Adipisci ipsam itaque facere ducimus sint quos nobis fugit quisquam omnis beatae.', 'Et amet nihil hic qui dicta. Harum deleniti eum placeat possimus veritatis consequuntur. Vero accusamus consequatur omnis suscipit veniam nemo.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('61', 'Tevin Breitenberg', 'Nam soluta ut hic sunt nobis atque in beatae quia quae alias.', 'Repellendus harum placeat provident illo voluptas esse praesentium sint. Placeat odit dolor dolor qui assumenda. Quia beatae officia sint deserunt.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('62', 'Aliza Sauer', 'Fuga facilis quibusdam voluptates quisquam culpa occaecati impedit iste.', 'Et sapiente id saepe aut. Animi ad suscipit repellendus cumque rerum. Recusandae blanditiis ad eos voluptas aut. Adipisci praesentium molestias hic consequatur corrupti natus delectus.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('63', 'Dr. Payton Wunsch', 'Non ut ea doloremque aut est dolores minus et minus et.', 'Ut ratione reiciendis ut qui non unde nihil. Enim vero est ratione quidem cum similique. Odit quidem dolores esse non ipsam.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('64', 'Mariah Gislason', 'Molestias consequatur voluptas reiciendis molestiae ullam inventore sit totam cumque impedit enim mo', 'Quia quas ipsam voluptate odio necessitatibus provident. Aut sed fugit modi eos aut rerum animi consequatur. Eaque iste doloremque vel cumque. Debitis voluptatem ipsa qui.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('65', 'Mr. Darwin Emard Sr.', 'Et voluptates et in aut unde hic repudiandae.', 'Ut quia voluptas optio saepe quis blanditiis. Placeat sit cumque neque aliquam. Doloremque non velit et voluptas quia totam. At ut aut fugiat et dolorem.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('66', 'Wallace O\'Keefe', 'Sit eum eum in fugit dolorem et quaerat necessitatibus.', 'Incidunt facere in voluptas et molestias. Fugit atque omnis qui deleniti aspernatur. Nobis aut facere explicabo officiis laboriosam dolorum. Suscipit beatae autem quisquam aut.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('67', 'Ronny Lowe', 'Consequuntur illum eos aut amet ea et consequatur numquam nisi.', 'Repellendus architecto eius qui distinctio et omnis. Aut voluptas aliquid accusantium dolorem. Facere aut voluptate qui debitis et. Dolores nihil consectetur necessitatibus eaque eveniet corrupti.', '8', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('68', 'Miss Halie Brown IV', 'Aperiam corrupti est nostrum atque dolor molestiae amet qui sit aliquam delectus hic.', 'Eum et rerum est. Dolor delectus doloremque vitae nulla. Sapiente sint consequuntur quos totam praesentium est consequatur. Sunt laboriosam voluptate ea blanditiis iusto.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('69', 'Zaria Schamberger', 'Quidem officia repellat laborum aut expedita eligendi aut.', 'Est voluptatem facilis sunt ipsa debitis. Quam est totam sunt omnis. Ipsum et molestiae sit totam corrupti at vel.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('70', 'Ressie Rosenbaum', 'Aut commodi explicabo veritatis sit quaerat provident dolorem dolorem dolorum repellat.', 'Consequuntur sunt id aut ab. Rerum omnis sit dolor maiores corporis. Voluptatibus dolores est ipsam sequi.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('71', 'Dr. Newell Keeling DDS', 'Occaecati occaecati distinctio enim perspiciatis in molestiae esse dicta tenetur autem nihil sapient', 'Possimus voluptas perspiciatis harum odio molestiae dolorem. Eum a sed ipsum nihil rerum officia. Dicta ea repellendus quia dolorem. Enim molestiae sit nemo ex et laboriosam.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('72', 'Willow Schamberger', 'Maiores reiciendis est facere velit magnam cumque.', 'Et assumenda esse fuga laborum et est facere. Praesentium blanditiis ut eaque ut labore quo. Corporis eaque est quam expedita. Hic aut labore temporibus odio voluptate ex magnam.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('73', 'Marielle Boyer', 'Veritatis nulla reprehenderit explicabo voluptatem optio dolor ex ipsam enim quasi iure vero.', 'Non omnis aliquam dolorem ullam sapiente architecto odit. Sed magnam dolores unde dolor et. Similique voluptatum qui nam fugiat. Modi eaque est sint ab a.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('74', 'Dr. Hunter Nolan', 'Sint officiis adipisci ut ullam consequatur id voluptatem repellat dolorum asperiores quam quasi non', 'Maxime voluptas quos explicabo temporibus fuga ut rerum qui. Id ut pariatur maiores nisi magnam iure iure. Rerum rerum ut repellendus in ut dolorum vel.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('75', 'Dr. Schuyler Thiel V', 'Voluptates esse sunt vel ad eum sed.', 'Quidem deleniti id voluptatem libero. Est et aspernatur enim dignissimos. Dolorem illum reprehenderit blanditiis corrupti fugiat.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('76', 'Mrs. Donna Schoen', 'Officiis modi sunt autem et a voluptas nihil aperiam.', 'Nostrum sint magni ex omnis enim ut tempora harum. Ipsum quo nulla rerum voluptatum ex ex sit. Eveniet quasi fugiat ut nihil et. Debitis consequuntur aut fuga quia consectetur voluptatibus aut.', '7', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('77', 'Retha McCullough', 'Dicta ducimus ullam quia nobis dolores ipsam perspiciatis.', 'Cum et esse perferendis sunt molestiae est. Itaque inventore illo consequatur voluptatem quisquam iusto saepe nihil. Aperiam cupiditate voluptatibus laboriosam et officia eum sit adipisci.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('78', 'Colleen Crona', 'Veritatis numquam sit qui soluta voluptate ratione cupiditate culpa voluptatibus eos reiciendis minu', 'Est iusto veritatis alias maiores voluptatum nostrum. Eaque excepturi eos pariatur aut dolor sapiente.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('79', 'Harvey Gerhold', 'Occaecati quia eveniet dicta beatae suscipit eos corrupti nostrum dolor non tempore iste.', 'Omnis neque nihil praesentium mollitia. Enim qui facere quas voluptatem qui. Et adipisci molestiae rerum velit. Enim dolorem est cumque aut non neque.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('80', 'Bo Connelly', 'Omnis id corporis fugit voluptatum rerum repudiandae quisquam reprehenderit aliquid sed eveniet minu', 'Voluptatem quas voluptas vero ut. Quasi nam nesciunt nihil qui.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('81', 'Prof. Freeman Muller', 'Expedita facilis magnam ut eum omnis ut earum recusandae consequatur.', 'Voluptatem minima nobis numquam qui quam. Repudiandae eius dignissimos nisi aut adipisci aperiam asperiores. Nulla amet qui numquam.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('82', 'Prof. Johnson Lemke', 'Nisi eum et eos eveniet adipisci ipsa voluptatem dicta dolorem aspernatur.', 'Et ut est reiciendis quia et. Fuga natus autem veritatis ut. Quo quaerat recusandae beatae. Et architecto ea quis eum omnis itaque. Ducimus et in molestiae occaecati ex sunt.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('83', 'Akeem Bahringer', 'Qui est sint voluptas ut at deserunt.', 'Debitis rerum quisquam eaque officia unde officia. Blanditiis eum esse soluta quia id. Maxime dolor sed rem reiciendis aspernatur nihil. Asperiores ratione iure laborum beatae aut et est.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('84', 'Lola Schmidt', 'Ullam ea quia consectetur architecto harum libero laborum sed.', 'Corporis sit sequi debitis repellat omnis quae eum. Non exercitationem perferendis ut aut eligendi. Amet rem iure consequatur neque deserunt eos totam.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('85', 'Frankie Padberg', 'Et esse in modi qui labore laboriosam amet est debitis debitis quia quia.', 'Et dolorem culpa aut ipsam odit nobis accusamus. Dolorem qui a quia maxime expedita odio ullam. Sed vitae quae et inventore similique.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('86', 'Willa Legros', 'Sed hic tempore quo libero officiis ea velit et eveniet laborum quis vitae corporis.', 'Quaerat voluptatem accusamus ea. Culpa dignissimos illo at aperiam voluptas perferendis libero. Ratione officiis laborum est accusamus ipsum consectetur nulla enim.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('87', 'Marshall Runte', 'Officiis nihil modi ea expedita ut neque dolorem quo exercitationem eligendi est corporis alias.', 'Magnam quaerat dolorum nostrum similique illo. Corporis ut molestias dignissimos veniam voluptatum. Voluptas numquam velit voluptate. Omnis nesciunt debitis aperiam.', '8', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('88', 'Gina McKenzie', 'Veniam illo corrupti minima sit reprehenderit reiciendis voluptatem atque et voluptates facilis.', 'Dolor aut similique assumenda repellendus. Eum reiciendis quasi recusandae qui quo a deserunt. Non dolorem asperiores illo necessitatibus. Molestiae quod tenetur est.', '3', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('89', 'Dr. Rosamond Hackett', 'Temporibus et minus et perspiciatis voluptatibus ut qui id.', 'Iusto dolores perferendis placeat et sint laboriosam corporis. Placeat molestiae expedita aut excepturi laboriosam recusandae. Adipisci cumque ex sapiente et.', '2', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('90', 'Miss Amy Goldner', 'Voluptatum libero error eos qui neque quia nam.', 'Sint corporis dicta temporibus et suscipit quibusdam. Dolor numquam explicabo vero ipsam. Officiis sapiente aut iste et occaecati quos occaecati tempore. Et velit harum nisi est sequi.', '6', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('91', 'Penelope Volkman', 'Ut explicabo provident debitis dolores facilis consequuntur.', 'Similique aspernatur consectetur sunt velit. Qui unde aut enim quaerat sint vel ullam. Sit dignissimos id et nostrum aliquam quas rerum. Quibusdam quisquam ut distinctio labore.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('92', 'Elfrieda Olson', 'Non alias quis esse alias architecto quia quam assumenda.', 'Dolores voluptate eligendi labore illo. Autem facere est eos voluptatibus et. Vero eaque libero id at ut ratione porro. Placeat asperiores accusantium voluptatum ipsam ab.', '8', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('93', 'Oleta Homenick', 'Adipisci quibusdam et rerum architecto sunt sit.', 'Pariatur ipsa in quis debitis inventore minus earum sint. Esse omnis suscipit ut laboriosam porro sit. Quis hic eum quos doloribus adipisci beatae.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('94', 'Leonor McCullough', 'Magni harum odio assumenda perspiciatis sapiente ipsa aut exercitationem consectetur et iste consect', 'Animi veritatis velit aut est reprehenderit et voluptas. Et ab dolorum aut. Sequi occaecati ipsa consectetur nesciunt rem.', '4', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('95', 'Olin Willms DDS', 'Doloribus deleniti fuga nihil amet in et modi aut eos rerum.', 'Pariatur nostrum cupiditate soluta ipsam voluptatem amet. Eveniet sint eos iste magni libero iste veritatis. Occaecati accusantium vero reiciendis ex qui ut laudantium. Et ut maxime cum aut rem.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('96', 'Mr. Eloy Heidenreich II', 'Et exercitationem ratione praesentium iusto ea et odio aspernatur sit consequatur et aut.', 'Nisi nisi in non illo sint quis. Necessitatibus voluptatem molestiae dolor praesentium omnis a.', '5', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('97', 'Verdie Ledner', 'Molestiae sint veniam nulla est id et explicabo quisquam saepe aut ratione a.', 'Exercitationem quaerat mollitia et laboriosam. Porro vero deleniti veniam quam voluptate numquam earum. Libero similique eaque explicabo impedit fuga sunt.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('98', 'Camilla McLaughlin', 'Eius perspiciatis rerum ipsam similique maiores explicabo officiis saepe beatae omnis tempora accusa', 'Praesentium aperiam autem consequatur omnis facere et. Expedita vel eos odio sint impedit magnam. Et quod quibusdam voluptatum voluptate culpa.', '1', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('99', 'Cassidy Herman', 'Pariatur facilis quia doloribus ab eum quos.', 'Sunt et laborum optio sequi. Quo nihil culpa perferendis placeat quis et. Commodi facere hic omnis et doloremque.', '9', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `articles` VALUES ('100', 'Lonnie Schamberger MD', 'Soluta ratione sit omnis enim rerum aut cum labore nulla laudantium porro consequatur quibusdam.', 'Accusamus ducimus est et dicta. Libero necessitatibus excepturi voluptatem aut voluptas id excepturi. Cumque atque voluptatum eum quos.', '10', '2018-02-04 16:26:06', '2018-02-04 16:26:06');

-- ----------------------------
-- Table structure for `cate`
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名称',
  `create_user_id` int(11) NOT NULL COMMENT '添加管理员ID',
  `update_user_id` int(11) NOT NULL COMMENT '更新管理员ID',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES ('1', '体育', '1', '1', '2018-02-04 16:26:41', '2018-02-04 16:26:41', null);

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '昵称',
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `score` int(11) NOT NULL COMMENT '得分',
  `count` int(11) NOT NULL COMMENT 'PK次数',
  `win_count` int(11) NOT NULL COMMENT '胜利次数',
  `lose_count` int(11) NOT NULL COMMENT '失败次数',
  `draw_count` int(11) NOT NULL COMMENT '平局次数',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', '红苕', 'http://wx.qlogo.cn/mmopen/k9sshN67YkOFRHjYmM39MjwRAVs4j041VXhy9BDt5UicbeEvhWn0IJLF8WkTvSeKXIptto1PspveR7TDZb96DZsIkfHHqwr5J/0', '40', '2', '2', '0', '0', '2018-02-04 16:31:17', '2018-02-04 16:31:20', null);
INSERT INTO `member` VALUES ('2', '土豆', 'http://wx.qlogo.cn/mmopen/vi_32/InKXymxdA8hek4z4Gy6T2vraw7aPG0Mu8QTXEsP8X0UosHqB4DwbLUB7QeRghLQCG8fj6r7AqF1flNty5cuprw/0', '0', '2', '0', '2', '0', '2018-02-04 16:32:07', '2018-02-04 16:32:09', null);

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2015_09_14_153210_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('2015_10_13_160328_create_articles_table', '1');
INSERT INTO `migrations` VALUES ('2015_10_16_120351_create_settings_table', '1');
INSERT INTO `migrations` VALUES ('2018_02_01_165058_create_qa_tables', '1');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '1', 'dashboard_view', '首页', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('2', '3', 'users_view', '帐户菜单', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('3', '3', 'users_create', '新建帐户', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('4', '3', 'users_update', '修改帐户', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('5', '3', 'users_delete', '删除帐户', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('6', '4', 'roles_view', '角色菜单', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('7', '4', 'roles_create', '新建角色', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('8', '4', 'roles_update', '修改角色', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('9', '4', 'roles_delete', '删除角色', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('10', '5', 'permissions_view', '权限菜单', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('11', '5', 'permissions_create', '新建权限', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('12', '5', 'permissions_update', '修改权限', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('13', '5', 'permissions_delete', '删除权限', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('14', '6', 'permissiongroups_view', '权限分组菜单', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('15', '6', 'permissiongroups_create', '新建权限分组', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('16', '6', 'permissiongroups_update', '修改权限分组', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('17', '6', 'permissiongroups_delete', '删除权限分组', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('18', '7', 'articles_view', '文章菜单', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('19', '7', 'articles_create', '新建文章', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('20', '7', 'articles_update', '修改文章', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('21', '7', 'articles_delete', '删除文章', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('22', '8', 'settings_view', '配置菜单', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('23', '8', 'settings_create', '新建配置', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('24', '8', 'settings_update', '修改配置', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permissions` VALUES ('25', '8', 'settings_delete', '删除配置', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');

-- ----------------------------
-- Table structure for `permission_dependencies`
-- ----------------------------
DROP TABLE IF EXISTS `permission_dependencies`;
CREATE TABLE `permission_dependencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `dependency_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_dependencies_permission_id_foreign` (`permission_id`),
  KEY `permission_dependencies_dependency_id_foreign` (`dependency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_dependencies
-- ----------------------------

-- ----------------------------
-- Table structure for `permission_groups`
-- ----------------------------
DROP TABLE IF EXISTS `permission_groups`;
CREATE TABLE `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_groups
-- ----------------------------
INSERT INTO `permission_groups` VALUES ('1', null, '后台', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permission_groups` VALUES ('2', '1', 'RBAC', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permission_groups` VALUES ('3', '2', '帐户', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permission_groups` VALUES ('4', '2', '角色', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permission_groups` VALUES ('5', '2', '权限', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permission_groups` VALUES ('6', '2', '权限分组', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permission_groups` VALUES ('7', '1', '文章', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `permission_groups` VALUES ('8', '1', '配置', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');

-- ----------------------------
-- Table structure for `permission_role`
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------

-- ----------------------------
-- Table structure for `question`
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL COMMENT '分类ID',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '题干',
  `score` int(11) NOT NULL COMMENT '分数',
  `create_user_id` int(11) NOT NULL COMMENT '添加管理员ID',
  `update_user_id` int(11) NOT NULL COMMENT '更新管理员ID',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('1', '1', '下列哪支球队不属于NBA？', '20', '1', '1', '2018-02-04 16:28:44', '2018-02-04 16:28:44', null);
INSERT INTO `question` VALUES ('2', '1', '姚明NBA生涯效力于哪只NBA球队？', '20', '1', '1', '2018-02-04 16:36:40', '2018-02-04 16:36:40', null);

-- ----------------------------
-- Table structure for `record`
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `round_id` int(11) NOT NULL COMMENT '轮次ID',
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '题目ID',
  `home_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '答案（主）',
  `home_is_right` tinyint(1) NOT NULL COMMENT '是否正确（主）',
  `home_score` int(11) NOT NULL COMMENT '得分（主）',
  `away_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '答案（客）',
  `away_is_right` tinyint(1) NOT NULL COMMENT '是否正确（客）',
  `away_score` int(11) NOT NULL COMMENT '得分（客）',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of record
-- ----------------------------
INSERT INTO `record` VALUES ('1', '1', '	下列哪支球队不属于NBA？', '巴萨', '1', '20', '勇士', '0', '20', '2018-02-04 16:39:18', '2018-02-04 16:39:21');
INSERT INTO `record` VALUES ('2', '1', '姚明NBA生涯效力于哪只NBA球队？', '火箭', '1', '20', '大鲨鱼', '0', '0', '2018-02-04 16:46:51', '2018-02-04 16:46:53');
INSERT INTO `record` VALUES ('3', '2', '姚明NBA生涯效力于哪只NBA球队？', '火箭', '1', '20', '勇士', '0', '20', '2018-02-04 16:46:46', '2018-02-04 16:46:49');
INSERT INTO `record` VALUES ('4', '2', '下列哪支球队不属于NBA？', '巴萨', '1', '20', '巴萨', '1', '20', '2018-02-04 16:47:48', '2018-02-04 16:47:50');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', '管理员', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `roles` VALUES ('2', 'editor', '编辑', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `roles` VALUES ('3', 'user', '普通用户', '0', '2018-02-04 16:26:06', '2018-02-04 16:26:06');

-- ----------------------------
-- Table structure for `role_user`
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('2', '2');

-- ----------------------------
-- Table structure for `round`
-- ----------------------------
DROP TABLE IF EXISTS `round`;
CREATE TABLE `round` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `home_member_id` int(11) NOT NULL COMMENT 'PK一方（主）',
  `away_member_id` int(11) NOT NULL COMMENT 'PK另一方（客）',
  `win_member_id` int(11) NOT NULL COMMENT '获胜用户ID，平局为0',
  `score` int(11) NOT NULL COMMENT '胜利者得分，平局为0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of round
-- ----------------------------
INSERT INTO `round` VALUES ('1', '1', '2', '1', '20', '2018-02-04 16:33:03', '2018-02-04 16:33:06');
INSERT INTO `round` VALUES ('2', '1', '2', '1', '20', '2018-02-04 16:33:32', '2018-02-04 16:33:34');

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '管理员', 'admin@admin.com', '$2y$10$DfEG/igSzf497HSEacL1tuzvSzRAo9E7EUrGV7h3hNmzU/QEZy/o.', null, '2018-02-04 16:26:06', '2018-02-04 16:26:06');
INSERT INTO `users` VALUES ('2', '测试用户', 'test@test.com', '$2y$10$PR/d85LcLei3TjUvtgyAieYASWNF478OYjIn2.suPa1FX0lOW2efS', null, '2018-02-04 16:26:06', '2018-02-04 16:26:06');
