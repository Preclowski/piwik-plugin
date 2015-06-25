<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\EvenOddTime;

use Piwik\DataTable;
use Piwik\Metrics;
use Piwik\Piwik;

class Archiver extends \Piwik\Plugin\Archiver
{
    const EVENODDTIME_ARCHIVE_RECORD = "EvenOddTime_archive_record";

    /**
     * @throws \Exception
     */
    public function aggregateDayReport()
    {
        $archiveProcessor = $this->getProcessor();
        $logAggregator = $this->getLogAggregator();
        $query = $logAggregator->queryVisitsByDimension(array('MOD(HOUR(log_visit.visit_last_action_time), 2)'));

        if (!$query) {
            return;
        }

        $dt = $this->prepareDataTable($query->fetchAll());

        $archiveProcessor->insertBlobRecord(self::EVENODDTIME_ARCHIVE_RECORD, $dt->getSerialized($this->maximumRows));
    }

    /**
     * @param array $data
     *
     * @return DataTable
     */
    private function prepareDataTable(array $data)
    {
        $dt = new DataTable;

        $dt->addRowsFromSimpleArray(array(
            array(
                'label' => Piwik::translate('Even'),
                'nb_visits' => isset($data[0]) ? $data[0][Metrics::INDEX_NB_VISITS] : 0
            ),
            array(
                'label' => Piwik::translate('Odd'),
                'nb_visits' => isset($data[1]) ? $data[1][Metrics::INDEX_NB_VISITS] : 0
            )
        ));

        return $dt;
    }

    public function aggregateMultipleReports()
    {
         $this->getProcessor()->aggregateDataTableRecords(self::EVENODDTIME_ARCHIVE_RECORD);
    }
}
