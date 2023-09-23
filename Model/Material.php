<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Model;

use DansMultiPro\LOM\Api\Data\MaterialInterface;
use Magento\Framework\Model\AbstractModel;

class Material extends AbstractModel implements MaterialInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\DansMultiPro\LOM\Model\ResourceModel\Material::class);
    }

    /**
     * @inheritDoc
     */
    public function getMaterialId()
    {
        return $this->getData(self::MATERIAL_ID);
    }

    /**
     * @inheritDoc
     */
    public function setMaterialId($materialId)
    {
        return $this->setData(self::MATERIAL_ID, $materialId);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getSummary()
    {
        return $this->getData(self::SUMMARY);
    }

    /**
     * @inheritDoc
     */
    public function setSummary($summary)
    {
        return $this->setData(self::SUMMARY, $summary);
    }

    /**
     * @inheritDoc
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * @inheritDoc
     */
    public function getImageUrl()
    {
        return $this->getData(self::IMAGE_URL);
    }

    /**
     * @inheritDoc
     */
    public function setImageUrl($imageUrl)
    {
        return $this->setData(self::IMAGE_URL, $imageUrl);
    }

    /**
     * @inheritDoc
     */
    public function getFile()
    {
        return $this->getData(self::FILE);
    }

    /**
     * @inheritDoc
     */
    public function setFile($file)
    {
        return $this->setData(self::FILE, $file);
    }

    /**
     * @inheritDoc
     */
    public function getFileUrl()
    {
        return $this->getData(self::FILE_URL);
    }

    /**
     * @inheritDoc
     */
    public function setFileUrl($fileUrl)
    {
        return $this->setData(self::FILE_URL, $fileUrl);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function beforeSave()
    {
      $now = date("Y-m-d H:i:s");
      if (empty($this->getCreatedAt())) {
        $this->setCreatedAt($now);
        $this->setUpdatedAt($now);
      } else $this->setUpdatedAt($now);
    }
}

