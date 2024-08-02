/**
 * TinyMCE version 6.1.2 (2022-07-29)
 */

(function () {
  'use strict';

  var global = tinymce.util.Tools.resolve('tinymce.PluginManager');

  const setContent = (editor, html) => {
    editor.focus();
    editor.undoManager.transact(() => {
      editor.setContent(html);
    });
    editor.selection.setCursorLocation();
    editor.nodeChanged();
  };

  const getContent = editor => {
    let content = editor.getContent();
    return prettify(content) || content;
  };

  const open = editor => {
    const editorContent = getContent(editor);
    editor.windowManager.open({
      title: 'Pretty Source Code',
      size: 'large',
      body: {
        type: 'panel',
        items: [{
          type: 'textarea',
          name: 'code'
        }]
      },
      buttons: [
        {
          type: 'cancel',
          name: 'cancel',
          text: 'Cancel'
        },
        {
          type: 'submit',
          name: 'save',
          text: 'Save',
          primary: true
        }
      ],
      initialData: { code: editorContent },
      onSubmit: api => {
        setContent(editor, api.getData().code);
        api.close();
      }
    });
  };

  const register$1 = editor => {
    editor.addCommand('mceCodeEditor', () => {
      open(editor);
    });
  };

  const register = editor => {
    const onAction = () => editor.execCommand('mceCodeEditor');
    editor.ui.registry.addButton('pretty_code', {
      icon: 'sourcecode',
      tooltip: 'Pretty source code',
      onAction
    });
    editor.ui.registry.addMenuItem('pretty_code', {
      icon: 'sourcecode',
      text: 'Pretty source code',
      onAction
    });
  };

  function prettify(input) {
    // taken from https://github.com/evan-brass/regex-html
    // improvement: handling self closing tag, return prettify string

    const VOID_TAGS = [
      'area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'isindex', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr',
    ];
    const BREAK_TAGS = [
      'address', 'article', 'aside', 'audio', 'blockquote', 'body', 'br', 'canvas', 'datalist', 'dd', 'details', 'div', 'dl', 'fieldset', 'figure', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hr', 'link', 'main', 'meta', 'nav', 'ol', 'optgroup', 'p', 'picture', 'pre', 'ruby', 'script', 'section', 'style', 'svg', 'table', 'tbody', 'template', 'tfoot', 'thead', 'title', 'tr', 'ul', 'video'
    ];

    const BREAK_TAGS_END = [
      'dd', 'dt', 'figcaption', 'li', 'option', 'summary', 'td',
    ];

    const vtag = tag => VOID_TAGS.includes(tag.toLowerCase());
    const btag = tag => BREAK_TAGS.includes(tag.toLowerCase());
    const btage = tag => BREAK_TAGS_END.includes(tag.toLowerCase());

    const root = {
      children: []
    };

    function pull(regex, handler = () => { }) {
      const match = regex.exec(input);
      if (match !== null) {
        const [full_match, ...captures] = match;
        input = input.substr(full_match.length);
        handler(...captures);
        return full_match;
      } else {
        return false;
      }
    }

    function parse_content(cursor) {
      let run = true;
      while (run && input.length > 0) {
        // Parse the opening of a tag:
        const success = pull(/^<([a-zA-Z][a-zA-Z0-9\-]*)/, tag => {
          const new_tag = { tag, attributes: {}, children: [] };
          cursor.children.push(new_tag);
          let closed = parse_attributes(new_tag);
          if (closed) new_tag.closed = true;
          if (!vtag(tag) && !closed) {
            parse_content(new_tag);
          }
        })
          // Parse a closing tag
          || pull(/^<\/([a-zA-Z][a-zA-Z0-9\-]*)>/, tag => {
            if (
              cursor.tag === undefined ||
              cursor.tag.toLowerCase() !== tag.toLowerCase()
            ) {
              throw new Error("Closing tag doesn't match: " + cursor.tag);
            }
            run = false;
          })
          // Parse a text node
          || pull(/^([^<]+)/, text => {
            let ttext = text.trim().replace(/\s+|\n/g, ' ');
            ttext && cursor.children.push({
              text: ttext
            });
          });
        if (!success) {
          throw new Error("Parsing Error: No rules matched");
        }
      }
    }

    function parse_attributes(cursor) {
      while (pull(/^\s+([a-zA-Z][a-zA-Z0-9\-]*)(?:="([^"]*)")?/, (
        name,
        value
      ) => {
        cursor.attributes[name] = value;
      })) { }
      let match = '';
      if (match = pull(/^\s*\/?>/)) {
        return match.endsWith('/>')
      } else {
        throw new Error("Malformed open tag: " + cursor.tag);
      }
    }
    try {
      parse_content(root);
    } catch (error) {
      console.log(error)
      return false;
    }
    // return root.children;
    function format(node, level = 0) {
      let indent = "    ".repeat(level);
      if (node.text) {
        return node.text
      }
      let result = "";
      if (level && (btag(node.tag) || btage(node.tag))) result += "\n" + indent;
      result += `<${node.tag} `;
      Object.keys(node.attributes).forEach(k => {
        if (node.attributes[k]) {
          result += k + '="' + node.attributes[k] + '" '
        } else {
          result += k + '="" ';
        }
      });
      result += node.closed ? " />" : ">";
      if (btag(node.tag)) result += "\n  " + indent;
      node.children.forEach(c => {
        result += format(c, level + 1)
      });
      if (btag(node.tag)) result += "\n" + indent;
      if (!node.closed && !vtag(node.tag)) {
        result += `</${node.tag}>`;
      }
      return result;
    }

    let result = '';
    root.children.forEach(e => {
      result += format(e, 0) + "\n";
    })
    result = result.replace(/ >/g, '>').replace(/ +\/>/g, ' />').replace(/(\n\s+)?\n+/g, "\n");
    return result;
  }

  var Plugin = () => {
    global.add('pretty_code', editor => {
      register$1(editor);
      register(editor);
      return {};
    });
  };

  Plugin();

})();
