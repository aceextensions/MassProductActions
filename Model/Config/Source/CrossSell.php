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


class CrossSell implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [['value' => 'Category', 'label' => __('Category')],['value' => 'Cost', 'label' => __('Cost')]];
    }

    public function toArray()
    {
        return ['Category' => __('Category'),'Cost' => __('Cost')];
    }
}

