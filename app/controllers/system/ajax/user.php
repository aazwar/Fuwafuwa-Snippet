<?php

namespace Ajax;

class User extends \Fuwafuwa\Controller\FFTable {

    function list(\Base $f3): void {
        $this->record_list('\Fuwafuwa\Model\User');
    }

    /**
     * Edit user table and allow disable deletion of user data only if the user is an admin.
     */
    function edit(\Base $f3): void {
        $this->allowDel =
            function (array $data) {
                if ($data['login'] == 'admin') {
                    return t('db.super_admin_del');
                }
                return true;
            };
        $this->ajaxEdit('\Fuwafuwa\Model\User', '_token');
    }

    function roles($f3) {
        $this->record_list('\Fuwafuwa\Model\Role', "is_admin = 0");
    }

    function edit_role($f3) {
        $this->ajaxEdit('\Fuwafuwa\Model\Role', '_token');
    }

    function get_permission($f3) {
        extract($this->data); // role_id
        $permissions = (string)$this->FSQL1('SELECT permissions FROM role WHERE id = ?', $role_id);
        $this->jsonResponse(true, '', ['permissions' => $permissions]);
    }

    function set_permission($f3) {
        extract($this->data); // role_id, permissions
        $this->SQL('UPDATE role SET permissions = ? WHERE id = ?', $permissions, $role_id);
        $permissions = (string)$this->FSQL1('SELECT permissions FROM role WHERE id = ?', $role_id);
        $this->jsonResponse(true, '', ['permissions' => $permissions]);
    }

    function members(\Base $f3): void {
        $this->record_list('\Fuwafuwa\Model\Member');
    }

    function member_edit(\Base $f3): void {
        $uploads = $this->processUpload("", null, 200);
        foreach ($uploads as $file) {
            $this->data['data'][$file['field']] = $file['url'];
        }
        $this->ajaxEdit('\Fuwafuwa\Model\Member');
    }

    function change_password(\Base $f3): void {
        // TODO: change user password
    }

    function upload_avatar(\Base $f3): void {
        // TODO: Update avatar
    }
}
