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

namespace Prooph\StandardProjections;

use Prooph\EventStore\Projection\Projection;

class CategoryStreamProjection
{
    /**
     * @var Projection
     */
    private $projection;

    public function __construct(Projection $projection)
    {
        $this->projection = $projection;
    }

    public function __invoke(): void
    {
        $this->projection
            ->fromAll()
            ->whenAny(function ($state, $event): void {
                $streamName = $this->streamName();
                $pos = strpos($streamName, '-');

                if (false === $pos) {
                    return;
                }

                $category = substr($streamName, 0, $pos);

                $this->linkTo('$ct-' . $category, $event);
            })
            ->run();
    }
}