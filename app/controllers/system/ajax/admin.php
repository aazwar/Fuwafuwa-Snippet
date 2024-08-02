<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Ajax;

class Admin extends \Fuwafuwa\Controller\Ajax
{
    use \Fuwafuwa\Traits\Content;
    function clear_cache(\Base $O673402283) : void
    {
        \Cache::instance()->clear("\x43\x41\x43\x48\x45");
    }
    function load_config(\Base $O673402283) : void
    {
        $this->jsonResponse(true, "\114\157\141\144\x20\143\x6f\x6e\146\151\147", c("\134\x46\x75\x77\x61\146\165\x77\x61\134\123\145\x72\x76\151\x63\x65\x5c\103\x6f\156\146\x69\147")->load_pref());
    }
    function save_config(\Base $O673402283) : void
    {
        $O318852266 = array_intersect_key($this->data, array_flip(["\101\x50\120", "\103\x4f\x4d\120\x41\116\x59", "\x53\117\103\x49\x41\x4c", "\x4d\101\111\114", "\x57\x45\x42\123\x49\x54\105", "\114\x49\x43\x45\116\123\105"]));
        c("\x5c\106\x75\x77\141\x66\x75\167\x61\134\123\145\x72\x76\x69\143\145\x5c\x43\157\x6e\x66\x69\x67")->store_pref($O318852266);
        $this->jsonResponse(true, "\103\157\156\146\x69\147\40\163\141\166\x65\144", $O318852266);
    }
    function test_email(\Base $O673402283) : void
    {
        ["\150\157\x73\x74" => $O460551053, "\160\x6f\x72\x74" => $O648104935, "\x73\143\x68\x65\x6d\x65" => $O329223825, "\165\x73\145\162" => $O945319213, "\160\141\x73\x73" => $O725699379, "\x66\x72\157\x6d" => $O816445333] = $this->data;
        $O891892174 = c("\134\106\165\167\141\x66\165\x77\x61\134\103\157\156\x74\x72\x6f\154\x6c\x65\162\x5c\115\141\x69\x6c")->test($O460551053, $O648104935, $O329223825, $O945319213, $O725699379, $O816445333);
        print json_encode($O891892174);
    }
}
