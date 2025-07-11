<?php

namespace Variantproducts\Search;

use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider as BaseCategoryProvider;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;
use Product;

class CustomCategoryProductSearchProvider extends BaseCategoryProvider
{
    public function runQuery(ProductSearchContext $context, ProductSearchQuery $query): ProductSearchResult
    {
        die('okkkk');
        $result = new ProductSearchResult();
        $idCategory = (int) $query->getQueryType()->getId();
        $products = $this->getProductsWithCombinations($idCategory, $context->getLanguageId());

        $result->setTotal(count($products));
        $result->setProducts($products);

        return $result;
    }

    private function getProductsWithCombinations($idCategory, $idLang)
    {
        $sql = "
            SELECT
                p.id_product,
                pa.id_product_attribute,
                pl.name AS product_name,
                GROUP_CONCAT(DISTINCT agl.name, ': ', al.name SEPARATOR ', ') AS attribute_name,
                pa.price AS combination_price,
                i.id_image
            FROM
                "._DB_PREFIX_."product p
                INNER JOIN "._DB_PREFIX_."product_attribute pa ON (p.id_product = pa.id_product)
                LEFT JOIN "._DB_PREFIX_."product_attribute_combination pac ON (pa.id_product_attribute = pac.id_product_attribute)
                LEFT JOIN "._DB_PREFIX_."attribute a ON (a.id_attribute = pac.id_attribute)
                LEFT JOIN "._DB_PREFIX_."attribute_lang al ON (a.id_attribute = al.id_attribute AND al.id_lang = $idLang)
                LEFT JOIN "._DB_PREFIX_."attribute_group_lang agl ON (agl.id_attribute_group = a.id_attribute_group AND agl.id_lang = $idLang)
                LEFT JOIN "._DB_PREFIX_."product_lang pl ON (p.id_product = pl.id_product AND pl.id_lang = $idLang)
                LEFT JOIN "._DB_PREFIX_."category_product cp ON (p.id_product = cp.id_product)
                LEFT JOIN "._DB_PREFIX_."product_attribute_image pai ON (pai.id_product_attribute = pa.id_product_attribute)
                LEFT JOIN "._DB_PREFIX_."image i ON (i.id_image = pai.id_image)
            WHERE
                cp.id_category = $idCategory
            GROUP BY pa.id_product_attribute
        ";

        $rows = \Db::getInstance()->executeS($sql);
        $link = new \Link();

        $products = [];
        foreach ($rows as $row) {
            $products[] = [
                'id_product' => $row['id_product'],
                'id_product_attribute' => $row['id_product_attribute'],
                'name' => $row['product_name'].' - '.$row['attribute_name'],
                'price' => Product::getPriceStatic($row['id_product'], true, $row['id_product_attribute']),
                'add_to_cart_url' => $link->getAddToCartURL($row['id_product'], $row['id_product_attribute']),
                'url' => $link->getProductLink($row['id_product'], null, null, null, $idLang, null, $row['id_product_attribute']),
                'image' => $link->getImageLink($row['product_name'], $row['id_image'], 'home_default'),
            ];
        }

        return $products;
    }
}