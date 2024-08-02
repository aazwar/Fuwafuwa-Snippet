<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Controller;

class Ajax implements Controller
{
    protected array $data;
    function __construct()
    {
        $O673402283 = \Base::instance();
        $this->data = json_decode($O673402283["\x42\x4f\104\x59"], true) ?? $O673402283["\x52\x45\121\125\x45\123\x54"] ?? [];
    }
    function execute(\Base $O673402283, string $O573311338 = '') : void
    {
        header("\x43\x6f\x6e\x74\145\x6e\x74\x2d\164\171\160\x65\x3a\40\x61\x70\160\x6c\x69\x63\x61\164\151\x6f\156\57\x6a\163\x6f\156\73\x63\150\x61\x72\163\x65\164\x3d\165\x74\146\x2d\70");
        if (method_exists($this, $O573311338)) {
            goto O411619743;
        }
        $O673402283->error(404);
        goto O582216414;
        O411619743:
        $this->{$O573311338}($O673402283);
        O582216414:
    }
}
