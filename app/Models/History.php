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

    public function addNewHistory($ip)
    {
        $history = new $this;

        $history->ip = $ip;

        $saved = $history->save();

        return $saved;
    }

    public function updateHistory($ip)
    {
        $history = $this->where('ip', $ip)->first();

        $history->count += 1;

        $history->last_time = now();

        $saved = $history->save();

        return $saved;
    }

    public function isIPExists($ip)
    {
        $history = $this->where('ip', $ip)->first();

        return $history;
    }
}