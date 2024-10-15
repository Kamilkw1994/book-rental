<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    public const TABLE = 'books';

    public const ID = 'id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const TITLE = 'title';
    public const AUTHOR = 'author';
    public const YEAR = 'year';
    public const PUBLISHER = 'publisher';
    public const IS_RENTED = 'is_rented';
    public const CLIENT_ID = 'client_id';

    protected $fillable = [
		self::TITLE,
		self::AUTHOR,
        self::YEAR,
        self::PUBLISHER,
	];

    public const RELATION_CLIENT = 'client';

    public function client() {
        return $this->belongsTo(Client::class);
    }
    
}
