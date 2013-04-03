<?php
$this->breadcrumbs=array(
		'Sinh vật'=>array('admin'),
		$model->Viet,
);

$this->menu=array(
		array('label'=>'List Creatures','url'=>array('index')),
		array('label'=>'Create Creatures','url'=>array('create')),
		array('label'=>'Update Creatures','url'=>array('update','id'=>$model->ID)),
		array('label'=>'Delete Creatures','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Creatures','url'=>array('admin')),
);
function getImageUrl($loai){
	if($loai==1)
		return Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/animal/";

	if($loai==2)
		return Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/plant/";
	if($loai==3)
		return Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/insect/";
}

?>

<h3>Thông tin của <?php echo $model->Viet; ?></h3>

<?php 
$position='';
foreach ($coordinations as $place){
	$st = $place->province_name;
	$position = $position .' ,' .$st;
};

$this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'Viet',
				'Latin',
				'rLoai',
				'rHo',
				'rBo',
				'rNhom',
				array(
						'label'=>'Mô tả',
						'type'=>'raw',
						'value'=>$model->Description,

				),
					array(
					
					'header' => 'Ảnh',
					'label'=>'Ảnh minh họa',
					'type'=>'raw',
					'value' => ''
					.CHtml::image(getImageUrl($model->Loai).$model->Img.".jpg",'',$htmlOptions=array(
						
							'style'=>'margin-right:10px;height:90px'
							))
					.CHtml::image(getImageUrl($model->Loai).$model->Img."_1".".jpg",'',$htmlOptions=array(
						'style'=>'margin-right:10px;height:90px'
							))	
					.CHtml::image(getImageUrl($model->Loai).$model->Img."_2".".jpg",'',$htmlOptions=array(
						'style'=>'margin-right:10px;height:90px'
							))
					.CHtml::image(getImageUrl($model->Loai).$model->Img."_3".".jpg",'',$htmlOptions=array(
						'style'=>'margin-right:10px;height:90px'
							))
							

,
						/* 'imagePathExpression' => 'Yii::app()->request->getBaseUrl(true) . "/images/pictures/" . $data->Img . ".jpg"', */
					'imageOptions'=>array('width'=>'90px'),
						
					
				),
				'rAuthor',
				
				array(
						'label'=>'Địa điểm phân bố',
						'value'=>$position,
				),
	),
));
  $this->widget('ext.FlexPictureSlider.FlexPictureSlider',
  array(
    'imageBlockSelector' => '#myslider', //the jquery selector
   
    
 
   )); ?>
