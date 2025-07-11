{**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{if isset($subcategories) && $subcategories|@count}
    <!-- Exo 3 -->
    <div class="container">
        <div class="row">
            <div class="large-12 columns">
                <div id="nz-sub-categories-list" class="owl-carousel owl-theme">
                   {foreach from=$subcategories item=sub}
                       <div class="item">
                        <a href="{$sub['url']}" class="bubble-wrapper">
                          <div class="bubble-inner-wrapper">
                            <img src="{$sub['image']["bySize"]["small_default"]["url"]}" alt="{$sub['name']}">
                            <p class="subcat-title">{$sub['name']} ({$sub['nb_products']})</p>
                          </div>
                        </a>
                      </div>
                   {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}
<div id="js-product-list-header">
    {if $listing.pagination.items_shown_from == 1}
        <div class="block-category card card-block">
            <h1 class="h1">{$category.name}</h1>
            <div class="block-category-inner">
                {if $category.description}
                    <div id="category-description" class="text-muted">{$category.description nofilter}</div>
                {/if}
                {if $category.image.large.url}
                    <div class="category-cover">
                        <img src="{$category.image.large.url}" alt="{if !empty($category.image.legend)}{$category.image.legend}{else}{$category.name}{/if}">
                    </div>
                {/if}
            </div>
        </div>
    {/if}
</div>
