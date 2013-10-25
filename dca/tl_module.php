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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['registration'] = str_replace('reg_activate;', 'reg_activate,nc_notification,nc_notification_admin;', $GLOBALS['TL_DCA']['tl_module']['palettes']['registration']);
$GLOBALS['TL_DCA']['tl_module']['palettes']['lostPassword'] = str_replace('reg_password;', 'reg_password,nc_notification;', $GLOBALS['TL_DCA']['tl_module']['palettes']['lostPassword']);

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'notifyPersonalData';
$GLOBALS['TL_DCA']['tl_module']['palettes']['personalData'] = str_replace('{redirect_legend', '{email_legend:hide},notifyPersonalData;{redirect_legend', $GLOBALS['TL_DCA']['tl_module']['palettes']['personalData']);
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['notifyPersonalData'] = 'nc_notification,mail_recipient';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['notifyPersonalData'] = array
(
    'label'             => &$GLOBALS['TL_LANG']['tl_module']['notifyPersonalData'],
    'exclude'           => true,
    'inputType'         => 'checkbox',
    'eval'              => array('submitOnChange'=>true, 'tl_class'=>'clr'),
    'sql'               => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mail_recipient'] = array
(
    'label'             => &$GLOBALS['TL_LANG']['tl_module']['mail_recipient'],
    'exclude'           => true,
    'inputType'         => 'text',
    'eval'              => array('maxlength'=>255, 'rgxp'=>'email', 'tl_class'=>'w50'),
    'sql'               => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['nc_notification_admin'] = $GLOBALS['TL_DCA']['tl_module']['fields']['nc_notification'];
$GLOBALS['TL_DCA']['tl_module']['fields']['nc_notification_admin']['label'] = &$GLOBALS['TL_LANG']['tl_module']['nc_notification_admin'];
