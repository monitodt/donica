<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 *
 * @property int $id
 * @property int $customer_id
 * @property int $product_id
 * @property int $product_count
 * @property bool $is_billed
 * @property bool $is_sent
 * @property bool $finished
 * @property float $summary_cost
 * @property float $marginality
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Contact $contact
 * @property Product $product
 *
 * @package App\Models
 */
class Purchase extends Model
{
    protected $table = 'purchases';
    protected $attributes = [
        'is_billed' => false,
        'is_sent' => false,
        'finished' => false
    ];
    protected $casts = [
        'customer_id' => 'int',
        'product_id' => 'int',
        'product_count' => 'int',
        'is_billed' => 'bool',
        'is_sent' => 'bool',
        'finished' => 'bool',
        'summary_cost' => 'float',
        'marginality' => 'float'
    ];

    protected $fillable = [
        'customer_id',
        'product_id',
        'product_count',
        'is_billed',
        'is_sent',
        'finished',
        'summary_cost',
        'marginality'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
