<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RbcTest\FWordsCleaner\FWordChecker\SimpleAlgorithm;

final class SimpleAlgorithmTest extends TestCase
{
    private SimpleAlgorithm $simpleAlgorithm;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->simpleAlgorithm = new SimpleAlgorithm();
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @dataProvider isIncludedDataProvider
     */
    public function testIsIncluded(string $message, bool $expected): void
    {
        $this->assertSame($expected, $this->simpleAlgorithm->isIncluded($message));
    }

    public function isIncludedDataProvider(): array
    {
        return [
            ['lol', false],
            ['test message', false],
            ['fuck off', true],
            ['fuck.', true],
            ['блеать', true],
        ];
    }
}
