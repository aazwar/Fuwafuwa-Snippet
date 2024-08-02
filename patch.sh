#!/bin/sh
# patch f3-template-directive bug
perl -i -pe 's@resolveContent\(\$node, \$attr\)@resolveContent(\$node)@' vendor/ikkez/f3-template-directives/src/template/taghandler.php
perl -i -pe 's@ \|\| empty\(\$header_types\)@@' vendor/mk-j/php_xlsxwriter/xlsxwriter.class.php