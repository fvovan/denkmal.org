<?php

class Denkmal_Paging_Tag_All extends Denkmal_Paging_Tag_Abstract {

    public function __construct() {
        $source = new CM_PagingSource_Sql('id', 'denkmal_model_tag', null, 'label');
        $source->enableCache();
        parent::__construct($source);
    }
}
