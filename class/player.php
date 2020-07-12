<?php
/**
 *  palyer.php for ncplayer class
 *
 * @copyright	The XOOPS project http://www.xoops.org/
 * @license		http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author		Wenfei Li (nightcat) <liwenfei@21cn.com>
 * @since		1.00
 * @version		$Id$ 2007/11/30
 * @package		module::ncplayer
 */


if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}
defined("FRAMEWORKS_ART_FUNCTIONS_INI") || include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.ini.php';
load_object();

/**
 *
 * @package		nckarma
 * @author		nightcat	<liwenfei@21cn.com>
 */
class XoopsPlayer extends ArtObject 
{
    function XoopsPlayer()
    {
        $this->ArtObject(); 
        $this->initVar('id',     XOBJ_DTYPE_INT,    	null, false);
        $this->initVar('url',    XOBJ_DTYPE_TXTBOX,    	null, false);
        $this->initVar('uid',    XOBJ_DTYPE_INT,    	null, false);
        $this->initVar('name',   XOBJ_DTYPE_TXTBOX,    	null, false);
        $this->initVar('dtime',  XOBJ_DTYPE_TXTBOX, 	null, false);
    }
}

/**
 *
 * @package		nckarma
 * @author		nightcat	<liwenfei@21cn.com>
 */
class NcplayerPlayerHandler extends ArtObjectHandler 
{
    function NcplayerPlayerHandler(&$db) {
        $this->ArtObjectHandler($db, 'ncplayer_list', 'XoopsPlayer', 'id', '');
    }
    
    /**
     * Get all music by limit
     *
     * @param unknown_type $criteria
     */
    function getMusic($criteria)
    {
    	$infos = array();
    	if ( $objs = $this->getObjects($criteria) ){
	    	foreach ( $objs as $obj ) {
	    		$info = array();
	    		$info['id'] = $obj->getVar('id');
	    		$info['name'] = $obj->getVar('name');
	    		$info['url']  = $obj->getVar('url');
	    		$infos[] = $info ;
	    	}
    	}
    	
    	return $infos ;
    }
}	


?>