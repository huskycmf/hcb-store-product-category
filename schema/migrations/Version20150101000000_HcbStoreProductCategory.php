<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150101000000_HcbStoreProductCategory extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE `store_product_category` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `enabled` tinyint(3) unsigned NOT NULL DEFAULT '0',
                      `priority` smallint(5) unsigned NOT NULL DEFAULT '1',
                      `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

                    CREATE TABLE `store_product_category_has_alias` (
                      `store_product_category_id` int(10) unsigned NOT NULL,
                      `alias_id` int(10) unsigned NOT NULL,
                      `is_primary` tinyint(3) unsigned DEFAULT NULL,
                      PRIMARY KEY (`store_product_category_id`,`alias_id`),
                      UNIQUE KEY `alias_id_UNIQUE` (`alias_id`),
                      KEY `fk_store_product_category_has_alias_alias1_idx` (`alias_id`),
                      KEY `fk_store_product_category_has_alias_store_product_category1_idx` (`store_product_category_id`),
                      KEY `unique` (`store_product_category_id`,`is_primary`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

                    CREATE TABLE `store_product_category_has_product` (
                      `store_product_category_id` int(10) unsigned NOT NULL,
                      `store_product_id` int(10) unsigned NOT NULL,
                      PRIMARY KEY (`store_product_category_id`,`store_product_id`),
                      KEY `fk_store_product_category_has_store_product_store_product1_idx` (`store_product_id`),
                      KEY `fk_store_product_category_has_store_product_store_product_c_idx` (`store_product_category_id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

                    CREATE TABLE `store_product_category_localized` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `store_product_category_id` int(10) unsigned NOT NULL,
                      `locale_id` int(10) unsigned NOT NULL,
                      `title` varchar(200) NOT NULL,
                      `description` text NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `fk_store_product_category_localized_store_product_category1_idx` (`store_product_category_id`),
                      KEY `fk_store_product_category_localized_locale1_idx` (`locale_id`),
                      KEY `unique` (`store_product_category_id`,`locale_id`)
                    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

                    CREATE TABLE `store_product_category_localized_page` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `store_product_category_localized_id` int(10) unsigned NOT NULL,
                      `content` text,
                      `keywords` varchar(300) DEFAULT NULL,
                      `title` varchar(300) DEFAULT NULL,
                      `description` varchar(300) DEFAULT NULL,
                      `url` varchar(100) NOT NULL,
                      PRIMARY KEY (`id`,`store_product_category_localized_id`),
                      UNIQUE KEY `url_UNIQUE` (`url`),
                      KEY `fk_store_product_category_localized_page_store_product_cate_idx` (`store_product_category_localized_id`)
                    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

                    ALTER TABLE `store_product_category_has_alias`
                      ADD CONSTRAINT `store_product_category_has_alias_ibfk_2` FOREIGN KEY (`alias_id`) REFERENCES `alias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                      ADD CONSTRAINT `store_product_category_has_alias_ibfk_1` FOREIGN KEY (`store_product_category_id`) REFERENCES `store_product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

                    ALTER TABLE `store_product_category_has_product`
                      ADD CONSTRAINT `store_product_category_has_product_ibfk_2` FOREIGN KEY (`store_product_id`) REFERENCES `store_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                      ADD CONSTRAINT `store_product_category_has_product_ibfk_1` FOREIGN KEY (`store_product_category_id`) REFERENCES `store_product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

                    ALTER TABLE `store_product_category_localized`
                      ADD CONSTRAINT `fk_store_product_category_localized_locale1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      ADD CONSTRAINT `fk_store_product_category_localized_store_product_category1` FOREIGN KEY (`store_product_category_id`) REFERENCES `store_product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                    ALTER TABLE `store_product_category_localized_page`
                      ADD CONSTRAINT `fk_store_product_category_localized_page_store_product_catego1` FOREIGN KEY (`store_product_category_localized_id`) REFERENCES `store_product_category_localized` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
                    ");
    }

    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE store_product_category');
        $this->addSql('DROP TABLE store_product_category_has_alias');
        $this->addSql('DROP TABLE store_product_category_has_product');
        $this->addSql('DROP TABLE store_product_category_localized');
        $this->addSql('DROP TABLE store_product_category_localized_page');
    }
}
