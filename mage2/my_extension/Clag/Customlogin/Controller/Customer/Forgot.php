<?php
/**
 * @copyright Copyright (c) 2017 www.tigren.com
 */

namespace Clag\Customlogin\Controller\Customer;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\SecurityViolationException;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\View\LayoutFactory;

class Forgot extends Action
{
    protected $customerAccountManagement;
    protected $escaper;
    protected $session;
    protected $jsonHelper;
    protected $_ajaxLoginHelper;

    public function __construct(
        Context $context,
        Session $customerSession,
        AccountManagementInterface $customerAccountManagement,
        Escaper $escaper,
        JsonHelper $jsonHelper,
        LayoutFactory $layoutFactory
    )
    {
        $this->session = $customerSession;
        $this->customerAccountManagement = $customerAccountManagement;
        $this->escaper = $escaper;
        $this->jsonHelper = $jsonHelper;
        //$this->_ajaxLoginHelper = $ajaxLoginHelper;
        $this->_layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    /**
     * Forgot customer password action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    /*public function execute()
    {
        die('Forgot');
    }*/


    public function execute()
    {
        $result = array();
        $captchaStatus = $this->session->getResultCaptcha();
        if ($captchaStatus) {
            if (isset($captchaStatus['error'])) {
                $this->session->setResultCaptcha(null);
                $this->getResponse()->setBody($this->jsonHelper->jsonEncode($captchaStatus));
                return;
            }
            $result['imgSrc'] = $captchaStatus['imgSrc'];
        }

        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $email = (string)$this->getRequest()->getPost('email');

        //$email = 'xyz@gmail.com';

        if ($email) {
            if (!\Zend_Validate::is($email, 'EmailAddress')) {
                $this->session->setForgottenEmail($email);
                $result['error'] = __('Please correct the email address.');
            }

            try {
                $this->customerAccountManagement->initiatePasswordReset(
                    $email,
                    AccountManagement::EMAIL_RESET
                );
                $result['success'] = __(
                    'We have sent a message to your email. Please check your inbox and click on the link to reset your password.'
                );
            } catch (NoSuchEntityException $e) {
                // Do nothing, we don't want anyone to use this action to determine which email accounts are registered.
            } catch (SecurityViolationException $exception) {
                $result['error'] = $exception->getMessage();
            } catch (\Exception $exception) {
                $result['error'] = __('We\'re unable to send the password reset email.');
            }
        }

        if (!empty($result['error'])) {
            /*$emailAdmin = 'email@admin.com';
            $htmlPopup = $this->_ajaxLoginHelper->getErrorMessageForgotPasswordPopupHtml($emailAdmin);
            $result['html_popup'] = $htmlPopup;*/

            /**/
            /*$layout = $this->_layoutFactory->create(['cacheable' => false]);
            $layout->getUpdate()->addHandle('ajaxlogin_forgotpassword_error')->load();
            $layout->generateXml();
            $layout->generateElements();
            $result = $layout->getOutput();
            //$layout->__destruct();
            $result['html_popup'] = $result;*/
            /**/

            $result['html_popup'] = "111";

        } else {
           /* $htmlPopup = $this->_ajaxLoginHelper->getSuccessMessageForgotPasswordPopupHtml($email);
            $result['html_popup'] = $htmlPopup;*/

            /**/
            /*$layout = $this->_layoutFactory->create(['cacheable' => false]);
            $layout->getUpdate()->addHandle('ajaxlogin_forgotpassword_success')->load();
            $layout->generateXml();
            $layout->generateElements();
            $result = $layout->getOutput();
            //$layout->__destruct();
            $result['html_popup'] = $result;*/
            /**/

            $result['html_popup'] = "222";
        }
        $this->getResponse()->representJson($this->jsonHelper->jsonEncode($result));

        //echo "<pre>";
        //print_r($result);

        //die("Forgot");
    }
}
