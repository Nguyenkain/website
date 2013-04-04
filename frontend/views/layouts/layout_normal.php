<?php /* @var $this Controller */ ?>

<?php
function getImageUrl($loai,$img){
	if($loai==1)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/animal/" . $img . ".jpg";
	if($loai==2)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/plant/" . $img . ".jpg";
	if($loai==3)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $img . ".jpg";
}
?>

<?php $this->beginContent('//layouts/main'); ?>
<div id="page">
	<?php echo $content?>
</div>

<div id="footer" class="normal">
	<div class="footer-info">
		<?php $this->widget('ext.carouFredSel.ECarouFredSel', array(
				'id' => 'carousel',
				'target' => '#foo',
				'config' => array(
						'items' => 5,
						'scroll' => array(
								'items' => 1,
								'easing' => 'cubic',
								'duration' => 800,
								'pauseDuration' => 1500,
								'pauseOnHover' => true,
								'fx' => 'directscroll',
						),
				),
		));
		?>
		
		<?php if(Yii::app()->controller->id == 'news' && Yii::app()->controller->action->id == 'index') {?>
			<h5>Tin Mới Nhất</h5>
			<div id="foo">
			<?php 
			$criteria=new CDbCriteria;
			$criteria->order = 'news_id DESC';
			$news = News::model()->findAll($criteria);
			for ($i = 0; $i<10 ; $i++) {
			$data = $news[$i];
			?>
			<div class="item">
			
			<a href="<?php echo Yii::app()->createUrl("news/view",array("id" => $data->news_id));?>">
				<img alt="Ảnh con vật" src="<?php echo Yii::app()->request->getBaseUrl(true) . "/images/forumpic/" . $data->image . ".jpg";?>">
				<h6><?php echo $data->title?></h6>
			</a>
			</div>
			<?php }?>
		<?php 
		} else {?>
		
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
			
			<a href="<?php echo Yii::app()->createUrl("creatures/view",array("id" => $data->ID));?>">
				<img alt="Ảnh con vật" src="<?php echo getImageUrl($data->Loai,$data->Img)?>">
				<h6><?php echo $data->Viet?></h6>
			</a>
			
			</div>
			<?php
			}
		}
			?>
		</div>
	</div>
	<div id="copyright">
		<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam'
			khi bạn phát hành lại thông tin từ Website này</p>
	</div>
</div>

<?php $this->endContent(); ?>