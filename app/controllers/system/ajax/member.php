<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Ajax;

class Member extends \Fuwafuwa\Controller\FFTable
{
    function message($O673402283)
    {
        $this->ajaxEdit("\134\x46\165\167\x61\146\x75\167\x61\134\x4d\x6f\144\145\x6c\134\x4d\145\163\x73\x61\x67\x65");
    }
    function register(\Base $O673402283) : void
    {
        $this->sendJson(c("\x5c\x46\x75\x77\141\146\x75\x77\141\x5c\123\x65\x72\x76\151\143\x65\134\x4d\x65\155\x62\145\x72")->register($this->data));
    }
    function activate(\Base $O673402283) : void
    {
        $this->sendJson(c("\x5c\106\x75\167\141\146\x75\167\141\x5c\123\145\162\166\151\143\x65\x5c\x4d\x65\x6d\x62\x65\162")->activate($this->data));
    }
    function forgot_password(\Base $O673402283) : void
    {
        $this->sendJson(c("\x5c\106\165\167\141\x66\x75\167\x61\134\123\145\162\166\151\x63\x65\134\x4d\145\x6d\x62\145\x72")->forgot_password($this->data));
    }
    function change_password(\Base $O673402283) : void
    {
        $this->sendJson(c("\134\106\165\167\x61\146\165\167\x61\x5c\123\x65\x72\x76\151\143\145\x5c\115\x65\155\142\x65\x72")->change_password($this->data));
    }
    function upload_avatar($O673402283)
    {
        $O891892174 = $this->processUpload(webp: false, record_media: true, size_limit: 2 * 1024 * 1024);
        if ($O891892174) {
            goto O863682773;
        }
        $this->jsonResponse(success: false, message: "\106\141\x69\x6c\x65\144\x20\x74\157\x20\165\x70\154\157\x61\144\40\146\x69\154\145");
        goto O440326491;
        O863682773:
        $this->jsonResponse(success: true, message: '', data: $O891892174[0]);
        O440326491:
    }
}
