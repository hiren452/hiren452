<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-event
 * @version   1.2.41
 * @copyright Copyright (C) 2021 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\Event\EventData\Order;


use Magento\Framework\Model\AbstractModel;
use Mirasvit\Event\Api\Data\AttributeInterface;
use Mirasvit\Event\Api\Data\EventDataInterface;
use Mirasvit\Event\EventData\Condition\OrderCondition;
use Mirasvit\Event\EventData\OrderData;

class SummaryQtyAttribute implements AttributeInterface
{
    const ATTR_CODE  = 'summary_qty';
    const ATTR_LABEL = 'Total quantity of products';

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {
        return self::ATTR_CODE;
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel()
    {
        return __(self::ATTR_LABEL);
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return EventDataInterface::ATTRIBUTE_TYPE_NUMBER;
    }

    /**
     * Calculate total QTY of products in order.
     *
     * {@inheritDoc}
     */
    public function getValue(AbstractModel $dataObject)
    {
        $qty = 0;
        /** @var OrderData $order */
        $order = $dataObject->getData(OrderData::IDENTIFIER);

        foreach ($order->getAllItems() as $item) {
            $qty += $item->getQtyOrdered();
        }

        return $qty;
    }

    /**
     * {@inheritDoc}
     */
    public function getConditionClass()
    {
        return OrderCondition::class . '|' . self::ATTR_CODE;
    }
}
