<?php

declare(strict_types=1);

namespace SandFox\Torrent\DataTypes\Internal;

use Arokettu\Bencode\Types\BencodeSerializable;
use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * @internal
 * @template TKey
 * @template TValue
 * @extends ArrayAccess<TKey, TValue>
 * @extends IteratorAggregate<TKey, TValue>
 */
interface StorageInterface extends ArrayAccess, Countable, IteratorAggregate, BencodeSerializable
{
    public function toArray(): array;
}
