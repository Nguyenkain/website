<?php /* @var $this Controller */ ?>

<script type="text/javascript">
$(document).ready(function() {
	$('#footer_content).hide();
	$('#footer').addClass('normal');
});

</script>

<?php $this->beginContent('//layouts/main'); ?>
		<div id="page">
			<?php echo $content?>
		</div>
		
		<div id="footer" class="normal">
			<div id="copyright">
				<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam'
					khi bạn phát hành lại thông tin từ Website này</p>
			</div>
		</div>
<?php $this->endContent(); ?>