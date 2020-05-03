<?php
namespace Aceextensions\MassProductActions\Plugin;

use Magento\Framework\UrlInterface;
use Aceextensions\MassProductActions\Helper\Data;
use Aceextensions\MassProductActions\Model\Config\Source\Enable;

class ProductListing
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * @var Data
     */
    protected $helper;

     /**
     * @var Enable
     */
    protected $enableAction;

    /**
     * ProductListing constructor.
     * @param UrlInterface $urlBuilder
     * @param Data $helper
     */
    public function __construct (
        UrlInterface $urlBuilder,
        Data $helper,
        Enable  $enableAction
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->helper = $helper;
        $this->enableAction = $enableAction;
    }

    /**
     * Create Massaction in Admin
     * @param \Magento\Framework\View\Layout\Generic $subject
     * @param \Closure $proceed
     * @param string $component
     * @return array|mixed
     */
    public function aroundBuild (\Magento\Framework\View\Layout\Generic $subject, \Closure $proceed, $component)
    {
        $enableAction = $this->helper->getEnableAction();

        if ( $this->helper->isEnable()) {
            if ($component->getName() == 'product_listing') {
                $result = $proceed($component);
                if (is_array($result)) {
                    if (isset($result['components']['product_listing']['children']['product_listing']['children']
                        ['listing_top']['children']['listing_massaction'])) {

                        $productMassAction =  $result['components']['product_listing']['children']['product_listing']['children']
                            ['listing_top']['children']['listing_massaction']['config']['actions'];
                        
                        foreach($productMassAction as $key => $action) {

                           if (!$this->isActionEnable($action, $enableAction) ) {

                               unset($result['components']['product_listing']['children']['product_listing']['children']
                               ['listing_top']['children']['listing_massaction']['config']['actions'][$key]);
                           }
                        }
                        
                    }
                }
            }
        }
        if (isset($result)) {
            return $result;
        }
        return $proceed($component);
    }


    public function isActionEnable($action, $enableAction) {
    
        $extensionAction = array_keys($this->enableAction->getMethodList());    
        if(isset($action['type']) && 
            in_array($action['type'],$extensionAction ) &&
            !in_array($action['type'],$enableAction )) {
                return FALSE;
            }
        return TRUE ;
    }
}
