<?php
namespace Aceextensions\MassProductActions\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    CONST SYSTEM_PREFIX="mass_product_actions";

    CONST SYSTEM_CONFIG_GENERAL_ENABLE=self::SYSTEM_PREFIX.'/general/enable';

    
    /**
     * Check is module enable
     * @return bool
     */
    public function isEnable ()
    {
        return $this->scopeConfig->isSetFlag(
            self::SYSTEM_CONFIG_GENERAL_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }


    /**
     * Get B2b Url
     * @return string
     */
    public function getEnableAction ()
    {
        return explode(",", $this->scopeConfig->getValue(
            self::SYSTEM_CONFIG_GENERAL_ENABLE,
            ScopeInterface::SCOPE_STORE
        ));
        
    }

}
