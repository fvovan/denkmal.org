<?php

class Denkmal_Page_Index extends Denkmal_Page_Abstract {

    public function prepareResponse(CM_Response_Page $response) {
        $response->redirect('Denkmal_Page_Events');
    }
}
