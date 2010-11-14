<?php
/**
 * Lesson 2: Leads in Arrays
 * 
 * Assuming you have done the steps in lesson 1, this example teaches you how to
 * send lead data that is stored in a php array to Salesforce CRM. 
 */

/**
 * This plain old php array contains the lead data. Let's say you pulled it from
 * your database.
 * @var array
 */
$lead_as_array = array('salutation' => 'Dr.',
                       'first_name' => 'Bobby',
                       'last_name' => 'Brown',
                       'email' => 'bobby@example.com',
                       'country' => 'USA',
                       // How about a custom field?
                       '00N20000002SNxc' => 'http://www.example.com/');
/**
 * Let's send it to Salesforce CRM. It's easy. Result will be true if everything
 * worked out fine, else it will be false.
 * @var bool
 */
$result = $web2lead->toSalesforce($lead_as_array);

if($result){
	echo 'Okay.';
}else{
	echo 'Whoops, something went wrong.';
}
