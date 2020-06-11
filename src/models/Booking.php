<?php
declare(strict_types=1);

namespace Bulakh\Models;

use Bulakh\Services\LoggingService;

class Booking {
    protected $bookingNumber = null;
    protected $ticket = null;

    public function __construct()
    {
        $this->bookingNumber = uniqid("_BOOKING_");
    }

    public function setTicket(Ticket $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function getBookingNumber(): string
    {
        return $this->bookingNumber;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function save(): bool
    {
        LoggingService::getLogger()->info("Booking saved", [$this->getBookingNumber()]);

        return true;
    }

    public function getInfo(): array
    {
        return [
            'booking_number' => $this->getBookingNumber(),
            'ticket_code' => $this->getTicket()->getCode(),
        ];
    }
}