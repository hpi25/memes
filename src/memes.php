<?php declare(strict_types=1);

use danog\MadelineProto\API;
use danog\MadelineProto\Settings;
use danog\MadelineProto\Settings\AppInfo;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . "/../vendor/autoload.php";

const CHANNEL_ID = -1789956480;

/**
 * @throws \danog\MadelineProto\Exception
 */
function make_client(): API
{
    new Dotenv()->load(__DIR__ . "/../.env");

    $apiId = $_ENV["API_ID"];
    $apiHash = $_ENV["API_HASH"];

    if (!$apiId || !$apiHash) {
        die("Env vars unset");
    }

    $settings = new Settings()
        ->setAppInfo(
            new AppInfo()->setApiId(intval($apiId))->setApiHash($apiHash),
        )
        ->setPeer(new Settings\Peer()->setFullFetch(true));

    $client = new API("session.madeline", $settings);
    $client->start();

    return $client;
}

/**
 * @throws \danog\MadelineProto\Exception
 */
function get_memes(): array
{
    $client = make_client();

    $messages = $client->messages->getHistory([
        "peer" => CHANNEL_ID,
        "offset_id" => 0,
        "limit" => 100,
    ]);

    var_dump($messages);
    // $client->channels->inviteToChannel();

    return [
        "url" => "",
        "user" => "",
    ];
}
