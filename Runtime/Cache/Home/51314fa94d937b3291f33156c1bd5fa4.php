<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ((isset($title) && ($title !== ""))?($title):get_system_config("system_name")); ?></title>
		<link href="/Public/Ins/css/bootstrap.min.css" rel="stylesheet">
		<link href="/Public/Ins/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="/Public/Ins/css/animate.css" rel="stylesheet">
		<link href="/Public/Ins/css/plugins/swiper/css/swiper.min.css" />
		<link href="/Public/Ins/css/plugins/toastr/toastr.min.css" rel="stylesheet">

		<?php if(!empty($plugin["jquery-ui"])): ?><link rel="stylesheet" href="/Public/Ins/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" />
	<link rel="stylesheet" href="/Public/Ins/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet"><?php endif; ?>
<?php if(!empty($plugin["date"])): ?><link rel="stylesheet" href="/Public/Ins/css/plugins/date-time/bootstrap-datetimepicker.css" /><?php endif; ?>

<?php if(!empty($plugin["calendar"])): ?><link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
	<link href="/Public/Ins/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'><?php endif; ?>

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

	<body class="popup">
		<div class="popup-container">
			
	<input type="hidden" name="ajax" id="ajax" value="1">
	<select name="dept_list" id="dept_list" class="hidden">
		<?php echo fill_option($dept_list);?>
	</select>
	<div class="popup-header clearfix">
		<div class="pull-left">
			<h1>添加员工</h1>
		</div>
		<div class="pull-right">
			<a onclick="save();" class="btn btn-sm btn-primary">确定</a>
			<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
		</div>
	</div>
	<div class="popup-body" style="height: 420px;overflow-y: auto;">
		<form id="form_data" name="form_data" method="post" class="form-horizontal">
			<input type="hidden" name="opmode" id="opmode" value="add">
			<table class="table table-bordered" >
				<tr>
					<th class="col-10">
					<nobr>
						员工编号*
					</nobr></th>
					<td class="col-20">
					<input class="form-control" type="text" id="emp_no" name="emp_no"  check="require" msg="请输入员工编号">
					</td>
					<th  class="col-5">姓名*</th>
					<td class="col-20">
					<input  class="form-control" type="text" id="name" name="name" class="input-sm" check="require" msg="请输入姓名">
					</td>

				</tr>
				
				<tr>
					<th>性别</th>
					<td >
					<select name="sex" id="sex" class="form-control col-10">
						<option  value="male">男</option>
						<option value="female">女</option>
					</select></td>
					<th>生日*</th>
					<td style="position: relative" >
					<input type="text" id="birthday" name="birthday" readonly="readonly" class="input-date form-control" readonly="readonly">
					</td>
				</tr>
				<tr>
					<th>部门*</th>
					<td class="col-20">
					<div class="input-group ">
						<input class="form-control" name="dept_name"  id="dept_name" type="text" msg="请选择部门" check="require" readonly="readonly" />
						<input name="dept_id" id="dept_id" type="hidden" msg="请选择部门" check="require" />
						<div class="input-group-btn">
							<a class="btn btn-sm btn-primary" onclick="select_dept();" > <i class="fa fa-search" ></i> </a>
						</div>
					</div></td>
					<th class="col-10">职位*</th>
					<td>
					<select name="position_id" id="position_id" class="form-control" msg="请选择职位" check="require">
						<option value="">选择职位</option>
						<?php echo fill_option($position_list);?>
					</select></td>
				</tr>
				<tr>
					<th>
					<nobr>
						办公室电话
					</nobr></th>
					<td>
					<input type="text" id="office_tel" name="office_tel" class="form-control">
					</td>
					<th>
					<nobr>
						移动电话
					</nobr></th>
					<td>
					<input type="text" id="mobile_tel" name="mobile_tel" class="form-control">
					</td>
				</tr>
				<tr>
				<tr>
					<th>电子邮箱</th>
					<td colspan="3">
					<input type="text" id="email" name="email" class="form-control">
					</td>
				</tr>
				<tr>
					<th>
					<nobr>
						负责业务
					</nobr></th>
					<td colspan="3">
					<input type="text" id="duty" name="duty" class="form-control">
					</td>
				</tr>
				<tr>
					<th>状态</th>
					<td colspan="3">
					<select class="form-control col-10"  name="is_del" id="is_del">
						<option  value="0">启用</option>
						<option value="1">禁用</option>
					</select></td>
					
				</tr>
			</table>
		</form>
		<b>带*的为必填选项</b>
	</div>
	</div>

		</div>
		<!-- Mainly scripts -->
		<script src="/Public/Ins/js/jquery-2.1.1.js"></script>
		<script src="/Public/Ins/js/bootstrap.min.js"></script>
		<script src="/Public/Ins/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="/Public/Ins/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Custom and plugin javascript -->
		<script src="/Public/Ins/js/inspinia.js"></script>
		<script src="/Public/Ins/js/common.js"></script>

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
		
	<script type="text/javascript">
		function select_dept() {
			winopen("<?php echo U('dept/winpop2');?>", 560, 470);
		}

		function save() {
			if (check_form("form_data")) {
				var vars = $("#form_data").serialize();
				sendAjax("<?php echo U('save');?>", vars, function(data) {
					if (data.status) {
						ui_alert(data.info, function() {
							parent.location.reload(true);
							myclose();
						});
					} else {
						ui_error(data.info);
					}
				});
			}
		}
	</script>

		<script>
			$(document).ready(function() {
				$(".popup-container").width($("#dialog", parent.document).width());
				if (is_mobile()) {
					$(".popup-container").height(window.screen.height - 40);
					$(".popup-container").css('overflow', 'auto');
				}
			});
		</script>
	</body>
</html>