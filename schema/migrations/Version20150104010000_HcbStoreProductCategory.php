<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150104010000_HcbStoreProductCategory extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `store_product_category_localized_page` CHANGE  `url`  `url` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
            $this->addSql("ALTER TABLE  `store_product_category_has_alias` DROP FOREIGN KEY  `fk_store_product_category_has_alias_store_product_category1` ,
    ADD FOREIGN KEY (  `store_product_category_id` ) REFERENCES  `store_product_category` (
    `id`
    ) ON DELETE CASCADE ON UPDATE CASCADE ;

    ALTER TABLE  `store_product_category_has_alias` DROP FOREIGN KEY  `fk_store_product_category_has_alias_alias1` ,
    ADD FOREIGN KEY (  `alias_id` ) REFERENCES  `alias` (
    `id`
    ) ON DELETE CASCADE ON UPDATE CASCADE ;");
        $this->addSql("ALTER TABLE  `store_product_category_localized` DROP FOREIGN KEY  `fk_store_product_category_localized_store_product_category1` ,
ADD FOREIGN KEY (  `store_product_category_id` ) REFERENCES  `store_product_category` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");
        $this->addSql("ALTER TABLE  `store_product_category_localized_page` DROP FOREIGN KEY  `fk_store_product_category_localized_page_store_product_catego1` ,
ADD FOREIGN KEY (  `store_product_category_localized_id` ) REFERENCES  `store_product_category_localized` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `store_product_category_localized_page` CHANGE  `url`  `url` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
        $this->addSql("ALTER TABLE  `store_product_category_has_alias` DROP FOREIGN KEY  `store_product_category_has_alias_ibfk_1` ,
ADD FOREIGN KEY (  `store_product_category_id` ) REFERENCES  `store_product_category` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `store_product_category_has_alias` DROP FOREIGN KEY  `store_product_category_has_alias_ibfk_2` ,
ADD FOREIGN KEY (  `alias_id` ) REFERENCES  `alias` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
        $this->addSql("ALTER TABLE  `store_product_category_localized` DROP FOREIGN KEY  `store_product_category_localized_ibfk_1` ,
ADD FOREIGN KEY (  `store_product_category_id` ) REFERENCES  `store_product_category` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
        $this->addSql("ALTER TABLE  `store_product_category_localized_page` DROP FOREIGN KEY  `store_product_category_localized_page_ibfk_1` ,
ADD FOREIGN KEY (  `store_product_category_localized_id` ) REFERENCES  `store_product_category_localized` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
    }
}
