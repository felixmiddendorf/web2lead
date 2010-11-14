# Web2Lead README

## Name
Web2Lead - Send leads to to Salesforce CRM

## Version
0.1

## Project Home
Web2Lead can be found on github: http://github.com/felixmiddendorf/web2lead/

## Synopsis
    <?php
    $web2lead = new Web2Lead($your_org_id);
    $web2lead->toSalesforce(array('first_name' => 'Alice',
                                  'last_name' => 'Bob'));
    // Refer to the lessons in /examples/ for more information on how to set up
    // and use Web2Lead.
    ?>

## Description
Web2Lead allows you to programmatically send leads to Salesforce CRM using the
Web to Lead mechanism. Leads are transferred using the cURL library, which
therefore needs to be installed (see http://php.net/curl/).

## Author
Written and maintained by Felix Middendorf, http://www.felixmiddendorf.eu/

## Bug Reports
http://github.com/felixmiddendorf/web2lead/issues/

## Copyright & License
Copyright 2010 Felix Middendorf. All rights reserved. Web2Lead is released
under GNU Lesser Public License (see COPYING.LESSER). Please respect copyright
and license when using Web2Lead.

## Disclaimer
Neither the author, nor the php Web2Lead library is in any way associated with
Salesforce.