<?php /* @var $this Controller */ ?>

<script type="text/javascript">
$(document).ready(function() {
	$('#footer_content').hide();
	$('#footer').addClass('normal');
});

</script>

<?php $this->beginContent('//layouts/main'); ?>
		<div id="page">
			<?php echo $content?>
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
<?php $this->endContent(); ?>