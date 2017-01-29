<?php

namespace App\Http\Services;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Message;
use Zend\Mime\Mime as Mime;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Message as MimeMessage;

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
		$messageText = 'A empresa ' . $partnerCompany . ' deseja saber mais sobre o projeto. Email: ' . $partnerMail;
		$toList      = array('contatofoundtruck@gmail.com');
		$from 		 = 'contatofoundtruck@gmail.com';
		$subject  	 = 'Novo Parceiro';
		$this->send($messageText, $toList, $from, $subject);

		// --- Send a message to the new partner 
		$messageText = $this->buildEmailLayout();
		$toList      = array($partnerMail);
		$from 		 = 'contatofoundtruck@gmail.com';
		$subject  	 = 'Parceiro FoundTruck';
		// $this->send($messageText, $toList, $from, $subject);
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

	private function buildEmailLayout() {
		$message = $this->generateEmail();

    	$html = new MimePart($message);
        $html->type = "text/html; charset=UTF-8";
        $body = new MimeMessage();

        // E-mail config.
    	$body->setParts(array($html));

    	return $body;
	}

	private function generateEmail() {
		return '
		<!DOCTYPE html>
		<html>
		<head>
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
			<style>
				* {
					font-family: "Source Sans Pro";
				}
				.container {
					width: 100%;
					text-align: center;
				}
			</style>
		</head>
		<body>
			<div class="container">
				<div class="header">
					<img src="http://i.imgur.com/uKjRhLs.png">
				</div>
				<div class="content">
					<div class="main-message">
						<h2>Agradecemos pelo desejo de fazer parte da FoundTruck!</h2>
						<h5>Em breve entraremos em contato :)</h5>
					</div>
				</div>
				<footer>
					Foundtruck - 2017
				</footer>
			</div>
		</body>
		</html>';
	}
}	