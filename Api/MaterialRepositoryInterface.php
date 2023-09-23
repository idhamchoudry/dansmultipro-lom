<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface MaterialRepositoryInterface
{

    /**
     * Save Material
     * @param \DansMultiPro\LOM\Api\Data\MaterialInterface $material
     * @return \DansMultiPro\LOM\Api\Data\MaterialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \DansMultiPro\LOM\Api\Data\MaterialInterface $material
    );

    /**
     * Retrieve Material
     * @param string $materialId
     * @return \DansMultiPro\LOM\Api\Data\MaterialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($materialId);

    /**
     * Retrieve Material matching the specified criteria.
     * @param  \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria | null
     * @return \DansMultiPro\LOM\Api\Data\MaterialSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Material
     * @param \DansMultiPro\LOM\Api\Data\MaterialInterface $material
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \DansMultiPro\LOM\Api\Data\MaterialInterface $material
    );

    /**
     * Delete Material by ID
     * @param string $materialId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($materialId);
}

