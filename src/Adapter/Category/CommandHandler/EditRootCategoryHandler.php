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

namespace PrestaShop\PrestaShop\Adapter\Category\CommandHandler;

use Category;
use PrestaShop\PrestaShop\Adapter\Domain\AbstractObjectModelHandler;
use PrestaShop\PrestaShop\Core\Domain\Category\Command\EditRootCategoryCommand;
use PrestaShop\PrestaShop\Core\Domain\Category\CommandHandler\EditRootCategoryHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CannotEditCategoryException;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CannotEditRootCategoryException;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryException;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryNotFoundException;

/**
 * Class EditRootCategoryHandler.
 */
final class EditRootCategoryHandler extends AbstractObjectModelHandler implements EditRootCategoryHandlerInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws CannotEditCategoryException
     * @throws CategoryNotFoundException
     * @throws CannotEditRootCategoryException
     */
    public function handle(EditRootCategoryCommand $command)
    {
        $category = new Category($command->getCategoryId()->getValue());

        if (!$category->id) {
            throw new CategoryNotFoundException($command->getCategoryId(), sprintf('Category with id "%s" cannot be found.', $command->getCategoryId()->getValue()));
        }

        // Root category means here REAL ROOT category, not the HOME of the shop
        if ($category->isRootCategory()) {
            throw new CannotEditRootCategoryException();
        }

        $this->updateRootCategoryFromCommandData($category, $command);
    }

    /**
     * @param Category $category
     * @param EditRootCategoryCommand $command
     */
    private function updateRootCategoryFromCommandData(Category $category, EditRootCategoryCommand $command)
    {
        if (null !== $command->isActive()) {
            $category->active = $command->isActive();
        }

        if (null !== $command->getLocalizedNames()) {
            $category->name = $command->getLocalizedNames();
        }

        if (null !== $command->getLocalizedLinkRewrites()) {
            $category->link_rewrite = $command->getLocalizedLinkRewrites();
        }

        if (null !== $command->getLocalizedDescriptions()) {
            $category->description = $command->getLocalizedDescriptions();
        }

        if (null !== $command->getLocalizedMetaTitles()) {
            $category->meta_title = $command->getLocalizedMetaTitles();
        }

        if (null !== $command->getLocalizedMetaDescriptions()) {
            $category->meta_description = $command->getLocalizedMetaDescriptions();
        }

        if (null !== $command->getLocalizedMetaKeywords()) {
            $category->meta_keywords = $command->getLocalizedMetaKeywords();
        }

        if (null !== $command->getAssociatedGroupIds()) {
            $category->groupBox = $command->getAssociatedGroupIds();
        }

        if ($command->getAssociatedShopIds()) {
            $this->associateWithShops($category, $command->getAssociatedShopIds());
        }

        if (false === $category->validateFields(false)) {
            throw new CategoryException('Invalid data for updating category root');
        }

        if (false === $category->validateFieldsLang(false)) {
            throw new CategoryException('Invalid data for updating category root');
        }

        if (false === $category->update()) {
            throw new CannotEditCategoryException(sprintf('Failed to edit Category with id "%s".', $category->id));
        }
    }
}
