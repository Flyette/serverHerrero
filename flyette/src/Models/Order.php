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
		$baskets = $this->db->where('archive', 0)->find_many();
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

	public function desarchiv(){
		$t = $this->db->find_one($_POST['id']);
		$t->archive = 0;
		$t->save();
	}

	public function archiv(){

		$t = $this->db->find_one($_POST['id']);
		$t->archive = 1;
		$t->save();
	}

	public function archived() {
		$baskets = $this->db->where('archive',1)->find_many();
		foreach ($baskets as $key => $value) {
			$baskets[$key]->basket = json_decode($value->basket, true);
		}
		return $baskets;	
	}

		public function deleteOrder(){
		$t = $this->db->find_one($_POST['id']);
		$t->delete();
	}

}

