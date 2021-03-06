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

namespace Ves\Testimonial\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action\UrlBuilder;
use Magento\Framework\UrlInterface;

class TestimonialActions extends Column
{
    /**
 * Url path
*/
    const MENU_URL_PATH_EDIT   = 'testimonial/testimonial/edit';
    const MENU_URL_PATH_DELETE = 'testimonial/testimonial/delete';

    /**
     *
     *
     * @var UrlBuilder
     */
    protected $actionUrlBuilder;

    /**
     *
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;


    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder         $actionUrlBuilder
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     * @param [type]             $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlBuilder $actionUrlBuilder,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::MENU_URL_PATH_EDIT
    ) {
        $this->urlBuilder       = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->editUrl          = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);

    }//end __construct()


    /**
     * Prepare Data Source
     *
     * @param  array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['testimonial_id'])) {
                    $item[$name]['edit'] = [
                                            'href'  => $this->urlBuilder->getUrl($this->editUrl, ['testimonial_id' => $item['testimonial_id']]),
                                            'label' => __('Edit'),
                                           ];
                    /*
                        $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::MENU_URL_PATH_DELETE, ['category_id' => $item['category_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                        'title' => __('Delete ${ $.$data.title }'),
                        'message' => __('Are you sure you wan\'t to delete a ${ $.$data.title } record?')
                        ]
                    ];*/
                }
            }
        }

        return $dataSource;

    }//end prepareDataSource()


}//end class
