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
 * @package     Plumrocket_Newsletterpopup
 * @copyright   Copyright (c) 2017 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

namespace Plumrocket\Newsletterpopup\Block;

use Plumrocket\Newsletterpopup\Block\Popup\Integration as BlockIntegration;

/**
 * Class Popup
 */
class Popup extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Plumrocket\Newsletterpopup\Helper\Data
     */
    protected $_dataHelper;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;

    /**
     * @var bool
     */
    protected $_noAnimation = false;

    /**
     * @var bool
     */
    protected $_hasPsloginCall = false;

    /**
     * @var string
     */
    protected $_template = 'templates/prnewsletterpopup-system-template.phtml';

    /**
     * Popup constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Plumrocket\Newsletterpopup\Helper\Data $dataHelper
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Plumrocket\Newsletterpopup\Helper\Data $dataHelper,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data = []
    ) {
        $this->_dataHelper = $dataHelper;
        $this->_filterProvider = $filterProvider;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\View\Element\Template|void
     */
    public function _prepareLayout()
    {
        parent::_prepareLayout();

        $layout = $this->getLayout();

        $this->setChild(
            'popup.fields',
            $layout->createBlock(
                'Plumrocket\Newsletterpopup\Block\Popup\Fields'
            )
        );

        $this->setChild(
            'popup.integration',
            $layout->createBlock(BlockIntegration::class)
        );
    }

    /**
     * @return null|\Plumrocket\Newsletterpopup\Model\Popup
     */
    public function getPopup()
    {
        if (! $this->hasData('popup')) {
            $this->setData('popup', $this->_dataHelper->getCurrentPopup());
        }

        return $this->getData('popup');
    }

    /**
     * @return string
     */
    public function getPopupTemplate()
    {
        $popup = $this->getPopup();
        $code = $popup->getCode();
        $hasContactLists = $this->hasPlaceholder('{{contact_lists}}');

        $code = str_replace(
            $this->_dataHelper->getTemplatePlaceholders(),
            [
                $popup->getData('text_cancel'),
                $popup->getData('text_title'),
                $popup->getData('text_description'),
                $hasContactLists ? $this->getChildHtml('popup.fields') : $this->getChildHtml(),
                $hasContactLists ? $this->getChildHtml('popup.integration') : '',
                $popup->getData('text_submit'),
            ],
            $code
        );

        $code = str_replace('.newspopup_up_bg', '#newspopup_up_bg_'.$popup->getId(), $code);

        if (false !== mb_strpos($code, 'window.psLogin')) {
            $this->_hasPsloginCall = true;
        }

        return $this->_filterProvider->getPageFilter()->filter($code);
    }

    /**
     * @param $placeholder
     * @return bool
     */
    public function hasPlaceholder($placeholder)
    {
        return false !== mb_strpos($this->getPopup()->getCode(), $placeholder);
    }

    /**
     * @return mixed|null|string|string[]
     */
    public function getPopupStyle()
    {
        $popup = $this->getPopup();
        $style = $popup->getStyle();

        // Use secure url for fonts.
        $style = preg_replace(
            '#{{view url=(.)Plumrocket_Newsletterpopup::css/font/(.+?)}}#ui',
            '{{view url=$1Plumrocket_Newsletterpopup::css/font/$2$1 _secure=$1true$1}}',
            $style
        );

        $style = $this->_filterProvider->getPageFilter()->filter($style);
        $id = '#newspopup_up_bg_' . $popup->getId();

        $style = preg_replace(
            [
                '/,(\s*)(\.)/m', // do not add (\.|#)  NEVER!!!
                '/^(\s*)(\.|#)/m'
            ],
            [
                ', ' . $id . ' $2',
                '$1' . $id . ' $2'
            ],
            $style
        );

        $style = str_replace(
            [
                $id . ' .newspopup_up_bg',
                $id . ' .newspopup-blur',
                $id . ' .newspopup_ov_hidden',
            ],
            [
                $id,
                '.newspopup-blur-' . $popup->getId(),
                '.newspopup_ov_hidden-' . $popup->getId(),
            ],
            $style
        );

        // $style = $this->_replaceFonts($style);

        return $style;
    }

    /*protected function _replaceFonts($content)
    {
        $to = $this->_dataHelper->getConfig('web/secure/base_url').'pub/static/frontend/$2/font$3';

        $content = preg_replace(
            [
                '/('.str_replace('/', '\/', $this->_dataHelper->getConfig('web/secure/base_static_url')).')(.*)\/font(.*)/m',
                '/('.str_replace('/', '\/', $this->_dataHelper->getConfig('web/unsecure/base_static_url')).')(.*)\/font(.*)/m'
            ],
            [
                $to,
                $to,
            ], $content);
        return $content;
    }*/

    /**
     * @return $this
     */
    public function noAnimation()
    {
        $this->_noAnimation = true;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnimation()
    {
        return $this->_noAnimation ? '' : $this->getPopup()->getAnimation();
    }

    /**
     * @return bool
     */
    public function hasPsloginCall()
    {
        return $this->_hasPsloginCall;
    }
}
