<?php

/**
 * This file contains unit tests for the CustomerRepositoryPlugin.
 */

namespace AdDeo\CustomerNameSanitaizer\Test\Unit\Plugin;

use AdDeo\CustomerNameSanitaizer\Model\CustomerLogger;
use AdDeo\CustomerNameSanitaizer\Model\Email\Sender;
use AdDeo\CustomerNameSanitaizer\Model\NameSanitizer;
use AdDeo\CustomerNameSanitaizer\Plugin\CustomerRepositoryPlugin;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use PHPUnit\Framework\TestCase;

/**
 * This class contains unit tests for the CustomerRepositoryPlugin.
 */
class CustomerRepositoryPluginTest extends TestCase
{
    /**
     * This method tests the aroundSave functionality for sanitizing and
     * executing actions on a new customer.
     *
     * @return void
     */
    public function testAroundSaveSanitizesAndExecutesOnNewCustomer(): void
    {
        $sanitizer = new NameSanitizer();
        $logger = $this->createMock(CustomerLogger::class);
        $sender = $this->createMock(Sender::class);

        $customer = $this->createMock(CustomerInterface::class);
        $customer->method('getId')->willReturn(null);
        $customer->method('getFirstname')->willReturn('Jo ao');
        $customer->expects($this->once())
            ->method('setFirstname')
            ->with('Joao');

        $logger->expects($this->once())->method('logCustomer');
        $sender->expects($this->once())->method('send');

        $plugin = new CustomerRepositoryPlugin($sanitizer, $logger, $sender);

        $proceed = function ($cust, $hash = null) {
            return $cust;
        };

        $subject = $this->createMock(CustomerRepositoryInterface::class);

        $plugin->aroundSave($subject, $proceed, $customer, null);
    }

    /**
     * This method tests the aroundSave functionality for skipping post actions
     * on an existing customer.
     *
     * @return void
     */
    public function testAroundSaveSkipsPostActionsOnExistingCustomer(): void
    {
        $sanitizer = new NameSanitizer();
        $logger = $this->createMock(CustomerLogger::class);
        $sender = $this->createMock(Sender::class);

        $customer = $this->createMock(CustomerInterface::class);
        $customer->method('getId')->willReturn(123);
        $customer->method('getFirstname')->willReturn('Ana');

        $logger->expects($this->never())->method('logCustomer');
        $sender->expects($this->never())->method('send');

        $plugin = new CustomerRepositoryPlugin($sanitizer, $logger, $sender);

        $proceed = function ($cust, $hash = null) {
            return $cust;
        };

        $subject = $this->createMock(CustomerRepositoryInterface::class);

        $plugin->aroundSave($subject, $proceed, $customer, null);
    }
}
