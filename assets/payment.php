<!DOCTYPE html>
<html lang="ko">
<head>
<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/page/header.php'; //헤더?>
</head>
<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/config/session.php'; //세션?>
<body class="">
	<div class="wrapper ">
		<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/page/side_menu.php'; //좌측 메뉴?>
		<div class="main-panel">
			<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/page/top_menu.php'; //상단 메뉴?>
			<div class="content">
				<div class="container-fluid">
    				<div class="row">
    					<div class="col-md-12">
    						<div class="card">
    							<div class="card-header card-header-primary">
    								<h4 class="card-title ">이용권 충전</h4>
    							</div>
    							<form method="post" action="/process/process_payment.php">
        							<div class="card-body">
        								<div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="bmd-label-floating">닉네임</label>
                                              <input type="text" class="form-control" name="user_nick">
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                            <label class="bmd-label-floating">티켓구매 수량</label>
                                              <input type="text" class="form-control"  id="ticket_amount" name="ticket_amount">
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="bmd-label-floating">금액</label>
                                              <input type="text" class="form-control" readonly id="ticket_price" value="0">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-12">
                                            <div class="text-center">
                                              <button class="btn btn-primary" type="submit">충전</button>
                                            </div>
                                          </div>
                                        </div>
        							</div>
    							</form>
    						</div>
    					</div>
    				</div>					
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
<!-- 					<nav class="float-left"> -->
<!-- 						<ul> -->
<!-- 							<li><a href="https://lunamint.com" target="_blank">Company </a></li> -->
<!-- 						</ul> -->
<!-- 					</nav> -->
					<div class="copyright float-right">&copy;루나민트닷컴. All Rights Reserved.</div>
				</div>
			</footer>
		</div>
	</div>
<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/page/footer.php'; //푸터?>
</body>

</html>