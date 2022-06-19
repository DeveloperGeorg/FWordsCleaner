<?php

declare(strict_types=1);

require 'autoload.php';

use danog\MadelineProto\Logger;
use danog\MadelineProto\Settings;
use RbcTest\FWordsCleaner\EventHandler\BotEventHandler;

$settings = new Settings();
$settings->getLogger()->setLevel(Logger::LEVEL_ULTRA_VERBOSE);
BotEventHandler::startAndLoop($_ENV['SESSION_FILE_NAME'], $settings);
