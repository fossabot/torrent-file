<?php

declare(strict_types=1);

namespace Arokettu\Torrent\V1;

use Arokettu\Torrent\DataTypes\Internal\InfoDict;

final class Info
{
    private ?string $infoHash = null;

    public function __construct(
        private readonly InfoDict $info,
    ) {}

    public function getInfoHash(bool $binary = false): string
    {
        $this->infoHash ??= sha1($this->info->infoString, true);
        return $binary ? $this->infoHash : bin2hex($this->infoHash);
    }
}
