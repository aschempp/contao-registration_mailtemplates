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


/**
 * Enable extension if the notification_center extension is active
 */
if (in_array('notification_center', Config::getInstance()->getActiveModules()))
{
	$GLOBALS['FE_MOD']['user']['lostPassword'] = 'ModulePasswordNotificationCenter';
	$GLOBALS['TL_HOOKS']['createNewUser'][] = array('RegistrationNotificationCenter', 'sendRegistrationEmail');
	$GLOBALS['TL_HOOKS']['updatePersonalData'][] = array('RegistrationNotificationCenter', 'notifyAboutPersonalData');
}


/**
 * Notification Center notification types
 */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['recipients'] = array('recipient_email');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['attachment_tokens'] = array();
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['email_text'] = array('domain', 'link', 'member_*', 'recipient_email');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['email_subject'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['email_html'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_password']['email_text'];

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personalData']['recipients'] = array('recipient_email');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personalData']['attachment_tokens'] = array();
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personalData']['email_text'] = array('changed', 'member_*', 'new_address', 'old_address');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personalData']['email_subject'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personalData']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personalData']['email_html'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_personalData']['email_text'];

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['recipients'] = array('member_email', 'admin_email');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['attachment_tokens'] = array();
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['email_text'] = array('domain', 'link', 'member_*', 'recipient_email');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['email_subject'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['email_html'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['contao']['member_registration']['email_text'];
