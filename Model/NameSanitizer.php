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

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;

/**
 * This class is responsible for sanitizing customer names.
 */
class NameSanitizer extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'addeo_customernamesanitaizer_name_sanitizer';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'name_sanitizer';

    /**
     * Constructor
     *
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource $resource
     * @param AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'AdDeo\CustomerNameSanitaizer\Model\ResourceModel\NameSanitizer'
        );
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
