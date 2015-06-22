<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\EvenOddTime;

use Piwik\Piwik;
use Piwik\View;

class Widgets extends \Piwik\Plugin\Widgets
{
    /**
     * @var string
     */
    protected $category = 'General_Visitors';

    protected function init()
    {
        $this->addWidget(Piwik::translate('Even/Odd time'), 'getEvenOddReport');
    }
}
