<?php
/**
 * Expose system plugin
 *
 * @package     Expose
 * @version     4.1
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

        if( JFactory::getApplication()->isAdmin() )
        {
            if ($form->getName() == 'com_menus.item'){
                JForm::addFormPath( JPATH_LIBRARIES . '/expose/core/menu' );
                $form->loadFile('params', false);
            }

            if( $form->getName() == 'com_templates.style' || 
                $form->getName() == 'com_modules.module' )
            {
                // Load Library language file
                $lang = JFactory::getLanguage();
                $lang->load('lib_expose', JPATH_SITE);
            }

            // Load module customizer form.
            // --------------------------------
            if (in_array(JRequest::getCmd('option'), array(
                'com_advancedmodules',
                'com_contenttemplater',
                'com_nonumbermanager',
                'com_rereplacer',
                'com_snippets',
                'com_modules',
                'com_poweradmin',
            ))) {
                // Get template name
                $db = JFactory::getDBO();
                $query = $db->getQuery(true)
                        ->select('template')
                        ->from('#__template_styles')
                        ->where('client_id = 0 AND home = 1');
                $db->setQuery($query);
                $template = $db->loadResult(); 

                // Set path
                $file           = 'modules_style';
                $templatePath   = JPATH_ROOT . '/templates/' . $template . '/html/';
                $finalPath      = JPATH_LIBRARIES . '/expose/admin/' ;
                
                if( file_exists( $templatePath . $file . '.xml' ) )
                {
                    $finalPath = $templatePath;
                }

                JForm::addFormPath( $finalPath );
                $form->loadFile( $file, false);
            }
        }

    }

   /* public function onBeforeRender(){
        jimport('expose.expose');

        global $expose;

        echo $expose->get('style');
    }*/

}
