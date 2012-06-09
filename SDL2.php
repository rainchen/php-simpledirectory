<?php
/*
Author           : David Wan
Contact          : inventordavid AT yahoo.com
                   david AT simpledirectorylisting.net
Application Name : Simple Directory Listing
Version          : 2.1 beta
Last Modified    : 2008-08-02
License          : GNU GENERAL PUBLIC LICENSE Version 3
Web Site         : http://simpledirectorylisting.net/
                   http://sourceforge.net/projects/simpledirectory/
Copyright. All rights reserved.
*/
?>
<?php
//------------------------------------------------------------------------------
// CONFIG
//------------------------------------------------------------------------------
// added in 2.1;
// Service can be shuted down by setting it to false.(true or false)
define("SYSTEM_ON"						, true);

// added in 2.0;
// Admin mode can be shuted down by setting it to false.(true or false)
define("ADMIN_MODE_ON"					, true);

// added in 2.0;
// To allow access to public, set it to false.(true or false)
define("ADMIN_MODE_NEEDS_LOGIN"			, true);

// added in 2.0;
// Login Name(a string)
define("ADMIN_MODE_LOGIN_NAME"			, "admin");

// added in 2.0;
// Password encoded in sha1 format(a string) or raw password
define("ADMIN_MODE_PASSWORD"			, "password");

// added in 2.0; removed in 2.1, see PASSWORD_FORMAT;
// "RAW", "SHA1"
//define("ADMIN_MODE_PASSWORD_FORMAT"		, "RAW");

// added in 2.0;
// "CUSTOM_ROOT", "CURRENT_WORKING_DIR", "DOCUMENT_ROOT" or "SERVER_ROOT"
define("ADMIN_MODE_VIRTUAL_ROOT"		, "DOCUMENT_ROOT");

// added in 2.0;
// An absolute path or null(a string or null)
define("ADMIN_MODE_CUSTOM_VIRTUAL_ROOT"	, null);

// added in 2.0;
// A relative path or null(a string or null)
define("ADMIN_MODE_PERMITTED_DIR"		, null);

// added in 2.1;
// User mode can be shuted down by setting it to false.(true or false)
define("USER_MODE_ON"					, true);

// added in 2.1;
// To allow access to public, set it to false.(true or false)
define("USER_MODE_NEEDS_LOGIN"			, false);

// added in 2.1;
// Login Name(a string)
define("USER_MODE_LOGIN_NAME"			, "user");

// added in 2.1;
// Password encoded in sha1 format(a string) or raw password
define("USER_MODE_PASSWORD"				, "password");

// added in 2.1;
// "CUSTOM_ROOT", "CURRENT_WORKING_DIR", "DOCUMENT_ROOT" or "SERVER_ROOT"
define("USER_MODE_VIRTUAL_ROOT"			, "DOCUMENT_ROOT");

// added in 2.1;
// An absolute path or null(a string or null)
define("USER_MODE_CUSTOM_VIRTUAL_ROOT"	, null);

// added in 2.1;
// A relative path or null(a string or null)
define("USER_MODE_PERMITTED_DIR"		, null);

// added in 2.0;
// Font size in pixel(a number)
define("FONT_SIZE"						, 15);

// added in 2.0;
// Enable/Disable Icon(true or false)
define("ICON_ON"						, true);

// added in 2.0;
// Enable/Disable Image(true or false)
define("IMAGE_PASSTHRU_ON"				, true);

// added in 2.0;
// "AUTO", "PASSTHRU_ONLY", "URL_ONLY"
define("IMAGE_LOAD_TYPE"				, "AUTO");

// added in 2.0;
// Language class(the name of a locale class)
define("LOCALE_CLASS"					, "LocaleEnglishUS");

// added in 2.0;
// For OS that doesn't use utf-8 as internal encoding method(a string)
define("OS_ENCODING"					, null);

// added in 2.1;
// "RAW", "SHA1"
define("PASSWORD_FORMAT"				, "RAW");

// added in 2.0;
// Enable/Disable RSS(true or false)
define("RSS_ON"							, true);

// added in 2.0;
// Enable/Disable SFS(true or false)
define("SFS_ON"							, true);

// added in 2.0;
// Theme class(the name of a theme class)
define("THEME_CLASS"					, "ThemeApache");

// added in 2.0;
// Enable/Disable thumbnail view(true or false)
define("THUMBNAIL_ON"					, true);

// added in 2.0;
// Pixel width in pixel(a number)
define("THUMBNAIL_SIZE"					, 120);

// added in 2.0;
// Name of your web site(a string)
define("META_WEB_SITE_NAME"				, "My Web Site");

//------------------------------------------------------------------------------
// ADVANCED CONFIG
//------------------------------------------------------------------------------
// added in 2.0;
// Enable/Disable 'remember me'(true or false)
define("SAVE_LOGIN_ON"					, false);

// added in 2.0;
// Dependent on SAVE_LOGIN_ON(in minute)
define("SESSION_CACHE_EXPIRE"			, 1440);

// added in 2.0;
// php ini(string)
define("SESSION_SAVE_PATH"				, null);

// added in 2.0;
// php ini(in secons)
define("SESSION_GC_MAXLIFETIME"			, null);

// added in 2.1;
// The size(no. of chars) of an incorrect XML response.(an integer)
define("DEBUG_XML_RESPONSE_LENGTH"		, 200);

// added in 2.1;
// Sets which PHP errors are reported. (null for using the value in php.ini)
define("DEBUG_ERROR_REPORTING_LEVEL"	, E_ALL ^ E_NOTICE);

// added in 2.1;
// Enable/disable FTP Layer for admin/readonly mode
define("FTP_LAYER_ON"					, false);

// added in 2.1;
// The FTP server address
define("FTP_LAYER_HOST"					, "localhost");

// added in 2.1;
// The FTP PORT
define("FTP_LAYER_PORT"					, 21);

// added in 2.1;
// The username of the FTP account
// SECURITY WARNING: Do no use the FTP account of "root" on your server
// SECURITY WARNING: Do not use FTP layer for production use
define("FTP_LAYER_USERNAME"				, "username");

// added in 2.1;
// The password of the FTP account
// SECURITY WARNING: Do no use the FTP account of "root" on your server
// SECURITY WARNING: Do not use FTP layer for production use
define("FTP_LAYER_PASSWORD"				, "password");

// added in 2.1;
// Enable/diable secure SSL-FTP connection
define("FTP_LAYER_SSL_ON"				, false);

// added in 2.1;
// The absolute path of the home of the FTP account.
define("FTP_LAYER_PATH_ON_SERVER"		, "/home/username/");

?>
<?php
//------------------------------------------------------------------------------
// Class name : Browser
//------------------------------------------------------------------------------
class Browser {
	var $cwd;
	var $cwdRelPath; // for non-js
	var $fileManager;
	var $moduleManager;
	var $view;

	function getFilesViewList($files, $isJavascript) {
		$html = null;
		if (count($files) === 0) {
			$html .= "<center>" . text("NO FILES") . "</center>";
		} else {
			$html .= "<table class='browserFilesViewList' id='browserFiles'><tbody>";
			foreach ($files as $fileIndex => $file) {
				if ($file->absPath !== $_SERVER['SCRIPT_FILENAME']) {
					$html .= "<tr class='fileViewList' id='$fileIndex'>";
					$html .= "<td class='systemAttribute'><div id='systemFilename_$fileIndex'>{$file->basename}</div></td>";
					$html .= "<td class='systemAttribute'><div id='systemRelPath_$fileIndex'>{$file->relPath}</div></td>";
					$html .= "<td class='systemAttribute'><div id='systemUrl_$fileIndex'>{$file->url}</div></td>";
					$html .= "<td class='systemAttribute'><div id='systemIsDir_$fileIndex'>{$file->isDir}</div></td>";
					foreach ($this->moduleManager->attributes as $attribute) {
						$html .= "<td>" . $attribute->getHtml($file, $fileIndex, $this->view, $isJavascript) . "</td>";
					}
					$html .= "<td class='browserCellFiller'></td>";
					$html .= "</tr>";
				}
			}
			$html .= "</tbody></table>";
		}
		return $html;
	}

	function getFilesViewThumbnail($files, $isJavascript) {
		$html = null;
		if (count($files) === 0) {
			$html .= "<center>" . text("NO FILES") . "</center>";
		} else {
			$html .= "<div class='browserFilesViewThumbnail' id='browserFiles'>";
			foreach ($files as $fileIndex=>$file) {
				if ($file->absPath !== $_SERVER['SCRIPT_FILENAME']) {
					$html .= "<div class='fileViewThumbnail' id='$fileIndex'>";
					$html .= "<div class='thumbnailItemContainer'>";
					$html .= "<div class='systemAttribute' id='systemFilename_$fileIndex'>{$file->basename}</div>";
					$html .= "<div class='systemAttribute' id='systemRelPath_$fileIndex'>{$file->relPath}</div>";
					$html .= "<div class='systemAttribute' id='systemUrl_$fileIndex'>{$file->url}</div>";
					$html .= "<div class='systemAttribute' id='systemIsDir_$fileIndex'>{$file->isDir}</div>";
					if ($file->isDir) {
						$html .= 	"<div class='thumbnailItemImageContainer' title='$file->basename'>" .
									"<a href='?cwdRelPath={$file->relPath}&view=$this->view' onclick='Sdl.browser.onClickThumbnailRedirect(event, \"$file->relPath\"); return false;'>" .
									"<img alt='<" . text("DIR") . ">' class='thumbnailItemImageDir' onload='Sdl.Image.position(this);' src='?print=icon&icon=dir'> </a></div>";
					} else {
						$ext = strtolower($file->extension);
						if ($ext === "gif" || $ext === "jpg" || $ext === "jpeg" || $ext === "png" || $ext === "wbmp") {
							If (IMAGE_LOAD_TYPE === "AUTO") {
								if ($file->url) {$href = "url";}
								else {$href = "passthru";}
							} else if (IMAGE_LOAD_TYPE === "PASSTHRU_ONLY") {
								$href = "passthru";
							} else { // URL_ONLY
								if ($file->url) {$href = "url";}
								else {$href = "";}
							}
							$img = "<img alt='<" . text("IMG") . ">' onload='Sdl.Image.position(this);' src='?print=thumbnail&relPath=$file->relPath'>";
						} else {
							If (IMAGE_LOAD_TYPE === "AUTO") {
								if ($file->url) {$href = "url";}
								else {$href = "passthru";}
							} else if (IMAGE_LOAD_TYPE === "PASSTHRU_ONLY") {
								$href = "passthru";
							} else { // URL_ONLY
								if ($file->url) {$href = "url";}
								else {$href .= "";}
							}
							$img = "<img alt='<" . text("UNKNOWN") . ">' class='thumbnailItemImageUnknown' onload='Sdl.Image.position(this);' src='?print=icon&icon=unknown'>";
						}
						if ($href === "passthru") {
							if (IMAGE_PASSTHRU_ON) {$href = "href='?print=image&relPath=$file->relPath' onclick='Sdl.image.onClickShowByRelPath(event, \"$file->relPath\"); return false;'";}
							else {$href = "";}
						} else if ($href === "url") {
							$href = "href='$file->url' onclick='Sdl.image.onClickShowByUrl(event, \"$file->url\"); return false;'";
						}
						$html .= "<div class='thumbnailItemImageContainer' title='$file->basename'><a $href>$img </a></div>";
					}
					foreach ($this->moduleManager->attributes as $attribute) {
							$html .= "<div>" . $attribute->getHtml($file, $fileIndex, $this->view, $isJavascript) . "</div>";
					}
					$html .= "</div>";
					$html .= "</div>";
				}
			}
			$html .= "</div>";
			// For IE6
			// For Opera 9.21. Functions would flow through thumbnail view otherwise.
			$html .= "<div style='clear:both'></div>";
		}
		return $html;
	}
	
	function getFunctions() {
		$html = null;
		if (count($this->moduleManager->functions) > 0) {
			foreach ($this->moduleManager->functions as $function) {
				//$function->fileManager = $this->fileManager;
				//$function->moduleManager = $this->moduleManager;
				$html .= "<div class='function'>" . $function->getHtml($this->cwdRelPath, $this->view) . "</div>";
			}
		}
		// For IE6
		// For Opera 9.21 though this part hasn't shown any problem yet.
		$html .= "<div style='clear:both'></div>";
		return $html;
	}
	
	function getHeader() {
		$html = null;
		$html .= "<table id='browserHeaders'><tbody><tr>";
		$html .= "<td class='systemAttribute'><div>systemFilename</div></td>";
		$html .= "<td class='systemAttribute'><div>systemRelPath</div></td>";
		$html .= "<td class='systemAttribute'><div>systemUrl</div></td>";
		$html .= "<td class='systemAttribute'><div>systemIsDir</div></td>";
		foreach ($this->moduleManager->attributes as $attribute) {
			$html .= "<td>" . $attribute->getHeader() . "</td>";
		}
		$html .= "<td class='browserCellFiller'><div class='browserScrollBarFiller'></div></td>";
		$html .= "</tr></tbody></table>";
		return $html;
	}
	
	function getHtml() {
		if (isset($_GET["cwdRelPath"])) {$this->cwdRelPath = $_GET["cwdRelPath"];}
		else {$this->cwdRelPath = $this->user->permittedDirRelPath;}
		if ($_GET["view"] === "list" || $_GET["view"] === "thumbnail") {$this->view = $_GET["view"];}
		else {$this->view = "list";}
		$functions = $this->getFunctions();
		$header = $this->getHeader();
		$systemFiles = $this->getSystemFiles();
		$files = $this->getDirListing();
		if (!$functions) {$separator2Display = "display:none;";}
		$html = null;
		$html .=
"
<div id='browserContainer'>
	<div id='browser'>
		<div id='browserDirListingContainer'>
			<div id='browserDirListing'>
				<div id='browserHeadersContainer'>
					$header
					<div id='browserHeadersMovableBar'></div>
				</div>
				<div id='broswerSeparator1Container'>
					<div id='broswerSeparator1'><hr/></div>
					<div id='broswerSeparator1MovableBar'></div>
				</div>
				<div id='browserSystemFilesContainer'>
					$systemFiles
					<div id='browserSystemFilesMovableBar'></div>
				</div>
				<div id='browserFilesContainer'>
					<div id='browserFilesDiv'><noscript>$files</noscript></div>
					<div id='browserFilesMovableBar'></div>
				</div>
			</div>
			<div id='browserDirListingMovableBar'></div>
		</div>
		<div id='broswerSeparator2Container'>
			<div id='broswerSeparator2' style='$separator2Display'><hr/></div>
			<div id='broswerSeparator2MovableBar'></div>
		</div>
		<div id='browserFunctionsContainer'>
			<div id='browserFunctions'>$functions</div>
			<div id='browserFunctionsMovableBar'></div>
		</div>
		<div id='broswerSeparator3Container'>
			<div id='broswerSeparator3'><hr/></div>
			<div id='broswerSeparator3MovableBar'></div>
		</div>
	</div>
	<div id='browserMovableBar'></div>
</div>
";
		return $html;
	}
	
	function getSystemFiles() {
		$parentCwdRelPath = dirname($this->cwdRelPath);
		if ($parentCwdRelPath === ".") $parentCwdRelPath = "";
		$html = null;
		$html .= "<table id='browserSystemFiles'><tbody>";
		$html .= "<tr id='..' file >";
		$html .= "<td class='systemAttribute'><div id='systemFilename_..'></div></td>";
		$html .= "<td class='systemAttribute'><div id='systemRelPath_..'></div></td>";
		$html .= "<td class='systemAttribute'><div id='systemUrl_..'></div></td>";
		$html .= "<td class='systemAttribute'><div id='systemIsDir_..'></div></td>";
		foreach ($this->moduleManager->attributes as $attribute) {
				$html .= "<td>" . $attribute->getHtmlParentDirectory($parentCwdRelPath, $this->view) . "</td>";
		}
		$html .= "<td class='browserCellFiller'></td>";
		$html .= "</tr></tbody></table>";
		return $html;
	}
	
	// for noscript
	// set cwdRelPath to permittedDir if it is not set
	function getDirListing() {
		$this->cwd = $this->fileManager->getFileByRelPath($this->cwdRelPath);
		if ($this->cwd) {
			if ($this->cwd->isDir) {
				if ($this->cwd->isPermitted) {
					$files = $this->fileManager->getFilesByDir($this->cwd->absPath);
					$html = null;
					if ($this->view === "list") {
						$html .= $this->getFilesViewList($files, false);
					} else if ($this->view === "thumbnail") {
						if (THUMBNAIL_ON) {$html .= $this->getFilesViewThumbnail($files, false);}
						else {$html .= "<center>" . text("THUMBNAIL VIEW IS DISABLED.") . "</center>";}
					}
				} else {
					$html .= "<center>" . text("ACCESS DENIED") . "</center>";
				}
			} else {
				$html .= "<center>" . text("ACCESS DENIED") . "</center>";
			}
		} else {
			$html .= "<center>" . text("ACCESS DENIED") . "</center>";
		}
		return $html;
	}
		
	// show error if $_GET["cwdRelPath"] is not set
	function printDirListing($cwdRelPath) {
		$xml = new Xml();
		if (isset($cwdRelPath)) {
			$this->cwd = $this->fileManager->getFileByRelPath($cwdRelPath);
			if ($this->cwd) {
				if ($this->cwd->isDir) {
					if ($this->cwd->isPermitted) {
						$files = $this->fileManager->getFilesByDir($this->cwd->absPath);
						if ($_GET["view"] === "list" || $_GET["view"] === "thumbnail") {$this->view = $_GET["view"];}
						else {$this->view = "list";}
						$html = null;
						if ($this->view === "list") {
							$html .= $this->getFilesViewList($files, true);
							$xml->setStatusSuccess();
							$xml->setContent($html);
						} else if ($this->view === "thumbnail") {
							//if (THUMBNAIL_ON) {
							if (true) {
								$html .= $this->getFilesViewThumbnail($files, true);
								$xml->setStatusSuccess();
								$xml->setContent($html);								
							} else {
								$xml->setError(text("THUMBNAIL VIEW IS DISABLED."));
							}
						}
					} else {
						$xml->setError(text("ACCESS DENIED"));	
					}
				} else {
					$xml->setError(text("ACCESS DENIED")); //Do not output relevant information.
				}
			} else {
				$xml->setError(text("ACCESS DENIED")); //Do not output relevant information.
			}
		} else {
			$xml->setError(text("ACCESS DENIED"));
		}
		$xml->dump();	
	}

	function printFiles() {
		echo $this->getFiles();
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : File
//------------------------------------------------------------------------------
class File {
	//
	var $absPath;		
	var $basename;		
	var $dirAbsPath;		// Only for regular files
	var $dirRelPath;		// Only for regular files
	var $extension;			// Only for regular files
	var $filename;			// Only for regular files	
	var $isDir;			
	var $isPermitted;
	var $isWithinDocumentRoot;
	var $relPath;
	var $uri;
	var $url;
	// Encoded in OS encoding method
	var $absPathEn;		
	var $basenameEn;		
	var $dirAbsPathEn;		// Only for regular files
	var $dirRelPathEn;		// Only for regular files
	var $extensionEn;		// Only for regular files
	var $filenameEn;		// Only for regular files	
	var $relPathEn;
	var $uriEn;
	var $urlEn;
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : FileManager
//------------------------------------------------------------------------------
// added in 2.0
class FileManager {
	var $user;

	function absPathToRelPath($absPath) {
		$len = strlen($this->user->virtualRootAbsPath);
		if ($len === strlen($absPath)) return "";
		else return substr($absPath, $len);
	}
	
	function addEndingSlash($absDir) {
		if (strlen($absDir) === 0) return "";
		else {
			$lastchar = substr($absDir, -1);
			if ($lastchar !== "/" && $lastchar !== "\\") $absDir .= "/";
			return $absDir;
		}
	}
	
	function changeSlashes($absPath) {
		return str_replace("\\", "/", $absPath);
	}

	function getDir($absPath) {
		$dirAbsPath = dirname($absPath);
		$dirAbsPath = FileManager::changeSlashes($dirAbsPath);
		return FileManager::addEndingSlash($dirAbsPath);		
	}
	
	// A file at $absPath must exist.
	function getFile($absPath) {
		$absPath = realpath($absPath); // to strip ending / if it exists
		$absPath = $this->changeSlashes($absPath);
		$file = new File;
		$file->isDir = is_dir($absPath);
		$path_parts = pathinfo($absPath);
		$file->basename = $path_parts["basename"];
		if (is_dir($absPath)) {
			$file->absPath = $this->addEndingSlash($absPath);
			$file->relPath = $this->absPathToRelPath($file->absPath);
		} else {
			$file->absPath = $absPath;
			$file->relPath = $this->absPathToRelPath($absPath);
			$file->filename = $path_parts["filename"];
			$file->extension = $path_parts["extension"];
		}
		$file->dirAbsPath = $this->getDir($file->absPath);
		$file->dirRelPath = $this->absPathToRelPath($file->dirAbsPath);		
		$file->uri = $this->getUri($file->absPath);
		$file->url = $this->getUrl($file->absPath);
		$file->isWithinDocumentRoot = $this->isWithinDocumentRoot($file->absPath);
		$file->isPermitted = $this->isPermitted($file->absPath);
		$file->absPathEn = Text::convertEncodingToUtf8($file->absPath);
		$file->basenameEn = Text::convertEncodingToUtf8($file->basename);
		$file->dirAbsPathEn = Text::convertEncodingToUtf8($file->dirAbsPath);
		$file->dirRelPathEn = Text::convertEncodingToUtf8($file->dirRelPath);
		$file->extensionEn = Text::convertEncodingToUtf8($file->extension);
		$file->filenameEn = Text::convertEncodingToUtf8($file->filename);	
		$file->relPathEn = Text::convertEncodingToUtf8($file->relPath);
		$file->uriEn = Text::convertEncodingToUtf8($file->uri);
		$file->urlEn = Text::convertEncodingToUtf8($file->url);

		return $file;
	}
	
	function getFileByRelPath($relPath) {
		$absPath = $this->relPathToAbsPath($relPath);
		if ($absPath) return $this->getFile($absPath);
		else return false;
	}
	
	function getFilesByDir($cwdAbsPath) {
		$files = array();
		$dirHandle = opendir($cwdAbsPath);
		# When there is no permission to browse the directory
		if ($dirHandle === false) {
			return false;
		# When there is permission to browse the directory	
		} else {
			while($basename = readdir($dirHandle)) {
				if (!($basename === "." || $basename === "..")) $files[] = $this->getFile($cwdAbsPath . $basename);
			}
		}
		closedir($dirHandle);

		usort($files, array("FileManager", "sortFilesCmp"));
		return $files;
	}
	
	function getParentDir($dirAbsPath) {
		$parentDirAbsPath = dirname($dirAbsPath);
		$parentDirAbsPath = FileManager::changeSlashes($parentDirAbsPath);
		return FileManager::addEndingSlash($parentDirAbsPath);
	}
	
	function getUri($absPath) {
		if (FileManager::isWithinDocumentRoot($absPath)) {
			// Some OS's add an ending slash to paths of directories
			$docRoot = FileManager::addEndingSlash(FileManager::changeSlashes($_SERVER['DOCUMENT_ROOT']));
			if (strlen($absPath) === strlen($docRoot)) return "";
			else return substr($absPath, strlen($docRoot));
		}
		return false;
	}

	// edited in 2.1
	function getUrl($absPath) {
		$uri = FileManager::getUri($absPath);
		
		if ($_SERVER["SERVER_PORT"] !== "80") $port = ":" . $_SERVER["SERVER_PORT"];
		else $port = null;
		
		if ($_SERVER["HTTPS"]) $protocal = "https";
		else $protocal = "http";
		
		if ($uri !== false) return $protocal . "://" . $_SERVER["SERVER_NAME"] . $port . "/" . $uri;
		return false;
	}
	
	function isPermitted($absPath) {
		if (strpos($absPath, $this->user->permittedDirAbsPath) === 0) return true;
		return false;
	}

	function isRelPathExist($relPath) {
		$absPath = realpath($this->user->virtualRootAbsPath . $relPath);
		str_replace("\\", "/", $absPath);
		return (file_exists($absPath));
	}
	
	function isWithinDocumentRoot($absPath) {
		// Some OS's add an ending slash to paths of directories
		$docRoot = FileManager::addEndingSlash(FileManager::changeSlashes($_SERVER['DOCUMENT_ROOT']));
		if (strpos($absPath, $docRoot) === 0) return true;	
		else return false;
	}

	function relPathToAbsPath($relPath) {
		$absPath = realpath($this->user->virtualRootAbsPath . $relPath);
		$absPath = FileManager::changeSlashes($absPath);
		if ($absPath) {
			if (is_dir($absPath)) return FileManager::addEndingSlash($absPath);
			else return $absPath;
		} else {
			return false;
		}
	}

	function relPathsToAbsPaths($relPaths) {
		$absPaths = array();
		foreach ($relPaths as $relPath) {
			$absPath = $this->relPathToAbsPath($relPath);
			$absPaths[$relPath] = $absPath;
		}
		return $absPaths;
	}

	// 2007-12-26
	function removeBeginningSlash($relPath) {
		return ltrim($relPath, "/\\");
	}
	
	function removeDoubleDots($absPath) {
		return str_replace("..", "", $absPath);
	}
	
	function sortFiles($files) {
		usort($files, array("FileManager", "sortFilesCmp"));
	}
	
	function sortFilesCmp($file1, $file2) {
		$basename1 = strtolower($file1->basename);
		$basename2 = strtolower($file2->basename);
		//$basename1 = $file1->basename;
		//$basename2 = $file2->basename;
		if ($basename1 == $basename2) return 0;
		return ($basename1 < $basename2) ? -1 : 1;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Ftp
//------------------------------------------------------------------------------
// added in 2.1
class Ftp {
	var $connId		= null;
	var $password	= FTP_LAYER_PASSWORD;	
	var $path		= FTP_LAYER_PATH_ON_SERVER;
	var $port		= FTP_LAYER_PORT;
	var $server		= FTP_LAYER_HOST;
	var $ssl		= FTP_LAYER_SSL_ON;
	var $timeout	= 60;
	var $username 	= FTP_LAYER_USERNAME;
	
	function Ftp() {
		$this->path = FileManager::changeSlashes($this->path);
		$this->path = FileManager::addEndingSlash($this->path);	
	}

	function absPathToFtpAbsPath($absPath) {
		if ($this->isWithinFtpRoot($absPath)) {
			$len = strlen($this->path);
			if ($len === strlen($absPath)) return "/";
			else return "/" . substr($absPath, $len);
		} else {
			return false;
		}
	}
	
	function chdir($absPath) {
		$this->connect();
		$ftpAbsPath = $this->absPathToFtpAbsPath($absPath);
		if ($ftpAbsPath !== false) {
			return ftp_chdir($this->getConnId(), $ftpAbsPath);
		}
	}
	
	// PHP 5 or above only
	function chmod($absPath, $mode) {
		$ftpAbsPath = $this->absPathToFtpAbsPath($absPath);
		if ($ftpAbsPath !== false) {
			if (!function_exists("ftp_chmod")) {
				return -1;
			}
			
			// ftp_chmod may not work on Windows. PHP 5 shows warning on Windows.
			return ftp_chmod($this->getConnId(), $mode, $ftpAbsPath);
		}
		return false;
	}
	
	function connect() {
		if (!$this->connId) {
			// set up basic connection
			if ($this->ssl) {
				$this->connId = @ftp_ssl_connect($this->server, $this->port, $this->timeout);
			} else {
				$this->connId = @ftp_connect($this->server, $this->port, $this->timeout);
			}
			if (!$this->connId) die("Cannot connect to FTP server");
			
			// login with username and password
			$loginResult = @ftp_login($this->connId, $this->username, $this->password);
			if (!$loginResult) die("Cannot login to FTP server");
		}
		return true;
	}
	
	function copy($srcAbsPath, $desAbsPath) {
		$ftpSrcAbsPath = $this->absPathToFtpAbsPath($srcAbsPath);
		$ftpDesAbsPath = $this->absPathToFtpAbsPath($desAbsPath);
		if ($ftpSrcAbsPath !== false && $ftpDesAbsPath !== false) {
			$result = false;
			$temp = tmpfile();
			if (ftp_fget($this->getConnId(), $temp, $ftpSrcAbsPath, FTP_BINARY, 0)) {
				//fseek($temp, 0); // Content to be uploaded will be content after the pointer
				$result = ftp_fput($this->getConnId(), $ftpDesAbsPath, $temp, FTP_BINARY);
			}
			fclose($temp);
			return $result;
		}
		return false;
	}
	
	function delete($absPath) {
		$ftpAbsPath = $this->absPathToFtpAbsPath($absPath);
		if ($ftpAbsPath !== false) {
			return ftp_delete($this->getConnId(), $ftpAbsPath);
		}
		return false;
	}
	
	function getConnId() {
		$this->connect();
		return $this->connId;
	}
	
	function isWithinFtpRoot($absPath) {
		if (strpos($absPath, $this->path) === 0) return true;	
		else return false;
	}
	
	function mkdir($absPath) {
		$ftpAbsPath = $this->absPathToFtpAbsPath($absPath);
		if ($ftpAbsPath !== false) {
			return ftp_mkdir($this->getConnId(), $ftpAbsPath);
		}
		return false;
	}

	function moveUploadedFile($tmpAbsPath, $desAbsPath) {
		$ftpDesAbsPath = $this->absPathToFtpAbsPath($desAbsPath);
		if ($ftpDesAbsPath !== false) {
			if (is_uploaded_file($tmpAbsPath)) { // to prevent file upload attack
				return ftp_put($this->getConnId(), $ftpDesAbsPath, $tmpAbsPath, FTP_BINARY);
			}
		}
		return false;
	}
	
	function putWithContent($absPath, $content) {
		$ftpAbsPath = $this->absPathToFtpAbsPath($absPath);
		if ($ftpAbsPath !== false) {
			$temp = tmpfile();
			if (fwrite($temp, $content) === false) return false;
			fseek($temp, 0); // Content to be uploaded will be content after the pointer
			$result = ftp_fput($this->getConnId(), $ftpAbsPath, $temp, FTP_BINARY);
			fclose($temp);
			return $result;
		}
		return false;	
	}
	
	function rename($oldAbsPath, $newAbsPath) {
		$this->connect();
		$oldFtpAbsPath = $this->absPathToFtpAbsPath($oldAbsPath);
		$newFtpAbsPath = $this->absPathToFtpAbsPath($newAbsPath);
		if (($oldFtpAbsPath !== false) && ($newFtpAbsPath !== false)) {
			return ftp_rename($this->getConnId(), $oldFtpAbsPath, $newFtpAbsPath);
		}
		return false;
	}
	
	function rmdir($absPath) {
		$ftpAbsPath = $this->absPathToFtpAbsPath($absPath);
		if ($ftpAbsPath !== false) {
			return ftp_rmdir($this->getConnId(), $ftpAbsPath);
		}
		return false;
	}
	
	function touch($absPath) {
		$ftpAbsPath = $this->absPathToFtpAbsPath($absPath);
		if ($ftpAbsPath !== false) {
			$temp = tmpfile();
			$result = ftp_fput($this->getConnId(), $ftpAbsPath, $temp, FTP_BINARY);
			fclose($temp);
			return $result;
		}
		return false;
	}

}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Image
//------------------------------------------------------------------------------
class Image {
	var $file;
	var $height;
	var $image;
	var $type;
	var $width;
	
	function printImage($file) {
		if ($this->setImageByFile($file)) {
			$this->dump();
		} else {
			return false;
		}
	}

	function printThumbnail($file) {
		if ($this->setImageByFile($file)) {
			$this->resize(THUMBNAIL_SIZE);
			$this->dump();
		} else {
			return false;
		}
	}
	
	function setImageByFile($file) {
		$this->file = $file;
		$size = getimagesize($this->file->absPath);
		$this->width = $size[0];
		$this->height = $size[1];
		$this->type = $size[2];
		if ($this->type === IMAGETYPE_JPEG) {
			$this->image = imagecreatefromjpeg($this->file->absPath);
		} else if ($this->type === IMAGETYPE_GIF) {
			$this->image = imagecreatefromgif($this->file->absPath);
		} else if ($this->type === IMAGETYPE_PNG) {
			$this->image = imagecreatefrompng($this->file->absPath);
		} else if ($this->type === IMAGETYPE_WBMP) {
			$this->image = imagecreatefromwbmp($this->file->absPath);
		} else {
			return false;
		}
		return true;
	}
	
	function resize($newSize) {
		$containerRatio = 1; // square
		if ($this->height > $newSize || $this->width > $newSize) {
			$ratio = $this->height / $this->width;
			if ($ratio > $containerRatio) {
				$newWidth = $newSize / $ratio;
				$newHeight = $newSize;			
			} else {
				$newWidth = $newSize;
				$newHeight = $newSize * $ratio;
			}
			$newImage = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $this->width, $this->height);		
			$this->image = $newImage;
		}
	}

	function dump() {
		header("Cache-Control: public");
		header("Content-type: " . image_type_to_mime_type($this->type));
		header('Content-Disposition: attachment; filename="'.$this->file->basename.'"');
		header("Content-Transfer-Encoding: binary\n");					
		if ($this->type === IMAGETYPE_JPEG) {
			imagejpeg($this->image);
		} else if ($this->type === IMAGETYPE_GIF) {
			imagegif($this->image);
		} else if ($this->type === IMAGETYPE_PNG) {
			imagepng($this->image);
		} else if ($this->type === IMAGETYPE_WBMP) {
			imagewbmp($this->image);
		} 
		exit(0);
	}	
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Javascript
//------------------------------------------------------------------------------
class Javascript {
	function getJavascrtipt() {
		$javascript = null;
		$javascript .=
"
var Sdl = {};
//------------------------------------------------------------------------------
Sdl.Ajax = function() {}

Sdl.Ajax.ajaxGet = function(fn, targetLink) {
	var xhr;
	xhr = Sdl.Ajax.initializeAjax();
	if (xhr) {
		//xhr.onerror = Sdl.Ajax.onError; //IE6 doesn't support it.
		xhr.onreadystatechange = function() {
				if(xhr.readyState == 4) {fn(xhr)};
			}
		xhr.open('GET', targetLink, true);
		xhr.send(null);
		return xhr;
	} else {
		return false;
	}
}

Sdl.Ajax.ajaxPost = function(fn, targetLink, param) {
	var xhr
	xhr = Sdl.Ajax.initializeAjax();
	if (xhr) {
		//xhr.onerror = Sdl.Ajax.onError; //IE6 doesn't support it.
		xhr.onreadystatechange = function() {
				if(xhr.readyState == 4) {fn(xhr)};
			}
		xhr.open('POST', targetLink, true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.setRequestHeader('Content-length', param.length);
		xhr.setRequestHeader('Connection', 'close');
		xhr.send(param);
		return xhr;
	} else {
		return false;
	}
}

Sdl.Ajax.initializeAjax = function() {
	var xhr;
	try	{
		xhr = new XMLHttpRequest(); // FF & IE7
	} catch (e) {
		try	{
			xhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
		} catch(e) {
			try	{
				xhr = new ActiveXObject('Microsoft.XMLHTTP');
			} catch(e) {
				alert('" . text("JAVASCRIPT ERROR") . "');
				return false;
			}
		}
	}
	return xhr;
}

Sdl.Ajax.onError = function() {
	alert('" . text("JAVASCRIPT ERROR") . "');
}
//------------------------------------------------------------------------------
Sdl.Browser = function() {
	var this_clone = this;
	this.cacheLocation = null;
	this.caches = [];
	this.cwd = new Sdl.File();
	this.cwdLoading = new Sdl.File();
	this.onLoadListeners = [];
	this.permittedDir = new Sdl.File(); //For reference only. It's not used for permission checking.
	this.status = {};
	this.status.success = false;
	this.view = null;

	this.ajaxActionLoadDirListingPass = function(xhr) {
		this_clone.ajaxActionLoadDirListing(xhr);
	}
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.Browser.prototype = {
	addOnLoadListener : function(fn) {
		this.onLoadListeners.push(fn);
	},

	ajaxActionLoadDirListing : function(xhr) {
		var div, container, dirListing, response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			this.cwd = new Sdl.Object.cloneObject(this.cwdLoading);
			div = document.getElementById('browserFilesDiv');
			if(response.status.success) {
				div.innerHTML = response.content;
				this.status.success = true;
			} else {
				this.status.success = false;
				div.innerHTML = '<center>' + response.error + '</center>';
			}
			
			var cache = {};
			cache.cwd = new Sdl.Object.cloneObject(this.cwd);
			cache.innerHTML = div.innerHTML;
			cache.view = this.view;
			cache.status = new Sdl.Object.cloneObject(this.status);
			this.cacheAdd(cache);
			this.onLoad();
		}
	},
	
	cacheAdd : function(cache) {
		if (this.cacheLocation != null) {
			if (this.caches[this.cacheLocation].cwd.relPath == cache.cwd.relPath) {
				this.caches.splice(this.cacheLocation, 1, cache);
			} else {
				this.caches.splice(this.cacheLocation + 1);
				this.cacheLocation++;
				this.caches.push(cache);
			}
		} else {
			this.cacheLocation = 0;
			this.caches.push(cache);
		}
	},

	cacheBackward : function() {
		if (this.cacheLocation != null) {
			if (this.caches[this.cacheLocation - 1]) {
				this.cacheLoad(this.caches[this.cacheLocation - 1]);
				this.cacheLocation--;
			}
		}		
	},
	
	cacheForward : function() {
		if (this.cacheLocation != null) {
			if (this.caches[this.cacheLocation + 1]) {
				this.cacheLoad(this.caches[this.cacheLocation + 1]);
				this.cacheLocation++;
			}
		}			
	},
	
	cacheLoad : function(cache) {
		var div;
		this.cwd = new Sdl.Object.cloneObject(cache.cwd);
		div = document.getElementById('browserFilesDiv');
		div.innerHTML = cache.innerHTML;
		this.view = cache.view;
		this.status = new Sdl.Object.cloneObject(cache.status);
		this.onLoad();
	},

	getAllFiles : function() {
		var files = [];
		this.traverseAllFiles(function(row) {
			var file = {};
			file.id = row.id;
			file.relPath = document.getElementById('systemRelPath_' + row.id).innerHTML.
			file.filename = document.getElementById('systeFilename_' + row.id).innerHTML.
			files.push(file);
		});
		return files;
	},
	
	getParentDir : function(path) {
		var i, parentDir;
		i = path.lastIndexOf('/', path.length - 2);
		if (i>=0) {parentDir = path.substring(0, i+1);}
		else {parentDir = '';}
		return parentDir;
	},

	loadDirListing : function(cwdRelPath, view) {
		if (view == 'list') {this.view = 'list';}
		else if (view == 'thumbnail') {this.view = 'thumbnail';}
		this.cwdLoading.relPath = cwdRelPath;
		this.cwdLoading.parentDir = this.getParentDir(cwdRelPath);
		Sdl.Ajax.ajaxGet(this.ajaxActionLoadDirListingPass, '?print=dirListing&cwdRelPath=' + encodeURIComponent(this.cwdLoading.relPath) + '&view=' + this.view);
	},
	
	loadDirListingParentDir : function() {
		this.loadDirListing(this.cwd.parentDir);
	},
	
	onClickThumbnailRedirect : function(e, cwdRelPath) {
		Sdl.Event.stopPropagation(e);
		this.loadDirListing(cwdRelPath);
	},
	
	onLoad : function() {
		var headers, len;
		document.title = '/' + this.cwd.relPath + ' - Simple Directory Listing';
		headers = document.getElementById('browserHeaders');
		for (var i = 0 ; i < headers.rows[0].cells.length ; i++) {
			if (this.view == 'thumbnail') {
				headers.rows[0].cells[i].childNodes[0].style.display = 'inline';
			} else if (this.view == 'list') {
				headers.rows[0].cells[i].childNodes[0].style.display = 'block';
			}
		}
		// It is replaced by Sdl.Image.position as an onload listener for thumbnails
		/*
		// For IE6. I don't know how to vertically align img with CSS only in IE6.
		if (Sdl.System.isIe6() && this.view == 'thumbnail') {
			this.traverseAllFiles(function(file) {
				var imgs, marginTop;
				imgs = file.getElementsByTagName('img');
				marginTop = ((" . THUMBNAIL_SIZE . " - imgs[0].offsetHeight ) / 2);
				imgs[0].style.marginTop = marginTop >= 0 ? marginTop + 'px' : '0px';
			});
		}
		*/
		len = this.onLoadListeners.length;
		for (var i = 0 ; i < len ; i++) {
			this.onLoadListeners[i]();
		}
		
	},

	redirectPermittedDir : function() {
		this.loadDirListing(this.permittedDir.relPath);
	},

	reloadDirListing : function() {
		this.loadDirListing(this.cwd.relPath);
	},
	
	removeOnLoadListener : function(fn) {
		var len;
		len = this.onLoadListeners.length;
		for (var i = 0 ; i < len ; i++) {
			if (this.onLoadListeners[i] == fn) {
				this.onLoadListeners.splice(i,1);
				return;
			}
		}				
	},

	setView : function(view) {
		if (view == 'list' && this.view != 'list') {this.loadDirListing(this.cwd.relPath, 'list');}
		else if (view == 'thumbnail' && this.view != 'thumbnail') {this.loadDirListing(this.cwd.relPath, 'thumbnail');}
	},
	
	traverseAllFiles : function(fn) {
		var b, elts, len;
		b = document.getElementById('browserFiles');
		if (b) {
			if (b.tagName == 'TABLE') {
				elts = b.rows;
			} else {
				elts = [];
				for (var i=0 ; i<b.childNodes.length ; i++) {
					if (b.childNodes[i].nodeType == 1 && b.childNodes[i].tagName == 'DIV') {elts.push(b.childNodes[i]);}
				}
			}
			len = elts.length;
			for (var i = 0 ; i < len ; i++) {
				fn(elts[i]);
			}
		}
	},
	
	traverseAllFilesOnAttribute : function(fn, idTag) {
		this.traverseAllFiles(function(elt) {
			var a;
			a = document.getElementById(idTag + '_' + elt.id);
			fn(a, elt);
		});
	},
	
	windowOnLoadListener : function() {
		document.getElementById('browserFilesDiv').innerHTML = '<center>" . text("LOADING") . "</center>';
		this.cwd.relPath = Sdl.Text.decodeHtmlEntity(this.cwd.relPath);
		this.permittedDir.relPath = Sdl.Text.decodeHtmlEntity(this.permittedDir.relPath);
		this.view = Sdl.Text.decodeHtmlEntity(this.view);	
		this.loadDirListing(this.cwd.relPath, this.view);
	}
}
//------------------------------------------------------------------------------
Sdl.Button = function() {}

Sdl.Button.decorateById = function(id) {
	Sdl.Button.decorateByRef(document.getElementById(id));
}

Sdl.Button.decorateByRef = function(elt) {
	Sdl.Object.modifyClassName(elt, 'functionButton', null);
	elt.onmouseout = function() {Sdl.Object.modifyClassName(this, null, 'functionButtonMouseOver');}
	elt.onmouseover = function() {Sdl.Object.modifyClassName(this, 'functionButtonMouseOver', null);}	
}
//------------------------------------------------------------------------------
Sdl.CoverBody = function() {
	Sdl.CoverBody.cover = null;
	Sdl.CoverBody.isCovered = false;
	Sdl.CoverBody.isTextShown = false;
	Sdl.CoverBody.text = null;
}

Sdl.CoverBody.hideCoverBody = function() {
	if (Sdl.CoverBody.isCovered) {
		document.body.removeChild(Sdl.CoverBody.cover);
		Sdl.CoverBody.isCovered = false;
	}
}

Sdl.CoverBody.hideText = function() {
	if (Sdl.CoverBody.isTextShown) {
		document.body.removeChild(Sdl.CoverBody.text);
		Sdl.CoverBody.isTextShown = false;
	}
}

Sdl.CoverBody.modifyText = function(text) {
	if (Sdl.CoverBody.isTextShown) {
		var clientWidth;
		clientWidth = document.documentElement.clientWidth;
		Sdl.CoverBody.text.style.visibility = 'hidden';
		Sdl.CoverBody.text.innerHTML = text;
		Sdl.CoverBody.text.style.left = ((clientWidth - Sdl.CoverBody.text.offsetWidth) / 2) + 'px';
		Sdl.CoverBody.text.style.visibility = 'visible';
	}
}

Sdl.CoverBody.resizeCoverBody = function() {
	if (Sdl.CoverBody.isCovered) {
		var clientHeight, clientWidth, newHeight, newWidth, pageHeight, pageWidth;
		clientWidth = document.documentElement.clientWidth;
		clientHeight = document.documentElement.clientHeight;
		pageWidth = document.body.clientWidth;
		pageHeight = document.body.clientHeight;
		newHeight = clientHeight > pageHeight ? clientHeight : pageHeight;
		newWidth = clientWidth > pageWidth ? clientWidth : pageWidth;
		Sdl.CoverBody.cover.style.height = newHeight + 'px';
		Sdl.CoverBody.cover.style.width = newWidth + 'px';
	}
}

Sdl.CoverBody.resizeText = function() {
	if (Sdl.CoverBody.isTextShown) {
		var clientWidth;
		clientWidth = document.documentElement.clientWidth;
		Sdl.CoverBody.text.style.left = ((clientWidth - Sdl.CoverBody.text.offsetWidth) / 2) + 'px';
	}
}

// For IE. IE6 doesn't support position:fixed.
Sdl.CoverBody.positionText = function() {
	if (Sdl.CoverBody.isTextShown) {
		Sdl.CoverBody.text.style.position = 'absolute';
		Sdl.CoverBody.text.style.top = (document.documentElement.scrollTop + (document.documentElement.clientHeight - Sdl.CoverBody.text.clientHeight) / 2) + 'px';
	}
}

Sdl.CoverBody.showCoverBody = function() {
	if (!Sdl.CoverBody.isCovered) {
		var newHeight, newWidth, clientHeight, clientWidth, pageHeight, pageWidth;
		clientWidth = document.documentElement.clientWidth;
		clientHeight = document.documentElement.clientHeight;
		pageWidth = document.body.clientWidth;
		pageHeight = document.body.clientHeight;
		newHeight = clientHeight > pageHeight ? clientHeight : pageHeight;
		newWidth = clientWidth > pageWidth ? clientWidth : pageWidth;
		Sdl.CoverBody.cover = document.createElement('div');
		Sdl.CoverBody.cover.className = 'coverBody';
		Sdl.CoverBody.cover.style.height = newHeight + 'px';
		Sdl.CoverBody.cover.style.width = newWidth + 'px';
		document.body.appendChild(Sdl.CoverBody.cover);
		Sdl.CoverBody.isCovered = true;
	}
}

Sdl.CoverBody.showText = function(text) {
	if (!Sdl.CoverBody.isTextShown) {
		var clientWidth;
		clientWidth = document.documentElement.clientWidth;
		Sdl.CoverBody.text = document.createElement('div');
		Sdl.CoverBody.text.className = 'coverBodyText';
		Sdl.CoverBody.text.innerHTML = text;
		document.body.appendChild(Sdl.CoverBody.text);
		Sdl.CoverBody.text.style.left = ((clientWidth - Sdl.CoverBody.text.offsetWidth) / 2) + 'px';
		Sdl.CoverBody.isTextShown = true;
	}
}
//------------------------------------------------------------------------------
Sdl.Css = function() {}

Sdl.Css.changeAttribute = function(className, attribute, value) {
	for (var i = 0; i < document.styleSheets.length; i++){
		for (var j = 0; j < document.styleSheets[i]['cssRules'].length; j++) {
			if (document.styleSheets[i]['cssRules'][j].selectorText == className) {
				document.styleSheets[i]['cssRules'][j].style[attribute] = value;
			}
		}
	}
}
//------------------------------------------------------------------------------
Sdl.Event = function() {}

Sdl.Event.addEventListener = function(target, event, fn) {
	if (target.addEventListener) {target.addEventListener(event, fn, false);}
	else if (target.attachEvent) {target.attachEvent('on' + event, fn);}
}

Sdl.Event.addWindowOnLoadListener = function(fn) {
	Sdl.Event.addEventListener(window,'load',fn);
}

Sdl.Event.disableSelection = function(elt) {
	elt.onselectstart = function() {return false;};
	elt.style.MozUserSelect = 'none';
}

Sdl.Event.removeEventListener = function(target, event, fn) {
	if (target.removeEventListener) {target.removeEventListener(event, fn, false);}
	else if (target.detachEvent) {target.detachEvent('on' + event, fn);}		
}

Sdl.Event.stopPropagation = function(e) {
	if (e.stopPropagation) {e.stopPropagation();}
	else {e.cancelBubble = true;}		
}
//------------------------------------------------------------------------------
Sdl.File = function() {
	this.filename = null;
	this.id = null;
	this.isDir = null;
	this.relPath = null;
}
//------------------------------------------------------------------------------
Sdl.FileContainer = function() {
	var this_clone = this;
	this.fileContainer = null;
	this.files = [];
	this.select = null;
	this.acceptedFileType = 1; //1=files/dirs, 2=files only, 3=dirs only
	
	this.onClickAddPass = function() {
		this_clone.onClickAdd();
	}
	
	this.onClickRemovePass = function() {
		this_clone.onClickRemove();
	}

	this.onClickResetPass = function() {
		this_clone.onClickReset();
	}
}

Sdl.FileContainer.prototype = {
	addFile : function(file) {
		if(!this.isFileExist(file)) {
			if(this.acceptedFileType == 2 && file.isDir) {
				alert('Cannot add directory. ' + file.relPath + ' is a directory.');
				return;
			}
			if(this.acceptedFileType == 3 && !file.isDir) {
				alert('Directory only. ' + file.relPath + ' is not a directory.');
				return;
			}
			this.files.push(file);
			this.addOption(this.select, file.relPath);
			this.updateNumber();
		}		
	},

	addFiles : function(files) {
		var len;
		len = files.length;
		for(var i = 0 ; i < len ; i++) {
			this.addFile(files[i]);
		}
	},
	
	addOption : function(select, text) {
		var o;
		o = document.createElement('option');
		o.text = text;
		try	{select.add(o, null);}
		catch (ex) {select.add(o);}
		return o;
	},
	
	isFileExist : function(file) {
		var exist, len;
		len = this.files.length;
		exist = false;
		for(var i = 0 ; i < len ; i++) {
			if(file.relPath == this.files[i].relPath) {	
				exist = true;
				break;
			}
		}
		return exist;	
	},

	onClickAdd : function() {
		var selectedFiles;
		selectedFiles = Sdl.ModuleSelector.main.getSelectedFilesAndWarn();
		if (selectedFiles && selectedFiles.length > 0) {this.addFiles(selectedFiles);}		
	},
	
	onClickRemove : function() {
		var index;
		index = this.select.selectedIndex;
		if(index>0) {this.removeFile(index);}
	},

	onClickReset : function() {
		var len;
		len = this.select.length;
		for (var i = len - 1 ; i > 0 ; i--) {
			this.removeFile(i);
		}
	},
	
	removeFile : function(index) {
		this.select.remove(index);
		this.files.splice(index-1, 1);
		if (index < this.select.length) {this.select.selectedIndex = index;}
		else {this.select.selectedIndex = index - 1;}
		this.updateNumber();	
	},
	
	setFileContainer : function(fc) {
		this.fileContainer = fc;
		this.add = document.createElement('input');
		//this.add.value = '" . text("ADD") . "';
		this.add.type = 'button';
		this.add.onclick = this.onClickAddPass;
		this.remove = document.createElement('input');
		//this.remove.value = '" . text("REMOVE") . "';
		this.remove.type = 'button';
		this.remove.onclick = this.onClickRemovePass;
		this.reset = document.createElement('input');
		//this.reset.value = '" . text("RESET") . "';
		this.reset.type = 'button';
		this.reset.onclick = this.onClickResetPass;
		this.select = document.createElement('select');
		this.select.style.width = '6em'; // Safari 3 beta occupies a longer select box.
		// IE6 doesn't expand items when a select box is clicked.
		if (Sdl.System.isIe6()) {
			this.select.style.width = '30em';
		}
		this.addOption(this.select, '0 " . text("FILES") . "');
		this.fileContainer.appendChild(this.select);
		this.fileContainer.appendChild(this.add);
		this.fileContainer.appendChild(this.remove);
		this.fileContainer.appendChild(this.reset);
		// For Opera 9.21. It can't set values to input buttons before they are added to DOM.
		this.add.value = '" . text("ADD") . "';
		this.remove.value = '" . text("REMOVE") . "';
		this.reset.value = '" . text("RESET") . "';
	},
	
	updateNumber : function() {
		this.select.options[0].text = this.files.length + ' " . text("FILES") . "';
	}
}
//------------------------------------------------------------------------------
Sdl.Image = function() {
	var this_clone = this;
	this.img = null;
	this.intervalId = null;
	this.originalHeight = null;
	this.originalWidth = null;
	this.success = false;
	
	this.checkCompletePass = function() {
		this_clone.checkComplete();
	}
	
	this.onClickShowPass = function(e, relPath) {
		this_clone.onClickShow(e, relPath);
	}
	
	this.onErrorPass = function() {
		this_clone.onError();
	}
	
	this.onLoadPass = function() {
		this_clone.onLoad();
	}
}

Sdl.Image.prototype = {
	// For Opera 9.21. zero byte image does not go to onerror
	// It isn't used.
	checkComplete : function() {
		if (this.img.complete) { 
			if (!this.success) {Sdl.CoverBody.modifyText('". text("INVALID IMAGE FORMAT") ."');}
			window.clearInterval(this.intervalId);
		}
	},
		
	onClickShowByRelPath : function(e, relPath) {
		this.showByRelPath(relPath);
		Sdl.Event.stopPropagation(e);
	},

	onClickShowByUrl : function(e, url) {
		this.showByUrl(url);
		Sdl.Event.stopPropagation(e);
	},
	
	onError : function() {
		Sdl.CoverBody.modifyText('Invalid image format.');
		//window.clearInterval(this.intervalId);
	},
	
	onLoad : function() {
		this.success = true;
		this.originalHeight = this.img.offsetHeight;
		this.originalWidth = this.img.offsetWidth;	
		this.resize();
		Sdl.CoverBody.hideText();
		this.img.style.visibility = 'visible';
	},
	
	// For IE. IE6 doesn't support position:fixed.
	position : function() {
		this.img.style.position = 'absolute';
		this.img.style.top = document.documentElement.scrollTop + 'px';
	},
	
	resize : function() {
		if (this.success) {
			var imgHeight, imgWidth, newHeight, newWidth, screenHeight, screenWidth;
			screenHeight = document.documentElement.clientHeight < document.body.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight;
			screenWidth = document.documentElement.clientWidth < document.body.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth;
			imgHeight = this.originalHeight;
			imgWidth = this.originalWidth;
			if (imgHeight > screenHeight || imgWidth > screenWidth) {
				var imgRatio, screenRatio;
				imgRatio = imgHeight / imgWidth;
				screenRatio = screenHeight / screenWidth;
				if (imgRatio > screenRatio) {
					newHeight = screenHeight;
					newWidth = newHeight / imgRatio;
				} else {
					newWidth = screenWidth;
					newHeight = newWidth * imgRatio;
				}
			} else {
				newHeight = imgHeight;
				newWidth = imgWidth;
			}
			this.img.style.height = newHeight + 'px';
			this.img.style.width = newWidth + 'px';	
		}
	},
	
	show : function(url) {
		var width1, height1;
		width1 = document.documentElement.clientWidth;
		height1 = document.documentElement.clientHeight;
		this.success = false;
		this.img = document.createElement('img');
		this.img.style.visibility = 'hidden';
		this.img.className = 'image';
		this.img.onload = this.onLoadPass;
		this.img.onerror = this.onErrorPass;
		document.body.appendChild(this.img);
		Sdl.CoverBody.showCoverBody();
		Sdl.CoverBody.showText('Loading');
		if (Sdl.System.isIe6()) {
			this.position(); // For IE. IE6 doesn't support position:fixed.
			Sdl.CoverBody.positionText(); // For IE. IE6 doesn't support position:fixed.
			Sdl.CoverBody.resizeText(); // For IE. IE6 doesn't support position:fixed.
		}
		this.img.src = url;
		//this.intervalId = window.setInterval(this.checkCompletePass, 500);
		var this_clone_tmp = this;
		window.onresize = function() {
			this_clone_tmp.resize();
			if (Sdl.System.isIe6()) {
				this_clone_tmp.position(); // For IE. IE6 doesn't support position:fixed.
				Sdl.CoverBody.positionText(); // For IE. IE6 doesn't support position:fixed.
			}
			Sdl.CoverBody.resizeCoverBody();
			Sdl.CoverBody.resizeText();			
		}
		if (Sdl.System.isIe6()) {
			window.onscroll = function() {
				this_clone_tmp.position(); // For IE. IE6 doesn't support position:fixed.
				Sdl.CoverBody.positionText(); // For IE. IE6 doesn't support position:fixed.
			}
		}
		document.onmousedown = function() {
			//window.clearInterval(this_clone_tmp.intervalId);
			document.body.removeChild(this_clone_tmp.img);
			document.onmousedown = null;
			window.onresize = null;
			if (Sdl.System.isIe6()) {
				window.onscroll = null; // For IE. IE6 doesn't support position:fixed.
			}
			Sdl.CoverBody.hideCoverBody();
			Sdl.CoverBody.hideText();
			this_clone_tmp.img = null;
			return false;
		}
	},

	showByRelPath : function(relPath) {
		this.show('?print=image&relPath=' + relPath);
	},

	showByUrl : function(url) {
		this.show(url);
	}
}

// For IE6. I don't know how to vertically align img with CSS only in IE6.
Sdl.Image.position = function(img) {
	if (Sdl.System.isIe6()) {
		var marginTop;
		marginTop = ((" . THUMBNAIL_SIZE . " - img.offsetHeight ) / 2);
		img.style.marginTop = marginTop >= 0 ? marginTop + 'px' : '0px';
	}
}
//------------------------------------------------------------------------------
Sdl.Layout = function() {
	var this_clone = this;
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.Layout.prototype = {
	windowOnLoadListener : function() {
		document.getElementById('font').style.display = 'inline';
	}
}

Sdl.Layout.changeFontSize = function(num) {
	var fontSize;
	fontSize = document.body.style.fontSize;
	if (fontSize) {document.body.style.fontSize = parseInt(fontSize.substring(0, fontSize.length - 2)) + num + 'px';}
	else {document.body.style.fontSize = " . FONT_SIZE . " + num + 'px';}
}

Sdl.Layout.increaseFontSize = function() {
	Sdl.Layout.changeFontSize(1);
}

Sdl.Layout.decreaseFontSize = function() {
	Sdl.Layout.changeFontSize(-1);
}
//------------------------------------------------------------------------------
Sdl.MovableBar = function() {
	var this_clone = this;
	this.div = null;
	this.isCovered = false;
	this.isDefaultLocked = null;
	this.lock = null;
	this.unlockType = 'auto';
	this.movableBar = null;
	this.moveTarget = null;
	
	this.onClickLock = function(e) {
		e = e || event;
		if (this_clone.lock.checked) {
			this_clone.moveTarget.style.height = this_clone.moveTarget.offsetHeight + 'px';
		} else {
			if (this_clone.unlockType == 'scrollHeight') {this_clone.moveTarget.style.height = this_clone.moveTarget.scrollHeight + 'px';}
			else {this_clone.moveTarget.style.height = 'auto';}
		}
		Sdl.Event.stopPropagation(e);
	}
	
	this.onMouseDown = function(e) {
		var oldY, oldHeight;
		e = e || event;
		oldY = e.pageY ? e.pageY : e.clientY + document.documentElement.scrollTop + document.body.scrollTop;
		oldHeight = this_clone.moveTarget.offsetHeight;
		this_clone.movableBar.onmouseout = null;
		this_clone.movableBar.onmouseover = null;
		document.onselectstart = function(e) {return false;}
		document.onmousedown = function(e) {return false;}
		//document.body.style.MozUserSelect = 'none';
		document.onmousemove = function(e) {
			var lock, newY, newHeight, diff;
			this_clone.lock.checked = true;
			e = e || event;
			newY = e.pageY ? e.pageY : e.clientY + document.documentElement.scrollTop + document.body.scrollTop;
			diff = newY - oldY;
			newHeight = oldHeight + diff;
			if (newHeight >= 0 ) {
				this_clone.moveTargetHeight = newHeight;
				this_clone.moveTarget.style.height = newHeight + 'px';
			}
		};		
		document.onmouseup = function(e) {
			document.body.onselectstart = null;
			document.onmousemove = null;
			document.onmousedown = null;
			this_clone.movableBar.onmouseout = this_clone.onMouseOut;
			this_clone.movableBar.onmouseover = this_clone.onMouseOver;
			this_clone.onMouseOut(e);
		};
	}
	
	this.onMouseOut = function() {
		Sdl.Object.modifyClassName(this_clone.movableBar, null, 'movableBarMouseOver')
	}
		
	this.onMouseOver = function() {
		Sdl.Object.modifyClassName(this_clone.movableBar, 'movableBarMouseOver', null)
	}
}

Sdl.MovableBar.prototype = {
	setMoveTarget : function(t) {
		//It would make body have no x-scroll
		//t.style.overflowY = 'auto';
		this.moveTarget = t;
		// IE6 retrieved incorrect .offsetHeight if there is no border in this case.
		if (Sdl.System.isIe6()) {
			Sdl.Object.modifyClassName(this.moveTarget, 'moveTargetIe6', null);
		}
	},
	
	setup : function() {
		var content, locked, sign;
		this.movableBar = document.createElement('div');
		Sdl.Object.modifyClassName(this.movableBar, 'movableBar', null)
		this.movableBar.onmouseover = this.onMouseOver;
		this.movableBar.onmouseout = this.onMouseOut;
		this.movableBar.onmousedown = this.onMouseDown;
		sign = document.createElement('div');
		sign.innerHTML = '------';
		sign.className = 'movableBarSign';
		content = document.createElement('div');
		content.className = 'movableBarContent';
		this.lock = document.createElement('input');
		this.lock.style.cursor = 'default';
		this.lock.type = 'checkbox';
		this.lock.onclick = this.onClickLock;
		this.lock.tabIndex = -1;
		locked = document.createTextNode('Locked');
		content.appendChild(this.lock);
		content.appendChild(locked);
		this.movableBar.appendChild(sign);
		this.movableBar.appendChild(content);
		// Properties/status change must be done after elements are added to DOM
		this.lock.checked = this.isDefaultLocked;
	}
}
//------------------------------------------------------------------------------
Sdl.Object = function() {}

Sdl.Object.cloneObject = function(obj) {
	for (i in obj) {
		if (typeof obj[i] == 'object') {this[i] = new Sdl.Object.cloneObject(obj[i]);}
		else {this[i] = obj[i];}
	}
}

Sdl.Object.modifyClassName = function(elt, add, remove) {
	var classNames, len, newClassName = '';
	classNames = elt.className.split(' ');
	len = classNames.length;
	for (var i = 0 ; i < len ; i++) {
		if (classNames[i] != remove && classNames[i] != add) {
			newClassName += classNames[i] + ' ';
		}
	}
	if (add) {
		newClassName += add;
	}
	elt.className = newClassName;
	//alert(elt.className);
}
//------------------------------------------------------------------------------
Sdl.Page = function() {
	var this_clone = this;
	this.content = null;
	this.contentContainer = null;
	this.movableBar = new Sdl.MovableBar();
	this.resizableElement = null;
	this.tabContent = null;
	this.tab = null;
		
	this.onClickTab = function() {
		Sdl.pageManager.switchPage(this_clone);	
	}
	
	this.onClickTabRemove = function(e) {
		/* e.stopPropagation is for Safari 3 beta, after this page is removed, this clicking bubbles to
		switching tab again. This doesn't happer in FF and IE since this page
		should have been deleted from DOM. */
		Sdl.Event.stopPropagation(e || event);
		
		Sdl.pageManager.removePage(this_clone);
	}
}

Sdl.Page.prototype = {
	hideContent : function() {
		this.contentContainer.style.display = 'none';
	},
	
	showContent : function() {
		this.contentContainer.style.display = 'block';
	},
	
	focusTab : function() {
		Sdl.Object.modifyClassName(this.tab, 'tabFocus', null);
	},
	
	blurTab : function() {
		Sdl.Object.modifyClassName(this.tab, null, 'tabFocus');
	}
}
//------------------------------------------------------------------------------
Sdl.PageManager = function() {
	var this_clone = this;
	this.currentPage = null;
	this.pages = [];

	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.PageManager.prototype = {
	addContent : function(page) {
		var pages;
		pages = document.getElementById('pages');
		page.contentContainer = document.createElement('div');
		page.contentContainer.style.display = 'none';
		page.contentContainer.appendChild(page.content);
		pages.appendChild(page.contentContainer);
	},
	
	addMovableBar : function(page) {
		page.movableBar.setup();
		page.contentContainer.appendChild(page.movableBar.movableBar);	
	},
	
	addPage : function(page) {
		this.pages.push(page);
		this.addContent(page);
		this.addTab(page);
		this.addMovableBar(page);
		this.switchPage(page);
		this.showHideTabs();
	},
	
	addTab : function(page, removable) {
		var tabContentContainer, tabs;
		tabs = document.getElementById('tabs');
		tabContentContainer = document.createElement('div');
		page.tab = document.createElement('div');
		Sdl.Object.modifyClassName(page.tab, 'tab', null);
		page.tab.onclick = page.onClickTab;
		tabContentContainer.style.cssFloat = 'left';
		tabContentContainer.style.styleFloat = 'left';
		tabContentContainer.appendChild(page.tabContent);
		page.tab.appendChild(tabContentContainer);
		if (removable != false) {
			var remove, removeDiv;
			removeDiv = document.createElement('div');
			remove = document.createElement('img');
			remove.src = '?print=icon&icon=cross';
			remove.alt = '[x]';
			remove.align = 'middle';
			remove.style.verticalAlign = 'middle';
			removeDiv.style.cssFloat = 'left';
			removeDiv.style.styleFloat = 'left';
			remove.onclick = page.onClickTabRemove;
			removeDiv.appendChild(remove);
			page.tab.appendChild(removeDiv);
		}
		tabs.appendChild(page.tab);
	},

	removePage : function(page) {
		var pages, tabs;
		tabs = document.getElementById('tabs');
		pages = document.getElementById('pages');
		tabs.removeChild(page.tab);
		pages.removeChild(page.contentContainer);
		var i = 0, len = this.pages.length;
		for (i ; i < len ; i++) {
			if (this.pages[i] == page) {
				if (this.currentPage == page) {
					if (this.pages[parseInt(i)+1]) {this.switchPage(this.pages[parseInt(i)+1]);}
					else {this.switchPage(this.pages[parseInt(i)-1]);}
				}
				this.pages.splice(i, 1);
				break;
			}
		}
		this.showHideTabs();
	},

	removeTab : function(id) {
		var tabs = document.getElementById('tabs');
		for (var i in tabs.childNodes) {
			if (tabs.childNodes[i].id == id) {
				tabs.removeChild(tabs.childNodes[i]);
				break;
			}
		}
		for (var i in this.pages) {
			if (this.tabs[i] == id) {
				this.tabs.splice(i, 1);
				break;
			}
		}			
	},
	
	showHideTabs : function() {		
		if (this.pages.length > 1) {
			document.getElementById('tabs').style.display = 'block';
			document.getElementById('pages').className = 'pagesSideBoxTopExist';
		} else {
			var sideBoxTopHeight;
			document.getElementById('tabs').style.display = 'none';
			sideBoxTopHeight = document.getElementById('containerSideBoxTopContainerCell').offsetHeight;
			if (sideBoxTopHeight > 0) {document.getElementById('pages').className = 'pagesSideBoxTopExist';}
			else {document.getElementById('pages').className = 'pagesSideBoxTopNotExist';}
		}
	},
	
	switchPage : function(page) {
		if (this.currentPage) {
			this.currentPage.hideContent();
			this.currentPage.blurTab();
			/*
			for (var i in this.pages) {
				this.pages[i].hideContent();
			}
			*/
		}
		page.showContent();
		page.focusTab();
		this.currentPage = page;
	},

	windowOnLoadListener : function() {
		var page, tabContent;
		this.showHideTabs();
		page = new Sdl.Page();
		page.contentContainer = document.getElementById('browserContainer');
		tabContent = document.createElement('div');
		tabContent.innerHTML = 'Browser';
		page.tabContent = tabContent;
		page.movableBar.moveTarget = document.getElementById('browserFilesContainer');
		// IE6 retrieved incorrect .offsetHeight if there is no border in this case.
		if (Sdl.System.isIe6()) {
			Sdl.Object.modifyClassName(page.movableBar.moveTarget, 'moveTargetIe6', null);
		}
		this.addTab(page, false);
		this.pages.push(page);
		this.addMovableBar(page);
		this.switchPage(page);
		Sdl.browser.page = page;
		this.showHideTabs();
	}
}
//------------------------------------------------------------------------------
Sdl.Rss = function() {
	var this_clone = this;
	
	Sdl.browser.addOnLoadListener(function() {this_clone.browserOnLoadListener();});
}

Sdl.Rss.prototype = {
	browserOnLoadListener : function() {
		var rss;
		rss = document.getElementById('rss');
		if (Sdl.browser.status.success && Sdl.browser.cwd) {rss.href = '?print=rss&cwdRelPath=' + Sdl.browser.cwd.relPath;}
		else {rss.removeAttribute('href');}
	}
}
//------------------------------------------------------------------------------
Sdl.Main = function() {
	Sdl.browser		= new Sdl.Browser(); // Must be on top
	Sdl.image 		= new Sdl.Image();
	Sdl.layout 		= new Sdl.Layout();
	Sdl.movableBar	= new Sdl.MovableBar();
	Sdl.pageManager = new Sdl.PageManager();
	Sdl.rss			= new Sdl.Rss();
	Sdl.sfs			= new Sdl.Sfs();
	Sdl.sort		= new Sdl.Sort();
	Sdl.sortManager = new Sdl.SortManager();
}
//------------------------------------------------------------------------------
Sdl.Sfs = function() {
	var this_clone = this;
	
	Sdl.browser.addOnLoadListener(function() {this_clone.browserOnLoadListener();});
}

Sdl.Sfs.prototype = {
	browserOnLoadListener : function() {
		var sfs;
		sfs = document.getElementById('sfs');
		if (Sdl.browser.status.success && Sdl.browser.cwd) {sfs.href = '?print=sfs&cwdRelPath=' + Sdl.browser.cwd.relPath;}
		else {sfs.removeAttribute('href');}
	}
}
//------------------------------------------------------------------------------
Sdl.Sort = function() {
	var this_clone = this;
	this.pos = null;
	this.sortSign = null;
	
	this.sortOnClick = function() {
		this_clone.order = -this_clone.order;
		this_clone.sort();
		Sdl.sortManager.sort = this_clone;
	}
	
	this.sortLiteral = function(a, b) {
		if (a.sortValue.toLowerCase() > b.sortValue.toLowerCase()) {return this_clone.order;}
		//if (a.sortValue > b.sortValue) {return this_clone.order;}
		else {return -this_clone.order;}
	}

	this.sortNumeric = function(a, b) {
		if (parseInt(a.sortValue, 10) > parseInt(b.sortValue, 10)) {return this_clone.order;}
		else {return -this_clone.order;}
	}
}

Sdl.Sort.prototype = {
	setDefaultOrder : function(order) {
		this.order = order;
	},

	setSortButton : function(button) {
		Sdl.Object.modifyClassName(button, 'sortHeader', null);
		button.onclick = this.sortOnClick;
		button.onmouseover = function() {Sdl.Object.modifyClassName(this, 'sortHeaderMouseOver', null);}
		button.onmouseout = function() {Sdl.Object.modifyClassName(this, null, 'sortHeaderMouseOver');}
	},

	sort : function() {
		var files = [], refs = [];
		Sdl.browser.traverseAllFilesOnAttribute(function(a, file) {
			var arr = {};
			arr.sortValue = a.innerHTML;
			arr.clone = file.cloneNode(true);
			arr.file = file;
			files.push(arr);
			refs.push(file);
		}, this.attribute);
		if (files.length > 0) {	
			var len, parentNode;
			if (this.type == 'literal') {files.sort(this.sortLiteral);}
			else if (this.type == 'numeric'){files.sort(this.sortNumeric);}
			parentNode = refs[0].parentNode;
			len = refs.length;
			for (var i = 0 ; i < len ; i++) {
				parentNode.appendChild(files[i].file);
			}
		}
	}
}

Sdl.SortManager = function() {
	var this_clone = this;
	this.defaultSort = null;
	
	Sdl.browser.addOnLoadListener(function() {this_clone.browserOnLoadListener();});
}

Sdl.SortManager.prototype = {
	browserOnLoadListener : function() {
		if (Sdl.browser.status.success) {
			if (this.defaultSort != null) {
				this.defaultSort.sort();
			}
		}
	}
}
//------------------------------------------------------------------------------
Sdl.System = {};

Sdl.System.isIe6 = function() {
	if (navigator.userAgent.toLowerCase().indexOf('msie 6') != -1) {return true;}
}

Sdl.System.isOpera = function() {
	if (navigator.userAgent.toLowerCase().indexOf('opera') != -1) {return true;}
}

Sdl.System.isFf1 = function() {
	if (navigator.userAgent.toLowerCase().indexOf('gecko') != -1 && navigator.userAgent.toLowerCase().indexOf('rv:1.7') != -1) {return true;}
}
//------------------------------------------------------------------------------
Sdl.Text = function() {}

Sdl.Text.decodeHtmlEntity = function(text) {
	text = text.replace('&amp;', '&');
	text = text.replace('&lt;', '<');
	text = text.replace('&gt;', '>');
	return text;
}

Sdl.Text.encodeHtmlEntity = function(text) {
	text = text.replace('&', '&amp;');
	text = text.replace('<', '&lt;');
	text = text.replace('>', '&gt;');
	return text;
}
//------------------------------------------------------------------------------
Sdl.Xml = function() {}

Sdl.Xml.digestResponseXml = function(xhr) {
	var container, nodes, response = {};
	if (!xhr) {
		response.valid = false;
		response.debug = '" . text("ERROR") . " : Sdl.Ajax';
		return response;	
	}
	if (xhr.responseXML == null) {
		response.valid = false;
		response.debug = xhr.responseText.substr(0, " . DEBUG_XML_RESPONSE_LENGTH . ");
		return response;
	}
	container = xhr.responseXML.documentElement;
	if (!container || container.tagName != 'container') {
		response.valid = false;
		response.debug = xhr.responseText.substr(0, " . DEBUG_XML_RESPONSE_LENGTH . ");
		return response;	
	}
	response.valid = true;
	response.status = {};
	nodes = container.getElementsByTagName('error')[0].childNodes;
	response.error = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('status')[0].childNodes;
	response.status.text = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('content')[0].childNodes;
	if (nodes[0]) {
		response.contentNodes = nodes;
		response.content = '';
		for (var i = 0 ; i < nodes.length ; i++) {
			response.content += nodes[i].nodeValue;
		}
	} else {
		response.content = null;
	}
	nodes = container.getElementsByTagName('debug')[0].childNodes;
	response.debug = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('message')[0].childNodes;
	response.message = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('warning')[0].childNodes;
	response.warning = nodes[0] ? nodes[0].nodeValue : null;
	if (response.status.text != null) {
		if (response.status.text == 'success') {
			response.status.success = true;
		} else if (response.status.text == 'error') {
			response.status.success = false;
		} else {
			response.status.success = null;
		}
	} else {
		response.status.success = null;
	}
	return response;
}

Sdl.Xml.validateResponseAndWarn = function(response) {
	if (response.valid) {
		return true;
	} else {
		alert('" . text("ERROR") . " : " . text("INCORRECT XML RESPONSE") . ".\\n" . text("DEBUG") . " : \\n' + response.debug);
		return false;
	}
}

Sdl.Xml.alertResponse = function(response) {
	if (response.status.success != null) {
		if (response.status.success == true) {
			if(response.message) {alert(response.message);}
			if(response.warning) {alert('" . text("WARNING") . " : ' + response.warning);}
		} else if (response.status.success == false){
			alert('" . text("ERROR") . " : ' + response.error);
		}
	} else {
		alert('" . text("ERROR") . " : " . text("UNKNOWN RESPONSE STATUS") . "');
	}
}
//------------------------------------------------------------------------------
Sdl.main = new Sdl.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Layout
//------------------------------------------------------------------------------
class Layout {
	var $cwdRelPath;
	var $footer;
	var $logout;
	var $pageBrowser;
	var $permittedDirRelPath;
	var $sideBoxBottom;
	var $sideBoxLeft;
	var $sideBoxRight;
	var $sideBoxTop;
	var $view;
	
	function getHtml() {
		$this->cwdRelPath = addslashes($this->cwdRelPath);
		if (!$this->sideBoxBottom) {$sideBoxBottomDisplay = "display:none;";}
		if (!$this->sideBoxLeft) {$sideBoxLeftDisplay = "display:none;";}
		if (!$this->sideBoxRight) {$sideBoxRightDisplay = "display:none;";}
		if (!$this->sideBoxTop) {
			$sideBoxTopDisplay = "display:none;";
			$pagesClass = "pagesSideBoxTopNotExist";
		} else {
			$pagesClass = "pagesSideBoxTopExist";
		}
		$html = null;
		$html .=
"		
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
<html>
	<head>
		<link rel='stylesheet' type='text/css' href='?print=css' />
		<meta name='keywords' content='simple, directory, listing, $this->title'></meta>
		<script type='text/javascript' src='?print=javascript'></script>
		<script type='text/javascript'>
			Sdl.browser.cwd.relPath = '$this->cwdRelPath';
			Sdl.browser.view = '$this->view';
			Sdl.browser.permittedDir.relPath = '$this->permittedDirRelPath';
		</script>
		<title>$this->title</title>
	</head>
	<body>
	<div id='body'>
		<div id='containerContainer'>
			<table id='container'>
				<tbody>
					<tr>
						<td class='containerCell' id='containerSideBoxLeftContainerCell' rowspan='3' style='{$sideBoxLeftDisplay}'>
							<div id='containerSideBoxLeftContainer'>
								<div id='containerSideBoxLeft'>$this->sideBoxLeft</div>
								<div id='containerSideBoxLeftMovableBar'></div>
							</div>
						</td>
						<td height='1px' class='containerCell' id='containerSideBoxTopContainerCell' colspan='2' style='{$sideBoxTopDisplay}'>
							<div id='containerSideBoxTopContainer'>
								<div id='containerSideBoxTop'>$this->sideBoxTop</div>
								<div id='containerSideBoxTopMovableBar'></div>
							</div>
						</td>
					</tr>
					<tr>
						<td class='containerCell' id='containerCentralContainerCell'>
							<div id='containerCentralContainer'>
								<div id='containerCentral'>
									<div id='tabsContainer'>
										<div id='tabs'></div>
										<div id='tabsMovableBar'></div>
									</div>
									<div id='pagesContainer'>
										<div id='pages' class='$pagesClass'>$this->pageBrowser</div>
										<div id='pagesMovableBar'></div>
									</div>
								</div>
								<div id='containerCentralMovableBar'></div>
							</div>
						</td>
						<td class='containerCell' id='containerSideBoxRightContainerCell' style='{$sideBoxRightDisplay}'>
							<div id='containerSideBoxRightContainer'>
								<div id='containerSideBoxRight'>$this->sideBoxRight</div>
								<div id='containerSideBoxRightMovableBar'></div>
							</div>
						</td>
					<tr>
						<td height='1px' class='containerCell' id='containerSideBoxBottomContainerCell' colspan='2' style='{$sideBoxBottomDisplay}'>
							<div id='containerSideBoxBottomContainer'>
								<div id='containerSideBoxBottom'>$this->sideBoxBottom</div>
								<div id='containerSideBoxBottomMovableBar'></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div id='containerMovableBar'></div>
		</div>
		$this->footer
	</div>
	</body>
</html>
";
		return $html;	
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Locale
//------------------------------------------------------------------------------
class Locale {
	var $text;
	
	function text($str, $replace=null, $firstCap=false) {
		$str = $this->text[$str];
		if (isset($replace)) {
			foreach ($replace as $key => $value) {
				$str = str_replace($key, $value, $str);
			}
		}
		if ($firstCap) {
			$str = strtoupper(substr($str, 0, 1)) . substr($str, 1);
		}
		return $str;
	}

	function setLocale() {
		$localeClass = LOCALE_CLASS;
		$locale = new $localeClass;
		$this->text = $locale->text;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : System
//------------------------------------------------------------------------------
// added in 2.1
class System {
	var $fileManager 	= null;
	var $ftpLayerOn 	= false;
	
	// added in 2.1
	function sysChmod($absPath, $mode) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->chmod($absPath, $mode);
		} else {
			return chmod($absPath, $mode);
		}
	}
	
	// added in 2.1
	function sysCopy($srcAbsPath, $desAbsPath) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->copy($srcAbsPath, $desAbsPath);
		} else {
			return copy($srcAbsPath, $desAbsPath);
		}
	}

	// added in 2.1
	function sysMkdir($absPath) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->mkdir($absPath);
		} else {
			return mkdir($absPath);
		}
	}

	// added in 2.1
	function sysMoveUploadedFile($tmpAbsPath, $desAbsPath) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->moveUploadedFile($tmpAbsPath, $desAbsPath);
		} else {
			return move_uploaded_file($tmpAbsPath, $desAbsPath);
		}
	}
	
	// added in 2.1
	function sysRename($oldAbsPath, $newAbsPath) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->rename($oldAbsPath, $newAbsPath);
		} else {
			return rename($oldAbsPath, $newAbsPath);
		}
	}

	// added in 2.1
	function sysRmdir($absPath) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->rmdir($absPath);
		} else {
			return rmdir($absPath);
		}
	}
	
	// added in 2.1
	function sysTouch($absPath) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->touch($absPath);
		} else {
			return touch($absPath);
		}
	}
	
	// added in 2.1
	function sysUnlink($absPath) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->delete($absPath);
		} else {
			return unlink($absPath);
		}
	}
	
	function sysWrite($absPath, $content) {
		$ftp = $this->fileManager->user->ftp;
		if ($this->ftpLayerOn && $ftp) {
			return $ftp->putWithContent($absPath, $content);
		} else {
			return $this->write($absPath, $content);
		}	
	}
	
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Module
//------------------------------------------------------------------------------
class Module extends System{
	var $enabled = true;
	var $disabledIfNotRequired = false;
	
	// removed in 2.1
	//var $fileManager;

	var $locale;
	var $localeClass;
	var $moduleManager;
	var $requiredModules = array();
	var $text;
	
	// added in 2.1
	var $enabledAdminMode = true;
	var $enabledUserMode = true;
	
	function Module() {
		if ($this->localeClass) {$this->locale = new $this->localeClass;}
	}
	
	function getCss() {}
	
	function getHtml($fileIndex) {}

	function getHtmlParentDirectory($file, $view) {}
	
	function getIcon() {
		return $this->icons[$_GET["moduleParams"]["icon"]];
	}
	
	function getJavascript() {}

	function getRss($file) {}
	
	function text($str, $replace = null, $firstCap = false) {
		return $this->locale->text($str, $replace, $firstCap);
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleManager
//------------------------------------------------------------------------------
class ModuleManager {
	var $modules = array();
	var $attributes = array();
	var $functions = array();
	//var $sideBoxes = array();
	var $sideBoxesBottom = array();
	var $sideBoxesLeft = array();
	var $sideBoxesRight = array();
	var $sideBoxesTop = array();
	var $services = array();
	
	// edited in 2.1;
	function ModuleManager($user) {
		$classes = get_declared_classes();
		foreach ($classes as $class) {
			$class = strtolower($class);
			if (strpos($class, "module") === 0 && strlen($class) > 6) {
				// PHP 4 returns lowercase while PHP 5 returns the original one
				//if (get_parent_class($class) === "module") {
				if (strtolower(get_parent_class($class)) === "module") {
					$module = new $class;
					if ($module->requiredModules) {
						foreach ($module->requiredModules as $requiredModule) {
							$requiredModule = strtolower($requiredModule);
							if (!class_exists($requiredModule))	{
								die(text("MODULE ERROR") . " : $class " . text("REQUIRES") . " $requiredModule");
							}
						}
					}
					
					if ($module->enabled) {
						// "b8ff02892916ff59f7fbd4e617fccd01f6bca576" === sha1("Module")
						
						if (($user->mode == "admin" && $module->enabledAdminMode) || ($user->mode == "user" && $module->enabledUserMode)) {
							$this->modules[] = $module;
						}
						/*
						if ($module->isAttribute === true) {
							$this->attributes[] = $module;
						} else if($module->isFunction === true) {
							$this->functions[] = $module;
						} else if($module->isSideBox === true) {
							//$this->sideBoxes[] = $module;
							if ($module->isSideBoxPositionBottom) $this->sideBoxesBottom[] = $module;
							if ($module->isSideBoxPositionLeft) $this->sideBoxesLeft[] = $module;
							if ($module->isSideBoxPositionRight) $this->sideBoxesRight[] = $module;
							if ($module->isSideBoxPositionTop) $this->sideBoxesTop[] = $module;
						} else {
							$this->services[] = $module;
						}
						*/
					}
				}
			}
		}
		
		$requiredModules = array();
		foreach ($this->modules as $module) {
			foreach ($module->requiredModules as $requiredModule) {
				$requiredModule = strtolower($requiredModule);
				if(!$this->isModuleExist($requiredModule)) {
					die(text("MODULE ERROR") . " : " . get_class($module) . " " . text("REQUIRES") . " $requiredModule");
				}
				$requiredModules[] = $requiredModule; // Store the list of required modules for next part
			}
		}
		
		// Remove modules which are necessary only when required by others
		foreach ($this->modules as $key => $module) {
			if ($module->disabledIfNotRequired) {
				if (!in_array(strtolower($module->moduleName), $requiredModules)) {
					array_splice($this->modules, $key, 1);
				}
			}
		}
		
		foreach ($this->modules as $module) {
			if ($module->isAttribute === true) {
				$this->attributes[] = $module;
			} else if($module->isFunction === true) {
				$this->functions[] = $module;
			} else if($module->isSideBox === true) {
				//$this->sideBoxes[] = $module;
				if ($module->isSideBoxPositionBottom) $this->sideBoxesBottom[] = $module;
				if ($module->isSideBoxPositionLeft) $this->sideBoxesLeft[] = $module;
				if ($module->isSideBoxPositionRight) $this->sideBoxesRight[] = $module;
				if ($module->isSideBoxPositionTop) $this->sideBoxesTop[] = $module;
			} else {
				$this->services[] = $module;
			}
		}
		
		$this->sortModules();
	}
	
	function getSideBoxes($pos, $cwdRelPath, $view) {
		$html = null;
		foreach ($this->{sideBoxes . $pos} as $sideBox) {
			$html .= $sideBox->getHtml($cwdRelPath, $view);
		}
		return $html;
	}
	
	function isModuleExist($moduleName) {
		foreach ($this->modules as $module) {
			if (strcasecmp(get_class($module), $moduleName) == 0) {
				return $module;
			}
		}
		return false;
	}
	
	function setManagersToModules($fileManager, $user) {
		foreach ($this->modules as $key=>$module) {
			$this->modules[$key]->fileManager = $fileManager;
			$this->modules[$key]->moduleManager = $this;
			$this->modules[$key]->user = $user;
		}		
		foreach ($this->functions as $key=>$function) {
			$this->functions[$key]->fileManager = $fileManager;
			$this->functions[$key]->moduleManager = $this;
			$this->functions[$key]->user = $user;
		}	
		foreach ($this->attributes as $key=>$attribute) {
			$this->attributes[$key]->fileManager = $fileManager;
			$this->attributes[$key]->moduleManager = $this;
			$this->attributes[$key]->user = $user;
		}
		foreach ($this->sideBoxesBottom as $key=>$sideBox) {
			$this->sideBoxesBottom[$key]->fileManager = $fileManager;
			$this->sideBoxesBottom[$key]->moduleManager = $this;
			$this->sideBoxesBottom[$key]->user = $user;
		}
		foreach ($this->sideBoxesLeft as $key=>$sideBox) {
			$this->sideBoxesLeft[$key]->fileManager = $fileManager;
			$this->sideBoxesLeft[$key]->moduleManager = $this;
			$this->sideBoxesLeft[$key]->user = $user;
		}
		foreach ($this->sideBoxesRight as $key=>$sideBox) {
			$this->sideBoxesRight[$key]->fileManager = $fileManager;
			$this->sideBoxesRight[$key]->moduleManager = $this;
			$this->sideBoxesRight[$key]->user = $user;
		}
		foreach ($this->sideBoxesTop as $key=>$sideBox) {
			$this->sideBoxesTop[$key]->fileManager = $fileManager;
			$this->sideBoxesTop[$key]->moduleManager = $this;
			$this->sideBoxesTop[$key]->user = $user;
		}
	}
	
	function sortModules() {
		usort($this->attributes, array("ModuleManager", "sortModulesCmp"));
		usort($this->functions, array("ModuleManager", "sortModulesCmp"));
		//usort($this->sideBoxes, array("ModuleManager", "sortModulesCmp"));
		usort($this->sideBoxesBottom, array("ModuleManager", "sortModulesCmp"));
		usort($this->sideBoxesLeft, array("ModuleManager", "sortModulesCmp"));
		usort($this->sideBoxesRight, array("ModuleManager", "sortModulesCmp"));
		usort($this->sideBoxesTop, array("ModuleManager", "sortModulesCmp"));
	}
	
	function sortModulesCmp($module1, $module2) {
		if ($module1->position == $module2->position) {return 0;}
		return ($module1->position < $module2->position) ? -1 : 1;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Param
//------------------------------------------------------------------------------
class Param {
	function filter(&$param) {
		if (is_array($param)) {
			array_map(array("Param", "filter"), &$param);
		} else {
			if (get_magic_quotes_gpc()) {$param = stripslashes($param);}
			$param = Text::convertEncodingFromUtf8($param);
		}
	}
}
?>
<?php
class Rss {
	var $fileManager;
	var $moduleManager;
	
	function printRss($cwdRelPath) {
		$content = array();
		$content["description"] = "(RSS generated by Simple Directory Listing - http://simpledirectorylisting.net)";
		if (RSS_ON) {
			if (isset($cwdRelPath)) {
				$cwd = $this->fileManager->getFileByRelPath($cwdRelPath);
				if ($cwd) {
					if ($cwd->isDir) {
						if ($cwd->isPermitted) {
							$files = $this->fileManager->getFilesByDir($cwd->absPath);
							$content["title"] = text("INDEX OF") . " /$cwd->relPath";
							$content["link"] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?cwdRelPath=$cwd->relPath";
							$content["items"] = array();
							if (count($files) > 0) {
								foreach ($files as $fileIndex=>$file) {
									$description = null;
									foreach ($this->moduleManager->attributes as $attribute) {
										  $description .= $attribute->getRss($file, $fileIndex);
									}
									$item = array();
									$item["description"] = $description;
									$item["link"] = $file->url;
									$item["title"] = $file->basename;
									$content["items"][] = $item;
								}
							}
						} else {
							$content["title"] = text("ACCESS DENIED");
							$content["link"] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
						}
					} else {
						$content["title"] = text("ACCESS DENIED");
						$content["link"] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
					}
				} else {
					$content["title"] = text("ACCESS DENIED");
					$content["link"] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
				}
			} else {
				$content["title"] = text("ACCESS DENIED");
				$content["link"] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
			}
		} else {
			$content["title"] = text("RSS IS DISABLED.");
			$content["link"] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
		}
		$this->dumb($content);
	}
	
	function dumb($content) {
		$xml = null;
		$content["title"] = Text::convertEncodingToUtf8($content["title"]);
		$content["link"] = Text::convertEncodingToUtf8($content["link"]);
		$content["description"] = Text::convertEncodingToUtf8($content["description"]);
		$xml .=
			"<?xml version='1.0' encoding='utf-8'?>" .
			"<rss version='2.0'>" .
			"<channel>" .
			"<title>" . htmlentities($content["title"], null, "utf-8") . "</title>" .
			"<link>" . htmlentities($content["link"], null, "utf-8") . "</link>" .
			"<description>" . htmlentities($content["description"], null, "utf-8") . "</description>" .
			"<generator>Simple Directory Listing</generator>";
		if ($content["items"]) {
			foreach ($content["items"] as $item) {
				$item["title"] = Text::convertEncodingToUtf8($item["title"]);
				$item["link"] = Text::convertEncodingToUtf8($item["link"]);
				$item["description"] = Text::convertEncodingToUtf8($item["description"]);
				$xml .=
					"<item>" .
					"<title>" . htmlentities($item["title"], null, "utf-8") . "</title>" .
					"<link>" . htmlentities($item["link"], null, "utf-8") . "</link>" .
					"<description>" . htmlentities($item["description"], null, "utf-8") . "</description>" .
					"</item>";
			}
		}
		$xml .=
			"</channel>" .
			"</rss>";
		header("content-type: text/xml");
		echo $xml;
	}
}
?>
<?php
class Sfs {
	var $fileManager;
	
	function printSfs($cwdRelPath) {
		$content = array();
		if (SFS_ON) {
			if (isset($cwdRelPath)) {
				$cwd = $this->fileManager->getFileByRelPath($cwdRelPath);
				if ($cwd) {
					if ($cwd->isDir) {
						if($cwd->url != false) {
							if ($cwd->isPermitted) {
								$files = $this->fileManager->getFilesByDir($cwd->absPath);
								$content["description"] = "(SFS generated by Simple Directory Listing - http://simpledirectorylisting.net)";
								$content["cwd"] = array();
								$content["cwd"]["path"] = $cwd->relPath;
								$content["cwd"]["link"] = $cwd->url;
								$content["cwd"]["mtime"] = filemtime($cwd->absPath);
								$content["files"] = array();
								if (count($files) > 0) {
									foreach ($files as $fileIndex=>$file) {
										$item = array();
										$item["name"] = $file->basename;
										$item["mtime"] = filemtime($file->absPath);
										if ($file->isDir) {
											$item["type"] = "dir";
											$item["size"] = "";
										} else {
											$item["type"] = "file";
											$item["size"] = filesize($file->absPath);											
										}
										$content["files"][] = $item;
									}
								}
							} else {
								$content["description"] = text("ACCESS DENIED");
							}
						} else {
							$content["description"] = text("ACCESS DENIED");							
						}
					} else {
						$content["description"] = text("ACCESS DENIED");
					}
				} else {
					$content["description"] = text("ACCESS DENIED");
				}
			} else {
				$content["description"] = text("ACCESS DENIED");
			}
		} else {
			$content["description"] = text("ACCESS DENIED");
		}
		$this->dumb($content);
	}
	
	function dumb($content) {
		$xml = null;
		$content["description"] = Text::convertEncodingToUtf8($content["description"]);
		$xml .=
			"<?xml version='1.0' encoding='utf-8'?>" .
			"<sfs version='1.0'>" .
			"<description>{$content["description"]}</description>";
		if ($content["cwd"]) {	
			$content["cwd"]["path"] = Text::convertEncodingToUtf8($content["cwd"]["path"]);
			$content["cwd"]["link"] = Text::convertEncodingToUtf8($content["cwd"]["link"]);
			$xml .=
				"<cwd>" .
					"<path>" . htmlentities($content["cwd"]["path"], null, "utf-8") . "</path>" .
					"<link>" . htmlentities($content["cwd"]["link"], null, "utf-8") . "</link>" .
					"<mtime>{$content["cwd"]["mtime"]}</mtime>" .
				"</cwd>";
		}
		if ($content["files"]) {
			foreach ($content["files"] as $file) {
				$file["name"] = Text::convertEncodingToUtf8($file["name"]);
				$file["link"] = Text::convertEncodingToUtf8($file["link"]);
				$xml .=
					"<file>" .
					"<name>" . htmlentities($file["name"], null, "utf-8") . "</name>" .
					"<mtime>{$file["mtime"]}</mtime>" .
					"<size>{$file["size"]}</size>" .
					"<type>{$file["type"]}</type>" .
					"</file>";
			}
		}
		$xml .=
			"</sfs>";
		header("content-type: text/xml");
		echo $xml;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : SimpleDirectoryListing
//------------------------------------------------------------------------------
class SimpleDirectoryListing {
	var $fileManager;
	var $moduleManager;
	var $user;
	
	// edited in 2.1;
	function SimpleDirectoryListing() {
		$this->validateConfig();
		
		// edited in 2.1;
		if (!SYSTEM_ON || (!ADMIN_MODE_ON && !USER_MODE_ON)){
			if (!(isset($_GET["print"]) || isset($_GET["action"]))) {
				echo text("SYSTEM HAS BEEN SHUTTED DOWN");
			}
			exit(0);			
		}
		#-----------------------------------------------------------------------
		# Service is available
		#-----------------------------------------------------------------------
		#-----------------------------------------------------------------------
		# Anonymous visitor
		#-----------------------------------------------------------------------
		Param::filter($_GET);
		Param::filter($_POST);
		UserManager::proceedLoginLogout();
		$this->user = UserManager::checkPermissionAndGetUser();
		if (!$this->user) {
			if (!(isset($_GET["print"]) || isset($_GET["action"]))) {UserManager::printLogin();}
			if (isset($_GET["action"]) || $_GET["print"] === "dirListing") {echo text("PLEASE LOGIN");};
			exit(0);
		}
		#-----------------------------------------------------------------------
		# Have rights to access
		#-----------------------------------------------------------------------
		// added in 2.1;
		if (($_GET["system"] === "loginPage") && !$_SESSION["loggedIn"]) {
			UserManager::printLogin();
			exit(0);			
		}
		
		$this->moduleManager = new moduleManager($this->user);
		// The output is static data
		if (($_GET["print"] === "css")) {
			$this->printCss();				
			exit(0);			
		}
		// The output is static data
		if (($_GET["print"] === "icon")) {
			$this->printIcon();				
			exit(0);			
		}
		// The output is static data
		if (($_GET["print"] === "javascript")) {
			$this->printJavascript();
			exit(0);
		}
		#-----------------------------------------------------------------------
		# Needs to have the $_GET['relCwd']
		#-----------------------------------------------------------------------
		#-----------------------------------------------------------------------
		# Printing of sections and modules
		# Execution of actions
		#-----------------------------------------------------------------------
		$this->fileManager = New fileManager();
		$this->fileManager->user = $this->user;
		$this->moduleManager->setManagersToModules($this->fileManager, $this->user);
		// The output is static data
		if (($_GET["print"] === "image")) {
			$this->printImage();				
			exit(0);			
		}
		// The output is static data
		if (($_GET["print"] === "thumbnail")) {
			$this->printThumbnail();
			exit(0);
		}
		// The output is dynamic		
		if ($_GET["print"] === "dirListing") {
			$this->printDirListing();
			exit(0);
		}
		// The output is dynamic
		if ($_GET["print"] === "rss") {
			$this->printRss();
			exit(0);
		}
		// The output is dynamic
		if ($_GET["print"] === "sfs") {
			$this->printSfs();
			exit(0);
		}
		// The output is dynamic
		if ($_GET["action"] === "module") {
			$this->actionModule();
			exit(0);
		}
		$this->printHtml();
		exit(0);
	}
	
	function actionModule() {
		$module = $this->moduleManager->isModuleExist($_GET["module"]);
		if ($module) {
			//$module->fileManager = $this->fileManager;
			//$module->moduleManager = $this->moduleManager;
			//$module->user = $this->user;
			$module->action();			
		}
		exit(0);
	}
	
	// edited in 2.1;
	function getFooter() {
		if (isset($_GET["cwdRelPath"])) {$rss = $sfs = $_GET["cwdRelPath"];}
		else {$rss = $sfs = $this->user->permittedDirRelPath;}		
		if ($_SESSION["loggedIn"] === true) {
			$logout = " <a href='?system=logout'>" . text("LOGOUT") . "</a>";
		} else {
			// shows login only if one of the modes needs login
			if ((ADMIN_MODE_ON && ADMIN_MODE_NEEDS_LOGIN) || (USER_MODE_ON && USER_MODE_NEEDS_LOGIN)) {
				$login = " <a href='?system=loginPage'>" . text("LOGIN") . "</a>";
			}
		}
		
		$footer = null;
		$footer .= "<div id='footer'>";
		$footer .= "<div style='float:left'>";
		$footer .= "<span id='poweredBy'><i><b>powered by <a href='http://simpledirectorylisting.net'>SimpleDirectoryListing</a></b></i></span>";
		$footer .= " <a href='?print=rss&cwdRelPath=$rss' id='rss' target='_blank'>RSS</a>";
		$footer .= " <a href='?print=sfs&cwdRelPath=$sfs' id='sfs' target='_blank'>SFS</a>";
		$footer .= $login . $logout;
		$footer .= " Mode:" . $this->user->mode;
		$footer .= " <span id='font' style='cursor:pointer; display:none'>Font size: <span onclick='Sdl.Layout.increaseFontSize();'>[+]</span> <span onclick='Sdl.Layout.decreaseFontSize();'>[-]</span></span>";
		$footer .= "</div>";
		$footer .= "<div style='float:right'>" . META_WEB_SITE_NAME . "</div>";
		$footer .= "</div>";
		return $footer;
	}
	
	function getTheme() {
		if (get_parent_class($_GET["theme"]) === "theme") {
			$_SESSION["theme"] = $_GET["theme"];
			$theme = new $_GET["theme"];
		} else if (get_parent_class($_SESSION["theme"]) === "theme") {
			$theme = new $_SESSION["theme"];
		} else {
			$themeName = THEME_CLASS;
			$theme = new $themeName;
		}		
		return $theme;
	}
	
	function printCss() {
		header("Cache-Control: public");
		header("content-type: text/css");
		$theme = $this->getTheme();
		$css = null;
		$css .= $theme->getCss();
		foreach ($this->moduleManager->modules as $module) {
			$css .= $module->getCss();
		}
		echo $css;
		exit(0);
	}

	// Output in XML format
	function printDirListing() {
		$browser = new Browser;
		$browser->fileManager = $this->fileManager;
		$browser->moduleManager = $this->moduleManager;
		$browser->printDirListing($_GET["cwdRelPath"]);
		exit(0);
	}
	
	function printHtml() {
		$layout = new Layout;
		$browser = new Browser;
		if (isset($_GET["cwdRelPath"])) {$cwdRelPath = $_GET["cwdRelPath"];}
		else {$cwdRelPath = $this->user->permittedDirRelPath;}
		if ($_GET["view"] === "list" || $_GET["view"] === "thumbnail") {$view = $_GET["view"];}
		else { $view = "list";}
		$browser->fileManager = $this->fileManager;
		$browser->moduleManager = $this->moduleManager;
		$layout->pageBrowser = $browser->getHtml();
		$layout->sideBoxBottom = $browser->moduleManager->getSideBoxes("Bottom", $cwdRelPath, $view);
		$layout->sideBoxLeft = $browser->moduleManager->getSideBoxes("Left", $cwdRelPath, $view);
		$layout->sideBoxRight = $browser->moduleManager->getSideBoxes("Right", $cwdRelPath, $view);
		$layout->sideBoxTop = $browser->moduleManager->getSideBoxes("Top", $cwdRelPath, $view);
		$layout->permittedDirRelPath = Text::htmlentitiesUtf8($this->user->permittedDirRelPath);
		$layout->cwdRelPath = Text::htmlentitiesUtf8($cwdRelPath);
		$layout->view = $view;
		$layout->title = Text::htmlentitiesUtf8("/$cwdRelPath") . " - Simple Directory Listing";
		$layout->footer = $this->getFooter();
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-Type: text/html; charset=utf-8");
		$html = null;
		$html .= $layout->getHtml();
		echo Text::convertEncodingToUtf8($html);
	}

	function printIcon() {
		if (ICON_ON) {
			if (isset($_GET["module"])) {
				if ($this->moduleManager->isModuleExist($_GET["module"])) {
					header("Cache-Control: public");
					$module = new $_GET["module"];
					$icon = base64_decode($module->getIcon());
				}
			} else {
				$theme = $this->getTheme();	
				$icon = base64_decode($theme->icons[$_GET["icon"]]);
			}
			//header('Content-type: image/gif');
			header('Content-length: '.strlen($icon));
			echo $icon;	
		}
		exit(0);
	}

	function printImage() {
		if (IMAGE_PASSTHRU_ON) {
			$file = $this->fileManager->getFileByRelPath($_GET["relPath"]);
			if ($file) {
				if ($file->isPermitted) {
					$image = new Image();
					$image->printImage($file);
				}
			}
		}
		exit(0);
	}
	
	function printJavascript() {
		$javascriptObj = new Javascript;
		$javascript = $javascriptObj->getJavascrtipt();
		foreach ($this->moduleManager->modules as $module) {
			$javascript .= $module->getJavascript();
		}
		header("Cache-Control: public");
		header("content-type: text/javascript");
		echo $javascript;
	}
	
	function printRss() {
		$rss = new Rss;
		$rss->fileManager = $this->fileManager;
		$rss->moduleManager = $this->moduleManager;
		$rss->printRss($_GET["cwdRelPath"]);
		exit(0);
	}

	function printSfs() {
		$sfs = new Sfs;
		$sfs->fileManager = $this->fileManager;
		//$rss->moduleManager = $this->moduleManager;
		$sfs->printSfs($_GET["cwdRelPath"]);
		exit(0);
	}
	
	function printThumbnail() {
		if (THUMBNAIL_ON) {
			$file = $this->fileManager->getFileByRelPath($_GET["relPath"]);
			if ($file) {
				if ($file->isPermitted) {
					$image = new Image();
					$image->printThumbnail($file);
				}
			}
		}
		exit(0);
	}

	function validateConfig() {}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Text
//------------------------------------------------------------------------------
class Text {
	var $text;
	
	function convertEncodingToUtf8($str) {
		if(OS_ENCODING != null) {
			if (mb_detect_encoding($str, OS_ENCODING . ",utf-8")) {
				return mb_convert_encoding($str, "utf-8", OS_ENCODING . ",utf-8");
			}
		}
		return $str;
	}
	
	function convertEncodingFromUtf8($str) {
		if(OS_ENCODING != null) {
			if (mb_detect_encoding($str, OS_ENCODING . ",utf-8")) {
				return mb_convert_encoding($str, OS_ENCODING, OS_ENCODING . ",utf-8");
			}
		}
		return $str;
	}
	
	function htmlentitiesUtf8($str) {
		return htmlentities(Text::convertEncodingToUtf8($str), null, "utf-8");
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Theme
//------------------------------------------------------------------------------
class Theme {
	var $icons = array();
	
	function getCss() {}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : User
//------------------------------------------------------------------------------
class User {
	var $ftp 					= null;
	var $mode 					= false;
	var $virtualRootAbsPath		= null;
	var $permittedDirAbsPath	= null;
	var $permittedDirRelPath	= null;
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : UserManager
//------------------------------------------------------------------------------
class UserManager {
	var $user;

	// edited in 2.1;
	// It checks session and config
	function getMode() {
		if (ADMIN_MODE_ON) {
			if (ADMIN_MODE_NEEDS_LOGIN) {
				if ($_SESSION["mode"] === "admin") {return "admin";}
			} else {
				return "admin";
			}
		}

		if (USER_MODE_ON) {
			if (USER_MODE_NEEDS_LOGIN) {
				if ($_SESSION["mode"] === "user") {return "user";}
			} else {
				return "user";
			}
		}

		return false;
	}
	
	// edited in 2.1;
	// It returns a user
	function checkPermissionAndGetUser() {
		$user = new User;
		$user->mode = UserManager::getMode();
		if ($user->mode === "admin") {
			//$user->virtualRootAbsPath = ADMIN_MODE_VIRTUAL_ROOT;
			$configVirtualRoot 			= ADMIN_MODE_VIRTUAL_ROOT;
			$configCustomVirtualRoot 	= ADMIN_MODE_CUSTOM_VIRTUAL_ROOT;
			$configPermittedDir 		= ADMIN_MODE_PERMITTED_DIR;
		} elseif ($user->mode === "user") {
			$configVirtualRoot 			= USER_MODE_VIRTUAL_ROOT;
			$configCustomVirtualRoot 	= USER_MODE_CUSTOM_VIRTUAL_ROOT;
			$configPermittedDir 		= USER_MODE_PERMITTED_DIR;		
		}
		else {return false;}
		
		$user->virtualRootAbsPath = $configVirtualRoot;
		
		// Some OS's add an ending slash to paths of directories
		if ($user->virtualRootAbsPath === "CURRENT_WORKING_DIR") {$user->virtualRootAbsPath = dirname($_SERVER['SCRIPT_FILENAME']);}
		elseif ($user->virtualRootAbsPath === "DOCUMENT_ROOT") {$user->virtualRootAbsPath = $_SERVER['DOCUMENT_ROOT'];}
		elseif ($user->virtualRootAbsPath === "SERVER_ROOT") {$user->virtualRootAbsPath = substr($_SERVER['DOCUMENT_ROOT'], 0, strpos($_SERVER['DOCUMENT_ROOT'], "/")+ 1);}
		elseif ($user->virtualRootAbsPath === "CUSTOM_ROOT") {$user->virtualRootAbsPath = $configCustomVirtualRoot;}
		// virtual root does not need to have relPath because it is null.
		$user->virtualRootAbsPath = FileManager::changeSlashes($user->virtualRootAbsPath);
		$user->virtualRootAbsPath = FileManager::addEndingSlash($user->virtualRootAbsPath);
		if (!realpath($user->virtualRootAbsPath)) {
			if ($user->mode === "admin") die(text("CONFIG ERROR") . " : ADMIN_MODE_VIRTUAL_ROOT, ADMIN_MODE_CUSTOM_VIRTUAL_ROOT");
			if ($user->mode === "user") die(text("CONFIG ERROR") . " : USER_MODE_VIRTUAL_ROOT, USER_MODE_CUSTOM_VIRTUAL_ROOT");
		}
		$user->permittedDirRelPath = $configPermittedDir;
		$user->permittedDirRelPath = FileManager::changeSlashes($user->permittedDirRelPath);
		$user->permittedDirRelPath = FileManager::addEndingSlash($user->permittedDirRelPath);
		$user->permittedDirRelPath = FileManager::removeBeginningSlash($user->permittedDirRelPath); // 2007-12-26
		$user->permittedDirAbsPath = $user->virtualRootAbsPath . $user->permittedDirRelPath;
		if (!realpath($user->permittedDirAbsPath)) {
			if ($user->mode === "admin") die(text("CONFIG ERROR") . " : ADMIN_MODE_PERMITTED_DIR");
			if ($user->mode === "user") die(text("CONFIG ERROR") . " : USER_MODE_PERMITTED_DIR");
		}
		
		if (FTP_LAYER_ON) {
			$ftp = new Ftp;
			//$ftp->connect(); // It checks the ftp account but would decrease performance.
			$user->ftp = $ftp;
		}

		return $user;
	}

	// edited in 2.1;
	function proceedLoginLogout() {
		if (SESSION_SAVE_PATH) session_save_path(SESSION_SAVE_PATH);
		if (SESSION_GC_MAXLIFETIME) ini_set("session.gc_maxlifetime", (string)SESSION_GC_MAXLIFETIME);
		
		if ($_GET["system"] === "login") {
			// Submit from a non-javscript browser
			if (isset($_POST["njs"])) {
				$password = null;
				if (PASSWORD_FORMAT === "SHA1") {
					$password = sha1($_POST["password"]);
				} else {
					$password = $_POST["password"];					
				}
				
				// Correct
	 			if ((ADMIN_MODE_ON && $_POST["loginName"] === ADMIN_MODE_LOGIN_NAME && $password === ADMIN_MODE_PASSWORD) ||
					(USER_MODE_ON && $_POST["loginName"] === USER_MODE_LOGIN_NAME && $password === USER_MODE_PASSWORD)) {
	 				// Save login
	 				if (SAVE_LOGIN_ON && $_POST["saveLogin"] === "on") {
						session_cache_expire(SESSION_CACHE_EXPIRE);
						session_start();
						setcookie(session_name(), session_id(), time() + 60 * SESSION_CACHE_EXPIRE);
					// Ordinary session
	 				} else {
	 					session_start();
	 				}
					
					if (ADMIN_MODE_ON && $_POST["loginName"] === ADMIN_MODE_LOGIN_NAME && $password === ADMIN_MODE_PASSWORD) {
						$_SESSION["mode"] = "admin";
					} else {
						$_SESSION["mode"] = "user";
					}
					$_SESSION["loggedIn"] = true;
				// Incorrect
				}	else {
					session_start();
					// Saved for filling values of input and showing login message
					$_SESSION["njs"] = array();
					$_SESSION["njs"]["isLoginCorrect"] = false;
					$_SESSION["njs"]["loginName"] = $_POST["loginName"];
				}
				sleep(1);
				header("location:?{$_POST["query"]}");
				exit(0);

			// Ordinary flow
			} else {
				$xml = new Xml();
				
				$password = null;
				if (PASSWORD_FORMAT === "SHA1") {
					$password = sha1($_POST["password"]);
				} else {
					$password = $_POST["password"];					
				}
				
				// Correct
	 			if ((ADMIN_MODE_ON && $_POST["loginName"] === ADMIN_MODE_LOGIN_NAME && $password === ADMIN_MODE_PASSWORD) ||
					(USER_MODE_ON && $_POST["loginName"] === USER_MODE_LOGIN_NAME && $password === USER_MODE_PASSWORD)) {
	 				// Save login
	 				if (SAVE_LOGIN_ON && $_POST["saveLogin"] === "true") {
						session_cache_expire(SESSION_CACHE_EXPIRE);
						session_start();
						setcookie(session_name(), session_id(), time() + 60 * SESSION_CACHE_EXPIRE);
					// Ordinary session
	 				} else {
	 					session_start();
	 				}
					
					if (ADMIN_MODE_ON && $_POST["loginName"] === ADMIN_MODE_LOGIN_NAME && $password === ADMIN_MODE_PASSWORD) {
						$_SESSION["mode"] = "admin";
					} else {
						$_SESSION["mode"] = "user";
					}
					$_SESSION["loggedIn"] = true;
					$xml->setStatusSuccess();
					$xml->setContent("1");
				// Incorrect
				}	else {
					$xml->setStatusSuccess();
					$xml->setMessage(text("INCORRECT LOGIN NAME OR PASSWORD"));
				}
				sleep(1);
				$xml->dump();
				exit(0);
			}

			exit(0);

		} else {
			if ($_GET["system"] === "logout") {
				session_start();
				session_unset();
				session_destroy();
				setcookie(session_name(), "");
				echo "<html><body style='font-family:arial'>" . text("YOU HAVE SUCCESSFULLY LOGGED OUT") . " <a href='?'>" . text("BACK") . "</a></body></html>";
				exit(0);
			}
		}
		session_start();
	}
	
	// edited in 2.1;
	function getLogin() {
		// Safari 3 beta submits form when pressing Enter no matter there is Submit input or not.
		// Safari doesn't align inline table to center
		if (isset($_SESSION["njs"])) {
			if ($_SESSION["njs"]["isLoginCorrect"] === false) {$msg = text("INCORRECT LOGIN NAME OR PASSWORD");}
			$loginName = $_SESSION["njs"]["loginName"];
			unset($_SESSION["njs"]);
		}
		if (SAVE_LOGIN_ON) {$saveLogin = "<input name='saveLogin' id='saveLogin'  style='vertical-align:middle' type='checkbox' value='on'><span style='font-size:0.7em;'>" . text("REMEMBER ME") . "</span>";}
		
		if ((ADMIN_MODE_ON && !ADMIN_MODE_NEEDS_LOGIN) || (USER_MODE_ON && !USER_MODE_NEEDS_LOGIN)) {
			$accessWithoutLogin = " <a href='?'>(" . text("ACCESS WITHOUT LOGIN") . ")</a>";
		}
		
		$html = null;
		$html .= 
"
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
<html>
	<head>
		<title>" . text("LOGIN") . " - Simple Directory Listing</title>
		<meta name='keywords' content='simple, directory, listing'></meta>
<script type='text/javascript'>
//------------------------------------------------------------------------------
var Sdl = {};
//------------------------------------------------------------------------------
Sdl.Ajax = function() {}

Sdl.Ajax.ajaxGet = function(fn, targetLink) {
	var xhr;
	xhr = Sdl.Ajax.initializeAjax();
	if (xhr) {
		//xhr.onerror = Sdl.Ajax.onError; //IE6 doesn't support it.
		xhr.onreadystatechange = function() {
				if(xhr.readyState == 4) {fn(xhr)};
			}
		xhr.open('GET', targetLink, true);
		xhr.send(null);
		return xhr;
	} else {
		return false;
	}
}

Sdl.Ajax.ajaxPost = function(fn, targetLink, param) {
	var xhr
	xhr = Sdl.Ajax.initializeAjax();
	if (xhr) {
		//xhr.onerror = Sdl.Ajax.onError; //IE6 doesn't support it.
		xhr.onreadystatechange = function() {
				if(xhr.readyState == 4) {fn(xhr)};
			}
		xhr.open('POST', targetLink, true);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.setRequestHeader('Content-length', param.length);
		xhr.setRequestHeader('Connection', 'close');
		xhr.send(param);
		return xhr;
	} else {
		return false;
	}
}

Sdl.Ajax.initializeAjax = function() {
	var xhr;
	try	{
		xhr = new XMLHttpRequest(); // FF & IE7
	} catch (e) {
		try	{
			xhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
		} catch(e) {
			try	{
				xhr = new ActiveXObject('Microsoft.XMLHTTP');
			} catch(e) {
				alert('" . text("JAVASCRIPT ERROR") . "');
				return false;
			}
		}
	}
	return xhr;
}

Sdl.Ajax.onError = function() {
	alert('" . text("JAVASCRIPT ERROR") . "');
}
//------------------------------------------------------------------------------
Sdl.Login = {};

Sdl.Login = function() {}

Sdl.Login.prototype = {	
	ajaxActionSubmit : function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
			if (response.valid) {
				if (response.content == '1') {
					window.location.reload();
					return;
				}
			}
		}
		document.getElementById('submit').disabled = false;
	},

	onClickSubmit : function() {
		this.submit();
	},
	
	onKeyPressEnter : function(e) {
		if (e.keyCode == 13) {
			this.submit();
		}
	},
	
	submit : function() {
		var loginName, param, password, saveLogin;
		document.getElementById('submit').disabled = true;
		loginName = document.getElementById('loginName').value;
		password = document.getElementById('password').value;
		saveLogin = document.getElementById('saveLogin') ? document.getElementById('saveLogin').checked : null;
		param =	'loginName=' + loginName + '&' +
				'password=' + password + '&' +
				'saveLogin=' + saveLogin;
		Sdl.Ajax.ajaxPost(this.ajaxActionSubmit, '?system=login', param);
	}
}
Sdl.login = new Sdl.Login();
//------------------------------------------------------------------------------
Sdl.Xml = function() {}

Sdl.Xml.digestResponseXml = function(xhr) {
	var container, nodes, response = {};
	if (!xhr) {
		response.valid = false;
		response.debug = '" . text("ERROR") . " : Sdl.Ajax';
		return response;	
	}
	if (xhr.responseXML == null) {
		response.valid = false;
		response.debug = xhr.responseText.substr(0, " . DEBUG_XML_RESPONSE_LENGTH . ");
		return response;
	}
	container = xhr.responseXML.documentElement;
	if (!container || container.tagName != 'container') {
		response.valid = false;
		response.debug = xhr.responseText.substr(0, " . DEBUG_XML_RESPONSE_LENGTH . ");
		return response;	
	}
	response.valid = true;
	response.status = {};
	nodes = container.getElementsByTagName('error')[0].childNodes;
	response.error = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('status')[0].childNodes;
	response.status.text = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('content')[0].childNodes;
	if (nodes[0]) {
		response.contentNodes = nodes;
		response.content = '';
		for (var i = 0 ; i < nodes.length ; i++) {
			response.content += nodes[i].nodeValue;
		}
	} else {
		response.content = null;
	}
	nodes = container.getElementsByTagName('debug')[0].childNodes;
	response.debug = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('message')[0].childNodes;
	response.message = nodes[0] ? nodes[0].nodeValue : null;
	nodes = container.getElementsByTagName('warning')[0].childNodes;
	response.warning = nodes[0] ? nodes[0].nodeValue : null;
	if (response.status.text != null) {
		if (response.status.text == 'success') {
			response.status.success = true;
		} else if (response.status.text == 'error') {
			response.status.success = false;
		} else {
			response.status.success = null;
		}
	} else {
		response.status.success = null;
	}
	return response;
}

Sdl.Xml.validateResponseAndWarn = function(response) {
	if (response.valid) {
		return true;
	} else {
		alert('" . text("ERROR") . " : " . text("INCORRECT XML RESPONSE") . ".\\n" . text("DEBUG") . " : \\n' + response.debug);
		return false;
	}
}

Sdl.Xml.alertResponse = function(response) {
	if (response.status.success != null) {
		if (response.status.success == true) {
			if(response.message) {alert(response.message);}
			if(response.warning) {alert('" . text("WARNING") . " : ' + response.warning);}
		} else if (response.status.success == false){
			alert('" . text("ERROR") . " : ' + response.error);
		}
	} else {
		alert('" . text("ERROR") . " : " . text("UNKNOWN RESPONSE STATUS") . "');
	}
}
//------------------------------------------------------------------------------
</script>
<style type='text/css'>
body {font-family:arial; font-size:" . FONT_SIZE . "; margin:0px;}
.textfield {width:11em} /* For IE6 */
#accessWithoutLogin {font-size:0.9em;}
#container {left:50%; margin:0em 0em 0em -8.5em; position:absolute; text-align:center; top:35%;}
#footer {font-size:10px}
#form {margin:0px}
#formTable {border-collapse:collapse;}
#msg {font-size:0.7em}
</style>
	</head>
	<body>
		<div id='container'>
			<strong>" . META_WEB_SITE_NAME . "</strong>
			<form action='?system=login' method='post' onsubmit='Sdl.login.submit(); return false;'>
			<noscript><div id='msg'>$msg</div></noscript>
			<table id='formTable'>
				<tr><td style='text-align:right'>" . text("LOGIN NAME") . " :</td><td><input class='textfield' type='textfield' name='loginName' id='loginName' value='$loginName'></td></tr>
				<tr><td style='text-align:right'>" . text("PASSWORD") . " :</td><td><input class='textfield' type='password' name='password' id='password'></td></tr>
				<tr>
					<td></td>
					<td style='text-align:left'>
						<noscript>
							<input name='query' type='hidden' value='{$_SERVER['QUERY_STRING']}'>
							<input name='njs' type='hidden' value='true'>
						</noscript>
						<input id='submit' type='submit' value='" . text("SUBMIT") . "'>
						<span style='vertical-align:top'>$saveLogin</span>
					</td>
				</tr>
			</table>
			</form>
			<span id='accessWithoutLogin'>$accessWithoutLogin</span>
			<div id='footer'><i><b>powered by <a href='http://simpledirectorylisting.net'>SimpleDirectoryListing</a></b></i></div>
		</div>
	</body>
</html>
";
		return $html;
	}
	
	function printLogin() {
		echo UserManager::getLogin();
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : Xml
//------------------------------------------------------------------------------
class Xml {
	var $content;
	var $debug;
	var $doc;
	var $error;
	var $status;
	var $warning;
	
	function dump() {
		$this->status = Text::convertEncodingToUtf8($this->status);
		$this->content = Text::convertEncodingToUtf8($this->content);
		$this->message = Text::convertEncodingToUtf8($this->message);
		$this->error = Text::convertEncodingToUtf8($this->error);
		$this->warning = Text::convertEncodingToUtf8($this->warning);
		$this->debug = Text::convertEncodingToUtf8($this->debug);
		header("content-type: text/xml");

		$xml = 
			"<?xml version='1.0' encoding='utf-8'?>" .
			"<container>" .
			
			/*
			"<status>" 	. htmlentities($this->status, null, "utf-8") 	. "</status>" .
			"<content>" . htmlentities($this->content, null, "utf-8") 	. "</content>" .
			"<message>" . htmlentities($this->message, null, "utf-8") 	. "</message>" .
			"<error>" 	. htmlentities($this->error, null, "utf-8") 	. "</error>" .
			"<warning>" . htmlentities($this->warning, null, "utf-8") 	. "</warning>" .
			"<debug>" 	. htmlentities($this->debug, null, "utf-8") 	. "</debug>" .
			*/
			"<status><![CDATA[" 	. $this->status		. "]]></status>" .
			"<content><![CDATA[" 	. $this->content 	. "]]></content>" .
			"<message><![CDATA["	. $this->message 	. "]]></message>" .
			"<error><![CDATA[" 		. $this->error 		. "]]></error>" .
			"<warning><![CDATA[" 	. $this->warning 	. "]]></warning>" .
			"<debug><![CDATA[" 		. $this->debug 		. "]]></debug>" .
			
			"</container>";
		echo $xml;
	}
	
	function setContent($text) {
		$this->content = $text;
		$this->setStatusSuccess();
	}
	
	function setError($text) {
		$this->error = $text;
		$this->setStatusError();
	}
	
	function setMessage($text) {
		$this->message = $text;
	}
	
	function setStatus($text) {
		$this->status = $text;
	}
	
	function setStatusError() {
		$this->setStatus("error");
	}
	
	function setStatusSuccess() {
		$this->setStatus("success");
	}
	
	function setWarning($text) {
		$this->warning = $text;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : LocaleEnglishUS
//------------------------------------------------------------------------------
class LocaleEnglishUS extends Locale {
	var $localeGroup = "en";
	var $localeName = "en-us";
	var $text = array(
		// Class : Browser
		"DIR"
			=> "dir",
		"IMG"
			=> "img",
		"UNKNOWN"
			=> "unknown",
		"INDEX OF"
			=> "Index of",
		"NO FILES"
			=> "No files",	
		"RSS IS DISABLED."
			=> "RSS is disabled.",
		// Errors
		"ACCESS DENIED"
			=> "Access denied",
		"DIRECTORY IS NOT ACCEPTED"
			=> "Directory is not accepted.",
		"INTERNAL SERVER ERROR"
			=> "Internal server error",
		"THUMBNAIL VIEW IS DISABLED."
			=> "Thumbnail View is disabled.",
		"INVALID LOCATION"
			=> "Invalid location",
		// Class : Javascript
		"ADD"
			=> "Add",
		"REMOVE"
			=> "Remove",
		"RESET"
			=> "Reset",
		"FILES"
			=> "files",
		"DEBUG"
			=> "Debug",
		"ERROR"
			=> "Error",
		"INCORRECT XML RESPONSE"
			=> "Incorrect XML response.",
		"INVALID IMAGE FORMAT"
			=> "Invalid image format",
		"JAVASCRIPT ERROR"
			=> "Javascript error",
		"LOADING"
			=> "Loading...",
		"UNKNOWN RESPONSE ERROR"
			=> "Unknown response error.",
		"WARNING"
			=> "Warning",
		// Class : ModuleManager
		"MODULE ERROR"
			=> "MODULE ERROR",
		"REQUIRES"
			=> "requires",
		// Class : SimpleDirectoryListing
		"LOGIN"
			=> "Login",
		"LOGOUT"
			=> "Logout",
		"SYSTEM HAS BEEN SHUTTED DOWN"
			=> "System has been shutted down.",
		// Class : UserManager
		"ACCESS WITHOUT LOGIN"
			=> "Access without login",
		"BACK"
			=> "Back",
		"CONFIG ERROR"
			=> "CONFIG ERROR",
		"INCORRECT LOGIN NAME OR PASSWORD"
			=> "Incorrect login name or password.",
		"LOGIN"
			=> "Login",
		"LOGIN NAME"
			=> "Login name",
		"PASSWORD" 
			=> "Password",
		"PLEASE LOGIN"
			=> "Please login.",
		"REMEMBER ME"
			=> "Remember me",
		"SUBMIT"
			=> "Submit",
		"YOU HAVE SUCCESSFULLY LOGGED OUT"
			=> "You have successfully logged out.",	
		// Module : ModuleBrowserView
		"BACKWARD"
			=> "Backward",
		"FORWARD"
			=> "Forward",
		"HOME"
			=> "Home",
		"LIST VIEW"
			=> "List View",
		"RELOAD"
			=> "Reload",
		"THUMBNAIL VIEW"
			=> "Thumbnail View",
		// Module : ModuleChangeMode
		"CHANGE MODE"
			=> "Change Mode",
		"HAS BEEN SUCCESSFULLY CHANGED TO A NEW MODE"
			=> "has been successfully changed to a new mode",
		// Module : ModuleCopyMove
		"ARE YOU SURE YOU WANT TO COPY ALL THESE"
			=> "Are you sure you want to copy all these",
		"ARE YOU SURE YOU WANT TO MOVE ALL THESE"
			=> "Are you sure you want to move all these",
		"COPY/MOVE"
			=> "Copy/Move",
		"COPY TO HERE"
			=> "Copy to here",
		"FAILED TO COPY"
			=> "Failed to copy",
		"FAILED TO MOVE"
			=> "Failed to move",
		"MOVE TO HERE"
			=> "Move to here",
		"SUCCESSFULLY COPIED"
			=> "Successfully copied",
		"SUCCESSFULLY MOVED"
			=> "Successfully moved",
		// Module : ModuleCreateFile
		"CREATE DIRECTORY"
			=> "Create Directory",
		"CREATE FILE"
			=> "Create File",
		"FILE WITH SAME NAME EXISTS"
			=> "File with same name exist.",
		"HAS BEEN SUCCESSFULLY CREATED IN"
			=> "has been successfully created in",
		"INVALID CURRENT WORKING DIRECTORY"
			=> "Invalid current working directory.",
		"NEWDIR"
			=> "newdir",
		"NEWFILE.EXT"
			=> "newfile.ext",
		"PLEASE ENTER A FILENAME"
			=> "Please enter a filename.",
		"PLEASE ENTER A DIRECTORY NAME"
			=> "Please enter a directory name.",
		// Module : ModuleDelete
		"ARE YOU SURE YOU WANT TO DELETE ALL THESE"
			=> "Are you sure you want to delete all these",
		"DELETE"
			=> "Delete",
		"FAILED TO DELETE"
			=> "Failed to delete",
		"FILES/DIRECTORIES"
			=> "files/directories",
		"SUCCESSFULLY DELETED"
			=> "Successfully deleted",
		// Module : ModuleDownload
		"DOWNLOAD"
			=> "Download",
		// Module : ModuleEdit
		"FILE HAS BEEN SUCCESSFULLY SAVED"
			=> "File has been successfully saved.",
		// Modile : ModuleFileMode
		"FILE MODE"
			=> "File mode",
		"MODE"
			=> "Mode",
		"PLEASE ENTER A NEW FILE MODE"
			=> "Please enter a new file mode.",
		// Module : ModuleFileMTime
		"LAST MODIFIED"
			=> "Last modified",
		// Module : ModuleFilename
		"NAME"
			=> "Name",
		// Module : ModuleFileSize
		"FILE SIZE"
			=> "File size",
		"SIZE"
			=> "Size",
		// Module : ModuleFileType
		"FILE TYPE"
			=> "File type",
		"TYPE"
			=> "Type",
		// Module : ModuleMusicPlayer
		"NO FILE"
			=> "No file",
		"PLAY"
			=> "Play",
		"PLAY MUSIC"
			=> "Play Music",
		// Module : ModuleOpen
		"FILE IS NOT WITHIN DOCUMENT ROOT"
			=> "File is not witin document root",
		"OPEN"
			=> "Open",
		// Module : ModuleRead
		"FILE"
			=> "File",
		"READ"
			=> "Read",
		// Module : ModuleRename
		"HAS BEEN SUCCESSFULLY RENAMED TO"
			=> "has been successfully renamed to",
		"PLEASE ENTER A NEW FILENAME"
			=> "Please enter a new filename.",
		"RENAME"
			=> "Rename",
		// Module : ModuleSelector
		"PLEASE SELECT A FILE"
			=> "Please select a file.",
		"PLEASE SELECT FILES"
			=> "Please select files.",
		"PLEASE SELECT ONE FILE ONLY"
			=> "Please select one file only.",
		// Module : ModuleUpload
		"FILE SIZE EXCEEDS LIMIT"
			=> "File size exceeds limit.",
		"SUCCESSFULLY UPLOADED TO"
			=> "Successfully uploaded to",
		"UPLOAD"
			=> "Upload",
		"UPLOAD TO DIRECTORY"
			=> "Upload to directory",	
				
	);
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ThemeApache
//------------------------------------------------------------------------------
class ThemeApache extends Theme{
	var $icons = array(
		"cross"		=> "R0lGODlhEAAQAMQfAOt0dP94eOFjY/a0tP/JyfFfX/yVlf6mppNtbf5qanknJ9dVVeZqat5eXpiMjGo4OIUvL3pGRthWVuhvb1kaGv39/f1lZdg7O/7Y2F8/P+13d4tcXNRTU2dCQv///////yH5BAEAAB8ALAAAAAAQABAAAAV/4Cd+Xml6Y0pGTosgEap6G0YQh6FDskhjGg0AMJkwAjxfBygkGhmCAAXl6QyGnuLFI4g+qNbixLMNdBNfkpXBLncbial6AC17Gvg4eND1BPB3cHJVBguGhwsSHHo+GRqKHJGRCQo9JI4WBZoFFpUVMw8QCqMQU58qJCclqKytIQA7",
		"file"		=> "R0lGODlhEAAQAMQfAMfj/uzx9rvc/eXt9YivyHaXtFdwkZXK/KvU+0lVa/L2+rba/KTR+4m77FJhe67T5UNLXNXn8MDf/bHX/JrA1qjL3t7n7ykxQz5FVeLp8LDR48vM0Z7O+9Xb5P///////yH5BAEAAB8ALAAAAAAQABAAAAWPoCeO5PidXvRoFUURRCEXHvpEQ5DrQ98YNY9mACgWJUhF4yeqKIwApECgqDpElOdRulhMFFdPdisRdCcIsIjwlJon6HRireB6EQgGYzD3FAJccXocAxAif1N3eQwcHBmGfgFmd4MHBxYYhwpveIwclgGZHgYdCjwZqBkWARsXhwawDg4JCRAQGBgXYSW8JCEAOw==",
		"dir"		=> "R0lGODlhEAAQAMQfAOvGUf7ztuvPMf/78/fkl/Pbg+u8Rvjqteu2Pf3zxPz36Pz0z+vTmPzurPvuw/npofbjquvNefHVduuyN+uuMu3Oafbgjfnqvf/3zv/3xevPi+vRjP/20/bmsP///////yH5BAEAAB8ALAAAAAAQABAAAAV24CeOZGmepqeqqOgxjBZFa+19r4ftWQUAgqDgltthMshMIJAZ4jYDHsBARSAmFOJvq+g6HIdEFgcYmBWNxoNAsDjGHgBnmV5bCoUDHLBIq9sFEhIdcAYJdYASFRUQhQkLCwkOFwcdEBAXhVabE52ecDahKy0oIQA7",
		"unknown"	=> "R0lGODlhEAAQAMQfAHSUstdxbU1Zbvz9/4CwzVZtjeTs9Njq9+rx9o7B8d7LzbjTsISyhUiCRvb5/K7S5NXd36LQ+7TZ/PP2+sPh/ajL3ikxQz9HV+Hp8Jq/1czkt5PGeDhzKs9XUv///////yH5BAEAAB8ALAAAAAAQABAAAAWSoCeO5Pid3vE8VZYRBCADHvocBuKIgzcZiULN89D1Ap1AwDNAEISeyqDjQXau1M4AiriKlh7vFSK6DhrkMnWa1VIajLB3EWGb3wS5Z9GIOMRaDRsaIg8cDWwiGGYNcgoMbGkAUwMSenUdDhciAA4DlQciB3VNmx4FEBMIBqwYrhgIChacBbUFArgXuhcWAiW/vyEAOw=="
	);

	// edited in 2.1;
	function getCss() {
		$css =
"
body {
	margin:0px 0px 0px 0px;
	font-family:arial;
	font-size:".FONT_SIZE."px;
}

img {
	border:0px;
}

.browserCellFiller { /* Php class : Browser */
	width:100%;
}

.browserScrollBarFiller { /* Php class : Browser */
	width:20px;
}


.browserFilesViewList { /* Php class : Browser */
	border-collapse:collapse;
	line-height:1.2em;
}

.browserFilesViewThumbnail { /* Php class : Browser */
	line-height:1.2em;
}

.containerCell { /* Php class : Browser */
	padding:0px;
	vertical-align:top;
}

.coverBody { /* Js class : Sdl.CoverBody */
	background-color:black; /*#00ff00*/	
	filter:alpha(opacity=90);
	height:0px;
	left:0px;
	opacity:0.9;
	position:absolute;
	top:0px;
	width:0px;
	z-index:0;
}

.coverBodyText { /* Js class : Sdl.CoverBody */
	color:white;
	font-size:2em;	
	position:fixed;
	top:45%;
	/* For IE6. IE6 doesn't support position:fixed */
	/* position:absolute; */ /* Js apprroach */
	z-index:1;
}

.fileViewList {	/* Php class : Browser */ /* Sdl.Selector overrides it */
}

.fileViewThumbnail { /* Php class : Browser */ /* Sdl.Selector overrides it */
	float:left;
}

.function { /* Php class : Browser */
	float:left;
}

.functionButton { /* Js class : Sdl.Button */
	border:1px solid;
	/* border-color:transparent;*/ /* IE6 doesn't support transparent */
	border-color:white;
	cursor:pointer;
	padding:3px;
}

.functionButtonMouseOver { /* Js class : Sdl.Button */
	background-color:green;
	border:1px solid black;
	filter:alpha(opacity=50);
	opacity:0.5;
}

.image { /* Js class : Sdl.Image */
	color:white;
	font-size:2em;
	left:0px;
	position:fixed;
	top:0px;
	/* For IE6. IE6 doesn't support position:fixed */
	/*position:absolute;*/ /* Js approach */
	z-index:2;
}

.movableBar{ /* Js class : Sdl.MovableBar */
	cursor:move;
	height:0.5em;
	left:45%;
	overflow:hidden;
	position:relative;
	width:6em;
}

.movableBarMouseOver { /* Js class : Sdl.MovableBar */
	background-color:gray;	
	height:2.0em;
}

.movableBarSign { /* Js class : Sdl.MovableBar */
	line-height:0.5em;
	text-align:center;
}

.movableBarContent { /* Js class : Sdl.MovableBar */
	text-align:center;
	line-height:1.0em;
}

/* For IE6. contentContainer gets incorrect height when setting .style.height = .offsetHeigh */
.moveTargetIe6 {
	border:1px solid white;
}

.pagesSideBoxTopExist { /* Php class : Layout */
	border-top:1px solid #AAAAAA;
}

.pagesSideBoxTopNotExist { /* Php class : Layout */
	border-top:0px;
}

.sortHeader { /* Js class : Sdl.Sort */
	cursor:pointer;
}

.sortHeaderMouseOver { /* Js class : Sdl.Sort */
	background-color:orange;
	filter:alpha(opacity=70);
	opacity:0.7;
}

.systemAttribute { /* Php class : Browser */
	display:none;
}

.tab { /* Js class : Sdl.Page */
	border-top:1px solid;
	border-left:1px solid;
	border-right:1px solid;
	cursor:pointer;
	float:left;
	margin-right:0.1em;
	padding:0px 0.2em;
	line-height:1.2em;
	vertical-align:bottom;
}

.tabFocus { /* Js class : Sdl.Page */
	background-color : yellow;
}

.thumbnailItemContainer { /* Php class : Browser*/
	padding: 0.33em;
	width: " . THUMBNAIL_SIZE / FONT_SIZE . "em;
	overflow:hidden;
}

.thumbnailItemImageContainer { /* Php class : Browser*/
	border: 1px solid #DDDDDD;
	width: " . THUMBNAIL_SIZE/FONT_SIZE . "em;
	height: " . THUMBNAIL_SIZE/FONT_SIZE . "em;
	line-height: " . THUMBNAIL_SIZE/FONT_SIZE . "em;
	overflow:hidden; /*For IE6. Size of cached images are used as estimated size.*/
	text-align:center;
}

.thumbnailItemImageContainer a { /* Php class : Browser*/
	display:block;
	height:100%; /* For IE6 */
	width:100%; /* For IE6 */
}

.thumbnailItemImageContainer img { /* Php class : Browser*/
	vertical-align:middle;
}

.thumbnailItemImageDir { /* Php class : Browser */
	height:2em;	
}

.thumbnailItemImageUnknown { /* Php class : Browser */
	height:2em;
}

#browserFiles { /* Php class : Browser */
	/*width:100%;*/ /* Cancelled for IE6. Vertical scrollbar problem. */
}

#browserFilesContainer { /* Php class : Browser */
	min-height:10em;
	height:auto;
	/*
	overflow-x:hidden;
	overflow-y:auto;
	*/
	overflow:auto;
	overflow-x:hidden; /* Opera 9.21 doesn't support overflow-x or overflow-y */
}

#browserFunctions { /* Php class : Browser */
	overflow:hidden;
}

#browserHeaders { /* Php class : Browser */
	border-collapse:collapse;
	border-bottom:1px solid gray;
	line-height:1.2em;
}

#broswerSeparator1 { /* Php class : Browser */
	display:none;	
	height:0px;
	overflow:hidden;
}

#browserSystemFiles { /* Php class : Browser */
	border-collapse:collapse;
	line-height:1.2em;
}

#container { /* Php class : Layout */
	border:0px solid;
	border-collapse:collapse;
	padding:0px;
	width:100%;
}

#footer { /* Php class : Layout */
	font-size:0.67em;
}

#pagesContainer { /* Php class : Layout */
	clear:both; /* For IE6 */
}

#tabs { /* Php class : Layout */
	overflow:hidden;
}
";		
		return $css;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleBrowserView
//------------------------------------------------------------------------------
define("MODULEBROWSERVIEW_ON"				, true);
define("MODULEBROWSERVIEW_ADMIN_MODE_ON"	, true);
define("MODULEBROWSERVIEW_USER_MODE_ON"		, true);

class ModuleBrowserView extends Module {
	var $enabled 			= MODULEBROWSERVIEW_ON;
	var $enabledAdminMode 	= MODULEBROWSERVIEW_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEBROWSERVIEW_USER_MODE_ON;
	var $icons = array(
		"backward"		=> "R0lGODlhEAAQAMQfACROFdzy00yoLbDhnUSVKFe+OV3CPMXpuLPioitfGordWnfRTXTLXLzmqX3UUYTaVjyDJGTEQaPdjI/gXXDLSc7sw2rKRdjwz9PuyVG6NTRzH4zUc9/z2H3OZf///////yH5BAEAAB8ALAAAAAAQABAAAAWH4CeOXumNKOkJLFGm4ipwXHARbrrSzaQMmArkFJtVJj7Fw4E4aIg75MSzXFCcp1WgoVCUHFbLppEoES6Ph8kUMZDNGIdjXTIUEGUPpCKxlixtBQwIAFkQBxaAHgZ2GYRQGgcSbXYFGRsDhSQaDQ0dGRkMA5lEJAkJCAijAJowJaysLzAqsighADs=",
		"forward"		=> "R0lGODlhEAAQAMQfACROFd7z10yoLbDhnUSVKHTLXIrdWVe+OcXpuLPiol3CPCtfGrzmqYTZVmvJRnjRTjyDJKPdjI/gXc7sw2PEQHLPS9nw0NPuyX7WUlG6NTRzH4zUc23LR33OZf///////yH5BAEAAB8ALAAAAAAQABAAAAWG4CeOXumNKOkJLFGm4ioEtEW46UozkjFcE8gpNptIeobGI4HQDHXHnufx4DRPKwvDwG2UHI4NY1EiWBpeU4miGJcvGIy6pDgkyB7IJFLpc+gHBQkAWBAIHGAUHnUZg08aCBFsdQcZGwOEJBoMDB0ZGQUDmEMkCwsJCaIAmTAlq6svMCqxKCEAOw==",
		"home"			=> "R0lGODlhEAAQALMPAI50QJ6IVNro74WxxfDmyNnGknZXI5zA0JS7zPPr08awddW5bNvCf6fJ2f///////yH5BAEAAA8ALAAAAAAQABAAAARg8Mn5nKOYOoRu1oggDN63CU0zliCaqiR2vu86OYNLp3Y1NIcDBzEoFkuOQEHBbBYCrGSiwKhWE4BoIFENBBgLQlaz7QIW4fGtzACcwwZtYk6o1+PkgNtt6ONvFoGCFhIRADs=",
		"reload"		=> "R0lGODlhEAAQAMQfAJXG2JXa+ZLO5ChrlkCy4TZ1kiVvpCN0trvo9SN5xTd4lrfh7iR9zo3S+EGz7JDJ4TaCromrvC9ymyV+0Dd3mTl1koe72YvN7LTj+9ne6N3g6v7+/0Cw2Stoh////////yH5BAEAAB8ALAAAAAAQABAAAAV94CeOXumJ5ah6VVFQpXSqX6YgC4JAljGTnYVAwCFcMIffx9OJdDqDB8HRSCiZCpMh0GgwroWTZ2A4JBiTn2nNVk8YiYNhIA6vGJhAwFdSdK4JAQ4EDwMDTX8rBwEXBBxDAIkrBhYQDw8AAAoaGzQeMh4ULhVKJDNrNKmqNCEAOw==",
		"viewList"		=> "R0lGODlhEAAQAMQAALvd/3aVsoWsx5XL/9vp9OTr81dvj7ba/0eo/0lVa4fE/+vy96rU/jya/2fG/6TR/1Fhe7LY/q/S5ENLXPL1+Orv+ufu9ZrA1qjL3tHW3SkxQz5FVeDo757P/6/X/////yH5BAAAAAAALAAAAAAQABAAAAWP4CeOZCkSkoRdl+AGsBGIErEQeI5bGUQvDoSwQSQiFgYRZgFoNg/QQ8Ti+1wszqc04ilULxUnlOthMLwiQRgwLjMej0IijWVz353OQE5vRiJ4A4IFEyIBWAdlD3oDCgochR+HUIqCjo8bhhRSgZcKC5kfBhkUFhYFqByqCxkahgawEBAJCRMTGxsaVSa8IiEAOw==",
		"viewThumbnail"	=> "R0lGODlhEAAQAMQAANvn8klVa+bt9Onx9lRpiUWHuXaYtT13uVJgea/S5OPr8ENLXPL1+HiOqerv+m+NrYOqxYyzzFp5npa805/E2KjL3ikxQz5FVUHUD+fv93uhvercjYXaaer0/7jT7P///yH5BAAAAAAALAAAAAAQABAAAAWJ4CeOZCkCSVJRUwRphvFIjZgAGaDvevYRtk5heCgaDz9RZeDpNJ/OTvJDyXg8m+x1+0GIJo5mdhNtdkWRMFbLaXs+ARFEAG1yMBxp/KNRtDlbf28LIhoCd3l1UoQfBoduW1wXIg8MilAfkx8SAAwCnwqhCgADHxYiDQSqCAgBAQsLFxcWXia2IyEAOw=="
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleBrowserView";
	var $position 			= -10;
	
	function getCss() {
		$css =
			"
			.$this->moduleName a, .$this->moduleName div{
				display:block;
				float:left;		
			}
			";
		return $css;
	}
	
	function getHtml($cwdRelPath, $view) {
		$html = 
			"
			<div class='$this->moduleName' id='$this->moduleName' style='line-height:0.9;'>
				<div id='{$this->moduleName}BrowserCacheBackward' onclick='Sdl.$this->moduleName.main.onClickCacheBackward();' style='display:none;' title='" . text("BACKWARD") . "'>
					<img alt='[" . text("BACKWARD") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=backward'>
				</div>
				<div id='{$this->moduleName}BrowserCacheForward' onclick='Sdl.$this->moduleName.main.onClickCacheForward();' style='display:none;' title='" . text("FORWARD") . "'>
					<img alt='[" . text("FORWARD") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=forward'>
				</div>
				<a class='functionButton' href='?cwdRelPath=$cwdRelPath&view=$view' id='{$this->moduleName}BrowserReload' onclick='Sdl.$this->moduleName.main.onClickReload(); return false;' title='" . text("RELOAD") . "'>
					<img alt='[" . text("RELOAD") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=reload'>
				</a>
				<a class='functionButton' href='?view=$view' id='{$this->moduleName}BrowserRedirectHome' onclick='Sdl.$this->moduleName.main.onClickRedirectPermittedDir(); return false;' title='" . text("HOME") . "'>
					<img alt='[" . text("HOME") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=home'>
				</a>
				<a class='functionButton' href='?cwdRelPath=$cwdRelPath&view=list' id='{$this->moduleName}BrowserViewList' onclick='Sdl.$this->moduleName.main.onClickViewList(); return false;' title='" . text("LIST VIEW") . "'>
					<img alt='[" . text("LIST VIEW") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=viewList'>
				</a>
				<a class='functionButton' href='?cwdRelPath=$cwdRelPath&view=thumbnail' id='{$this->moduleName}BrowserViewThumbnail' onclick='Sdl.$this->moduleName.main.onClickViewThumbnail(); return false;' title='" . text("THUMBNAIL VIEW") . "'>
					<img alt='[" . text("THUMBNAIL VIEW") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=viewThumbnail'>
				</a>
			</div>
			";
		return $html;
	}

	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.$this->moduleName.Main.prototype = {
	onClickCacheBackward : function() {
		Sdl.browser.cacheBackward();
	},
	
	onClickCacheForward : function() {
		Sdl.browser.cacheForward();
	},
	
	onClickRedirectPermittedDir : function() {
		Sdl.browser.redirectPermittedDir();
	},
	
	onClickReload : function() {
		Sdl.browser.reloadDirListing();
	},
	
	onClickViewList : function() {
		Sdl.browser.setView('list');
	},
	
	onClickViewThumbnail : function() {
		Sdl.browser.setView('thumbnail');
	},
		
	windowOnLoadListener : function() {
		document.getElementById('{$this->moduleName}BrowserCacheBackward').style.display = 'block';
		document.getElementById('{$this->moduleName}BrowserCacheForward').style.display = 'block';
		document.getElementById('{$this->moduleName}BrowserReload').removeAttribute('href');
		document.getElementById('{$this->moduleName}BrowserRedirectHome').removeAttribute('href');
		document.getElementById('{$this->moduleName}BrowserViewList').removeAttribute('href');
		document.getElementById('{$this->moduleName}BrowserViewThumbnail').removeAttribute('href');
		Sdl.Button.decorateById('{$this->moduleName}BrowserViewList');
		Sdl.Button.decorateById('{$this->moduleName}BrowserViewThumbnail');
		Sdl.Button.decorateById('{$this->moduleName}BrowserReload');
		Sdl.Button.decorateById('{$this->moduleName}BrowserRedirectHome');
		Sdl.Button.decorateById('{$this->moduleName}BrowserCacheBackward');
		Sdl.Button.decorateById('{$this->moduleName}BrowserCacheForward');
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleChangeMode
//------------------------------------------------------------------------------
define("MODULECHANGEMODE_ON"			, true);
define("MODULECHANGEMODE_ADMIN_MODE_ON"	, true);
define("MODULECHANGEMODE_USER_MODE_ON"	, false);
define("MODULECHANGEMODE_FTP_LAYER_ON"	, true);

class ModuleChangeMode extends Module {
	var $enabled 			= MODULECHANGEMODE_ON;
	var $enabledAdminMode 	= MODULECHANGEMODE_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULECHANGEMODE_USER_MODE_ON;
	var $icons = array(
		"changeMode"	=> "R0lGODlhEAAQAMQfAO/v79GdFee+Su/TbvPdgMXFxevJXeO0OPrhkfz10v354v3328SCDti0If377dSlF+vr68mMEcfHx/rwucySEvvzx9XV1ditGvnsqNy2HMN/Dffnkvnadq2trf///////yH5BAEAAB8ALAAAAAAQABAAAAV24CeKXmmOKNmtrJeqniVLReeing2wq2TjnZ0pV7uphKZOceTJdCCdRibTUHYut6bHoVgkEpUJBhHIZhSYzYYwMAgOiIgZrWa74QzzIr1uvzkaZgl8dn+BJBmDdX4HgFkXCBySk5OHHx4PARQRDBqen5ZDoqIfIQA7"
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleChangeMode";
	var $position 			= 40;
	var $requiredModules 	= array("ModuleSelector");
	
	// added in 2.1;
	var $ftpLayerOn 		= MODULECHANGEMODE_FTP_LAYER_ON;
	
	// edited in 2.1;
	function action() {
		$relPath = $_POST["moduleParams"]["relPath"];
		$newFileMode = $_POST["moduleParams"]["newFileMode"];
		$file = $this->fileManager->getFileByRelPath($relPath);
		$xml = new Xml();
		if ($file) {
			if($file->isPermitted) {
				$result = $this->sysChmod($file->absPath, octdec($newFileMode));
				if ($result !== false) {
					$xml->setStatusSuccess();
					$xml->setMessage("/$file->relPath " . text("HAS BEEN SUCCESSFULLY CHANGED TO A NEW MODE") . " $newFileMode .");
				} else if ($result === -1) {
					$xml->setError("Change mode by FTP(ftp_chmod) is not supported in your PHP version. Please use PHP 5 or above.");
				} else {
					$xml->setError(text("ACCESS DENIED"));
				}
			} else {
				$xml->setError(text("ACCESS DENIED"));
			}
		} else {
			$xml->setError(text("ACCESS DENIED"));
		}
		$xml->dump();	
	}
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}ChangeMode' onclick='Sdl.$this->moduleName.main.onClickChangeMode();' style='float:left' title='" . text("CHANGE MODE") . "'>
					<img alt='[" . text("CHANGE MODE") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=changeMode'>
				</div>
			</div>
			";		
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;

	this.ajaxActionChangeMode = function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
		}
	}
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
};

Sdl.$this->moduleName.Main.prototype = {
	changeMode : function(relPath, newFileMode) {
		var param;
		param =	'moduleParams[relPath]=' + relPath + '&' +
				'moduleParams[newFileMode]=' + newFileMode;
		Sdl.Ajax.ajaxPost(this.ajaxActionChangeMode, '?action=module&module=$this->moduleName', param);
	},
	
	onClickChangeMode : function() {
		if (Sdl.browser.status.success) {
			var newFileMode, oldFileMode, selectedFile;
			selectedFile = Sdl.ModuleSelector.main.getSingleSelectedFileAndWarn();
			if (selectedFile) {
				oldFileMode = document.getElementById('ModuleFileMode_' + selectedFile.id).innerHTML;
				newFileMode = prompt('" . text("PLEASE ENTER A NEW FILE MODE") . "', oldFileMode);
				if (newFileMode && newFileMode != '') {
					this.changeMode(selectedFile.relPath, newFileMode);
				}				
			}
		}
	},
	
	windowOnLoadListener : function() {
		document.getElementById('{$this->moduleName}').style.display = 'block';
		Sdl.Button.decorateById('{$this->moduleName}ChangeMode');
	}
}
Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleCopyMove
//------------------------------------------------------------------------------
define("MODULECOPYMOVE_ON"				, true);
define("MODULECOPYMOVE_ADMIN_MODE_ON"	, true);
define("MODULECOPYMOVE_USER_MODE_ON"	, false);
define("MODULECOPYMOVE_FTP_LAYER_ON"	, true);

class ModuleCopyMove extends Module {
	var $enabled 			= MODULECOPYMOVE_ON;
	var $enabledAdminMode 	= MODULECOPYMOVE_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULECOPYMOVE_USER_MODE_ON;
	var $icons = array(
		"cut"	=> "R0lGODlhEAAQAMQfALm7y/n5+3aQrZTI+hsjTu/0+abS+0tVcllqiuXs9dHT22h6m7vc/Yi237PZ/FRheeTl69Tq/o2Rqq7S5JqetMHg/Z6ht6irvlheg9/o70BIWDI5Z5/D177Z6P///////yH5BAEAAB8ALAAAAAAQABAAAAWM4CeOZFl6aJqan9dNE9cItGeqXpEkw2KTHgDAE6lUCo0G4tcKHCABQIRRqC5bqMtBcbB4GA5H4YEKKCCbDYHydRgMhQNKIkEQCJf225CQe3wUBBgBFWB7CRpzEhgQAF5uBgMDGYkeZgIAFHmQkgWJWAkSFwEoCRkZBQoETCkICA8HGrIEZCc4OCy5HyEAOw=="
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleCopyMove";
	var $position 			= 35;
	var $requiredModules 	= array("ModuleSelector");
	var $ftpLayerOn 		= MODULECOPYMOVE_FTP_LAYER_ON;

	function action() {
		error_reporting(0);
		$relPaths = $_POST["moduleParams"]["relPaths"];
		$cwdRelPath = $_POST["moduleParams"]["cwdRelPath"];
		$action = $_POST["moduleParams"]["action"];
		$cwd = $this->fileManager->getFileByRelPath($cwdRelPath);
		$xml = new Xml();
		if($cwd) {
			if ($cwd->isPermitted) {
				$success = array();
				$failure = array();
				foreach ($relPaths as $relPath) {
					$file = $this->fileManager->getFileByRelPath($relPath);		
					if ($file) {
						if ($file->isPermitted) {
							if ($action === "copy") {$this->copy($file->absPath, $cwd->absPath, $success, $failure);}
							else if ($action === "move") {$this->move($file->absPath, $cwd->absPath, $success, $failure);}
						} else {
							$failure[] = array("src" => $this->user->virtualRootAbsPath . $relPath, "des" => $cwd->absPath . basename($relPath));
						}
					} else {
						$failure[] = array("src" => $this->user->virtualRootAbsPath . $relPath, "des" => $cwd->absPath . basename($relPath));
					}
				}
				sort($success);
				sort($failure);
				$xml->setStatusSuccess();
				$content = null;
				if ($action === "copy") {$content .= text("SUCCESSFULLY COPIED") . " :<br>";}
				else if ($action === "move") {$content .= text("SUCCESSFULLY MOVED") . " :<br>";}
				foreach ($success as $absPath) {
					$content .= "/" . $this->fileManager->absPathToRelPath($absPath["src"]) . " -> " . "/" . $this->fileManager->absPathToRelPath($absPath["des"]) . "<br>";
				}
				if ($action === "copy") {$content .= "<br>" . text("FAILED TO COPY") . " :<br>";}
				else if ($action === "move") {$content .= "<br>" . text("FAILED TO MOVE") . " :<br>";}
				foreach ($failure as $absPath) {
					$content .= "/" . $this->fileManager->absPathToRelPath($absPath["src"]) . " -> " . "/" . $this->fileManager->absPathToRelPath($absPath["des"]) . "<br>";
				}
				$xml -> setContent($content);
			} else {
				$xml->setError(text("ACCESS DENIED"));
			}
		} else {
			$xml->setError(text("ACCESS DENIED"));
		}
		$xml->dump();	
	}
	
	// edited in 2.1;
	function copy($srcAbsPath, $desDirAbsPath, &$success, &$failure){
		if (is_dir($srcAbsPath)) {
			$nextDesDirAbsPath = $desDirAbsPath . basename($srcAbsPath) . "/";
			if (strpos($nextDesDirAbsPath, $srcAbsPath) === 0) {
				$failure[] = array("src" => $srcAbsPath, "des" => $nextDesDirAbsPath);
				} else {
				if ($this->sysMkdir($nextDesDirAbsPath)) {
					$success[] = array("src" => $srcAbsPath, "des" => $nextDesDirAbsPath);
					$dirHandle = opendir($srcAbsPath);
					while ($basename = readdir($dirHandle)) {
						$nextSrcAbsPath = $srcAbsPath . $basename;
						switch (true) {  
							case ($basename=="."):
								break;
							case ($basename==".."):
								break;
							case (is_dir($nextSrcAbsPath)):
								$nextSrcAbsPath .= "/";
								ModuleCopyMove::copy($nextSrcAbsPath, $nextDesDirAbsPath, $success, $failure);
								break;
							default:
								if ($this->sysCopy($nextSrcAbsPath, $nextDesDirAbsPath . $basename)) {
									$success[] = array("src" => $nextSrcAbsPath, "des" => $nextDesDirAbsPath . $basename);
								} else {
									$failure[] = array("src" => $nextSrcAbsPath, "des" => $nextDesDirAbsPath . $basename);
								}
								break;
						}
					}
					closedir($dirHandle);
				} else {
					$failure[] = array("src" => $srcAbsPath, "des" => $nextDesDirAbsPath);
				}
			}
		} else {
			if ($this->sysCopy($srcAbsPath, $desDirAbsPath . basename($srcAbsPath))) {
				$success[] = array("src" => $srcAbsPath, "des" => $desDirAbsPath . basename($srcAbsPath));
			} else {
				$failure[] = array("src" => $srcAbsPath, "des" => $desDirAbsPath . basename($srcAbsPath));
			}
		}	
	}
	
	function getCss() {
		$css =
			"
			.$this->moduleName input, .$this->moduleName select{
				font-size:0.8em;
			}
			";
		return $css;
	}
	
	function getHtml() {
		/* Button is set overflow:hidden for Safari 3 beta. Otherwise button
		would disappear after onClick show/hide the panel and onmouseout. */
		$html = 
			"
			<div class='$this->moduleName' id='$this->moduleName' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}CopyMove' onclick='Sdl.$this->moduleName.main.onClickShowHide();' style='float:left; overflow:hidden;' title='" . text("COPY/MOVE") . "'>
					<img alt='[" . text("COPY/MOVE") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=cut'>
				</div>
				<div style='display:none; float:left; white-space:nowrap;' id='{$this->moduleName}Panel'>
					<span id='{$this->moduleName}FileContainer'></span><input onclick='Sdl.$this->moduleName.main.onClickMove();' type='button' value='" . text("MOVE TO HERE") . "'><input onclick='Sdl.$this->moduleName.main.onClickCopy();' type='button' value='" . text("COPY TO HERE") . "'>
				</div>
			</div>
			";		
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.fileContainer = new Sdl.FileContainer();
	
	this.ajaxActionCopy = function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
			this_clone.showResult('copy', response.content);
		}
	}
	
	this.ajaxActionMove = function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
			this_clone.showResult('move', response.content);
		}
	}
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
};

Sdl.$this->moduleName.Main.prototype = {
	copy : function(cwdRelPath, relPaths) {
		var param = '';
		param += 'moduleParams[action]=copy' + '&';
		param += 'moduleParams[cwdRelPath]=' + cwdRelPath + '&';
		for (var i = 0 ; i < relPaths.length ; i++) {
			param += 'moduleParams[relPaths][' + i + ']=' + relPaths[i] + '&';
		}
		Sdl.Ajax.ajaxPost(this.ajaxActionCopy, '?action=module&module=$this->moduleName', param);
	},

	copyMove : function(action) {
		if (this.fileContainer.files.length > 0) {
			if (Sdl.browser.status.success && Sdl.browser.cwd) {
				var confirm, text;
				if (action == 'copy') {text = '" . text("ARE YOU SURE YOU WANT TO COPY ALL THESE") . " ';}
				else if (action == 'move') {text = '" . text("ARE YOU SURE YOU WANT TO MOVE ALL THESE") . " ';}
				confirm = window.confirm(text + this.fileContainer.files.length + ' files/directories?');
				if (confirm) {
					var relPaths = [];
					for (var i = 0 ; i < this.fileContainer.files.length ; i++) {
						relPaths.push(this.fileContainer.files[i].relPath);
					}
					if (action == 'copy') {this.copy(Sdl.browser.cwd.relPath, relPaths);}
					else if (action == 'move') {this.move(Sdl.browser.cwd.relPath, relPaths);}
				}
			} else {
				alert('Invalid current working directory.');
			}		
		} else {
			alert('Please select files.');
		}
	},
	
	move : function(cwdRelPath, relPaths) {
		var param = '';
		param += 'moduleParams[action]=move' + '&';
		param += 'moduleParams[cwdRelPath]=' + cwdRelPath + '&';
		for (var i = 0 ; i < relPaths.length ; i++) {
			param += 'moduleParams[relPaths][' + i + ']=' + relPaths[i] + '&';
		}
		Sdl.Ajax.ajaxPost(this.ajaxActionMove, '?action=module&module=$this->moduleName', param);
	},

	onClickCopy : function() {
		this.copyMove('copy');
	},
	
	onClickMove : function() {
		this.copyMove('move');
	},

	onClickShowHide : function() {
		var panel = document.getElementById('{$this->moduleName}Panel');
		if (panel.style.display == 'block') {
			panel.style.display = 'none';
		} else {
			panel.style.display = 'block';
			// For Opera 9.21. When it's clicked, the panel floats down until mouse moves or until onmouseout.
			if (Sdl.System.isOpera()) {
				document.getElementById('{$this->moduleName}CopyMove').onmouseout();
				document.getElementById('{$this->moduleName}CopyMove').onmouseover();
			}
		}
	},
	
	showResult : function(action, result) {
		var content, page, tabContent, text;
		page = new Sdl.Page();
		content = document.createElement('div');
		content.innerHTML = result;
		content.style.overflow = 'hidden';
		page.content = content;
		tabContent = document.createElement('div');
		if (action == 'copy') {text = 'Result:copy';}
		else {text = 'Result:move';}
		tabContent.innerHTML = text;
		page.tabContent = tabContent;
		page.movableBar.setMoveTarget(page.content);
		Sdl.pageManager.addPage(page);	
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'inline';
		Sdl.Button.decorateById('{$this->moduleName}CopyMove');
		this.fileContainer.setFileContainer(document.getElementById('{$this->moduleName}FileContainer'));		
	}
}
Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}

	// edited in 2.1;
	function move($absPath, $dirAbsPath, &$success, &$failure) {
		if ($this->sysRename($absPath, $dirAbsPath . basename($absPath))) {$success[] = array("src" => $absPath, "des" => $dirAbsPath . basename($absPath));}
		else {$failure[] = array("src" => $absPath, "des" => $dirAbsPath . basename($absPath));}
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleCreateFile
//------------------------------------------------------------------------------
define("MODULECREATEFILE_ON"			, true);
define("MODULECREATEFILE_ADMIN_MODE_ON"	, true);
define("MODULECREATEFILE_USER_MODE_ON"	, false);
define("MODULECREATEFILE_FTP_LAYER_ON"	, true);

class ModuleCreateFile extends Module {
	var $enabled 			= MODULECREATEFILE_ON;
	var $enabledAdminMode 	= MODULECREATEFILE_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULECREATEFILE_USER_MODE_ON;
	var $icons = array(
		"createFile"	=> "R0lGODlhEAAQANUoAOLp8ElVa0NLXIivyJXK/D5FVYm77N7n7ykxQ5rA1svM0YS8O4C4OJXJSInAP5fLS362N4/ERJLHR5DFRdXb5JbKStXn8HqzM4vAQJ7O+1Jhe1dwkezx9nKsLeXt9XaXtKTR+7HX/PL2+sDf/bvc/avU+7ba/P///////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAACgALAAAAAAQABAAAAaXwJNwSByijifLqdM5JQaDj/RzQgofjaFn6zFsqsuKJOJojs4ig1fYmWAWEDOJJKpriIzLcEQymUIid05LZnx+ISWBQgNEc3+IiQGLImd9fyUlICAekicfHJWXmSAZHgJCn46QmhkZAKeeHJaIrAQEBwWoIn2rrbYcuScbFCIcWwDIAAccCgioG9AaGgEBAgIFBQiCRdxEQQA7",
		"createDir"		=> "R0lGODlhEAAQANUnAP/3xffkl+vPMfbgjf3zxP7ztvnpofz36PPbg/vuw+3Oaf/78/HVdvbjqvjqtfz0z/bmsPnqvYvAQI/ERJfLS//204nAP5XJSHqzM5bKSoS8O5LHR362N4C4OJDFReu8Ruu2PeuyN+vGUXKsLeuuMvzurP///////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAACcALAAAAAAQABAAAAaFwNPJRDQJj8ijaTQyJpFFyqX4FC4zm4mlWewSRx6JhtNUiESCtKDbwRQB8EIBsB4umwDRZw8ChUhGXiIHhAkJDgSAQyILjQclJQYBAQMJiiYiFXKQkgMICA6XIg+QkZQIDAwQlx8EnKcMCgoNrAQPDwQJEQ4QDQ0RrH3CIcTFl17IVFXLQQA7",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleCreateFile";
	var $position 			= 20;
	var $ftpLayerOn 		= MODULECREATEFILE_FTP_LAYER_ON;
	
	// edited in 2.1;
	function action() {
		$cwdRelPath = $_POST["moduleParams"]["cwdRelPath"];
		$filename = $_POST["moduleParams"]["filename"];
		$type = $_POST["moduleParams"]["type"];
		$cwd = $this->fileManager->getFileByRelPath($cwdRelPath);
		$xml = new Xml();
		if ($cwd) {
			if ($cwd->isPermitted) {
				$absPath = $cwd->absPath . $filename;
				if (file_exists($absPath)) {
					$xml->setError(text("FILE WITH SAME NAME EXISTS"));
				} else {
					if ($type === "file") {
						if ($this->sysTouch($absPath)) {
							$xml->setStatusSuccess();
							$xml->setMessage("$filename " . text("HAS BEEN SUCCESSFULLY CREATED IN") . " /$cwd->relPath .");
						} else {
							$xml->setError(text("ACCESS DENIED"));
						}
					} elseif ($type === "dir") {
						if ($this->sysMkdir($absPath)) {
							$xml->setStatusSuccess();
							$xml->setMessage("$filename " . text("HAS BEEN SUCCESSFULLY CREATED IN") . " /$cwd->relPath .");
						} else {
							$xml->setError(text("ACCESS DENIED"));
						}
					} else {
						$xml->setError(text("ACCESS DENIED"));
					}
				}
			} else {
				$xml->setError(text("ACCESS DENIED"));
			}
		} else {
			$xml->setError(text("ACCESS DENIED"));
		}
		$xml->dump();
	}
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9'>
				<div id='{$this->moduleName}CreateFile' onclick='Sdl.$this->moduleName.main.onClickCreateFile();' style='float:left;' title='" . text("CREATE FILE") . "'>
					<img alt='[" . text("CREATE FILE") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=createFile'>
				</div>
				<div id='{$this->moduleName}CreateDir' onclick='Sdl.$this->moduleName.main.onClickCreateDir();' style='float:left' title='" . text("CREATE DIRECTORY") . "'>
					<img alt='[" . text("CREATE DIRECTORY") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=createDir'>
				</div>
			</div>
			";
		return $html;
	}

	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;

	this.ajaxActionCreate = function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
		}
	}
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.$this->moduleName.Main.prototype = {
	createDir : function(cwdRelPath, filename) {
		var param;
		param =	'moduleParams[cwdRelPath]=' + cwdRelPath + '&' +
				'moduleParams[filename]=' + filename + '&' +
				'moduleParams[type]=dir';
		Sdl.Ajax.ajaxPost(this.ajaxActionCreate, '?action=module&module=$this->moduleName', param);
	},

	createFile : function(cwdRelPath, filename) {
		var param;
		param =	'moduleParams[cwdRelPath]=' + cwdRelPath + '&' +
				'moduleParams[filename]=' + filename + '&' +
				'moduleParams[type]=file';
		Sdl.Ajax.ajaxPost(this.ajaxActionCreate, '?action=module&module=$this->moduleName', param);
	},
	
	onClickCreateDir : function() {
		if (Sdl.browser.status.success && Sdl.browser.cwd) {
			var filename;
			filename = prompt('" . text("PLEASE ENTER A DIRECTORY NAME") . "', '" . text("NEWDIR") . "');
			if (filename != '' && filename != null) {
				this.createDir(Sdl.browser.cwd.relPath, filename);
			}
		} else {
			alert('" . text("INVALID CURRENT WORKING DIRECTORY") . "');
		}
	},
	
	onClickCreateFile : function() {
		if (Sdl.browser.status.success && Sdl.browser.cwd) {
			var filename;
			filename = prompt('" . text("PLEASE ENTER A FILENAME") . "', '" . text("NEWFILE.EXT") . "');
			if (filename != '' && filename != null) {
				this.createFile(Sdl.browser.cwd.relPath, filename);
			}
		} else {
			alert('" . text("INVALID CURRENT WORKING DIRECTORY") . "');
		}
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'inline';
		Sdl.Button.decorateById('{$this->moduleName}CreateFile');
		Sdl.Button.decorateById('{$this->moduleName}CreateDir');		
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleDelete
//------------------------------------------------------------------------------
define("MODULEDELETE_ON"			, true);
define("MODULEDELETE_ADMIN_MODE_ON"	, true);
define("MODULEDELETE_USER_MODE_ON"	, false);
define("MODULEDELETE_FTP_LAYER_ON"	, true);

class ModuleDelete extends Module {
	var $enabled 			= MODULEDELETE_ON;
	var $enabledAdminMode 	= MODULEDELETE_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEDELETE_USER_MODE_ON;
	var $icons = array(
		"delete"	=> "R0lGODlhEAAQANUiALba/OLp8ElVa0NLXIivyJXK/MDf/T5FVbvc/Ym77MvM0ZrA1t7n7ykxQ67T5dXn8LDR46jL3tXb5J7O+1Jhe1dwkbHX/KvU+6TR++zx9naXtMfj/u0xMeXt9fL2+u3x9s8dHf///////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAACIALAAAAAAQABAAAAaewJBwSByKjqGHAxJZLAgEjVQTQjoenUxW2+kmKtUQpLMplw1oT+IrjHg+5o8BgfDYKcLFBwTffxAAABYeeCEKIBx8iHyCF4RCBB6LiR8WFheOApBvi5WYGBgdmiEaGZN8F6ATHQNCh5SdGBMTAa2kfgB+sgUFDAdCGm+NH7ITvBm/IRUSHlwBzwEMGQoNwBXXFBQCAgMDBwcNhUXjREEAOw==",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleDelete";
	var $position 			= 50;
	var $requiredModules 	= array("ModuleSelector");
	var $ftpLayerOn 		= MODULEDELETE_FTP_LAYER_ON;

	// edited in 2.1;
	function action() {
		$relPaths = $_POST["moduleParams"]["relPaths"];
		$xml = new Xml();
			$success = array();
			$failure = array();
			foreach ($relPaths as $relPath) {
				$file = $this->fileManager->getFileByRelPath($relPath);		
				if ($file) {
					if ($file->isPermitted) {
						$this->deleteFile($file->absPath, $success, $failure);
					} else {
						$failure[] = $file->absPath;	
					}
				} else {
					$failure[] = $file->absPath;
				}
			}
			sort($success);
			sort($failure);
			$xml->setStatusSuccess();
			$content = null;
			$content = text("SUCCESSFULLY DELETED") . " :<br>";
			foreach ($success as $absPath) {
				$content .= "/" . $this->fileManager->absPathToRelPath($absPath) . "<br>";
			}
			$content .= "<br>" . text("FAILED TO DELETE") . " :<br>";
			foreach ($failure as $absPath) {
				$content .= "/" . $this->fileManager->absPathToRelPath($absPath) . "<br>";
			}
			$xml -> setContent($content);
		$xml->dump();	
	}
	
	function deleteFile($absPath, &$success, &$failure) {
		if(is_dir($absPath)){
			$dirHandle = opendir($absPath);
			while ($basename = readdir($dirHandle)){
				$nextAbsPath = $absPath . $basename;
				switch (true) {  
					case ($basename=="."):
						break;
					case ($basename==".."):
						break;
					case (is_dir($nextAbsPath)):
						$nextAbsPath .= "/";
						ModuleDelete::deleteFile($nextAbsPath, $success, $failure);
						break;
					default:
						$this->sysUnlink($nextAbsPath) ? $success[] = $nextAbsPath : $failure[] = $nextAbsPath;
						break;
				}
			}
			closedir($dirHandle);
			if ($this->sysRmdir($absPath)) {$success[] = $absPath;}
			else {$failure[] = $absPath;}
		}else{
			if ($this->sysUnlink($absPath)) {$success[] = $absPath;}
			else {$failure[] = $absPath;}
		}		
	}
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}Delete' onclick='Sdl.$this->moduleName.main.onClickDelete();' style='float:left' title='" . text("DELETE") . "'>
					<img alt='[" . text("DELETE") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=delete'>
				</div>
			</div>
			";		
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;

	this.ajaxActionDelete = function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			var content, page, tabContent;
			Sdl.Xml.alertResponse(response);
			page = new Sdl.Page();
			content = document.createElement('div');
			content.style.overflow = 'hidden';
			content.innerHTML = response.content;
			page.content = content;
			tabContent = document.createElement('div');
			tabContent.innerHTML = '<nobr>Deletion result</nobr>';
			page.tabContent = tabContent;
			page.movableBar.setMoveTarget(page.content);
			Sdl.pageManager.addPage(page);	
		}
	}
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
};

Sdl.$this->moduleName.Main.prototype = {
	deleteFiles : function(relPaths) {
		var param = '';
		for (var i = 0 ; i < relPaths.length ; i++) {
			param += 'moduleParams[relPaths][' + i + ']=' + relPaths[i] + '&';
		}
		Sdl.Ajax.ajaxPost(this.ajaxActionDelete, '?action=module&module=$this->moduleName', param);
	},
	
	onClickDelete : function() {
		var selectedFiles, confirm;
		selectedFiles = Sdl.ModuleSelector.main.getSelectedFilesAndWarn();
		if (selectedFiles.length > 0) {
			confirm = window.confirm('" . text("ARE YOU SURE YOU WANT TO DELETE ALL THESE") . " ' + selectedFiles.length + ' " . text("FILES/DIRECTORIES") . "?');
			if (confirm) {
				var relPaths = [];
				for (var i = 0 ; i < selectedFiles.length ; i++) {
					relPaths.push(selectedFiles[i].relPath);
				}
				this.deleteFiles(relPaths);
			}				
		}
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'block';
		Sdl.Button.decorateById('{$this->moduleName}Delete');
	}
}
Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleDownload
//------------------------------------------------------------------------------
define("MODULEDOWNLOAD_ON"				, true);
define("MODULEDOWNLOAD_ADMIN_MODE_ON"	, true);
define("MODULEDOWNLOAD_USER_MODE_ON"	, false);

class ModuleDownload extends Module {
	var $enabled 			= MODULEDOWNLOAD_ON;
	var $enabledAdminMode 	= MODULEDOWNLOAD_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEDOWNLOAD_USER_MODE_ON;
	var $icons = array(
		"download"		=> "R0lGODlhEAAQAMQAAIWOl8rKyoibetPT02hoarm6usPDw/Pz89ra2uTk5Hl6e6mrpmGNRH2vWunp6e3t7ZPNX47LVbW1tZPIa5nXWvv7+1hZXfT2+HFxcfNXV2FhYZ6ens7OzvDw8GOPRf///yH5BAAAAAAALAAAAAAQABAAAAWf4CeOX9SQJGIYi+CZniBsQCEa5Nt44nUBIlvCQ6RMiB7ORRH8JCoeCAUSYVQ4H+ZH8kEgDp5Gg9HhYDGiRRcRODDIBvMH/VEPBgVJpyORyOl2d2aDcgQiGwd7D4sPDo6Ohh8bHSoFlpYSBRwOkZN3AxwBHxMGGQYJGocXn6EBKwYFHakfAAgXHY2PDgkdARYiAArCGBgExhrIFpEozCQhADs=",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleDownload";
	var $position 			= 70;
	var $requiredModules 	= array("ModuleSelector");
	
	function action() {
		if ($_GET["moduleParams"]["action"] === "download") {
			$relPath = $_GET["moduleParams"]["relPath"];
			$absPath = $this->fileManager->relPathToAbsPath($relPath);	
			$handle = fopen($absPath, "rb");
			$name = basename($absPath);
			header("Content-Type: application/octet-stream");
			header("Content-Length: " . filesize($absPath));
			header('Content-Disposition: attachment; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary\n");			
			fpassthru($handle);	
			exit(0);
		} else if ($_GET["moduleParams"]["action"] === "check") {
			$xml = new Xml();
			$relPath = $_POST["moduleParams"]["relPath"];
			$absPath = $this->fileManager->relPathToAbsPath($relPath);
			if ($absPath) {
				if (is_dir($absPath)) {
					$xml->setError(text("DIRECTORY IS NOT ACCEPTED"));
				} else {
					if (is_readable($absPath)) {
						$xml->setStatusSuccess();
						$link = "?action=module&module=$this->moduleName&moduleParams[action]=download&moduleParams[relPath]=$relPath";
						$xml->setContent($link);
					} else {
						$xml->setError(text("ACCESS DENIED"));
					}
					
				}
			} else {
				$xml->setError(text("ACCESS DENIED"));
			}
			$xml->dump();
		}
	}
	
	function getPageHtml($content, $relPath) {
		$content = htmlentities($content);
		$html = null;
		$html = 
			"
			<div>
				<span>$relPath</span>
				<pre>$content</pre>
			</div>
			";
		return $html;	
	}
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}Download' onclick='Sdl.$this->moduleName.main.onClickDownload();' style='float:left' title='" . text("DOWNLOAD") . "'>
					<img alt='[" . text("DOWNLOAD") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=download'>
				</div>
			</div>";
		return $html;
	}

	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.$this->moduleName.Main.prototype = {
	ajaxActionDownload : function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
			if (response.status.success) {
				window.open(response.content);
			}
		}
	},

	download : function(relPath) {
		var param;
		param =	'moduleParams[relPath]=' + relPath;
		Sdl.Ajax.ajaxPost(this.ajaxActionDownload, '?action=module&module=$this->moduleName&moduleParams[action]=check', param);
	},	
	
	onClickDownload : function() {
		var selectedFile;
		selectedFile = Sdl.ModuleSelector.main.getSingleSelectedFileAndWarn();
		if (selectedFile) {
			this.download(selectedFile.relPath);
		}
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'inline';
		Sdl.Button.decorateById('{$this->moduleName}Download');
	}
}
Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleEdit
//------------------------------------------------------------------------------
define("MODULEEDIT_ON"				, true);
define("MODULEEDIT_ADMIN_MODE_ON"	, true);
define("MODULEEDIT_USER_MODE_ON"	, false);
define("MODULEEDIT_FTP_LAYER_ON"	, true);

class ModuleEdit extends Module {
	var $enabled 			= MODULEEDIT_ON;
	var $enabledAdminMode 	= MODULEEDIT_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEEDIT_USER_MODE_ON;
	var $icons = array(
		"edit"		=> "R0lGODlhEAAQAMQAAGB3lYivyMDf/XiZt+Ts9ajT/Mbh/UlVa/P2+bLY/FRlfu3x9ZzN++Xy/rTR4ENLXN7v/tTk8Jm/1enx96jL3uDo7ykxQz5FVb2JAP+8Bv/RV6HQ/FSr9qfR+jhllf///yH5BAAAAAAALAAAAAAQABAAAAWV4CeOZClGjkNJUhAMsOdJohMRUz4RvNdxntrEQCQKGj6gQkRBFAXHpAex/EicBijy54FQRddslAspfD8BhBZDLpgPovQRo8l0C50NAf4ZLBp0GRhleXoPIn4RdYN4GxsMFYd9CwkKlgoAAwybFReICAkJeAUDAKYAC54fABEIOzwEFbILDhaImJcHBw8PFxcWVSbCIiEAOw==",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleEdit";
	var $position 			= 95;
	var $requiredModules 	= array("ModuleFilename", "ModuleSelector");
	var $ftpLayerOn 		= MODULEEDIT_FTP_LAYER_ON;
		
	function action() {
		$action = $relPath = $_POST["moduleParams"]["action"];
		if ($action === "edit") {
			$relPath = $_POST["moduleParams"]["relPath"];
			$file = $this->fileManager->getFileByRelPath($relPath);
			$xml = new Xml();
			if ($file) {
				if ($file->isPermitted) {
					if ($file->isDir) {
						$content = text("DIRECTORY IS NOT ACCEPTED");
					} else {
						$content = file_get_contents($file->absPath);
						if ($content === false) {$response = text("ACCESS DENIED");}
						else {$content = $this->getPageHtml($content, $relPath, $_POST["moduleParams"]["pageId"]);}
					}
				} else {
					$content = text("ACCESS DENIED");
				}
			} else {
				$content = text("ACCESS DENIED");
			}
			echo $content;
		} else if ($action === "save") {
			$relPath = $_POST["moduleParams"]["relPath"];
			$text = $_POST["moduleParams"]["text"];
			$file = $this->fileManager->getFileByRelPath($relPath);
			$xml = new Xml();
			if ($file) {
				if ($file->isPermitted) {
					if ($file->isDir) {
						$xml->setErrorFileWithSameNameExist();
					} else {
						if ($this->sysWrite($file->absPath, $text)) {
							$xml->setStatusSuccess();
							$xml->setMessage(text("FILE HAS BEEN SUCCESSFULLY SAVED"));
						} else {
							$xml->setError("ACCESS DENIED");
						}
						/*
						$handle = fopen($file->absPath, 'w');
						if ($handle) {
							if (fwrite($handle, $text) === false) {
								$xml->setError("ACCESS DENIED");
							} else {
								$xml->setStatusSuccess();
								$xml->setMessage(text("FILE HAS BEEN SUCCESSFULLY SAVED"));
							}
						} else  {
							$xml->setError("ACCESS DENIED");
						}
						fclose($handle);
						*/
					}
				} else {
					$xml->setError(text("ACCESS DENIED"));
				}
			} else {
				$xml->setError(text("ACCESS DENIED"));
			}
			$xml->dump();		
		}
	}
	
	function write($absPath, $content) {
		$handle = fopen($absPath, 'w');
		if ($handle) {
			if (fwrite($handle, $content) === false) {
				fclose($handle);
				return false;
			} else {
				fclose($handle);
				return true;
			}
		}
		return false;
	}
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}Edit' onclick='Sdl.$this->moduleName.main.onClickEdit();' style='float:left' title='Edit'>
					<img alt='[Edit]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=edit'>
				</div>
			</div>
			";
		return $html;
	}

	function getPageHtml($content, $relPath, $pageId) {
		$content = Text::htmlentitiesUtf8($content);
		$html = null;
		$html = 
			"
			<div>
				<div>File : /$relPath</div>
				<div><input id='{$this->moduleName}Save_$pageId' type='button' value='Save'></div>
				<div><textarea id='{$this->moduleName}Textarea_$pageId' wrap='off' style='height:300px;min-height:100px;width:100%;'>$content</textarea></div>
			</div>
			";
		return $html;	
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Edit = function(){
	var this_clone = this;
	this.file = null;
	this.page = null;
	this.pageId = null;

	this.ajaxActionEditPass = function(xhr) {
		this_clone.ajaxActionEdit(xhr);
	}
	this.ajaxActionSavePass = function(xhr) {
		this_clone.ajaxActionSave(xhr);
	}	
	this.onClickSave = function() {
		this_clone.save();
	}
};

Sdl.$this->moduleName.Edit.prototype = {
	addPage : function() {
		var content, tabContent;
		this.page = new Sdl.Page();
		content = document.createElement('div');
		content.innerHTML = 'Loading...';
		content.style.padding = '0px 5px';
		this.page.content = content;
		tabContent = document.createElement('div');
		tabContent.innerHTML = 'Edit:Loading';
		this.page.tabContent = tabContent;
		this.page.movableBar.isDefaultLocked = true;
		this.page.movableBar.unlockType = 'scrollHeight';
		Sdl.pageManager.addPage(this.page);
	},
	
	ajaxActionEdit : function(xhr) {
		var div
		this.page.content.innerHTML = xhr.responseText;
		this.page.tabContent.innerHTML = '<nobr>Edit:' + this.file.filename + '</nobr>';
		div = document.getElementById('{$this->moduleName}Textarea_' + this.pageId);
		if (div){
			this.page.movableBar.setMoveTarget(document.getElementById('{$this->moduleName}Textarea_' + this.pageId));
			document.getElementById('{$this->moduleName}Save_' + this.pageId).onclick = this.onClickSave;
		}
	},
	
	ajaxActionSave : function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
		}
	},
	
	edit : function() {
		var param;
		param =	'moduleParams[relPath]=' + this.file.relPath + '&' +
				'moduleParams[pageId]=' + this.pageId + '&' +
				'moduleParams[action]=edit';
		Sdl.Ajax.ajaxPost(this.ajaxActionEditPass, '?action=module&module=$this->moduleName', param);						
	},
	
	save : function() {
		var text;
		text = document.getElementById('{$this->moduleName}Textarea_' + this.pageId).value;
		var param;
		param =	'moduleParams[relPath]=' + this.file.relPath + '&' +
				'moduleParams[text]=' + encodeURIComponent(text) + '&' + 
				'moduleParams[action]=save';
		Sdl.Ajax.ajaxPost(this.ajaxActionSavePass, '?action=module&module=$this->moduleName', param);
	}
}

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.pages = [];
	this.pageIdIndex = 0;
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.$this->moduleName.Main.prototype = {
	onClickEdit : function() {
		var newFilename, oldFilename, selectedFile;
		selectedFile = Sdl.ModuleSelector.main.getSingleSelectedFileAndWarn();
		if (selectedFile) {
			var edit = new Sdl.$this->moduleName.Edit;
			edit.file = selectedFile;
			edit.pageId = this.pageIdIndex++;
			edit.addPage();
			edit.edit();
		}
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'block';
		Sdl.Button.decorateById('{$this->moduleName}Edit');
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleFileMode
//------------------------------------------------------------------------------
define("MODULEFILEMODE_ON"				, true);
define("MODULEFILEMODE_ADMIN_MODE_ON"	, true);
define("MODULEFILEMODE_USER_MODE_ON"	, true);

class ModuleFileMode extends Module {
	var $enabled 			= MODULEFILEMODE_ON;
	var $enabledAdminMode 	= MODULEFILEMODE_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEFILEMODE_USER_MODE_ON;
	var $isAttribute 		= true;
	var $moduleName 		= "ModuleFileMode";
	var $position 			= 30;

	function getCss() {
		$css =
"
.{$this->moduleName}HeaderViewList {
	margin:0em 0.5em;
	text-align:center;
	white-space:nowrap;
	width:3em;
}
.{$this->moduleName}ViewList {
	margin:0em 0.5em;
	text-align:center;
	white-space:nowrap;
	width:3em;
}
.{$this->moduleName}ViewThumbnail {
	font-size:0.9em;
	white-space:nowrap;
}
";
		return $css;
	}

	function getHeader() {
		return "<div class='{$this->moduleName}HeaderViewList'><span id='{$this->moduleName}Header'>" . text("MODE") . "</span></div>";
	}
	
	function getHtml($file, $id, $view) {
		if ($view == "list") {$className = "{$this->moduleName}ViewList";}
		else if ($view == "thumbnail") {$className = "{$this->moduleName}ViewThumbnail";}		
		$mode = substr(sprintf('%o', fileperms($file->absPath)), -3);
		$html = "<div class='$className' id='{$this->moduleName}_$id'>$mode</div><div id='{$this->moduleName}SortValue_$id' style='display:none'>$mode</div>";
		return $html;
	}

	function getHtmlParentDirectory($relPath, $view) {
		$html = "<div class='{$this->moduleName}ViewList'></div>";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.sort = new Sdl.Sort();
	this.sort.setDefaultOrder(1);
	this.sort.attribute = '$this->moduleName';
	this.sort.type = 'numeric';

	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener()});
}

Sdl.$this->moduleName.Main.prototype = {
	windowOnLoadListener : function() {
		var div = document.getElementById('{$this->moduleName}Header');
		this.sort.setSortButton(div);	
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";		
		return $javascript;
	}
	
	function getRss($file, $fileId) {
		return "[" . text("FILE MODE") . ": " . substr(sprintf('%o', fileperms($file->absPath)), -3) . "] ";
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleFileMTime
//------------------------------------------------------------------------------
define("MODULEFILEMTIME_ON"				, true);
define("MODULEFILEMTIME_ADMIN_MODE_ON"	, true);
define("MODULEFILEMTIME_USER_MODE_ON"	, true);
define("MODULEFILEMTIME_TIME_OFFSET"	, 0);

class ModuleFileMTime extends Module {
	var $enabled 			= MODULEFILEMTIME_ON;
	var $enabledAdminMode 	= MODULEFILEMTIME_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEFILEMTIME_USER_MODE_ON;
	var $header 			= "Last Modified";
	var $isAttribute 		= true;
	var $moduleName 		= "ModuleFileMTime";
	var $position 			= 40;

	function getCss() {
		$css =
"
.{$this->moduleName}HeaderViewList {
	margin:0em 0.5em;
	text-align:center;
	width:9em;
	white-space:nowrap;
}
.{$this->moduleName}ViewList {
	margin:0em 0.5em;
	text-align:right;
	width:9em;
	white-space:nowrap;
	white-space:nowrap;
}
.{$this->moduleName}ViewThumbnail {
	white-space:nowrap;
	font-size:0.9em;
}
";
		return $css;
	}
	
	function getHeader() {
		return "<div class='{$this->moduleName}HeaderViewList'><span id='{$this->moduleName}Header'>" . text("LAST MODIFIED") . "</span></div>";
	}
	
	function getHtml($file, $id, $view) {
		$timestamp = filemtime($file->absPath) + MODULEFILEMTIME_TIME_OFFSET * 3600;
		if ($view == "list") {
			$className = "{$this->moduleName}ViewList";
			$mtime = date('d-M-Y H:i', $timestamp);
		} else if ($view == "thumbnail") {
			$className = "{$this->moduleName}ViewThumbnail";
			$mtime = date('d-M-y H:i', $timestamp);
		}
		$html = 
			"
			<div class='$className' id='{$this->moduleName}_$id'>$mtime</div>
			<div id='{$this->moduleName}SortValue_$id' style='display:none'>" . $timestamp . "</div>
			";
		return $html;
	}
	
	function getHtmlParentDirectory($file, $view) {
		$html = "<div class='{$this->moduleName}ViewList'></div>";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.sort = new Sdl.Sort();
	this.sort.setDefaultOrder(1);
	this.sort.attribute = '{$this->moduleName}SortValue';
	this.sort.type = 'numeric';

	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener()});
}

Sdl.$this->moduleName.Main.prototype = {
	windowOnLoadListener : function() {
		var div = document.getElementById('{$this->moduleName}Header');
		this.sort.setSortButton(div);	
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";		
		return $javascript;
	}
	
	function getRss($file, $fileId) {
		$timestamp = filemtime($file->absPath) + MODULEFILEMTIME_TIME_OFFSET * 3600;
		return "[" . text("LAST MODIFIED") . ": " . date('d-M-Y H:i', $timestamp) . "] ";
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleFilename
//------------------------------------------------------------------------------
define("MODULEFILENAME_ON"				, true);
define("MODULEFILENAME_ADMIN_MODE_ON"	, true);
define("MODULEFILENAME_USER_MODE_ON"	, true);
define("MODULEFILENAME_LOCALE_CLASS"	, "ModuleFilenameLocaleEnglishUS");

class ModuleFilename extends Module {
	var $enabled 			= MODULEFILENAME_ON;
	var $enabledAdminMode 	= MODULEFILENAME_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEFILENAME_USER_MODE_ON;
	var $isAttribute 		= true;
	var $localeClass 		= MODULEFILENAME_LOCALE_CLASS;
	var $moduleName 		= "ModuleFilename";
	var $position 			= 10;

	function getCss() {
		$css =
"
.{$this->moduleName}ViewList {
	overflow:hidden;
	margin:0em 0.5em;
	/*width:13.3em;*/
	width:20em;
	white-space:nowrap;
}
.{$this->moduleName}ViewThumbnail {
	white-space:nowrap;
	font-size:0.9em;
}
";
		return $css;
	}
	
	function getHeader() {
		return "<div class='{$this->moduleName}ViewList'><span id='{$this->moduleName}Header'>" . text("NAME") . "</span></div>";
	}
	
	function getHtml($file, $id, $view) {
		if ($view == "list") {
			$className = "{$this->moduleName}ViewList";
		} else if ($view == "thumbnail") {
			$className = "{$this->moduleName}ViewThumbnail";
		}
		if ($file->isDir) {
			$attribute = "<a href='?cwdRelPath={$file->relPath}&view=$view' onclick='Sdl.$this->moduleName.main.onClickRedirect(event, \"$file->relPath\"); return false;' style='text-decoration:underline'>$file->basename</a>";
		} else {
			if($file->url) {
				$attribute = "<a href='$file->url' onclick='Sdl.Event.stopPropagation(event);' style='text-decoration:none' target='_blank'>$file->basename</a>";
			} else {
				$attribute = "<span style='text-decoration:none'>$file->basename</span>";
			}
		}
		$html = 
			"
			<div class='$className' id='{$this->moduleName}_$id' title='$file->basename'>$attribute</div>
			<div id='{$this->moduleName}SortValue_$id' style='display:none'>$file->basename</div>
			";
		return $html;
	}
	
	function getHtmlParentDirectory($relPath, $view) {
		$basename = "Parent Directory";
		$html = 
			"<div class='{$this->moduleName}ViewList' id='{$this->moduleName}_..'>
				<a href='?cwdRelPath={$relPath}&view=$view' onclick='Sdl.$this->moduleName.main.onClickRedirectParentDir(); return false;'>$basename</a>
			</div>
			";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.sort = new Sdl.Sort();
	this.sort.setDefaultOrder(1);
	this.sort.attribute = '{$this->moduleName}SortValue';
	this.sort.type = 'literal';

	Sdl.browser.addOnLoadListener(function() {this_clone.browserOnLoadListener()});
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener()});
}

Sdl.$this->moduleName.Main.prototype = {
	browserOnLoadListener : function() {
		var a, div;
		div = document.getElementById('{$this->moduleName}_..');
		a = div.getElementsByTagName('a')[0];
		a.href = '?cwdRelPath=' + Sdl.browser.cwd.parentDir + '&view=' + Sdl.browser.view;
	},	

	onClickRedirect : function(e, cwdRelPath) {
		Sdl.Event.stopPropagation(e);
		Sdl.browser.loadDirListing(cwdRelPath);
	},

	onClickRedirectParentDir : function() {
		Sdl.browser.loadDirListingParentDir();
	},
	
	windowOnLoadListener : function() {
		var div = document.getElementById('{$this->moduleName}Header');
		this.sort.setSortButton(div);	
		Sdl.sortManager.defaultSort = this.sort;
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";		
		return $javascript;
	}
}

class ModuleFilenameLocaleEnglishUS extends Locale {
	var $localeGroup = "en";
	var $localeName = "en-us";
	var $text = array(
		"NAME" 
			=> "Name",
	);
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleFileSize
//------------------------------------------------------------------------------
define("MODULEFILESIZE_ON"				, true);
define("MODULEFILESIZE_ADMIN_MODE_ON"	, true);
define("MODULEFILESIZE_USER_MODE_ON"	, true);

class ModuleFileSize extends Module {
	var $enabled 			= MODULEFILESIZE_ON;
	var $enabledAdminMode 	= MODULEFILESIZE_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEFILESIZE_USER_MODE_ON;
	var $isAttribute 		= true;
	var $moduleName 		= "ModuleFileSize";
	var $position 			= 20;
	
	function getCss() {
		$css =
"
.{$this->moduleName}HeaderViewList {
	overflow:hidden;
	margin:0em 0.5em;
	text-align:right;
	white-space:nowrap;
	width:5em;
}
.{$this->moduleName}ViewList {
	overflow:hidden;
	margin:0em 0.5em;
	text-align:right;
	white-space:nowrap;
	width:5em;
}
.{$this->moduleName}ViewThumbnail {
	font-size:0.9em;
	white-space:nowrap;
}
";
		return $css;
	}	

	function getHeader() {
		return "<div class='{$this->moduleName}HeaderViewList'><span id='{$this->moduleName}Header'>" . text("SIZE") . "</span></div>";
	}
	
	function getHtml($file, $id, $view) {
		if ($view == "list") {$className = "{$this->moduleName}ViewList";}
		else if ($view == "thumbnail") {$className = "{$this->moduleName}ViewThumbnail";}
		if ($file->isDir) {
			$filesize = "-";
			$sortValue = -1;
		} else {
			$filesize = $this->getSizeString(filesize($file->absPath));
			$sortValue = filesize($file->absPath);
		}
		$html = 
			"
			<div class='$className' id='{$this->moduleName}_$id'>$filesize</div>
			<div id='{$this->moduleName}SortValue_$id' style='display:none'>" . $sortValue . "</div>
			";
		return $html;
	}
	
	function getHtmlParentDirectory($relPath, $view) {
		$html = "<div class='{$this->moduleName}ViewList'></div>";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.sort = new Sdl.Sort();
	this.sort.setDefaultOrder(1);
	this.sort.attribute = '{$this->moduleName}SortValue';
	this.sort.type = 'numeric';

	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener()});
}

Sdl.$this->moduleName.Main.prototype = {
	windowOnLoadListener : function() {
		var div;
		div = document.getElementById('{$this->moduleName}Header');
		this.sort.setSortButton(div);	
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";		
		return $javascript;
	}
	
	function getRss($file, $fileId) {
		if ($file->isDir) {$filesize = "-";}
		else {$filesize = $this->getSizeString(filesize($file->absPath));}
		return "[" . text("FILE SIZE") . ": " . $filesize . "] ";
	}
	
	function getSizeString($filesize) {
		$precision = 2;
		if($filesize > 1024 * 1024 * 1024) {$filesize = round($filesize / (1024 * 1024 * 1024), $precision) . "G";}
		else if($filesize > 1024 * 1024) {$filesize = round($filesize / (1024 * 1024), $precision) . "M";}
		else if($filesize > 1024) {$filesize = round($filesize / (1024), $precision) . "K";}
		else {$filesize = $filesize . "B";}		
		return $filesize;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleFileType
//------------------------------------------------------------------------------
define("MODULEFILETYPE_ON"				, true);
define("MODULEFILETYPE_ADMIN_MODE_ON"	, true);
define("MODULEFILETYPE_USER_MODE_ON"	, true);

class ModuleFileType extends Module {
	var $enabled 			= MODULEFILETYPE_ON;
	var $enabledAdminMode 	= MODULEFILETYPE_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEFILETYPE_USER_MODE_ON;
	var $isAttribute 		= true;
	var $moduleName 		= "ModuleFileType";
	var $position 			= 15;

	function getCss() {
		$css =
"
.{$this->moduleName}HeaderViewList {
	margin:0em 0.5em;
	text-align:center;
	white-space:nowrap;
	width:3em;
}
.{$this->moduleName}ViewList {
	height:1em;
	line-height:1em;
	margin:0em 0.5em;
	text-align:center;
	white-space:nowrap;
	width:3em;
}
.{$this->moduleName}ViewThumbnail {
	height:1em;
	line-height:1em;
}

.{$this->moduleName}Icon {
	height:1em;
}
";
		return $css;
	}

	function getHeader() {
		return "<div class='{$this->moduleName}HeaderViewList'><span id='{$this->moduleName}Header'>" . text("TYPE") . "</span></div>";
	}
	
	function getHtml($file, $id, $view) {
		if ($view == "list") {$className = "{$this->moduleName}ViewList";}
		else if ($view == "thumbnail") {$className = "{$this->moduleName}ViewThumbnail";}
		if ($file->isDir) {
			$type = "<img alt='<" . text("DIR") . ">' class='{$this->moduleName}Icon' src='?print=icon&icon=dir'>";
			//$type = htmlentities("<" . text("DIR") . ">");
			$sortValue = htmlentities("<dir>") . $file->basename;
		} else {
			$type = "";
			$sortValue = htmlentities("<file>") . $file->basename;
		}
		$html = 
			"
			<div class='$className' id='{$this->moduleName}_$id'>$type</div>
			<div id='{$this->moduleName}SortValue_$id' style='display:none'>" . $sortValue . "</div>
			";
		return $html;
	}

	function getHtmlParentDirectory($relPath, $view) {
		$html = "<div class='{$this->moduleName}ViewList'></div>";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.sort = new Sdl.Sort();
	this.sort.setDefaultOrder(1);
	this.sort.attribute = '{$this->moduleName}SortValue';
	this.sort.type = 'literal';

	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener()});
}

Sdl.$this->moduleName.Main.prototype = {
	windowOnLoadListener : function() {
		var div = document.getElementById('{$this->moduleName}Header');
		this.sort.setSortButton(div);	
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";		
		return $javascript;
	}
	
	function getRss($file, $fileId) {
		if ($file->isDir) {$type = text("DIR");}
		else {$type = "-";}
		return "[" . text("FILE TYPE") . ": $type] ";
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleNavigator
//------------------------------------------------------------------------------
define("MODULENAVIGATOR_ON"				, true);
define("MODULENAVIGATOR_ADMIN_MODE_ON"	, true);
define("MODULENAVIGATOR_USER_MODE_ON"	, true);

class ModuleNavigator extends Module {
	var $enabled 				= MODULENAVIGATOR_ON;
	var $enabledAdminMode 		= MODULENAVIGATOR_ADMIN_MODE_ON;
	var $enabledUserMode 		= MODULENAVIGATOR_USER_MODE_ON;
	var $isSideBox 				= true;
	var $isSideBoxPositionTop 	= true;
	var $moduleName 			= "ModuleNavigator";
	var $position 				= 10;

	function getHtml($cwdRelPath, $view) {
		$cwdRelPath = Text::htmlentitiesUtf8($cwdRelPath);
		$html = 
			"
			<div style='margin:1.4em 0em;'><span id='$this->moduleName' style='font-size:2em; font-weight:bold; white-space:nowrap;'>/$cwdRelPath</span></div>
			";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	
	Sdl.browser.addOnLoadListener(function() {this_clone.browserOnLoadListener()});
};

Sdl.$this->moduleName.Main.prototype = {
	browserOnLoadListener : function() {
		var title;
		title = document.getElementById('$this->moduleName');
		title.textContent ? title.textContent = '/' + Sdl.browser.cwd.relPath : title.innerText = '/' + Sdl.browser.cwd.relPath;
	}
}
Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";		
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleOpen
//------------------------------------------------------------------------------
define("MODULEOPEN_ON"				, true);
define("MODULEOPEN_ADMIN_MODE_ON"	, true);
define("MODULEOPEN_USER_MODE_ON"	, false);

class ModuleOpen extends Module {
	var $enabled 			= MODULEOPEN_ON;
	var $enabledAdminMode 	= MODULEOPEN_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEOPEN_USER_MODE_ON;
	var $icons = array(
		"open"	=> "R0lGODlhEAAQANUkAHBwcMXFxaioqJqamtHR0XNzc6SkpJeXl6CgoNXV1ZiYmHd3d8fHx6Kioo2NjZubm6GhoX9/f4qKipSUlKenp5CQkJOTk6Ojo3t7e6WlpZ2dnX19fZ+fn4SEhHJycn5+foWFhZ6entra2v///////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAACQALAAAAAAQABAAAAZmQJJwSCwaj0jSaMlMjgSUjAGCGB2fI1GCwAg8rEKmYGRAcAYKRWDCHIXe78vyAH8vRXg8SBjJ45cggYEDSwUAh4dtDSMHFRIdHxgBC01hGllbXR5gRSMWDiAbCwWcRm1LSamqq6pBADs=",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleOpen";
	var $position 			= 60;
	var $requiredModules 	= array("ModuleSelector");
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}Open' onclick='Sdl.$this->moduleName.main.onClickOpen();' style='float:left' title='" . text("OPEN") . "'>
					<img alt='[" . text("OPEN") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=open'>
				</div>
			</div>
			";		
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
};

Sdl.$this->moduleName.Main.prototype = {
	onClickOpen : function() {
		var selectedFile;
		selectedFile = Sdl.ModuleSelector.main.getSingleSelectedFileAndWarn();
		if (selectedFile) {
			this.open(selectedFile.id);
		}
	},

	open : function(id) {
		var url;
		url = document.getElementById('systemUrl_' + id).innerHTML;
		if (url == '') {alert('" . text("FILE IS NOT WITHIN DOCUMENT ROOT") . "');}
		else {window.open(url);}
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'block';
		Sdl.Button.decorateById('{$this->moduleName}Open');
	}
}
Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleRead
//------------------------------------------------------------------------------
define("MODULEREAD_ON"				, true);
define("MODULEREAD_ADMIN_MODE_ON"	, true);
define("MODULEREAD_USER_MODE_ON"	, false);

class ModuleRead extends Module {
	var $enabled 			= MODULEREAD_ON;
	var $enabledAdminMode 	= MODULEREAD_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEREAD_USER_MODE_ON;
	var $icons = array(
		"read"		=> "R0lGODlhEAAQAMQfAJrM+3OSsKfS++zx9uXt9Yis1FdwkZW51ElVa8fj/bba/NXb5PL2+o276b3d/VJhe7TR4ENLXNXn8KLD536kwIyzzJ/E2KjL3t7n7ykxQz5FVa/W/OLp8I+w1P///////yH5BAEAAB8ALAAAAAAQABAAAAWRoCeO5PidngRBl3VUVBwEHgpJxJDrRN8YNQ+EkCgWHUhG4ye6MBKdqLTDqD5ElifSoeh2N4yr5/CcTAtoQVhUeXoVm7hAjRBRylE0uiEg1D0UA1xwcnMABBF2gmZ6ewAciR4BgoRzAgCYGBoiAQxchZiYA5seBgsMPByqHBgDEBmcBrIPDwgIEREaGhliJb4kIQA7",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleRead";
	var $position 			= 90;
	var $requiredModules 	= array("ModuleFilename");
	
	function action() {
		$relPath = $_POST["moduleParams"]["relPath"];
		$file = $this->fileManager->getFileByRelPath($relPath);
		$xml = new Xml();
		if ($file) {
			if ($file->isPermitted) {
				if ($file->isDir) {
					$content = text("DIRECTORY IS NOT ACCEPTED");
				} else {
					$content = file_get_contents($file->absPath);
					if ($content === false) {$response = text("ACCESS DENIED");}
					else {$content = $this->getPageHtml($content, $relPath);}
				}
			} else {
				$content = text("ACCESS DENIED");
			}
		} else {
			$content = text("ACCESS DENIED");
		}
		echo $content;
	}
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}Read' onclick='Sdl.$this->moduleName.main.onClickRead();' style='float:left' title='" . text("READ") . "'>
					<img alt='[" . text("READ") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=read'>
				</div>
			</div>
			";
		return $html;
	}

	function getPageHtml($content, $relPath) {
		$content = Text::htmlentitiesUtf8($content);
		$html = null;
		$html = 
			"
			<div>
				<div>" . text("FILE") . " : /$relPath</div>
				<div style='border:1px dotted #CCCCCC; padding:2px'><pre style='margin:0px'>$content</pre></div>
			</div>
			";
		return $html;	
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Read = function(){
	var this_clone = this;
	this.file = null;
	this.page = null;

	this.ajaxActionReadPass = function(xhr) {
		this_clone.ajaxActionRead(xhr);
	}
	
};

Sdl.$this->moduleName.Read.prototype = {
	addPage : function() {
		var content, tabContent;
		this.page = new Sdl.Page();
		content = document.createElement('div');
		content.innerHTML = 'Loading...';
		content.style.padding = '0px 5px';
		//content.style.overflow = 'hidden';
		this.page.content = content;
		tabContent = document.createElement('div');
		tabContent.innerHTML = 'Read:Loading';
		this.page.tabContent = tabContent;
		this.page.movableBar.setMoveTarget(this.page.content);
		Sdl.pageManager.addPage(this.page);
	},
	
	ajaxActionRead : function(xhr) {
		this.page.content.innerHTML = xhr.responseText;
		this.page.tabContent.innerHTML = '<nobr>Read:' + this.file.filename + '</nobr>';
		// Must set overflow:hidden after putting innerHTML because text cannot expand after setting overflow:hidden
		this.page.content.style.overflow = 'hidden';
		//this.page.content.style.top = this.page.content.clientHeight + 'px';
	},
	
	read : function() {
		var param;
		param =	'moduleParams[relPath]=' + this.file.relPath;
		Sdl.Ajax.ajaxPost(this.ajaxActionReadPass, '?action=module&module=$this->moduleName', param);						
	}
}

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.pages = [];
	this.pageIdIndex = 0;
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.$this->moduleName.Main.prototype = {
	onClickRead : function() {
		var newFilename, oldFilename, selectedFile;
		selectedFile = Sdl.ModuleSelector.main.getSingleSelectedFileAndWarn();
		if (selectedFile) {
			var read = new Sdl.$this->moduleName.Read;
			read.file = selectedFile;
			read.addPage();
			read.read();
		}
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'block';
		Sdl.Button.decorateById('{$this->moduleName}Read');
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleRename
//------------------------------------------------------------------------------
define("MODULERENAME"				, true);
define("MODULERENAME_ADMIN_MODE_ON"	, true);
define("MODULERENAME_USER_MODE_ON"	, false);
define("MODULERENAME_FTP_LAYER_ON"	, true);

class ModuleRename extends Module {
	var $enabled 			= MODULERENAME;
	var $enabledAdminMode 	= MODULERENAME_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULERENAME_USER_MODE_ON;
	var $icons = array(
		"rename"	=> "R0lGODlhEAAQAOZ/ALHW+a7V+rXa/VJjgHSWs95hZPb5+oOqxdJud3mdubrc/YyzzO32/uzx98bj/pa8077e/Z/E2Ovy+ajL3vH0+erx9+Xt9uXs88nk/sjj/sDf/Vt6np/P++JLSPT3+/P2+fL1+FlujN7n773d/a7T5SkxQ0xZcUlUaeZCPeVNS05eeT1EVUJLXanT++o5Mv7+/qvU+8rl/sLg/aTR+8Th/cbi/XqPq+Pq8eTv9dOKl6bQ+tt4fo7B8avQ9ejv9Z3F75TB71Fhfn2hvEFIV+Hp8OPs9+Tr9aDK87zB3UVPYbTR8bja/cy2yrzZ+L6Po8xrdsXW8XyjwJe951BpjLDS4+Tq+LDX/NxdYMvN5Iq971VohdXb5LLY/O7w8q3C47y81qzH6IOz48vM0fH0+8qPn6LQ+5LI+5bK+5fM/82fsLjJ5+fv99KWpFlgbmeHp2+Or9Fyfe/x9OJXV6/Q4tfn8MyqvafS+5vN+6nK7K3I6UBHV8KfskVQY9Pn8P///////yH5BAEAAH8ALAAAAAAQABAAAAfqgC9+g4SFg3+Ifn0kcxMRDwsHQgkEbn6JJHQ4FWsSDRagRTwbl35UPhkxGDU0GhoQDFlhIYMTHqoZWEwaIwoMDB9agxEGGA4OOwVNCksCXCBBgw8eNTVQKS5fAgJWASAqgwtjNDJsaR0IAFYwLSAmgwcUMhpyamQoXi12M0Yng1ENNNRJcaUACic6ynCokmRQggYjCiDJgwdBhyMc7hBhMYhAgxwu9gSAAcfFEzRnROgZ9MaAAiVgerSY8UMKEDNxVgzasOVDhQtAbxAhIqKLmBKDbEwJoWWAChMn+LAYsqJEGz+CDGkd9CIQADs=",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleRename";
	var $position 			= 10;
	var $requiredModules 	= array("ModuleSelector");
	var $ftpLayerOn 		= MODULERENAME_FTP_LAYER_ON;
	
	function action() {
		$oldRelPath = $_POST["moduleParams"]["oldRelPath"];
		$newFilename = $_POST["moduleParams"]["newFilename"];
		$oldFile = $this->fileManager->getFileByRelPath($oldRelPath);
		$xml = new Xml();
		if ($oldFile) {
			if ($oldFile->isPermitted) {
				$newAbsPath = $oldFile->dirAbsPath . $newFilename;
				if (file_exists($newAbsPath)) {
					$xml->setError(text("FILE WITH SAME NAME EXIST"));
				} else {
					if ($this->sysRename($oldFile->absPath, $newAbsPath)) {
						$xml->setStatusSuccess();
						$xml->setMessage("$oldFile->basename " . text("HAS BEEN SUCCESSFULLY RENAMED TO") . " $newFilename .");
					} else {
						$xml->setError(text("ACCESS DENIED"));
					}
				}
			} else {
				$xml->setError(text("ACCESS DENIED"));
			}
		} else {
			$xml->setError(text("ACCESS DENIED"));
		}
		$xml->dump();	
	}
	
	function getHtml() {
		$html = 
			"
			<div id='$this->moduleName' style='display:none; float:left; line-height:0.9' title='" . text("RENAME") . "'>
				<div id='{$this->moduleName}Rename' onclick='Sdl.$this->moduleName.main.onClickRename();' style='float:left'>
					<img alt='[" . text("RENAME") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=rename'>
				</div>
			</div>";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	
	this.ajaxActionRename = function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {Sdl.Xml.alertResponse(response);}
	},	
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
}

Sdl.$this->moduleName.Main.prototype = {
	onClickRename : function() {
		var selectedFile, oldRelPath, newFilename;
		selectedFile = Sdl.ModuleSelector.main.getSingleSelectedFileAndWarn();
		if (selectedFile) {
			oldRelPath = selectedFile.relPath;
			newFilename = prompt('" . text("PLEASE ENTER A NEW FILENAME") . "', selectedFile.filename);
			if (newFilename != '' && newFilename != null) {this.renameFile(oldRelPath, newFilename);}				
		}
	},
	
	renameFile : function(oldRelPath, newFilename) {
		var param;
		param =	'moduleParams[oldRelPath]=' + oldRelPath + '&' +
				'moduleParams[newFilename]=' + newFilename;
		Sdl.Ajax.ajaxPost(this.ajaxActionRename, '?action=module&module=$this->moduleName', param);						
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'block';
		Sdl.Button.decorateById('{$this->moduleName}Rename');
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleSelector
//------------------------------------------------------------------------------
define("MODULESELECTOR_ON"							, true);
define("MODULESELECTOR_ADMIN_MODE_ON"				, true);
define("MODULESELECTOR_USER_MODE_ON"				, true);
define("MODULESELECTOR_DISABLED_IF_NOT_REQUIRED"	, true);
define("MODULESELECTOR_FILE_TYPE"					, 1); //1=files/dirs, 2=regular files only, 3=dirs only

class ModuleSelector extends Module {
	var $disabledIfNotRequired 	= MODULESELECTOR_DISABLED_IF_NOT_REQUIRED;
	var $enabled 				= MODULESELECTOR_ON;
	var $enabledAdminMode 		= MODULESELECTOR_ADMIN_MODE_ON;
	var $enabledUserMode 		= MODULESELECTOR_USER_MODE_ON;
	var $isAttribute 			= true;
	var $moduleName 			= "ModuleSelector";
	var $position 				= 0;
	
	function getCss() {
		// Checkbox is about the same in FF2 and IE7.
		// In Safari 3 beta, checkbox is aligned a bit bottom
		// In Opera 9.21, checkbox is large. It's about 16px minimum.
		$css =	
"
.{$this->moduleName}FileFocus {
	background-color:#E2ECED;
}

.{$this->moduleName}HeaderViewList {
	margin:0em 0.1em;
	overflow:hidden;
	text-align:center;
	width:1.6em;
}
.{$this->moduleName}ViewList {
	margin:0em 0.1em;
	overflow:hidden;
	text-align:center;
	width:1.6em;
}

.{$this->moduleName}ViewThumbnail {
}

.{$this->moduleName}CheckBox {
	height:1.05em;
	margin:0px;
	vertical-align:middle;
}

.{$this->moduleName}browserFilesDiv {
	cursor:pointer;
}
";
		return $css;
	}
	
	function getHeader() {
		return "<div id='{$this->moduleName}Header' class='{$this->moduleName}HeaderViewList' style='display:none'><input class='{$this->moduleName}CheckBox' id='{$this->moduleName}SelectorAll' onclick='Sdl.$this->moduleName.main.onClickAllSelectors(event);' type='checkbox'/></div>";
	}
	
	function getHtml($file, $id, $view, $isJavascript) {
		if ($isJavascript) {
			if ($view == "list") {$className = "{$this->moduleName}ViewList";}
			else if ($view == "thumbnail") {$className = "{$this->moduleName}ViewThumbnail";}
			$html = "<div class='$className' id='{$this->moduleName}_$id'><input class='{$this->moduleName}CheckBox' onclick='Sdl.$this->moduleName.main.onClickSelector(event, \"$id\");' type='checkbox'/></div>";
			return $html;
		} else {
			return "";
		}
	}
	
	function getHtmlParentDirectory() {
		$html = "<div class='{$this->moduleName}ViewList' id='{$this->moduleName}_..'>&nbsp;</div>";
		return $html;
	}
	
	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.fileType = " . MODULESELECTOR_FILE_TYPE . "; //1=files/dirs, 2=files only, 3=dirs only
	this.selectedFileIds = [];
	
	this.modifyFilesPass = function(file) {
		this_clone.modifyFiles(file);
	}

	Sdl.browser.addOnLoadListener(function() {this_clone.browserOnLoadListener()});	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener()});
}

Sdl.$this->moduleName.Main.prototype = {
	browserOnLoadListener : function() {
		Sdl.browser.traverseAllFiles(this.modifyFilesPass);
		var sa = document.getElementById('{$this->moduleName}SelectorAll');
		sa.checked = false;
		this.selectedFileIds = [];
	},
	
	countSelectedFiles : function() {
		var num = 0, this_clone_tmp = this;
		Sdl.browser.traverseAllFiles(function(file) {
			if (this_clone_tmp.isFileSelected(file.id)) {num++;}
		});
		return num;
	},

	deselectAllFiles : function() {
		var this_clone_tmp = this;
		Sdl.browser.traverseAllFiles(function(file) {
			if (this_clone_tmp.isFileSelected(file.id)) {this_clone_tmp.deselectFile(file.id);}
		});
	},

	deselectSelectedFiles : function() {
		var len;
		len = this.selectedFileIds.length;
		for(var i = len-1 ; i >=0 ; i--) {
			var a, t;
			t = document.getElementById(this.selectedFileIds[i]);
			Sdl.Object.modifyClassName(t, null, '{$this->moduleName}FileFocus');
			a = document.getElementById('browserFiles');
			t.getElementsByTagName('input').item(0).checked = false;
		}
		this.selectedFileIds = [];	
	},
	
	deselectFile : function(fileId) {
		var a, len, t;
		t = document.getElementById(fileId);
		Sdl.Object.modifyClassName(t, null, '{$this->moduleName}FileFocus');
		a = document.getElementById('browserFiles');
		t.getElementsByTagName('input').item(0).checked = false;
		len = this.selectedFileIds.length;
		for(var i = 0 ; i  < len ; i++) {
			if(fileId == this.selectedFileIds[i]) {
				this.selectedFileIds.splice(i, 1);
				break;
			}
		}
	},
	
	getSelectedFiles : function() {
		var selectedFiles = [], this_clone_tmp = this;
		Sdl.browser.traverseAllFiles(function(file) {
			if (this_clone_tmp.isFileSelected(file.id)) {
				var detail = {};
				detail.id = file.id;
				detail.relPath = document.getElementById('systemRelPath_' + file.id).innerHTML;
				detail.filename = document.getElementById('systemFilename_' + file.id).innerHTML;
				detail.isDir = document.getElementById('systemIsDir_' + file.id).innerHTML;
				selectedFiles.push(detail);
			}
		});
		return selectedFiles;
	},

	getSelectedFilesAndWarn : function() {
		var selectedFiles;
		selectedFiles = this.getSelectedFiles();
		if (selectedFiles.length < 1) {
			alert('" . text("PLEASE SELECT FILES") . "');
			return false;
		} else {
			return selectedFiles;
		}
	},
	
	getSingleSelectedFileAndWarn : function() {
		var selectedFiles;
		selectedFiles = this.getSelectedFiles();
		if (selectedFiles.length > 1) {alert('" . text("PLEASE SELECT ONE FILE ONLY") . "');}
		else if (selectedFiles.length == 1) {return selectedFiles[0];}
		else {alert('" . text("PLEASE SELECT A FILE") . "');}
		return false;
	},
	
	isFileSelected : function(fileId) {
		return document.getElementById(fileId).getElementsByTagName('input').item(0).checked;
	},
	
	modifyFiles : function(file) {
		if (Sdl.browser.status.success) {
			var this_clone_tmp = this;			
			var isDir = document.getElementById('systemIsDir_' + file.id).innerHTML; // For additional file/dir type function
			if ((this.fileType == 1) || (this.fileType == 2 && !isDir) || (this.fileType == 3 && isDir)) { // For additional file/dir type function
				var File = function() {
					var fileId;
					this.setFileId = function(id) {
						fileId = id;
					}
					this.fileOnClick = function(e) {
						e = e || event;
						if (e.ctrlKey) {
							if (this_clone_tmp.isFileSelected(fileId)) {this_clone_tmp.deselectFile(fileId);}
							else {this_clone_tmp.selectFile(fileId);}							
						} else {
							if (this_clone_tmp.isFileSelected(fileId)) {
								if (this_clone_tmp.countSelectedFiles() > 1) {
									this_clone_tmp.deselectSelectedFiles();
									this_clone_tmp.selectFile(fileId);
								} else {
									this_clone_tmp.deselectSelectedFiles();
								}
							} else {
								this_clone_tmp.deselectSelectedFiles();
								this_clone_tmp.selectFile(fileId);
							}
						}
					}
				}
				var fileObj = new File();
				fileObj.setFileId(file.id);
				file.onclick = fileObj.fileOnClick;
				
			} else {
				var checkbox = document.getElementById('{$this->moduleName}_' + file.id); // For additional file/dir type function
				checkbox.style.visibility = 'hidden'; // For additional file/dir type function
			}			
		}
	},
	
	onClickAllSelectors : function(e) {
		var checkbox;
		e = e || event;
		checkbox = e.target || e.srcElement;
		if (checkbox.checked) {this.selectAllFiles();}
		else {this.deselectAllFiles();}
		Sdl.Event.stopPropagation(e);
	},

	onClickSelector : function(e, fileId) {
		var checkbox;
		e = e || event;
		checkbox = e.target || e.srcElement;
		if (checkbox.checked) {this.selectFile(fileId);}
		else {this.deselectFile(fileId);}
		Sdl.Event.stopPropagation(e);
	},
	
	selectAllFiles : function() {
		var this_clone_tmp = this;
		Sdl.browser.traverseAllFiles(function(file) {
			this_clone_tmp.selectFile(file.id);
		});
	},
	
	selectFile : function(fileId) {
		var i, s, t;
		t = document.getElementById(fileId);
		Sdl.Object.modifyClassName(t, '{$this->moduleName}FileFocus', null);
		s = document.getElementById('{$this->moduleName}_' + t.id);
		i = s.getElementsByTagName('input');
		i[0].checked = true;
		this.selectedFileIds.push(fileId);
	},
	
	windowOnLoadListener : function() {
		Sdl.Object.modifyClassName(document.getElementById('browserFilesDiv'), '{$this->moduleName}browserFilesDiv', null);
		document.getElementById('{$this->moduleName}Header').style.display = 'block';	
		document.getElementById('{$this->moduleName}_..').style.display = 'block';	
		Sdl.Event.disableSelection(document.getElementById('browserDirListing'));
		
		// For additional file/dir type function
		var sa = document.getElementById('{$this->moduleName}SelectorAll');
		if (this.fileType == 2 || this.fileType == 3) {
			sa.style.visibility = 'hidden';
		}
	}
}

Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleServerSignature
//------------------------------------------------------------------------------
define("MODULESERVERSIGNATURE_ON"				, true);
define("MODULESERVERSIGNATURE_ADMIN_MODE_ON"	, true);
define("MODULESERVERSIGNATURE_USER_MODE_ON"		, true);

class ModuleServerSignature extends Module {
	var $enabled 					= MODULESERVERSIGNATURE_ON;
	var $enabledAdminMode 			= MODULESERVERSIGNATURE_ADMIN_MODE_ON;
	var $enabledUserMode 			= MODULESERVERSIGNATURE_USER_MODE_ON;
	var $isSideBox 					= true;
	var $isSideBoxPositionBottom 	= true;
	var $moduleName 				= "ModuleServerSignature";
	var $position 					= 10;
	
	function getHtml($cwdRelPath, $view) {
		$html = 
			"
			<div id='$this->moduleName'><address><span style='font-size:0.8em'>" . $_SERVER["SERVER_SIGNATURE"] . "</span></address></div>
			";
		return $html;
	}
}
?>
<?php
//------------------------------------------------------------------------------
// Class name : ModuleUpload
//------------------------------------------------------------------------------
define("MODULEUPLOAD_ON"				, true);
define("MODULEUPLOAD_ADMIN_MODE_ON"		, true);
define("MODULEUPLOAD_USER_MODE_ON"		, false);
define("MODULEUPLOAD_FTP_LAYER_ON"		, true);
define("MODULEUPLOAD_FILE_SIZE_LIMIT"	, 100 * 1024 * 1024); // in byte; for HTML form only

class ModuleUpload extends Module {
	var $enablde 			= MODULEUPLOAD_ON;
	var $enabledAdminMode 	= MODULEUPLOAD_ADMIN_MODE_ON;
	var $enabledUserMode 	= MODULEUPLOAD_USER_MODE_ON;
	var $icons = array(
		"upload"	=> "R0lGODlhEAAQAMQfAJLNW3aXtJnM/OTs9YivyMfj/ldwkabS+73d/UpXbdXb5PP2+dHn+uv1/uvx9mGNRIm77LXZ/H6xW1Jhe6/S5ERNX5rA1qjL3uLw/t7o8CkxQz9GVsvM0WOPRf///////yH5BAEAAB8ALAAAAAAQABAAAAWYoCeO5PidHkNRl2URRCAHHkplg6M7Qz9AhpqH4igYjYhkAwIUXRbHwuOhbCwmIgvU2JFIHpHwNbvtAM4A8GHsIUA78DO8s06I3IhGwyzpYDAHA3YeAQ1JCHwPBwcCAxUiAQ5JEXN0AgIZj4SSYQyeBZeYG5ALCGGLi6EOox4GCgs8PhmzDhwakAa5ExMJCRUVGxsaWCXFJSEAOw==",
	);
	var $isFunction 		= true;
	var $moduleName 		= "ModuleUpload";
	var $position 			= 100;
	var $ftpLayerOn 		= MODULEUPLOAD_FTP_LAYER_ON;
	
	// edited in 2.1;
	function action() {
		$xml = new Xml();
		if ($_GET["moduleParams"]["action"] === "upload") {
			$cwdRelPath = $_GET["moduleParams"]["cwdRelPath"];
			$cwd = $this->fileManager->getFileByRelPath($cwdRelPath);
			if ($cwd) {
				if ($cwd->isPermitted) {
					if ($_FILES["file"]["size"] == 0) {
						$content = text("ERROR");
					} else {
						if ( $_FILES["file"]["size"] > MODULEUPLOAD_FILE_SIZE_LIMIT) {
							$content =  text("FILE SIZE EXCEEDS LIMIT");
						} else {
							$absPath = $cwd->absPath . $_FILES["file"]["name"];
							if (file_exists($absPath)) {
								$content =  text("FILE WITH SAME NAME EXISTS");
							} else {
								if ($this->sysMoveUploadedFile($_FILES["file"]["tmp_name"], $absPath)) {$content = text("SUCCESSFULLY UPLOADED TO") . " /" . $cwdRelPath;}
								else {$content = text("ACCESS DENIED");}
							}
						}
					}
				} else {
					$content = text("ACCESS DENIED");
				}
			} else {
				$content = text("ACCESS DENIED");
			}
			echo "<html><body style='border:0px; margin:0.1em'><span style='white-space:nowrap'>$content</span></body></html>";
			exit(0);
		} else if ($_GET["moduleParams"]["action"] === "printPage") {
			$cwdRelPath = $_POST["moduleParams"]["cwdRelPath"];
			$cwdAbsPath = $this->fileManager->relPathToAbsPath($cwdRelPath);
			if ($cwdAbsPath) {
				if (is_dir($cwdAbsPath)) {
					// writable for others or using ftp layer
					if (is_writable($cwdAbsPath) || $this->fileManager->user->ftp) {
						$xml->setStatusSuccess();
						$xml->setContent($this->getPageHtml($cwdRelPath, $_POST["moduleParams"]["pageId"]));
					} else {
						$xml->setError(text("ACCESS DENIED"));
					}					
				} else {
					$xml->setError(text("ACCESS DENIED"));
				}
			} else {
				$xml->setError(text("ACCESS DENIED"));
			}
			echo $response;		
		} else if ($_GET["moduleParams"]["action"] === "printUploadFrame") {
			$cwdRelPath = $_GET["moduleParams"]["cwdRelPath"];
			echo $this->getUploadFrame($cwdRelPath);
			return;
		} else {
			$xml->setError(text("ACCESS DENIED"));
		}
		$xml->dump();
	}
	
	function getCss() {
		//overflow:hidden is for Safari 3 beta as its html page inside a frame is long
		$css =	
"
.{$this->moduleName}UploadFrame {
	border:0px dotted black;
	height:3em;
	overflow:auto;
	padding:0.2em;
	width:35em;
}
";
		return $css;
	}
	
	function getUploadFrame($cwdRelPath) {
		$html = null;
		$html =
			"
			<html>
				<body style='border:0px; margin:0em; overflow:hidden'>
					<form action='?action=module&module=$this->moduleName&moduleParams[action]=upload&moduleParams[cwdRelPath]=$cwdRelPath' method='post' name='form' enctype='multipart/form-data'>
						<input type='hidden' name='MAX_FILE_SIZE' value='" . MODULEUPLOAD_FILE_SIZE_LIMIT . "'>
						<nobr><input name='file' type='file' size='50'><input name='upload' value='" . text("UPLOAD") . "' type='submit'></nobr>
					</form>
				</body>
			</html>
			";
		return $html;
		
	}
	
	function getPageHtml($cwdRelPath, $pageId) {
		$content = htmlentities($content);
		
		$iniMaxUpload 	= ini_get(upload_max_filesize);
		$iniMaxPost 	= ini_get(post_max_size);
		$maxUploadSize 	= $iniMaxUpload < $iniMaxPost ? $iniMaxUpload : $iniMaxPost;
		
		$html = null;
		$html = 
			"
			<div>
				<div>" . text("UPLOAD TO DIRECTORY") . " : /$cwdRelPath<br>Max file size : $maxUploadSize</div>
				<div><input id='{$this->moduleName}AddUploadFrame_{$pageId}' type='button' value='Add'></div>
				<div style='min-height:10em; overflow:auto' id='{$this->moduleName}UploadFrameContainer_{$pageId}'></div>
			</div>
			";
		return $html;	
	}
	
	function getHtml() {
		$html = 
			"
			<div id='{$this->moduleName}' style='display:none; float:left; line-height:0.9;'>
				<div id='{$this->moduleName}Upload' onclick='Sdl.$this->moduleName.main.onClick();' style='float:left' title='" . text("UPLOAD") . "'>
					<img alt='[" . text("UPLOAD") . "]' src='?print=icon&module=$this->moduleName&moduleParams[icon]=upload'>
				</div>
			</div>";
		return $html;
	}

	function getJavascript() {
		$javascript =
"
Sdl.$this->moduleName = {};

Sdl.$this->moduleName.Upload = function() {
	var this_clone = this;
	this.file = null;
	this.pageId = null;
	this.cwd = null;

	this.ajaxActionPrintPage = function(xhr) {
		var response;
		response = Sdl.Xml.digestResponseXml(xhr);
		if (Sdl.Xml.validateResponseAndWarn(response)) {
			Sdl.Xml.alertResponse(response);
			if (response.status.success) {this_clone.addPage(response.content);}
		}
	}	
	
	this.onClickAddUploadFrame = function() {
		this_clone.addUploadFrame();
	}
}

Sdl.$this->moduleName.Upload.prototype = {
	addUploadFrame : function() {
		var container, div;
		div = document.createElement('div');
		div.innerHTML = '<iframe class=\'{$this->moduleName}UploadFrame\' src=\'?action=module&module=$this->moduleName&moduleParams[action]=printUploadFrame&moduleParams[cwdRelPath]=' + this.cwd.relPath + '\'></iframe>';
		container = document.getElementById('{$this->moduleName}UploadFrameContainer_' + this.pageId);
		container.insertBefore(div, container.childNodes[0] ? container.childNodes[0] : null);
	},
	
	addPage : function(innerHTML) {
		var add, content, tabContent;
		this.page = new Sdl.Page();
		content = document.createElement('div');
		content.innerHTML = innerHTML;
		this.page.content = content;
		tabContent = document.createElement('div');
		tabContent.innerHTML = 'Upload';
		this.page.tabContent = tabContent;
		this.page.movableBar.isDefaultLocked = false;
		Sdl.pageManager.addPage(this.page);
		// Must add movable bar after add page because the moveTarget has not been rendered before adding page to DOM
		this.page.movableBar.setMoveTarget(document.getElementById('{$this->moduleName}UploadFrameContainer_' + this.pageId));
		add = document.getElementById('{$this->moduleName}AddUploadFrame_' + this.pageId);
		add.onclick = this.onClickAddUploadFrame;
		this.addUploadFrame();
	},
	
	printPage : function() {
		var param;
		param =	'moduleParams[cwdRelPath]=' + this.cwd.relPath + '&' +
				'moduleParams[pageId]=' + this.pageId;
		Sdl.Ajax.ajaxPost(this.ajaxActionPrintPage, '?action=module&module=$this->moduleName&moduleParams[action]=printPage', param);						
	}					
}		

Sdl.$this->moduleName.Main = function() {
	var this_clone = this;
	this.pages = [];
	this.pageIdIndex = 0;
	
	Sdl.Event.addWindowOnLoadListener(function() {this_clone.windowOnLoadListener();});
};

Sdl.$this->moduleName.Main.prototype = {
	onClick : function() {
		var upload;
		upload = new Sdl.$this->moduleName.Upload;
		upload.cwd = Sdl.browser.cwd;
		upload.pageId = this.pageIdIndex++;
		upload.printPage();
	},
	
	windowOnLoadListener : function() {
		document.getElementById('$this->moduleName').style.display = 'block';
		Sdl.Button.decorateById('{$this->moduleName}Upload');
	}
}
Sdl.$this->moduleName.main = new Sdl.$this->moduleName.Main();
";
		return $javascript;
	}
}
?>
<?php
if (DEBUG_ERROR_REPORTING_LEVEL !== null)
	error_reporting(DEBUG_ERROR_REPORTING_LEVEL);
$locale = new Locale();
$locale->setLocale();
function text($str, $replace = null, $firstCap = false) {
	global $locale;
	return $locale->text($str, $replace, $firstCap);
}
$instance = new SimpleDirectoryListing();
?>
