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
	<div class="popup-fixed">
		<div class="popup-header clearfix">
			<div class="pull-left">
				<h1>添加部门</h1>
			</div>
			<div class="pull-right">
				<a onclick="save();" class="btn btn-sm btn-primary">确定</a>
				<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
			</div>
		</div>
		<div class="popup-body" style="height: 420px;overflow-y: auto;">
			<form id="form_data" name="form_data" method="post" class="form-horizontal clearfix">
				<input type="hidden" name="opmode" id="opmode" value="add">
				<div class="form-group col-xs-12">
					<label class="col-xs-3 control-label" for="name">名称*：</label>
					<div class="col-xs-9">
						<input class="form-control" type="text" id="name" name="name" check="require" msg="请输入名称">
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-xs-3 control-label" for="short">简称*：</label>
					<div class="col-xs-9">
						<input class="form-control" type="text" id="short" name="short" check="require" msg="请输入简称">
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-xs-3 control-label" for="dept_name">上级部门*：</label>
					<div class="col-xs-9">
						<div class="input-group">
							<input name="dept_name" class="form-control" id="dept_name" type="text" readonly="readonly" msg="请选择上级部门" check="require"/>
							<input name="pid" id="pid" type="hidden" msg="请选择上级部门" check="require" />
							<span class="input-group-btn">
								<button class="btn btn-sm btn-primary" onclick="select_pid()" type="button">
									选择
								</button> </span>
						</div>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-xs-3 control-label" for="dept_grade_id">部门级别*：</label>
					<div class="col-xs-9">
						<select name="dept_grade_id" id="dept_grade_id" class="form-control" msg="请选择部门级别" check="require">
							<option>选择部门级别</option>
							<?php echo fill_option($dept_grade_list);?>
						</select>
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-xs-3 control-label" for="sort">排序：</label>
					<div class="col-xs-9">
						<input class="form-control" type="text" id="sort" name="sort" >
					</div>
				</div>
				<div class="form-group col-xs-12">
					<label class="col-xs-3 control-label" for="is_del">状态*：</label>
					<div class="col-xs-9">
						<select  name="is_del" id="is_del" class="form-control">
							<option  value="0">启用</option>
							<option value="1">禁用</option>
						</select>
					</div>
				</div>
			</form>
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

		function select_pid() {
			winopen("<?php echo U('winpop');?>", 560, 470);
		}

		$(document).ready(function() {
			$pid = $("#id", parent.document).val();
			$("#pid").val($pid);
		});
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