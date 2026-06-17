<?php

namespace WCHubSpot\Contracts;

interface LoggerInterface
{
    public function log(string $message): void;
}