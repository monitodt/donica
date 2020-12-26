<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * 
 * @property int $id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $home_address
 * @property string|null $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Purchase[] $purchases
 *
 * @package App\Models
 */
class Contact extends Model
{
	protected $table = 'contacts';

	protected $fillable = [
		'first_name',
		'middle_name',
		'last_name',
		'phone_number',
		'home_address',
		'comment'
	];

	public function purchases()
	{
		return $this->hasMany(Purchase::class, 'customer_id');
	}
}
