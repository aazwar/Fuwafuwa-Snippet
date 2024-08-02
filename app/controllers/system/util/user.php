<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Util;

use HtmlUtil;
use Util\Query;
class User
{
    static function roleOption() : string
    {
        return (new \Util\Html())->selectOption("\x5c\x46\x75\x77\141\146\x75\167\141\134\x4d\157\x64\145\154\134\122\x6f\154\x65", '', "\x69\x64", "\x6e\141\155\x65");
    }
    static function userOption() : string
    {
        return (new \Util\Html())->selectOption("\134\106\x75\167\x61\146\165\x77\141\x5c\115\157\x64\x65\x6c\x5c\125\x73\145\x72", '', "\151\144", "\156\141\155\145");
    }
    static function allowed($O431359579) : bool
    {
        $O673402283 = \Base::instance();
        $O770224106 = $O673402283["\123\105\123\123\x49\x4f\116\x2e\x70\x65\162\x6d\x69\x73\x73\151\x6f\156\163"];
        if ($O770224106 == "\x2a") {
            goto O730380961;
        }
        return in_array($O431359579, explode("\x2c", $O770224106));
        goto O439849732;
        O730380961:
        return true;
        O439849732:
    }
    static function roleList() : array
    {
        return parse_ini_file("\141\x70\160\57\x63\157\x6e\x66\x69\147\x73\x2f\x70\145\162\x6d\x69\163\x73\151\x6f\156\163\x2e\151\x6e\151", true);
    }
    static function myId()
    {
        return \Base::instance()->get("\x53\105\x53\123\111\117\116\x2e\x75\x73\145\162\x6e\141\x6d\145");
    }
}
