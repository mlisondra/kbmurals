<?php
/**
 * Joomla! System plugin - jQuery Fancybox
 *
 * @author Yireo (info@yireo.com)
 * @copyright Copyright 2011 Yireo.com. All rights reserved
 * @license GNU Public License
 * @link http://www.yireo.com

 * CHANGELOG:
 * [1.1.8] Extra parameter to disable loading of jQuery
 * [1.1.8] Usage of $j variable in noConflict mode
 * [1.1.9] Addition of Google API
 * [1.2.3] New option "Content-type"
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

// Import the parent class
jimport( 'joomla.plugin.plugin' );

/**
 * Fancybox System Plugin
 */
class plgSystemFancybox extends JPlugin
{
    /**
     * Event onAfterRender
     *
     * @access public
     * @param null
     * @return null
     */
    public function onAfterDispatch()
    {
        // Dot not load if this is not the right document-class
        $document = JFactory::getDocument();
        if($document->getType() != 'html') {
            return false;
        }

        // Perform actions on the frontend
        $application = JFactory::getApplication();
        if($application->isSite()) {

            $elements = $this->getElements();
            if(empty($elements)) return null;

            // Get and parse the components from the plugin parameters
            $components = $this->getParams()->get('exclude_components');
            if(empty($components)) {
                $components= array();
            } elseif(!is_array($components)) {
                $components = array($components);
            }

            // Don't do anything if the current component is excluded
            if(in_array(JRequest::getCmd('option'), $components)) {
                return;
            }

            $js_folder = 'media/plg_fancybox/js/';
            $transition = $this->getParams()->get('transition', '');
            $namespace = $this->getParams()->get('namespace', '');

            $this->loadStylesheet('jquery.fancybox-1.3.4.css', $this->getParams()->get('load_css', 1));

            if(JFactory::getApplication()->get('jquery') == false) {
                $this->loadScript('jquery-1.6.4.min.js', $this->getParams()->get('load_jquery', 1));
                JFactory::getApplication()->set('jquery', true);
            }
            $this->loadScript('jquery.fancybox-1.3.4.pack.js', $this->getParams()->get('load_fancybox', 1));
            if($this->getParams()->get('enable_mousewheel', 0) == 1 && $this->getParams()->get('load_mousewheel', 1) == 1) {
                $this->loadScript('jquery.mousewheel-3.0.4.pack.js');
            }

            $options = array(
                'hideOnContentClick' => (bool)$this->getParams()->get('hide_on_click', true),
                'hideOnOverlayClick' => (bool)$this->getParams()->get('hide_on_click', true),
                'overlayShow' => false,
            );

            $content_type = $this->getParams()->get('content_type');
            if(!empty($content_type)) {
                $options['type'] = $content_type;
            }

            if(!in_array($transition, array('', 'swing', 'linear', 'elastic'))) {
            
                $this->loadScript('jquery.easing-1.3.pack.js', $this->getParams()->get('load_easing', 1));

                $options['easingIn'] = 'easeIn'.ucfirst($transition);
                $options['easingOut'] = 'easeOut'.ucfirst($transition);
                $options['zoomSpeedIn'] = $this->getParams()->get('speed', 200);
                $options['zoomSpeedOut'] = $this->getParams()->get('speed', 200);

            } else {
                $options['transitionIn'] = $transition;
                $options['transitionOut'] = $transition;
                $options['speedIn'] = $this->getParams()->get('speed', 200);
                $options['speedOut'] = $this->getParams()->get('speed', 200);
            }

            foreach($options as $name => $value) {
                if(is_bool($value)) {
                    $bool = ($value) ? 'true' : 'false';
                    $options[$name] = "'$name':$bool";
                } else {
                    $options[$name] = "'$name':'$value'";
                }
            }

            $script_lines = array('<!--//--><![CDATA[//><!--');
            if(empty($namespace)) {
                $script_lines[] = 'jQuery.noConflict();';
                $script_lines[] = 'jQuery(document).ready(function() {';
                foreach($elements as $element) {
                    $script_lines[] = 'if(jQuery("'.$element.'")) { jQuery("'.$element.'").fancybox({'.implode(',', $options).'}); }';
                }

            } else {
                $script_lines[] = $namespace.' = jQuery.noConflict();';
                $script_lines[] = $namespace.'(document).ready(function() {';
                foreach($elements as $element) {
                    $script_lines[] = $namespace.'("'.$element.'").fancybox({'.implode(',', $options).'});';
                }
            }
            $script_lines[] = '});';
            $script_lines[] = '//--><!]]>';

            $document = JFactory::getDocument();
            $document->addScriptDeclaration(implode("\n", $script_lines)); 

        }
    }

    /**
     * Load a script
     *
     * @access private
     * @param null
     * @return null
     */
    private function loadScript($file = null, $condition = true)
    {
        if($condition == true) {

            if(preg_match('/^jquery-([0-9\.]+).min.js$/', $file, $match) && $this->getParams()->get('use_google_api', 0) == 1) {

                if(JURI::getInstance()->isSSL() == true) {
                    $script = 'https://ajax.googleapis.com/ajax/libs/jquery/'.$match[1].'/jquery.min.js';
                } else {
                    $script = 'http://ajax.googleapis.com/ajax/libs/jquery/'.$match[1].'/jquery.min.js';
                }

                JFactory::getDocument()->addScript($script);
                return;
            }

            $folder = 'media/plg_fancybox/js/';

            // Check for overrides
            $template = JFactory::getApplication()->getTemplate();
            if(file_exists(JPATH_SITE.DS.'templates'.DS.$template.DS.'html'.DS.'plg_fancybox'.DS.'js'.DS.$file)) {
                $folder = 'templates/'.$template.'/html/plg_fancybox/js/';
            }

            JHTML::script($file, $folder, false);
        }
    }

    /**
     * Load a stylesheet
     *
     * @access private
     * @param null
     * @return null
     */
    private function loadStylesheet($file = null, $condition = true)
    {
        if($condition == true) {

            $folder = 'media/plg_fancybox/css/';

            // Check for overrides
            $template = JFactory::getApplication()->getTemplate();
            if(file_exists(JPATH_SITE.DS.'templates'.DS.$template.DS.'html'.DS.'plg_fancybox'.DS.'css'.DS.$file)) {
                $folder = 'templates/'.$template.'/html/plg_fancybox/css/';
            }

            JHTML::stylesheet($file, $folder, false);
        }
    }

    /**
     * Load the parameters
     *
     * @access private
     * @param null
     * @return JParameter
     */
    private function getParams()
    {
        jimport('joomla.version');
        $version = new JVersion();
        if(version_compare($version->RELEASE, '1.5', 'eq')) {
            $plugin = JPluginHelper::getPlugin('system', 'fancybox');
            $params = new JParameter($plugin->params);
            return $params;
        } else {
            return $this->params;
        }
    }

    /**
     * Get the HTML elements
     *
     * @access private
     * @param null
     * @return JParameter
     */
    private function getElements()
    {
        $elements = $this->getParams()->get('elements');
        $elements = trim($elements);
        $elements = explode(",", $elements);
        if(!empty($elements)) {
            foreach($elements as $index => $element) {
                $element = trim($element);
                $element = preg_replace('/([^a-zA-Z0-9\[\]\=\-\_\.\#\ ]+)/', '', $element);
                if(empty($element)) {
                    unset($elements[$index]);
                } else {
                    $elements[$index] = $element;
                }
            }
        }

        return $elements;
    }
}

