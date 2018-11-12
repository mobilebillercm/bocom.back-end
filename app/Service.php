<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = ['serviceid', 'name', 'description', 'price', 'logo'];
    public function __construct($serviceid = null, $name = null, $description = null, $price = null,$logo = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->serviceid=$serviceid;
        $this->name=$name;
        $this->description=$description;
        $this->price=$price;
        $this->logo=$logo;
    }
}
