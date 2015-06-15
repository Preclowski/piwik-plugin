<?php

namespace Piwik\Plugins\EvenOddTime;

use Piwik\Plugin\ViewDataTable;

class EvenOddTime extends \Piwik\Plugin
{
    /**
     * @return array
     */
    public function getListHooksRegistered()
    {
        return array(
            'ViewDataTable.configure' => 'configureViewDataTable'
        );
    }

    /**
     * @param ViewDataTable $view
     */
    public function configureViewDataTable(ViewDataTable $view)
    {
        switch ($view->requestConfig->apiMethodToRequestDataTable) {
            case 'EvenOddTime.getEvenOddReport':
                $view->config->show_limit_control = true;
                $view->config->show_search = false;
                $view->config->show_goals = false;
                $view->config->columns_to_display = array('label', 'nb_visits');

                break;
        }
    }
}
