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
		$basket = json_decode($basket, true);
		return $basket;

	}

	public static function frenchDate($date){
		$dt = new Carbon($date);
		return $date = $dt->formatLocalized('%A %d %h %Y, à %k:%M');
	}

	public function desarchive(){
		$o = new Order;
		$order = $o->get($_POST['id']);
		$order->archive = 0;
		$order->save();
	}

	public static function archive(){
		$o = new Order;
		$order = $o->get($_POST['id']);
		$order->archive = 1;
		$order->save();
	}

	public function archived() {
		return $this->db->where('archive',1)->find_many();
	}

	public static function url($page, $id=false, $action=false){
		
		$page = str_replace("/", "-", $page);
		$domain = 'index.php?/';

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

