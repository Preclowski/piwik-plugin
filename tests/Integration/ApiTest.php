<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\EvenOddTime\tests\Integration;

use Piwik\Plugins\EvenOddTime\API;
use Piwik\Plugins\EvenOddTime\tests\Fixtures\ManyVisits;
use Piwik\Tests\Framework\TestCase\IntegrationTestCase;

/**
 * @group EvenOddTime
 * @group ApiTest
 * @group Plugins
 */
class ApiTest extends IntegrationTestCase
{
    /**
     * @test
     *
     * @throws mixed
     */
    public function apiMethodsReturnExpectedResult()
    {
        $this->runApiTests('EvenOddTime.getEvenOddReport', array(
            'idSite' => self::$fixture->idSite,
            'date' => 'today'
        ));
    }

    /**
     * @test
     */
    public function reportResultCountAsExpected()
    {
        $api = API::getInstance()->getEvenOddReport(self::$fixture->idSite, 'day', 'today');

        $this->assertEquals(2, $api->getRowsCount());
    }

    /**
     * @test
     */
    public function emptyReportReturnNothing()
    {
        $api = API::getInstance()->getEvenOddReport(self::$fixture->idSite, 'day', '2000-01-01');

        $this->assertEquals(0, $api->getRowsCount());
    }
}

ApiTest::$fixture = new ManyVisits;