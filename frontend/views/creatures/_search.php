<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>


<div class="seach_title">
	<h2>TRA CỨU SINH VẬT RỪNG VIỆT NAM</h2>
	<p>
		(Hơn 2000 loài thuộc các họ, bộ, nhóm khác nhau)<br /> Cập nhật
		20/05/2012
	</p>
</div>
<div class="hoz_line search"></div>
<div id="type_filter">
	<div class="filter_item">
		<label for="filter_lop" class="filter_label"> Tra cứu theo Lớp (nhóm)</label>
		<?php echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet' ), array(
				'empty'=>'--Chọn lớp muốn tìm--',
				'id' => 'filter_lop', 'class' => 'filter_ddl') );
		?>
	</div>
	<div class="filter_item">
		<label for="filter_bo" class="filter_label"> Tra cứu theo Bộ</label>
		<?php echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet' ), array(
				'empty'=>'--Chọn bộ muốn tìm--',
				'id' => 'filter_bo', 'class' => 'filter_ddl'));
		?>
	</div>
	<div class="filter_item">
		<label for="filter_ho" class="filter_label"> Tra cứu Họ</label>
		<?php echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' ), array(
				'empty'=>'--Chọn họ muốn tìm--',
				'id' => 'filter_ho', 'class' => 'filter_ddl') );
		?>
	</div>
	<div id="kingdom_choose">
		<?php echo $form->radioButtonList($model,'Loai',CHtml::listData(Loai::model()->findAll(),'ID','Loai'));?>
	</div>
</div>
<div id="search_text">
	<div id="search_input">
		<?php echo $form->textField($model,'Viet',array('placeholder' => 'Tìm Kiếm')); ?>
		<?php echo CHtml::submitButton('', array(
				'class' => 'search_btn',
		));
		?>
		
	</div>
	<div class="decoration">
		<label class="hint"> VD: Trăn gấm / Python reticulatus </label>
	</div>
</div>


<?php $this->endWidget(); ?>