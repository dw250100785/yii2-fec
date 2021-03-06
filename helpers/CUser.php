<?php
namespace fec\helpers;
use Yii; 
class CUser
{
	# 1.检测用户是否登录
	public static function isLogin(){
		if($identity = Yii::$app->user->identity){
			return true;
		}
		return false;
	}
	
	# 2.得到当前的用户名
	public static function getCurrentUsername(){
		if($identity = Yii::$app->user->identity){
			if(isset($identity['username']) && !empty($identity['username'])){
				return $identity['username'];
			}
		}
		return '';
	}
	
	# 3.判断是否是超级用户，需要配置项：super_admin_user
	public static function isSuperUser($user = ''){
		$superUser = self::getSuperUserConfig();
		if(!$user){
			$user = self::getCurrentUsername();
		}
		if($user && in_array($user,$superUser)){
			return true;
		}
		return false;
	}
	
	# 4.得到用户的配置。
	public static function getSuperUserConfig(){
		$superUser = ['admin'];
		$configSuperUser = CConfig::param('super_admin_user');
		if(is_array($configSuperUser) && !empty($configSuperUser)){
			$superUser = array_merge($superUser,$configSuperUser);
			$superUser = array_unique($superUser);
		}
		return $superUser;
	}
	
	
	
	
}