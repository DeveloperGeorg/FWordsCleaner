<?php

declare(strict_types=1);

namespace RbcTest\FWordsCleaner\UseCase\CheckMessageAndBanUser;

use RbcTest\FWordsCleaner\FWordChecker\FWordCheckerInterface;
use RbcTest\FWordsCleaner\UserBanDelegate\UserBanDelegateInterface;

class Handler
{
    public function __construct(
        private FWordCheckerInterface $fWordChecker,
        private UserBanDelegateInterface $userBanDelegate
    )  {
    }

    public function handle($channel, $user, string $message): void
    {
        if ($this->fWordChecker->isIncluded($message)) {
            $this->userBanDelegate->ban($channel, $user);
        }
    }
}