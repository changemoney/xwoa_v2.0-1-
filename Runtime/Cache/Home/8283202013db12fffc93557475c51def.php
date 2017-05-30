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
			
	<div class="popup-fixed">
		<div class="popup-header clearfix">
			<div class="pull-left">
				<label>
					<input class="ace"  type="radio" id="rb_dept" name="type" value="dept" >
					<span class="lbl">部门</span> </label>
				<label>
					<input  class="ace"  type="radio" id="rb_position" name="type" value="position">
					<span class="lbl">职位</span> </label>
			</div>
			<div class="pull-right">
				<a onclick="save();" class="btn btn-sm btn-primary">确定</a>
				<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
			</div>
		</div>
		<div class="popup-body clearfix">
			<div class="col-23 pull-left">
				<b class="popup-label">地址簿</b>
				<div class="popup_tree_menu" >
					<div id="dept" class="hidden"  style="height:170px;">
						<?php echo ($list_dept); ?>
					</div>
					<div id="position" class="hidden" style="height:170px;">
						<?php echo ($list_position); ?>
					</div>
				</div>
				<b class="popup-label">&nbsp;</b>
				<div>
					<div id="addr_list" style="width:100%;height:170px;"></div>
				</div>
			</div>
			<div class="col-30 pull-left">
				<div class="col-7 pull-left text-center mid" style="margin-top: 24px;">
					<div style="height:132px;">
						<a onclick="add_address('rc');" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-right"></i></a>
						<a onclick="save();" class="hidden-lg btn btn-sm btn-primary">确定</a>
						<a onclick="myclose();" class="btn btn-sm btn-default">关闭</a>
					</div>
					<div style="height:132px;">
						<a onclick="add_address('cc');" class="btn btn-sm btn-primary"> <i class="fa fa-angle-double-right"></i></a>
					</div>
					<a onclick="add_address('bcc');" class="btn btn-sm btn-primary"> <i class="fa fa-angle-double-right"></i></a>
				</div>
				<div class="col-23 pull-left">
					<b class="popup-label">管理</b><span id="rc_count"></span>
					<div id="rc" class="selected" style="width:100%;height:107px;overflow:hidden">
						<ul></ul>
					</div>
					<b class="popup-label">写入\修改</b><span id="cc_count"></span>
					<div id="cc" class="selected" style="width:100%;height:107px;overflow:hidden">
						<ul></ul>
					</div>
					<b class="popup-label">读取</b><span id="bcc_count"></span>
					<div id="bcc" class="selected" style="width:100%;height:107px;overflow:hidden">
						<ul></ul>
					</div>
				</div>
			</div>
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
		function add_address(name) {
			$("input:checked[name='addr_id']").each(function() {
				$text = $(this).next().text().trim();
				$val = $(this).val();
				if ($("#" + name + ".selected li[data='" + $val + "']").length == 0) {
					$li = $('<li><span></span><a class="fa fa-times"></a></li>');
					$li.find('span').text($text);
					$li.attr('data', $val);
					$li.appendTo("#" + name + ".selected ul");
					recount();
				};
			});
			$("#addr_list input:checked").prop('checked', false);
		}


		$(document).on("click", ".selected a.fa-times", function() {
			$(this).parent().remove();
			recount();
		});

		// 双击添加到收件人 因后添加的数据 所以需要用live函数
		$(document).on("dblclick", "#addr_list label", function() {
			$text = $(this).text();
			$val = $(this).find("input").val();
			if ($("#rc.selected li[data='" + $val + "']").length == 0) {
				$li = $('<li><span></span><a class="fa fa-times"></a></li>');
				$li.find('span').text($text);
				$li.attr('data', $val);
				$li.appendTo("#rc.selected ul");
				recount();
			};
		});

		function recount() {
			$("#rc_count").text("(" + $("#rc.selected li").length + ")");
			$("#cc_count").text("(" + $("#cc.selected li").length + ")");
			$("#bcc_count").text("(" + $("#bcc.selected li").length + ")");
		}

		function save() {
			$("#rc.selected li").each(function(i) {
				emp_no = $(this).attr('data');
				name = jQuery.trim($(this).text());
				name = name.replace(/<.*>/, '');
				html = conv_inputbox_item(name, emp_no);
				$("#admin_list .address_list", parent.document).append(html);
			});

			$("#cc.selected li").each(function(i) {
				emp_no = $(this).attr('data');
				name = jQuery.trim($(this).text());
				name = name.replace(/<.*>/, '');
				html = conv_inputbox_item(name, emp_no);
				$("#write_list .address_list", parent.document).append(html);
			});

			$("#bcc.selected li").each(function(i) {
				emp_no = $(this).attr('data');
				name = jQuery.trim($(this).text());
				name = name.replace(/<.*>/, '');
				html = conv_inputbox_item(name, emp_no);
				$("#read_list .address_list", parent.document).append(html);
			});
			myclose();
		}

		function showdata(result) {
			$("#addr_list").html("");
			if ( type = $("input[name='type']:checked").val() == "dept") {
				var dept_id = "dept_" + $("#dept a.active").attr("node");
				var dept_name = $("#dept a.active span").text();
				var name = dept_name + "&lt;dept@group&gt;";
				var html_string = conv_address_item(name, dept_id);
				$("#addr_list").html(html_string);
			}
			for (s in result.data) {
				var id = result.data[s].id;
				var emp_no = result.data[s].emp_no;
				var position_name = result.data[s].position_name;
				var name = result.data[s].name;
				var name = name + "/" + position_name;
				var html_string = conv_address_item(name, emp_no);
				$("#addr_list").append(html_string);
			}
		}

		$(document).ready(function() {

			$("#rb_<?php echo ($type); ?>").prop('checked', true);
			// 选择用户默认选择的类型
			$("#<?php echo ($type); ?>").removeClass("hidden");

			$("input[name='type']").on('click', function() {
				$("input[name='type']").each(function() {
					$("#" + $(this).val()).addClass("hidden");
				});
				$("#" + $(this).val()).removeClass("hidden");
			});
			//点击节点时读取相应的数据
			$(".tree_menu  a").click(function() {
				$(".tree_menu a").removeClass("active");
				var type = $("input[name='type']:checked").val();
				$(this).addClass("active");
				sendAjax("<?php echo U('read');?>", "type=" + type + "&id=" + $(this).attr("node"), function(data) {
					showdata(data);
				});
				return false;
				//禁止连接生效
			});

		});
		//最终确认
		//-->
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