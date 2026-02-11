<?php

/**
 * Plugin for sanitizing customer names and logging customer data.
 *
 * @category CustomerManagement
 * @package  AdDeo\CustomerNameSanitaizer\Plugin
 * @author   Carlos Deotti <deotti@gmail.com>
 * @license  Open Software License ("OSL") v. 3.0
 * @link     https://opensource.org/licenses/OSL-3.0
 */

namespace AdDeo\CustomerNameSanitaizer\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use AdDeo\CustomerNameSanitaizer\Model\NameSanitizer;
use AdDeo\CustomerNameSanitaizer\Model\CustomerLogger;
use AdDeo\CustomerNameSanitaizer\Model\Email\Sender;

/**
 * This plugin ensures customer names are sanitized and logs customer data
 * during repository operations.
 */
class CustomerRepositoryPlugin
{
    /**
     * Constructor
     *
     * @param NameSanitizer $sanitizer
     * @param CustomerLogger $logger
     * @param Sender $emailSender
     */
    public function __construct(
        private readonly NameSanitizer $sanitizer,
        private readonly CustomerLogger $logger,
        private readonly Sender $emailSender
    ) {

    }

    /**
     * This method is executed around the save operation of
     * the CustomerRepositoryInterface, which intercepts the
     * save method to sanitize customer names, log data, and send emails.
     *
     * @param CustomerRepositoryInterface $subject
     * @param callable $proceed
     * @param CustomerInterface $customer
     * @param String $passwordHash
     *
     * @return void
     */
    public function aroundSave(
        CustomerRepositoryInterface $subject,
        callable $proceed,
        CustomerInterface $customer,
        $passwordHash = null
    ) {
        $isNew = !$customer->getId();

        $customer->setFirstname(
            $this->sanitizer->sanitize($customer->getFirstname())
        );

        $result = $proceed($customer, $passwordHash);

        if ($isNew) {
            $this->logger->logCustomer($result);
            $this->emailSender->send($result);
        }

        return $result;
    }
}
