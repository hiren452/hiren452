<?php
/**
 * Plumrocket Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End-user License Agreement
 * that is available through the world-wide-web at this URL:
 * http://wiki.plumrocket.net/wiki/EULA
 * If you are unable to obtain it through the world-wide-web, please
 * send an email to support@plumrocket.com so we can send you a copy immediately.
 *
 * @package     Plumrocket_Base
 * @copyright   Copyright (c) 2020 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

namespace Plumrocket\Base\Observer;

/**
 * Base observer
 */
class SystemConfigSaveAfter extends AbstractSystemConfig
{
    /**
     * Predispath admin action controller
     *
     * @param                                         \Magento\Framework\Event\Observer $observer
     * @return                                        void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $section = $this->_getSection($observer);
        if (!$section) {
            return;
        }

        $product = $this->_getProductBySection($section);

        $product->checkStatus();
        if (!$product->isInStock()) {
            $product->disable();
        }
    }
}
