<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = ['vessel_id', 'start', 'end', 'revenues','expenses', 'profit'];

    //Table Name
    protected $table = 'voyages';

    //Table's Field
    public $vessel_id ;

    public $start;
    public $end;
    public $code;
    protected $status = 'pending'; // By default
    public $revenues;
    public $expenses;
    public $profit;
    //Timestamps
    public $timestamps = true;



    public function asArray(): array
    {

        return [
            'vessel_id' => $this->vessel_id,
            'code' => $this->code,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
            'revenues' => $this->revenues,
            'expenses' => $this->expenses,
            'profit' => $this->profit
        ];
    }
}
