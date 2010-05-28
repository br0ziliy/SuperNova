<?php
/**
 * alliance.php
 *
 * Alliance control page
 *
 * History
 * 2.0  - Full rewrite by Gorlum for http://supernova.ws
 * 1.0s - Security checked for SQL-injection by Gorlum for http://supernova.ws
 * 1.0  - copyright 2008 by Chlorel for XNova
 */

define('INSTALL' , false);
define('INSIDE', true);

$ugamela_root_path = './';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'common.' . $phpEx);

if ($IsUserChecked == false) {
  includeLang('login');
  header("Location: login.php");
}

check_urlaubmodus ($user);

// MINE VARS
$POST_name = SYS_mysqlSmartEscape($_POST['name']);
$POST_tag = SYS_mysqlSmartEscape($_POST['tag']);
$POST_web = SYS_mysqlSmartEscape($_POST['web']);
$POST_image = SYS_mysqlSmartEscape($_POST['image']);
$POST_request_notallow = intval($_POST['request_notallow']);
$POST_owner_range = SYS_mysqlSmartEscape($_POST['owner_range']);
$POST_text = SYS_mysqlSmartEscape(strip_tags($_POST['text']));

$rankListInput = $_POST['u'];

$id_user = intval($_GET['id_user']);
if(isset($_GET['id_rank']))
  $id_rank = intval($_GET['id_rank']);

$newRankName = SYS_mysqlSmartEscape(strip_tags($_POST['newRankName']));

// Main admin page save themes
$isSaveText       = !empty($_POST['isSaveText']);
$isSaveOptions    = !empty($_POST['isSaveOptions']);
$isDisband        = !empty($_POST['isDisband']);
$isConfirmDisband = !empty($_POST['isConfirmDisband']);

$mode       = SYS_mysqlSmartEscape($_GET['mode']);

// alliance ID
$a          = intval($_GET['a']);

// new tag when creating alliance
$POST_atag  = SYS_mysqlSmartEscape($_POST['atag']);





$edit       = SYS_mysqlSmartEscape($_GET['edit']);
$allyid     = intval($_GET['allyid']);
$d          = intval($_GET['d']);
$yes        = intval($_GET['yes']);
$sort1      = intval($_GET['sort1']);
$sort2      = intval($_GET['sort2']);
$t          = intval($_GET['t']);
$rank       = intval($_GET['rank']);
$kick       = intval($_GET['kick']);
$id         = intval($_GET['id']);
$show       = intval($_GET['show']);
$sendmail   = intval($_GET['sendmail']);
$tag        = SYS_mysqlSmartEscape($_GET['tag']);
$POST_aname = SYS_mysqlSmartEscape($_POST['aname']);
$POST_searchtext = SYS_mysqlSmartEscape($_POST['searchtext']);
$POST_action = SYS_mysqlSmartEscape($_POST['action']);
$POST_r = intval($_POST['r']);
$POST_id = $_POST['id']; // pretty safe 'cause it's array. We will handle it's later
$POST_further = SYS_mysqlSmartEscape($_POST['further']);
$POST_bcancel = SYS_mysqlSmartEscape($_POST['bcancel']);
$POST_newrangname = SYS_mysqlSmartEscape($_POST['newrangname']);
$POST_newleader = SYS_mysqlSmartEscape($_POST['newleader']);
$POST_newrang = SYS_mysqlSmartEscape($_POST['newrang']);
$POST_newname = SYS_mysqlSmartEscape($_POST['newname']);
$POST_newtag = SYS_mysqlSmartEscape($_POST['newtag']);

includeLang('alliance');


/*
  Alianza consiste en tres partes.
  La primera es la comun. Es decir, no se necesita comprobar si se esta en una alianza o no.
  La segunda, es sin alianza. Eso implica las solicitudes.
  La ultima, seria cuando ya se esta dentro de una.
*/
// Parte inicial.

if ($mode == 'ainfo') {
  include('includes/includes/ali_info.inc');
};
// --[Comprobaciones de alianza]-------------------------
if ($user['ally_id'] == 0) { // Sin alianza
  include('includes/includes/ali_external.inc');
}elseif
//---------------------------------------------------------------------------------------------------------------------------------------------------
// Parte de adentro de la alianza
($user['ally_id'] != 0 && $user['ally_request'] == 0) { // Con alianza
  include('includes/includes/ali_internal.inc');
}
?>
