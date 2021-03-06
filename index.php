<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHPBin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-39957916-1');
            ga('send', 'pageview');
        </script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top editor-menu">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="brand" href="/"><b>PHPBin</b></a>
                    <a class="github" href="https://github.com/wojtekk/PHPBin">GitHub</a>
                    <button id="bRun" class="btn pull-right btn-primary">Run [F9]</button>
                    <select class="pull-right" id="consoleMode" title="Console mode">
                        <optgroup label="Basic">
                            <option value="text">Text</option>
                            <option value="json">JSON</option>
                            <option value="xml">XML</option>
                            <option value="html">HTML</option>
                        <optgroup label="Additional">
                            <option value="javascript">JavaScript</option>
                            <option value="php">PHP</option>
                            <option value="sh">SH</option>
                            <option value="sql">SQL</option>
                            <option value="svg">SVG</option>
                            <option value="xquery">XQuery</option>
                            <option value="yaml">YAML</option>
                    </select>
                    <button id="lMemory" class="btn disabled pull-right hide" title="Approximate memory usage / memory peak usage"><span class="icon-tasks"></span><span class="value" /></button>
                    <button id="lTime" class="btn disabled pull-right hide" title="Run time"><span class="icon-time"></span><span class="value" /></button>
                </div>
            </div>
        </div>

        <div class="editor-main">
            <div class="editor-row">
                <div class="editor-column"><pre class="editor" id="editor"></pre></div>
                <div class="editor-column"><pre class="editor" id="phpConsole"></pre></div>
            </div>
        </div>

        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/underscore-1.4.4.min.js"></script>
        <script src="js/backbone-1.0.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/ace/ace.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>
