<?php

    // 資料庫設定
    $host_sql = 'localhost';
    $username_sql = 'root';
    $password_sql = '0000';

    // 聯結資料庫
    $link = mysql_connect($host_sql, $username_sql, $password_sql) or die('無法連結資料庫');
    mysql_select_db('selectboxes', $link);
    mysql_query('SET NAMES UTF8');

    // 預設選項
    $data['0'] = '請選擇';

    // 只有在 parentId 與 levelNum 都存在的情況下，才進行資料庫的搜尋
    if (0 !== (int) $_GET['id'] && 0 !== (int) $_GET['lv']) {
        $parentId = (int) $_GET['id'];
        $levelNum = (int) $_GET['lv'];
        
        $query = sprintf("SELECT id, name FROM games WHERE parentId = %d AND levelNum = %d", $parentId, $levelNum);
        $result = mysql_query($query, $link);
        while ($row = mysql_fetch_assoc($result)) {
        
            // 將取得的資料放入陣列中
            $data[$row['id']] = $row['name'];
        }
    }
    
    // 將陣列轉換為 json 格式輸入
    echo json_encode($data);
?>
