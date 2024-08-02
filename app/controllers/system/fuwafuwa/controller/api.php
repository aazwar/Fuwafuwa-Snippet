<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Controller;

class Api implements Controller
{
    use \Fuwafuwa\Traits\Content;
    use \Fuwafuwa\Traits\SQL;
    protected $data;
    protected $uid;
    protected function authenticate(string $O784308344) : array
    {
        $O673402283 = \Base::instance();
        $O977815800 = array_values(array_filter((array) $O673402283["\101\x50\120\x2e\x61\x75\164\x68\x5f\143\x6c\141\x73\x73"], fn($O303733380) => class_exists($O303733380)));
        if ($O977815800) {
            goto O275117907;
        }
        $O673402283["\145\x72\162\157\162\x5f\x6d\163\147"] = "\116\x6f\x20\x61\165\164\150\x65\x72\x73\x20\x63\154\x61\163\x73\x20\144\x65\146\x69\x6e\145\x64";
        echo (new \Theme())->render("\x6c\x6f\147\x69\x6e");
        exit;
        O275117907:
        $O221806265 = [];
        foreach ($O977815800 as $O576906802) {
            $O221806265 = m($O576906802)->authenticate($O784308344);
            if (!isset($O221806265["\x61\165\x74\x68\x65\x64"])) {
                goto O105379201;
            }
            goto O911467943;
            O105379201:
            O464227019:
        }
        O911467943:
        return $O221806265;
    }
    function execute(\Base $O673402283, string $O573311338 = '')
    {
        goto O967606037;
        O967606037:
        $this->data = json_decode($O673402283["\x42\117\104\131"], true) ?? [];
        $O406328963 = explode("\40", $O673402283["\x48\105\x41\x44\105\122\123\56\x41\165\164\x68\x6f\x72\151\x7a\x61\x74\151\x6f\156"], 2);
        $O945319213 = [];
        if (!count($O406328963)) {
            goto O589219135;
        }
        [$O655445611, $O784308344] = $O406328963;
        if (!($O655445611 == "\102\145\x61\162\145\x72")) {
            goto O914511648;
        }
        $O945319213 = $this->authenticate($O784308344);
        O914511648:
        goto O831646195;
        O831646195:
        O589219135:
        $O774818420 = rbac_permission($O945319213["\165\x69\144"], $O945319213["\147\x72\x6f\165\160"], $O945319213["\160\145\x72\x6d\x69\163\x73\x69\157\x6e\163"], '', $O673402283["\x50\101\x54\x48"]);
        if ($O774818420) {
            goto O713179128;
        }
        $this->jsonResponse(false, t("\x6c\157\x67\x69\156\x2e\151\156\x76\x61\x6c\x69\144\x5f\164\x6f\153\x65\156"));
        goto O404096854;
        O713179128:
        if (method_exists($this, $O573311338)) {
            goto O643897178;
        }
        $this->jsonResponse(false, t("\x63\x6f\155\155\x6f\x6e\x2e\x6d\x65\164\x68\x6f\x64\137\x6e\157\x74\137\x66\157\x75\x6e\x64", __CLASS__ . "\x5c{$O573311338}"));
        goto O813322999;
        O813322999:
        goto O606787361;
        O643897178:
        $this->uid = $O945319213["\x6c\x6f\x67\x69\x6e"];
        $this->{$O573311338}($O673402283);
        O606787361:
        O404096854:
        goto O027488454;
        O027488454:
    }
}
