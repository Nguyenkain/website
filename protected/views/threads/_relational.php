<?php
// example code for the view "_relational" that returns the HTML content
echo CHtml::tag('h3',array(),'RELATIONAL DATA EXAMPLE ROW : "'.$id.'"');
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered',
		'dataProvider' => $gridDataProvider,
		'template' => "{items}",
		'columns' => array(
				'last_modified_time',
				'user_id',
				'thread_title',
				'thread_content',
				'thread_created_time',
				array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
				),),
));