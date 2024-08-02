<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:57              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa;

use Rakit\Validation\Rule;
class BaseModel extends \DB\SQL\Mapper
{
    use \Fuwafuwa\Traits\Content;
    use \Fuwafuwa\Traits\SQL;
    const REG_ADD = "\57\x61\x64\144\174\x63\x72\145\x61\x74\x65\x2f";
    const REG_EDIT = "\57\x65\x64\151\x74\57";
    const REG_DEL = "\x2f\144\x65\154\x7c\x72\x65\155\x6f\166\145\x2f";
    protected string $dbprefix = '';
    protected string $keys = '';
    public string $ai_field = '';
    public string $except_fields = '';
    public string $only_fields = '';
    public ?\closure $postRetrieve = null;
    public ?\closure $postView = null;
    public ?\closure $preProcess = null;
    public ?\closure $preCreate = null;
    public ?\closure $preUpdate = null;
    public ?\closure $preDelete = null;
    public ?\closure $postCreate = null;
    public ?\closure $postUpdate = null;
    public ?\closure $postDelete = null;
    public array $validation = [];
    public bool $softDelete = false;
    public string $deletedField = '';
    public $db = null;
    function __construct(\DB\SQL $O160990503, string $O845824466, array $O562033107 = [], string $O755397105 = NULL, int $O106538204 = 60)
    {
        goto O560233027;
        O064003031:
        if (!isset($O562033107["\153\x65\171\163"])) {
            goto O226600782;
        }
        $this->keys = $O562033107["\x6b\x65\171\163"];
        O226600782:
        if (!$O150018364) {
            goto O766602615;
        }
        $this->softDelete = true;
        $this->deletedField = $O150018364;
        O766602615:
        if ($this->keys) {
            goto O158309874;
        }
        goto O349960732;
        O349960732:
        throw new \Exception(t("\144\142\x2e\153\x65\x79\x5f\165\x6e\163\160\x65\x63\151\x66\x69\145\x64"));
        O158309874:
        $this->beforeerase(function (object $O031691036, array $O020377783) {
            if (!is_callable($this->preDelete)) {
                goto O411872249;
            }
            $this->preDelete($O031691036, $O020377783);
            O411872249:
        });
        $this->beforeinsert(function (object $O031691036, array $O020377783) use($O191338135, $O713264704, $O562033107) {
            if (!$O191338135) {
                goto O711606618;
            }
            $O031691036[$O191338135] = null;
            O711606618:
            if (!$O713264704) {
                goto O954563140;
            }
            $O031691036[$O713264704] = date("\131\55\155\x2d\144\x20\110\72\151\x3a\163");
            O954563140:
            if (!is_callable($this->preCreate)) {
                goto O380039901;
            }
            $this->preCreate($O031691036, $O020377783);
            O380039901:
        });
        $this->beforeupdate(function (object $O031691036, array $O020377783) use($O893888564, $O562033107) {
            if (!$O893888564) {
                goto O587323229;
            }
            $O031691036[$O893888564] = date("\131\x2d\x6d\x2d\x64\40\110\x3a\x69\x3a\163");
            O587323229:
            if (!is_callable($this->preUpdate)) {
                goto O294542473;
            }
            $this->preUpdate($O031691036, $O020377783);
            O294542473:
        });
        $this->aftererase(function (object $O031691036, array $O020377783) {
            if (!is_callable($this->postDelete)) {
                goto O911324360;
            }
            $this->postDelete($O031691036, $O020377783);
            O911324360:
        });
        $this->afterinsert(function (object $O031691036, array $O020377783) {
            if (!is_callable($this->postCreate)) {
                goto O190425660;
            }
            $this->postCreate($O031691036, $O020377783);
            O190425660:
        });
        $this->afterupdate(function (object $O031691036, array $O020377783) {
            if (!is_callable($this->postUpdate)) {
                goto O662611838;
            }
            $this->postUpdate($O031691036, $O020377783);
            O662611838:
        });
        goto O281109984;
        O261960698:
        $O150018364 = $O562033107["\x64\145\154\x65\164\145\x64\x5f\x66\x69\145\x6c\x64"] ?? '';
        if (!($O150018364 && !$this->fields[$O150018364])) {
            goto O951162057;
        }
        throw new \Exception(t("\x64\142\56\144\x65\154\145\164\x65\144\x5f\165\x6e\144\x65\x66\x69\x6e\x65\x64", $O150018364));
        O951162057:
        if (!$O191338135) {
            goto O751368408;
        }
        $this->keys = $O191338135;
        $this->ai_field = $O191338135;
        O751368408:
        goto O064003031;
        O560233027:
        $O673402283 = \Base::instance();
        $this->dbprefix = $O673402283["\x44\102\56\160\x72\145\146\x69\x78"] ?? '';
        parent::__construct($O160990503, $this->dbprefix . $O845824466, $O755397105, $O106538204);
        $this->db = $O160990503;
        $O191338135 = $O562033107["\141\151\x5f\x66\151\x65\154\144"] ?? '';
        if (!($O191338135 && !$this->fields[$O191338135])) {
            goto O287285645;
        }
        throw new \Exception(t("\144\142\x2e\141\x69\146\137\x75\156\x64\145\146\x69\156\x65\144", $O191338135));
        O287285645:
        goto O251373229;
        O251373229:
        $O713264704 = $O562033107["\x63\162\x65\x61\164\x65\144\x5f\146\151\145\x6c\144"] ?? '';
        if (!($O713264704 && !$this->fields[$O713264704])) {
            goto O449715752;
        }
        throw new \Exception(t("\x64\142\x2e\143\x72\145\x61\164\x65\x64\x5f\165\x6e\144\145\x66\x69\156\145\144", $O713264704));
        O449715752:
        $O893888564 = $O562033107["\x6d\157\x64\x69\146\x69\x65\x64\137\x66\151\x65\x6c\144"] ?? '';
        if (!($O893888564 && !$this->fields[$O893888564])) {
            goto O399284015;
        }
        throw new \Exception(t("\144\x62\56\x6d\157\144\151\x66\151\145\x64\137\165\156\144\x65\x66\151\156\145\x64", $O893888564));
        O399284015:
        goto O261960698;
        O281109984:
    }
    function pk() : array
    {
        return explode("\54", $this->keys);
    }
    function pkValues() : array
    {
        return array_map(fn($O760291049) => $this->{$O760291049}, $this->pk());
    }
    function lastInsertId() : int
    {
        return (int) $this->get("\x5f\x69\144");
    }
    function softdeleteCond() : string
    {
        return $this->softDelete ? "{$this->deletedField}\40\111\x53\x20\x4e\125\x4c\x4c" : '';
    }
    function tableName() : string
    {
        return $this->table;
    }
    function copyExcept(string $O224203247, $O318852266 = "\x52\x45\x51\125\105\x53\124") : void
    {
        $O755397105 = \Base::instance()->split($O224203247);
        $this->copyfrom($O318852266, function (array $O147042029) use($O755397105) : array {
            return array_diff_key($O147042029, array_flip($O755397105));
        });
    }
    function copyOnly(string $O224203247, $O318852266 = "\122\x45\x51\x55\105\123\124") : void
    {
        $O755397105 = \Base::instance()->split($O224203247);
        $this->copyfrom($O318852266, function (array $O147042029) use($O755397105) : array {
            return array_intersect_key($O147042029, array_flip($O755397105));
        });
    }
    public function saveFromData($O318852266) : void
    {
        if ($this->except_fields) {
            goto O319007147;
        }
        if ($this->only_fields) {
            goto O378773953;
        }
        $this->copyfrom($O318852266);
        goto O555392850;
        O319007147:
        $this->copyExcept($this->except_fields, $O318852266);
        goto O555392850;
        O378773953:
        $this->copyOnly($this->only_fields, $O318852266);
        O555392850:
        $this->save();
    }
    public function saveFromRequest() : void
    {
        $this->saveFromData("\x52\x45\121\x55\105\123\x54");
    }
    public function retrieve(array $O435430248)
    {
        $O503259346 = join("\x20\101\x4e\104\x20", array_map(function ($O303733380) {
            return "{$O303733380}\40\75\x20\77";
        }, \Base::instance()->split($this->keys)));
        return $this->load(array_merge([$O503259346], $O435430248));
    }
    public function erase($O270287008 = NULL, $O027467004 = TRUE) : void
    {
        if (!$this->loaded()) {
            goto O147646599;
        }
        if ($this->softDelete) {
            goto O825499069;
        }
        parent::erase($O270287008, $O027467004);
        goto O826089380;
        O825499069:
        $this[$this->deletedField] = date("\x59\x2d\155\x2d\x64\40\x48\72\x69\72\163");
        $this->save();
        O826089380:
        O147646599:
    }
    public function page(int $O197980361, int $O144303611, string $O283020758 = "\x2a", string $O124511808 = '', string $O503259346 = '') : array
    {
        goto O727991501;
        O727991501:
        $O124511808 && ($O124511808 = "\x4f\122\104\105\122\40\x42\x59\x20{$O124511808}");
        if (!$this->softDelete) {
            goto O867932247;
        }
        if ($O503259346) {
            goto O516839308;
        }
        $O503259346 .= "{$this->deletedField}\40\111\123\40\x4e\125\x4c\x4c";
        goto O067055886;
        O516839308:
        $O503259346 .= "\x20\x41\116\104\x20{$this->deletedField}\x20\x49\123\x20\x4e\125\114\114";
        O067055886:
        goto O414066471;
        O414066471:
        O867932247:
        $O045035930 = $O503259346 ? "\x57\110\x45\x52\x45\40{$O503259346}" : '';
        $O399050510 = (int) $this->FSQL1("\x53\x45\x4c\105\x43\x54\40\x43\117\125\x4e\124\x28\x31\51\40\106\122\x4f\x4d\40{$this->table}\40{$O045035930}");
        $O573984375 = ceil($O399050510 / $O144303611);
        $O197980361 = max(0, min($O197980361, $O573984375 - 1));
        $O128225742 = $O197980361 * $O144303611;
        $O309656867 = $this->SQL("\x53\105\114\x45\x43\x54\x20{$O283020758}\40\106\122\x4f\x4d\x20{$this->table}\x20{$O045035930}\x20{$O124511808}\x20\x4c\111\115\x49\124\40{$O128225742}\54\40{$O144303611}");
        if (!is_callable($this->postRetrieve)) {
            goto O224338324;
        }
        goto O825811325;
        O825811325:
        foreach ($O309656867 as &$O413561132) {
            $O413561132 += $this->postRetrieve($O413561132);
            O116855077:
        }
        O814467565:
        O224338324:
        return ["\163\x75\x62\163\x65\x74" => $O309656867, "\164\x6f\x74\141\x6c" => $O399050510, "\154\151\x6d\151\x74" => $O144303611, "\143\x6f\x75\156\x74" => $O573984375, "\160\x6f\163" => $O197980361];
        goto O785174325;
        O785174325:
    }
    function fieldFilter(string $O877262245, $O117508431, int $O835270704, string $O124511808 = '') : array
    {
        $O124511808 && ($O124511808 = "\x4f\122\104\105\122\40\102\131\x20{$O124511808}");
        return $this->SQL("\x53\105\114\105\x43\124\x20\x2a\x20\x46\x52\117\115\x20{$this->table}\40\127\110\105\122\x45\x20{$O877262245}\40\x3d\40\x3f\40{$O124511808}\40\x4c\x49\115\x49\x54\x20\x3f", $O117508431, $O835270704);
    }
    function codeValue(string $O125774725, string $O719889592, $O853595284 = true, string $O270287008 = '') : ?array
    {
        if (!$O270287008) {
            goto O305178537;
        }
        $O270287008 = "\x57\x48\105\122\x45\x20{$O270287008}";
        O305178537:
        $O891892174 = $this->SQL("\123\105\x4c\105\x43\x54\x20{$O125774725}\x20\141\163\x20\166\141\154\x75\145\54\x20{$O719889592}\x20\141\163\40\154\x61\x62\x65\x6c\40\106\x52\117\x4d\x20{$this->table}\x20{$O270287008}\x20\117\x52\x44\x45\x52\40\142\x79\x20{$O719889592}");
        if (!$O853595284) {
            goto O103336417;
        }
        array_unshift($O891892174, ["\x76\141\x6c\165\x65" => '', "\154\x61\x62\x65\154" => $O853595284 === true ? "\342\x80\x93\342\x80\x93" : $O853595284]);
        O103336417:
        return $O891892174;
    }
    function getKey(string $O877262245, $O117508431) : ?string
    {
        return $this->FSQL1("\123\105\114\x45\103\124\x20{$this->keys}\40\x46\x52\x4f\x4d\x20{$this->table}\x20\127\110\x45\122\x45\40{$O877262245}\x20\x3d\x20\x3f", $O117508431);
    }
    function getValue(string $O877262245, $O202884766) : ?string
    {
        return $this->FSQL1("\123\x45\x4c\105\103\x54\40{$O877262245}\x20\x46\122\x4f\x4d\x20{$this->table}\40\x57\110\x45\122\105\40{$this->keys}\40\x3d\x20\x3f", $O202884766);
    }
    function unique(string $O877262245, $O117508431) : bool
    {
        return !(bool) $this->FSQL1("\x53\105\114\105\x43\x54\40\x43\x4f\125\x4e\124\50\x31\51\x20\x46\x52\117\115\40{$this->table}\40\x57\x48\x45\122\x45\40{$O877262245}\x20\75\40\77", $O117508431);
    }
    protected function uniqueRule() : Rule
    {
        return new class($this) extends Rule
        {
            protected $message = "\x3a\141\x74\164\x72\x69\x62\x75\x74\x65\40\72\166\x61\154\165\x65\x20\151\x73\x20\156\x6f\164\x20\x75\x6e\151\161\x75\x65";
            protected $fillableParams = ["\146\151\145\x6c\x64"];
            protected $basemodel;
            function __construct($O192020120)
            {
                $this->basemodel = $O192020120;
            }
            public function check($O117508431) : bool
            {
                $this->requireParameters(["\x66\x69\x65\154\144"]);
                $O877262245 = $this->parameter("\x66\x69\x65\154\x64");
                if ($this->basemodel->loaded()) {
                    goto O570822517;
                }
                return $this->basemodel->unique($O877262245, $O117508431);
                goto O641133219;
                O570822517:
                return !$this->basemodel->changed($O877262245) || $this->basemodel->unique($O877262245, $O117508431);
                O641133219:
            }
        };
    }
    protected function existsInTable() : Rule
    {
        return new class($this) extends Rule
        {
            use \Fuwafuwa\Traits\SQL;
            protected $message = "\x3a\141\164\164\x72\151\142\165\164\145\x20\167\151\x74\150\x20\x76\141\x6c\x75\145\x20\x27\72\x76\x61\x6c\x75\145\x27\x20\144\x6f\x65\x73\x6e\47\164\40\x65\x78\151\x73\164\40\151\x6e\40\x74\141\x62\x6c\x65\40\x27\72\x74\141\x62\x6c\x65\47";
            protected $fillableParams = ["\164\x61\x62\x6c\x65", "\146\x69\145\154\x64"];
            protected $basemodel;
            function __construct($O192020120)
            {
                $this->basemodel = $O192020120;
            }
            public function check($O117508431) : bool
            {
                $this->requireParameters(["\164\141\142\154\145", "\146\151\145\154\144"]);
                $O845824466 = $this->parameter("\x74\141\142\154\x65");
                $O877262245 = $this->parameter("\x66\x69\145\154\144");
                if ($this->basemodel->loaded()) {
                    goto O171165024;
                }
                return (bool) $this->FSQL1("\x53\105\114\x45\103\124\x20\x43\117\125\x4e\x54\x28\61\x29\40\x46\122\117\x4d\x20{$O845824466}\x20\127\x48\105\x52\105\x20{$O877262245}\x20\x3d\40\x3f", $O117508431);
                goto O756290486;
                O171165024:
                return !$this->basemodel->changed($O877262245) || (bool) $this->FSQL1("\x53\x45\114\105\103\124\x20\x43\x4f\125\x4e\x54\x28\x31\51\40\x46\122\117\115\x20{$O845824466}\40\x57\110\105\x52\x45\x20{$O877262245}\40\75\40\x3f", $O117508431);
                O756290486:
            }
        };
    }
    protected function inexistsInTable() : Rule
    {
        return new class($this) extends Rule
        {
            use \Fuwafuwa\Traits\SQL;
            protected $message = "\x3a\x61\x74\164\162\151\x62\x75\x74\x65\40\x77\x69\164\x68\x20\166\x61\154\x75\145\x20\x27\x3a\x76\x61\x6c\165\145\47\40\x65\x78\x69\163\x74\x73\40\151\x6e\x20\x74\x61\x62\154\x65\40\47\x3a\164\x61\x62\x6c\x65\x27";
            protected $fillableParams = ["\164\x61\142\154\145", "\x66\151\145\154\x64"];
            protected $basemodel;
            function __construct($O192020120)
            {
                $this->basemodel = $O192020120;
            }
            public function check($O117508431) : bool
            {
                $this->requireParameters(["\164\x61\x62\x6c\145", "\146\x69\145\x6c\x64"]);
                $O845824466 = $this->parameter("\164\141\x62\x6c\145");
                $O877262245 = $this->parameter("\146\151\x65\x6c\144");
                if ($this->basemodel->loaded()) {
                    goto O863057599;
                }
                return !(bool) $this->FSQL1("\123\x45\x4c\x45\103\x54\x20\103\x4f\x55\x4e\x54\50\61\51\x20\106\x52\x4f\115\x20{$O845824466}\40\x57\110\105\122\105\x20{$O877262245}\40\75\x20\77", $O117508431);
                goto O609376724;
                O863057599:
                return !$this->basemodel->changed($O877262245) || !(bool) $this->FSQL1("\123\x45\x4c\x45\x43\x54\x20\103\117\x55\x4e\124\50\x31\x29\x20\x46\x52\x4f\115\40{$O845824466}\40\x57\110\105\x52\x45\40{$O877262245}\40\75\x20\x3f", $O117508431);
                O609376724:
            }
        };
    }
    function validate(string $O573311338, array $O318852266) : \Rakit\Validation\Validation
    {
        $O457292671 = $this->validation["\143\165\x73\164\x6f\155\x5f\x6d\145\x73\x73\x61\147\145"] ?? [];
        $O844362269 = $this->validation["\141\x6c\151\141\x73"] ?? [];
        $O492318964 = array_merge(\Base::instance()->get("\x54\x58\124\x5f\x72\x61\153\151\x74\x76\x61\x6c"), $O457292671);
        $O634014264 = $this->validation["\162\165\x6c\145\x73"];
        array_walk($O634014264, function (&$O117508431, string $O259079837) use($O573311338, $O318852266) {
            if (!is_callable($O117508431)) {
                goto O630557638;
            }
            $O117508431 = $O117508431($O573311338, $O318852266);
            O630557638:
        });
        $O607196538 = new \Rakit\Validation\Validator();
        $O607196538->addValidator("\x75\156\x69\161\165\145", $this->uniqueRule());
        $O607196538->addValidator("\145\170\151\163\164\x73\137\151\156\x5f\164\141\x62\154\x65", $this->existsInTable());
        $O607196538->addValidator("\151\156\x65\x78\151\163\164\x73\x5f\151\156\x5f\164\141\x62\x6c\145", $this->inexistsInTable());
        $O855324517 = $O607196538->make($O318852266, $O634014264, $O492318964);
        $O855324517->setAliases($O844362269);
        $O855324517->validate();
        return $O855324517;
    }
}
