<?php

namespace Piwik\Plugins\EvenOddTime;

use Piwik\Menu\MenuReporting;
use Piwik\Piwik;

class Menu extends \Piwik\Plugin\Menu
{
    /**
     * @param MenuReporting $menu
     */
    public function configureReportingMenu(MenuReporting $menu)
    {
        $menu->addVisitorsItem(
            Piwik::translate('Even/Odd Report'),
            $this->urlForAction('getEvenOddReport'),
            $orderId = 30
        );
    }
}
