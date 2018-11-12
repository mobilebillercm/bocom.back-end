<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMthodeType extends Model
{
    protected $table='paymentmethodetypes';
    protected $fillable = ['paymentmethodetypeid', 'name', 'description', 'logo'];
    public function __construct($paymentmethodetypeid = null, $name = null, $description = null, $logo = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->paymentmethodetypeid=$paymentmethodetypeid;
        $this->name=$name;
        $this->description=$description;
        $this->logo=$logo;
    }
}
