<?php

declare(strict_types=1);

namespace RbcTest\FWordsCleaner\UserBanDelegate;

interface UserBanDelegateInterface
{
    public function ban($channel, $user);
}