<?php

/**
 * Model for sanitizing customer names
 *
 * @category Magento_Model
 * @package  AdDeo\CustomerNameSanitaizer\Model
 * @author   Carlos Deotti <deotti@gmail.com>
 * @license  Open Software License ("OSL") v. 3.0
 * @link     https://opensource.org/licenses/OSL-3.0
 */

namespace AdDeo\CustomerNameSanitaizer\Model;

/**
 * This class is responsible for sanitizing customer names.
 */
class NameSanitizer
{
    /**
     * Sanitizes the given first name by removing all whitespace.
     *
     * @param string|null $firstName
     *
     * @return string|null
     */
    public function sanitize(?string $firstName): ?string
    {
        if ($firstName === null) {
            return null;
        }
        return preg_replace('/\s+/', '', $firstName);
    }
}
