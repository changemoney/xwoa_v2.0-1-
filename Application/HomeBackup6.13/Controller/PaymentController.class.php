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
    
    function _search_filter(&$map) {
        $map['is_del'] = array('eq', '0');
        $keyword = I('keyword');
        if (!empty($keyword)) {
            $map['name'] = array('like', "%" . $keyword . "%");
        }
    }
    
	function index() {
	    
	    $model = M('Payment');
		$where['is_del'] = 0;
		
		$list = $model -> where($where) -> order("create_time desc") -> select();
 		if (!empty($model)) {
 		    $this -> folder($model);
 		}
	}
	
	function folder($model) {
	     
	    $plugin['date'] = true;
	    $this -> assign("plugin", $plugin);
	
	    $emp_no = get_emp_no();
	    $user_id = get_user_id();
	
	    $map = $this -> _search();
	    if (method_exists($this, '_search_filter')) {
	        $this -> _search_filter($map);
	    }
	     
	    //显示结果
	    $this -> _list($model, $map, 'create_time desc');
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
                
 				$objPHPExcel -> setActiveSheetIndex(0) -> setCellValue("A$i", "CNY") -> setCellValue("B$i", "广告费") -> setCellValue("C$i", $product_name) -> setCellValue("D$i", $pay_amount) -> setCellValue("E$i", $pay_to) -> setCellValue("F$i", $pay_bank) -> setCellValueExplicit("G$i",$pay_account,'s') -> setCellValue("H$i", $pay_bankaddress) -> setCellValue("I$i", $pay_bankaddress) -> setCellValue("J$i", $remark);
 			
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
	
	//生成外部费用Excel
	public function export_out() {
	    $id = I('user_id');
	    \Think\Log::write('--- PaymentController export_out 11111 ---','DEBUG');
	    //导入thinkphp第三方类库
	    Vendor('Excel.PHPExcel');
	    $objPHPExcel = new \PHPExcel();
	    //读取一个excel表并写入数据
	    $objPHPExcel -> getProperties() -> setCreator("市场部OA") -> setLastModifiedBy("市场部OA") -> setTitle("Office 2007 XLSX Test Document") -> setSubject("Office 2007 XLSX Test Document") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");
	    // Add some data
	    $i = 1;
	    //日期,申请人,支付额度,产品,模块,收款人,账号,支付方式,余额,备注
	    $objPHPExcel -> setActiveSheetIndex(0) -> setCellValue("A$i", "日期") -> setCellValue("B$i", "申请人") -> setCellValue("C$i", "支付额度") -> setCellValue("D$i", "产品") -> setCellValue("E$i", "模块") -> setCellValue("F$i", "收款人") -> setCellValue("G$i", "账号") -> 
	    setCellValue("H$i", "支付方式") -> setCellValue("I$i", "余额") -> setCellValue("J$i", "备注");
	
	    foreach ($id as $key=>$val) {

	 			    $where['id'] = array('eq', $id[$key]);
	 			    //费用ID
	 			    $user_id = M("Payment") -> where($where) -> getField('id');
	 			    //申请人ID
	 			    $user_id = M("Payment") -> where($where) -> getField('user_id');
	 			    //申请人
	 			    $user_name = M("Payment") -> where($where) -> getField('user_name');
	 			    //申请人部门ID
	 			    $group_id = M("Payment") -> where($where) -> getField('group_id');
	 			    //标题
	 			    $pay_to = M("Payment") -> where($where) -> getField('pay_to');
	 			    //收款人
	 			    $pay_account = M("Payment") -> where($where) -> getField('pay_account');
	 			    //收款账号
	 			    $pay_bank = M("Payment") -> where($where) -> getField('pay_bank');
	 			    //付款银行
	 			    $pay_bankaddress = M("Payment") -> where($where) -> getField('pay_bankaddress');
	 			    //付款银行地址
	 			    $pay_bankcity = M("Payment") -> where($where) -> getField('pay_bankcity');
	 			    //付款银行城市
	 			    $pay_type = M("Payment") -> where($where) -> getField('pay_type');
	 			    //产品名称
	 			    $product_name = M("Payment") -> where($where) -> getField('product_name');
	 			    //交易额度
	 			    $pay_amount = M("Payment") -> where($where) -> getField('pay_amount');
	 			    //手续费
	 			    $pay_fee = M("Payment") -> where($where) -> getField('pay_fee');
	 			    //备注
	 			    $remark = M("Payment") -> where($where) -> getField('remark');
	 			    //审批时间戳
	 			    $time = M("Payment") -> where($where) -> getField('create_time');
	 			    //审批时间 				
	 			    $create_time = to_date($time, 'Y-m-d H:i:s');
	 			    	
	 			    $create_date = to_date($time, 'Y/m/d');
	 			    
	 			    $excel_date =  to_date($time, 'Y-m-d H-i-s');
	 			    
	 			    $where['id'] = array('eq', $group_id);
	 			    $dept_name = M('Dept')  -> where($where) -> getField('name');
	 			  
	 			    $i++;
	 			    //日期,申请人,支付额度,产品,模块,收款人,账号,支付方式,余额,备注
	                $objPHPExcel -> setActiveSheetIndex(0) -> setCellValue("A$i", $create_date) -> setCellValue("B$i", $user_name) -> setCellValueExplicit("C$i", $pay_amount,'s') -> setCellValue("D$i", $product_name) -> setCellValue("E$i", $dept_name) -> setCellValue("F$i", $pay_to) -> setCellValueExplicit("G$i", $pay_amount,'s') -> 
	                setCellValue("H$i", $pay_bank) -> setCellValue("I$i", "") -> setCellValue("J$i", $remark);
	    }
	 			// Rename worksheet
	 			$objPHPExcel -> getActiveSheet() -> setTitle('外部支付');
	 			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	 			$objPHPExcel -> setActiveSheetIndex(0);
	 			$file_name = "外部费用".$excel_date.".xls";
	 			// Redirect output to a client’s web browser (Excel2007)
	 			header("Content-Type: application/force-download");
	 			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	 			header("Content-Disposition:attachment;filename =" . str_ireplace('+', '%20', URLEncode($file_name)));
	 			header('Cache-Control: max-age=0');
	
	 			$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//切换Excel2007
	 			$objWriter -> save('php://output');
	 			exit();
	}
	
	//生成费用Excel
	public function export_in() {
	    $id = I('user_id');
	    //导入thinkphp第三方类库
	    Vendor('Excel.PHPExcel');
	    $objPHPExcel = new \PHPExcel();
	    //读取一个excel表并写入数据
	    $objPHPExcel -> getProperties() -> setCreator("市场部OA") -> setLastModifiedBy("市场部OA") -> setTitle("Office 2007 XLSX Test Document") -> setSubject("Office 2007 XLSX Test Document") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");
	    // Add some data
	    $i = 1;
	    //日期,申请人,支付额度,手续费,产品,模块,账户名,支付前,支付后,收款人,账号,支付方式,备注
	    $objPHPExcel -> setActiveSheetIndex(0) -> setCellValue("A$i", "日期") -> setCellValue("B$i", "申请人") -> setCellValue("C$i", "支付额度") -> setCellValue("D$i", "手续费") -> setCellValue("E$i", "产品") -> setCellValue("F$i", "模块") -> setCellValue("G$i", "账户名") -> 
	    setCellValue("H$i", "支付前") -> setCellValue("I$i", "支付后") -> setCellValue("J$i", "收款人") -> setCellValue("K$i", "账号") -> setCellValue("L$i", "支付方式") -> setCellValue("M$i", "备注");
	
	    foreach ($id as $key=>$val) {

	 			    $where['id'] = array('eq', $id[$key]);
	 			    //费用ID
	 			    $user_id = M("Payment") -> where($where) -> getField('id');
	 			    //申请人ID
	 			    $user_id = M("Payment") -> where($where) -> getField('user_id');
	 			    //申请人
	 			    $user_name = M("Payment") -> where($where) -> getField('user_name');
	 			    //申请人部门ID
	 			    $group_id = M("Payment") -> where($where) -> getField('group_id');
	 			    //标题
	 			    $pay_to = M("Payment") -> where($where) -> getField('pay_to');
	 			    //收款人
	 			    $pay_account = M("Payment") -> where($where) -> getField('pay_account');
	 			    //收款账号
	 			    $pay_bank = M("Payment") -> where($where) -> getField('pay_bank');
	 			    //付款银行
	 			    $pay_bankaddress = M("Payment") -> where($where) -> getField('pay_bankaddress');
	 			    //付款银行地址
	 			    $pay_bankcity = M("Payment") -> where($where) -> getField('pay_bankcity');
	 			    //付款银行城市
	 			    $pay_type = M("Payment") -> where($where) -> getField('pay_type');
	 			    //产品名称
	 			    $product_name = M("Payment") -> where($where) -> getField('product_name');
	 			    //交易额度
	 			    $pay_amount = M("Payment") -> where($where) -> getField('pay_amount');
	 			    //手续费
	 			    $pay_fee = M("Payment") -> where($where) -> getField('pay_fee');
	 			    //备注
	 			    $remark = M("Payment") -> where($where) -> getField('remark');
	 			    //审批时间戳
	 			    $time = M("Payment") -> where($where) -> getField('create_time');
	 			    //审批时间 				
	 			    $create_time = to_date($time, 'Y-m-d H:i:s');
	 			    	
	 			    $create_date = to_date($time, 'Y/m/d');
	 			    
	 			    $excel_date =  to_date($time, 'Y-m-d H-i-s');
	 			    
	 			    $where['id'] = array('eq', $group_id);
	 			    $dept_name = M('Dept')  -> where($where) -> getField('name');
	 			  
	 			    $i++;
	 			    //日期,申请人,支付额度,手续费,产品,模块,账户名,支付前,支付后,收款人,账号,支付方式,备注
	 			    $objPHPExcel -> setActiveSheetIndex(0) -> setCellValue("A$i", $create_date) -> setCellValue("B$i", $user_name) -> setCellValueExplicit("C$i", $pay_amount,'s') -> setCellValue("D$i", $pay_fee) -> setCellValue("E$i", $product_name) -> setCellValue("F$i", $dept_name) -> setCellValue("G$i", "") -> 
	                setCellValue("H$i", "") -> setCellValue("I$i", "") -> setCellValue("J$i", $pay_to) -> setCellValue("K$i", $pay_account) -> setCellValue("L$i", "支付宝") -> setCellValue("M$i", $remark);
	    }
	 			// Rename worksheet
	 			$objPHPExcel -> getActiveSheet() -> setTitle('内部支付');
	 			// 			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	 			$objPHPExcel -> setActiveSheetIndex(0);
	 			$file_name = "内部费用".$excel_date.".xls";
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
