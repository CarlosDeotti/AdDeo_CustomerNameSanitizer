<?php
/**
 * Basic logger for the CustomerNameSanitaizer module.
 *
 * @category Logging
 * @package AdDeo\CustomerNameSanitaizer\Logger
 * @author   Carlos Deotti <deotti@gmail.com>
 * @license  Open Software License ("OSL") v. 3.0
 * @link     https://opensource.org/licenses/OSL-3.0
 */
namespace AdDeo\CustomerNameSanitaizer\Logger;

use Monolog\Logger as MonologLogger;

/**
 * This class extends MonologLogger to provide custom logging functionality
 * specific to the CustomerNameSanitaizer module.
 */
class Logger extends MonologLogger {
    public function __construct($name, array $handlers = [], array $processors = [])
    {
        parent::__construct($name, $handlers, $processors);
    }
}
