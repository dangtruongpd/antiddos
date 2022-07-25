<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ip',
        'count',
        'last_time',
    ];

    public $timestamps = false;

    public function findByIP($ip){
        $history = $this::where('ip', $ip)->get()->first();

        return $history;
    }

    public function addNewHistory($ip)
    {
        $history = new $this;

        $history->ip = $ip;

        $saved = $history->save();

        return $saved;
    }

    public function updateHistory()
    {
        if($this->count>=1)
            $this->last_time = now();
            
        $this->count += 1;

        $saved = $this->save();

        return $saved;
    }

    public function resetHistory()
    {
        $this->count = 1;

        $this->first_time = now();

        $this->last_time = null;

        $saved = $this->save();

        return $saved;
    }

    public function updateCount($ip)
    {
        $history = $this->where('ip', $ip)->get()->first();

        if($history->count == 5){
            $history->count = 0;
            $history->first_time = now();
            $history->last_time = null;
            $history->save();
        }
    }
}