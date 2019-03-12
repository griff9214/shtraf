<?php

namespace classes;

interface ResponseDecoder
{
    public static function checkErrors($response);

    public static function checkState($response);

    public static function getSecureCode($response);

    public static function getFines($response);

    public static function getPhotoIds($response);
}