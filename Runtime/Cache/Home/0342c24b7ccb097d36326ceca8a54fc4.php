<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ((isset($title) && ($title !== ""))?($title):get_system_config("system_name")); ?></title>
		<link href="/Public/Ins/css/bootstrap.min.css" rel="stylesheet">
		<link href="/Public/Ins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="/Public/Ins/css/animate.css" rel="stylesheet">
		<link href="/Public/Ins/css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<link href="/Public/Ins/css/plugins/gritter/jquery.gritter.css" />
		<?php if(!empty($plugin["jquery-ui"])): ?><link rel="stylesheet" href="/Public/Ins/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" />
	<link rel="stylesheet" href="/Public/Ins/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet"><?php endif; ?>
<?php if(!empty($plugin["date"])): ?><link rel="stylesheet" href="/Public/Ins/css/plugins/date-time/bootstrap-datetimepicker.css" /><?php endif; ?>

<?php if(!empty($plugin["calendar"])): ?><link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
	<link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'><?php endif; ?>


		<link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" />
		<link href="/Public/Ins/css/style.css" rel="stylesheet">
		<link href="/Public/Ins/css/xiaowei.css" rel="stylesheet">
		
	</head>
	<script type="text/javascript">
	var upload_url = "<?php echo U('upload');?>";
	var del_url = "<?php echo U('del_file');?>";
	var app_path = "";
	var cookie_prefix = "<?php echo C('COOKIE_PREFIX');?>";
	var link_select = "<?php echo U('Popup/link_select');?>";
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?2a935166b0c9b73fef3c8bae58b95fe4";
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hm, s);
	})(); 
</script>
	<body class="<?php echo (CONTROLLER_NAME); ?>">
		<div class="shade"></div>
		<div class="form-group hidden" id="img_upload_container">
			<div id="img_upload">上传</div>
		</div>
		<nav class="navbar navbar-default row" role="navigation" id="top_menu">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-6">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-lg"></i>
				</button>
				<div class="hidden-xs">
					&nbsp;
				</div>
				<a href="<?php echo U('index/index');?>" class="navbar-brand"><?php echo get_system_config("system_name");?></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-6">
				<ul class="nav navbar-nav navbar-right">
					<?php if(is_array($top_menu)): foreach($top_menu as $key=>$top_menu_vo): ?><a class="nav-app" href="#" url="<?php echo (get_nav_url($top_menu_vo['url'])); ?>" node="<?php echo ($top_menu_vo["id"]); ?>" onclick="click_top_menu(this)" ><i class="<?php echo ($top_menu_vo["icon"]); ?>"></i><?php echo ($top_menu_vo["name"]); ?>
						<?php if(!empty($badge_count[$top_menu_vo['id']])){ $html=''; $html='<span class="label label-danger">'.$badge_count[$top_menu_vo['id']].'</span>'; echo $html; } ?></a><?php endforeach; endif; ?>
					<a class="nav-app btn-danger" href="<?php echo U('public/logout');?>"><i class="fa fa-sign-out"></i>退出</a>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
		<div id="wrapper">
			<div class="sidebar navbar-static-side" id="sidebar">
				<div id="user_info" class="text-center hidden-xs"  >
					<span >当前用户：<?php echo (session('user_name')); ?></span>
				</div>
				<div id="nav_head" class="text-center" onclick="toggle_left_menu()">
					<span class="menu-text"><?php echo ($top_menu_name); ?></span>
					<b id="left_menu_icon" class="fa fa-angle-down pull-right"></b>
				</div>
				<?php echo W('Sidebar/left',array('tree'=>$left_menu,'badge_count'=>$badge_count));?>
			</div>
			<div id="page-wrapper" class="gray-bg">
				<div class="row wrapper border-bottom gray-bg">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="fa fa-home home-icon"></i>
								<a href="/">Home</a>
							</li>
							<li>
								<?php echo ($top_menu_name); ?>
							</li>
						</ul><!-- .breadcrumb -->
					</div>
				</div>
				<div class="wrapper wrapper-content">
					
	<?php echo W('PageHeader/simple',array('name'=>'新建收入','search'=>'N'));?>
	<form method='post' id="form_data" name="form_data" enctype="multipart/form-data"   class="well form-horizontal">
		<input type="hidden" id="ajax" name="ajax" value="0">
		<input type="hidden" id="account_name" name="account_name" value="">
		<input type="hidden" id="doc_type" name="doc_type" value="1">
		<input type="hidden" id="opmode" name="opmode" value="add">
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="doc_no">单据编号：</label>
			<div class="col-sm-8">
				<p class="form-control-static">
					YYYY-####
				</p>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="end_date" >日期：</label>
			<div class="col-sm-8">
				<input  class="form-control input-date" type="text" id="input_date" name="input_date"    check="require" msg="请输入日期" readonly="readonly">
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="partner">客户名称：</label>
			<div class="col-sm-8">
				<select id="partner" name="partner" class="form-control" check="require" msg="请选择客户">
					<option value="" >请选择客户</option>
					<?php echo fill_option($customer_list);?>
					<?php echo fill_option($supplier_list);?>
					<option value="其他" >其他</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" >收入项目：</label>
			<div class="col-sm-8">
				<select id="type" name="type" class="form-control" check="require" msg="请选择收收入项目">
					<option value="" >请选择收入项目</option>
					<?php echo fill_option(get_system_config('finance_income_type'));?>
					<option value="其他" >其他</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="account_id">收款帐号：</label>
			<div class="col-sm-8">
				<select id="account_id" name="account_id" class="form-control" check="require" msg="请选择收款帐号">
					<option value="" >请选择收款帐号</option>
					<?php echo fill_option($account_list);?>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" >账户余额：</label>
			<div class="col-sm-8">
				<input class="form-control" id="balance" type="text" readonly="readonly" >
			</div>
		</div>

		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="income">金额：</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="income" check="require" msg="请输入金额">
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label class="col-sm-4 control-label" for="actor_name">经办人：</label>
			<div class="col-sm-8">
				<input class="form-control" type="text" name="actor_name" check="require" msg="请输入经办人">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="remark">摘要：</label>
			<div class="col-sm-10">
				<textarea name="remark" rows="4" style="width: 100%;" check="require" msg="请输入摘要" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="name">附件：</label>
			<div class="col-sm-10">
				<?php echo W('FileUpload/add');?>
			</div>
		</div>
		<div class="form-group">
			<div class="form-actions col-sm-10 col-sm-offset-2">
				<input class="btn btn-sm btn-primary" type="button" value="保存" onclick="save();">
				<input class="btn btn-sm btn-default" type="button" value="取消" onclick="go_return_url();">
			</div>
		</div>
	</form>

				</div>
			</div>
		</div>
		<iframe src="<?php echo U('push/client');?>" class="push" id="push"></iframe>
		<script src="/Public/Ins/js/jquery-2.1.1.js"></script>
		<script src="/Public/Ins/js/bootstrap.min.js"></script>
		<script src="/Public/Ins/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="/Public/Ins/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="/Public/Ins/js/bootstrap-suggest.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="/Public/Ins/js/inspinia.js"></script>
		<script src="/Public/Ins/js/common.js"></script>
		<script src="/Public/Ins/js/plugins/pace/pace.min.js"></script>
		<?php if(!empty($plugin["jquery-ui"])): ?><script src="/Public/Ins/js/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="/Public/Ins/js/plugins/nouslider/jquery.nouislider.min.js"></script><?php endif; ?>
<?php if(!empty($plugin["date"])): ?><script src="/Public/Ins/js/plugins/date-time/moment-with-locales.js"></script>
	<script src="/Public/Ins/js/plugins/date-time/bootstrap-datetimepicker.js"></script><?php endif; ?>

<?php if(!empty($plugin["uploader"])): ?><script type="text/javascript" src="/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script>
	<script type="text/javascript" src="/Public/Ins/js/plugins/plupload/plupload.setting.js"></script><?php endif; ?>

<?php if(!empty($plugin["editor"])): if(empty($plugin["uploader"])): ?><script type="text/javascript" src="/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script><?php endif; ?>
	<script type="text/javascript" src="/Public/Ins/js/plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="/Public/Ins/js/plugins/tinymce/tinymce.setting.js"></script><?php endif; ?>

<?php if(!empty($plugin["calendar"])): ?><script src="/Public/Ins/js/plugins/fullcalendar/moment.min.js"></script>
	<script src="/Public/Ins/js/plugins/fullcalendar/fullcalendar.min.js"></script><?php endif; ?>

<?php if(!empty($plugin["baidu_map"])): ?><script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=EE6745c36d96321e90b7015f3de4a4ee"></script><?php endif; ?>

<script src="/Public/Ins/js/plugins/toastr/toastr.min.js"></script>
<script src="/Public/Ins/js/plugins/gritter/jquery.gritter.min.js"></script>
<script src="/Public/Ins/js/plugins/bootbox/bootbox.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		<?php if(!empty($plugin["date"])): ?>$('.input-date').datetimepicker({
			format : 'YYYY-MM-DD',
			locale : 'zh-cn',
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});

		$(".input-daterange input").datetimepicker({
			format : "YYYY-MM-DD",
			locale : 'zh-cn',
			showTodayButton : true,
			showClose : true,
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});

		$("#start_date").on("dp.change", function(e) {
			if ($("#end_date").length > 0) {
				$('#end_date').data("DateTimePicker").minDate(e.date);
			}
		});

		$("#end_date").on("dp.change", function(e) {
			if ($("#start_date").length > 0) {
				$('#start_date').data("DateTimePicker").maxDate(e.date);
			}
		});

		$(".input-date-time").datetimepicker({
			format : 'YYYY-MM-DD HH:mm',
			locale : 'zh-cn',
			sideBySide : true,
			showTodayButton : true,
			showClose : true,
			ignoreReadonly : true,
			widgetPositioning : {
				horizontal : 'auto',
				vertical : 'bottom'
			},
		});<?php endif; ?>
	}); 
</script>
		
	<script>
		function save() {
			sendForm("form_data", "<?php echo U('save');?>");
		}

		$(document).ready(function() {
			$("#account_id").change(function() {
				$account_name = $('#account_id option:selected').text();
				$("#account_name").val($account_name);
				$.getJSON("<?php echo U('Finance/read_account');?>", {
					account_id : $(this).val()
				}, function(data) {
					if (data.status == 1) {
						$("#balance").val(data.data.balance);
					}
				});
			});
		});
	</script>


	</body>
</html>