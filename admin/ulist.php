<?php
/**
 * Created by PhpStorm.
 * User: cghang
 * Date: 2018/7/16
 * Time: 1:40 AM
 */
include("../includes/common.php");
$title='用户列表';
include './head.php';


$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加用户</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=add_submit" method="POST">
<div class="form-group">
<label>用户名:</label><br>
<input type="text" class="form-control" name="user" value="" required>
</div>
<div class="form-group">
<label>用户密码:</label><br>
<input type="text" class="form-control" name="pwd" value="" required>
</div>
<div class="form-group">
<label>手机号:</label><br>
<input type="text" class="form-control" name="phone" value="" placeholder="可留空">
</div>
<div class="form-group">
<label>邮箱:</label><br>
<input type="text" class="form-control" name="email" value="" placeholder="可留空">
</div>
<div class="form-group">
<label>ＱＱ:</label><br>
<input type="text" class="form-control" name="qq" value="" placeholder="可留空">
</div>
<div class="form-group">
<label>状态选择:</label><br><select class="form-control" name="active"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
echo '<br/><a href="./ulist.php">>>返回用户列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=$_GET['id'];
$row=$DB->query("select * from mzf_user where id='$id' limit 1")->fetch();
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改用户信息</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./ulist.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label>用户名:</label><br>
<input type="text" class="form-control" name="user" value="'.$row['user'].'" placeholder="不可空">
</div>
<div class="form-group">
<label>手机号:</label><br>
<input type="text" class="form-control" name="phone" value="'.$row['phone'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>邮箱:</label><br>
<input type="text" class="form-control" name="email" value="'.$row['email'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>ＱＱ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'" placeholder="可留空">
</div>
<div class="form-group">
<label>是否正常:</label><br><select class="form-control" name="active" default="'.$row['active'].'"><option value="1">1_正常</option><option value="0">0_封禁</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>
';
echo '<br/><a href="./ulist.php">>>返回用户列表</a>';
echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>';
}
elseif($my=='add_submit')
{
$username=$_POST['user'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$qq=$_POST['qq'];
$pwd=md5($_POST['pwd']);
$active=$_POST['active'];
if($pwd==NULL or $user==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
$key = random(32);
$sds=$DB->exec("INSERT INTO `mzf_user` (`token`, `user`, `pwd`, `phone`, `addtime`, `email`, `qq`, `active`) VALUES ('{$key}',  '{$user}', '{$pwd}', '{$phone}', '{$date}', '{$email}', '{$qq}', '{$active}')");
$pid=$DB->lastInsertId();
if($sds){
	showmsg('添加用户成功！登陆账号：'.$pid.'<br/>登陆密码：已加密<br/><br/><a href="./ulist.php">>>返回用户列表</a>',1);
}else
	showmsg('添加用户失败！<br/>错误信息：'.$DB->errorCode(),4);
}
}
elseif($my=='edit_submit')
{
$id=$_GET['id'];
$rows=$DB->query("select * from mzf_user where id='$id' limit 1")->fetch();
if(!$rows){
    showmsg('当前记录不存在！',3);exit;
}
$user=$_POST['user'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$qq=$_POST['qq'];
$active=$_POST['active'];
if($user==NULL){
showmsg('保存错误,请确保加*项都不为空!',3);
} else {
$sql="update `mzf_user` set `user` ='{$user}',`phone` ='{$phone}',`email` ='$email',`qq` ='$qq',`active` ='$active' where `id`='$id'";
if($DB->exec($sql)||$sqs)
	showmsg('修改用户信息成功！<br/><br/><a href="./ulist.php">>>返回用户列表</a>',1);
else
	showmsg('修改用户信息失败！'.$DB->errorCode(),4);
}
}
elseif($my=='delete')
{
$id=$_GET['id'];
$rows=$DB->query("select * from mzf_user where id='$id' limit 1")->fetch();
if(!$rows){
	showmsg('当前记录不存在！',3);exit;
}
$sql="DELETE FROM mzf_user WHERE id='$id'";
if($DB->exec($sql))
	showmsg('删除用户成功！<br/><br/><a href="./ulist.php">>>返回用户列表</a>',1);
else
	showmsg('删除用户失败！'.$DB->errorCode(),4);
}
else
{

echo '<form action="ulist.php" method="GET" class="form-inline"><input type="hidden" name="my" value="search">
  <div class="form-group">
    <label>搜索</label>
	<select name="column" class="form-control"><option value="user">用户名</option><option value="qq">QQ号</option><option value="phone">手机号码</option><option value="email">邮箱</option></select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="value" placeholder="搜索内容">
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>&nbsp;<a href="./ulist.php?my=add" class="btn btn-success">添加用户</a>&nbsp;<a href="./plist.php" class="btn btn-default">商户管理</a>
</form>';

if($my=='search') {
	$sql=" `{$_GET['column']}`='{$_GET['value']}'";
	$numrows=$DB->query("SELECT * from mzf_user WHERE{$sql}")->rowCount();
	$con='包含 '.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 个用户';
}else{
	$numrows=$DB->query("SELECT * from mzf_user WHERE 1")->rowCount();
	$sql=" 1";
	$con='共有 <b>'.$numrows.'</b> 个用户';
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>用户ID</th><th>用户名</th><th>QQ号</th><th>邮箱</th><th>手机号</th><th>添加时间</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM mzf_user WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['user'].'</td><td>'.$res['qq'].'</td><td>'.$res['email'].'</td><td>'.$res['phone'].'</td><td>'.$res['addtime'].'</td><td>'.($res['active']==1?'<font color=green>正常</font>':'<font color=red>封禁</font>').'</td><td><a href="./ulist.php?my=edit&id='.$res['id'].'" class="btn btn-xs btn-info">编辑</a>&nbsp;<a href="./ulist.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此用户吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="ulist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="ulist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="ulist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="ulist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="ulist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>
    </div>
  </div>