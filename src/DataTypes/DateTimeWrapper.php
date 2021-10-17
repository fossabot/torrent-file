<?php

namespace SandFox\Torrent\DataTypes;

use SandFox\Bencode\Types\BencodeSerializable;

/**
 * Wrapper for nullable datetime
 *
 * @internal
 */
final class DateTimeWrapper implements BencodeSerializable
{
    private ?\DateTimeImmutable $dateTime;

    public function __construct(?\DateTimeImmutable $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * From the value that may happen in TorrentFile::$data
     * @param self|int|null $value
     */
    public static function fromDataValue($value): self
    {
        if ($value instanceof self) {
            return $value;
        }

        return self::fromTimestamp($value);
    }

    /**
     * From the value that is hinted in setCreationDate()
     * @param int|\DateTimeInterface|null $value
     */
    public static function fromExternalValue($value): self
    {
        if (is_integer($value)) {
            return self::fromTimestamp($value);
        }

        return self::fromDateTime($value);
    }

    public static function fromTimestamp(?int $timestamp): self
    {
        return new self($timestamp !== null ? new \DateTimeImmutable('@' . $timestamp) : null);
    }

    public static function fromDateTime(?\DateTimeInterface $dateTime): self
    {
        // TODO: PHP 8.0: return new self($dateTime ? \DateTimeImmutable::createFromInterface($dateTime) : null);
        return self::fromTimestamp($dateTime ? $dateTime->getTimestamp() : null);
    }

    public function getDateTime(): ?\DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function getTimestamp(): ?int
    {
        return $this->dateTime ? $this->dateTime->getTimestamp() : null;
    }

    public function bencodeSerialize(): ?int
    {
        return $this->getTimestamp();
    }
}