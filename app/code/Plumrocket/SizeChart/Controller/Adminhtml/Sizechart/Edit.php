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
 * @package     Plumrocket_SizeChart
 * @copyright   Copyright (c) 2015 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

namespace Plumrocket\SizeChart\Controller\Adminhtml\Sizechart;

class Edit extends \Plumrocket\SizeChart\Controller\Adminhtml\Sizechart
{
    /**
     * {@inherited}
     */
    protected function _beforeAction()
    {
        $model = $this->_getModel();

        if ($model->getId()) {
            $content = $model->getContent();
            $editedContent = preg_replace_callback('/{{(view|media).*}}/', function ($matches) {
                return str_replace('"', '\'', $matches[0]);
            }, $content);

            $model->setContent($editedContent);
        }
    }
}
