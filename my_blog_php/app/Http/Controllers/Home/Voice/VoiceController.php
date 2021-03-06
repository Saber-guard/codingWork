<?php
namespace App\Http\Controllers\Home\Voice;

use App\Http\Controllers\Controller;
use IFlytek\Xfyun\Speech\TtsClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoiceController extends Controller
{
    const VOICE_DIR = 'voices';

    /**
     * 文字转语音
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function strToVoice(Request $request)
    {
        $param = $this->param;
        $client = new TtsClient(
            env('XUNFEI_APPID'), env('XUNFEI_KEY'), env('XUNFEI_SECRET'),
            ['speed' => 75]
        );
        $fileName = md5($param['text']) . '.mp3';
        $fileDir = public_path() . '/' . self::VOICE_DIR;
        $filePath = $fileDir . '/' . $fileName;
        // 目录不存在则创建
        if (!is_dir($fileDir)) {
            mkdir($fileDir, 0777, true);
        }

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
        return $this->returnInfo(['file_name' => $fileName],0,'文字转语音成功');
    }
}
