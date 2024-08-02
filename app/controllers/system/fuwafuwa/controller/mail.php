<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Controller;

use Rakit\Validation\Rules\Boolean;
class Mail
{
    use \Fuwafuwa\Traits\Content;
    protected string $template;
    protected string $subject;
    protected bool $html = true;
    protected string $mime = "\164\x65\170\x74\x2f\x70\154\141\151\156";
    function __construct(string $O589433584 = '', string $O092261741 = '')
    {
        $this->template = $O589433584;
        $this->subject = $O092261741;
    }
    private function initMailer($O460551053 = '', $O648104935 = '', $O329223825 = '', $O945319213 = '', $O725699379 = '')
    {
        $O673402283 = \Base::instance();
        $O221886742 = c("\x5c\x50\110\120\x4d\x61\151\x6c\145\162\x5c\120\110\120\x4d\141\x69\154\x65\x72\x5c\120\x48\120\115\141\x69\154\145\x72", [true]);
        $O221886742->isSMTP();
        $O221886742->Host = $O460551053 ?: $O673402283["\x4d\x41\x49\x4c\x2e\x68\157\163\x74"];
        $O221886742->Port = $O648104935 ?: $O673402283["\x4d\x41\x49\114\56\160\157\162\x74"];
        $O221886742->SMTPSecure = $O329223825 ?: $O673402283["\115\x41\111\114\x2e\163\x63\150\145\x6d\x65"];
        $O221886742->SMTPAuth = (bool) ($O329223825 ?: $O673402283["\115\101\111\x4c\56\x73\x63\150\145\155\145"]);
        $O221886742->Username = $O945319213 ?: $O673402283["\x4d\x41\x49\114\x2e\x75\x73\145\162"];
        $O221886742->Password = $O725699379 ?: $O673402283["\x4d\101\111\114\56\160\x61\x73\163"];
        if (!$this->html) {
            goto O729488457;
        }
        $O221886742->isHTML(true);
        O729488457:
        return $O221886742;
    }
    private function splitAddress($O566333081)
    {
        if (preg_match("\57\42\50\56\x2a\51\42\x5c\163\x3c\x28\x2e\52\x29\76\57", $O566333081, $O130684250)) {
            goto O104539431;
        }
        $O701283922 = '';
        $O863668589 = $O566333081;
        goto O469175036;
        O104539431:
        [, $O701283922, $O863668589] = $O130684250 + ['', '', ''];
        O469175036:
        return [$O863668589, $O701283922];
    }
    private function send_email(string $O611929191, string $O092261741, string $O050491992, $O032179913 = true)
    {
        $O673402283 = \Base::instance();
        try {
            $O221886742 = $this->initMailer();
            [$O566333081, $O844362269] = $this->splitAddress($O673402283["\x4d\101\111\x4c\x2e\146\x72\157\155"]);
            $O221886742->setFrom($O566333081, $O844362269);
            $O221886742->addReplyTo($O566333081, $O844362269);
            $O221886742->addAddress($O611929191);
            $O221886742->Subject = $O092261741;
            $O221886742->Body = $O050491992;
            $O221886742->send();
            return $this->jsonResult(true, "\x45\155\141\x69\x6c\x20\x73\x65\156\x74");
        } catch (\Throwable $O304253321) {
            return $this->jsonResult(false, $O304253321->getMessage());
        }
    }
    function send(string $O440689033, ?array $O318852266 = null)
    {
        $O050491992 = \Template::instance()->render($this->template, $this->mime, $O318852266);
        return $this->send_email($O440689033, $this->subject, $O050491992);
    }
    function setSubject(string $O092261741) : void
    {
        $this->subject = $O092261741;
    }
    function test($O460551053, $O648104935, $O329223825, $O945319213, $O725699379, $O816445333)
    {
        try {
            $O221886742 = $this->initMailer($O460551053, $O648104935, $O329223825, $O945319213, $O725699379);
            [$O566333081, $O844362269] = $this->splitAddress($O816445333);
            $O221886742->setFrom($O566333081, $O844362269);
            $O221886742->addReplyTo($O566333081, $O844362269);
            $O221886742->addAddress($O566333081);
            $O221886742->Subject = "\x46\165\x77\141\146\165\167\x61\40\106\x72\x61\x6d\145\167\x6f\162\x6b\40\124\145\163\164\40\105\x6d\x61\151\154";
            $O221886742->Body = "\x54\x68\x69\x73\x20\x69\163\40\164\145\163\x74\x20\x65\x6d\x61\151\x6c";
            $O221886742->send();
            return $this->jsonResult(true, "\x45\x6d\141\151\x6c\x20\x73\145\156\164");
        } catch (\Throwable $O304253321) {
            return $this->jsonResult(false, $O304253321->getMessage());
        }
    }
}
