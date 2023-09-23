<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Api\Data;

interface MaterialInterface
{

    const FILE = 'file';
    const FILE_URL = 'file_url';
    const MATERIAL_ID = 'material_id';
    const UPDATED_AT = 'updated_at';
    const SUMMARY = 'summary';
    const TITLE = 'title';
    const IMAGE = 'image';
    const IMAGE_URL = 'image_url';
    const CREATED_AT = 'created_at';

    /**
     * Get material_id
     * @return string|null
     */
    public function getMaterialId();

    /**
     * Set material_id
     * @param string $materialId
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setMaterialId($materialId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setTitle($title);

    /**
     * Get summary
     * @return string|null
     */
    public function getSummary();

    /**
     * Set summary
     * @param string $summary
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setSummary($summary);

    /**
     * Get image
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     * @param string $image
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setImage($image);

    /**
     * Get image url
     * @return string|null
     */
    public function getImageUrl();

    /**
     * Set image url
     * @param string $imageUrl
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setImageUrl($imageUrl);

    /**
     * Get file
     * @return string|null
     */
    public function getFile();

    /**
     * Set file
     * @param string $file
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setFile($file);

    /**
     * Get file Url
     * @return string|null
     */
    public function getFileUrl();

    /**
     * Set file url
     * @param string $fileUrl
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setFileUrl($fileUrl);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \DansMultiPro\LOM\Material\Api\Data\MaterialInterface
     */
    public function setUpdatedAt($updatedAt);
}

