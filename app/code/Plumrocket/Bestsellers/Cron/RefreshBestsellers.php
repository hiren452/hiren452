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
 * @package     Plumrocket_Bestsellers
 * @copyright   Copyright (c) 2019 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */
declare(strict_types=1);

namespace Plumrocket\Bestsellers\Cron;

class RefreshBestsellers
{
    /**
     * @var \Plumrocket\Bestsellers\Model\BestsellersReport
     */
    private $bestsellersReport;

    /**
     * @param \Plumrocket\Bestsellers\Model\BestsellersReport $bestsellersReport
     */
    public function __construct(
        \Plumrocket\Bestsellers\Model\BestsellersReport $bestsellersReport
    ) {
        $this->bestsellersReport = $bestsellersReport;
    }

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $this->bestsellersReport->refresh();
    }
}