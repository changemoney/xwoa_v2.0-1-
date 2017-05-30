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
			
	<?php echo W('PageHeader/popup',array('name'=>'上传头像','search'=>'N'));?>
	<div id="uploader">
		<input type="hidden" id="avatarUpload" value="" />
		<input type="hidden" id="img" name="img" />
		<input type="hidden" id="id" name="id" value="<?php echo ($id); ?>"/>
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
		<div class="ul_table hidden">
			<ul id="file_list">
				<li class="thead">
					<span class="del">删除</span>
					<span class="size">大小</span>
					<span class="auto autocut">文件名</span>
				</li>
				<?php if(!empty($file_list)): if(is_array($file_list)): $i = 0; $__LIST__ = $file_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><li class="tbody" id="<?php echo ($file["id"]); ?>" add_file="<?php echo ($file["id"]); ?>" size="<?php echo ($file["size"]); ?>" filename="<?php echo ($file["name"]); ?>">
							<div class="loading"></div>
							<div class="data">
								<span class="del text-center"> <a class="link del">删除</a> </span>
								<span class="size" ><?php echo (reunit($file["size"])); ?></span>
								<span class="auto autocut" title="<?php echo ($file["name"]); ?>"></span>
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</ul>
		</div>
		<div class="well clearfix">
			<div class="imgchoose col-xs-9">
				编辑头像：
				<br/>
				<img src="" id="target" style="max-width:440px;height:auto;"/>
			</div>
			<div class="col-xs-3" >				
				<div class="text-center">
					<a id="pickfiles" href="javascript:;" class="btn btn-sm btn-primary">上传头像</a>
				</div>
				<br>
				<div class="text-center hidden">
					当前头像：
					<br />
					<div><img class="current"  src="/<?php echo ($pic); ?>" />
					</div>
				</div>
				<div class="text-center">
					头像预览：
					<br />
					<div style="width:120px;height:120px;overflow:hidden;margin-left: auto;margin-right: auto;"><img class="preview" id="preview" src="" />
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
		
	<link rel="stylesheet" href="/Public/Ins/css/plugins/jcrop/jquery.Jcrop.css" type="text/css" />
	<script type="text/javascript" src="/Public/Ins/js/plugins/plupload/plupload.full.min.js"></script>
	<script type="text/javascript" src="/Public/Ins/js/plugins/jcrop/jquery.Jcrop.min.js"></script>
	<script>
	
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,html4',
		browse_button : 'pickfiles', // you can pass in id...
		container: document.getElementById('uploader'), // ... or DOM Element itself
		url : upload_url,
		flash_swf_url : "/Public/Ins/js/plugins/plupload/Moxie.swf",
		filters : {
			max_file_size : '10mb',
			mime_types: [{title : "Image files", extensions : "jpg,gif,png"},]
		},
		init: {		
			FilesAdded: function(up, files) {
				up.start();
			},
			FileUploaded: function(up,file,data) {
				var myObject = eval('(' + data.response + ')');
				if(myObject.status){
					$("#img").val(myObject.path);
					$("#target").attr("src",myObject.path);
					$(".preview").attr("src",myObject.path);
					$('#target').Jcrop({
						minSize : [60, 60],
						setSelect : [0, 0, 120, 120],
						onChange : updatePreview,
						onSelect : updatePreview,
						onSelect : updateCoords,
						aspectRatio : 1
					}, function(){					
						var bounds = this.getBounds();
						boundx = bounds[0];
						boundy = bounds[1];	
						jcrop_api = this;
					});
					$(".imgchoose").show(1000);
				}else{
					alert(myObject.info);
				}
			}
		}
	});

	uploader.init();

	//头像裁剪
	var jcrop_api, boundx, boundy;
	
	function updateCoords(c) {
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};
	
	function updatePreview(c) {
		if (parseInt(c.w) > 0){
			var rx = 120 / c.w;
			var ry = 120 / c.h;
			$('#preview').css({"width" : Math.round(rx * boundx) + 'px',"height" : Math.round(ry * boundy) + 'px',"marginLeft" : '-' + Math.round(rx * c.x) + 'px',"marginTop" : '-' + Math.round(ry * c.y) + 'px',});
		}
	};
	
	function checkCoords(){
		if(parseInt($('#w').val())){
			return true;	
		}else{
			alert('请选择图片上合适的区域');
			return false;	
		}
	};
	
	function save() {
		var img = $("#img").val();
		var x = $("#x").val();
		var y = $("#y").val();
		var w = $("#w").val();
		var h = $("#h").val();
		var id = $("#id").val();
		if (checkCoords()) {
			$.ajax({
				type : "POST",
				url : "<?php echo U('resize_img');?>",
				data : {
					"img" : img,
					"x" : x,
					"y" : y,
					"w" : w,
					"h" : h,
					"id" : id
				},
				dataType : "json",
				success : function(msg) {
					if (msg.result_code == 1) {
						$("#emp_pic", parent.document).attr("src", msg.result_des + '?t=' + Math.random());
						$("#pic", parent.document).val(msg.result_des);
					}
					myclose();
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