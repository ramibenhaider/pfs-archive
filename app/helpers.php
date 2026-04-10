<?php

use Vinkla\Hashids\Facades\Hashids;

if (!function_exists('encodeId')) {
    function encodeId(int $id): string
    {
        return Hashids::encode($id);
    }
}

if (!function_exists('decodeId')) {
    function decodeId(string $hash): int|null
    {
        $decoded = Hashids::decode($hash);
        return $decoded[0] ?? null;
    }
}