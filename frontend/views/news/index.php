<div id="news_content">
<?php
foreach ($modelCategories->findAll() as $value) {
	$criteria = new CDbCriteria;
	$criteria->condition = 'category_id = '.$value->category_id;
	$criteria->order = 'news_id DESC';
	$newest = $modelNews->find($criteria);
	?>
	
	<?php if (!is_null($newest)) { ?>
	<div class="cateogory_item">
		<div class="category_title">
		<a href="<?php echo Yii::app()->createUrl("news/list",array("cat_id"=>$value->category_id))?>">
			<h4 class="title"><?php echo $value->category_name ?></h4></a>
			<div class="hoz_line"></div>
		</div>
		<div class="first_news">
			<div class="images">
				<?php echo CHtml::image(Yii::app()->request->getBaseUrl(true) . "/images/forumpic/" . $newest->image . ".jpg");?>
			</div>
			<div class="news_content">
				<?php echo CHtml::link($newest->title,array('news/view&id='.$newest->news_id));?>
				<p><?php echo $newest->short_description;?></p>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="news_list">
			<?php
				$this->widget('zii.widgets.CListView',array(
					'dataProvider'=>$value->getNews($value->category_id),
					'itemView'=>'_index',
					'summaryText'=>false,
					'emptyText'=>false,
				));
			?>
		</div>
	</div>

<?php 
	}
}

?>
<div class="clearfix"></div>
</div>
