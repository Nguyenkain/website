<script type="text/javascript">
	function replaceImages() {
		$('#nationalParks_content img').each(function() {
			var link = $(this).attr('src');
			if(link.indexOf("forumpic") != -1 || link.indexOf("vqgpic") != -1) {
				link = "images/" + link;
			}
			$(this).attr('src',link);
		});
	}
</script>

<?php Yii::app()->clientScript->registerScript('replace', "replaceImages();");?>

<div id="nationalParks_content" class="page_content">

	<h3>
		<?php echo $model->park_name?>
	</h3>

	<div class='hoz_line long'></div>

	<?php echo $model->park_description?>

</div>
