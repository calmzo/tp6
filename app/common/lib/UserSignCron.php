<?php
/**
 * UserSignCron.php
 * User chenzhuo
 * Date 2020/8/27 10:31 上午
 * Description :
 */

namespace app\common\lib;
class UserSignCron
{
    /**
     * 同步用户签到记录
     * @throws \Exception
     */
    public static function addUserSignLogToMysql()
    {
        $data = [];
        $time = Time();
        //1、计算上月的年份、月份
        $dataTime = Common::getMonthTimeByKey(0);
        $year = date('Y', $dataTime['start_time']);
        $month = date('m', $dataTime['start_time']);
        //2、查询签到记录的key
        $signModel = new Sign(0, $year, $month);
        $keys = $signModel->keys('sign_' . $year . '_' . $month . ':*');
        foreach ($keys as $key) {
            $bitLog = '';//用户当月签到记录
            $userData = explode(':', $key);
            $userId = $userData[1];
            //3、循环查询用户是否签到（这里没按每月天数存储，直接都存31天了）
            for ($i = 1; $i <= 31; $i++) {
                $isSign = $signModel->getBit($key, $i);
                $bitLog .= $isSign;
            }
            $data[] = [
                'user_id' => $userId,
                'year' => $year,
                'month' => $month,
                'bit_log' => $bitLog,
                'create_time' => $time,
                'update_time' => $time
            ];
        }
        //4、插入日志
        if ($data) {
            $logModel = new SignLog();
            $logModel->insertAll($data, '', 100);
        }
    }

}