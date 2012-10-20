<?php

class Page {
    public $title, $js, $css, $footer;

    function html_header($js='', $title='Connect 4', $css=''){
        $this->title = $title;
        $this->js = $js;
        $this->css = $css;
        $string = <<<END
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html>
	<head>
	    <title>$title</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="author" content="Jeanyhwh Desulme">
        <meta name="description" content="A final project for a Web Client Server Programming">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/blitzer/jquery-ui-1.9.0.custom.min.css">
        <script src="js/vendor/modernizr-2.6.1.min.js"></script>
    </head>
    <body>
END;
        echo $string;
    }

    function html_footer($footer='Connect 4 - Created & Designed by Jeanyhwh Desulme'){
        $this->footer = $footer;
        $string = <<<END

        <footer>$footer</footer>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script src="js/vendor/jquery-ui-1.9.0.custom.min.js"><script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
END;
        echo $string;
    }
}

