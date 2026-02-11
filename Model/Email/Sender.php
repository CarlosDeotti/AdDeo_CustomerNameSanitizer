<?php
/**
 * Handles email sending functionality for the CustomerNameSanitaizer module.
 *
 * @category CustomerNameSanitaizer
 * @package  AdDeo\CustomerNameSanitaizer\Model\Email
 * @author   Carlos Deotti <deotti@gmail.com>
 * @license  Open Software License ("OSL") v. 3.0
 * @link     https://opensource.org/licenses/OSL-3.0
 */
namespace AdDeo\CustomerNameSanitaizer\Model\Email;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Handles email sending functionality for customer-related actions.
 */
class Sender
{
    /**
     * Constructor
     *
     * @param TransportBuilder $transportBuilder
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        private readonly TransportBuilder $transportBuilder,
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly StoreManagerInterface $storeManager
    ) {

    }

    /**
     * Sends an email to the customer
     *
     * @param CustomerInterface $customer
     *
     * @return void
     */
    public function send(CustomerInterface $customer): void
    {
        $storeId = (int)$this->storeManager->getStore()->getId();

        $supportEmail = $this->scopeConfig->getValue(
            'trans_email/ident_support/email',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        $supportName = $this->scopeConfig->getValue(
            'trans_email/ident_support/name',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        if (!$supportEmail) {
            return;
        }

        $transport = $this->transportBuilder
            ->setTemplateIdentifier('addeo_customer_registered')
            ->setTemplateOptions(
                [
                    'area'  => 'frontend',
                    'store' => $storeId
                ]
            )
            ->setTemplateVars(
                [
                    'firstname' => $customer->getFirstname(),
                    'lastname'  => $customer->getLastname(),
                    'email'     => $customer->getEmail()
                ]
            )
            ->setFromByScope('support', $storeId)
            ->addTo($supportEmail, $supportName)
            ->getTransport();

        $transport->sendMessage();
    }
}
