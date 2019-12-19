<?php

namespace Catalog\Utility;

/**
 * Class Session
 *
 * @package Catalog\Utility
 */
class Session
{
    /**
     * Method to start session
     */
    public static function startSession(): void
    {
        session_start();
    }

    /**
     * Method to destroy session
     */
    public static function endSession(): void
    {
        session_unset();
        session_destroy();
    }

    /**
     * Adding new parameter to the session
     *
     * @param string $key
     * @param string $val
     */
    public static function setParameter(string $key, string $val): void
    {
        $_SESSION[$key] = $val;
    }

    /**
     * Checking if there is active session or not
     *
     * @return bool
     */
    public static function areSessionParametersSet(): bool
    {
        if (!isset($_SESSION['username'], $_SESSION['password'])) {
            return false;
        }

        return true;
    }

}