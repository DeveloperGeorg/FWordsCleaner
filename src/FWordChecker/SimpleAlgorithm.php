<?php

declare(strict_types=1);

namespace RbcTest\FWordsCleaner\FWordChecker;

class SimpleAlgorithm implements FWordCheckerInterface
{
    private const OBSCENE_LANGUAGE_WORDS = [
        'fuck',
        'f*ck',
        'cunt',
        'хуй',
        'блять',
        'блеать',
    ];

    private array $obsceneLanguageWords = self::OBSCENE_LANGUAGE_WORDS;

    public function __construct(?array $obsceneLanguageWords = null)
    {
        if ($obsceneLanguageWords !== null) {
            $this->obsceneLanguageWords = $obsceneLanguageWords;
        }
    }
    public function isIncluded(string $message): bool
    {
        $strRegex = implode('|', $this->obsceneLanguageWords);

        if (preg_match('/(' . $strRegex . ')/i', mb_strtolower($message))) {
            return true;
        }

        return false;
    }
}