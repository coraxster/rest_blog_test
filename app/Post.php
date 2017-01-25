<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;

    protected $table = 'Items';
    protected $primaryKey = 'item_id';
    protected $fillable = ['is_development_mode', 'post_type', 'class', 'order_id', 'props_json', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setPostTypeAttribute($post_type){
    	if ($post_type == 'post'){
			$this->attributes['is_development_mode'] = 1;
		}elseif($post_type == 'draft'){
			$this->attributes['is_development_mode'] = 0;
		}
    }
    public function getPostTypeAttribute(){
    	if ($this->is_development_mode = 1){
    		return 'post';
    	}elseif($this->is_development_mode = 0){
    		return 'draft';
    	}
    }

    public function scopePostType($scope, $post_type){
    	if ($post_type == 'post'){
			$scope->where('is_development_mode', 1);
		}elseif($post_type == 'draft'){
			$scope->where('is_development_mode', 0);
		}
    	return $scope;
    }

}
