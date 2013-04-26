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
		$url = Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/animal/" . $img . "s.jpg";
		if(checkUrl($url))
			return $url;
		else
			return Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/animal/" . $img . ".jpg";
	}
	if($loai==2)
	{
		$url = Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/plant/" . $img . "s.jpg";
		if(checkUrl($url))
			return $url;
		else
			return Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/plant/" . $img . ".jpg";
	}
	if($loai==3)
	{
		$url = Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/insect/" . $img . "s.jpg";
		if(checkUrl($url))
			return $url;
		else
			return Yii::app()->request->getBaseUrl(true) . "/../web/images/pictures/insect/" . $img . ".jpg";
	}
}

function getImage($loai, $img) {
	$html = CHtml::image(getImageUrl($loai, $img),'',$htmlOptions=array(
						
							'style'=>'margin-right:10px;height:90px'
							));
	for($i = 1; $i <= 3; $i ++) {
		$url = getImageUrl($loai, $img."_".$i);
		if(checkUrl($url))
			$html .= CHtml::image($url,'',$htmlOptions=array(
						'style'=>'margin-right:10px;height:90px'
							));;
	}
	return $html;
}

?>

<h3>Thông tin của <?php echo $model->Viet; ?></h3>

<?php 
$position='';
$numItems = count($coordinations);
$i = 0;
foreach ($coordinations as $place){
	$st = $place->province_name;
	$position = $position .$st;
	if(++$i != $numItems) {
		$position = $position .', ';
	}
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
					.getImage($model->Loai, $model->Img)
							

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
