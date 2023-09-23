<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Api\Data;

interface MaterialSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Material list.
     * @return \DansMultiPro\LOM\Api\Data\MaterialInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \DansMultiPro\LOM\Api\Data\MaterialInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

