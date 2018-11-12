<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethode extends Model
{
    protected $table = 'paymentmethods';
    protected $fillable = ['paymentmethodid', 'name', 'description', 'issuer', 'logo', 'type', 'typename', 'typedescription'];
    public function __construct($paymentmethodid = null, $name = null, $description = null, $issuer = null,$logo = null,
                                $type = null, $typename = null, $typedescription = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->paymentmethodid=$paymentmethodid;
        $this->name=$name;
        $this->description=$description;
        $this->issuer=$issuer;
        $this->logo=$logo;
        $this->type = $type;
        $this->typename = $typename;
        $this->typedescription = $typedescription;
    }
}
