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
        $query = $logAggregator->queryVisitsByDimension(array('MOD(HOUR(log_visit.visitor_localtime), 2)'));

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
                'nb_visits' => $data[0][Metrics::INDEX_NB_VISITS]
            ),
            array(
                'label' => Piwik::translate('Odd'),
                'nb_visits' => $data[1][Metrics::INDEX_NB_VISITS]
            )
        ));

        return $dt;
    }

    public function aggregateMultipleReports()
    {
         $this->getProcessor()->aggregateDataTableRecords(self::EVENODDTIME_ARCHIVE_RECORD);
    }
}
