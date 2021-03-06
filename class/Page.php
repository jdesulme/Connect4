<?php

class Page {
   // private $js, $title, $footer, $css;

    /**
     * Generates the html headers
     * @param array|string $cssArray multiple css files
     * @param string       $title
     */
    public static function html_header($cssArray = '', $title='Connect 4'){
        $css = (!empty($cssArray)) ? implode(' ', array_map("linkTag", $cssArray)) : '';
        $string = <<<END
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
        $css
        <script src="js/vendor/modernizr-2.6.1.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script src="js/vendor/jquery-ui-1.9.0.custom.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
END;
        echo $string;
    }

    public static function html_footer($jsArray = '', $footer='Connect 4 - Created & Designed by Jeanyhwh Desulme'){
        $js = (!empty($jsArray)) ? implode(' ', array_map("scriptTag", $jsArray)) : '';
        $string = <<<END
        <footer>$footer</footer>
        <script src="js/plugins.js"></script>
        $js
    </body>
</html>
END;
        echo $string;
    }
}

/**
 * Generates a script tag for javascript files
 * @param $name
 * @return string
 */
function scriptTag($name){
    return("<script src=\"js/" . $name  . ".js\"></script>");
}

/**
 * Generates a link tag for css files
 * @param $name
 * @return string
 */
function linkTag($name){
    return("<link rel=\"stylesheet\" href=\"css/" . $name  . ".css\">");
}
