<?php
/**
 * This file is part of the prooph/standard-projections.
 * (c) 2016-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2016-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ProophTest\StandardProjections\Mock;

class TestDomainEvent extends \ProophTest\EventStore\Mock\TestDomainEvent
{
    public static function withPayloadAndMessageName(array $payload, int $version, string $messageName): TestDomainEvent
    {
        $event = new static($payload);
        $event->messageName = $messageName;

        return $event->withVersion($version);
    }
}
