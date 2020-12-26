<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $consist
 * @property float $cost
 * @property float $real_cost
 * 
 * @property Collection|Purchase[] $purchases
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	public $timestamps = false;

	protected $casts = [
		'cost' => 'float',
		'real_cost' => 'float'
	];

	protected $fillable = [
		'name',
		'description',
		'consist',
		'cost',
		'real_cost'
	];

	public function purchases()
	{
		return $this->hasMany(Purchase::class);
	}
}
