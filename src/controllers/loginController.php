<?php

loadModel('Login');
$exception = null;

if(count($_POST) > 0){
    $login = new Login($_POST);

    try{
        $user = $login->checkLogin();
        echo "Usuario " . $user->name;
    }catch(ValidationException $e){
        $exception = $e;
    }catch(AppException $e){
        $exception = $e;
    }
}

loadView('login',['exception' => $exception]);

