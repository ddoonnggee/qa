<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Round extends Model {
    protected $table = 'round';
    protected $fillable = ['home_member_id', 'away_member_id', 'win_member_id', 'score'];

    public $datatable_fields = [
        'id'             => ['orderable' => true,  'searchable' => false],
        'home_member_id' => ['orderable' => false, 'searchable' => false],
        'away_member_id' => ['orderable' => false, 'searchable' => false],
        'win_member_id'  => ['orderable' => false, 'searchable' => false],
        'score'          => ['orderable' => true,  'searchable' => true],
        'created_at'     => ['orderable' => true,  'searchable' => false]
    ];

    public function memberHome()
    {
        return $this->belongsTo(Member::class, 'home_member_id');
    }

    public function memberAway()
    {
        return $this->belongsTo(Member::class, 'away_member_id');
    }

    public function memberWin()
    {
        return $this->belongsTo(Member::class, 'win_member_id');
    }

    public function record()
    {
        return $this->hasMany(Record::class);
    }
}