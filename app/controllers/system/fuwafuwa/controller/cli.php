<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Controller;

class Cli implements Controller
{
    use \Fuwafuwa\Traits\Content;
    protected array $data = [];
    function execute(\Base $O673402283, string $O573311338 = '') : void
    {
        ob_end_flush();
        ob_implicit_flush();
        if ($O673402283->CLI) {
            goto O981557246;
        }
        $O673402283->error(500, "\117\x6e\154\x79\x20\x61\143\143\x65\x73\x73\x69\x62\154\145\x20\x66\162\x6f\155\x20\x63\x6c\x69");
        O981557246:
        if (method_exists($this, $O573311338)) {
            goto O194586328;
        }
        $O673402283->error(404, t("\143\x6f\x6d\155\x6f\x6e\56\155\145\x74\x68\157\144\137\x6e\x6f\164\137\x66\x6f\165\x6e\144", __CLASS__ . "\134{$O573311338}"));
        goto O273092029;
        O194586328:
        $this->data = $O673402283["\107\105\x54"] ?? [];
        $this->{$O573311338}($O673402283);
        O273092029:
    }
}
