<?php

namespace Catalytic\SDK\Entities;

/**
 * Class which contains possible values for the status of an instance
 */
class InstanceStatus
{
    const RUNNING = 'running';
    const COMPLETED = 'completed';
    const CANCELLED = 'aborted';
}