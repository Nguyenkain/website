<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'postDialog',
                'options'=>array(
                    'title'=>"Viết bài mới",
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('post', array("model" => $model, "data" => $data, "photo" => $photo)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>