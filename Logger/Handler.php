<?php

/**
 * This class is a placeholder for a custom log handler.
 *
 * @category AdDeo\CustomerNameSanitaizer
 * @package AdDeo\CustomerNameSanitaizer\Logger
 * @author   Carlos Deotti <deotti@gmail.com>
 * @license  Open Software License ("OSL") v. 3.0
 * @link     https://opensource.org/licenses/OSL-3.0
 */

namespace AdDeo\CustomerNameSanitaizer\Logger;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

/**
 * Custom log handler for customer name sanitizer, extends Magento's Base logger
 */
class Handler extends Base
{
    protected $loggerType = Logger::INFO;
    protected $fileName = '/var/log/customer_name_sanitizer.log';
}
