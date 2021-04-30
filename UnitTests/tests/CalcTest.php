<?php

use PHPUnit\Framework\TestCase;

final class CalcTest extends TestCase
{
    private $calc;

    protected function setUp(): void
    {
        $this->calc = new Calc();
    }

    protected function tearDown(): void
    {
        $this->calc = null;
    }

    /**
     * @dataProvider validSumProvider
     */
    public function testReturnValidSumWithTwoIntProvided($sum, $a, $b): void
    {
        $this->assertEquals($sum, $this->calc->sum($a, $b));
    }

    public function validSumProvider(): array
    {
        return [
            [99, 33, 66],
            [50, 25, 25],
            [0, 5, -5],
            [-21, -7, -14],
        ];
    }

    /**
     * @dataProvider incorrectEntryDataProvider
     */
    public function testThrowExceptionWhenIncorrectEntryData($a, $b): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->calc->sum($a, $b);
    }

    public function incorrectEntryDataProvider(): array
    {
        return [
            ['a', 1.2],
            [1.5, 1.99],
            ['a', null]
        ];
    }
}
