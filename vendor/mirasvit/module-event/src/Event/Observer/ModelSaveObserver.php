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



namespace Mirasvit\Event\Observer;


use Magento\Framework\DataObject;
use Magento\Framework\Event\ObserverInterface;
use Mirasvit\Core\Service\CompatibilityService;
use Mirasvit\Event\Api\Data\Event\InstanceEventInterface;
use Mirasvit\Event\Api\Data\Event\ObservableEventWrapperInterface;
use Mirasvit\Event\Api\Repository\EventRepositoryInterface;

class ModelSaveObserver implements ObserverInterface
{
    private $eventRepository;
    
    public function __construct(
        EventRepositoryInterface $eventRepository
    ) {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Register "model_save_after" event for observed events.
     *
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $object = $observer->getData('object');
        $class  = ltrim(get_class($object), '\\'); // object class

        if (version_compare(CompatibilityService::getVersion(), '2.3.0', '>=')) {
            $upToDateDataClass = CompatibilityService::getObjectManager()->get('\Magento\Framework\Setup\Patch\UpToDateData');
            if ($upToDateDataClass->isUpToDate()) {
                /** @var ObservableEventWrapperInterface|InstanceEventInterface $event */
                foreach ($this->eventRepository->getEvents() as $event) {
                    if ($this->isObserved($class, $event)) {
                        $event->register($object);
                    }
                }
            }
        }
        return $this;
    }

    /**
     * Determine whether the model_save event is observed for given $class or not.
     *
     * @param string                 $class
     * @param InstanceEventInterface $event
     *
     * @return bool
     */
    private function isObserved($class, InstanceEventInterface $event)
    {
        $result = false;
        if ($event instanceof ObservableEventWrapperInterface
            && $class === ltrim($event->getObservedClassName(), '\\')
        ) {
            $result = true;
        }

        return $result;
    }
}
