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

namespace Aceextensions\MassProductActions\Controller\Adminhtml\Product;

use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Export extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    protected $productExport;


    /**
     * Massactions filter
     *
     * @var Filter
     */
    protected $filter;

    protected $objectManager;
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        PageFactory $resultPageFactory,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\CatalogImportExport\Model\Export\Product $productExport
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->filter = $filter;
        $this->productExport = $productExport;

        $this->_fileFactory = $fileFactory;
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        
        $params = $this->getRequest()->getParam("selected");

        $fliter = array();
        $fliter['product_ids'] = $params;
        $this->productExport->setParameters(array(\Magento\ImportExport\Model\Export::FILTER_ELEMENT_GROUP => $fliter));
        $this->productExport->setWriter($this->objectManager->create(
            \Magento\ImportExport\Model\Export\Adapter\Csv::class
        ));
        $exportData = $this->productExport->export();

        return $this->_fileFactory->create(
            "catalog_product.csv",
            $exportData
        );

    }
}
