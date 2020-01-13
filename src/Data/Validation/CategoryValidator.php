<?php

namespace Catalog\Data\Validation;

use Catalog\Services\CategoryService;

/**
 * Class CategoryValidator
 *
 * @package Catalog\Data\Validation
 */
class CategoryValidator extends Validator
{

    private static $errorMessage = '';

    /**
     *This method calls all validation methods and returns message with errors if there are any.
     *
     * @param string $title
     * @param string $code
     * @param string $description
     * @param int $parentId
     *
     * @return bool|null
     */
    public static function validateInputCategory(string $title, string $code, string $description, int $parentId): ?bool
    {

        self::$errorMessage = '';

        if (!self::requireFields($title, $code, $description, $parentId)) {
            self::$errorMessage .= 'Some of inputted fields are empty. ';
        }

        if (!self::checkInputLengths($title, $code, $description)) {
            self::$errorMessage .= 'Inputted values longer than required ';
        }

        if (self::categoryExists($code)) {
            self::$errorMessage .= 'Category code must be unique. ';
        }

        return self::$errorMessage !== '';
    }

    /**
     * Method that is used to check if all required fields are inputted.
     *
     * @param string $title
     * @param string $code
     * @param string $description
     * @param int $parentId
     *
     * @return bool
     */
    private static function requireFields(string $title, string $code, string $description, int $parentId): bool
    {
        if (empty($title) || empty($code) || empty($description) || empty($parentId)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Method used to check inputted fields lengths.
     *
     * @param string $title
     * @param string $code
     * @param string $description
     *
     * @return bool
     */
    private static function checkInputLengths(string $title, string $code, string $description): bool
    {
        if (strlen($title) > 45 || strlen($code) > 45 || strlen($description) > 250) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Method that returns true if Category exists and false if it does not.
     *
     * @param string $code
     *
     * @return bool
     */
    private static function categoryExists(string $code): bool
    {
        if (CategoryService::getCategoryByCode($code)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Method that returns error message.
     *
     * @return string
     */
    public static function getErrorMessage(): string
    {
        return self::$errorMessage;
    }

}

