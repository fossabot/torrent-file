<?php

declare(strict_types=1);

namespace SandFox\Torrent\Tests\All;

use PHPUnit\Framework\TestCase;
use SandFox\Bencode\Bencode;
use SandFox\Torrent\TorrentFile;

use function SandFox\Torrent\Tests\build_magnet_link;

class MagnetLinkTest extends TestCase
{
    public function testDN()
    {
        // simple

        $torrent = TorrentFile::loadFromString(Bencode::encode(['info' => ['name' => 'my test torrent']]));
        $this->assertEquals(
            build_magnet_link([
                'dn=my%20test%20torrent',
                'xt=urn:btih:BF88DD1FDFDD0E8B596E6AA39EBEA83D536F1DDE',
            ]),
            $torrent->getMagnetLink()
        );

        // unicode

        $torrent = TorrentFile::loadFromString(Bencode::encode(['info' => ['name' => 'トレント']]));
        $this->assertEquals(
            build_magnet_link([
                'dn=%E3%83%88%E3%83%AC%E3%83%B3%E3%83%88',
                'xt=urn:btih:F8A6EF35F6B70E8E599CEB2CE3DE920111524FBA',
            ]),
            $torrent->getMagnetLink()
        );

        // empty

        $torrent = TorrentFile::loadFromString('de');
        $this->assertEquals('magnet:?xt=urn:btih:600CCD1B71569232D01D110BC63E906BEAB04D8C', $torrent->getMagnetLink());
    }

    public function testTR()
    {
        $base = TorrentFile::loadFromString(Bencode::encode(['info' => ['name' => 'my test torrent']]));

        // add tracker

        $torrent = clone $base;
        $torrent->setAnnounce('http://example.com');
        $this->assertEquals(
            build_magnet_link([
                'dn=my%20test%20torrent',
                'xt=urn:btih:BF88DD1FDFDD0E8B596E6AA39EBEA83D536F1DDE',
                'tr=http://example.com',
            ]),
            $torrent->getMagnetLink()
        );

        // add list of trackers

        $torrent = clone $base;
        $torrent->setAnnounceList([
            'http://example.net',
            ['udp://example.org:4321', 'http://example.org']
        ]);
        $this->assertEquals(
            build_magnet_link([
                'dn=my%20test%20torrent',
                'xt=urn:btih:BF88DD1FDFDD0E8B596E6AA39EBEA83D536F1DDE',
                'tr=http://example.net',
                'tr=udp://example.org:4321',
                'tr=http://example.org',
            ]),
            $torrent->getMagnetLink()
        );

        // mixed

        $torrent = clone $base;
        $torrent->setAnnounce('http://example.com');
        $torrent->setAnnounceList([
            'http://example.net',
            'http://example.com', // removes duplicates that are allowed in base class
            ['udp://example.org:4321', 'http://example.org', 'http://example.net']
        ]);
        $this->assertEquals(
            build_magnet_link([
                'dn=my%20test%20torrent',
                'xt=urn:btih:BF88DD1FDFDD0E8B596E6AA39EBEA83D536F1DDE',
                'tr=http://example.com',
                'tr=http://example.net',
                'tr=udp://example.org:4321',
                'tr=http://example.org',
            ]),
            $torrent->getMagnetLink()
        );
    }
}
