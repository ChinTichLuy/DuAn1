<?php
namespace App\Commons;
use eftec\bladeone\BladeOne;
use Rakit\Validation\Validator;

abstract class Controller{

    protected $validator;

    public function __construct(){
        $this->validator = new Validator;
        $this->setMessagesValidate();
    }

    public function renderView($view,$data,$type): void{
        $tempPath = __DIR__ ."/../Views/{$type}";
        $cache = __DIR__ ."/../Views/Compiles";
        $blade = new BladeOne($tempPath,$cache);
        echo $blade->run($view,$data);
    }

    public function viewAdmin($view,$data = []){
        return $this-> renderView($view,$data,'Admin');
    }
    public function viewClient($view,$data = []){
        return $this-> renderView($view,$data,'Client');

    }

    public function setMessagesValidate(){
        $this->validator->setMessages([
			'email:email' => 'Email không đúng định dạng 🤬',
			'digits' => 'Phải là số và 10 kí tự 🤬',
			// set riêng các trường
			'username:required' => 'Vui lòng nhập username 🤬',
			'email:required' => 'Vui lòng nhập email 🤬',
			'password:required' => 'Vui lòng nhập password 🤬',
			'phone:required' => 'Vui lòng nhập phone 🤬',
			'image:required' => 'Vui lòng tải image 🤬',
			'password:min' => 'Password tối thiểu 5 kí tự',
			'image:uploaded_file' => 'File gì lớn thế - Tối đa 500K',
			'password:alpha_num' => 'Password chỉ nhận số và chữ thường🤬',
			'address:required' => 'Vui long nhap address 🤬',
			// posts
			'title:required' => 'Vui lòng nhập title 🤬',
			'content:required' => 'Vui lòng nhập content 🤬',
			// 'phone:digits' => 'Phone Phải là số và 10 kí tự 🤬'
			// categories
			'name:required' => 'Vui long nhap name category 🤬',

            'product.name:required' => 'Trường name bắt buộc nhập',
            'product.name:max' => 'Nhập quá giới hạn quy định',
            'product.thumb_image:uploaded_file' => 'Quá khích thước, không đúng định dạng',
            'product.price_regular:required' => 'Trường giá gốc bắt buộc phải nhập',
            'product.price_regular:numeric' => 'Trường giá gốc bắt buộc phải là số',
            'product.price_sale:numeric' => 'Trường giá giảm giá gốc bắt buộc phải là số',
            'product.sku:required' => 'Trường sku bắt buộc phải nhập',
            'product.category_id:required' => 'Trường category bắt buộc phải nhập',
		]);
    }
}