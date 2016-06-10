<?php 

namespace Flyette\Models;
use ORM;
use Carbon\Carbon;
use Models\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

	public function deleteOrder($id){
		$t = $this->db->find_one($id);
		$t->delete();
	}

	public function deleteAll(){
		$baskets = $this->archived();
		foreach ($baskets as $basket) {
			$basket->delete();
		}
	}

	public function tri(Request $req){
		$users = $this->all();
		$query = $req->query->all();
		$tri = $req->query->get('tri');
		var_dump($tri);

		$direction = $req->query->get('direction');
		if(isset($tri) && isset($direction)){
			$users = $this->sort($users, $req->query->get('tri'), $req->query->get('direction'));
		} else {
			$users = $this->sort($users);
		}
		return $users;
	}

	public function sort($model, $tri = 'id', $direction = 'ASC'){
		if($tri != null && $direction == 'ASC'){
			return $model::order_by_asc($tri);
		} else {
			return $model::order_by_desc($tri);
		}
	}

}

