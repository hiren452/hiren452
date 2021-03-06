<?php
/**
 * Plumrocket Inc.
 * NOTICE OF LICENSE
 * This source file is subject to the End-user License Agreement
 * that is available through the world-wide-web at this URL:
 * http://wiki.plumrocket.net/wiki/EULA
 * If you are unable to obtain it through the world-wide-web, please
 * send an email to support@plumrocket.com so we can send you a copy immediately.
 *
 * @package     Plumrocket Search Autocomplete & Suggest
 * @copyright   Copyright (c) 2019 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

namespace Plumrocket\Search\Model\System\Config\Source;

use Plumrocket\Search\Helper\Search;

class Andor implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var null
     */
    private $options = null;

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_getOptions();
    }

    /**
     * @return array|null
     */
    private function _getOptions()
    {
        if (null === $this->options) {
            $this->options = [
                ['value' => Search::CONDITION_AND, 'label' => __('All words must be present')],
                ['value' => Search::CONDITION_OR, 'label'  => __('At least one word must be present')],
            ];
        }

        return $this->options;
    }
}
