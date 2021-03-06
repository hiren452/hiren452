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
 * @package     Plumrocket_Base
 * @copyright   Copyright (c) 2020 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

declare(strict_types=1);

namespace Plumrocket\Base\Model\Utils;

use Magento\Store\Model\StoreManagerInterface;

/**
 * @since 2.3.1
 */
class GetRelativePathFromUrl
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
    }

    /**
     * @param string $url
     * @param bool   $removeGetParams
     * @param bool   $removeFragment
     * @return string
     */
    public function execute(string $url, bool $removeGetParams = true, bool $removeFragment = true): string
    {
        $baseUrl = $this->endSlash($this->storeManager->getStore()->getBaseUrl());

        $url = str_replace(["\n", "\r"], '', $url);

        if ($removeGetParams && $this->hasParams($url)) {
            $paramsWithFragment = strstr($url, '?');
            if ($removeFragment) {
                $url = str_replace($paramsWithFragment, '', $url);
            } else {
                $url = str_replace(strstr($paramsWithFragment, '#', true), '', $url);
            }
        }

        if ($removeFragment && $this->hasFragment($url)) {
            $url = str_replace(strstr($url, '#'), '', $url);
        }

        if (! $this->hasParams($url) && ! $this->hasFragment($url)) {
            $url = $this->endSlash($url);
        }

        $url = str_replace($baseUrl, '', $url);
        if ('' === $url || $url[0] !== '/') {
            $url = '/' . $url;
        }

        return $url;
    }

    /**
     * Add slash to end of line
     *
     * @param string $path
     * @return string
     */
    private function endSlash(string $path): string
    {
        return rtrim($path, '/') . '/';
    }

    /**
     * @param string $url
     * @return bool
     */
    private function hasParams(string $url): bool
    {
        return strpos($url, '?') !== false;
    }

    /**
     * @param string $url
     * @return bool
     */
    private function hasFragment(string $url): bool
    {
        return strpos($url, '#') !== false;
    }
}
