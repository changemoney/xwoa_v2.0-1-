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
	<input type="hidden" name="ajax" id="ajax" value="1">
	<div class="popup-fixed">
		<div class="popup-header clearfix">
			<div class="pull-left">
				<h1>添加</h1>
			</div>
			<div class="pull-right">
				<a onclick="save();" class="btn btn-sm btn-primary">确定</a>
				<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
			</div>
		</div>
		<div class="popup-body" style="height: 420px;overflow-y: auto;">
			<form method='post' id="form_data" class="form-horizontal">
				<input type="hidden" name="controller" id="controller" value="<?php echo ($controller); ?>">
				<input type="hidden" name="row_type" id="row_type" value="<?php echo ($row_type); ?>">

				<input type="hidden" id="opmode" name="opmode" value="add">
				<input type="hidden" name="ajax" id="ajax" value="1">

				<div class="form-group">
					<label class="col-xs-3 control-label" for="name">名称*：</label>
					<div class="col-xs-9">
						<input class="form-control" type="text" id="name" name="name" check="require" msg="请输入名称">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="type">控件类型*：</label>
					<div class="col-xs-9">
						<select name="type" id="type" check="require" msg="请选择控件类型" class="form-control col-12">
							<option value="">请选择</option>
							<option value="popup">弹窗选择</option>
							<option value="add_file">文件上传</option>
							<option value="text">单行文本</option>
							<option value="date">日期 </option>
							<option value="datetime">日期+时间 </option>
							<option value="select">列表</option>
							<option value="link_select">联动列表</option>
							<option value="radio">单选</option>
							<option value="checkbox">多选 </option>
							<option value="textarea">多行文本 </option>
							<option value="editor">编辑器</option>
							<option value="simple">简易编辑器</option>
							<option value="help">帮助 </option>
							<option value="hr">分隔符</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="layout">控件布局：</label>
					<div class="col-xs-9">
						<select name="layout" id="layout" check="require" msg="请选择控件布局" class="form-control col-12">
							<option value="">请选择 <option value="1">两列 <option value="2">整行 <option value="3">帮助 <option value="4">分隔符
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="data">控件数据：</label>
					<div class="col-xs-9">
						<input  class="form-control" type="text" id="data" name="data" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="config">设置：</label>
					<div class="col-xs-9">
						<input  class="form-control" type="text" id="config" name="config" >
					</div>
				</div>
				<div class="form-group =">
					<label class="col-xs-3 control-label" for="sort">排序：</label>
					<div class="col-xs-9">
						<input class="form-control" type="text" id="sort" name="sort" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="validate">验证：</label>
					<div class="col-xs-9">
						<select name="validate" id="validate" class="form-control col-12">
							<option value="">请选择 <option value="require">必选 <option value="email">邮件 <option value="number">数字
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="msg">错误提示：</label>
					<div class="col-xs-9">
						<input  class="form-control" type="text" id="msg" name="msg" >
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