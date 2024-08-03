<?php

namespace Model;

class Snippet extends \Fuwafuwa\BaseModel {

    function __construct(\Fuwafuwa\Db $db) {
        parent::__construct($db, 'snippet', ['ai_field' => 'id', 'modified_field' => 'updated',]);

        // https://github.com/rakit/validation
        $this->validation = [
            'rules' => [
                'title' => 'required',
                'summary' => 'required',
                'content' => 'required',
            ],
            'custom_message' => []
        ];

        $this->preCreate = function (self $self, array $pkeys): void {
            $self['updater'] = \Base::instance()->get('SESSION.fullname');
            $self['updated'] = date('Y-m-d H:i:s');
        };
        $this->preUpdate = function (self $self, array $pkeys): void {
            $self['updater'] = \Base::instance()->get('SESSION.fullname');
            error_log("fullname: " . \Base::instance()->get('SESSION.fullname'));
            $self['updated'] = date('Y-m-d H:i:s');
        };
    }
}
