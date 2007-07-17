<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo htmlspecialchars($t->currLang);?>" xml:lang="<?php echo htmlspecialchars($t->currLang);?>">
<head>
    <title><?php echo htmlspecialchars($t->conf['site']['name']);?> :: <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'translate'))) echo $t->translate($t->pageTitle);?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo htmlspecialchars($t->charset);?>" />
    <meta http-equiv="Content-Language" content="<?php echo htmlspecialchars($t->currLang);?>" />
    <meta name="keywords" content="<?php echo htmlspecialchars($t->conf['site']['keywords']);?>" />
    <meta name="description" content="<?php echo htmlspecialchars($t->conf['site']['description']);?>" />
    <meta name="robots" content="ALL" />
    <meta name="copyright" content="Copyright (c) 2006 Seagull Framework, Demian Turner, and the respective authors" />
    <meta name="rating" content="General" />
    <meta name="generator" content="Seagull Framework v<?php echo htmlspecialchars($t->versionAPI);?>" />
    <link rel="help" href="http://trac.seagullproject.org" title="Seagull Documentation." />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'makeCssLink'))) echo htmlspecialchars($t->makeCssLink($t->theme,$t->conf['navigation']['stylesheet'],$t->moduleName));?>&amp;isFormSubmitted=<?php echo htmlspecialchars($t->submitted);?>" />

    <?php if ($this->options['strict'] || (is_array($t->aCssFiles)  || is_object($t->aCssFiles))) foreach($t->aCssFiles as $file) {?>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo htmlspecialchars($t->webRoot);?>/<?php echo htmlspecialchars($file);?>" />
    <?php }?>

    <?php echo $t->scriptOpen;?>
        var SGL_JS_WEBROOT="<?php echo htmlspecialchars($t->webRoot);?>";
        var SGL_JS_WINHEIGHT=<?php echo htmlspecialchars($t->conf['popup']['winHeight']);?>;
        var SGL_JS_WINWIDTH=<?php echo htmlspecialchars($t->conf['popup']['winWidth']);?>;
        var SGL_JS_SESSID="<?php echo htmlspecialchars($t->sessID);?>";
        var SGL_JS_CURRURL="<?php echo htmlspecialchars($t->currUrl);?>";
        var SGL_JS_THEME="<?php echo htmlspecialchars($t->theme);?>";
        var SGL_JS_ADMINGUI="1";
        var SGL_JS_DATETEMPLATE="<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getDateFormat'))) echo htmlspecialchars($t->getDateFormat());?>";
        var SGL_JS_URL_STRATEGY = "<?php echo htmlspecialchars($t->conf['site']['outputUrlHandler']);?>";
        var SGL_JS_FRONT_CONTROLLER = "<?php echo htmlspecialchars($t->conf['site']['frontScriptName']);?>";
    <?php echo $t->scriptClose;?>

    <script type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/js/mainAdmin.js"></script>
    <script type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/js/mainPublic.js"></script>
    <script type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/js/hack-IE-hover.js"></script>
    <script type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/js/global.js"></script>

    <?php if ($this->options['strict'] || (is_array($t->javascriptSrc)  || is_object($t->javascriptSrc))) foreach($t->javascriptSrc as $file) {?>
    <script type="text/javascript" src="<?php echo htmlspecialchars($file);?>"></script>
    <?php }?>

    <?php echo $t->scriptOpen;?>
    <?php if ($this->options['strict'] || (is_array($t->onReadyDom)  || is_object($t->onReadyDom))) foreach($t->onReadyDom as $eventHandler) {?>
        sgl.ready("<?php echo htmlspecialchars($eventHandler);?>");
    <?php }?>
    <?php if ($t->onLoad)  {?>
    window.onload = function() {
        <?php if ($this->options['strict'] || (is_array($t->onLoad)  || is_object($t->onLoad))) foreach($t->onLoad as $eventHandler) {?>
        <?php echo htmlspecialchars($eventHandler);?>;
        <?php }?>
    }
    <?php }?>
    <?php if ($t->onUnload)  {?>
    window.onunload = function() {
        <?php if ($this->options['strict'] || (is_array($t->onUnload)  || is_object($t->onUnload))) foreach($t->onUnload as $eventHandler) {?>
        <?php echo htmlspecialchars($eventHandler);?>;
        <?php }?>
    }
    <?php }?>
    <?php echo $t->scriptClose;?>

    <?php if ($t->wysiwyg)  {?>
    <?php if ($t->wysiwyg_fck)  {?>
    <script type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/fck/fckeditor.js"></script>
    <script type="text/javascript">
        var oFCKEditors = new Array;

        /* initalises an instance of FCK and returns the object. */
        function fck_add(id)
        {
            i = oFCKEditors.length;
            oFCKEditors[i] = new FCKeditor(id, '100%', 500);
            oFCKEditors[i].BasePath = SGL_JS_WEBROOT + "/fck/";
            oFCKEditors[i].Config["CustomConfigurationsPath"] = SGL_JS_WEBROOT + "/js/SglFckconfig.js"  ;
            oFCKEditors[i].ReplaceTextarea();
        }
        function fck_init()
        {
            if( document.getElementsByTagName ) {
                areas = document.getElementsByTagName('textarea');

                for( var i=0; i<areas.length; i++ ){
                    if( areas[i].className.match("wysiwyg") ) {
                        fck_add(areas[i].id);
                    }
                    else if( areas[i].id.match('frmBodyName') ) {
                        /* fallback for old templates */
                        fck_add('frmBodyName');
                    }
               }
            }
        }
    </script>
    <?php }?>
    <?php if ($t->wysiwyg_tinyfck)  {?>
        <script language="javascript" type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/tinyfck/tiny_mce_gzip.php"></script>
        <script language="javascript" type="text/javascript" src="<?php echo htmlspecialchars($t->webRoot);?>/js/SglTinyFckConfig.js"></script>
    <?php }?>
    <?php }?>
</head>
<body>
