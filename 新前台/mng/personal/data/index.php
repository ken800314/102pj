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
        function submitForm(){
            $('#ff').form('submit');
        }
        function clearForm(){
            $('#ff').form('clear');
        }
         $(function () {
            $("#txtDate").datebox({
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
    <div class="demo-info">
       <div><img src="../../../css/images/tip.png">請參考證照登錄流程.</div> 
    </div>
    <div style="margin:10px 0;"></div>
    <div class="easyui-panel" title="新增登錄" style="width:400px;0">
        <div style="padding:10px 0 10px 60px">
        <form id="ff" method="post">
            <table>
                <tr>
                    <td>姓名：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="name" data-options="required:true"></input>
					</td>
                </tr>
                <tr>
                    <td>學號：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="uid" data-options="required:true"></input>
					</td>
                </tr>
                <tr>
                    <td>學制：</td>
					<td>
						<select class="easyui-combobox" name="state">
							<option value="四技日間部">四技日間部</option>
							<option value="四技夜間部">四技夜間部</option>
						</select>
					</td>
				</tr>
				  <tr>
                    <td>英文名：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="subject" data-options="required:true"></input>
					</td>
                </tr>
				 <tr>
                    <td>國內/外：</td>
					<td>
						<select class="easyui-combobox" name="state">
							<option value="國內">國內</option>
							<option value="國外">國外</option>
						</select>
					</td>
				</tr>
				 <tr>
                    <td>證照類別：</td>
					<td>
						<select id="select1">
							<option value="">請選擇</option>
							<?php
									// 資料庫設定
								$host_sql = 'localhost';
								$username_sql = 'root';
								$password_sql = '0000';
									// 聯結資料庫
								$link = mysql_connect($host_sql, $username_sql, $password_sql) or die('無法連結資料庫');
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
							<!-- 利用隱藏欄位指定預設的選項 -->

							<input id="fullIdPath" type="hidden" value="0,0,0" />
				<tr>
                    <td>證照名稱：</td>
					<td>
						<select id="select2">
							<option value="">請選擇</option>
						</select>
					</td>
				</tr>
				<tr>
                    <td>點數：</td>
					<td>
						<select id="select3">
							<option value="">請選擇</option>
						</select>
					</td>
				</tr>
				<input id="fullIdPath" type="hidden" value="0,0,0" />
				<tr>
                    <td>登錄日期：</td>
					<td>
						<input class="easyui-datebox" id="txtDate"></input>
					</td>
                </tr>
				<tr>
                    <td>級別：</td>
                    <td>
						<input class="easyui-validatebox" type="text" name="subject" data-options="required:true"></input>
					</td>
                </tr>
				<tr>
				</tr>
            </table>
        </form>
        </div>
        <div style="text-align:center;padding:5px">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">確認</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">清除</a>
        </div>
    </div>
</body>
</html>
