<?php

/**
 * Customer Logger Model
 *
 * @category CustomerLogger
 * @package  AdDeo\CustomerNameSanitaizer\Model
 * @author   Carlos Deotti <deotti@gmail.com>
 * @license  Open Software License ("OSL") v. 3.0
 * @link     https://opensource.org/licenses/OSL-3.0
 */

namespace AdDeo\CustomerNameSanitaizer\Model;

use Magento\Customer\Api\Data\CustomerInterface;
use AdDeo\CustomerNameSanitaizer\Logger\Logger;

/**
 * This class is responsible for logging customer information.
 */
class CustomerLogger
{
    /**
     * Constructor
     *
     * @param Logger $logger
     */
    public function __construct(
        private readonly Logger $logger
    ) {}

    /**
     * Logs customer information.
     *
     * @param CustomerInterface $customer
     *
     * @return void
     */
    public function logCustomer(CustomerInterface $customer): void
    {
        $this->logger->info(
            __('New Customer Registered')->render(),
            [
                'datetime'  => date('Y-m-d H:i:s'),
                'firstname' => $customer->getFirstname(),
                'lastname'  => $customer->getLastname(),
                'email'     => $customer->getEmail()
            ]
        );
    }
}
