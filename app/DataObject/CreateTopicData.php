<?php
declare(strict_types=1);

namespace App\DataObject;

use Akbarali\DataObject\DataObjectBase;
use Carbon\Carbon;

class CreateTopicData extends DataObjectBase
{
    public readonly int $user_id;
    public readonly int $subject_id;
}
