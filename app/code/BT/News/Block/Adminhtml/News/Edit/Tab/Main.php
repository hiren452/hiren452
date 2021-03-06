<?php
/**
 * @category   Chirag
 * @package    Chirag_Events
 * @author     chirag@czargroup.net
 * @copyright  This file was generated by using Module Creator provided by <developer@czargroup.net>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace BT\News\Block\Adminhtml\News\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{
    protected $_wysiwygConfig;

    protected $_customergroup;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \BT\News\Model\Status $status,
        array $data = []
    ) {
        $this->_status = $status;
        $this->_customergroup = $customerGroup;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('News Status');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('News Status');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('news');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('news_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('News Status')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
       
        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status', 'label' => __('Status'), 'title' => __('Status'),  'values' => $this->getStatusTypes()]
        );

        $fieldset->addField(
            'imageupload',
            'image',
            ['name' => 'imageupload', 'label' => __('Image Upload'), 'title' => __('Image Upload')]
        )->setAfterElementHtml('
        <div class="field-tooltip toggle">
            <div class="field-tooltip-content">
                 <span>(Please Upload 200 x 200px image)</span>
            </div>
        </div>
        ');

        $fieldset->addField(
            'link',
            'text',
            ['name' => 'link', 'label' => __('Link'), 'title' => __('Link'), 'required' => true]
        );

        $fieldset->addField(
            'description',
            'editor',
            ['name' => 'description', 'label' => __('Description'), 'title' => __('Description'), 'required' => true, 'config' => $this->_wysiwygConfig->getConfig()]
        );
       
        
    //     $fieldset->addField(
    //         'iconupdate',
    //         'image',
    //         ['name' => 'iconupdate', 'label' => __('Icon Upload'), 'title' => __('Icon Upload')]
    //     )->setAfterElementHtml('
    //     <div class="field-tooltip toggle">
    //         <div class="field-tooltip-content">
    //              <span>(Please Upload 30 x 30px image)</span>
    //         </div>
    //     </div>
    // ');
    //     $fieldset->addField(
    //         'customergroup',
    //         'multiselect',
    //         ['name' => 'customergroup', 'label' => __('Customer Group'), 'title' => __('Customer Group'),  'values' => $this->getCustomerGroupOption()]
    //     );
    //     $fieldset->addField(
    //         'eventdate',
    //         'date',
    //         ['name' => 'eventdate', 'label' => __('Eventdate'), 'title' => __('Eventdate'),'date_format' => 'M/d/Y','class' => 'validate-date validate-date-range date-range-task_data-from',
    //         'class' => 'required-entry']
    //     );
        

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
    public function getCustomerGroupOption()
    {
        $customerGroupsCollection = $this->_customergroup->toOptionArray();
        return $customerGroupsCollection;
    }
    protected function getStatusTypes()
    {
        // $result = [
        //     'label' => '',
        //     'value' => '',
        // ];
        $collection = $this->_status->toOptionArray();
        foreach ($collection as $type) {
            $result[] = $type;
        }
        return $result;
    }
}
