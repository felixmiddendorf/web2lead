<?php
/**
 * Lesson 1: Set-Up
 * 
 * This example teaches you how you can set up Web2Lead to send leads to
 * Salesforce CRM.
 */

/**
 * Obviously, you have to import the Web2Lead class.
 */
require '../lib/Web2Lead.php';

/**
 * Replace this with your own Salesforce organization ID.
 * @var string
 */
$your_org_id = '123';

/**
 * Create an instance of Web2Lead that can be used to send leads to Salesforce
 * CRM.
 * @var Web2Lead
 */
$web2lead = new Web2Lead($your_org_id);

/**
 * Now you can start sending leads to Salesforce. But wait, there's more.
 */

/**
 * You can set the source your leads will be associated with. This is optional.
 */
$web2lead->setLeadSource('my_online_shop');

/**
 * You can enable SSL, if you want to. This is experimental at the moment.
 */
$web2lead->setSSL(true);

/**
 * You can use Salesforce CRM's debugging functionality.
 */
$web2lead->setDebug(true);
$web2lead->setDebugEmail('your-mail-account@your-company.com');
