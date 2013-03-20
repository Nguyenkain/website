



<?php

 $this->widget('zii.widgets.CListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_userview', 
	'sortableAttributes'=>array(
		'category_id',
		'category_name',
		'description',
	),
)); ?>
