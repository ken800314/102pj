<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>證照登錄</title>
    <link rel="stylesheet" type="text/css" href="../../../css/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../../css/icon.css">
    <link rel="stylesheet" type="text/css" href="../../../css/demo.css">
    <script type="text/javascript" src="../../../js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../../../js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="../../../js/easyui-lang-zh_TW.js"></script>
    <script type="text/javascript" src="js/selectboxes.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
	<script>
		function check_data()
		{
        if (document.myForm.cname.value.length == 0)
          alert("帳號不可以空白");
        else if (document.myForm.sid.value.length == 0)
          alert("密碼不可以空白");
        else
		 if (alert('登錄成功')) {
        }
			myForm.submit();
		}
        function clearForm(){
            $('#ff').form('clear');
        }
         $(function () {
            $("#date").datebox({
                formatter: function (date) {
                    var y = date.getFullYear();
                    var m = date.getMonth() + 1;
                    var d = date.getDate();
                    return y + "/" + (m < 10 ? ("0" + m) : m) + "/" + (d < 10 ? ("0" + d) : d);
                }
            });
        });
    </script>
</head>
<body>
<?php
	require_once("dbtools.inc.php");
      session_start();
	  if (isset($_SESSION["user_id"]))
	  {
        $user_id = $_SESSION["user_id"];
	  }
	else
	{
	    header("location:index.html");
	}
      $link = create_connection();		//建立資料庫連結	  
      $sql = "SELECT * FROM suid WHERE user_id = '$user_id'";
      $result = execute_sql("License", $sql, $link);
	  $row = mysql_fetch_assoc($result);
?>
    <div class="demo-info">
       <div><img src="../../../css/images/tip.png">請參考證照登錄流程.</div> 
    </div>
    <div style="margin:10px 0;"></div>
    <div class="easyui-panel" title="新增登錄" style="width:900px;0">
        <div style="padding:10px 0 10px 60px">
        <form id="ff" method="post" action="add.php" name="myForm">
            <table>
                <tr>
                    <td>姓名：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="cname" data-options="required:true" value="<?php echo $row['name'] ?>"></input>
					</td>
                </tr>
                <tr>
                    <td>學號：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="sid" data-options="required:true" value="<?php echo $row['sid'] ?>"></input>
					</td>
                </tr>
				<tr>
                    <td>班級：</td>
					<td>
						<select class="easyui-combobox" name="class">
							<option value="0">忠</option>
							<option value="1">信</option>
							<option value="2">篤</option>
						</select>
					</td>
				</tr>
                <tr>
                    <td>學制：</td>
					<td>
						<select class="easyui-combobox" name="school_system">
							<option value="0">四技日間部</option>
							<option value="1">四技夜間部</option>
						</select>
					</td>
				</tr>
				  <tr>
                    <td>英文名：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="ename" data-options="required:true" value="<?php echo $row['ename'] ?>"></input>
					</td>
                </tr>
                <tr>
                    <td>學期：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="year" data-options="required:true"></input>
					</td>
                </tr>
                <tr>
                    <td>入學學年：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="semester" data-options="required:true"></input>
					</td>
                </tr>
				 <tr>
                    <td>國內/外：</td>
					<td>
						<select class="easyui-combobox" name="domestic_outer">
							<option value="0">國內</option>
							<option value="1">國外</option>
						</select>
					</td>
				</tr>
				 <tr>
                    <td>證照類別：</td>
					<td>
						<select id="select1" name="licensing_units">
							<option value="">請選擇</option>
							<?php
									mysql_select_db('selectboxes', $link);
									mysql_query('SET NAMES UTF8');
									// 動態取得第一階層下拉式選單
								$query = 'SELECT id, name FROM games WHERE levelNum = 1';
								$result = mysql_query($query, $link);
								while ($row = mysql_fetch_assoc($result)) {
								echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>' . "\n";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
                    <td>證照名稱：</td>
					<td>
						<select id="select2" name="license_name">
							<option value="">請選擇</option>
						</select>
					</td>
				</tr>
				<tr>
                    <td>點數：</td>
					<td>
						<select id="select3" name="count">
							<option value="">請選擇</option>
						</select>
					</td>
				</tr>
					<!-- 可預設下拉式選單初始值 並隱藏-->
				<input id="fullIdPath" type="hidden" value="0,0,0" />
				<tr>
                    <td>登錄日期：</td>
					<td>
						<input class="easyui-datebox" id="date" name="date"></input>
					</td>
                </tr>
				<tr>
					<!-- 刪除預設 = 0 並隱藏-->
				    <td>
						<input class="easyui-validatebox" type="hidden" name="delete" data-options="required:true" value="0"></input>
					</td>
				</tr>
				<tr>
					<!-- 審核狀態預設 = 1 並隱藏-->
				    <td>
						<input class="easyui-validatebox" type="hidden" name="audit_state" data-options="required:true" value="1"></input>
					</td>
				</tr>
				<tr>
					<!-- 審核次數預設 = 0 並隱藏-->
				    <td>
						<input class="easyui-validatebox" type="hidden" name="audit_frequency" data-options="required:true" value="0"></input>
					</td>
				</tr>
            </table>
        </form>
        </div>
        <div style="text-align:center;padding:5px">
            <a href="javascript:void(0)" class="easyui-linkbutton" onClick="check_data()">確認</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">清除</a>
        </div>
    </div>
</body>
</html>
