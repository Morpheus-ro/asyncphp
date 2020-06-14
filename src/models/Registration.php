<?php

declare(strict_types=1);

namespace Bulakh\Models;

use Bulakh\Infrastructure\RegisterRequest;

class Registration
{
    protected $providerId = '';
    protected $ticketCode = '';

    public function __construct($ticketCode, $providerId)
    {
        $this->providerId = $providerId;
        $this->ticketCode = $ticketCode;
    }

    public function register(): void
    {
        RegisterRequest::send($this->ticketCode, $this->providerId);
    }

    public function getTicketCode(): string
    {
        return $this->ticketCode;
    }

    public function getProviderId(): string
    {
        return $this->providerId;
    }
}