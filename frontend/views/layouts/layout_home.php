<?php /* @var $this Controller */ ?>

<script type="text/javascript">
$(document).ready(function() {
	$('#footer_content').hide();
	$('#footer').addClass('normal');
});

</script>

<?php $this->beginContent('//layouts/main'); ?>
		<div id="page">
			<?php echo $content?>
		</div>
		
<?php $this->endContent(); ?>