<?php
/**
 * Venustheme
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the venustheme.com license that is
 * available through the world-wide-web at this URL:
 * http://venustheme.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category  Venustheme
 * @package   Ves_Testimonial
 * @copyright Copyright (c) 2017 Landofcoder (http://www.venustheme.com/)
 * @license   http://www.venustheme.com/LICENSE-1.0.html
 */

namespace Ves\Testimonial\Controller\Adminhtml\Category;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Ves\Testimonial\Model\ResourceModel\Category\CollectionFactory;

class MassEnable extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;


    /**
     * @param Context
     * @param Filter
     * @param CollectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);

    }//end __construct()


    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        foreach ($collection as $item) {
            $item->setIsActive(true);
            $item->save();
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been enabled.', $collection->getSize()));

        /*
            *
            *
            * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
        */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');

    }//end execute()


     /**
      * {@inheritdoc}
      */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ves_Testimonial::category_save');

    }//end _isAllowed()


}//end class
