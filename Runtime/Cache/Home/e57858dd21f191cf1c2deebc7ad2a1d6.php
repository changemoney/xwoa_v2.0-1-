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
			
	<?php echo W('PageHeader/simple',array('name'=>'修改密码','search'=>'N'));?>
	<form id="form_password" method="post" action="" class="well form-horizontal">
		<input type="hidden" name="ajax" id="ajax" value="1">
		<input type="hidden" name="user_id" id="user_id" value="<?php echo ($id); ?>">
		<div class="form-group">
			<label class="col-xs-2 control-label" >新密码：</label>
			<div class="col-xs-10">
				<input type="password" name="password" id="password" value=""  class="form-control col-20">
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-2 control-label" >确认密码：</label>
			<div class="col-xs-10">
				<input type="password" name="confirm_password" id="confirm_password" value=""  class="form-control col-20"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-2 control-label" ></label>
			<div class="col-xs-10">
				<p class="form-control-static">
					<span id="msg" ></span>
				</p>
			</div>
		</div>
		<div class="form-group">
			<div class="action  col-xs-10 col-xs-offset-2">
				<input class="btn btn-sm btn-primary" type="button" value="保存" onclick="save();">
				<input  class="btn btn-sm " type="button" value="取消" onclick="myclose();">
			</div>
		</div>
	</form>

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
		function check_password(s) {
			if (s.length < 4) {
				return 0;
			}
			var ls = 0;
			if (s.match(/[a-z]/ig)) {
				ls++;
			}
			if (s.match(/[0-9]/ig)) {
				ls++;
			}
			if (s.match(/(.[^a-z0-9])/ig)) {
				ls++;
			}
			if (s.length < 6 && ls > 0) {
				ls--;
			}
			return ls;
		}

		function save() {
			var msg = "";
			var vars = $("#form_password").serialize();
			new_pwd = $("#password").val();
			confirm_pwd = $("#confirm_password").val();
			if (new_pwd == confirm_pwd) {
				sendAjax("<?php echo U('reset_pwd');?>", vars, function(data) {
					ui_info(data.info);
					setTimeout("myclose()", 200);
				});
			} else {
				ui_error("密码不一致");
			}
		}

		$(document).ready(function() {
			$("#password").keydown(function() {
				s = $(this).val();
				t = check_password(s);
				if (t == 0) {
					$("#msg").html("密码过短");
					$("#msg").css("color", "red");
				}
				if (t == 1) {
					$("#msg").html("密码强度差");
					$("#msg").css("color", "red");
				}
				if (t == 2) {
					$("#msg").html("密码强度良好");
					$("#msg").css("color", "blue");
				}
				if (t == 3) {
					$("#msg").html("密码强度高");
					$("#msg").css("color", "blue");
				}
			});
			$("#confirm_password").keyup(function() {
				new_pwd = $("#password").val();
				confirm_pwd = $(this).val();
				if (new_pwd != confirm_pwd) {
					$("#msg").html("密码不一致");
					$("#msg").css("color", "red");
				} else {
					$("#msg").html("密码一致");
					$("#msg").css("color", "blue");
				}
			});
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