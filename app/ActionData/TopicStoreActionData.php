<?php
declare(strict_types=1);

namespace App\ActionData;

use Akbarali\ActionData\ActionDataBase;

class TopicStoreActionData extends ActionDataBase
{

    public ?int    $id;
    public int     $user_id;
    public int     $subject_id;
    public string  $title;
    public ?string $content;

    protected array $rules = [
        "title"      => "required|max:255",
        "content"    => "nullable",
        "user_id"    => "required|int|exists:users,id",
        "subject_id" => "required|int|exists:subjects,id",
    ];

}
