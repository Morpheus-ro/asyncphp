<?php
declare(strict_types=1);

namespace Bulakh\Services;

require __DIR__ . '/../../vendor/autoload.php';

use Bulakh\Models\Booking;
use Bulakh\Models\Provider;
use Bulakh\Infrastructure\ProvidersRepository;
use Bulakh\Models\Registration;
use React\Promise\Deferred;

class RegisterService
{
    protected static $pendingRegistrationTasks = [];

    public static function registerBooking(Booking $booking)
    {
        /** @var Provider $provider */
        foreach (ProvidersRepository::getArray() as $provider) {
            $taskDeferred = new Deferred();
            $taskDeferred->promise()
                ->then(function(Registration $registration) {
                    LoggingService::getLogger()
                        ->info("Registered", [$registration->getTicketCode(), $registration->getProviderId()]);
                });

            self::$pendingRegistrationTasks[] = $taskDeferred;

            $registration = new Registration($booking->getTicket()->getCode(), $provider->getId());

            $registration->register();

            $taskDeferred->resolve($registration);

            $booking->addProvider($provider);
        }
    }
}