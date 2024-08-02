<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Ajax;

class User extends \Fuwafuwa\Controller\FFTable
{
    function list(\Base $O673402283) : void
    {
        $this->record_list("\134\106\x75\x77\x61\146\165\167\141\134\115\157\144\145\x6c\134\x55\163\x65\x72");
    }
    function edit(\Base $O673402283) : void
    {
        $this->allowDel = function (array $O318852266) {
            if (!($O318852266["\x6c\157\147\x69\x6e"] == "\x61\x64\x6d\x69\156")) {
                goto O890634732;
            }
            return t("\x64\x62\x2e\x73\165\x70\x65\162\x5f\x61\144\x6d\151\x6e\x5f\144\145\x6c");
            O890634732:
            return true;
        };
        $this->ajaxEdit("\134\106\x75\167\x61\146\165\167\141\134\115\157\x64\145\x6c\x5c\x55\163\145\x72", "\137\164\x6f\153\x65\156");
    }
    function roles($O673402283)
    {
        $this->record_list("\x5c\x46\165\167\141\x66\x75\167\x61\134\115\x6f\x64\x65\154\x5c\122\x6f\x6c\x65", "\x69\x73\x5f\x61\144\x6d\x69\x6e\x20\75\40\x30");
    }
    function edit_role($O673402283)
    {
        $this->ajaxEdit("\134\x46\165\x77\x61\146\x75\167\141\x5c\115\x6f\x64\145\154\x5c\x52\x6f\x6c\x65", "\x5f\x74\157\153\x65\156");
    }
    function get_permission($O673402283)
    {
        extract($this->data);
        $O770224106 = (string) $this->FSQL1("\x53\x45\114\105\103\124\x20\160\x65\162\x6d\x69\163\x73\151\157\x6e\163\40\x46\122\117\115\40\x72\157\154\145\x20\127\110\x45\x52\105\x20\151\x64\x20\x3d\x20\77", $O248558345);
        $this->jsonResponse(true, '', ["\160\145\x72\155\151\163\x73\x69\x6f\x6e\x73" => $O770224106]);
    }
    function set_permission($O673402283)
    {
        extract($this->data);
        $this->SQL("\125\x50\x44\101\124\105\40\x72\157\x6c\145\x20\123\x45\x54\x20\x70\x65\162\x6d\x69\x73\163\151\x6f\156\x73\40\x3d\40\x3f\40\x57\110\105\122\x45\x20\x69\144\x20\75\x20\77", $O770224106, $O248558345);
        $O770224106 = (string) $this->FSQL1("\x53\x45\114\x45\103\x54\40\x70\x65\x72\x6d\151\163\163\151\x6f\156\x73\40\106\122\117\x4d\40\162\x6f\154\x65\40\x57\110\x45\122\x45\40\151\144\x20\75\40\77", $O248558345);
        $this->jsonResponse(true, '', ["\x70\x65\162\x6d\151\x73\x73\151\157\156\x73" => $O770224106]);
    }
    function members(\Base $O673402283) : void
    {
        $this->record_list("\x5c\106\x75\x77\x61\x66\165\x77\141\x5c\115\x6f\144\145\x6c\x5c\x4d\145\155\x62\145\162");
    }
    function member_edit(\Base $O673402283) : void
    {
        $O183059490 = $this->processUpload('', null, 200);
        foreach ($O183059490 as $O278385465) {
            $this->data["\x64\141\x74\x61"][$O278385465["\x66\x69\x65\x6c\x64"]] = $O278385465["\165\x72\x6c"];
            O685022801:
        }
        O370972300:
        $this->ajaxEdit("\x5c\x46\x75\x77\x61\146\165\x77\x61\x5c\115\x6f\144\145\154\134\x4d\145\155\142\x65\162");
    }
    function change_password(\Base $O673402283) : void
    {
    }
    function upload_avatar(\Base $O673402283) : void
    {
    }
}
