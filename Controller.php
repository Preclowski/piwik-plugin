<?php

namespace Piwik\Plugins\EvenOddTime;

use Piwik\View;

class Controller extends \Piwik\Plugin\Controller
{
    /**
     * @return string
     * @throws \Exception
     */
    public function getEvenOddReport()
    {
        return $this->renderReport(__FUNCTION__);
    }
}
