<?php declare(strict_types=1);
/**
 * A Magento 2 module named Aceextensions/MassProductActions
 * Copyright (C) 2020 Durga Shankar Gupta
 * 
 * This file included in Aceextensions/MassProductActions is licensed under OSL 3.0
 * 
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Aceextensions\MassProductActions\Rewrite\Magento\CatalogImportExport\Model\Export;


class Product extends \Magento\CatalogImportExport\Model\Export\Product
{


      /**
     * Apply filter to collection and add not skipped attributes to select.
     *
     * @param \Magento\Eav\Model\Entity\Collection\AbstractCollection $collection
     * @return \Magento\Eav\Model\Entity\Collection\AbstractCollection
     * @since 100.2.0
     */
    protected function _prepareEntityCollection(\Magento\Eav\Model\Entity\Collection\AbstractCollection $collection)
    {
        $exportFilter = !empty($this->_parameters[\Magento\ImportExport\Model\Export::FILTER_ELEMENT_GROUP]) ?
            $this->_parameters[\Magento\ImportExport\Model\Export::FILTER_ELEMENT_GROUP] : [];

        if (isset($exportFilter['category_ids'])
            && trim($exportFilter['category_ids'])
            && $collection instanceof \Magento\Catalog\Model\ResourceModel\Product\Collection
        ) {
            $collection->addCategoriesFilter(['in' => explode(',', $exportFilter['category_ids'])]);
        }

        if (isset($exportFilter['product_ids'])
            && $collection instanceof \Magento\Catalog\Model\ResourceModel\Product\Collection
        ) {
            $collection->addFieldToFilter('entity_id', array('in' => $exportFilter['product_ids']));
        }

        return parent::_prepareEntityCollection($collection);
    }

}
