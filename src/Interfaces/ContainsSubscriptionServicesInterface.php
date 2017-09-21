<?php

namespace AccessManager\Services\Interfaces;

/**
 * Interface ContainsSubscriptionServicesInterface
 * @package AccessManager\Services\Interfaces
 */
interface ContainsSubscriptionServicesInterface
{
    public function primaryPolicy();

    public function aqPolicy();

    public function limits();
}