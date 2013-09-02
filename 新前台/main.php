<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>資訊管理系 - 證照查詢系統</title>
<link rel="stylesheet" type="text/css" href="css/easyui.css"/>
<link rel="stylesheet" type="text/css" href="css/layout.css"/>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="js/backend.js"></script>
</head>
<body class="easyui-layout">
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
	<div region="north" border="true" class="cs-north">
		<div class="cs-north-bg">
			<div class="cs-north-logo">
				<img src="css/images/tip.png">
				學號：<font color='black'><?php echo $row['sid'] ?></font>
				|姓名：<font color='black'><?php echo $row['name'] ?></font>
				|學制：<font color='black'>
						<?php  									//判斷  0 = 四技日間部  1 = 四技夜間部
							if($row['school_system'] == 0)
								{
									echo "四技日間部";
								}
							else
								{
									echo "四技夜間部";
								}
						?></font>
			<a href="logout.php"><font color='red'>[登出系統]</font></a>
			</div>
			<div class="cs-north-logo_1">
			證照管理系統
			
			</div>
		</div>
	</div>
	<div region="west" border="true" split="true" title="主選單" class="cs-west">
		<div class="easyui-accordion" fit="true" border="false">
				<div title="公告區">
					<h2><a href="javascript:void(0);" src="mng/announcement/news/index.html" class="cs-navi-tab">最新消息</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/announcement/announcement/index.html" class="cs-navi-tab">系上公告</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/announcement/process/index.html" class="cs-navi-tab">登錄流程</a></p></h2>
				</div>
				<div title="個人區">
					<h2><a href="javascript:void(0);" src="mng/personal/password/index.html" class="cs-navi-tab">密碼修改</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/personal/data/index.php" class="cs-navi-tab">證照登錄</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/personal/accumulative/index.html" class="cs-navi-tab">證照累計點數查詢</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/personal/audit/index.html" class="cs-navi-tab">證照審核查詢</a></p></h2>
				</div>
				<div title="證照查詢區">
					<h2><a href="javascript:void(0);" src="mng/license/exam/index.html" class="cs-navi-tab">近期證照考試</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/license/check_license/index.html" class="cs-navi-tab">各證照點數查詢</a></p></h2>
				</div>
				<div title="證照排行榜區">
					<h2><a href="javascript:void(0);" src="mng/ranking/class/index.html" class="cs-navi-tab">各學年班級排行榜</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/ranking/individual/index.html" class="cs-navi-tab">各學年排行榜</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/ranking/highest/index.html" class="cs-navi-tab">歷年最高紀錄排行</a></p></h2>
				</div>
				<div title="證照需求相關資訊">
					<h2><a href="javascript:void(0);" src="mng/demand/index.html" class="cs-navi-tab">各行業需求證照相關資訊</a></p></h2>
					<h2><a href="javascript:void(0);" src="mng/demand/index.html" class="cs-navi-tab">各證照實用性</a></p></h2>
				</div>
				<div title="相關連結">
					<h2><a href="javascript:void(0);" src="http://itia.im.tpcu.edu.tw/itia2013/" class="cs-navi-tab">I T I A</a></p></h2>
					<h2><a href="javascript:void(0);" src="http://www.appledaily.com.tw/" class="cs-navi-tab">蘋果日報</a></p></h2>
					<h2><a href="javascript:void(0);" src="http://tw.yahoo.com/" class="cs-navi-tab">Yahoo!</a></p></h2>
					<h2><a href="javascript:void(0);" src="http://www.tpcu.edu.tw/bin/home.php" class="cs-navi-tab">T P C U</a></p></h2>
				</div>
		</div>
	</div>
	<div id="mainPanle" region="center" border="true" border="false">
		 <div id="tabs" class="easyui-tabs"  fit="true" border="false" >
                <div title="Home">
				<div class="cs-home-remark">
					<h1>歡迎使用證照管理系統</h1> <br>
					<h2>歡迎使用</h2></br>
					在各分頁點擊右鍵即可重新整理</br>
					第三行</br>
				</div>
				</div>
        </div>
	</div>
	<div region="south" border="false" class="cs-south">版權宣告</div>
	
	<div id="mm" class="easyui-menu cs-tab-menu">
		<div id="mm-tabupdate">重新整理</div>
		<div class="menu-sep"></div>
		<div id="mm-tabclose">關閉</div>
		<div id="mm-tabcloseother">關閉其他</div>
		<div id="mm-tabcloseall">關閉全部</div>
	</div>
</body>
</html>
