<?php
/*--------------------------------------------------------------------
 小微OA系统 - 让工作更轻松快乐

 Copyright (c) 2013 http://www.smeoa.com All rights reserved.

 Author:  jinzhu.yin<smeoa@qq.com>

 Support: https://git.oschina.net/smeoa/xiaowei
--------------------------------------------------------------*/

namespace Home\Controller;

class PaymentController extends HomeController {
    protected $config = array('app_type' => 'master');

	function index() {
	    $model = D('Payment');
		$where['is_del'] = 0;
		
		$list = $model -> where($where) -> order("create_time desc") -> select();
		
		if (!empty($model)) {
		    $this -> _list($model, $where, "create_time desc");
		}
		
		$this -> assign("list", $list);
		$this -> display();
	}
	
	public function import(){
	    $File = D('File');
	    $file_driver = C('DOWNLOAD_UPLOAD_DRIVER');
	    $info = $File -> upload($_FILES, C('DOWNLOAD_UPLOAD'), C('DOWNLOAD_UPLOAD_DRIVER'), C("UPLOAD_{$file_driver}_CONFIG"));
	}
	
	
	//生成费用Excel
	public function export() {
	    $id = I('user_id');
	    //Vendor('Excel.PHPExcel');
	    
		//导入thinkphp第三方类库
	    Vendor('Excel.PHPExcel');
		$objPHPExcel = new \PHPExcel();
		//读取一个excel表并写入数据
		$objPHPExcel -> getProperties() -> setCreator("市场部OA") -> setLastModifiedBy("市场部OA") -> setTitle("Office 2007 XLSX Test Document") -> setSubject("Office 2007 XLSX Test Document") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");
		// Add some data
		$i = 1;
		//dump($list);
		//编号，类型，标题，登录时间，部门，登录人，状态，审批，协商，传阅，审批情况，自定义字段
		$objPHPExcel -> setActiveSheetIndex(0) -> setCellValue("A$i", "币种") -> setCellValue("B$i", "类型") -> setCellValue("C$i", "产品") -> setCellValue("D$i", "交易额度") -> setCellValue("E$i", "第三方名") -> setCellValue("F$i", "第三方银行名") -> setCellValue("G$i", "第三方银行账户") -> setCellValue("H$i", "第三方银行地址") -> setCellValue("I$i", "第三方银行城市") -> setCellValue("J$i", "备注");

 		foreach ($id as $key=>$val) {
			    
 			    $where['id'] = array('eq', $id[$key]);
			    
 			    $user_id = M("Payment") -> where($where) -> getField('id');
 			    
 				$user_id = M("Payment") -> where($where) -> getField('user_id');
 				//编号
 				$group_id = M("Payment") -> where($where) -> getField('group_id');
// 				//标题
 				$pay_to = M("Payment") -> where($where) -> getField('pay_to');
// 				//收款人
 				$pay_account = M("Payment") -> where($where) -> getField('pay_account');
// 				//收款账号
				$pay_bank = M("Payment") -> where($where) -> getField('pay_bank');
// 				//付款银行
				$pay_bankaddress = M("Payment") -> where($where) -> getField('pay_bankaddress');
				//付款银行地址
				$pay_bankcity = M("Payment") -> where($where) -> getField('pay_bankcity');
				//付款银行城市
 				$pay_type = M("Payment") -> where($where) -> getField('pay_type');
// 				//付款类型
 				$product_name = M("Payment") -> where($where) -> getField('product_name');
				//交易额度
 				$pay_amount = M("Payment") -> where($where) -> getField('pay_amount');
 				//备注
 				$remark = M("Payment") -> where($where) -> getField('remark');
 				//
 				$time = M("Payment") -> where($where) -> getField('create_time');
// 				//产品编号
 				$create_time = to_date($time, 'Y-m-d H:i:s');
 				
 				$create_date = to_date($time, 'Y-m-d H-i-s');
// 				//付款时间
                $i++;
                
 				$objPHPExcel -> setActiveSheetIndex(0) -> setCellValue("A$i", "CNY") -> setCellValue("B$i", "广告费") -> setCellValue("C$i", $product_name) -> setCellValue("D$i", $pay_amount) -> setCellValue("E$i", $pay_to) -> setCellValue("F$i", $pay_bank) -> setCellValue("G$i",$pay_account) -> setCellValue("H$i", $pay_bankaddress) -> setCellValue("I$i", $pay_bankaddress) -> setCellValue("J$i", $remark);
 			}
 			//echo $create_time;
// 			// Rename worksheet
 			$objPHPExcel -> getActiveSheet() -> setTitle('费用申请');
// 			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
 			$objPHPExcel -> setActiveSheetIndex(0);
 			$file_name = "费用申请".$create_date.".xls";
// 			// Redirect output to a client’s web browser (Excel2007)
			header("Content-Type: application/force-download");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header("Content-Disposition:attachment;filename =" . str_ireplace('+', '%20', URLEncode($file_name)));
			header('Cache-Control: max-age=0');
			
 			$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//切换Excel2007
 			$objWriter -> save('php://output');
 			exit();	
	}
	
	public function field_manage($row_type) {
		$this -> assign("folder_name", "自定义字段管理");
		$this -> _field_manage($row_type);
	}
	
}
