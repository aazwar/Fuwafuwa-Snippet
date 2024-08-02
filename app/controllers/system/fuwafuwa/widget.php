<?php

namespace Fuwafuwa;

/** Basic widget for use in HTML. 
 * 
 * Common Attributes:
 * 
 * ```
 * title: component
 * class: additional class for input component
 * inline: Whether title and input are placed side by side or in separate line
 * explanation: explanation text in small font below input 
 * cols: for radio and checkboxes, to arrange options in n cols
 * errormodel: variable for showing validation result message
 * exattr: explanation attributes, usually x-text or x-html for dynamic content
 * coattr: container attributes, usually id, :class or other alpine js attribute
 * ```
 */

class Widget {
    static function init() {
        $template = \Template::instance();
        $template->extend('ff:input', '\Fuwafuwa\Widget::input');
        $template->extend('ff:content', '\Fuwafuwa\Widget::content');
        $template->extend('ff:textarea', '\Fuwafuwa\Widget::textarea');
        $template->extend('ff:radio', '\Fuwafuwa\Widget::radio');
        $template->extend('ff:select', '\Fuwafuwa\Widget::select');
        $template->extend('ff:srselect', '\Fuwafuwa\Widget::srselect');
        $template->extend('ff:checkbox', '\Fuwafuwa\Widget::checkbox');
        $template->extend('ff:checkboxes', '\Fuwafuwa\Widget::checkboxes');
        $template->extend('ff:rating', '\Fuwafuwa\Widget::rating');
        $template->extend('ff:card', '\Fuwafuwa\Widget::card');
        $template->extend('ff:spinner', '\Fuwafuwa\Widget::spinner');
        $template->extend('ff:modal', '\Fuwafuwa\Widget::modal');
        $template->extend('ff:uploader', '\Fuwafuwa\Widget::uploader');
        $template->extend('ff:autocomplete', '\Fuwafuwa\Widget::autocomplete');
    }

    static function pick($array, $attrs) {
        $data = [];
        foreach ($attrs as $attr) {
            $data[$attr] = $array[$attr] ?? '';
        }
        $remn = array_diff_key($array, array_flip($attrs));
        $t = \Template::instance();
        $attr = implode(' ', array_map(fn ($e) => $e . ($remn[$e] ? '="' . $t->build($remn[$e]) . '"' : ''), array_keys($remn)));
        return [$data, $attr];
    }

    static function input($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'explanation', 'type', 'floating', 'errormodel', 'exattr', 'coattr', 'required', 'size']);
        $template = \Preview::instance()->render('blocks/widgets/input.html', null, $data + compact('attr'));
        return $template;
    }

    static function content($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'floating', 'explanation', 'content', 'exattr', 'coattr']);
        $template = \Preview::instance()->render('blocks/widgets/content.html', null, $data + compact('attr'));
        return $template;
    }

    static function textarea($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'content', 'explanation', 'errormodel', 'exattr', 'coattr', 'required']);
        $template = \Preview::instance()->render('blocks/widgets/textarea.html', null, $data + compact('attr'));
        return $template;
    }

    static function radio($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'cols', 'options', 'explanation', 'errormodel', 'exattr', 'coattr', 'required']);
        $template = \Preview::instance()->render('blocks/widgets/radio.html', null, $data + compact('attr'));
        return $template;
    }

    static function checkbox($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'explanation', 'errormodel', 'exattr', 'coattr', 'required']);
        $template = \Preview::instance()->render('blocks/widgets/checkbox.html', null, $data + compact('attr'));
        return $template;
    }

    static function checkboxes($node) {
        // can't use x-model here because it will override checkbox's value
        // use model parameter and let the component take care the binding
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'model', 'class', 'inline', 'options', 'cols', 'explanation', 'errormodel', 'exattr', 'coattr', 'required']);
        $template = \Preview::instance()->render('blocks/widgets/checkboxes.html', null, $data + compact('attr'));
        return $template;
    }

    static function select($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'options', 'explanation', 'errormodel', 'type', 'exattr', 'coattr', 'required', 'dboption', 'dboptionblank']);
        $template = \Preview::instance()->render('blocks/widgets/select.html', null, $data + compact('attr'));
        return $template;
    }

    static function srselect($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'options', 'explanation', 'errormodel', 'type', 'exattr', 'coattr', 'required', 'lookupUrl', 'codeField']);
        $template = \Preview::instance()->render('blocks/widgets/srselect.html', null, $data + compact('attr'));
        return $template;
    }

    static function autocomplete($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['title', 'class', 'inline', 'options', 'explanation', 'errormodel', 'type', 'exattr', 'coattr', 'required', 'lookupUrl', 'default']);
        $template = \Preview::instance()->render('blocks/widgets/autocomplete.html', null, $data + compact('attr'));
        return $template;
    }

    static function process_content($node) {
        unset($node['@attrib']);
        $result = "";
        foreach ($node as $content) {
            $result .= \Template::instance()->build($content);
        }
        return $result;
    }

    static function card($node) {
        [$data,] = static::pick($node['@attrib'] ?? [], ['image', 'link', 'title']);
        $content = static::process_content($node);
        $template = \Preview::instance()->render('blocks/widgets/card.html', null, $data + compact('content'));
        return $template;
    }

    static function modal($node) {
        [$data,] = static::pick($node['@attrib'] ?? [], ['size', 'title', 'id']);
        $content = static::process_content($node);
        $template = \Preview::instance()->render('blocks/widgets/modal.html', null, $data + compact('content'));
        return $template;
    }

    static function uploader($node) {
        [$data,] = static::pick($node['@attrib'] ?? [], ['title', 'section']);
        $content = static::process_content($node);
        $template = \Preview::instance()->render('blocks/widgets/uploader.html', null, $data + compact('content'));
        return $template;
    }

    static function rating($node) {
        [$data,] = static::pick($node['@attrib'] ?? [], ['size', 'value']);
        $template = \Preview::instance()->render('blocks/widgets/rating.html', null, $data);
        return $template;
    }

    static function spinner($node) {
        [$data, $attr] = static::pick($node['@attrib'] ?? [], ['size', 'color']);
        $template = \Preview::instance()->render('blocks/widgets/spinner.html', null, $data + compact('attr'));
        return $template;
    }
}
