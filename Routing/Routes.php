<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    'api/textSnippet'=>function(){
        $order = ValidationHelper::string($_POST['uid']??null);
        $order = ValidationHelper::string($_POST['code']??null);
        $order = ValidationHelper::string($_POST['code_language']??null);
        // $order = ValidationHelper::string($_POST['is_expired']??null);
        // $order = ValidationHelper::string($_POST['expired_at']??null);
        $textSnippet = DatabaseHelper::postTextSnippet();
        return new JSONRenderer(['textSnippet'=>$textSnippet]);
    },
    'api/parts/performance'=>function(){
        $order = ValidationHelper::string($_GET['order']??null);
        $type = ValidationHelper::string($_GET['type']??null);
        $performance = DatabaseHelper::getPerformance($order, $type);
        return new JSONRenderer(['performance'=>$performance]);
    },
];