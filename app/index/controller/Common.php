<?php
// +----------------------------------------------------------------------
// | 公共控制器
// +----------------------------------------------------------------------
namespace app\index\controller;

class Common
{
	public function index()
	{
		return "公共模块控制器";
	}

	// 单张上传文件
	public function upload()
	{
		$file = request()->file('filename');
		if (empty($file)) {
			return json([
				'code'	=> 0,
				'msg' 	=> '上传图片信息为空',
				'errmsg' => '接收不到filename信息'
			]);
		}
		$path = 'uploads' . DS . date('Ymd');
		$filename = time() . '.jpg';
		$info = $file->validate(['size' => 2*1024*1024, 'ext' => 'jpg,png,gif'])->move(ROOT_PATH . $path, $filename);
		if ($info === false) {
			return json([
				'code'	=> 0,
				'msg'	=> '上传图片上限为2MB,并且只能上传(jpg,png,gif)格式'
			]);
		}

		return json([
			'code'	=> 200,
			'msg'	=> '上传图片成功',
			'data'	=> [
				'filepath'	=> DS . $path . DS . $filename
			]
		]);
	}
}
