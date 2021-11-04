<?php
namespace App\Http\Controllers\Home\Voice;

use App\Http\Controllers\Controller;
use IFlytek\Xfyun\Speech\TtsClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoiceController extends Controller
{
    const VOICE_DIR = '/mnt/voices';

    /**
     * 文字转语音
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function strToVoice(Request $request)
    {
        ini_set('max_execution_time', '0'); //防止 php 脚本超时

        $param = $this->param;
        $client = new TtsClient(
            env('XUNFEI_APPID'), env('XUNFEI_KEY'), env('XUNFEI_SECRET'),
            ['speed' => 75, 'vcn' => 'aisjinger']
        );
        $fileName = $param['file_name'] ?? md5($param['text']) . '.mp3';
        $fileDir = self::VOICE_DIR;
        $filePath = $fileDir . '/' . $fileName;
        // 目录不存在则创建
        if (!is_dir($fileDir)) {
            mkdir($fileDir, 0777, true);
        }

        // 文件存在则不用重复转
        if (!is_file($filePath)) {
            // 字符串截取为数组
            $text = preg_replace('/\s+/', ' ', $param['text']);
            $offset = 0;
            $limit = 3200;
            $arr = [];
            while ($offset <= mb_strlen($text)) {
                $arr[] = mb_substr($text, $offset, $limit);
                $offset += $limit;
            }

            // 转语音并写入文件
            file_put_contents($filePath, '');
            foreach ($arr as $item) {
                $content = $client->request($item)->getBody();
                file_put_contents($filePath, $content, FILE_APPEND);
            }
        }
        return $this->returnInfo(['file_name' => $fileName],0,'文字转语音成功');
    }
}

