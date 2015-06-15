<?php

namespace Piwik\Plugins\EvenOddTime;

use Piwik\Archive;
use Piwik\DataTable;
use Piwik\DataTable\Row;

class API extends \Piwik\Plugin\API
{

    /**
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getEvenOddReport($idSite, $period, $date, $segment = false)
    {
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dt = $archive->getDataTable(Archiver::EVENODDTIME_ARCHIVE_RECORD);

        return $dt;
    }
}
