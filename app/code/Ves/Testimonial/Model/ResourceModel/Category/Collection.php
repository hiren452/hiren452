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

namespace Ves\Testimonial\Model\ResourceModel\Category;

use \Ves\Testimonial\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'category_id';


    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ves\Testimonial\Model\Category', 'Ves\Testimonial\Model\ResourceModel\Category');
        $this->_map['fields']['store'] = 'store_table.store_id';

    }//end _construct()


    /**
     * Add filter by store
     *
     * @param  int|array|\Magento\Store\Model\Store $store
     * @param  bool                                 $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }

        return $this;

    }//end addStoreFilter()


    /**
     * Returns pairs category_id - title
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('category_id', 'title');

    }//end toOptionArray()


}//end class
