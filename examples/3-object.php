<?php
/**
 * Lesson 3: Send your Objects to Salesforce CRM
 * 
 * This example teaches you how you can send objects of your very own classes
 * to Salesforce CRM if they implement the SalesforceLead interface.
 */

require '../lib/SalesforceLead.php';

/**
 * Let's say this is your Customer class. It should implement the SalesforceLead
 * interface that can be found in /lib/SalesforceLead.php
 */
class Customer implements SalesforceLead{
	private $firstname;
	private $lastname;
	private $url;
	
	/**
	 * This is just an example.
	 * @param string $firstname
	 * @param string $lastname
	 * @param string $url
	 */
	public function __construct($firstname, $lastname, $url){
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->url = $url;
	}
	
	/**
	 * Your class has to implement this method. It has to return an array using
	 * the Salesforce fields as keys. Custom fields can also be used.
	 */
	public function exportLead(){
		return array(
			'first_name' => $this->firstname,
			'last_name' => $this->lastname,
			'00N20000002SNxc' => $this->url
		);
	}
}

/**
 * Here is an object of type Customer. Let's assume, you pulled it from your
 * application's database.
 * @var Customer
 */
$lead_object = new Customer('Alice', 'Wonderland', 'http://www.example.com/');
/**
 * You can easily send it to Salesforce CRM. Web2Lead will extract the lead data
 * using the object's exportLead() method for you.
 */
$web2lead->toSalesforce($lead_object);
