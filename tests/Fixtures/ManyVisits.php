<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\EvenOddTime\tests\Fixtures;

use Piwik\Tests\Framework\Fixture;
use Piwik\Tracker;

class ManyVisits extends Fixture
{
    /**
     * @var string
     */
    public $dateTime;

    /**
     * @var int
     */
    protected $iterations = 0;

    /**
     * @var int
     */
    public $idSite = 1;

    public function setUp()
    {
        $date = new \DateTime('2015-06-22');
        $this->dateTime = $date->format('Y-m-d');
        $this->setUpWebsite();
        $this->trackVisits();
    }

    public function tearDown()
    {
    }

    private function setUpWebsite()
    {
        self::createWebsite($this->dateTime, $ecommerce = 0, 'Site 1');
    }

    /**
     * @throws \Exception
     */
    protected function trackVisits()
    {
        $tracker = self::getTracker(1, $this->dateTime, $defaultInit = true, true);

        for ($i = 0; $i <= 60; $i++) {
            $tracker->setForceNewVisit(true);
            $tracker->setForceVisitDateTime($this->getVisitTime());
            $tracker->setUrl('http://example.com/');

            self::checkResponse($tracker->doTrackPageView('Viewing homepage'));
        }
    }

    /**
     * @return \DateTime
     */
    private function getVisitTime()
    {
        $this->iterations++;

        if ($this->iterations % 3 === 0) {
            return $this->dateTime . ' 11:00:01';
        } else {
            return $this->dateTime . ' 10:00:02';
        }
    }
}
