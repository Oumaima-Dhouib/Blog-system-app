<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Comment extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'content',
        'userId',
        'postId'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'postId');
    }
}