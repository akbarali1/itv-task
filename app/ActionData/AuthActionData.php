<?php
declare(strict_types=1);

namespace App\ActionData;

use Akbarali\ActionData\ActionDataBase;

class AuthActionData extends ActionDataBase
{

    public string $email;
    public string $password;
    public bool   $remember = false;

    protected array $rules = [
        'email'    => 'required|email',
        'password' => 'required',
        'remember' => 'boolean',
    ];

}
