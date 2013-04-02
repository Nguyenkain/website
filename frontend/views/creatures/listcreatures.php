<?php
Yii::app()->clientScript->registerScript('search', "
		$('.search_container form').submit(function(){
		$.fn.yiiGridView.update('creatures-grid', {
		data: $(this).serialize()
});
		return false;
});
		");

 function getImageUrl($loai,$img){
	if($loai==1)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/animal/" . $img . ".jpg";
	if($loai==2)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/plant/" . $img . ".jpg";
	if($loai==3)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $img . ".jpg";
}
?>
<div id="list-creature" class="page_content">
	<div class="search_container" >
		<?php $this->renderPartial('_search',array(
				'model'=>$search,
				'listNhom'=>$listNhom,
				'listBo' => $listBo,
				'listHo' => $listHo,
		));
		?>
	</div>
	<!-- search-form -->
	<?php 

	
	$this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'creatures-grid',
			'dataProvider'=>$dataProvider,
			'template'=>'{summary}{pager}{items}{pager}',
			'pagerCssClass'=>'pagination pagination-right',
			'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
			'emptyText' => 'Không có kết quả nào được tìm thấy',
			'columns'=>array(
				array(
					'class' => 'bootstrap.widgets.TbImageColumn',
					'header' => 'Ảnh',
					'imagePathExpression' => 'getImageUrl($data->Loai,$data->Img)',
						/* 'imagePathExpression' => 'Yii::app()->request->getBaseUrl(true) . "/images/pictures/" . $data->Img . ".jpg"', */
					'imageOptions'=>array('width'=>'90px'),
						
					
				),
				array(
					'name'=>'Viet',
					'header'=>'Tên Việt/Tên Latin',
					'value'=>'CHtml::link($data->Viet."/".$data->Latin,Yii::app()->createUrl("creatures/view", array("id"=>$data["ID"])))',
					'type'  => 'raw',
				),
				array(
					'name'=>'Nhom',
					'filter' => CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet'),
					 'value'=>'$data->rNhom',
					
					'htmlOptions'=> array(
							'width'=>'130px',
					)
				),
				array(
					'name'=>'Bo',
					'filter' => CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet'),
					'value'=>'$data->rBo',
					'htmlOptions'=>array(
						'width'=>'130px',
					)
				),
				array(
					'name' => 'Ho',
					'header'=>'Họ',
					'filter' => CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet'),
					'value'=>'$data->rHo',
					'htmlOptions'=>array(
						'width'=>'130px',
					)
				),
			),
)); ?>
</div>


<div id="footer" class="normal">
	<div id="copyright">
		<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam'
			khi bạn phát hành lại thông tin từ Website này</p>
	</div>
</div>
