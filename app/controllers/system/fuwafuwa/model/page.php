<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Model;

use Util\User;
class Page extends \Fuwafuwa\BaseModel
{
    function __construct(\Fuwafuwa\Db $O160990503)
    {
        parent::__construct($O160990503, "\160\141\x67\145", array("\x61\x69\x5f\146\x69\145\x6c\144" => "\x69\x64", "\x63\x72\145\x61\164\x65\x64\137\146\151\x65\154\144" => "\x63\x72\x65\141\x74\145\144", "\x6d\x6f\144\151\146\x69\x65\x64\x5f\x66\151\145\x6c\x64" => "\x75\160\x64\x61\x74\145\144"));
        $this->preCreate = function ($O031691036, $O020377783) {
            $O031691036["\165\x73\145\162"] = User::myId();
        };
        $this->preUpdate = function ($O031691036, $O020377783) {
            $O031691036["\x75\x73\x65\162"] = User::myId();
        };
    }
    function sitemap_feed() : array
    {
        $O673402283 = \Base::instance();
        $O841738847 = array_map(function ($O303733380) use($O673402283) {
            return ["\x75\x72\154" => $O673402283["\122\x4f\117\124\x5f\x55\122\114"] . "\57\x70\x61\x67\x65\57" . $O303733380["\x73\x6c\165\147"], "\x75\x70\x64\x61\x74\145\x64" => date(DATE_ATOM, strtotime($O303733380["\165\160\144\141\x74\x65\144"] ?? $O303733380["\143\x72\x65\141\x74\x65\x64"]))];
        }, $this->SQL("\123\105\x4c\x45\x43\x54\40\163\x6c\x75\147\54\x20\x75\x70\x64\x61\164\145\144\x2c\x20\x63\162\x65\141\x74\x65\x64\40\x46\x52\117\x4d\40\160\141\x67\145"));
        return $O841738847;
    }
}
