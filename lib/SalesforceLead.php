<?php
/**
 * Web2Lead - A php library for sending leads to Salesforce CRM
 *
 * This library is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.
 * If not, see <{@link http://www.gnu.org/licenses/lgpl-3.0.txt}>.
 *
 * @author Felix Middendorf
 * @copyright 2010 Felix Middendorf
 * @link http://www.felixmiddendorf.eu/
 * @package Web2Lead
 * @version 0.1
 * @license http://www.gnu.org/licenses/lgpl-3.0.txt GNU Lesser General Public License 3.0
 */

/**
 * Instances of classes that implement this interface can be send directly to
 * Salesforce CRM using the Web2Lead class.
 */
interface SalesforceLead{
	/**
	 * Returns the attributes of this object as an array using the names of
	 * the Salesforce fields as keys.
	 * 
	 * Example:
	 * <code>
	 * return array('first_name' => $this->firstname,
	 *              'last_name' => $this->lastname);
	 * </code>
	 * @return array
	 */
	public function exportLead();
}
