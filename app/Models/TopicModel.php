<?php
declare(strict_types=1);

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int                    $id
 * @property string                 $title
 * @property string                 $content
 * @property int                    $user_id
 * @property int                    $subject_id
 * @property Carbon                 $created_at
 *
 * @property User|BelongsTo         $user
 * @property SubjectModel|BelongsTo $subject
 */
class TopicModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'topics';

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'subject_id',
    ];

    #region Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }
    #endregion
}
