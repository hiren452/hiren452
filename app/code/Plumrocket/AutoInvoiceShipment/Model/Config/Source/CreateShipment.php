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
 * @package   Plumrocket_AutoInvoiceShipment
 * @copyright Copyright (c) 2017 Plumrocket Inc. (http://www.plumrocket.com)
 * @license   http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

namespace Plumrocket\AutoInvoiceShipment\Model\Config\Source;

use Plumrocket\AutoInvoiceShipment\Model\Shipmentrules;

class CreateShipment
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            Shipmentrules::CREATE_AFTER_ORDER_CREATED   => __('After Order is created'),
            Shipmentrules::CREATE_AFTER_INVOICE_CREATED => __('After Invoice is created')
        ];
    }
}
