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
<div id="list-creature" class="page_content">
	<div class="search_container">
		<?php $this->renderPartial('_search',array(
				'model'=>$model,
		));
		?>
	</div>
	<!-- search-form -->
	<div id="creature_content">

		<div class="big_images">
		
			<?php echo CHtml::image(getImageUrl($model->Loai, $model->Img),"Ảnh con vật")?>
		
		</div>

		<div class="creature_info">

			<div class="creature_name">
				<div class="name_item">
					<div class="name">Tên Việt Nam:</div>
					<div class="vn_name"><?php echo $model->Viet?></div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Tên Latin:</div>
					<div class="latin_name"><?php echo $model->Latin?></div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Họ:</div>
					<div class="normal_name"><?php echo $model->rHo->Viet?></div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Bộ:</div>
					<div class="normal_name"><?php echo $model->rBo->Viet?></div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Lớp (nhóm):</div>
					<div class="normal_name"><?php echo $model->rNhom->Viet?></div>
					<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="small_images"></div>

		</div>
		
		<div class="clearfix"></div>
		
		<div class="creature_content">
		
			<?php echo $model->Description?>
		
		</div>
		
		

	</div>
	<?php 


	?>
</div>


<div id="footer" class="normal">
	<div id="copyright">
		<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam'
			khi bạn phát hành lại thông tin từ Website này</p>
	</div>
</div>
