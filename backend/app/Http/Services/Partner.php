<?php

namespace App\Http\Services;
use MongoDB\BSON\ObjectId; 

class Partner {

	public function __construct(){

	}
  
    public function create($owner,$company,$email,$city,$state){
        $partner = new \App\Models\Partner;
        // --- Partner setters
        $partner->owner = $owner;
        $partner->company = $company;
        $partner->email = $email;
        $partner->city = $city;
        $partner->state = $state;
        $partner->save();
    }

    public function getAll(){
    	return \App\Models\Partner::all();
    } 

    public function delete($partnerId){
        $partner = \App\Models\Partner::find($partner);
        $partner->delete();
    }  

    public function edit($partnerId){
        $partner = \App\Models\Partner::find($partnerId);
        if(!empty($partner)){
            
        }
        $partner->save();
    }
}
