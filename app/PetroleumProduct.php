<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetroleumProduct extends Model
{
    protected $table = 'petroleumproducts';
    protected $fillable = ['petroleumproductid', 'name', 'description', 'price', 'logo'];
    public function __construct($petroleumproductid = null, $name = null, $description = null, $price = null,$logo = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->petroleumproductid=$petroleumproductid;
        $this->name=$name;
        $this->description=$description;
        $this->price=$price;
        $this->logo=$logo;
    }
}
