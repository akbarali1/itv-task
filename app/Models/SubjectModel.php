<?php
declare(strict_types=1);

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                  $id
 * @property string               $title
 * @property string               $description
 * @property int                  $user_id
 * @property Carbon               $created_at
 *
 * @property User                 $user
 * @property TopicModel[]|HasMany $topics
 *
 */
class SubjectModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'subjects';

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    #region Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topics(): HasMany
    {
        return $this->hasMany(TopicModel::class, 'subject_id', 'id');
    }
    #endregion
}
