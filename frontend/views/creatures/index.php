
<div id="page_container">
                <div id="search_container">
                    <div id="text_container">
                        <h2>
                            Tra cứu sinh vật rừng Việt Nam</h2>
                        <p>
                            (Hơn 2000 loài thuộc các họ, bộ, nhóm khác nhau)<br>
                            Cập nhật 20/05/2012
                        </p>
                    </div>
                    <div id="hoz_line">
                    </div>
                    <div id="search_form">
                    	<?php $form=$this->beginWidget('CActiveForm',array(
								'id'=>'creatures-form',
								'enableAjaxValidation'=>false,
						)); ?>
                        <div id="type_filter">
                        	
                            <div class="filter_item">
                                <label for="filter_lop" class="filter_label">
                                    Tra cứu theo Lớp (nhóm)</label>
                                <?php echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet' ), array(
                                		'empty'=>'--Chọn lớp muốn tìm--',
                                		'id' => 'filter_lop', 'class' => 'filter_ddl') ); ?>
                            </div>
                            <div class="filter_item">
                                <label for="filter_bo" class="filter_label">
                                    Tra cứu theo Bộ</label>
                                <?php echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet' ), array(
                                		'empty'=>'--Chọn bộ muốn tìm--',
                                		'id' => 'filter_bo', 'class' => 'filter_ddl')); ?>
                            </div>
                            <div class="filter_item">
                                <label for="filter_ho" class="filter_label">
                                    Tra cứu Họ</label>
                                <?php echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' ), array(
                                		'empty'=>'--Chọn họ muốn tìm--',
                                		'id' => 'filter_ho', 'class' => 'filter_ddl') ); ?>
                            </div>
                            <div id="kingdom_choose">
                                <?php echo CHtml::radioButtonList('radio','Loai',CHtml::listData(Loai::model()->findAll(),'ID','Loai'));?>
                            </div>
                        </div>
                        <div id="search_text">
                            <div id="search_input">
                                <?php echo $form->textField($model,'Viet',array('placeholder' => 'Tìm Kiếm')); ?>
                                <?php echo CHtml::submitButton('', array(
                                		'class' => 'search_btn',
                                		)); ?>
                            </div>
                            <div class="decoration">
                                <label class="hint">
                                    VD: Trăn gấm / Python reticulatus
                                </label>
                                <img alt="trang trí" src="css/images/deco.png" />
                            </div>
                        </div>
                    	<?php $this->endWidget(); ?>
                    </div>
                </div>
                <div id="image_container">
                    <img alt="ảnh con chim" src="css/images/chim.png">
                </div>
                <div class="clearfix">
                </div>
            </div>
