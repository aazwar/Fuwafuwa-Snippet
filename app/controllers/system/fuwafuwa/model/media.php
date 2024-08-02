<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Model;

class Media extends \Fuwafuwa\BaseModel
{
    function __construct(\Fuwafuwa\Db $O160990503)
    {
        parent::__construct($O160990503, "\x6d\145\x64\x69\x61", ["\141\151\137\x66\151\x65\154\144" => "\x69\x64", "\143\162\145\141\x74\x65\x64\x5f\146\x69\145\x6c\144" => "\143\x72\145\141\164\x65\x64", "\x62\x65\146\x6f\162\x65\x69\x6e\x73\x65\x72\x74" => function ($O031691036, $O020377783) {
            $O673402283 = \Base::instance();
            $O031691036["\157\x77\x6e\145\x72"] = $O673402283["\123\105\123\123\111\x4f\116\x2e\165\163\x65\162\156\x61\x6d\145"];
        }]);
        $this->preDelete = function (array $O031691036, array $O020377783) : void {
            if (!file_exists($O031691036["\x75\x72\154"])) {
                goto O647320167;
            }
            unlink($O031691036["\165\x72\x6c"]);
            O647320167:
        };
    }
    function removeByPath($O320386277) : bool
    {
        $this->load(["\x75\x72\154\40\x3d\x20\x3f", $O320386277]);
        if (!$this->loaded()) {
            goto O155049403;
        }
        $this->erase();
        return true;
        O155049403:
        return false;
    }
}
