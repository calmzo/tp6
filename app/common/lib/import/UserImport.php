<?php
/**
 * UserImport.php
 * User chenzhuo
 * Date 2020/8/31 1:36 下午
 * Description :
 */
declare(strict_types=1);

namespace app\common\lib\import;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserImport implements ImportBulk{

    public $option;
    public function __construct()
    {

        $this->option['ext'] = ['xls','xlsx'];
    }


    public function upload($file)
    {
        $ext = $file->getOriginalExtension();
        if(!in_array( $ext, $this->option['ext'])){
            return error('请上传xls或者xlsx格式');
        }
        $savename = \think\facade\Filesystem::disk('public')->putFile( 'file', $file);
        $path = public_path().'storage/'.$savename;

        if($ext=="xlsx"){
            $reader = IOFactory::createReader('Xlsx');
        }else{
            $reader = IOFactory::createReader('Xls');
        }
        $excel = $reader->load($path,$encode = 'utf-8');
        $sheet = $excel->getSheet(0)->toArray();

        //读取第一张表
        //获取总行数
        array_shift($sheet);  //删除第一个数组(标题);
        $data = [];
        $i = 0;
        foreach ($sheet as $k => $v) {
            if(is_numeric($v[1])){
                $v[1] = (int)$v[1];
            }
            $data[$k]['username'] = $v[0];
            $data[$k]['password'] = password_hash($v[1],PASSWORD_BCRYPT);
            $data[$k]['num_coin'] = $v[2];
            $data[$k]['draws'] = $v[3];
            $i++;
        }
        $result = $this->model->saveAll($data);
        if($result) return success('导入成功');
        return false;
    }



}