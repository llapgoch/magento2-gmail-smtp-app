<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * http://www.magepal.com | support@magepal.com
 */

namespace MagePal\GmailSmtpApp\Model;

use Exception;
use InvalidArgumentException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\TransportInterface;
use Magento\Framework\Phrase;
use Zend_Mail;
use Zend_Mail_Transport_Sendmail;

/**
 * Class Transport
 * @package MagePal\GmailSmtpApp\Model
 */
class Transport extends Zend_Mail_Transport_Sendmail implements TransportInterface
{
    /**
     * @var MessageInterface
     */
    protected $_message;

    /**
     * @param MessageInterface $message
     * @param null $parameters
     */
    public function __construct(MessageInterface $message, $parameters = null)
    {
        parent::__construct($parameters);
        $this->_message = $message;
    }

    /**
     * Send a mail using this transport
     *
     * @return void
     * @throws MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->_message);
        } catch (Exception $e) {
            throw new MailException(new Phrase($e->getMessage()), $e);
        }
    }

    /**
     * @return MessageInterface|Zend_Mail
     */
    public function getMessage()
    {
        return $this->_message;
    }
}
