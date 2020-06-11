<?php
declare(strict_types=1);

namespace Bulakh\Infrastructure;

class RegisterRequest
{
    public static function send(string $ticketCode, string $providerId): void
    {
        do {
            $result = boolval(rand(0, 1));

            if ($result) {
                echo sprintf("OK: %s by %s\n", $ticketCode, $providerId);
            } else {
                echo sprintf("FAIL: %s by %s\n", $ticketCode, $providerId);
            }
        } while (!$result);
    }
}