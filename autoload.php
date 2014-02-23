<?php

 set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR,
    array(
        DOCUMENT_ROOT . '/core',
        DOCUMENT_ROOT . '/modules',
        //DOCUMENT_ROOT . '/controller',
        //DOCUMENT_ROOT . '/model',
        DOCUMENT_ROOT . '/vendor'
    )
 ));

spl_autoload_register(function ($className) {
    $className = (string)str_replace('\\', DIRECTORY_SEPARATOR, $className);
    include_once($className . '.php');
});
