<?php

/**
 * Source code generator.
 *
 * @author Azrul Azwar
 * @version $Id$
 * @copyright , 3 April, 2020
 */

namespace Fuwafuwa;

use Rakit\Validation\Helper;

/**
 * CLI generator.
 * 
 * php index.php fuwafuwa/generator/generator-function --options=value
 */
class Generator extends \Fuwafuwa\Controller\Cli implements \Fuwafuwa\Controller\Controller {

    protected \DB\SQL $db;

    function __construct() {
        $this->db = c('\Fuwafuwa\Db');
    }
    /**
     * Action dispatcher.
     *
     * @param \Base $f3
     * @param string $action 
     *
     * @return void
     */
    function execute(\Base $f3, string $action = ""): void {
        if (method_exists($this, $action)) {
            $this->$action($f3);
        } else {
            die(t('common.method_not_found', __CLASS__ . "\\$action"));
        }
    }

    /**
     * List available generators.
     *
     * @param \Base $f3
     * @return void
     */
    function list(\Base $f3): void {
        $methods = get_class_methods(self::class);
        $methods = array_filter($methods, function ($m) {
            $ref = new \ReflectionMethod(self::class, $m);
            return $ref->isPublic();
        });
        array_splice($methods, 0, 5);
        print join("\n", $methods);
    }

    /**
     * Provides different instructions based on the input function provided in the GET request.
     * 
     * @param \Base f3
     */
    function help(\Base $f3): void {
        switch ($f3['GET.function']) {
            case 'ajax_fftable':
                print "--table=tableName\nCreate skeleton for FFTable Ajax backend";
                break;
            case 'fftable':
                print "--table=tableName\nCreate skeleton for FFTable frontend";
                break;
            case 'model':
                print "--table=tableName\nCreate model database";
                break;
            case 'component':
                print <<<HELP
          Create various components
          --name=tab --panels="Activity, History, Report" --id=Journal
          --name=card --title --fields="Name,Address,Telp" --icon=true
          HELP;
                break;
            default:
                print "help --function=xxx";
                break;
        }
        print "\n";
    }
    /**
     * Internal use. To deceive f3 parser, some token must be modified.
     *
     * @param string $text
     *
     * @return string
     */
    private function normalize(string $text): string {
        return str_replace(
            ['<{ /', '<{', '}>', '<*', '*>',],
            ['</', '<', '>', '{*', '*}'],
            $text
        );
    }

    private function table_info(string $table): array {
        $result = [
            'table' => $table
        ];
        $map = new \DB\SQL\Mapper($this->db, $table);
        $schema = $map->schema();
        $keys = array_filter($schema, fn ($e) => $e['pkey']);
        $result['fields'] = $map->fields();
        $types = [];
        foreach ($schema as $key => $val) {
            $types[$key] = $val['type'];
        }
        if (count($keys) == 1) {
            $key = array_keys($keys)[0];
            $result['keys'] = $key;
            $result['auto_inc'] = $keys[$key]['auto_inc'] ?: preg_match('/int/i', $types[$key]);
        } else {
            $result['keys'] = implode(',', array_keys($keys));
        }

        // convert to html input type
        foreach ($types as $key => &$val) {
            switch ($val) {
                case (bool)preg_match('/int|num/i', $val):
                    $val = 'number';
                    break;
                case (bool)preg_match('/DATE|TIME/i', $val): // time, date, datetime
                    $val = strtolower($val);
                    break;
                default:
                    $val = 'text';
                    break;
            }
        }
        $result['types'] = $types;
        return $result;
    }

    private function md_info($master, $detail, $master_key = null) {
        ['table' => $mtable, 'fields' => $mfields, 'keys' => $mkeys, 'types' => $mtypes, 'auto_inc' => $mauto_inc] = $this->table_info($master);
        ['table' => $dtable, 'fields' => $dfields, 'keys' => $dkeys, 'types' => $dtypes, 'auto_inc' => $dauto_inc] = $this->table_info($detail);
        $master_key ??= $mtable . "_id";
        return compact("mtable", "mfields", "mkeys", "mtypes", "mauto_inc", "dtable", "dfields", "dkeys", "dtypes", "dauto_inc", "master_key");
    }

    function info($f3) {
        extract($f3['GET']);
        print_r($this->table_info($table));
    }

    function ajax_fftable(\Base $f3): void {
        extract($f3['GET']);
        $out = (new \Theme)->render_bare('_generator/ajax-fftable.tmpl', $this->table_info($table));
        print $this->normalize($out);
    }

    function fftable(\Base $f3): void {
        extract($f3['GET']);
        $out = (new \Theme)->render_bare('_generator/fftable.tmpl', $this->table_info($table));
        print $this->normalize($out);
    }

    private function parse_json_setting() {
        $default = [
            'fields' => [],
            'form' => [
                'id' => 'form_' . dechex(time()),
                'size' => 'large',
                'columns' => 2,
                'url' => '/ajax/user/edit',
                'watch' => [],
            ],
            'table' => [
                'id' => 'table',
                'masterId' => '', // master table id, for master-slave tables
                'containerId' => 'tabCont_' . dechex(time()),
                'editable' => true,
                'deletable' => false,
                'selectable' => true,
                'pageSize' => 30,
                'class' => [],
                'formatter' => [],
                'sortable' => [],
                'display' => 'normal',
                'displayClass' => 'h-[60vh]',
                'url' => '/ajax/user/list',
                'nonSortable' =>
                array(
                    0 => 'push_token',
                ),
                'searchable' =>
                array(
                    0 => 'login',
                    1 => 'fullname',
                ),
            ]
        ];
        $def = json_decode(file_get_contents("php://stdin"), true);
        foreach (['fields', 'table', 'form']  as $sect) {
            $default[$sect] = array_replace_recursive($default[$sect], (array)$def[$sect]);
        }
        if (is_string($default['form']['pk'])) {
            $default['form']['pk'] = preg_split('/[\s,\|]+/', $default['form']['pk']);
        }

        foreach ($default['fields'] as $f) {
            if ($f['fclass']) $default['form']['class'][$f['name']] = $f['fclass'];
            if ($f['watch']) $default['form']['watch'] = array_merge($f['watch'], $default['form']['watch']);

            if ($f['class']) $default['table']['class'][$f['name']] = $f['class'];
            // function is not serializable: formatter
            $default['table']['sortable'][$f['name']] = true;
            if (is_bool($f['sortable'])) $default['table']['sortable'][$f['name']] = $f['sortable'];
            if (!is_bool($f['visible'])) $f['visible'] = true;
            $prefix = $f['queryPrefix'] ? $f['queryPrefix'] + '.' : '';
            $default['table']['queryTrans'][$f['name']] = $prefix . $f['name'];
        }
        $default['form']['watch'] = array_unique($default['form']['watch']);
        $default['cols'] = array_map(fn ($e) => $e['name'], array_filter($default['fields'], fn ($e) => !$e['visible']));
        $default['titles'] = array_map(fn ($e) => $e['title'], array_filter($default['fields'], fn ($e) => !$e['visible']));
        $default['dcols'] = array_map(fn ($e) => $e['name'], array_filter($default['fields'], fn ($e) => !$e['virtual']));
        $default['tinymce'] = $def['tinymce'];
        return $default;
    }

    function static_table(\Base $f3): void {
        $config = $this->parse_json_setting();

        $out = (new \Theme)->render_bare('_generator/static-table.tmpl', $config);
        print $this->normalize($out);
    }

    function static_form(\Base $f3): void {
        $config = $this->parse_json_setting();

        $out = (new \Theme)->render_bare('_generator/static-form.tmpl', $config);
        $out = str_replace('class="" ', '', $out);
        print $this->normalize($out);
    }

    function standalone_form(\Base $f3): void {
        $config = $this->parse_json_setting();

        $out = (new \Theme)->render_bare('_generator/standalone-form.tmpl', $config);
        $out = str_replace('class="" ', '', $out);
        print $this->normalize($out);
    }

    function static_modal(\Base $f3): void {
        $config = $this->parse_json_setting();

        $out = (new \Theme)->render_bare('_generator/static-modal.tmpl', $config);
        print $this->normalize($out);
    }

    function static_ajax(\Base $f3): void {
        extract($f3['GET']);
        $out = (new \Theme)->render_bare('_generator/static-ajax.tmpl', $this->table_info($table));
        print $this->normalize($out);
    }


    /**
     * Model
     *
     * @param \Base $f3
     * @return void
     */
    function model(\Base $f3): void {
        extract($f3['GET']);
        $info = $this->table_info($table);
        $opts = [];
        if (isset($info['auto_inc'])) {
            $opts['ai_field'] = $info['keys'];
        } else {
            $opts['keys'] = $info['keys'];
        }
        foreach ($info['fields'] as $field) {
            if (preg_match('/create(d|d?_(date|at))/i', $field)) $opts['created_field'] = $field;
            if (preg_match('/update(d|d?_(date|at))/i', $field)) $opts['modified_field'] = $field;
            if (preg_match('/delete(d|d?_(date|at))/i', $field)) $opts['deleted_field'] = $field;
        }
        $info['opts'] = $opts;
        $out = (new \Theme)->render_bare('_generator/model.tmpl', $info);
        print $this->normalize($out);
    }

    function component(\Base $f3): void {
        // --name=tab --panels="Activity, History, Report" --id=Journal
        // --name=accordion --n=2
        extract($f3['GET']);
        switch ($name) {
            case 'tab': // --name=tab --panels="activity,history,report" --id=panel
                $panels = preg_split('/,\s*/', $panels);
                $panelId = $id ?? 'A';
                $head = '';
                $content = '';
                foreach ($panels as $index => $panel) {
                    $active = $index == 0 ? 'true' : 'false';
                    $upanel = ucwords($panel);
                    $head .= <<<HEAD
          <li class="mr-2" role="presentation">
              <button class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500" id="profile-tab" data-tabs-target="#$panel" type="button" role="tab" aria-controls="$panel" aria-selected="$active">$upanel</button>
          </li>\n
          HEAD;
                    $content .= <<<CONTENT
          <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="$panel" role="tab-$panel" aria-labelledby="$panel-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">$upanel content here</p>
          </div>\n
          CONTENT;
                }
                print <<<TAB
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
          <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" id="{$panelId}Tab" data-tabs-toggle="#{$panelId}TabContent" role="tablist">
          $head
          </ul>
        </div>
        <div id="{$panelId}TabContent">
          $content
        </div>        
        TAB;
                break;
            case 'accordion': // n=number of sections
                for ($i = 1; $i <= $n; $i++) {
                    $bc = 'flex items-center justify-between w-full p-5 font-medium text-left border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white';
                    if ($i == 1) $bc .= ' rounded-t-xl';
                    print <<<ACC
            <!-- section $i -->
            <div id="accordion-collapse" data-accordion="collapse">
              <h2 id="accordion-collapse-heading-1">
                <button type="button" class="$bc" data-accordion-target="#accordion-collapse-body-$i" aria-expanded="true" aria-controls="accordion-collapse-body-$i">
                  <span>Title</span>
                  <svg data-accordion-icon="" class="rotate-180 size-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
              </h2>
              <div id="accordion-collapse-body-$i" class="" aria-labelledby="accordion-collapse-heading-$i">
                <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                  <p class="mb-2 text-gray-500 dark:text-gray-400">content</p>
                </div>
              </div>
            </div>
            ACC;
                }
                break;
            default:
                # code...
                break;
        }
    }
}
