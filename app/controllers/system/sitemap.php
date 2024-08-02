<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

class Sitemap extends \Fuwafuwa\Controller\View
{
    use \Fuwafuwa\Traits\Content;
    use \Fuwafuwa\Traits\SQL;
    function root() : void
    {
        $O673402283 = \Base::instance();
        $O365112864 = m("\134\106\165\x77\141\x66\165\167\x61\134\x4d\x6f\144\x65\154\x5c\x50\141\147\x65")->sitemap_feed();
        $O471550582 = m("\134\x46\165\167\141\x66\x75\167\x61\134\x4d\x6f\144\x65\x6c\x5c\x50\x6f\x73\x74")->sitemap_feed();
        $O046650536 = array_merge($O365112864, $O471550582);
        $O673402283["\154\x69\x6e\153\163"] = $O046650536;
        header("\x43\x6f\x6e\164\145\x6e\164\x2d\x74\171\160\145\x3a\x20\141\x70\160\x6c\x69\x63\x61\x74\x69\157\x6e\57\x78\155\154\73\143\x68\141\x72\x73\x65\x74\x3d\x75\164\146\x2d\x38");
        $this->expire_header(date("\x59\x2d\x6d\x2d\144\40\x48\72\x69\x3a\163"), 3600);
        print (new \Theme())->render("\164\x65\x6d\x70\x6c\x61\164\x65\163\57\163\151\164\145\155\x61\160", "\x61\x70\x70\154\x69\x63\141\x74\x69\x6f\156\57\x78\x6d\x6c");
    }
}
