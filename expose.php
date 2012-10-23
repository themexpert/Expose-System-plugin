<?php
/**
 * Expose system plugin
 *
 * @package     Expose
 * @version     3.0.0
 * @author      ThemeXpert http://www.themexpert.com
 * @copyright   Copyright (C) 2010 - 2011 ThemeXpert
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
 **/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

class plgSystemExpose extends JPlugin{

    public function __construct( &$subject, $config ){
        parent::__construct( $subject, $config );
    }


    //load extended menu params
    public function onContentPrepareForm($form, $data){

        if ($form->getName()=='com_menus.item'){
			JForm::addFormPath(JPATH_LIBRARIES.DS.'expose'.DS.'core'.DS.'menu');
			$form->loadFile('params', false);
		}
    }

   /* public function onBeforeRender(){
        jimport('expose.expose');

        global $expose;

        echo $expose->get('style');
    }*/

}
