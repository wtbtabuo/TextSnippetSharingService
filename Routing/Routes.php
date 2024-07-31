<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    'api/textSnippet'=>function(){
        $inputData = json_decode(file_get_contents('php://input'), true);
        $uid = ValidationHelper::string($inputData['uid']??null);
        $text = ValidationHelper::string($inputData['text']??null);
        $language = ValidationHelper::string($inputData['language']??null);
        $retention = ValidationHelper::string($inputData['retention']??null);
        $title = ValidationHelper::string($inputData['title']??null);
        $textSnippet = DatabaseHelper::postTextSnippet($uid, $text, $language, $retention, $title);
        return new JSONRenderer(['textSnippet'=>$textSnippet]);
    }
];