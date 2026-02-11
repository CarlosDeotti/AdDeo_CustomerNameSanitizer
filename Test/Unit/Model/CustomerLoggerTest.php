<?php
/**
 * This file contains unit tests for the CustomerLogger model.
 */
namespace AdDeo\CustomerNameSanitaizer\Test\Unit\Model;

use AdDeo\CustomerNameSanitaizer\Logger\Logger;
use AdDeo\CustomerNameSanitaizer\Model\CustomerLogger;
use Magento\Customer\Api\Data\CustomerInterface;
use PHPUnit\Framework\TestCase;

/**
 *  This class contains unit tests for the CustomerLogger model.
 */
class CustomerLoggerTest extends TestCase
{
    /**
     * This method tests the logCustomer functionality of the CustomerLogger model.
     *
     * @return void
     */
    public function testLogCustomer(): void
    {
        $logger = $this->createMock(Logger::class);
        $customer = $this->createMock(CustomerInterface::class);

        $customer->method('getFirstname')->willReturn('Joao');
        $customer->method('getLastname')->willReturn('Silva');
        $customer->method('getEmail')->willReturn('joao@teste.com');

        $logger->expects($this->once())
            ->method('info')
            ->with(
                $this->isType('string'),
                $this->arrayHasKey('email')
            );

        $service = new CustomerLogger($logger);
        $service->logCustomer($customer);
    }
}
