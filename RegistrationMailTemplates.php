<?php

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
 * @copyright  terminal42 gmbh 2013
 * @author     Kamil Kuzminski <kamil.kuzminski@gmail.com>
 * @author     Andreas Schempp <andreas.schempp@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


class RegistrationMailTemplates extends System
{

	/**
	 * Send a registration e-mail
	 * @param integer
	 * @param array
	 * @param object
	 */
	public function sendRegistrationEmail($intId, $arrData, &$objModule)
	{
		if (!$objModule->mail_template)
		{
			return;
		}

		$arrData['domain'] = $this->Environment->host;
		$arrData['link'] = $this->Environment->base . $this->Environment->request . (($GLOBALS['TL_CONFIG']['disableAlias'] || strpos($this->Environment->request, '?') !== false) ? '&' : '?') . 'token=' . $arrData['activation'];

		// Support newsletters
		if (in_array('newsletter', $this->Config->getActiveModules()))
		{
			if (!is_array($arrData['newsletter']))
			{
				if ($arrData['newsletter'] != '')
				{
					$objChannels = $this->Database->execute("SELECT title FROM tl_newsletter_channel WHERE id IN(". implode(',', array_map('intval', (array) $arrData['newsletter'])) .")");
					$arrData['newsletter'] = implode("\n", $objChannels->fetchEach('title'));
				}
				else
				{
					$arrData['newsletter'] = '';
				}
			}
		}

		// Initialize and send e-mail
		try
		{
			$objEmail = new EmailTemplate($objModule->mail_template);
			$objEmail->send($arrData['email'], $arrData);
		}
		catch (Exception $e)
		{
			$this->log('Could not send registration e-mail for member ID ' . $arrData['id'] . ': ' . $e->getMessage(), 'RegistrationMailTemplates sendRegistrationEmail()', TL_ERROR);
			return;
		}

		$objModule->reg_activate = true;
	}

