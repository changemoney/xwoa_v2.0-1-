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
				<h1>添加</h1>
			</div>
			<div class="pull-right">
				<a onclick="save();" class="btn btn-sm btn-primary">确定</a>
				<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
			</div>
		</div>
		<div class="popup-body" style="height: 420px;overflow-y: auto;">
			<form id="form_data" name="form_data" method="post" class="form-horizontal">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="pid" id="pid" value="0">
				<input type="hidden" name="ajax" id="ajax" value="0">
				<input type="hidden" name="opmode" id="opmode" value="add">
				<input type="hidden" name="controller" id="controller" value="<?php echo ($controller); ?>">
				<select name="tag_list" id="tag_list" class="hidden">
					<?php echo fill_option($tag_list);?>
				</select>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="name">名称：</label>
					<div class="col-xs-9">
						<input type="text" id="name" name="name" check="require" msg="请输入名称" class="form-control">
					</div>
				</div>
				<?php if($has_pid): ?><div class="form-group">
						<label class="col-xs-3 control-label" for="tag_name">父节点*：</label>
						<div class="col-xs-9">
							<div class="input-group">
								<input name="tag_name" class="form-control val" id="tag_name" type="text" msg="请选择父节点" check="require" />
								<span class="input-group-btn">
									<button class="btn btn-sm btn-primary" onclick="select_pid()" type="button">
										选择
									</button> </span>
							</div>
						</div>
					</div><?php endif; ?>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="sort">排序：</label>
					<div class="col-xs-9">
						<input type="text" id="sort" name="sort" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="is_del">状态：</label>
					<div class="col-xs-9">
						<select   name="is_del" id="is_del" class="form-control col-10">
							<option  value="0">启用</option>
							<option value="1">禁用</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label" for="remark">备注：</label>
					<div class="col-xs-9">
						<textarea id="remark" name="remark" class="col-xs-12 form-control"></textarea>
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
		function add() {
			//3.14 自定义文件夹添加修改---------------------------------------------------------------
			//$("#opmode").val("add");
			//$("#id").val("");
			//sendForm("form_data", "", "/index.php?m=&c=SystemTag&a=add&controller=FlowType");
			var vars=$("#form_data").serialize();
			sendAjax("<?php echo U('add');?>",vars,function(data){
				if(data.status){
					ui_alert("新增成功",function() {
						location.href="<?php echo U('index');?>";
						}
						);
				}else{
					ui_error("新增失败");
				}		
			})
			//----------------------------------------------------------------------------------
		};

		function del() {
			ui_confirm('相应的子目录也会自动删除,真的要删除吗?', function() {
				$("#opmode").val("del");
				sendForm("form_data", "", "/index.php?m=&c=SystemTag&a=add&controller=FlowType");
			});
		}

		function save() {
			if (check_form("form_data")) {
				var vars = $("#form_data").serialize();
				sendAjax("<?php echo U('SystemTag/save');?>", vars, function(data) {
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
		};

		function showdata(result) {
			for (var s in result.data) {
				set_val(s, result.data[s]);
			}
			if ($("#pid").val() == 0) {
				$("#tag_name").val("根节点");
			} else {
				$("#tag_name").val($("#tag_list option[value='" + $("#pid").val() + "']").text());
			}
			$("#opmode").val("edit");
		}

		function select_pid() {
			winopen("<?php echo U('system_tag/winpop?controller='.CONTROLLER_NAME);?>", 560, 470);
		}


		$(document).ready(function() {
			$(".sub_left_menu .tree_menu  a").click(function() {
				$(".sub_left_menu .tree_menu  a").removeClass("active");
				$(this).addClass("active");
				sendAjax("<?php echo U('system_tag/read');?>", "id=" + $(this).attr("node"), function(data) {
					showdata(data);
				});
				return false;
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