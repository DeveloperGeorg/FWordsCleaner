<?php

declare(strict_types=1);

namespace RbcTest\FWordsCleaner\FWordChecker;

interface FWordCheckerInterface
{
    public function isIncluded(string $message): bool;
}