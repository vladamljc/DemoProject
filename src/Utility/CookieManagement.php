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
     * Removing cookie with given username.
     *
     * @param string $cookieName
     */
    public static function removeCookie(string $cookieName): void
    {
        setcookie($cookieName, '', time() - COOKIE_EXPIRE_VALUE);
    }

    /**
     * Setting cookie with given parameters.
     *
     * @param string $username
     * @param string $password
     * @param string $cookieName
     */
    public static function setCookie(string $username, string $password, string $cookieName): void
    {
        $valueHash = hash('sha256', $username . '/' . $password);
        setcookie($cookieName, $valueHash, time() + COOKIE_EXPIRE_VALUE, '/');
    }

    /**
     * Method that returns hashed cookie value.
     *
     * @param string $cookieName
     *
     * @return string
     */
    public static function readCookie(string $cookieName): string
    {
        return $_COOKIE[$cookieName] ?? '';
    }

}