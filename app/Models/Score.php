<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string|null $post_id
 * @property string|null $class
 * @property mixed|null $date
 * @property string|null $school
 * @property string|null $model_name
 * @property string|null $source
 */
class Score extends Model
{
    protected $table = 'score_table';


    //for each img in imgs_red
    //  img.setOpacity(*полученный с запроса процент*)

    //for each img in imgs_yellow
    //  img.setOpacity(1 - *полученный с запроса процент*)
}
