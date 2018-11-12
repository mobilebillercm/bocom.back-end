<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 'stations';
    protected $fillable = ['stationid', 'name', 'description', 'region', 'division', 'subdivision', 'quarter', 'latitude', 'longitude',
        'bp', 'petroleumproducts', 'services', 'lubrifiants', 'paymentmethods', 'images', 'contacts'];
    public function __construct($stationid = null, $name = null, $description = null, $region = null,$division = null,
                                $subdivision = null, $quarter=null, $latitude = null, $longitude = null, $bp = null,
                                $petroleumproducts = null, $services = null, $lubrifiants = null, $paymentmethods = null,
                                $images = null, $contacts = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->stationid=$stationid;
        $this->name=$name;
        $this->description=$description;
        $this->region=$region;
        $this->division=$division;
        $this->subdivision = $subdivision;
        $this->quarter = $quarter;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->bp = $bp;
        $this->petroleumproducts = $petroleumproducts;
        $this->services = $services;
        $this->lubrifiants = $lubrifiants;
        $this->paymentmethods = $paymentmethods;
        $this->images = $images;
        $this->contacts = $contacts;
    }

    public function addPetroleumProduct($ppid){
        $products = json_decode($this->petroleumproducts);
        array_push($products, $ppid);
        $this->petroleumproducts = json_encode($products);
        $this->save();
    }

    public function addService($serviceid){
        $services = json_decode($this->services);
        array_push($services, $serviceid);
        $this->services = json_encode($services);
        $this->save();
    }

    public function addLubrifiant($lbid){
        $lubrifiants = json_decode($this->lubrifiants);
        array_push($lubrifiants, $lbid);
        $this->lubrifiants = json_encode($lubrifiants);
        $this->save();
    }

    public function addPaymentmethod($pmid){
        $paymentMethods = json_decode($this->paymentmethods);
        array_push($paymentMethods, $pmid);
        $this->paymentmethods = json_encode($paymentMethods);
        $this->save();
    }

    public function addImages($image){
        $images = json_decode($this->images);
        array_push($images, $image);
        $this->images = json_encode($images);
        $this->save();
    }

    public function addContact($contact){
        $contacts = json_decode($this->contacts);
        array_push($contacts, $contact);
        $this->contacts = json_encode($contacts);
        $this->save();
    }
}
