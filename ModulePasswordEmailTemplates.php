<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2012
 * @author     Kamil Kuzminski <kamil.kuzminski@gmail.com>
 * @package    RegistrationMailtemplates
 * @license    LGPL
 * @filesource
 */


class ModulePasswordEmailTemplates extends ModulePassword
{

	/**
	 * Send a lost password e-mail
	 * @param Database_Result
	 */
	protected function sendPasswordLink(Database_Result $objMember)
	{
		if (!$this->mail_template)
		{
			return;
		}

		$confirmationId = md5(uniqid(mt_rand(), true));

		// Store confirmation ID
		$this->Database->prepare("UPDATE tl_member SET activation=? WHERE id=?")
					   ->execute($confirmationId, $objMember->id);

		$arrTokens = $objMember->row();
		$arrTokens['domain'] = $this->Environment->host;
		$arrTokens['link'] = $this->Environment->base . $this->Environment->request . (($GLOBALS['TL_CONFIG']['disableAlias'] || strpos($this->Environment->request, '?') !== false) ? '&' : '?') . 'token=' . $confirmationId;

		// Initialize and send e-mail
		try
		{
			$objEmail = new EmailTemplate($this->mail_template);
			$objEmail->send($objMember->email, $arrTokens);
		}
		catch (Exception $e)
		{
			$this->log('Could not send password link for member ID ' . $objMember->id . ': ' . $e->getMessage(), 'ModulePasswordEmailTemplates sendPasswordLink()', TL_ERROR);
			$this->reload();
		}

		$this->log('A new password has been requested for user ID ' . $objMember->id . ' (' . $objMember->email . ')', 'ModulePasswordEmailTemplates sendPasswordLink()', TL_ACCESS);
		$this->jumpToOrReload($this->jumpTo);
	}
}

?>