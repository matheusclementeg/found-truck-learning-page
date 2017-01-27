<?php

namespace App\Http\Services;
use MongoDB\BSON\ObjectId; 

class Partner {

	public function __construct(){

	}
  
    public function create(){
        $partner = new \App\Models\Partner;
        // --- Partner setters
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
