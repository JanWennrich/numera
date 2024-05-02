<?php
/**
 *      ****  *  *     *  ****  ****  *    *
 *      *  *  *  * *   *  *  *  *  *   *  *
 *      ****  *  *  *  *  *  *  *  *    *
 *      *     *  *   * *  *  *  *  *   *  *
 *      *     *  *    **  ****  ****  *    *
 * @author   Pinoox
 * @link https://www.pinoox.com/
 * @license  https://opensource.org/licenses/MIT MIT License
 */

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Pino\Numera;

final class GermanTest extends TestCase
{
    private function createGermanNumeraInstance(): Numera
    {
        return Numera::init('de-DE');
    }

    #[Test]
    #[TestWith([
        4_454_545_156,
        '4.454.545.156'
    ])]
    public function convert_number_to_words(int|string $number)
    {
        $sut = $this->createGermanNumeraInstance();

        $result = $sut->convertToWords($number);

        $this->assertEquals(
            'vier Milliarden vierhundertvierundfünfzig Millionen fünfhundertfünfundvierzigtausendeinhundertsechsundfünfzig',
            $result
        );
    }

    #[Test]
    #[TestWith([
        4_454_545_156,
        '4.454.545.156'
    ])]
    public function convert_number_to_words_in_camelcase()
    {
        $sut = $this->createGermanNumeraInstance();
        $sut->setCamelCase(true);

        $result = $sut->convertToWords(4_454_545_156);

        $this->assertEquals(
            'Vier Milliarden Vierhundertvierundfünfzig Millionen Fünfhundertfünfundvierzigtausendeinhundertsechsundfünfzig',
            $result
        );
    }

    #[Test]
    #[TestWith([
        4_454_545_156,
        '4.454.545.156'
    ])]
    public function convert_number_to_summary(int|string $number)
    {
        $sut = $this->createGermanNumeraInstance();

        $result = $sut->convertToSummary($number);

        $this->assertEquals(
            '4 Milliarden, 454 Millionen, 545 Tausend, 156',
            $result
        );
    }

    #[Test]
    public function convert_words_to_number()
    {
        $sut = $this->createGermanNumeraInstance();

        $result = $sut->convertToNumber(
            'vier Milliarden vierhundertvierundfünfzig Millionen fünfhundertfünfundvierzigtausendeinhundertsechsundfünfzig'
        );

        $this->assertEquals(4_454_545_156, $result);
    }

    #[Test]
    public function convert_words_in_camelcase_to_number()
    {
        $sut = $this->createGermanNumeraInstance();
        $sut->setCamelCase(true);

        $result = $sut->convertToNumber(
            'Vier Milliarden Vierhundertvierundfünfzig Millionen Fünfhundertfünfundvierzigtausendeinhundertsechsundfünfzig'
        );

        $this->assertEquals(4_454_545_156, $result);
    }
}
