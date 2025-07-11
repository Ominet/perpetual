<?php

class CategoryController extends CategoryControllerCore
{
    

    protected function getTemplateVarSubCategories()
    {
        return array_map(function (array $category) {
            $object = new Category(
                $category['id_category'],
                $this->context->language->id
            );
            $subCat = new Category($category['id_category']);
            $category['nb_products'] = $subCat->getProducts($this->context->language->id, 0, 0, null, null, true);
            $category['image'] = $this->getImage(
                $object,
                $object->id_image
            );
            $category['url'] = $this->context->link->getCategoryLink(
                $category['id_category'],
                $category['link_rewrite']
            );

            return $category;
        }, $this->category->getSubCategories($this->context->language->id));
    }

    
}
