<?php
/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\PrestaShop\Core\Import;

/**
 * Class ImportSettings provides import constants to be used in import pages
 */
final class ImportSettings
{
    /**
     * Default value separator
     */
    const DEFAULT_SEPARATOR = ';';

    /**
     * Default multiple value separator
     */
    const DEFAULT_MULTIVALUE_SEPARATOR = ',';

    /**
     * Maximum number of columns that are visible in the import matches configuration page
     */
    const MAX_VISIBLE_COLUMNS = 6;

    /**
     * Import entities
     */
    const CATEGORY_IMPORT = 0;
    const PRODUCT_IMPORT = 1;
    const COMBINATION_IMPORT = 2;
    const CUSTOMER_IMPORT = 3;
    const ADDRESS_IMPORT = 4;
    const BRAND_IMPORT = 5;
    const SUPPLIER_IMPORT = 6;
    const ALIAS_IMPORT = 7;
    const STORE_CONTACT_IMPORT = 8;

    /**
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }
}
