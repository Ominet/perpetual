<?php

/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */
namespace ps_metrics_module_v4_1_2\Tests\Unit\DependencyInjection;

use ps_metrics_module_v4_1_2\PHPUnit\Framework\TestCase;
use ps_metrics_module_v4_1_2\PrestaShop\ModuleLibCacheDirectoryProvider\Cache\CacheDirectoryProvider;
use PrestaShop\ModuleLibServiceContainer\DependencyInjection\ContainerProvider;
class ContainerProviderTest extends TestCase
{
    public function testItIsReturnValidInstance()
    {
        /** @var CacheDirectoryProvider $cacheDirectory */
        $cacheDirectory = $this->createMock(CacheDirectoryProvider::class);
        $containerProvider = new ContainerProvider('test', __DIR__, $cacheDirectory);
        $this->assertInstanceOf(ContainerProvider::class, $containerProvider);
    }
}
