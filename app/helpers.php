<?php


function translations($json)
{
    if (!file_exists($json)) {
        return [];
    }

    return json_decode(file_get_contents($json), true, 512, JSON_THROW_ON_ERROR);
}
