<?php

session_start();
requireValidSession();

$exception = null;

if(!empty($_POST)){
    try{
        $newUser = new User($_POST);
        $newUser->insert();
        addSuccessMsg('Usuário cadastrado com sucesso!');
        $_POST = [];
    } catch(Exception $e){
        $exception = $e;
    }
}
loadTemplateView('save_user', $_POST + ['exception' => $exception]);