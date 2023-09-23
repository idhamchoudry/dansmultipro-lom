<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Controller\Adminhtml\Material;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $materialFactory;
    protected $_filesystem;
    protected $_file;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \DansMultiPro\LOM\Model\MaterialFactory  $materialFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \DansMultiPro\LOM\Model\MaterialFactory $materialFactory,
        Filesystem $filesystem,
        File $file
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->materialFactory = $materialFactory;
        $this->_filesystem = $filesystem;
        $this->_file = $file;

        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('material_id');
        
            $model = $this->materialFactory->create()->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Material no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $prevImage = $model->getImage();
            $prevFile = $model->getFile();
            $data = $this->_filterImageData($data);
            $data = $this->_filterFileData($data);
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Material.'));
                $this->dataPersistor->clear('dansmultipro_lom_material');

                if(!empty($prevImage) && $prevImage != $model->getImage()) {
                    $this->deleteFile($prevImage);
                }
                if(!empty($prevFile) && $prevFile != $model->getFile()) {
                    $this->deleteFile($prevFile);
                }
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['material_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Material.'.$e->getMessage()));
            }
        
            $this->dataPersistor->set('dansmultipro_lom_material', $data);
            return $resultRedirect->setPath('*/*/edit', ['material_id' => $this->getRequest()->getParam('material_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    private function deleteFile($file){
        $mediaRootDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        if ($this->_file->isExists($mediaRootDir . $file)) {
            $this->_file->deleteFile($mediaRootDir . $file);
        }
    }

    private function _filterImageData(array $rawData)
    {
        //Replace icon with fileuploader field name
        $data = $rawData;
        if (isset($data['image'][0]['name'])) {
            $data['image'] = 'dansmultipro_lom/image/' . $data['image'][0]['name'];
        } else {
            $data['image'] = null;
        }
        return $data;
    }

    private function _filterFileData(array $rawData)
    {
        //Replace icon with fileuploader field name
        $data = $rawData;
        if (isset($data['file'][0]['name'])) {
            $data['file'] = 'dansmultipro_lom/file/' . $data['file'][0]['name'];
        } else {
            $data['file'] = null;
        }
        return $data;
    }
}

