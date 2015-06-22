<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

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
