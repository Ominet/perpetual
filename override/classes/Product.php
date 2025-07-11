<?php

class Product extends ProductCore
{
	//Override Nizar (Exercice 1) get last SubCategory name 
	public static function getLastChildCategory($id_product = '', $id_lang = null)
	{
	    if (!$id_lang) {
	        $id_lang = Context::getContext()->language->id;
	    }

	    $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
	        '
	        SELECT  cl.`name` FROM `' . _DB_PREFIX_ . 'category_product` cp
	        LEFT JOIN `' . _DB_PREFIX_ . 'category` c ON (c.id_category = cp.id_category)
	        LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON (cp.`id_category` = cl.`id_category`' . Shop::addSqlRestrictionOnLang('cl') . ')
	        ' . Shop::addSqlAssociation('category', 'c') . '
	        WHERE cp.`id_product` = ' . (int) $id_product . '
	            AND cl.`id_lang` = ' . (int) $id_lang
	        . ' ORDER BY level_depth desc limit 0,1'
	    );

	    
	    return $row[0]['name'];
	}
	//End override
}