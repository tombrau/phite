<?php
#-------------------------------------------------------------------------------
#
# PHITE.php -- a simple but powerful site framework.
# (C) 2001,2002 Chris Robson
# 
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
# 
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA,
# or, see http://www.gnu.org/copyleft/gpl.html
#
# Contact the author at: chris@dreammask.com
# Documentation and downloads at: www.dreammask.com/PHITE.php?sitesig=PT
#
#-------------------------------------------------------------------------------
#
# Bugfix / Robustness, v0.92: August 17 2002
# First public release, v0.9: January 11 2002
# Alpha 1:	   				  December 31 2001
#
#-------------------------------------------------------------------------------
#SETTINGS
#-------------------------------------------------------------------------------
#
# Requires TemplatePower v2.0+ to be in same directory
# See http://templatepower.codocad.com/

  include "./class.TemplatePower.inc.php";	#Requires v2.0 or above

# These are the only two settings you must change to get going on a simple site
# siteroot should be set to the full http:// URL of the directory that this script
# resides in. Leave off the trailing slash.
# Note you can use a relative path (from this file) if your web server
# handles relative paths OK -- try it and see. In the following examples
# it assumes that your PHITE.php (this file) is at www.yoursitehere.com/PHITE_R092/PHITE.php
# def_sitesig is the default 'signature' for your site. Best kept short.

# $siteroot 		= "http://www.yoursitehere.com/PHITE_R092";	 # Safest way
  $siteroot			= ".";								 # Relative (faster)
  $def_sitesig 		= "PT";

#PHITE can drive several 'sites' from one script. Each site needs a signature, a
#name, a homepage name and a default skin (template) file, which resides in
#./{sitesig}_MAIN/skins/{def_skin}.tpl
  
  $sites['PT'] = array('name'=>"PHITE","homepagename"=>'Home', 'def_skin'=>'default');

#Elements can appear only once on a page. You can have any number of elements. The
#array key is the 'signature' of the file that is inserted (e.g. BODY_somename.inc),
#the el_name is the TemplatePower {BODY} that needs to be put in the .tpl (skin)
#file. acq determines whether the element is 'acquired' further up the hierarchy
#if not found in the current page/sub-page

  $elements['BODY']   = array('el_name'=>'BODY',   'acq'=>true); 
  $elements['FOOTER'] = array('el_name'=>'FOOTER', 'acq'=>true);
  $elements['META']   = array('el_name'=>'META',   'acq'=>true);
  $elements['DATE']   = array('el_name'=>'DATE',   'acq'=>true);
  $elements['PRINT']  = array('el_name'=>'PRINT_FRIENDLY', 'acq'=>true);
  
#Blocks can appear many times on a page. You can have any number of blocks. The
#array key is the 'signature' of the file that is inserted (e.g. RB_sort_somename.inc),
#the bl_name is the TemplatePower {RIGHT_BLOCK} that needs to be put in the .tpl (skin)
#file. See the example templates for how to build a block (it's very easy)
#acq determines whether the element is 'acquired' further up the hierarchy
#if no blocks of that type found in the current page/sub-page

  $blocks['RB'] = array('bl_name'=>'RIGHT_BOX', 'bl_title'=>'RB_TITLE', 'bl_content'=>'RB_CONTENT', 'acq'=>true);
  $blocks['LB'] = array('bl_name'=>'LEFT_BOX' , 'bl_title'=>'LB_TITLE', 'bl_content'=>'LB_CONTENT', 'acq'=>true);
  $blocks['CB'] = array('bl_name'=>'CENTER_BOX' , 'bl_title'=>'CENTER_TITLE', 'bl_content'=>'CENTER_CONTENT', 'acq'=>true);

#Substitution array so that illegal filename characters can be inserted in
#titles
  
  $namechars['__apo'] = "'";
  $namechars['__que'] = "?";
  $namechars['__col'] = ":";
  $namechars['__com'] = ",";
  
#Subdirectory behavior. alwaysshowsubs makes all subdirectories appear in the
#navigation block always. namefromsubs determines whether the pagename is derived
#from the subdirectory or its parent.

  $alwaysshowsubs 	= false;
  $namefromsubs		= true; 

#-------------------------------------------------------------------------------
#               No need to change anything below this line
#-------------------------------------------------------------------------------
# FUNCTIONS
#-------------------------------------------------------------------------------

# Function to return ordered array of filename/name pairs which meet the
# criteria SIG_sort_some_name.ext (which would be key:"SIG_sort_Some_name.ext",
# value:"Some name". If $ext="dir" (default) directories are assumed. If $sig
# is empty then no leading signature is required.
function getlist($dir,$sig,$ext="dir")
{
  $d=dir($dir);
  while($entry=$d->read())
  {
    if (!isset($sig) || strtolower(substr($entry,0,strlen($sig)+1))==strtolower($sig."_"))
	{
      if (($ext=="dir" && is_dir($dir."/".$entry)) || strtolower((substr(strrchr($entry,'.'),1))==strtolower($ext)))
      {
		$list[$entry] = textname($entry,$sig);
	  }
	} 
  }
  if (isset($list))
  {
    ksort($list);
    return $list;
  }
  else
  {
    return false;
  } 
}

# Function to insert special characters in names, e.g. '?' for '__que' from $namechars array
function subspecial($name)
{
  global $namechars;
  reset($namechars);
  while($sub=each($namechars))
  {
    $name=str_replace($sub['key'],$sub['value'],$name);
  }
  return $name;
}
    
# Function to get text part of filename of form "SIG_sort_Some_name.ext",
# returns "Some name". If sort is false then filename is assumed to be of form SIG_Some_name.ext
function textname($name,$sig,$sort=true)
{
	    if (strtolower(substr($name,0,strlen($sig)+1))==strtolower($sig."_")) $name = substr($name,strlen($sig)+1); # Trim SIG
		if ($sort && !(strpos($name,'_')===false)) $name = substr($name,strpos($name,'_')+1); # Trim sort string
		if (!(strrpos($name,'.')===false)) $name = substr($name,0,strrpos($name,'.')); # Trim any extension
		$name = subspecial($name);
		$name = str_replace('_',' ',$name);
		return $name;
}

# Function to return the filename of the first file found in directory $dir which starts
# with $start."_" . Returns "" if no file found.
function filestarting($dir,$start,$ext='inc')
{
	  $d=dir($dir);
	  while($f=$d->read())
	  {
	     if (strtolower($f)==strtolower($start.'.'.$ext)) return $f;
		 if (strtolower(substr($f,0,strlen($start)+1))==strtolower($start.'_')
		     && strtolower(substr($f,strrpos($f,'.')+1))==strtolower($ext) ) return $f;
	  }
	  return "";
}

# Function to create an element based on file content
function cr_element($dir, $sig, &$tpl_obj, $el_name)
{
  $file=filestarting($dir,$sig,"inc");
  if ($file!="")
  {
	$fname=$dir."/".$file;
	$content=buf_out($fname);
    $tpl_obj->assign('_ROOT.'.$el_name,$content);
	return 1;
  }
  else return 0; 
}


# Function to create a number of blocks or 'boxes' (usually left- or right-) based
# on directory content
function cr_blocks($dir, $sig, &$tpl_obj, $block_name, $block_title_name, $block_content)
{
  $block_count=0;
  $files=getlist($dir,$sig,"inc");
  if ($files) while($entry=each($files))
  {
    $name=$entry['value'];
	$fname=$dir."/".$entry['key'];
	$content=buf_out($fname);
	$tpl_obj->newBlock($block_name);
    $tpl_obj->assign($block_title_name,$name);
    $tpl_obj->assign($block_content,$content);
	$block_count+=1;
  }
  return $block_count; 
}

# Function to execute php file and return buffered output
function buf_out($PHITE_fname)
{
  ob_start();
  include_once($PHITE_fname);
  $buffer=ob_get_contents();
  ob_end_clean();
  return $buffer;
}
 
### Debug Box:
function debugvar($var)					
{
    global $tpl;
    $tpl->newBlock("RIGHT_BOX");
    $tpl->assign("RB_TITLE","Debug");
    $tpl->assign("RB_CONTENT",$var);
}

#-------------------------------------------------------------------------------
# Main Script
#-------------------------------------------------------------------------------

# Unpack all needed variables so script works with register_globals set to 'off'
  $PHP_SELF=$HTTP_SERVER_VARS['PHP_SELF'];
  if (isset($HTTP_GET_VARS['page'])) $page=$HTTP_GET_VARS['page'];
  if (isset($HTTP_POST_VARS['page'])) $page=$HTTP_POST_VARS['page'];
  if (isset($HTTP_GET_VARS['subpage'])) $subpage=$HTTP_GET_VARS['subpage'];
  if (isset($HTTP_POST_VARS['subpage'])) $subpage=$HTTP_POST_VARS['subpage'];
  if (isset($HTTP_GET_VARS['sitesig'])) $sitesig=$HTTP_GET_VARS['sitesig'];
  if (isset($HTTP_POST_VARS['sitesig'])) $sitesig=$HTTP_POST_VARS['sitesig'];
  if (isset($HTTP_GET_VARS['skin'])) $skin=$HTTP_GET_VARS['skin'];
  if (isset($HTTP_POST_VARS['skin'])) $skin=$HTTP_POST_VARS['skin'];
  
# Set site to default values if not set through GET, POST, Cookie or session
  if (!isset($sitesig)) $sitesig = $def_sitesig;
  if (!isset($sites[$sitesig]['name'])) $sitesig = $def_sitesig; # check valid sitesig (can't use array_key_exists till 4.1.0!)

  $homepagename=$sites[$sitesig]['homepagename'];
  $sitename=$sites[$sitesig]['name'];
  $scriptdir        = "./".$sitesig."_MAIN/scripts";
  
#get skin from Cookie, but override if set through POST or GET
  if (!isset($skin))
  {
     if (isset($HTTP_COOKIE_VARS["PHITE_".$sitesig."_skin"])) $skin = $HTTP_COOKIE_VARS["PHITE_".$sitesig."_skin"];
   	 else $skin = $sites[$sitesig]['def_skin'];
  } 

# Check we have a valid skin, page and subpage
  if (!file_exists("./".$sitesig."_MAIN/skins/".$skin.".tpl")) $skin = $sites[$sitesig]['def_skin'];
  if (isset($page) && !is_dir('./'.strtr($page,'\/','  ')))
  {
	$page=$sitesig.'_MAIN';
	$subpage='ERROR_badpage';
  } 
  if (isset($subpage) && !is_dir('./'.strtr($page,'\/','  ').'/'.strtr($subpage,'\/','  ')))
  {
	$page=$sitesig.'_MAIN';
	$subpage='ERROR_badpage';
  } 
  
# The files for the home page are always held in SIG_MAIN
# Set path to body.inc and determine pagename
  if (!isset($page))
  {
    $page = $sitesig."_MAIN";
	$pagename = $homepagename;
  } else {
    if ($namefromsubs && isset($subpage))
	{
	  $pagename = textname($subpage,$sitesig);
	} else {
      $pagename = textname($page,$sitesig);
	}
  }
  if (isset($subpage))
  {
    $bodydir="./".$page."/".$subpage;
  } else {
    $bodydir="./".$page;
  }

# Build PHITE-specific variables for use by included scripts     
  $PHITE_vars["PHITE_sitename"] = $sitename;
  $PHITE_vars["PHITE_siteroot"] = $siteroot;
  $PHITE_vars["PHITE_sitesig"]  = $sitesig;
  $PHITE_vars["PHITE_homepagename"] = $homepagename;
  $PHITE_vars["PHITE_mainscript"] = $siteroot."/".basename($PHP_SELF);
  $PHITE_vars["PHITE_callself"] = $siteroot."/".basename($PHP_SELF)."?sitesig=".$sitesig."&page=".$page;
  if (isset($subpage)) $PHITE_vars["PHITE_callself"] .= "&subpage=".$subpage;
  $PHITE_vars["PHITE_selfdir"] = $bodydir;
  $PHITE_vars["PHITE_selfdirURL"] = $siteroot.substr($bodydir,1);
  $PHITE_vars["PHITE_pagename"] = $pagename;
  $PHITE_vars["PHITE_scriptdir"] = $scriptdir;
  $PHITE_vars["PHITE_fullcallself"]= $siteroot."/".basename($PHP_SELF);
  if (isset($page)) $PHITE_vars["PHITE_page"] = $page;
  if (isset($subpage)) $PHITE_vars["PHITE_subpage"] = $subpage;
  $PHITE_vars["PHITE_skin"] = $skin;

# Load GET and POST variables into array for included scripts, and build
# PHITE_fullcallself variable to be able to re-call pages
  $c='?';  
  if (isset($HTTP_GET_VARS)) while ($var = each($HTTP_GET_VARS))
  {
    $PHITE_vars[$var['key']] = $var['value'];
	$PHITE_vars["PHITE_fullcallself"].= $c.$var['key'].'='.$var['value'];
	$c='&';
  } 
  if (isset($HTTP_POST_VARS)) while ($var = each($HTTP_POST_VARS))
  {
    $PHITE_vars[$var['key']] = $var['value'];
	$PHITE_vars["PHITE_fullcallself"].= $c.$var['key'].'='.$var['value'];
	$c='&';
  }

# Initialize Template instance and insert includes
  $tpl = new TemplatePower("./".$sitesig."_MAIN/skins/".$skin.".tpl");
  $tpl->prepare();
  
# Assign main variables
  $tpl->assign("_ROOT.SITENAME",$sitename);
  $tpl->assign("_ROOT.PAGETITLE",$pagename);
  $tpl->assign("_ROOT.HOMELINK",$siteroot."/".basename($PHP_SELF)."?sitesig=".$sitesig);
  $tpl->assign("_ROOT.HOMENAME",$homepagename);

# Build left navigation options	    
  $dirs = getlist(".",$sitesig,"dir");
  if ($dirs) while($entry=each($dirs))
  {
      $filename=$entry['key'];
	  $text=$entry['value'];
      if (strtolower($filename)==strtolower($sitesig."_MAIN")) continue; # Do not show MAIN directory
	  $redir =filestarting("./".$filename,"redirect",'inc');
	  if ($redir=="")
	  {
	    $link = $siteroot."/".basename($PHP_SELF)."?sitesig=".$sitesig."&page=".str_replace(' ','%20',$filename);
	  }else {  
	  	$link=buf_out('./'.str_replace(' ','%20',$filename).'/'.$redir); #get redirected output
	  }

      $tpl->newBlock("LEFT_NAV");
      $tpl->assign("OPTION_LINK",$link);
      $tpl->assign("OPTION_NAME",$text);
	  
	  # If this is current directory (or $alwaysshowsubs is set) check for subdirs  
	  if ($alwaysshowsubs || strtolower($filename)==strtolower($page))
	  {
	    $subdirs = getlist("./".$filename,$sitesig,"dir");
        if ($subdirs) while($subentry=each($subdirs))
        {
          $subfilename=$subentry['key'];
	      $subtext=$subentry['value'];
	      $redir =filestarting("./".$filename."/".$subfilename,"redirect",'inc');
	      if ($redir=="")
	      {
	        $sublink = $siteroot."/".basename($PHP_SELF)."?sitesig=".$sitesig."&page=".str_replace(' ','%20',$filename)."&subpage=".str_replace(' ','%20',$subfilename);
	      }else {
	  	    $sublink=buf_out('./'.str_replace(' ','%20',$filename).'/'.str_replace(' ','%20',$subfilename).'/'.$redir); #get redirected output
	      }

          $tpl->newBlock("SUB_NAV");
          $tpl->assign("SUB_LINK",$sublink);
          $tpl->assign("SUB_NAME",$subtext);
		}
	  }
  }

# Build Elements using acquisition
  while ($el_array=each($elements))
  {
    $el_sig=$el_array['key'];
    $el=$el_array['value'];
    $count=0;
    if (isset($subpage))
    {
      $count=cr_element($bodydir,$el_sig,$tpl,$el['el_name']);
    }
    if (isset($page) && $count==0  && (!isset($subpage) || $el['acq']))
    {
      $count=cr_element("./".$page,$el_sig,$tpl,$el['el_name']);
    }
    if ($count == 0 && (!isset($page) || $el['acq']))
    {
      $count=cr_element($sitesig."_MAIN",$el_sig,$tpl,$el['el_name']);
    }
  }

  
# Build Blocks using acquisition
  while ($bl_array=each($blocks))
  {
    $bl_sig=$bl_array['key'];
    $bl=$bl_array['value'];
    $count=0;
    if (isset($subpage))
    {
      $count=cr_blocks($bodydir,$bl_sig,$tpl,$bl['bl_name'],$bl['bl_title'],$bl['bl_content']);
    }
    if (isset($page) && $count==0  && (!isset($subpage) || $bl['acq']))
    {
      $count=cr_blocks("./".$page,$bl_sig,$tpl,$bl['bl_name'],$bl['bl_title'],$bl['bl_content']);
    }
    if ($count == 0 && (!isset($page) || $bl['acq']))
    {
      $count=cr_blocks($sitesig."_MAIN",$bl_sig,$tpl,$bl['bl_name'],$bl['bl_title'],$bl['bl_content']);
    }
  }


# Output page  
  $tpl->printToScreen();
  
?>
