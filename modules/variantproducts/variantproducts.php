<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class VariantProducts extends Module
{
    public function __construct()
    {
        $this->name = 'variantproducts';
        $this->author = 'ChatGPT';
        $this->version = '1.0.0';
        $this->bootstrap = true;
        $this->tab = 'front_office_features';
        parent::__construct();

        $this->displayName = $this->l('Variant Products as Separate Items');
        $this->description = $this->l('Display combinations as individual products in listings.');
    }

    public function install()
    {
        return parent::install();
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }
}