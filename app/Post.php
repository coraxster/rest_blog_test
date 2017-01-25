<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use SoftDeletes;

    protected $table = 'Items';
    protected $fillable = ['is_development_mode', 'class', 'order_id', 'props_json'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
