<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'post',
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
			<?php	echo $form->dropDownList($model,'Nhom',$listNhom, array(
						'empty'=>'--Chọn lớp muốn tìm--',
						'id' => 'filter_lop', 'class' => 'filter_ddl',
		                                		'ajax' => array(
					 	'type' => 'POST',
						'dataType' => 'json',
						'data' => array('ID' => 'js:$(this).val()'),
		
						'url' => CController::createUrl('creatures/dynamicnhom'),
						'success' => 'function(data){
						$("#filter_bo").html(data.dropdownBo);
						$("#filter_ho").html(data.dropdownHo);
}')));
		?>
	</div>
	<div class="filter_item">
		<label for="filter_bo" class="filter_label"> Tra cứu theo Bộ</label>
			<?php 	echo $form->dropDownList($model,'Bo',$listBo, array(
						'empty'=>'--Chọn bộ muốn tìm--',
						'id' => 'filter_bo', 'class' => 'filter_ddl',
		                                		'ajax' => array(
					 	'type' => 'POST',
						'dataType' => 'json',
						'data' => array('ID' => 'js:$(this).val()'),
		
						'url' => CController::createUrl('creatures/dynamicbo'),
						'success' => 'function(data){
						$("#filter_ho").html(data.dropdownHo);
}')));
		?>
	</div>
	<div class="filter_item">
		<label for="filter_ho" class="filter_label"> Tra cứu Họ</label>
		<?php echo $form->dropDownList($model,'Ho',$listHo, array(
				'empty'=>'--Chọn họ muốn tìm--',
				'id' => 'filter_ho', 'class' => 'filter_ddl') );
		?>
	</div>
	<div id="kingdom_choose">
		<?php echo $form->radioButtonList($model,'Loai',CHtml::listData(Loai::model()->findAll(),'ID','Loai'),
				array('onclick' => CHtml::ajax(array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamicloai'),
				'success' => 'function(data){		
				$("#filter_lop").html(data.dropdownNhom);
				$("#filter_bo").html(data.dropdownBo);
				$("#filter_ho").html(data.dropdownHo);

}'))));?>
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