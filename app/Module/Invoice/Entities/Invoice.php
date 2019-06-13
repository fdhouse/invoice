<?php

namespace App\Module\Invoice\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Invoice.
 *
 * @package namespace App\Entities;
 */
class Invoice extends Model
{
    use SoftDeletes;

    protected $table = "invoice";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
