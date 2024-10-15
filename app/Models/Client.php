<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    public const TABLE = 'clients';

    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';

    protected $fillable = [
		self::FIRST_NAME,
		self::LAST_NAME,
	];

    /**
     * Relations
     */

    public const RELATION_BOOKS = 'books';

    public function books() {
        return $this->hasMany(Book::class);
    }
}