<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lubrifiant extends Model
{
    protected $table = 'lubrifiants';
    protected $fillable = ['lubrifiantid', 'name', 'description', 'price', 'logo'];
    public function __construct($lubrifiantid = null, $name = null, $description = null, $price = null,$logo = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->lubrifiantid=$lubrifiantid;
        $this->name=$name;
        $this->description=$description;
        $this->price=$price;
        $this->logo=$logo;
    }
}
