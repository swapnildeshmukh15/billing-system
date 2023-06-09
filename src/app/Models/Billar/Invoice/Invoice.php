<?php

namespace App\Models\Billar\Invoice;

use App\Casts\Packages;
use App\Models\Billar\Recurring\RecurringCycle;
use App\Models\Core\BaseModel;
// use App\Models\Core\Status;
use App\Models\Core\Traits\BootTrait;
use App\Models\Core\Traits\CreatedByRelationship;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends BaseModel
{
    use BootTrait, HasFactory, SoftDeletes, CreatedByRelationship;



    protected $fillable = [
        'currency_id',
        'invoice_number',
        'recurring',
        'date',
        "packaging_type",
        'recurring_cycle_id',
        'sub_total',
        'discount_type',
        'discount',
        'total',
        'received_amount',
        'due_amount',
        'notes',
        'terms',
        'created_by',
        'discount_amount',
        'is_from_estimate',
        'from_address' ,
        'to_address' ,
        'reminder',
        'lift_from_address',
        'lift_to_address',
        'floor_from_address',
        'floor_to_address',
        'client_name',
        'client_email',
        'client_number',

        'is_hide_charges',
        'packing',
        'unloading' ,
        'local' ,
        'gst',
        'transport',
        'unpacking',
        'car_transport',
        'loading',
        'ac',
        'insuarance'
    ];
    
    protected $casts = [
        'due_amount' => 'double',
        'lift_from_address' => 'boolean',
        'lift_to_address' => 'boolean'
    ];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = (new Carbon($value))->format('Y-m-d H:i:s');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = (new Carbon($value))->format('y-m-d');
    }



    public function getFloorToAddressAttribute($value): string
    {
        return $value ?? 'N/A';
    }

    public function getFloorFromAddressAttribute($value): string
    {
        return $value ?? 'N/A';
    }

    // public function status(): BelongsTo
    // {
    //     return $this->belongsTo(Status::class);
    // }

    public function recurringCycle(): BelongsTo
    {
        return $this->belongsTo(RecurringCycle::class, 'recurring_cycle_id', 'id');
    }

    // public function client(): BelongsTo
    // {
    //     return $this->belongsTo(config('biller.client'));
    // }

    public function invoiceDetails(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function invoiceRecurrings(): HasMany
    {
        return $this->hasMany(InvoiceRecurring::class, 'referance_invoice_id', 'id');
    }
}
