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

namespace Ves\Testimonial\Model\Config\Source;

class Gender implements \Magento\Framework\Option\ArrayInterface
{


    public function toOptionArray()
    {
        return [
                [
                 'value' => 'mal',
                 'label' => __('Male'),
                ],
                [
                 'value' => 'female',
                 'label' => __('Female'),
                ],
               ];

    }//end toOptionArray()


}//end class
