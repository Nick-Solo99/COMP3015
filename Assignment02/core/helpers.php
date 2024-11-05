<?php

function image(string $filename): string
{
    return "/images/$filename";
}

function getSessionData(string $key)
{
    return $_SESSION[$key] ?? null;
}
