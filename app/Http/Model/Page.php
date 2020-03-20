<?php
  
namespace App\Http\Model;
   
use Illuminate\Database\Eloquent\Model;
   
class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'pages';
    protected $fillable = [
        'title', 'page_type'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function test()
    {
        return 'test';
    }
}