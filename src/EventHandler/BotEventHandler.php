<?php

declare(strict_types=1);

namespace RbcTest\FWordsCleaner\EventHandler;

use danog\MadelineProto\EventHandler;
use RbcTest\FWordsCleaner\FWordChecker\SimpleAlgorithm;
use RbcTest\FWordsCleaner\UseCase\CheckMessageAndBanUser;
use RbcTest\FWordsCleaner\UserBanDelegate\MadelineProtoUserBanDelegate;

class BotEventHandler extends EventHandler
{
    private ?CheckMessageAndBanUser\Handler $useCase = null;

    /**
     * List of properties automatically stored in database (MySQL, Postgres, redis or memory).
     * @see https://docs.madelineproto.xyz/docs/DATABASE.html
     * @var array
     */
    protected static array $dbProperties = [
        'dataStoredOnDb' => 'array'
    ];

    /**
     * @var DbArray<array>
     */
    protected $dataStoredOnDb;

    public function __construct($API) // BC
    {
        parent::__construct($API);
        $this->initUseCase();
    }

    /**
     * Called on startup, can contain async calls for initialization of the bot
     *
     * @return void
     */
    public function onStart()
    {
    }
    /**
     * Handle updates from supergroups and channels
     *
     * @param array $update Update
     *
     * @return void
     */
    public function onUpdateNewChannelMessage(array $update): \Generator
    {
        return $this->onUpdateNewMessage($update);
    }
    /**
     * Handle updates from users.
     *
     * @param array $update Update
     *
     * @return \Generator
     */
    public function onUpdateNewMessage(array $update): \Generator
    {
        if ($update['message']['_'] === 'messageEmpty' || $update['message']['out'] ?? false) {
            return;
        }
        if ($this->useCase === null) {
            $this->initUseCase();
        }
        yield $this->useCase?->handle(
            channel: $update['message']['peer_id'],
            user: $update['message']['from_id'],
            message: (string)$update['message']['message']
        );
    }

    private function initUseCase(): void
    {
        $this->useCase = new CheckMessageAndBanUser\Handler(
            fWordChecker:    new SimpleAlgorithm(),
            userBanDelegate: new MadelineProtoUserBanDelegate(apiFactory: $this)
        );
    }
}