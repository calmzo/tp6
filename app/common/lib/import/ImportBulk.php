<?php
/**
 * ImportBulk.php
 * User chenzhuo
 * Date 2020/8/31 1:33 下午
 * Description :
 */
declare(strict_types=1);
namespace app\common\lib\import;

interface ImportBulk
{

    //upload
    public function upload($file);

}