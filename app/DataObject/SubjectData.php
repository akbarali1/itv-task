<?php
declare(strict_types=1);

namespace App\DataObject;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class SubjectData extends DataObjectBase
{
    public readonly ?int $id;
    public readonly int  $user_id;
    public string        $title;
    public ?string       $description;
    public Carbon        $created_at;

    /** @var array<TopicData> */
    public array|TopicData $topics = [];

}
