<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name','due_date','is_completed'];

    public function toggleCompleted()
    {
        $this->is_completed = !$this->is_completed;
        return $this;
    }
}
