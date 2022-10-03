<?php

namespace George\CustomGridAdmin\Model;

class GridItems extends \Magento\Framework\Model\AbstractModel
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'george_customgridadmin';
    /**
     * @var string
     */
    protected $_cacheTag = 'george_customgridadmin';
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'george_customgridadmin';
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('George\CustomGridAdmin\Model\ResourceModel\GridItems');
    }
}