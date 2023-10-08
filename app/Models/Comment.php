<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string|null $user_id
 * @property string|null $text
 * @property mixed|null $date
 * @property string|null $post_id
 * @property string|null $school
 * @property string|null $ru_school
 * @property string|null $source
 */
class Comment extends Model
{
    protected $table = 'comments';
}
