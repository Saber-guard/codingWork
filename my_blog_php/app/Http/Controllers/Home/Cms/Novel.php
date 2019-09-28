<?php
namespace App\Http\Controllers\Home\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Novel as N;
use App\Models\NovelClick;

class Novel extends Controller
{
	//获取小说列表
	public function novelListGet(Request $request,N $novel)
    {
        $result = $novel->get();
        return $this->returnInfo($result->toArray());
    }

    //增加小说
    public function novelPost(Request $request,N $novel)
    {
        $param = $this->param;

		//构建数据库数据
		$data = [];

		$data['n_id'] = $param['n_id'];
		$data['n_channel'] = $param['n_channel'];
		$data['n_identify'] = $param['n_identify'];
		$data['n_name'] = $param['n_name'];
		$data['n_datetime'] = date('Y-m-d H:i:s');

		//新增数据
		$id = $novel->insertGetId($data);
		//返回
		$result = $id?['n_id'=>$id]:[];
		$errno = $id?0:2;
		$info = $id?'添加成功':'添加失败';
		return $this->returnInfo($result,$errno,$info);
    }

    //删除小说
    public function novelDelete(Request $request,N $novel)
    {
        $param = $this->param;
        
        $result = $novel->destroy($param['n_id']);
        $errno = $result?0:2;
		$info = $result?'删除成功':'删除失败';
        return $this->returnInfo($result,$errno,$info);
    }

    //抓取当前的所有小说点击量并返回
    public function novelClicksNowGet(Request $request,NovelClick $novel_click,N $novel)
    {
        set_time_limit(60);
        $novel_list = $novel->get();
        $novel_clicks_now = array();
        foreach ($novel_list as $n) {
            //抓取
            $click_time = self::crawlNovelClick($n);
            $novel_clicks_now[] = array(
                'name'=>$n->n_name,
                'identify'=>$n->n_identify,
                'channel'=>$n->n_channel,
                'click_time'=>$click_time,
            );

        }

        return $this->returnInfo($novel_clicks_now,0);
    }

    //返回所有的小说点击量历史记录
    public function novelClicksHistoryGet(Request $request,NovelClick $novel_click)
    {

        $result = $novel_click->orderBy('nc_date','desc')->get();
        return $this->returnInfo($result->toArray());
    }

    //=============================================================================

    //抓取指定小说当前点击量
    static public function crawlNovelClick($novel)
    {
        $click_time = 0;
        //分渠道
        //1.懒人听书
        if ($novel->n_channel == 1) {
            $url = 'https://www.lrts.me/book/'.$novel->n_identify;
            $try = 0;
            while ($try<3) {
                $crawl_info = file_get_contents($url);
                $reg = '/<span><em>\s+(\S+)\s+<\/em>播放<\/span>/';
                $reg_res = preg_match($reg,$crawl_info,$match);
                if (isset($match[1]) && !empty($match[1])) {
                    $click_time = $match[1];
                    break;
                }
            }
    
        } elseif ($novel->n_channel == 2) {

        }

        return $click_time;
    }
}