<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    'random/part'=>function(): HTTPRenderer{
        $part = DatabaseHelper::getRandomComputerPart();

        return new HTMLRenderer('component/random-part', ['part'=>$part]);
    },
    'parts'=>function(): HTTPRenderer{
        // IDの検証
        $id = ValidationHelper::integer($_GET['id']??null);

        $part = DatabaseHelper::getComputerPartById($id);
        return new HTMLRenderer('component/parts', ['part'=>$part]);
    },
    'api/random/part'=>function(): HTTPRenderer{
        $part = DatabaseHelper::getRandomComputerPart();
        return new JSONRenderer(['part'=>$part]);
    },
    'api/parts'=>function(){
        $id = ValidationHelper::integer($_GET['id']??null);
        $part = DatabaseHelper::getComputerPartById($id);
        return new JSONRenderer(['part'=>$part]);
    },
    'api/types'=>function(){
        $type = ValidationHelper::string($_GET['type']??null);
        $page = ValidationHelper::integer($_GET['page']??null);
        $perpage = ValidationHelper::integer($_GET['perpage']??null);
        $types = DatabaseHelper::getTypes($type, $page, $perpage);
        return new JSONRenderer(['types'=>$types]);
    },
    'api/random/computer'=>function(){
        $randomComputer = DatabaseHelper::getRandomComputer();
        return new JSONRenderer(['randomComputer'=>$randomComputer]);
    },
    'api/parts/performance'=>function(){
        $order = ValidationHelper::string($_GET['order']??null);
        $type = ValidationHelper::string($_GET['type']??null);
        $performance = DatabaseHelper::getPerformance($order, $type);
        return new JSONRenderer(['performance'=>$performance]);
    },
];