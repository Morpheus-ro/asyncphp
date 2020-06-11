<?php
declare(strict_types=1);

class Provider
{
    protected $id = null;

    public function __construct()
    {
        $this->id = uniqid("_PROVIDER_");
    }

    public function register(string $code): bool
    {
        sleep(1);

        return true;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}

class Ticket
{
    protected $code = null;

    public function __construct()
    {
        $this->code = uniqid("_TICKET_");
        $this->register(...$this->getProviders());
    }

    public function register(Provider ...$providers): void
    {
        foreach ($providers as $provider) {
            $provider->register($this->code);
        }
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getProviders(): array
    {
        $providers = [];

        for ($i = 0; $i < rand(5,20); $i++) {
            $providers[] = new Provider();
        }

        return $providers;
    }
}

class Booking {
    protected $bookingNumber = null;
    protected $ticket = null;

    public function __construct()
    {
        $this->bookingNumber = uniqid("_BOOKING_");
    }

    public function place(): array
    {
        $executionMetric = microtime(true);

        $this->ticket = new Ticket();

        return [
            'booking_number' => $this->getBookingNumber(),
            'ticket_code' => $this->getTicket()->getCode(),
            'execution_time' => round(microtime(true) - $executionMetric, 3),
        ];
    }

    public function getBookingNumber(): string
    {
        return $this->bookingNumber;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }
}

###############

$booking = new Booking();
$result = $booking->place();
echo json_encode($result, JSON_PRETTY_PRINT) . "\n";