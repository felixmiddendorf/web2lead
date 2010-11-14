# Web2Lead README

## Name
Web2Lead - Send leads to to [Salesforce CRM][salesforce]

## Version
0.1

## Project Home
Web2Lead can be found on [github][home].

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
Web to Lead mechanism. Leads are transferred using the [cURL library][cURL],
which therefore needs to be installed.

## Author
Written and maintained by [Felix Middendorf][felixmiddendorf].

## Bug Reports
Please report bugs to the Web2Lead [issue tracker on github][issues].

## Copyright & License
Copyright 2010 Felix Middendorf. All rights reserved. Web2Lead is released
under [GNU Lesser Public License][lgpl] (see COPYING.LESSER). Please respect
copyright and license when using Web2Lead.

## Disclaimer
Neither the author, nor the php Web2Lead library is in any way associated with
Salesforce.

[salesforce]: http://www.salesforce.com
[home]: http://github.com/felixmiddendorf/web2lead/
[cURL]: http://php.net/curl/
[felixmiddendorf]: http://www.felixmiddendorf.eu/
[issues]: http://github.com/felixmiddendorf/web2lead/issues/
[lgpl]: http://www.gnu.org/licenses/lgpl.txt
