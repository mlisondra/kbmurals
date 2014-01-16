<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.folder' );

class com_virtueuploadInstallerScript {
	
	/**
	 * returns the current DB object
	 * 
	 * @since 0.6
	 * @return object database
	 *
	 */



	function _getDB() {
		$database = JFactory::getDBO();
		return $database;
	}
	
	/**
	 * Prints the content of a given table for debugging purposes
	 *
	 * @since 0.6b
	 * @param object $table
	 */
	function _debugDB($table) {
		echo '<br/>';
		foreach ($table as $row) {
			echo $row . '-';
		}
		echo '<br/>';
	}
	
	/**
	 * Helper to print the UTF charset and collate strings to go with DB creation/upgrade queries
	 *
	 * @param string $collation
	 * @return string if UTF8, empty strings if not.
	 */
	function _isUtf8($collation) {
		$utf8 = '';
		if ( substr($collation, 0, 4) == 'utf8' ) {
			$utf8 = " CHARACTER SET `utf8` COLLATE `" . $collation . "`";
		}
		return $utf8;
	}

	
	/**
	 * Runs the creation DB scripts. This is run only on first install!
	 * This db is from version 0.5. Subsequent additions / changes are
	 * found under "dbupgrade"
	 *
	 * @since 0.6b
	 * @return true on success;
	 */
	function dbinstall($collation) {
		
		// test for UTF8
		$utf8 = com_VirtueUploadInstallerScript::_isUtf8($collation);
		
		$sql1 = "CREATE TABLE IF NOT EXISTS `#__virtueuploads` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `file_name` varchar(100) NOT NULL DEFAULT '',
				  `file_size` text NOT NULL,
                  `user_id` int(11) NOT NULL,
				  `upload_by` varchar(100) NOT NULL DEFAULT '',
				  `product_id` varchar(64) NOT NULL DEFAULT '0',
				  `order_id` mediumint(11) NOT NULL DEFAULT '0',
				  `thumb` varchar(256) NOT NULL,
				  `ip` varchar(200) NOT NULL DEFAULT '',
				  `session_id` varchar(32) NOT NULL DEFAULT '',
				  `link` varchar(150) NOT NULL DEFAULT '',
				  `comment` text NOT NULL,
				  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				  `cdate` int(11) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM" . $utf8 . ";";
		$sql2="CREATE TABLE IF NOT EXISTS `jos_joomlavm_ordref` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`orderid` int(11) ,
				`fileid` int(11),
				  PRIMARY KEY (`id`) 
			) ENGINE=MyISAM" . $utf8 . ";";
		$sql3 = "CREATE TABLE IF NOT EXISTS `#__virtueuploads_settings` (
				  `id` int(11) NOT NULL default '1',
				  `allow_upload` tinyint(1) default '1',
				  `uploadpath` varchar(128) default 'virtueupload',
				  `filerename` tinyint(1) default '1',
				  `frontend_link_color` varchar(16) default 'B8CDDC',
				  `extensions` varchar(255) NOT NULL default '.html|.php|.exe|.com|.bat|.ini',
				  `maxsize` int(11) NOT NULL default '8024000',
				  `banuser` int(11) NOT NULL default '0',
				  `adminmail` varchar(128) default NULL,
				  `vm_attribute` varchar(128) NOT NULL default 'upload',
				  `show_thumb` int(11) NOT NULL default '1',
				  `iconwidth` varchar(128) NOT NULL,
				  `iconheight` varchar(128) NOT NULL,
				  `thumbwidth` varchar(128) NOT NULL,
				  `thumbheight` varchar(128) NOT NULL,
				  `maxuploadfiles` int(11) NOT NULL default '4',
				  PRIMARY KEY  (`id`)
				  ) ENGINE=MyISAM" . $utf8 . ";";

		$sql4 = "INSERT INTO `#__virtueuploads_settings` VALUES
			(1, 1, 'vmupload', 1, 'B8CDDC', '.php|.exe|.com|.bat|.ini|.js|.htm|.html', 8024000, 0, '0', 'Upload', 1, '64px', '64px', '64px', '64px',4);
			";
		
		$database = com_VirtueUploadInstallerScript::_getDB();
		$database->setQuery($sql1);
		if ( !$database->query() ) {
			echo "Error on DB table virtueuploads";
			return false;
		}
		$database->setQuery($sql2);
		if ( !$database->query() ) {
			echo "Error on DB table jos_joomlavm_ordref";
			return false;
		}
		$database->setQuery($sql3);
		if ( !$database->query() ) {
			echo "Error on DB table virtueuploads_settings";
			return false;
		}
		$database->setQuery($sql4);
		if ( !$database->query() ) {
			echo "Error on DB table inserting virtueuploads_settings";
			return false;
		}
		
		return "Tables installed!<br />";
	}

	
	/**
	 * Prepares the file system for the directories (folders) for VirtueUpload documents. 
	 *
	 * @since 0.7b
	 * @param string $dirname
	 * @return bool true on success
	 */
	function createDir() {
		
		// Initialize some variables
		$string = '';
		$counterrors = 0;
		
		// Check for existing dirs: if they are found, then skip this step.
		if ( $upldirexists = JFolder::exists(JPATH_SITE.'/vmupload')  ) {
			$string = 'Upload folder already there.<br />'."\n";
			return $string; 
		} else {
			if ($makedir = JFolder::create( JPATH_SITE.'/vmupload')) {
				$string .= "upload folder created.<br />";
			} else {
				$string .= "<font color='red'>ERROR:upload folder is not created!</font><br />";
				$counterrors = $counterrors + 1;
			}
		}
		if ( $counterrors > 0 ) {
			$string .= "<br /><font color = 'red'>WARNING: 1 or more folders are not created. <br/> Please make them by yourself.</font><br />";
		}
		return $string;
	}


/**
 * Executes the installation and upgrade script
 * 
 * @since 0.6b
 * @return bool true on success
 *
 */
function install($parent) {



	$version = new JVersion();
    if ( (real) $version->RELEASE < 1.5 ) {
		echo "<h3 style=\"color: red;\">The 'VMUpload' component is designed to only  for<b>Joomla versie 1.5</b> or later edition</h3>";
		return false;
    }




    $installer = new com_VirtueUploadInstallerScript();
    $database = $installer->_getDB();
    $collation = $database->getCollation();
//	echo "DB collation is: " . $collation . "<br/>";
	
    // check whether it is an installation or an upgrade
	$database->setQuery ("SHOW COLUMNS FROM #__virtueuploads");
	$fields = $database->loadObjectList();
	if ( !count($fields) ) {
		// run DB install scripts if no column is found
	    $dbinstall = $installer->dbinstall($collation);
		if ( $dbinstall ) {
			echo "<h3>Create Tables:</h3><br />";	
			echo $dbinstall;
			echo "<font color='green'>---> OK!</font><br />";
		} else {
			echo "<h3 style=\"color: red;\">Error during database processing ...<br/></h3>";
			return false;
		}
	}
	
		



	// Run directory create scripts
	$createdir = $installer->createDir();
	if ( $createdir ) {
		echo "<h3>Create Folders ...</h3><br />";
		echo $createdir;
		echo "<font color='green'>----> OK!</font><br />";
	} else {
		echo "<h3 style=\"color: red;\">Error Create Folders ...<br/></h3>";
		return;
	}



	echo "<h3>Installation completed successfully!</h3><br />";
 }


}


?>