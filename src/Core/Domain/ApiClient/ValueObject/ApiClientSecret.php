<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
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
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace PrestaShop\PrestaShop\Core\Domain\ApiClient\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\ApiClient\Exception\ApiClientConstraintException;

class ApiClientSecret
{
    public const MIN_SIZE = 32;
    public const MAX_SIZE = 72;

    public function __construct(
        private string $value,
    ) {
        $this->assertSecretValue($this->value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function assertSecretValue(string $value)
    {
        if (strlen($value) < self::MIN_SIZE || strlen($value) > self::MAX_SIZE) {
            throw new ApiClientConstraintException(sprintf('Invalid api client secret "%s".', var_export($value, true)), ApiClientConstraintException::INVALID_SECRET);
        }
    }
}
