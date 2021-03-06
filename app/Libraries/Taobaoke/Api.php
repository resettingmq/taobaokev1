<?php
namespace App\Libraries\Taobaoke;

use App\Libraries\Taobaoke\top\TopClient;

/**
* 这是淘宝客对接的api
*/
class Api
{
	public static function api() {
		/**
		 * TOP SDK 入口文件
		 * 请不要修改这个文件，除非你知道怎样修改以及怎样恢复
		 * @author xuteng.xt
		 */

		/**
		 * 定义常量开始
		 * 在include("TopSdk.php")之前定义这些常量，不要直接修改本文件，以利于升级覆盖
		 */
		/**
		 * SDK工作目录
		 * 存放日志，TOP缓存数据
		 */
		if (!defined("TOP_SDK_WORK_DIR"))
		{
			define("TOP_SDK_WORK_DIR", "/tmp/");
		}

		/**
		 * 是否处于开发模式
		 * 在你自己电脑上开发程序的时候千万不要设为false，以免缓存造成你的代码修改了不生效
		 * 部署到生产环境正式运营后，如果性能压力大，可以把此常量设定为false，能提高运行速度（对应的代价就是你下次升级程序时要清一下缓存）
		 */
		if (!defined("TOP_SDK_DEV_MODE"))
		{
			define("TOP_SDK_DEV_MODE", true);
		}

		if (!defined("TOP_AUTOLOADER_PATH"))
		{
			define("TOP_AUTOLOADER_PATH", dirname(__FILE__));
		}

		/**
		* 注册autoLoader,此注册autoLoader只加载top文件
		* 不要删除，除非你自己加载文件。
		**/
		spl_autoload_register('self::autoload');

		date_default_timezone_set('Asia/Shanghai'); 

		$taobao = new TopClient;
	    // $taobao->appkey = getenv('TAOBAOKE_APPKEY');
	    // $taobao->secretKey = getenv('TAOBAOKE_SECRETKEY');
        $taobao->appkey = config('taobao.appkey');
        $taobao->secretKey = config('taobao.secretKey');

	    return $taobao;
	}

    /**
     * 类库自动加载，写死路径，确保不加载其他文件。
     * @param string $class 对象类名
     * @return void
     */
    public static function autoload($class) {
        $name = $class;
        if(false !== strpos($name,'\\')){
          $name = strstr($class, '\\', true);
        }
        
        $filename = TOP_AUTOLOADER_PATH."/top/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/top/request/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/top/domain/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/aliyun/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/aliyun/request/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/aliyun/domain/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }      

        $filename = TOP_AUTOLOADER_PATH."/dingtalk/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }
        $filename = TOP_AUTOLOADER_PATH."/dingtalk/request/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }

        $filename = TOP_AUTOLOADER_PATH."/dingtalk/domain/".$name.".php";
        if(is_file($filename)) {
            include $filename;
            return;
        }         
    }
}