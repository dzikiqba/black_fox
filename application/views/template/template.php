<html>
    <head>
        <title><?php if(isset($title)) echo $title; ?></title>
        <?php
		if(isset($script))
        foreach ($script as $key => $value)
            echo Html::script($value)."\n";

		if(isset($style))
        foreach ($style as $key => $value)
            echo Html::style($value)."\n";
        ?>
    </head>
    <body>
        <div id = "container">
            <div id = "header"><?php if(isset($header)) echo $header; ?>
             <div id = "menu"><?php if(isset($menu)) echo $menu; ?></div>
            </div>
           
            <div id = "content"><?php if(isset($content)) echo $content; ?></div>
        </div>
            <div id="push"></div>
            <div id="footer"><?php if(isset($footer)) echo $footer; ?></div>
        </div>        
    </body>
</html>