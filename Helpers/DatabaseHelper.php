<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;

class DatabaseHelper
{
    public static function postTextSnippet(string $uid, string $code, string $code_language, string $expired_at, string $title): array {
        $db = new MySQLWrapper();

        // データベースにインサートするSQL文
        $stmt = $db->prepare("INSERT INTO text_snap (uid, code, code_language, expired_at, title, is_expired) VALUES (?, ?, ?, ?, ?, ?)");
        
        // プレースホルダに値をバインド
        $isExpired = 0; // false を表す整数値
        $stmt->bind_param("sssssi", $uid, $code, $code_language, $expired_at, $title, $isExpired);
        
        // クエリを実行
        if (!$stmt->execute()) {
            throw new Exception('Failed to insert data into text_snap table: ' . $stmt->error);
        }
        
        // 挿入されたレコードのIDを取得
        $insertedId = $stmt->insert_id;
        
        // インサートされたデータを再取得して返す（例として）
        $stmt = $db->prepare("SELECT * FROM text_snap WHERE id = ?");
        $stmt->bind_param("i", $insertedId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        
        if (!$data) {
            throw new Exception('Could not retrieve the inserted record from database');
        }
        
        return $data;
    }
}
