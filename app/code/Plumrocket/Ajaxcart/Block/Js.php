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
 * @package     Plumrocket Ajaxcart v2.x.x
 * @copyright   Copyright (c) 2019 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

namespace Plumrocket\Ajaxcart\Block;

/**
 * Class Js
 *
 * @package Plumrocket\Ajaxcart\Block
 */
class Js extends \Plumrocket\Ajaxcart\Block\WorkMode\Js
{
    /**
     * @return string
     */
    public function toHtml()
    {
        if (!$this->dataHelper->moduleEnabled()) {
            return '';
        }

        return  '<div id="pac-popup-content" style="display:none;"></div>
                <script>
                    require([
                        "jquery",
                        "Plumrocket_Ajaxcart/js/prajaxcart",
                        "Magento_Catalog/product/view/validation",
                        "domReady!"
                    ], function ($, prajaxcart) {

                        //Prepare AddToCart buttons
                        prajaxcart.setConfig(' . $this->getConfig() . ').prepareForms();
                        
                         if (typeof window.plumrocket === "undefined") {
                            window.plumrocket = {};
                        }

                        //check if event is is not allready binded
                        //fix for ajax categories to prevent multiple binding
                        if (typeof window.prajaxCartPrepared == "undefined") {
                            $(document).on("click", "button[prajaxCart=' . "'submit-button'" . '], a[prajaxCart=' . "'submit-button'" . ']", function() {
                                var button = $(this);
                                if (button.hasClass("addFromWishList")) {
                                    prajaxcart.addFromWishList(button);
                                } else {
                                    prajaxcart.addToCart(button);
                                }
                            });
                            window.prajaxCartPrepared = true;
                        }
                        
                        window.plumrocket.ajaxCart = prajaxcart;
                    });
                </script>';
    }
}
