<?php

class User extends Model{
    protected static $tableName = 'users';
    protected static $columns = [
        'id',
        'name',
        'password',
        'email',
        'start_date',
        'end_date',
        'is_admin'
    ];

    public function insert(){
        $this->validate();
        $this->is_admin =  $this->is_admin ? 1 : 0;
        if(!$this->end_date) $this->end_date = null;

        return parent::insert();
    }

    public function validate(){
        $errors = [];

        if(!$this->name){
             $errors['name'] = "Nome é um campo obrigatório.";
        }
             
        if(!$this->email){
             $errors['email'] = "email é um campo obrigatório.";
        }
             
        if(!empty($errors)){
            throw new ValidationException($errors);
        }
    }
}