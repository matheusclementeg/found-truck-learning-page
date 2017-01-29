<?php

namespace App\Http\Services;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Message;

class Mail {

	protected $transport;
	
	public function __construct(){
		$this->transport = new SmtpTransport();
		$options         = new SmtpOptions([
			'name'		 => 'smtp.gmail.com',
			'host'		 => 'smtp.gmail.com',
			'port'		 => '465',
			'connection_class'  => 'login', 
			'connection_config' => [	
				'username' => 'contatofoundtruck@gmail.com',
				'password' => '1foundtruck16',
				'ssl'	   => 'ssl'
			],
		]);	
		$this->transport->setOptions($options);
	}

	public function partnerRegister($partnerMail, $partnerCompany){
		// --- Send a message to found truck accounts 
		$messageText = 'The user of '.$partnerCompany.' wants to be a foundtruck partner. His mail address is '.$partnerMail;
		$toList      = array('contatofoundtruck@gmail.com');
		$from 		 = 'contatofoundtruck@gmail.com';
		$subject  	 = 'New Partner';
		$this->send($messageText, $toList, $from, $subject);

		// --- Send a message to the new partner 

		$messageText = 'Agradecemos pelo desejo de fazer parte da FoundTruck!! Em breve entraremos em contato.';
		$toList      = array($partnerMail);
		$from 		 = 'contatofoundtruck@gmail.com';
		$subject  	 = 'Parceiro FoundTruck';
		$this->send($messageText, $toList, $from, $subject);

	}

	public function send($messageText, $toList, $from, $subject){
		foreach($toList as $to){	
			$message = new Message();
			$message->addTo($to);
			$message->addFrom($from);
			$message->setSubject($subject);
			$message->setBody($messageText);
			$this->transport->send($message);
		}	
	}


}	