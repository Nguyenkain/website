<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">

	<div class="span3">
		<div id="sidebar">
			<?php
			$this->widget('bootstrap.widgets.TbMenu', array(
					'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
					'stacked'=>true, // whether this is a stacked menu
					'items'=>$this->menu,
			));
			?>
		</div>
		<!-- sidebar -->
	</div>

	<div class="span9">
		<div id="content">
			<?php echo $content; ?>
		</div>
		<!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>