<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Model;

use DansMultiPro\LOM\Api\Data\MaterialInterface;
use DansMultiPro\LOM\Api\Data\MaterialInterfaceFactory;
use DansMultiPro\LOM\Api\Data\MaterialSearchResultsInterfaceFactory;
use DansMultiPro\LOM\Api\MaterialRepositoryInterface;
use DansMultiPro\LOM\Model\ResourceModel\Material as ResourceMaterial;
use DansMultiPro\LOM\Model\ResourceModel\Material\CollectionFactory as MaterialCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use \Magento\Store\Model\StoreManagerInterface;

class MaterialRepository implements MaterialRepositoryInterface
{

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var MaterialCollectionFactory
     */
    protected $materialCollectionFactory;

    /**
     * @var Material
     */
    protected $searchResultsFactory;

    /**
     * @var MaterialInterfaceFactory
     */
    protected $materialFactory;

    /**
     * @var ResourceMaterial
     */
    protected $resource;


    /**
     * @param ResourceMaterial $resource
     * @param MaterialInterfaceFactory $materialFactory
     * @param MaterialCollectionFactory $materialCollectionFactory
     * @param MaterialSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceMaterial $resource,
        MaterialInterfaceFactory $materialFactory,
        MaterialCollectionFactory $materialCollectionFactory,
        MaterialSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->materialFactory = $materialFactory;
        $this->materialCollectionFactory = $materialCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    public function save(MaterialInterface $material)
    {
        try {
            $this->resource->save($material);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the material: %1',
                $exception->getMessage()
            ));
        }
        return $material;
    }

    /**
     * @inheritDoc
     */
    public function get($materialId)
    {
        $material = $this->materialFactory->create();
        $this->resource->load($material, $materialId);

        $material->setImageUrl($this->getMediaUrl().$material->getImage());
        $material->setFileUrl($this->getMediaUrl().$material->getFile());
        
        if (!$material->getId()) {
            throw new NoSuchEntityException(__('Material with id "%1" does not exist.', $materialId));
        }
        return $material;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->materialCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $model->setImageUrl($this->getMediaUrl().$model->getImage());
            $model->setFileUrl($this->getMediaUrl().$model->getFile());
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(MaterialInterface $material)
    {
        try {
            $materialModel = $this->materialFactory->create();
            $this->resource->load($materialModel, $material->getMaterialId());
            $this->resource->delete($materialModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Material: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($materialId)
    {
        return $this->delete($this->get($materialId));
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl;
    }
}

