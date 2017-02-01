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
		$messageText = $this->buildEmailLayout();
		// $toList      = array('contatofoundtruck@gmail.com');
		$toList      = array('baldilp@gmail.com');
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
			<title></title>
			<img id="logo" src="http://i.imgur.com/xmF7E8Z.png"></head>

			<style>
				img {
					/*margin-left: 25%;*/
					width: 50%;
				}
				#fundo {
					background-color: #404040;
					/*margin-left: 25%;*/
					width: 50%;
					text-align: center;
					font-family: Helvetica;
					padding: 40px;
					color: white;
				}
				a {
					background-color: #FFA500; /* Orange */
				    border: none;
				    border-radius: 5px;
				    color: white;
				    padding: 15px 32px;
				    text-align: center;
				    text-decoration: none;
				    display: inline-block;
				    font-size: 16px;
				    font-family: Helvetica;
				    /*margin-left: 42%;*/
				    margin-top: 3%;
				}
			</style>
		<body>
			<div style="text-align: center">
				<table id="fundo">
					<tr>
						<th>
							Bem-Vindo!
							<br>
							<br>
							<br></th>
					</tr>
					<tr>
						<td>
							Agradecemos pelo desejo de fazer parte da FoundTruck!
							<br>
							<br></td>
					</tr>
					<td>Em breve entraremos em contato. :)</td>
				</table>
				<a href="http://foundtruck.com.br/blog">Conheça nosso Blog!</a>
			</div>
		</body>
		</html>';
	}
}	