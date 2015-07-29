<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

namespace Goteo\Controller {

    use Goteo\Core\DB,
        Goteo\Core\Model,
        Goteo\Model\User,
        Goteo\Model\Project;

    class SFDC extends \Goteo\Core\Controller
    {
        // -------------------------------------------------------------------
        // CSVデータ出力(array to csv)
        // -------------------------------------------------------------------
        private function arr2csv($fields) {
            $fp = fopen('php://temp', 'r+b');
            foreach($fields as $i => $field) {
                if ($i === 0){
                    fputcsv($fp, $field);
                } else {
                    self::mb_fputcsv($fp, $field,',','"',true);
                }
            }
            rewind($fp);
            $tmp = str_replace(PHP_EOL, "\r\n", stream_get_contents($fp));
            return mb_convert_encoding($tmp, 'UTF-8', 'auto');
        }

        /*
         * 配列の値をCSV形式にフォーマットする
         * ****************************************40
         * fputcsv()の改良版。
         * 基本的な動作はPHP関数のfputcsv()と同じ。
         *
         * 相違点：
         *   数値型文字型を考慮せず全てのフィールドに対し""(ダブルクォート)で括るという点。
         *   Shift-JISではなくUTF-8にしか対応していない点。
         *
         * 注意点：
         *   第5引数をtrueにすると「\"」(バックスラッシュ ダブルクォート)という方言エスケープのかかった文字列に対しても、RFC4180に準拠したエスケープ処理を行う。
         *   PHPのfgetcsv()、str_getcsv()とRFC4180はエスケープの解釈がそれぞれ異なるため、これを行ったCSVファイルにはこれらのPHP関数は利用できなくなる。
         *   ただし一般的にCSVファイルを取り扱うことの多いEcxelの動作はRFC4180のものである。
         *
         * @param resource $fp=null
         * @param array $fields=null
         * @param string $delimiter=',' // 将来的な予約
         * @param string $enclosure='"' // 将来的な予約
         * @param boolean $rfc=false
         * @return int // 書き込んだ文字列の長さ。失敗したらFALSE
         */
        private function mb_fputcsv($fp=null, $fields=null, $delimiter=',', $enclosure='"', $rfc=false) {
            $str=null;
            $chk=true;

            if($chk) {
                $cnt=0;
                $last=count($fields);
                foreach($fields as $val) {
                    $cnt++;
                    if(!$rfc) {  // fputcsv()の挙動
                        $val = preg_replace('/(?<!\\\\)\"/u', '""', $val);
                    }else {      // RFC4180に準拠
                        $val = preg_replace('/\"/u', '""', $val);
                    }// end if
                    $str.= '"'. $val. '"';
                    if($cnt!=$last) $str.= ',';
                }// end foreach
            }// end if
            if($chk) $chk = fwrite($fp, $str);
            if($chk) $chk = fwrite($fp, "\n");
            return $chk;
        }

        public function output_csv($assoc_data, $csv_header, $_csv_header,$filename = "data.csv"){
            $invest_stat_str = array(
                -1 => "処理未完了", 0 => "決済待ち（予約中）", 1 => "決済完了", 2 => "キャンセル", 3 => "支払われたプロジェクト", 4 => "プロジェクト不成立（未決済）"
            );
            $pj_stat_str = array(
                -1 => "レビュー申請中", 0 => "キャンセル済", 1 => "編集中", 2 => "レビュー中", 3 => "掲載中", 4 => "金額達成", 5 => "お礼実施", 6 => "完了"
            );
            $pj_area_str = array(
                "yokohama" => "横浜", "kitaq" => "北九州", "fukuoka" => "福岡"
            );

            $_csv[] = $_csv_header;

            foreach($assoc_data as $assoc_row){
                $_assoc_row = array();
                $_tmprow = "";
                foreach($csv_header as $orig_key => $csv_hdr){
                    if ($csv_hdr == "donation_status"){
                        if (is_numeric($assoc_row[$orig_key])){
                            $_tmprow = $invest_stat_str[intval($assoc_row[$orig_key])];
                        }
                    } elseif ($csv_hdr == "project_status"){
                        if (is_numeric($assoc_row[$orig_key])){
                            $_tmprow = $pj_stat_str[intval($assoc_row[$orig_key])];
                        }
                    } elseif ($csv_hdr == "del_flg"){
                        if ($assoc_row['id'] !== "root"){
                            $_tmprow = ($assoc_row[$orig_key] == 1) ? "TRUE" : "FALSE";
                        } else {
                            $_tmprow = "FALSE";
                        }
                    } elseif (
                        ($csv_hdr == "start_date") || ($csv_hdr == "1st_end_date") || ($csv_hdr == "2nd_start_date") || ($csv_hdr == "end_date") || ($csv_hdr == "donation_date")
                    ){
                        if (!is_null($assoc_row[$orig_key])){
                            $_tmprow = $assoc_row[$orig_key] . "T09:00:00.00Z";
                        } else {
                            $_tmprow = "";
                        }
                    } elseif ($csv_hdr == "input_type"){
                        $_tmprow = "Goteo";
                    } elseif ($csv_hdr == "project_area"){
                        if (array_key_exists(LG_PLACE_NAME,$pj_area_str)){
                            $_tmprow = $pj_area_str[LG_PLACE_NAME];
                        }
                    } elseif ($csv_hdr == "target_price") {
                        if (intval($assoc_row[$orig_key]) > 0) {
                            $_tmprow = intval($assoc_row[$orig_key]) + intval($assoc_row['cost_req']);
                        }
                    } elseif($csv_hdr == "user_area"){
                        $_area = trim($assoc_row[$orig_key]);
                        $_area = mb_ereg_replace("yokohama", "横浜", $_area);
                        $_area = mb_ereg_replace("kitaq", "北九州", $_area);
                        $_area = mb_ereg_replace("fukuoka", "福岡", $_area);
                        $_tmprow = $_area;
                    } elseif ($csv_hdr == "user_area_yokohama" ) {
                        $hasstr = strpos($assoc_row["lg_user_area"],'yokohama');
                        $_tmprow = ($hasstr !== false) ? "TRUE" : "FALSE";
                    } elseif ($csv_hdr == "user_area_kitaq" ) {
                        $hasstr = strpos($assoc_row["lg_user_area"],'kitaq');
                        $_tmprow = ($hasstr !== false) ? "TRUE" : "FALSE";
                    } elseif ($csv_hdr == "user_area_fukuoka" ) {
                        $hasstr = strpos($assoc_row["lg_user_area"], 'fukuoka');
                        $_tmprow = ($hasstr !== false) ? "TRUE" : "FALSE";
                    } elseif ($csv_hdr == "projectupdate_flg" || $csv_hdr == "returnmail_flg" || $csv_hdr == "projectblog_flg" || $csv_hdr == "newsletter_flg") {
                        if (!is_null($assoc_row[$orig_key])) {
                            $_tmprow = ($assoc_row[$orig_key] == "1") ? "TRUE" : "FALSE";
                        } else {
                            $_tmprow = "";
                        }
                    } elseif ($csv_hdr == "zip_code"){
                        // 数字（とダブルクォーテーション）以外は落とす
                        $_tmprow = mb_ereg_replace("[^0-9\"\r\n]","",mb_convert_kana($assoc_row[$orig_key], "ns", "utf-8"));
                    } else {
                        $_tmprow = $assoc_row[$orig_key];
                    }
                    // 禁則文字を含むデータは空白に
                    if (strpos($_tmprow,'"') !== false){
                        $_tmprow = "";
                    }
                    $_assoc_row[] = $_tmprow;
                }
                $_csv[] = $_assoc_row;
            }

            $csv = self::arr2csv($_csv);
//            $fp = fopen(SFDC_EXPORT_FILE_PATH . "/$filename", "ab");
            $fp = fopen(SFDC_EXPORT_FILE_PATH . "/$filename", "wb");
            $written = fwrite($fp, $csv);
            fclose($fp);

            return $written;
        }

        public function get_project_master(){
            $query = "SELECT `project`.id, `project`.name, GROUP_CONCAT(DISTINCT `category`.description SEPARATOR ';'),
                          `project`.owner, GROUP_CONCAT(DISTINCT `skill`.name SEPARATOR ';'),
                          `project`.published, `project`.passed, `project`.success, `project`.closed, `project`.status,
                          pjcost1.cost_req, pjcost2.cost_noreq
                        FROM `project` LEFT JOIN ( `project_category` INNER JOIN `category` ON `project_category`.category = `category`.id  ) ON `project`.id = `project_category`.project
                          LEFT JOIN (`project_skill` INNER JOIN `skill` ON `project_skill`.skill = `skill`.id ) ON `project`.id = `project_skill`.project
                          INNER JOIN (SELECT project, SUM(amount) AS cost_req FROM `cost` WHERE required = 1 GROUP BY project) AS pjcost1 ON pjcost1.project = `project`.id
                          LEFT JOIN (SELECT project, SUM(amount) AS cost_noreq FROM `cost` WHERE required = 0 GROUP BY project) AS pjcost2 ON pjcost2.project = `project`.id
                        WHERE
                          `project`.published IS NOT NULL AND `project`.name != '' AND `project`.id != '' AND
                          `project`.status NOT IN (-1,1,2)
                        GROUP BY `project`.id";
//                           `project`.published IS NOT NULL AND `project`.status > 2
            $res = \Goteo\Core\Model::query($query);
            $assoc_data = $res->fetchAll(\PDO::FETCH_ASSOC);

            $csv_header = array(
                "id" => "project_id",
                "name" => "project_name",
                "GROUP_CONCAT(DISTINCT `category`.description SEPARATOR ';')" => "project_category",
                "project_area" => "project_area",
                "owner" => "project_owner_userID",
                "GROUP_CONCAT(DISTINCT `skill`.name SEPARATOR ';')" => "skill_category",
                "published" => "start_date",
                "passed" => "1st_end_date",
                "success" => "2nd_start_date",
                "closed" => "end_date",
                "status" => "project_status",
                "cost_req" => "least_price",
                "cost_noreq" => "target_price",
                "del_flg" => "del_flg"
            );
            $_csv_header = array(
                "project_id","project_name","project_category","project_area","project_owner_userID","skill_category","start_date","1st_end_date","2nd_start_date","end_date","project_status","least_price","target_price","del_flg"
            );

            return self::output_csv($assoc_data, $csv_header, $_csv_header, LG_PLACE_NAME . '_' . SFDC_EXPORT_FILE_NAME_PROJ);
        }

        public function get_donate_info(){
            $query = "SELECT DISTINCT invest.id, invest.user, invest_address.name, invest.project, invest.method,
                          reward.description, invest_address.zipcode,invest_address.address,
                          user.email, invest.invested, invest.amount, invest.status
                        FROM invest LEFT JOIN invest_address ON invest.id = invest_address.invest
                          LEFT JOIN (invest_reward INNER JOIN reward ON invest_reward.reward = reward.id ) ON invest.id = invest_reward.invest
                          LEFT JOIN user ON invest.user = user.id
                        WHERE invest.status <> -1 AND method <> 'paypal' AND invest.id != '' AND invest.user != '' AND invest.project != ''";
            $res = \Goteo\Core\Model::query($query);
            $assoc_data = $res->fetchAll(\PDO::FETCH_ASSOC);

            $csv_header = array(
                "id" => "donation_id",
                "user" => "customer_id",
                "name" => "real_name",
                "project" => "project_id",
                "method" => "support_category",
                "description" => "return",
                "zipcode" => "zip_code",
                "address" => "address",
                "email" => "mail",
                "invested" => "donation_date",
                "amount" => "price",
                "status" => "donation_status",
                "del_flg" => "del_flg"
            );
            $_csv_header = array(
                "donation_id","customer_id","real_name","project_id","support_category","return","zip_code","address","mail","donation_date","price","donation_status","del_flg"
            );

            return self::output_csv($assoc_data, $csv_header, $_csv_header, LG_PLACE_NAME . '_' . SFDC_EXPORT_FILE_NAME_DONA);
        }

        public function get_user_info(){

            $query = "SELECT DISTINCT user.id, user.name, user_personal.contract_name,
                            user_personal.zipcode, user_personal.address, user_personal.phone, user.email,
                            GROUP_CONCAT(DISTINCT category.description separator ';'),
                            GROUP_CONCAT(DISTINCT skill.name separator ';'),
                            GROUP_CONCAT(DISTINCT user_login_log.node separator ';') AS lg_user_area,
                            user_prefer.updates,
                            user_prefer.threads,
                            user_prefer.rounds,
                            user_prefer.mailing,
                            user.confirmed,
                            user.hide
                        FROM user INNER JOIN user_personal ON user.id = user_personal.user
                        LEFT JOIN ( user_interest INNER JOIN category ON user_interest.interest = category.id ) ON user.id = user_interest.user
                        LEFT JOIN ( user_skill INNER JOIN skill ON user_skill.skill = skill.id ) ON user.id = user_skill.user
                        INNER JOIN user_login_log ON user.id = user_login_log.user
                        LEFT JOIN user_prefer ON user.id = user_prefer.user
                        WHERE user.id != '' AND user.name != '' AND user_personal.contract_name != ''
                        GROUP BY user.id
                        HAVING lg_user_area != ''
                        ";

            $res = \Goteo\Core\Model::query($query);
            $assoc_data = $res->fetchAll(\PDO::FETCH_ASSOC);

            $csv_header = array(
                "id" => "customer_id",
                "name" => "user_name",
                "contract_name" => "user_realname",
                "input_type" => "input_type",
                "zipcode" => "zip_code",
                "address" => "address",
                "phone" => "tel",
                "email" => "mail",
                "GROUP_CONCAT(DISTINCT category.description separator ';')" =>"project_category",
                "GROUP_CONCAT(DISTINCT skill.name separator ';')" => "skill_category",
                "lg_user_area" => "user_area",
//                "GROUP_CONCAT(DISTINCT `gt_lg-common`.user_login_log.node separator ';')" => "user_area",
                "updates" => "projectupdate_flg",
                "threads" => "returnmail_flg",
                "rounds" => "projectblog_flg",
                "mailing" => "newsletter_flg",
                "hide" => "del_flg",
                "user_area_yokohama" => "user_area_yokohama",
                "user_area_fukuoka" => "user_area_fukuoka",
                "user_area_kitaq" => "user_area_kitaq"
            );
            $_csv_header = array(
                'customer_id','user_name','user_realname','input_type','zip_code','address','tel','mail','project_category','skill_category','user_area','projectupdate_flg','returnmail_flg','projectblog_flg','newsletter_flg','del_flg',
                'user_area_yokohama','user_area_fukuoka','user_area_kitaq'
            );

            return self::output_csv($assoc_data, $csv_header, $_csv_header, SFDC_EXPORT_FILE_NAME_USER);
        }

    }
}

