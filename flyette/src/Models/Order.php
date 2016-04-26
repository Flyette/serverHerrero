<?php 

namespace Flyette\Models;
use ORM;
use Carbon\Carbon;

class Order extends Model {

	public function imageList($list){
		$out = [];
		foreach($list as $key=>$value) {
			$out[] = $list;

		}
	}

	public function all(){
		$baskets = $this->db->find_many();
		foreach ($baskets as $key => $value) {
			$baskets[$key]->basket = json_decode($value->basket, true);
		}
		return $baskets;
	}

	public function get($id){
		$basket = $this->db->find_one($id);
			$basket->basket = json_decode($basket->basket, true);
		return $basket;

	}

	public static function frenchDate($date){
		$dt = new Carbon($date);
		return $date = $dt->formatLocalized('%A %d %h %Y, à %k:%M');
	}

		public function desarchive(){
		$u = new Order;
		$user = $u->get($_GET['id']);
		$user->archive = 0;
		$user->save();
	}

		public function archive(){
		$u = new Order;
		$user = $u->get($_GET['id']);
		$user->archive = 1;
		$user->save();
	}

		public static function url($page, $id=false, $action=false){
		//http://senny.dev/?page=users-show&id=1&action=archive
		$page = str_replace("/", "-", $page);
		$domain = config()['url'];
		$url = $domain . "page=" . $page;
		if($id){
			$url .= "&id=" . $id;
		}
		if($action) {
			$url .= "&action=" . $action;
		}
		return $url;
	}

}

