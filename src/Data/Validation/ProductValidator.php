<?php

namespace Catalog\Data\Validation;

/**
 * Class ProductValidator
 *
 * @package Catalog\Data\Validation
 */
class ProductValidator extends Validator
{
    /**
     * @var string
     */
    private static $errorMessage;

    /**
     * Method that calls other validation methods.
     *
     * @param string $sku
     * @param string $title
     * @param string $brand
     * @param string $price
     * @param string $shortDescription
     * @param string $description
     *
     * @return bool
     */
    public static function validateProduct(
        string $sku,
        string $title,
        string $brand,
        string $price,
        string $shortDescription,
        string $description
    ): bool {

        self::$errorMessage = '';

        if (!self::requireFields($sku, $title, $brand, $price, $shortDescription, $description)) {
            self::$errorMessage .= 'Some of inputted fields are empty. ';
        }

        if (!self::checkInputLengths($sku, $title, $brand, $price, $shortDescription, $description)) {
            self::$errorMessage .= 'Inputted values longer than required ';
        }

        if (!self::checkNumericValue($price)) {
            self::$errorMessage .= 'Price must be a number. ';
        }

        return self::$errorMessage === '';
    }

    /**
     * Returns false if some of inputted fields are empty.
     *
     * @param string $sku
     * @param string $title
     * @param string $brand
     * @param string $price
     * @param string $shortDescription
     * @param string $description
     *
     * @return bool
     */
    private static function requireFields(
        string $sku,
        string $title,
        string $brand,
        string $price,
        string $shortDescription,
        string $description
    ): bool {
        if (empty($sku) || empty($title) || empty($brand) || empty($price) || empty($shortDescription) || empty($description)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Returns false if some of inputted fields are longer than required.
     *
     * @param string $sku
     * @param string $title
     * @param string $brand
     * @param string $category
     * @param string $shortDescription
     * @param string $description
     *
     * @return bool
     */
    private static function checkInputLengths(
        string $sku,
        string $title,
        string $brand,
        string $category,
        string $shortDescription,
        string $description
    ): bool {
        if (strlen($title) > 45 || strlen($sku) > 45 || strlen($description) > 250 || strlen($shortDescription) > 150 || strlen($category) > 11 || strlen($brand) > 45) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $price
     *
     * @return bool
     */
    private static function checkNumericValue($price): bool
    {
        if (is_numeric($price)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public static function getErrorMessage(): string
    {
        return self::$errorMessage;
    }
}