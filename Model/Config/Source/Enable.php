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

namespace Aceextensions\MassProductActions\Model\Config\Source;


class Enable implements \Magento\Framework\Option\ArrayInterface
{

    CONST MASS_ACTION_EXPORT_PRODUCT = 'export_product';

    CONST MASS_ACTION_ADD_CATEGORY = 'add_category';

    CONST MASS_ACTION_REMOVE_CATEGORY = 'remove_category';

    CONST MASS_ACTION_REPLACE_CATEGORY = 'replace_category';


    public function toOptionArray()
    {
        $returnArray = array();

        foreach($this->getMethodList() as $key => $methidList) {
            $returnArray[] = ['value' => $key, 'label' => $methidList['label']];
        }

        return [     
                    ['value' => self::MASS_ACTION_EXPORT_PRODUCT, 'label' => __('Export Product')],
                    ['value' => self::MASS_ACTION_ADD_CATEGORY, 'label' => __('Assign Category')],
                    ['value' => 'removecategory', 'label' => __('Remove Category')],
                    ['value' => 'replacecategory', 'label' => __('Replace Category')]
                ];
    }

    public function toArray()
    {
        $returnArray = array();

        foreach($this->toOptionArray() as $options) {
            $returnArray[$options['value']] = $options['label'];
        }
        
        return $returnArray;
    }

    public function getMethodList() {
        
            $returnArray = array();

            $returnArray[self::MASS_ACTION_EXPORT_PRODUCT] = array('label' => __('Export Product')); 
            $returnArray[self::MASS_ACTION_ADD_CATEGORY] = array('label' => __('Assign Category')) ;
            $returnArray[self::MASS_ACTION_REMOVE_CATEGORY] = array('label' => __('Remove Category'));
            $returnArray[self::MASS_ACTION_REPLACE_CATEGORY] = array('label' => __('Replace Category'));
            return $returnArray;
        
    }



    public function getProductExportConfig() {

    }
}

