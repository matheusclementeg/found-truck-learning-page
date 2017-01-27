<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Services\Partner as PartnerService;

class Partner extends Controller {	
	
    protected $partnerService;

	public function __construct(PartnerService $partnerService){
		$this->partnerService = $partnerService;
	}
    
    public function create(Request $request){
        $responseContent = array();

    	try{
            $partner   = $request->all();
            if(!empty($partner)){
                // --- Data treatment
                $owner = $partner['owner'];
                $company  = $partner['company'];
                $email    = $partner['email'];
                $city     = $partner['city'];
                $state    = $partner['state'];

		        $this->partnerService->create($owner,$company,$email,$city,$state);
                $responseContent['error']   = false;
    	        $responseContent['message'] = 'partner has been saved';
        	} else{
    			$responseContent['error']   = true;
    			$responseContent['message'] = 'Any data sent';
    		}
    	}catch(\Exception $e){
    		$responseContent['error']   = true;
    		$responseContent['message'] = $e->getMessage();
    	}

    	$response = new Response($responseContent);
    	return $response;
    }

    public function getAll(Request $request){
    	$responseContent = array();
        try {
    		$partners = $this->partnerService->getAll();
            $responseContent['error']   = false;
            $responseContent['message'] = 'OK';
            $responseContent['data']    = $partners;
        } catch(\Exception $e) {
            $responseContent['error']   = true;
            $responseContent['message'] = $e->getMessage();
            $responseContent['data']    = array();
        }
        $response = new Response($responseContent);
        return $response;
    }

    public function delete(Request $request){
        $responseContent = array();
        try {
            $partner = $request->all();
            if(!empty($partner)){
                $partnerId    = $partner['_id'];
                $this->partnerService->delete($partnerId);
                $responseContent['error']   = false;
                $responseContent['message'] = 'partner has been removed.';
            }else{
                $responseContent['error']   = true;
                $responseContent['message'] = 'Any data sent.';
            }
        } catch(\Exception $e) {
            $responseContent['error']   = true;
            $responseContent['message'] = $e->getMessage();
        }
        $response = new Response($responseContent);
        return $response;
    }

    public function edit(Request $request){
        $responseContent = array();
        try {
            $partner = $request->all();
            if(!empty($partner)){
                //--- data treatment
                $this->partnerService->edit();
                $responseContent['error']   = false;
                $responseContent['message'] = 'partner has been edited.';
            }else{
                $responseContent['error']   = true;
                $responseContent['message'] = 'Any data sent.';
            }
        } catch(\Exception $e) {
            $responseContent['error']   = true;
            $responseContent['message'] = $e->getMessage();
        }
        $response = new Response($responseContent);
        return $response;
    }
}
