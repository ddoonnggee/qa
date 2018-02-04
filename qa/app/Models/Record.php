<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {
    protected $table = 'record';
    protected $fillable = ['round_id', 'question', 'home_answer', 'away_answer', 'home_score', 'away_score'];

    public $datatable_fields = [
        'round_id'    => ['orderable' => false, 'searchable' => false],
        'question'    => ['orderable' => false, 'searchable' => false],
        'home_answer' => ['orderable' => false, 'searchable' => false],
        'away_answer' => ['orderable' => false, 'searchable' => false],
        'home_score'  => ['orderable' => false, 'searchable' => false],
        'away_score'  => ['orderable' => false, 'searchable' => false],
        'created_at'  => ['orderable' => true,  'searchable' => false]
    ];

    public function round()
    {
        return $this->belongsTo(Round::class, 'round_id', 'id');
    }
}