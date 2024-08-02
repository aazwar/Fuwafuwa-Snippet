<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:56              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

class Rss extends \Fuwafuwa\Controller\View
{
    use \Fuwafuwa\Traits\SQL;
    use \Fuwafuwa\Traits\Content;
    function root() : void
    {
        $O673402283 = \Base::instance();
        $O341134344 = m("\x5c\x46\165\x77\141\x66\165\x77\x61\x5c\115\157\144\145\x6c\x5c\x50\x6f\163\164")->rss_feed();
        $O673402283["\151\x74\145\x6d\x73"] = $O341134344;
        header("\x43\x6f\x6e\164\x65\156\164\55\164\x79\160\x65\72\40\141\160\x70\x6c\x69\x63\141\164\151\x6f\x6e\x2f\170\155\x6c\x3b\x63\x68\141\162\163\x65\164\x3d\x75\164\146\55\x38");
        $this->expire_header(date("\x59\x2d\155\55\x64\40\x48\x3a\x69\x3a\x73"), 3600);
        echo (new \Theme())->render("\x74\x65\x6d\x70\x6c\x61\x74\145\163\57\162\x73\x73", "\141\x70\160\x6c\x69\x63\141\164\151\157\156\57\x78\x6d\x6c");
    }
}
