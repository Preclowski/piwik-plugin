<?php

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
