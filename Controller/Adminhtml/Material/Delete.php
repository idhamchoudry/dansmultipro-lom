<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DansMultiPro\LOM\Controller\Adminhtml\Material;

use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Delete extends \DansMultiPro\LOM\Controller\Adminhtml\Material
{
    protected $_filesystem;
    protected $_file;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param Filesystem $filesystem
     * @param File $file
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        Filesystem $filesystem,
        File $file
    ) {
        $this->_filesystem = $filesystem;
        $this->_file = $file;

        parent::__construct($context, $coreRegistry);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('material_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\DansMultiPro\LOM\Model\Material::class);
                $model->load($id);

                // delete file
                if($model->getImage()) {
                    $this->deleteFile($model->getImage());
                }
                if($model->getFile()) {
                    $this->deleteFile($model->getFile());
                } 

                $model->delete();

                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Material.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['material_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Material to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }

    private function deleteFile($file){
        $mediaRootDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();

        if ($this->_file->isExists($mediaRootDir . $file)) {
            $this->_file->deleteFile($mediaRootDir . $file);
        }
    }
}

