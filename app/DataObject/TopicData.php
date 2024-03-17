<?php
declare(strict_types=1);

namespace App\DataObject;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class TopicData extends DataObjectBase
{
    public readonly ?int $id;
    public readonly int  $user_id;
    public readonly int  $subject_id;
    public ?string       $title;
    public ?string       $content;
    public Carbon        $created_at;

}
