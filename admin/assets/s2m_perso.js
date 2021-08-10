document.addEventListener('DOMContentLoaded', function () {
    coders = document.querySelectorAll('.coder');
    for (var i = 0; i < coders.length; i++) {
        var editor = CodeMirror.fromTextArea(coders[i], {
            lineNumbers: true,
            matchBrackets: true,
            mode: "xml",
            htmlMode: true,
            theme: "material",
            indentUnit: 2
        });
    }

    // buttons
    buttons = document.querySelectorAll('.shortcode_button');
    Array.prototype.forEach.call(buttons, function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            console.log(button.dataset.add);
            editor = document.getElementById(button.dataset.add).nextSibling.CodeMirror;
            value = button.value;
            insertTextAtCursor(editor, value);
        });
    });

});

function insertTextAtCursor(editor, str) {
    var selection = editor.getSelection();
    if (selection.length > 0) {
        editor.replaceSelection(str);
    } else {
        var doc = editor.getDoc();
        var cursor = doc.getCursor();
        var pos = {
            line: cursor.line,
            ch: cursor.ch
        }
        doc.replaceRange(str, pos);
    }
}
