<?php
/**
 * Copyright (c) 2020, Zillion Insurance Services, Inc.
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *   * Redistributions of source code must retain the above copyright notice,
 *     this list of conditions and the following disclaimer.
 *   * Redistributions in binary form must reproduce the above copyright notice,
 *     this list of conditions and the following disclaimer in the documentation
 *     and/or other materials provided with the distribution.
 *   * Neither the name of Zend Technologies USA, Inc. nor the names of its
 *     contributors may be used to endorse or promote products derived from this
 *     software without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @package myzillion
 * @subpackage module-simplified-insurance
 * @author Serfe <info@serfe.com>
 * @copyright 2020 Zillion Insurance Services, Inc.
 * @since 1.0.0
 */

namespace MyZillion\SimplifiedInsurance\Model\Config\Source;

/**
 * Source model for Zillion offer types
 *
 * @author Maximo Marucci | Serfe Team <maximo@serfe.com>
 */
class SelectDefault implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $arr = [];
        $arr[] = [
            'value' => 0,
            'label' => __('-- Please Select an Option --'),
        ];

        $listDefaultValues = $this->listDefaultValues();

        foreach ($listDefaultValues as $defaulValue) {
            $arr[$defaulValue['value']] = $defaulValue['label'];
        }

        return $arr;
    }

    /**
     * Default options
     *
     * @return array
     */
    private function listDefaultValues() {
        $values =[
            ['value' => 'sku', 'label' => 'SKU']
        ];
        return $values;
    }
}
