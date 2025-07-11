<?php
/* Smarty version 3.1.33, created on 2025-07-11 05:50:47
  from 'C:\laragon\www\perpetual\themes\perpetual\templates\catalog\_partials\category-header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68709827b86ac4_99869168',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1509316ef34874dbfa7af14eda3a8cc60af88547' => 
    array (
      0 => 'C:\\laragon\\www\\perpetual\\themes\\perpetual\\templates\\catalog\\_partials\\category-header.tpl',
      1 => 1752208550,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68709827b86ac4_99869168 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['subcategories']->value) && count($_smarty_tpl->tpl_vars['subcategories']->value)) {?>
    <div class="container">
        <div class="row">
            <div class="large-12 columns">
                <div id="nz-sub-categories-list" class="owl-carousel owl-theme">
                   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subcategories']->value, 'sub');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sub']->value) {
?>
                       <div class="item">
                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sub']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="bubble-wrapper">
                          <div class="bubble-inner-wrapper">
                            <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sub']->value['image']["bySize"]["small_default"]["url"], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sub']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                            <p class="subcat-title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sub']->value['name'], ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sub']->value['nb_products'], ENT_QUOTES, 'UTF-8');?>
)</p>
                          </div>
                        </a>
                      </div>
                   <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<div id="js-product-list-header">
    <?php if ($_smarty_tpl->tpl_vars['listing']->value['pagination']['items_shown_from'] == 1) {?>
        <div class="block-category card card-block">
            <h1 class="h1"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
</h1>
            <div class="block-category-inner">
                <?php if ($_smarty_tpl->tpl_vars['category']->value['description']) {?>
                    <div id="category-description" class="text-muted"><?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>
</div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['category']->value['image']['large']['url']) {?>
                    <div class="category-cover">
                        <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['image']['large']['url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php if (!empty($_smarty_tpl->tpl_vars['category']->value['image']['legend'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['image']['legend'], ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');
}?>">
                    </div>
                <?php }?>
            </div>
        </div>
    <?php }?>
</div>
<?php }
}
