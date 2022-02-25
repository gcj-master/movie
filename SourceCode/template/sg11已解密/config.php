<?php

$my = parse_ini_file(dirname(dirname(__FILE__)) . "/info.ini", true);
date_default_timezone_set("Asia/Shanghai");
ini_set("display_errors", "On");
error_reporting(E_ALL);
define("SystemRoot", dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define("IncDir", SystemRoot . "inc" . DIRECTORY_SEPARATOR);
define("CacheDir", SystemRoot . "/admin/cache" . DIRECTORY_SEPARATOR);
define("SystemDir", "/");
define("SystemDomain", "");
define("AdminDir", "admin");
define("Product", "MACCMS243");
define("UploadDir", "statics");
define("TemplateDir", "template");
define("UrlRewrite", 0);
define("IndexFile", "index.php");
define("WapOpen", 0);
define("WapDomain", "");
define("DbError", 0);
define("MysqlEngine", "MyISAM");
define("TableEx", "sm_");
define("ArticleTable", TableEx . "article");
define("SiteHash", "d296bf4053251a53f56e");
define("SiteCache", 1);
define("TemplateTime", 0);
define("TemplateStart", "{");
define("TemplateEnd", "}");
define("TemplateDebug", 0);
define("IndexCache", 0);
define("AdminOpenid", 0);
define("AdminFileedit", 1);
define("version", "1.0");
$site_db = array("database" => "sqlitepdo", "dbfile" => "data/50ef74f1ea787652.db");
require "func.php";
if (!defined("NoDb") && !isset($GLOBALS["db"])) {
	$GLOBALS["db"] = new db();
	$GLOBALS["db"]->connect($site_db);
}
_stripslashes();
error_reporting(0);
$domain = gettopdomainhuo();
$real_domain = "baidu.com";
$http_type = isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] == "443" ? "https://" : "http://";
$check_host = "" . $http_type . "sq.mytheme.cn/api/api.php";
$client = "&client=" . base64_encode(str_replace(" ", "+", "" . Product . ""));
$client_check = $check_host . "?a=client_check&u=" . trim($_SERVER["HTTP_HOST"]) . $client;
$check_message = $check_host . "?a=check_message&u=" . trim($_SERVER["HTTP_HOST"]) . $client;
$message = file_get_contents($check_message);
$cache_check_info = "cache/" . substr(md5($domain), 0, 16) . "_info.dat";
$cache_check_msg = "cache/" . substr(md5($domain), 0, 16) . "_msg.dat";
$cache_domain = __DIR__ . $cache_check_info;
if (!file_exists($cache_domain) && filemtime($cache_check_info) + 604800 < time()) {
	$check_info = file_get_contents($client_check);
	$message = file_get_contents($check_message);
	file_put_contents($cache_check_info, base64_encode(json_encode($check_info)));
	file_put_contents($cache_check_msg, $message);
} else {
	$check_info = json_decode(base64_decode(file_get_contents($cache_check_info)));
	$message = file_get_contents($cache_check_msg);
}
$ben_string = trim(gettopdomainhuo()) . $real_domain;
$shaben = sha1($ben_string);
$robotstrben = substr(md5($shaben), 0, 8);
if ($check_info == $robotstrben) {
	$get_string = trim(gettopdomainhuo()) . $real_domain;
} else {
	$get_string = trim($_SERVER["HTTP_HOST"]) . $real_domain;
}
$sha = sha1($get_string);
$robotstr = substr(md5($sha), 0, 8);
if ($check_info == "1" || $check_info == "2" || $check_info == "3" || $check_info == "4" || $check_info == "5") {
	header("Content-Type: text/html;charset=utf-8");
	echo "<title>Mytheme</title>";
	echo "<link href=\"static/layui/css/layui.css\" rel=\"stylesheet\" type=\"text/css\" />";
	echo "<link href=\"static/css/sq.css\" rel=\"stylesheet\" type=\"text/css\" />";
	echo "<div class=\"wrapper\">";
	echo "<div class=\"main\">";
	echo "<div class=\"title\">授权信息</div>";
	echo "<div class=\"content\">";
	echo "<h3><font color=red>" . $message . "</font></h3>";
	echo "<p>请正确提交域名授权，如果已经授权请检查目录权限或清理缓存刷新重试</p>";
	echo "<p><a class=\"layui-btn layui-btn-normal\" target=\"_blank\" href=\"https://www.mytheme.cn/index.php?s=theme&c=shouquan&cid=" . $my["id"] . "\"><i class=\"layui-icon layui-icon-add-1\"></i> 提交授权</a><a class=\"layui-btn layui-btn-warm\" target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=" . $my["qq"] . "&site=qq&menu=yes\"><i class=\"layui-icon layui-icon-dialogue\"></i> 联系客服</a><a class=\"layui-btn\" target=\"_blank\" href=\"./clear.php\"><i class=\"layui-icon layui-icon-set\"></i> 清理缓存</a></p>";
	echo "</div>";
	echo "<div class=\"footer\"><a target=\"_blank\" href=\"https://www.mytheme.cn/\">MyTheme.cn</a>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	exit;
}
$result = $check_info;
if (empty($result)) {
	$result_info = "0";
} else {
	if (!empty($result)) {
		$result_info = $check_info;
	}
}
if ($robotstr !== $result_info) {
	if ($domain !== $real_domain) {
		header("Content-Type: text/html;charset=utf-8");
		echo "<title>Mytheme</title>";
		echo "<link href=\"static/layui/css/layui.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"static/css/sq.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<div class=\"wrapper\">";
		echo "<div class=\"main\">";
		echo "<div class=\"title\">授权状态</div>";
		echo "<div class=\"content\">";
		echo "<h3><font color=red>远程授权校验失败！</font></h3>";
		echo "<p>请正确提交域名授权，如果已经授权请检查目录权限或清理缓存刷新重试</p>";
		echo "<p><a class=\"layui-btn layui-btn-normal\" target=\"_blank\" href=\"https://www.mytheme.cn/index.php?s=theme&c=shouquan&cid=" . $my["id"] . "\"><i class=\"layui-icon layui-icon-add-1\"></i> 提交授权</a><a class=\"layui-btn layui-btn-warm\" target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=" . $my["qq"] . "&site=qq&menu=yes\"><i class=\"layui-icon layui-icon-dialogue\"></i> 联系客服</a><a class=\"layui-btn\" target=\"_blank\" href=\"./clear.php\"><i class=\"layui-icon layui-icon-set\"></i> 清理缓存</a></p>";
		echo "</div>";
		echo "<div class=\"footer\"><a target=\"_blank\" href=\"https://www.mytheme.cn/\">MyTheme.cn</a>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		exit;
	}
}
unset($domain);
function getTopDomainhuo()
{
	$url = $_SERVER["HTTP_HOST"];
	$data = explode(".", $url);
	$co_ta = count($data);
	$zi_tow = true;
	$host_cn = "com.cn,net.cn,org.cn,gov.cn";
	$host_cn = explode(",", $host_cn);
	foreach ($host_cn as $host) {
		if (strpos($url, $host)) {
			$zi_tow = false;
		}
	}
	if ($zi_tow == true) {
		$host = $data[$co_ta - 2] . "." . $data[$co_ta - 1];
	} else {
		$host = $data[$co_ta - 3] . "." . $data[$co_ta - 2] . "." . $data[$co_ta - 1];
	}
	return $host;
}