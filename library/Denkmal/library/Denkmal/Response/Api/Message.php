<?php

class Denkmal_Response_Api_Message extends Denkmal_Response_Api_Abstract {

    public function __construct(CM_Request_Post $request) {
        $request->setBodyEncoding(CM_Request_Post::ENCODING_FORM);
        parent::__construct($request);
    }

    protected function _process() {
        $hashToken = self::_getConfig()->hashToken;
        $hashAlgorithm = self::_getConfig()->hashAlgorithm;

        $venue = $this->_params->getVenue('venue');
        $text = $this->_params->has('text') ? $this->_params->getString('text') : null;
        $imageData = $this->_params->has('image-data') ? base64_decode($this->_params->getString('image-data')) : null;
        $clientHash = $this->_params->getString('hash');

        if (null === $text && null === $imageData) {
            throw new CM_Exception_Invalid('Either `text` or `imageData` is required.');
        }
        if (null !== $text && null !== $imageData) {
            throw new CM_Exception_Invalid('Specifying both `text` and `imageData` is not allowed.');
        }

        $hashData = (null !== $text) ? $text : md5($imageData);
        $serverHash = hash($hashAlgorithm, $hashToken . $hashData);
        if ($serverHash != $clientHash) {
            throw new CM_Exception_NotAllowed('Not authorised access.');
        }

        $action = new Denkmal_Action_Message(Denkmal_Action_Message::CREATE, $this->getRequest()->getIp());
        $action->prepare();
        $image = (null !== $imageData) ? Denkmal_Model_MessageImage::create($imageData) : null;
        $message = Denkmal_Model_Message::create($venue, $text, $image);
        $action->notify($message);

        $response = $message->toArrayApi($this->getRender());
        $this->_setContent($response);
    }

    public static function match(CM_Request_Abstract $request) {
        if (!parent::match($request)) {
            return false;
        }
        return $request->getPathPart(1) === 'message';
    }
}
