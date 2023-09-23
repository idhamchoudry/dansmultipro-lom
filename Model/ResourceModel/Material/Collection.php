<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Model\ResourceModel\Material;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'material_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \DansMultiPro\LOM\Model\Material::class,
            \DansMultiPro\LOM\Model\ResourceModel\Material::class
        );
    }
}

