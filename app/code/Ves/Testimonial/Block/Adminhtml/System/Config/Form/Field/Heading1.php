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

namespace Ves\Testimonial\Block\Adminhtml\System\Config\Form\Field;
use Magento\Config\Block\System\Config\Form\Field;

class Heading1 extends Field
{


    /**
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $fieldConfig = $element->getFieldConfig();
        $htmlId      = $element->getHtmlId();
        $html        = '<tr id="row_'.$htmlId.'">'.'<td class="label" colspan="3">';

        $html .= '<div style="border-bottom: 1px solid #dfdfdf;
        font-size: 15px;
        color: #666;
        border-left: #CCC solid 5px;
        padding: 2px 12px;
        text-align: left !important;
        margin-left: 10%;
        margin-top: 20px;">';
        $html .= $element->getLabel();
        $html .= '</div></td></tr>';

        return $html;

    }//end render()


}//end class
