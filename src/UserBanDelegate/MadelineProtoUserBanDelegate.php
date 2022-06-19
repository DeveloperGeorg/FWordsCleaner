<?php

namespace RbcTest\FWordsCleaner\UserBanDelegate;

use danog\MadelineProto\APIFactory;

class MadelineProtoUserBanDelegate implements UserBanDelegateInterface
{
    public function __construct(private APIFactory $apiFactory)
    {
    }

    public function ban($channel, $user): void
    {
        $chatBannedRights = [
            '_' => 'chatBannedRights',
            'view_messages' => true,
            'send_messages' => true,
            'send_media' => true,
            'send_stickers' => true,
            'send_gifs' => true,
            'send_games' => true,
            'send_inline' => true,
            'embed_links' => true,
            'send_polls' => true,
            'change_info' => true,
            'invite_users' => true,
            'pin_messages' => true,
            'until_date' => 0
        ];
        $this->apiFactory->channels->editBanned([
                                              'channel' => $channel,
                                              'participant' => $user,
                                              'banned_rights' => $chatBannedRights
                                          ]);
    }
}