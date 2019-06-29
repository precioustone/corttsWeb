<?php

require_once('../database/functions.php');

$request = $_SERVER['REDIRECT_URL'];


if(preg_match('(/corttsWeb/api/login)', $request)){
    if( $_POST){
        return json_encode(login($_POST['email'],$_POST['password']));
    }else{
        return json_encode(array('staus' => '',));
    }
}else if(preg_match('(/corttsWeb/api/register)', $request)){
    if( $_POST){
        return json_encode(register($_POST['name'],$_POST['email'],$_POST['password'],$_POST['phone']));
    }else{
        return json_encode(array('staus' => '',));
    }
}else if(preg_match('(/corttsWeb/api/properties)', $request)){
    
        return json_encode(getProps());
}else if(preg_match('(/corttsWeb/api/add-property)', $request)){
    if( $_POST){
        return json_encode(addProp($_POST));
    }else{
        return json_encode(array('staus' => '',));
    }
}else if(preg_match('(/corttsWeb/api/edit-property)', $request)){
    if( $_POST){
        return json_encode(del($_POST['id']));
    }else{
        return json_encode(array('staus' => '',));
    }
}else if(preg_match('(/corttsWeb/api/del-property)', $request)){
    if( $_POST){
        return json_encode(editProp($_POST['id'], 'properties'));
    }else{
        return json_encode(array('staus' => '',));
    }
}else{
    return json_encode(array('staus' => '',));
}

/*switch ($request) {
    case preg_match('(/mavinmp3/singles/[A-Za-z0-9])', $request):
        require __DIR__ . '/views/singles.php';
        break;
    case '/mavinmp3/singles' :
        require __DIR__ . '/views/singles.php';
        break;
    case '/mavinmp3/albums' :
        require __DIR__ . '/views/album.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}*/
?>