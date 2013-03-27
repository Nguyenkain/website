<?php 
$userid = Yii::app()->facebook->getUser();

if ($userid)
{
	try
	{
		$fbuid = Yii::app()->facebook->getUser();
		$me = Yii::app()->facebook->api('/me');
	}
	catch(FacebookApiException $e){
		$userid = NULL;
	}
}

if($userid) {
	$url = Yii::app()->facebook->getLogoutUrl();
	$user_info	= Yii::app()->facebook->api('/' . $userid);
	$model = new Users;
	$model->facebook_id = $userid;
	$model->name = $user_info['name'];
	$model->username = $user_info['username'];
	$model->user_avatar = $userid;
	$model->user_email = $user_info['email'];
	$model->user_dob = $user_info['birthday'];
	if(isset($user_info['location']))
		$model->user_address = $user_info['location']['name'];
	$model->addNewUser();
}
else {
	$url = Yii::app()->facebook->getLoginUrl(array(
			'scope'	=> 'read_stream, publish_stream, user_birthday, user_location, email, user_hometown, user_photos',
	));
}

?>

<div id="discussion_content" class="page_content">
	<div id="action_nav">
		<?php EQuickDlgs::ajaxLink(
            array(
                'controllerRoute' => 'post', //'member/view'
                'actionParams' => array('id'=>$userid), //array('id'=>$model->member->id),
                'dialogTitle' => "Viết bài mới",
                'dialogWidth' => 490,
                'dialogHeight' => 370,
                'openButtonText' => '<span>Thêm chủ đề</span>',
                'closeButtonText' => false,
                'closeOnAction' => true, //important to invoke the close action in the actionCreate
                'openButtonHtmlOptions' => array('id' => 'post_button'),
            )
        );
        ?>
		<h4>Các chủ đề thảo luận</h4>
		<?php
$this->widget('ext.tooltipster.tooltipster',
          array(
            'identifier'=>'#profile',
            'options'=>array(        'animation'=>'grow',
        'offsetY'=>'60',
        'interactive'=>true,
        'interactiveTolerance'=>'10000',
        'timer'=>'10000',
        'position'=>'top')
    ));
		if(!$userid)
		{
			echo CHtml::link('', $url, array('id'=>'facebook_button'));
		}
		else {
		?>
</td>
		<div id="profile_container">
			<div id="profile" title="<img src='http://graph.facebook.com/<?php echo $userid ?>/picture?type=normal' width='100' height='100' /> <?php echo $user_info['name']?><br><a href='<?php echo $url?>'> Log out</a>">
				<?php echo CHtml::image("http://graph.facebook.com/". $userid ."/picture?type=normal"); ?>
				<label><?php echo $user_info['name']?></label>
			</div>
			<div class="ver_line"></div>
			<div id="notification">
				<label>Thông báo</label>
			</div>
			<div class="clearfix"></div>
		</div>

		<?php }?>

		<div class="clearfix"></div>
	</div>
	<div class="hoz_line long"></div>
	<div id="thread_container">

		<?php

 $this->widget('bootstrap.widgets.TbListView',array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_index',
				'summaryText'=>false,
				'emptyText'=>'Hiện thảo luận chưa có bài viết nào, hãy đóng góp bài viết cho chúng tôi',
				'pager'=>array(
						'header'         => '',
						'firstPageLabel' => '&lt;&lt;',
						'lastPageLabel'  => '&gt;&gt;',
						'nextPageLabel'=>'Tiếp',//overwrite nextPage lable
						'prevPageLabel'=>'Lùi',//overwrite prePage lable
				),
				'pagerCssClass'=>'pagination-right',
				'beforeAjaxUpdate' =>'js:function(id, data) {
				$("#thread_container").addClass("hasLoading");
}',
				'afterAjaxUpdate' => 'js:function(id, data) {
				$("#thread_container").removeClass("hasLoading");
}'
		));
		?>

	</div>
</div>


<div id="footer">
            <div id="footer_content">
                <div id="intro">
                    <h4>
                        Giới thiệu</h4>
                    <p>
                        Website Sinh vật rừng Việt Nam là một nỗ lực của những con người đang mong muốn
                        góp một phần nhỏ bé của mình vào việc bảo tồn thiên nhiên và nhằm đáp ứng yêu cầu
                        khoa học phục vụ cho việc quản lý nhà nước về công tác nghiên cứu, bảo tồn thiên
                        nhiên Việt Nam và công tác tra cứu, tìm hiểu các loài động, thực vật, côn trùng,
                        các văn bản pháp quy liên quan đến việc quản lý, xây dựng và bảo vệ, phát triển
                        rừng. Rất mong được sự đồng cảm của mọi người.</p>
                </div>
                <div id="news_container">
                    <h4>
                        Tin mới</h4>
                    <div id="news_list">
                        <div class="news_item">
                            <div class="images">
                                <img alt="" src="css/images/news_test.png">
                            </div>
                            <div class="news_info">
                                <a href="#" class="news_title">Cầy tai trắng- Ninja của rừng già</a>
                                <p class="news_content">
                                    So với những người anh em trong họ Cầy Viverridae, Cầy tai trắng có kích thước thuộc
                                    dạng trung bình., phần sống mũi có sọc trắng mờ, đôi tai to tròn, mỏng phủ lớp lông
                                    ngắn màu trắng, hai mắt to, phần lông quanh mắt có màu sậm, trông như một chiếc
                                    mặt nạ của các ninja trên phim ảnh.</p>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                        <div class="news_item">
                            <div class="images">
                                <img alt="" src="css/images/news_test.png">
                            </div>
                            <div class="news_info">
                                <a href="#" class="news_title">Cầy tai trắng- Ninja của rừng già</a>
                                <p class="news_content">
                                    So với những người anh em trong họ Cầy Viverridae, Cầy tai trắng có kích thước thuộc
                                    dạng trung bình., phần sống mũi có sọc trắng mờ, đôi tai to tròn, mỏng phủ lớp lông
                                    ngắn màu trắng, hai mắt to, phần lông quanh mắt có màu sậm, trông như một chiếc
                                    mặt nạ của các ninja trên phim ảnh.</p>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                        <div class="news_item">
                            <div class="images">
                                <img alt="" src="css/images/news_test.png">
                            </div>
                            <div class="news_info">
                                <a href="#" class="news_title">Cầy tai trắng- Ninja của rừng già</a>
                                <p class="news_content">
                                    So với những người anh em trong họ Cầy Viverridae, Cầy tai trắng có kích thước thuộc
                                    dạng trung bình., phần sống mũi có sọc trắng mờ, đôi tai to tròn, mỏng phủ lớp lông
                                    ngắn màu trắng, hai mắt to, phần lông quanh mắt có màu sậm, trông như một chiếc
                                    mặt nạ của các ninja trên phim ảnh.</p>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
            </div>
            <div id="copyright">
                <p>
                    Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam' khi bạn phát hành
                    lại thông tin từ Website này</p>
            </div>
        </div>