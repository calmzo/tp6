<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 16:34
 */
namespace app\admin\controller;
class Image  extends AdminBase {
    public function upload() {
        if(!$this->request->isPost()) {
            return show(config("status.error"), "请求不合法");
        }
        $file = $this->request->file("file");
        // 注意事项
        // 1 、上传图片类型需要判断 png gif jpg  2、文件大小限制 600kb， 作业小伙伴自行完成
        //$filename = \think\facade\Filesystem::putFile('upload', $file);

        $filename = \think\facade\Filesystem::disk('public')->putFile("image", $file);
        if(!$filename) {
            return show(config("status.error"), "上传图片失败");
        }
        // 这个地方的路径一定要注意
        $imageUrl = [
            "image"  =>  "/upload/".$filename
        ];
        return show(config("status.success"), "图片上传成功", $imageUrl);

    }
    public function layUpload() {
        if(!$this->request->isPost()) {
            return show(config("status.error"), "请求不合法");
        }
        $file = $this->request->file("file");
        $filename = \think\facade\Filesystem::disk('public')->putFile("image", $file);
        if(!$filename) {
            return json(["code" => 1, "data" => []], 200);
        }

        $result = [
            "code" => 0,
            "data" => [
                "src" => "/upload/".$filename,
            ],
        ];
        return json($result, 200);


    }
}