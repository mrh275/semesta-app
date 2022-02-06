<?php
/**
 *
 * - PopojiCMS Installation
 *
 * - File : install.php
 * - Version : 3.0
 * - Author : Jenuar Dalapang
 * - License : MIT License
 *
 *
 * This is a file installation from Popoji which handling engine installation.
 *
*/
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

$aConf = array();
$aConf['structure']	= 'Popoji';
$aConf['release'] = '11 November 2019';
$aConf['ver'] = '3.0';
$aConf['build'] = '0';
$aConf['header_inc_file'] = 'po-includes/.env';
$aConf['dir_inc'] = 'po-includes/storage/';	
$aConf['headerTempl'] = <<<EOS
APP_NAME=POPOJI
APP_VERSION={$aConf['ver']}
APP_ENV=local
APP_KEY=base64:BeCGoSKNBL7wZlLEbuwtzcutmQyIfkp8Jn1vMUm1F0w=
APP_DEBUG=true
APP_URL=%site_url%

LOG_CHANNEL=stack
FM_KEY=i7GLt0sqUVc0uWdlxT4t8TftzX5Ebi8gm8uqa6IGE6w

DB_CONNECTION=mysql
DB_HOST=%db_host%
DB_PORT=%db_port%
DB_DATABASE=%db_name%
DB_USERNAME=%db_user%
DB_PASSWORD="%db_password%"

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="\${PUSHER_APP_CLUSTER}"

EOS;

$confFirst = array();
$confFirst['site_url'] = array(
	'name' => "Site URL",
	'ex' => "https://www.popojicms.org",
	'desc' => "Your site url (Remember, without backslash in the end url '/')",
	'def' => "https://",
    'def_exp' => '
		$str = "http://".$_SERVER[\'HTTP_HOST\'].$_SERVER[\'PHP_SELF\'];
		$str = str_replace("/install.php","",$str);
	    return $str;',
	'check' => 'return strlen($arg0) >= 10 ? true : false;'
);
$confFirst['dir_root'] = array(
	'name' => "Root directory",
	'ex' => "/path/to/your/popoji/",
	'desc' => "Directory of Popoji placed.",
    'def_exp' => '
		$str = rtrim($_SERVER[\'DOCUMENT_ROOT\'], \'/\').$_SERVER[\'PHP_SELF\'];
		$str = str_replace("install.php","",$str);
	    return $str;',
	'check' => 'return strlen($arg0) >= 1 ? true : false;'
);


$confDB = array();
$confDB['sql_file'] = array(
    'name' => "SQL file",
    'ex' => "/path/to/your/popoji/po-includes/database/popoji.sql",
    'desc' => "SQL file location",
	'def' => "po-includes/database/popoji.sql",
	'def_exp' => '
		if ( !( $dir = opendir( "po-includes/database/" ) ) )
	        return "";
		while (false !== ($file = readdir($dir)))
	        {
		    if ( substr($file,-3) != \'sql\' ) continue;
			closedir( $dir );
			return "po-includes/database/$file";
		}
		closedir( $dir );
		return "";',
	'check' => 'return strlen($arg0) >= 4 ? true : false;'
);
$confDB['db_host'] = array(
	'name' => "Database host name",
	'ex' => "localhost",
	'desc' => "Your MySQL database host name here.",
	'def' => "localhost",
	'check' => 'return strlen($arg0) >= 1 ? true : false;'
);
$confDB['db_port'] = array(
	'name' => "Database host port number",
	'ex' => "3306",
	'desc' => "Leave 3306 for default or specify MySQL Database host port number.",
	'def' => "",
	'check' => ''
);
$confDB['db_sock'] = array(
	'name' => "Database socket path",
	'ex' => "/tmp/mysql50.sock",
	'desc' => "Leave blank or specify MySQL Database socket path.",
	'def' => "",
	'check' => ''
);
$confDB['db_name'] = array(
    'name' => "Database name",
    'ex' => "YourDatabaseName",
    'desc' => "Your MySQL database name here.",
    'check' => 'return strlen($arg0) >= 1 ? true : false;'
);
$confDB['db_user'] = array(
	'name' => "Database user",
	'ex' => "YourName",
	'desc' => "Your MySQL database read/write user name here.",
	'check' => 'return strlen($arg0) >= 1 ? true : false;'
);
$confDB['db_password'] = array(
	'name' => "Database password",
	'ex' => "YourPassword",
	'desc' => "Your MySQL database password here.",
	'check' => 'return strlen($arg0) >= 0 ? true : false;'
);

$confGeneral = array();
$confGeneral['site_title'] = array(
	'name' => "Site Title",
	'ex' => "The Best Community",
	'desc' => "Name of your site.",
	'check' => 'return strlen($arg0) >= 1 ? true : false;'
);
$confGeneral['site_desc'] = array(
	'name' => "Site Description",
	'ex' => "The place to find new friends, communicate and have fun.",
	'desc' => "Meta description of your site.",
	'check' => 'return strlen($arg0) >= 1 ? true : false;'
);
$confGeneral['site_email'] = array(
	'name' => "Site E-mail",
	'ex' => "your@email.here",
	'desc' => "Your site e-mail.",
	'check' => 'return strlen($arg0) > 0 AND strstr($arg0,"@") ? true : false;'
);
$confGeneral['site_user'] = array(
	'name' => "Site Username",
	'ex' => "admin",
	'desc' => "Username for login to administrator page, please just write letters and numbers (lowercase).",
	'check' => 'return strlen($arg0) >= 1 ? true : false;'
);
$confGeneral['site_pass'] = array(
	'name' => "Site Password",
	'ex' => "admin123",
	'desc' => "Password for login to administrator page, please enter character more than 8 characters.",
	'check' => 'return strlen($arg0) >= 8 ? true : false;'
);
$confGeneral['site_timezone'] = array(
	'name' => "Site Timezone",
	'ex' => "Asia/Jakarta",
	'desc' => "Timezone of your site.",
	'check' => 'return strlen($arg0) >= 1 ? true : false;'
);

$aTemporalityWritableFolders = array(
	'inc',
);

$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
$error = '';

$InstallPageContent = InstallPageContent( $error );

mb_internal_encoding('UTF-8');

echo PageHeader( $action, $error );
echo $InstallPageContent;
echo PageFooter( $action );

function InstallPageContent(&$error) {
	global $aConf, $confFirst, $confDB, $confGeneral;
        $action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
	$ret = '';

	switch ($action) {

		case 'step5':
			$ret .= genMainPage();
		break;

		case 'step4':
			$errorMessage = checkConfigArray($confGeneral, $error);
			$ret .= (strlen($errorMessage)) ? genSiteGeneralConfig($errorMessage) : genInstallationProcessPage();
		break;

		case 'step3':
			$errorMessage = checkConfigArray($confDB, $error);
			$errorMessage .= CheckSQLParams();
			$ret .= (strlen($errorMessage)) ? genDatabaseConfig($errorMessage) : genSiteGeneralConfig();
		break;

		case 'step2':
			$errorMessage = checkConfigArray($confFirst, $error);
			$ret .= (strlen($errorMessage)) ? genPathCheckingConfig($errorMessage) : genDatabaseConfig();
		break;

		case 'step1':
			$ret .= genPathCheckingConfig();
		break;

		default:
			$ret .= StartInstall();
		break;
	}

	return $ret;
}

function PageHeader($action = '', $error = '') {
	global $aConf;

	$actions = array(
		"startInstall" => "Getting Started",
		"step1" => "Paths",
		"step2" => "Database",
		"step3" => "Config",
		"step4" => "Installation Process",
		"step5" => "Main Page",
	);

	if( !strlen( $action ) )
		$action = "startInstall";

	$activehome = ($action == "startInstall") ? 'class="active"' : '';
	$activestep1 = ($action == "step1") ? 'class="active"' : '';
	$activestep2 = ($action == "step2") ? 'class="active"' : '';
	$activestep3 = ($action == "step3") ? 'class="active"' : '';
	$activestep4 = ($action == "step4") ? 'class="active"' : '';
	$activestep5 = ($action == "step5") ? 'class="active"' : '';

	$iCounterCurrent = 1;
	$iCounterActive	 = 1;

	foreach ($actions as $actionKey => $actionValue) {
		if ($action != $actionKey) {
			$iCounterActive++;
		} else
			break;
	}

	if (strlen($error))
		$iCounterActive--;

	return <<<EOF
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>POPOJI Installation</title>
			<link rel="shortcut icon" href="favicon.png" />
			<link type="text/css" rel="stylesheet" href="po-admin/lib/install/bootstrap.min.css" />
			<link type="text/css" rel="stylesheet" href="po-admin/lib/@fortawesome/fontawesome-free/css/all.min.css" />
			<link type="text/css" rel="stylesheet" href="po-admin/lib/install/install.css" />

			<script type="text/javascript" src="po-admin/lib/install/jquery-2.1.4.min.js"></script>
			<script type="text/javascript" src="po-admin/lib/install/bootstrap.min.js"></script>

			<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body style="background:#efefe9;">
			<section>
				<div class="container">
					<div class="row">
						<div class="board">
							<div class="board-inner">
								<ul class="nav nav-tabs" id="myTab">
									<div class="liner"></div>
									<li {$activehome}>
										<a href="javascript:void(0);" data-toggle="tab" title="Getting Started">
											<span class="round-tabs one"><i class="fa fa-home fa-fw"></i></span>
										</a>
									</li>
									<li {$activestep1}>
										<a href="javascript:void(0);" data-toggle="tab" title="Paths">
											<span class="round-tabs two"><i class="fa fa-folder fa-fw"></i></span>
										</a>
									</li>
									<li {$activestep2}>
										<a href="javascript:void(0);" data-toggle="tab" title="Database">
											<span class="round-tabs three"><i class="fa fa-database fa-fw"></i></span>
										</a>
									</li>
									<li {$activestep3}>
										<a href="javascript:void(0);" data-toggle="tab" title="Web Config">
											<span class="round-tabs four"><i class="fa fa-sitemap fa-fw"></i></span>
										</a>
									</li>
									<li {$activestep4}>
										<a href="javascript:void(0);" data-toggle="tab" title="Installation Process">
											<span class="round-tabs five"><i class="fa fa-cog fa-fw"></i></span>
										</a>
									</li>
								</ul>
							</div>
EOF;
}

function PageFooter($action) {
	global $aConf;

	return <<<EOF
						</div>
					</div>
				</div>
			</section>
			<script type="text/javascript">
				$(function(){
					$('a[title]').tooltip();
				});
			</script>
		</body>
	</html>
EOF;
}

function StartInstall() {
	global $aConf;
	if (strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false) {
		if (function_exists('apache_get_modules')) {
			$ifmodrewrite = (in_array('mod_rewrite', apache_get_modules()) ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
		} else {
			$ifmodrewrite = '<span class="text-success">ON</span>';
		}
	}
	$ifshorttag = (ini_get('short_open_tag') == '1' ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifexif = (extension_loaded('exif') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifbcmath = (extension_loaded('bcmath') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifctype = (extension_loaded('ctype') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifjson = (extension_loaded('json') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifmbstring = (extension_loaded('mbstring') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifopenssl = (extension_loaded('openssl') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifpdo = (extension_loaded('pdo') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$iftokenizer = (extension_loaded('tokenizer') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$ifxml = (extension_loaded('xml') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$fileinfo = (extension_loaded('fileinfo') ? '<span class="text-success">ON</span>' : '<span class="text-danger">OFF</span>');
	$iffoldercorewrite = (is_writable('po-includes/storage') ? '<span class="text-success">YES</span>' : '<span class="text-danger">NO</span>');
	$current_year = date("Y");
	$startinstallc = <<<EOF
<div class="tab-content">
	<div class="tab-pane fade in active" id="Getting Started">
		<h3 class="head text-center">POPOJI {$aConf['ver']}.{$aConf['build']}</h3>
		<p class="narrow text-center">
			Welcome to POPOJI instalation page, please read the license and click button at bottom if you agree and start instalation process.
		</p>
		<p class="narrow text-center text-info">
			<i>Note : POPOJI requires minimal php version 7.2.x, but will be more stable in php version 7.2.12 - latest.</i>
		</p>
		<div class="license">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">Server Information</th>
							<th class="text-center">Current Setting</th>
							<th class="text-center">Required Setting</th>
						</tr>
					</thead>
					<tbody>
EOF;
	if (strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false) {
	$startinstallc .= <<<EOF
						<tr>
							<td class="text-center" colspan="3">Apache</td>
						</tr>
						<tr>
							<td class="text-center">Mod Rewrite</td>
							<td class="text-center">{$ifmodrewrite}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
EOF;
	}
	$startinstallc .= <<<EOF
						<tr>
							<td class="text-center" colspan="3">PHP Extension</td>
						</tr>
						<tr>
							<td class="text-center">BCMath</td>
							<td class="text-center">{$ifbcmath}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">Ctype</td>
							<td class="text-center">{$ifctype}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">JSON</td>
							<td class="text-center">{$ifjson}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">Mbstring</td>
							<td class="text-center">{$ifmbstring}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">OpenSSL</td>
							<td class="text-center">{$ifopenssl}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">PDO</td>
							<td class="text-center">{$ifpdo}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">Tokenizer</td>
							<td class="text-center">{$iftokenizer}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">XML</td>
							<td class="text-center">{$ifxml}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">Exif</td>
							<td class="text-center">{$ifexif}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">Fileinfo</td>
							<td class="text-center">{$fileinfo}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center">Short Open Tag</td>
							<td class="text-center">{$ifshorttag}</td>
							<td class="text-center"><span class="text-success">ON</span></td>
						</tr>
						<tr>
							<td class="text-center" colspan="3">Directory</td>
						</tr>
						<tr>
							<td class="text-center">/po-includes/storage/</td>
							<td class="text-center">{$iffoldercorewrite}</td>
							<td class="text-center"><span class="text-success">YES</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="license">
			<textarea class="form-control" readonly>
The MIT License (MIT)

Copyright (c) 2013-{$current_year} POPOJI

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
			</textarea>
		</div>
		<div class="text-center" style="margin:0 auto;">
			<form action="{$_SERVER['PHP_SELF']}" method="post" role="form">
				<input type="hidden" name="action" value="step1" />
				<button type="submit" class="btn btn-success btn-outline-rounded green">I Agree and Start Install</button>
			</form>
		</div>
	</div>
</div>
EOF;

	return $startinstallc;
}

function genPathCheckingConfig($errorMessage = '') {
	global  $aConf, $confFirst;

	$currentPage = $_SERVER['PHP_SELF'];

	$error = printInstallError( $errorMessage );
	$pathsTable = createTable($confFirst);

	return <<<EOF
<div class="tab-content">
	<div class="tab-pane fade in active" id="Paths">
		<h3 class="head text-center">Paths Check</h3>
		<p class="narrow text-center">POPOJI checks general script paths.</p>
		<p>&nbsp;</p>
		<form action="{$currentPage}" method="post" role="form">
			<div class="contable" style="padding:0 50px;">
				{$error}
				{$pathsTable}
			</div>
			<div class="text-center" style="margin:0 auto;">
				<input type="hidden" name="action" value="step2" />
				<button type="submit" class="btn btn-success btn-outline-rounded green">Next to Database</button>
			</div>
		</form>
	</div>
</div>
EOF;
}

function genDatabaseConfig($errorMessage = '') {
	global $confDB;

	$currentPage = $_SERVER['PHP_SELF'];
	$DbParamsTable = createTable($confDB);

	$errors = '';
	if (strlen($errorMessage)) {
		$errors = printInstallError($errorMessage);
		unset($_POST['db_name']);
		unset($_POST['db_user']);
		unset($_POST['db_password']);
	}

	$oldDataParams = '';
	foreach($_POST as $postKey => $postValue) {
		$oldDataParams .= ('action' == $postKey || isset($confDB[$postKey])) ? '' : '<input type="hidden" name="' . $postKey . '" value="' . $postValue . '" />';
	}

	return <<<EOF
<div class="tab-content">
	<div class="tab-pane fade in active" id="Database">
		<h3 class="head text-center">Database</h3>
		<p class="narrow text-center">POPOJI checks and connect to database.</p>
		<p>&nbsp;</p>
		<form action="{$currentPage}" method="post" role="form">
			<div class="contable" style="padding:0 50px;">
				{$errors}
				{$DbParamsTable}
			</div>
			<div class="text-center" style="margin:0 auto;">
				<input type="hidden" name="action" value="step3" />
				<button type="submit" class="btn btn-success btn-outline-rounded green">Next to Web Config</button>
				{$oldDataParams}
			</div>
		</form>
	</div>
</div>
EOF;
}

function genSiteGeneralConfig($errorMessage = '') {
	global $confGeneral;

	$currentPage = $_SERVER['PHP_SELF'];
	$paramsTable = createTable($confGeneral);

	$errors = '';
	if (strlen($errorMessage)) {
		$errors = printInstallError($errorMessage);
		unset($_POST['site_title']);
		unset($_POST['site_email']);
		unset($_POST['site_user']);
		unset($_POST['site_pass']);
		unset($_POST['notify_email']);
		unset($_POST['bug_report_email']);
		unset($_POST['site_timezone']);
	}

	$oldDataParams = '';
	foreach($_POST as $postKey => $postValue) {
		$oldDataParams .= ('action' == $postKey || isset($confGeneral[$postKey])) ? '' : '<input type="hidden" name="' . $postKey . '" value="' . $postValue . '" />';
	}

	return <<<EOF
<div class="tab-content">
	<div class="tab-pane fade in active" id="Web Config">
		<h3 class="head text-center">Web Config</h3>
		<p class="narrow text-center">POPOJI checks and config your site informations.</p>
		<p>&nbsp;</p>
		<form action="{$currentPage}" method="post" role="form">
			<div class="contable" style="padding:0 50px;">
				{$errors}
				{$paramsTable}
			</div>
			<div class="text-center" style="margin:0 auto;">
				<input type="hidden" name="action" value="step4" />
				<button type="submit" class="btn btn-success btn-outline-rounded green">Next to Installation Process</button>
				{$oldDataParams}
			</div>
		</form>
	</div>
</div>
EOF;
}

function genInstallationProcessPage($errorMessage = '') {
	global $aConf, $confFirst, $confDB, $confGeneral;

	$resRunSQL = RunSQL();

	$sForm = '';
	
	if ('done' ==  $resRunSQL) {
		RunLastSQL();
		$sForm = '
		<form action="./" method="post" role="form">
			<div class="text-center" style="margin:0 auto;">
				<input type="hidden" name="action" value="step5" />
				<button type="submit" class="btn btn-success btn-outline-rounded green">Goto Web</button>
			</div>
		</form>';
	} else {
		$sForm = $resRunSQL . '
		<form action="'.$_SERVER['PHP_SELF'].'" method="post" role="form">
			<button type="submit" class="btn btn-success btn-outline-rounded green">Back to Process</button>';
			foreach ($_POST as $sKey => $sValue) {
				if ($sKey != "action")
					$sForm .= '<input type="hidden" name="'.$sKey.'" value="'.$sValue.'" />';
			}
			$sForm .= '<input type="hidden" name="action" value="step2" />
		</form>';
		return $sForm;
	}

	foreach ($confFirst as $key => $val) {
		$aConf['headerTempl'] = str_replace ("%$key%", $_POST[$key], $aConf['headerTempl']);
	}
	foreach ($confDB as $key => $val) {
		$aConf['headerTempl'] = str_replace ("%$key%", $_POST[$key], $aConf['headerTempl']);
	}
	foreach ($confGeneral as $key => $val) {
		$aConf['headerTempl'] = str_replace ("%$key%", $_POST[$key], $aConf['headerTempl']);
	}

	$innerCode = '';
	$fp = fopen($aConf['header_inc_file'], 'w');
	if ($fp) {
		fputs($fp, $aConf['headerTempl']);
		fclose($fp);
		chmod($aConf['header_inc_file'], 0666);
	} else {
		$text = 'Warning!!! can not get write access to config file '.$aConf['header_inc_file'].'. Here is config file</font><br>';
		$innerCode .= printInstallError($text);
		$trans = get_html_translation_table(HTML_ENTITIES);
		$templ = strtr($aConf['headerTempl'], $trans);
		$sInnerCode .= '<textarea cols="20" rows="10" class="form-control">'.$aConf['headerTempl'].'</textarea>';
	}
	return <<<EOF
<div class="tab-content">
	<div class="tab-pane fade in active" id="Congratulations">
		<h3 class="head text-center">Congratulations</h3>
		<p class="narrow text-center">
			Installation process has finished.<br />Please delete or rename file install.php before or after click Goto Web button.
		</p>
		<p>&nbsp;</p>
		{$sForm}
	</div>
</div>
EOF;
}

// check of config pages steps
function checkConfigArray($checkedArray, &$error) {
	$errorMessage = '';

	foreach ($checkedArray as $key => $value) {
		if (! strlen($value['check'])) continue;

		$funcbody = $value['check'];
		$func = create_function('$arg0', $funcbody);

		if (! $func($_POST[$key])) {
			$fieldErr = $value['name'];
			$errorMessage .= "Please, input valid data to <b>{$fieldErr}</b> field<br />";
			$error_arr[$key] = 1;
			unset($_POST[$key]);
		} else
			$error_arr[$key] = 0;

	}

	if (strlen($errorMessage)) {
		$error = 'error';
	}

	return $errorMessage;
}

function genMainPage() {
	return <<<EOF
<script type="text/javascript">
	window.location = "./";
</script>
EOF;
}

function printInstallError($text) {
	$ret = (strlen($text)) ? '<div class="alert alert-danger">'.$text.'</div>' : '';
	return $ret;
}

function createTable($arr) {
	$ret = '';
	$i = '';
        $error_arr = array();
	foreach($arr as $key => $value) {
		$def_exp_text = "";
		if (strlen($value['def_exp'])) {
		    $funcbody = $value['def_exp'];
		    $func = create_function("", $funcbody);
		    $def_exp = $func();
			if (strlen($def_exp)) {
				$def_exp_text = "<i>(Status : <font color='green'>found</font>)</i>";
				$value['def'] = $def_exp;
			} else {
				$def_exp_text = "<i>(Status : <font color='red'>not found</font>)</i>";
			}
		}

		$st_err = ($error_arr[$key] == 1) ? ' style="background-color:#ffdddd;" ' : '';

		if ($key == 'site_timezone') {
			$ret .= <<<EOF
			<div class="row">
				<div class="col-md-4">{$value['name']} {$def_exp_text}</div>
				<div class="col-md-8">
					<select {$st_err} name="{$key}" class="form-control input-sm">
EOF;
						$timezoneList = timezoneList();
						foreach ($timezoneList as $tvalue => $tlabel) {
							$ret .= <<<EOF
							<option value='{$tvalue}'>{$tlabel}</option>
EOF;
						}
					$ret .= <<<EOF
					</select>
				</div>
			</div>
			<div class="row hidden-xs">
				<div class="col-md-4"><small>Description</small></div>
				<div class="col-md-8"><small>{$value['desc']}</small></div>
			</div>
			<div class="row hidden-xs">
				<div class="col-md-4"><small>Example</small></div>
				<div class="col-md-8"><small><i>{$value['ex']}</i></small></div>
			</div>
			<p>&nbsp</p>
EOF;
		} else {
			$ret .= <<<EOF
			<div class="row">
				<div class="col-md-4">{$value['name']} {$def_exp_text}</div>
				<div class="col-md-8"><input {$st_err} name="{$key}" class="form-control input-sm" value="{$value['def']}" /></div>
			</div>
			<div class="row hidden-xs">
				<div class="col-md-4"><small>Description</small></div>
				<div class="col-md-8"><small>{$value['desc']}</small></div>
			</div>
			<div class="row hidden-xs">
				<div class="col-md-4"><small>Example</small></div>
				<div class="col-md-8"><small><i>{$value['ex']}</i></small></div>
			</div>
			<p>&nbsp</p>
EOF;
		}
		$i ++;
	}

	return $ret;
}

function rewriteFile($code, $replace, $file) {
	$ret = '';
	$fs = filesize($file);
	$fp = fopen($file, 'r');
	if ($fp) {
		$fcontent = fread($fp, $fs);
		$fcontent = str_replace($code, $replace, $fcontent);
		fclose($fp);
		$fp = fopen($file, 'w');
		if ($fp) {
			if (fputs($fp, $fcontent)) {
				$ret .= true;
			} else {
				$ret .= false;
			}
			fclose ( $fp );
		} else {
			$ret .= false;
		}
	} else {
		$ret .= false;
	}
	return $ret;
}

function RunSQL() {
	$confDB['host'] = $_POST['db_host'];
	$confDB['sock'] = $_POST['db_sock'];
	$confDB['port'] = $_POST['db_port'];
	$confDB['user'] = $_POST['db_user'];
	$confDB['passwd'] = $_POST['db_password'];
	$confDB['db'] = $_POST['db_name'];

	$confDB['host'] .= ( $confDB['port'] ? ":{$confDB['port']}" : '' ) . ( $confDB['sock'] ? ":{$confDB['sock']}" : '' );

	$pass = true;
	$errorMes = '';
	$ret = '';
	$filename = $_POST['sql_file'];

	$vLink = @mysqli_connect($confDB['host'], $confDB['user'], $confDB['passwd']);

	if( !$vLink )
		return printInstallError( mysqli_error($vLink) );

	if (!mysqli_select_db ($vLink, $confDB['db']))
		return printInstallError( $confDB['db'] . ': ' . mysqli_error($vLink) );

    mysqli_query ($vLink, "SET sql_mode = ''");

    if (! ($f = fopen ( $filename, "r" )))
    	return printInstallError( 'Could not open file with sql instructions:' . $filename  );

	//Begin SQL script executing
	$s_sql = "";
	while ($s = fgets ( $f, 10240)) {
		$s = trim( $s ); //Utf with BOM only

		if (! strlen($s)) continue;
		if (mb_substr($s, 0, 1) == '#') continue; //pass comments
		if (mb_substr($s, 0, 2) == '--') continue;
		if (substr($s, 0, 5) == "\xEF\xBB\xBF\x2D\x2D") continue;

		$s_sql .= $s;

		if (mb_substr($s, -1) != ';') continue;

		$res = mysqli_query($vLink, $s_sql);
		if (!$res)
			$errorMes .= 'Error while executing: ' . $s_sql . '<br />' . mysqli_error($vLink) . '<hr />';

		$s_sql = '';
	}

    fclose($f);

    mysqli_close($vLink);

    if (strlen($errorMes)) {
    	return printInstallError($errorMes);
    } else {
    	return 'done';
    }
}

function RunLastSQL() {
	$confDB['host'] = $_POST['db_host'];
	$confDB['sock'] = $_POST['db_sock'];
	$confDB['port'] = $_POST['db_port'];
	$confDB['user'] = $_POST['db_user'];
	$confDB['passwd'] = $_POST['db_password'];
	$confDB['db'] = $_POST['db_name'];

	$confDB['host'] .= ( $confDB['port'] ? ":{$confDB['port']}" : '' ) . ( $confDB['sock'] ? ":{$confDB['sock']}" : '' );

	$errorMes = '';
	$ret = '';

	$vLink = @mysqli_connect($confDB['host'], $confDB['user'], $confDB['passwd']);

	if( !$vLink )
		return printInstallError( mysqli_error($vLink) );

	if (!mysqli_select_db ($vLink, $confDB['db']))
		return printInstallError( $confDB['db'] . ': ' . mysqli_error($vLink) );

    mysqli_query ($vLink, "SET sql_mode = ''");

	$siteEmail = DbEscape($vLink, $_POST['site_email']);
	$siteTitle = DbEscape($vLink, $_POST['site_title']);
	$siteDesc = DbEscape($vLink, $_POST['site_desc']);
	$siteUser = DbEscape($vLink, $_POST['site_user']);
	$sitePass = DbEscape($vLink, $_POST['site_pass']);
	$siteTimezone = DbEscape($vLink, $_POST['site_timezone']);
	$sitePassEnc = password_hash($sitePass, PASSWORD_BCRYPT);
	$strUrlsim = rtrim(((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http"). "://".$_SERVER['HTTP_HOST'], "/").$_SERVER['PHP_SELF'];
	$siteUrlsim = rtrim(str_replace("install.php","",$strUrlsim), "/");
	date_default_timezone_set($siteTimezone);
	
	if ($siteEmail != '' && $siteTitle != '' && $siteUser != '' && $sitePass != '') {
		if (!(mysqli_query($vLink, "UPDATE settings SET value = '{$siteTitle}' WHERE id = '1'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
		if (!(mysqli_query($vLink, "UPDATE settings SET value = '{$siteUrlsim}' WHERE id = '2'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
		if (!(mysqli_query($vLink, "UPDATE settings SET value = '{$siteDesc}' WHERE id = '3'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
		if (!(mysqli_query($vLink, "UPDATE settings SET value = '{$siteEmail}' WHERE id = '6'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
		if (!(mysqli_query($vLink, "UPDATE users SET username = '{$siteUser}', email = '{$siteEmail}', password = '{$sitePassEnc}' WHERE id = '1'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
		if (!(mysqli_query($vLink, "UPDATE users SET password = '{$sitePassEnc}' WHERE id = '2'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
		if (!(mysqli_query($vLink, "UPDATE users SET password = '{$sitePassEnc}' WHERE id = '3'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
		if (!(mysqli_query($vLink, "UPDATE users SET password = '{$sitePassEnc}' WHERE id = '4'")))
			$ret .= "<font color='red'><i><b>Error</b>:</i> ".mysqli_error($vLink)."</font>";
	} else {
		$ret .= "<font color='red'><i><b>Error</b>:</i> Please check again site email or site title.</font>";
	}

    mysqli_close($vLink);

    $errorMes .= $ret;

    if (strlen($errorMes)) {
    	return printInstallError($errorMes);
    }
}

function DbEscape($vLink, $s, $isDetectMagixQuotes = true) {
    if (get_magic_quotes_gpc() && $isDetectMagixQuotes)
        $s = stripslashes ($s);
    return mysqli_real_escape_string($vLink, $s);
}

function CheckSQLParams() {
	$confDB['host'] = $_POST['db_host'];
	$confDB['sock'] = $_POST['db_sock'];
	$confDB['port'] = $_POST['db_port'];
	$confDB['user'] = $_POST['db_user'];
	$confDB['passwd'] = $_POST['db_password'];
	$confDB['db'] = $_POST['db_name'];
	$confDB['host'] .= ( $confDB['port'] ? ":{$confDB['port']}" : '' ) . ( $confDB['sock'] ? ":{$confDB['sock']}" : '' );

	$vLink = @mysqli_connect($confDB['host'], $confDB['user'], $confDB['passwd']);

	if (!$vLink)
		return printInstallError(mysqli_error($vLink));

	if (!mysqli_select_db ($vLink, $confDB['db']))
		return printInstallError($confDB['db'] . ': ' . mysqli_error($vLink));

	mysqli_close($vLink);
}

function timezoneList(){
    $timezoneIdentifiers = DateTimeZone::listIdentifiers();
    $utcTime = new DateTime('now', new DateTimeZone('UTC'));
    $tempTimezones = array();
    foreach($timezoneIdentifiers as $timezoneIdentifier){
        $currentTimezone = new DateTimeZone($timezoneIdentifier);
        $tempTimezones[] = array(
            'offset' => (int)$currentTimezone->getOffset($utcTime),
            'identifier' => $timezoneIdentifier
        );
    }
    function sort_list($a, $b){
        return ($a['offset'] == $b['offset']) 
            ? strcmp($a['identifier'], $b['identifier'])
            : $a['offset'] - $b['offset'];
    }
    usort($tempTimezones, "sort_list");
    $timezoneList = array();
    foreach($tempTimezones as $tz){
        $sign = ($tz['offset'] > 0) ? '+' : '-';
        $offset = gmdate('H:i', abs($tz['offset']));
        $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
            $tz['identifier'];
    }
    return $timezoneList;
}

function findEnv($key) {
	$file_lines = file('po-includes/.env');
	foreach($file_lines as $line) {
		$entry_array = explode("=", $line);
		if(count($entry_array) > 0) {
			if ($entry_array[0] == $key) {
				return trim($entry_array[1]);
			}
		}
	}
	
	return null;
}

?>
