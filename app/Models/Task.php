<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;

  // Task Status
  public const DOING = 1;
  public const TODO = 2;
  public const DONE = 3;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = 'tasks';
  protected $primaryKey = 'id';
  protected $fillable = [
    'title',
    'description',
    'status',
    'user_id'
  ];
  public $timestamps = true;


  public function assignedUser()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public static function sortByStatus()
  {
    return self::get()->sortBy('title')->sortBy('status');
  }
}
