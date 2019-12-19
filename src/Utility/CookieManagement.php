<?php

namespace Catalog\Utility;

/**
 * Class CookieManagement
 *
 * @package Catalog\Utility
 */
class CookieManagement
{
    /**
     * @param string $cookieName
     */
    public static function removeCookie(string $cookieName): void
    {
        setcookie($cookieName, '', time() - COOKIE_EXPIRE_VALUE);
    }

    /**
     * @param string $username
     * @param string $cookieName
     */
    public static function setCookie(string $username, string $cookieName): void
    {
        setcookie($cookieName, $username, time() + COOKIE_EXPIRE_VALUE, '/');
    }
}