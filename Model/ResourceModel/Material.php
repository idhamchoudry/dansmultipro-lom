<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Material extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('dansmultipro_lom_material', 'material_id');
    }
}

