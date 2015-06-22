/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

describe("Report is generated properly", function () {
    this.timeout(0);

    this.fixture = "Piwik\\Plugins\\EvenOddTime\\tests\\Fixtures\\ManyVisits";

    before(function () {
        testEnvironment.configOverride = {
            General: {
                testmode: 'true'
            }
        };
        testEnvironment.pluginsToLoad = ['EvenOddTime'];
        testEnvironment.save();
    });

    it('should load a report by its module and action and take a full screenshot', function (done) {
        var screenshotName = 'simple_report_full';
        var urlToTest = '?module=Widgetize&action=iframe&idSite=1&period=year&date=2015-06-18' +
            '&moduleToWidgetize=EvenOddTime&actionToWidgetize=getEvenOddReport';

        expect.screenshot(screenshotName).to.be.capture(function (page) {
            page.load(urlToTest);
        }, done);
    });
});