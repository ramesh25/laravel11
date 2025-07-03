<?php
class BredcrumpHelper
{		
	private static $result=null;
	public static $level=0;
	
	public static function admin($table, $id, $uri)
	{				
		$model=DB::table($table)->where('id', $id)->take(1)->first(array('id', 'parent_id', 'title'));
		if(!empty($model))
		{
			if (self::$level == 0) {
			    self::$result .= '@@@rraySeper#ator@@@' . '<li>' . $model->title;
			} else {
			    self::$result .= '@@@rraySeper#ator@@@' . '<li><a href="' . url($uri.'/'.$model->id) . '">' . $model->title . '</a></li>';
			}

			BredcrumpHelper::admin($table, $model->parent_id, $uri);			
		}
		self::$result = explode('@@@rraySeper#ator@@@', self::$result);
		self::$result = array_reverse(self::$result);
		self::$result = implode("", self::$result);
		return self::$result;			
	}

	public static function front($table, $id, $uri)
	{
		$model=DB::table($table)->where('id', $id)->take(1)->first(array('id', 'slug', 'parent_id', 'title'));
		if(!empty($model))
		{
			if (self::$level == 0) {
			    self::$result .= '@@@rraySeper#ator@@@' . '<li>' . $model->title;
			} else {
			    self::$result .= '@@@rraySeper#ator@@@' . '<li><a href="' . url($uri.'/'.$model->slug) . '">' . $model->title . '</a></li>';
			}
			BredcrumpHelper::front($table, $model->parent_id, $uri);
		}
		self::$result = explode('@@@rraySeper#ator@@@', self::$result);
		self::$result = array_reverse(self::$result);
		self::$result = implode("", self::$result);
		return self::$result;
	}

}

