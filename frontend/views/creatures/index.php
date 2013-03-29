
<div id="page_container">
	<div id="search_container">
		<div id="text_container">
			<h2>Tra cứu sinh vật rừng Việt Nam</h2>
			<p>
				(Hơn 2000 loài thuộc các họ, bộ, nhóm khác nhau)<br> Cập nhật
				20/05/2012
			</p>
		</div>
		<div id="hoz_line"></div>
		<div id="search_form">
			<?php $form=$this->beginWidget('CActiveForm',array(
					'id'=>'creatures-form',
					'enableAjaxValidation'=>false,
						)); ?>
			<div id="type_filter">

				<div class="filter_item">
					<label for="filter_lop" class="filter_label"> Tra cứu theo Lớp
						(nhóm)</label>
					<?php echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet' ), array(
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

}'))); ?>
				</div>
				<div class="filter_item">
					<label for="filter_bo" class="filter_label"> Tra cứu theo Bộ</label>
					<?php echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet' ), array(
							'empty'=>'--Chọn bộ muốn tìm--',
                                		'id' => 'filter_bo', 'class' => 'filter_ddl',
                                		'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamicbo'),
				'success' => 'function(data){
				$("#filter_ho").html(data.dropdownHo);

}'))); ?>
				</div>
				<div class="filter_item">
					<label for="filter_ho" class="filter_label"> Tra cứu theo Họ</label>
					<?php echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' ), array(
							'empty'=>'--Chọn họ muốn tìm--',
                                		'id' => 'filter_ho', 'class' => 'filter_ddl') ); ?>
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
                                		)); ?>
				</div>
				<div class="decoration">
					<label class="hint"> VD: Trăn gấm / Python reticulatus </label> <img
						alt="trang trí" src="css/images/deco.png" />
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<div id="image_container">
		<img alt="ảnh con chim" src="css/images/chim.png">
	</div>
	<div class="clearfix"></div>
</div>
<div id="footer">
	<div id="footer_content">
		<div id="intro">
			<h4>Giới thiệu</h4>
			<p>Website Sinh vật rừng Việt Nam là một nỗ lực của những con người
				đang mong muốn góp một phần nhỏ bé của mình vào việc bảo tồn thiên
				nhiên và nhằm đáp ứng yêu cầu khoa học phục vụ cho việc quản lý nhà
				nước về công tác nghiên cứu, bảo tồn thiên nhiên Việt Nam và công
				tác tra cứu, tìm hiểu các loài động, thực vật, côn trùng, các văn
				bản pháp quy liên quan đến việc quản lý, xây dựng và bảo vệ, phát
				triển rừng. Rất mong được sự đồng cảm của mọi người.</p>
		</div>
		<div id="news_container">
			<h4>Tin mới</h4>
			<div id="news_list">
			<?php
				$this->widget('zii.widgets.CListView',array(
					'dataProvider'=>$dataProviderNews,
					'itemView'=>'listnews',
					'summaryText'=>false,
					'emptyText'=>false
				));
			?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div id="copyright">
		<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam'
			khi bạn phát hành lại thông tin từ Website này</p>
	</div>
</div>
