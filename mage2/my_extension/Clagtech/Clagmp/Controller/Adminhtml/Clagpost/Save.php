<?php
/**
 * Mageplaza_HelloWorld extension
 *                     NOTICE OF LICENSE
 * 
 *                     This source file is subject to the Mageplaza License
 *                     that is bundled with this package in the file LICENSE.txt.
 *                     It is also available through the world-wide-web at this URL:
 *                     https://www.mageplaza.com/LICENSE.txt
 * 
 *                     @category  Mageplaza
 *                     @package   Mageplaza_HelloWorld
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.mageplaza.com/LICENSE.txt
 */
namespace Clagtech\Clagmp\Controller\Adminhtml\Clagpost;

class Save extends \Clagtech\Clagmp\Controller\Adminhtml\Clagpost
{
    /**
     * Upload model
     * 
     * @var \Mageplaza\HelloWorld\Model\Upload
     */
    protected $_uploadModel;

    /**
     * File model
     * 
     * @var \Mageplaza\HelloWorld\Model\Post\File
     */
    protected $_fileModel;

    /**
     * Image model
     * 
     * @var \Mageplaza\HelloWorld\Model\Post\Image
     */
    protected $_imageModel;

    /**
     * Backend session
     * 
     * @var \Magento\Backend\Model\Session
     */
    protected $_backendSession;

    /**
     * constructor
     * 
     * @param \Mageplaza\HelloWorld\Model\Upload $uploadModel
     * @param \Mageplaza\HelloWorld\Model\Post\File $fileModel
     * @param \Mageplaza\HelloWorld\Model\Post\Image $imageModel
     * @param \Magento\Backend\Model\Session $backendSession
     * @param \Mageplaza\HelloWorld\Model\PostFactory $postFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Clagtech\Clagmp\Model\Upload $uploadModel,
        \Clagtech\Clagmp\Model\Clagpost\File $fileModel,
        \Clagtech\Clagmp\Model\Clagpost\Image $imageModel,
        \Magento\Backend\Model\Session $backendSession,
        \Clagtech\Clagmp\Model\ClagpostFactory $clagpostFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_uploadModel    = $uploadModel;
        $this->_fileModel      = $fileModel;
        $this->_imageModel     = $imageModel;
        $this->_backendSession = $backendSession;
        parent::__construct($clagpostFactory, $registry, $resultRedirectFactory, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('post');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->_filterData($data);
            $post = $this->_initPost();
            $post->setData($data);
            $featuredImage = $this->_uploadModel->uploadFileAndGetName('featured_image', $this->_imageModel->getBaseDir(), $data);
            $post->setFeaturedImage($featuredImage);
            $sampleUploadFile = $this->_uploadModel->uploadFileAndGetName('sample_upload_file', $this->_fileModel->getBaseDir(), $data);
            $post->setSampleUploadFile($sampleUploadFile);
            $this->_eventManager->dispatch(
                'clagtech_clagmp_clagpost_prepare_save',
                [
                    'post' => $post,
                    'request' => $this->getRequest()
                ]
            );
            try {
                $post->save();
                $this->messageManager->addSuccess(__('The Post has been saved.'));
                $this->_backendSession->setClagtechClagmpClagpostData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'clagtech_clagmp/*/edit',
                        [
                            'id' => $post->getId(),
                            '_current' => true
                        ]
                    );
                    return $resultRedirect;
                }
                $resultRedirect->setPath('clagtech_clagmp/*/');
                return $resultRedirect;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Post.'));
            }
            $this->_getSession()->setClagtechClagmpClagpostData($data);
            $resultRedirect->setPath(
                'clagtech_clagmp/*/edit',
                [
                    'id' => $post->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('clagtech_clagmp/*/');
        return $resultRedirect;
    }

    /**
     * filter values
     *
     * @param array $data
     * @return array
     */
    protected function _filterData($data)
    {
        if (isset($data['sample_multiselect'])) {
            if (is_array($data['sample_multiselect'])) {
                $data['sample_multiselect'] = implode(',', $data['sample_multiselect']);
            }
        }
        return $data;
    }
}
