<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:56              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Traits;

use Rakit\Validation\Rule;
trait Validation
{
    protected function uniqueRule() : Rule
    {
        return new class extends Rule
        {
            use \Fuwafuwa\Traits\SQL;
            protected $message = "\x3a\x61\164\164\x72\151\x62\165\164\145\x20\72\x76\141\x6c\x75\145\40\x69\163\x20\x6e\x6f\x74\40\x75\x6e\151\161\x75\x65\x20\151\156\x20\72\164\141\x62\x6c\145";
            protected $fillableParams = ["\164\141\142\154\145", "\x66\151\x65\154\x64"];
            function unique(string $O877262245, $O845824466, $O117508431) : bool
            {
                return !(bool) $this->FSQL1("\x53\x45\x4c\105\103\124\x20\103\x4f\125\116\124\50\x31\51\40\x46\122\117\115\40{$O845824466}\x20\127\x48\x45\x52\105\x20{$O877262245}\40\75\40\77", $O117508431);
            }
            public function check($O117508431) : bool
            {
                $this->requireParameters(["\164\x61\142\x6c\x65", "\146\x69\x65\x6c\x64"]);
                $O845824466 = $this->parameter("\164\x61\x62\x6c\145");
                $O877262245 = $this->parameter("\x66\151\145\154\x64");
                return $this->unique($O877262245, $O845824466, $O117508431);
            }
        };
    }
    function validate(array $O855324517, array $O318852266) : \Rakit\Validation\Validation
    {
        $O457292671 = $O855324517["\x63\x75\x73\x74\x6f\x6d\x5f\155\x65\x73\x73\x61\147\145"] ?? [];
        $O844362269 = $O855324517["\x61\x6c\151\141\x73"] ?? [];
        $O492318964 = array_merge(\Base::instance()->get("\124\130\124\x5f\162\x61\x6b\x69\x74\166\x61\x6c"), $O457292671);
        $O634014264 = $O855324517["\162\x75\x6c\x65\163"];
        $O607196538 = new \Rakit\Validation\Validator();
        $O607196538->addValidator("\x75\x6e\x69\161\x75\145", $this->uniqueRule());
        $O147042029 = $O607196538->make($O318852266, $O634014264, $O492318964);
        $O147042029->setAliases($O844362269);
        $O147042029->validate();
        return $O147042029;
    }
}
