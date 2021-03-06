<?php

class User extends Model
{
    private $id;
    private $pid;
    private $email;
    private $username;
    private $password;
    private $description;
    private $token;
    private $is_active;

    public function __construct(
        string $email       = null,
        string $username    = null,
        string $password    = null,
        string $description = null,
        string $token       = null
    ) {
        $this->email       = $email;
        $this->username    = $username;
        $this->password    = $password;
        $this->description = $description;
        $this->token       = $token;
    }

    public function create()
    {
        if (
            is_null($this->email)       ||
            is_null($this->username)    ||
            is_null($this->password)    ||
            is_null($this->token)
        ) {
            throw new Exception("Error Processing Request", 1);
            die();
        }
        $this->create_object([
            "pid"         => $this->get_pid(),
            "email"       => $this->email,
            "username"    => $this->username,
            "password"    => $this->password,
            "description" => $this->description,
            "token"       => $this->token
        ]);
    }

    public function get(array $field)
    {
        $user_data = $this->get_object($field);

        $this->id          = $user_data[0]['id'];
        $this->pid         = $user_data[0]['pid'];
        $this->email       = $user_data[0]['email'];
        $this->username    = $user_data[0]['username'];
        $this->password    = $user_data[0]['password'];
        $this->description = $user_data[0]['description'];
        $this->token       = $user_data[0]['token'];
        $this->is_active   = $user_data[0]['is_active'];
    }

    public function select(string $field, array $condition = null)
    {
        return $this->get_field($field, $condition);
    }

    public function id()
    {
        return $this->id;
    }

    public function pid()
    {
        return $this->pid;
    }

    public function email()
    {
        return $this->email;
    }

    public function username()
    {
        return $this->username;
    }

    public function description()
    {
        return $this->description;
    }

    public function is_active()
    {
        return $this->is_active;
    }

    public function activate()
    {
        return $this->update_object(
            ['is_active' => true, 'token' => '-'],
            ['pid' => $this->pid]
        );
    }
}
