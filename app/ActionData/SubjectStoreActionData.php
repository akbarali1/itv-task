<?php
declare(strict_types=1);

namespace App\ActionData;

use Akbarali\ActionData\ActionDataBase;

class SubjectStoreActionData extends ActionDataBase
{

    public ?int    $id;
    public int     $user_id;
    public string  $title;
    public ?string $description;

    protected array $rules = [
        "title"       => "required|max:255",
        "description" => "nullable",
        "user_id"     => "required|int|exists:users,id",
    ];

}
