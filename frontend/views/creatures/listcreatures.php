<?php
Yii::app()->clientScript->registerScript('search', "
		$('.search_container form').submit(function(){
		$.fn.yiiGridView.update('creatures-grid', {
		data: $(this).serialize()
});
		return false;
});
		");

function checkUrl($url) {
	@$headers = get_headers($url);
	if (preg_match('/^HTTP\/\d\.\d\s+(200|301|302)/', $headers[0])){
		return true;
	}
	else return false;
}

 function getImageUrl($loai,$img){
	if($loai==1)
	{
		$url = Yii::app()->request->getBaseUrl(true) . "/images/pictures/animal/" . $img . "s.jpg";
		if(checkUrl($url))
			return $url;
		else 
			return Yii::app()->request->getBaseUrl(true) . "/images/pictures/animal/" . $img . ".jpg";
	}
	if($loai==2)
	{
		$url = Yii::app()->request->getBaseUrl(true) . "/images/pictures/plant/" . $img . "s.jpg";
		if(checkUrl($url))
			return $url;
		else
			return Yii::app()->request->getBaseUrl(true) . "/images/pictures/plant/" . $img . ".jpg"; 
	}
	if($loai==3)
	{
		$url = Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $img . "s.jpg";
		if(checkUrl($url))
			return $url;
		else 
			return Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $img . ".jpg";
	}
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
	
	<div id="list-creature">
	
	<?php 

	
	$this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'creatures-grid',
			'dataProvider'=>$dataProvider,
			'template'=>'{summary}{pager}{items}{pager}',
			'pagerCssClass'=>'pagination pagination-right',
			'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
			'beforeAjaxUpdate' => 'js:function(id,data){
				$("#list-creature").addClass("hasLoading");
			}',
						'afterAjaxUpdate' => 'js:function(id,options){
				$("#list-creature").removeClass("hasLoading");
			}',
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
</div>
<div id="footer" class="normal">

	<div class="footer-info">
		<?php $this->widget('ext.carouFredSel.ECarouFredSel', array(
				'id' => 'carousel',
				'target' => '#foo',
				'config' => array(
						'responsive' => true,
						'items' => 5,
						'scroll' => array(
								'items' => 3,
								'easing' => 'quadratic',
								'duration' => 2000,
								'pauseDuration' => 1500,
								'pauseOnHover' => true,
								'fx' => 'directscroll',
						),
						'sweep' => array(
								'items' => 3,
								'easing' => 'quadratic',
								'duration' => 2000,
								'pauseDuration' => 1500,
								'pauseOnHover' => true,
								'fx' => 'directscroll',
								'onMouse'=>true,
						),
				),
		));
		?>

		<h5>Sinh vật ngẫu nhiên</h5>
		<div id="foo">
			<?php 
			$criteria=new CDbCriteria;
			$criteria->order = 'rand()';
			$creature = Creatures::model()->findAll($criteria);
			for ($i = 0; $i<10 ; $i++) {
			$data = $creature[$i];
			?>
			<div class="item">

				<a
					href="<?php echo Yii::app()->createUrl("creatures/view",array("id" => $data->ID));?>">
					<img alt="Ảnh con vật"
					src="<?php echo getImageUrl($data->Loai,$data->Img)?>">
					<div class="slide">
					<h6>
						<?php echo $data->Viet?>
					</h6>
					</div>
				</a>

			</div>
			<?php }?>

		</div>
	</div>

	<div id="copyright">
		<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam'
			khi bạn phát hành lại thông tin từ Website này</p>
	</div>
</div>
