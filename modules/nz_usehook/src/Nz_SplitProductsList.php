<?php

use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchProviderInterface;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchResult;

class NzSplitProductsList implements ProductSearchProviderInterface
{
    private $module;    

    public function __construct(nz_usehook $module)
    {
        $this->module = $module;
    }
    //get provider from query
    protected function getProvider(ProductSearchQuery $query)
    {
        //verfier si un module utilise déjà ProductSearchProviderInterface (notamment factedsearch)
        $providers = Hook::exec(
            'productSearchProvider',
            array('query' => $query),
            null,
            true
        );
        if (!is_array($providers)) {
            $providers = array();
        }
        foreach ($providers as $module_name => $provider) {
            if ($module_name != 'nz_usehook' && $provider instanceof ProductSearchProviderInterface) {
                return $provider;
            } 
        }
    }
 
    public function runQuery(
        ProductSearchContext $context,
        ProductSearchQuery $query
    ) {
        $resultsPerPage = (int)$query->getResultsPerPage();
        $page = (int)$query->getPage();
        //recupérer provider pour modifier les résultats
        $provider = $this->getProvider($query);
        $query->setPage(1);
        //changer le nombre de produits
        $countResult = $provider->runQuery($context, $query, 'count');
        $query->setResultsPerPage((int)$countResult->getTotalProductsCount());
        $result = $provider->runQuery($context, $query);
        $query->setResultsPerPage((int)$resultsPerPage);
        $query->setPage((int)$page);
        if (!$result->getCurrentSortOrder()) {
            $result->setCurrentSortOrder($query->getSortOrder());
        }
        $productsResults = array();
        //ne pas faire de doublons
        $unique_combination = array();
        foreach ($result->getProducts() as $product) {
            $productFull = new Product((int)$product['id_product']);
            $productWithoutCombination = true;
            $combinations = $productFull->getAttributeCombinations((int)$context->getIdLang());
            if (is_array($combinations) && count($combinations)) {
                foreach ($combinations as $combination) {
                    if (
                        !isset($unique_combination[(int)$combination['id_product'].'_'.(int)$combination['id_attribute']]) && 
                        $combination['is_color_group'])  // spliter que pour le group couleur 
                    {
                        $combination_image = Image::getBestImageAttribute((int)$context->getIdShop(), (int)$context->getIdLang(), (int)$combination['id_product'], (int)$combination['id_product_attribute']);

                        //Ajouter la couleur dans le nom du produit
                        $product['id_product_attribute'] = (int)$combination['id_product_attribute'];
                        $product['name'] = $productFull->name[(int)$context->getIdLang()].' ('.$combination['attribute_name'] .')';
                        $product['is_color_group'] = (bool)$combination['is_color_group'];
                        $productsResults[] = $product;
                        $productWithoutCombination = false;
                        $unique_combination[(int)$combination['id_product'].'_'.(int)$combination['id_attribute']] = true;
                    }
                }
            }
            if ($productWithoutCombination) {
                $productsResults[] = $product;
            }
        }
        $result->setTotalProductsCount((int)count($productsResults));
        $productsResults = array_slice($productsResults, ((int)$resultsPerPage * ($page - 1)), (int)$resultsPerPage);
        $result->setProducts($productsResults);
        return $result;
    }
    
    
}
