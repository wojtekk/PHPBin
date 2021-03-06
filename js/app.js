function loaded(data, textStatus, jqXHR) {
    time = jqXHR.getResponseHeader('X-PHPBin-RunTime');
    memory = jqXHR.getResponseHeader('X-PHPBin-MemoryPeakUsage');
    result = '';
    if (memory) {
        $("#lMemory").removeClass("hide");
        $("#lMemory .value").text(memory);
    } else {
        $("#lMemory").addClass("hide");
    }
    if (time) {
        $("#lTime .value").text(time);
        $("#lTime").removeClass("hide");
    } else {
        $("#lTime").addClass("hide");
    }
    result += data;

    phpConsole.setValue(result);
    phpConsole.clearSelection();
    editor.focus();
}

function errorLoaded(jqXHR, textStatus, errorThrown) {
    phpConsole.setValue("Run error (" + textStatus + ")" );
    phpConsole.clearSelection();
    editor.focus();
}

var AppView = Backbone.View.extend({
    el: $("body"),
    editor: null,
    phpConsole: null,
    events: {
        "click #bRun": "execute",
        "keydown": "checkF9",
        "change #consoleMode": "consoleModeChange"

    },
    initialize: function() {
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/chrome");
        session = editor.getSession();
        session.setMode("ace/mode/php");

        editor.on("change", function(e) {
            localStorage.setItem("sourceCode", editor.getValue());
        });
        var c = localStorage.getItem("sourceCode");
        if (c) {
            editor.setValue(c);

        } else {
            editor.setValue("<?php\n\n# Example\necho date('l, j F, H:i');");

        }
        editor.setFontSize('14px');
        session.setFoldStyle("markbegin");
        session.setUseWrapMode(false);
        editor.setSelectionStyle("line");
        editor.setHighlightActiveLine(true);

        editor.setShowInvisibles(false);
        editor.setDisplayIndentGuides(true);
        editor.renderer.setShowGutter(true);
        editor.renderer.setShowPrintMargin(true);
        editor.setHighlightSelectedWord(true);
        editor.renderer.setHScrollBarAlwaysVisible(false);
        editor.setAnimatedScroll(true);
        editor.session.setUseSoftTabs(true);
        editor.setBehavioursEnabled(true);
        editor.setFadeFoldWidgets(true);

        phpConsole = ace.edit("phpConsole");
        phpConsole.setTheme("ace/theme/chrome");
        phpConsole.getSession().setMode("ace/mode/text");
        phpConsole.setFontSize('14px');
        phpConsole.setReadOnly(true);

        editor.clearSelection();
        editor.focus();
    },
    execute: function() {
        var code = editor.getValue();
        $.ajax({url: 'run.php', type: "POST", data: {code: code}, success: loaded, error: errorLoaded });
        return false;
    },
    checkF9: function(e) {
        if (120 === e.keyCode) {
            this.execute();
        }
    },
    consoleModeChange: function() {
        phpConsole.getSession().setMode("ace/mode/" + $("#consoleMode").val());
    }

});

var App = new AppView;


