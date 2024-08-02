<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2024-08-02 12:47:56              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/

namespace Fuwafuwa\Traits;

trait SQL
{
    function SQL()
    {
        if (property_exists($this, "\x64\x62")) {
            goto O609806500;
        }
        $O160990503 = c("\134\106\165\x77\141\146\x75\x77\x61\134\x44\x62");
        goto O886495234;
        O609806500:
        $O160990503 = $this->db ?? c("\x5c\x46\x75\x77\x61\146\x75\x77\141\134\x44\142");
        O886495234:
        $O691845072 = func_get_args();
        if (!is_array($O691845072[0])) {
            goto O703898052;
        }
        $O691845072 = $O691845072[0];
        O703898052:
        $O864688667 = array_shift($O691845072);
        return $O160990503->exec($O864688667, $O691845072);
    }
    function SQLR()
    {
        $O691845072 = func_get_args();
        if (!is_array($O691845072[0])) {
            goto O479650418;
        }
        $O691845072 = $O691845072[0];
        O479650418:
        return $this->SQL($O691845072)[0] ?? [];
    }
    function FSQL() : array
    {
        $O691845072 = func_get_args();
        if (!is_array($O691845072[0])) {
            goto O156005397;
        }
        $O691845072 = $O691845072[0];
        O156005397:
        return array_map(fn($O303733380) => array_values($O303733380), $this->SQL($O691845072));
    }
    function FSQLC() : array
    {
        $O691845072 = func_get_args();
        if (!is_array($O691845072[0])) {
            goto O297587613;
        }
        $O691845072 = $O691845072[0];
        O297587613:
        return array_map(fn(array $O303733380) => $O303733380[0], $this->FSQL($O691845072));
    }
    function FSQLR() : array
    {
        $O691845072 = func_get_args();
        if (!is_array($O691845072[0])) {
            goto O045269121;
        }
        $O691845072 = $O691845072[0];
        O045269121:
        return $this->FSQL($O691845072)[0] ?? [];
    }
    function FSQL1() : string
    {
        $O691845072 = func_get_args();
        if (!is_array($O691845072[0])) {
            goto O349065626;
        }
        $O691845072 = $O691845072[0];
        O349065626:
        return $this->FSQLR($O691845072)[0] ?? '';
    }
    function SQLBI(string $O766833760, array $O607697907, int $O832676338 = 100) : void
    {
        $O541506859 = array_map(function ($O227436236) {
            $O344177348 = array_map(function (string $O303733380) {
                return escapeSQLString($O303733380);
            }, $O227436236);
            return "\x28" . join("\54\x20", $O344177348) . "\x29";
        }, $O607697907);
        foreach (array_chunk($O541506859, $O832676338) as $O639496486) {
            $O379177861 = "{$O766833760}\x20\x56\x41\114\x55\105\123\40" . join("\54\40", $O639496486);
            $this->SQL($O379177861);
            O325314267:
        }
        O286037482:
    }
    function SQLBU(string $O766833760, string $O602431473, array $O607697907, int $O832676338 = 100) : void
    {
        $O541506859 = array_map(function ($O303733380) {
            return escapeSQLString($O303733380);
        }, $O607697907);
        foreach (array_chunk($O541506859, $O832676338) as $O639496486) {
            $O379177861 = "{$O766833760}\x20\x57\110\x45\x52\x45\40{$O602431473}\40\x49\x4e\40\50" . join("\x2c\x20", $O639496486) . "\51";
            $this->SQL($O379177861);
            O102916035:
        }
        O703059949:
    }
}
