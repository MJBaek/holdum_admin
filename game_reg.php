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
    								<h4 class="card-title ">게임등록</h4>
    							</div>
    							<form method="post" action="/process/process_game.php">
    								<input type="hidden" name="type" value="reg">
        							<div class="card-body">
        								<div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="bmd-label-floating">게임제목</label>
                                              <input type="text" class="form-control" name="game_title">
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                            <label class="bmd-label-floating">테이블</label>
                                                <select class="browser-default custom-select" name="game_table">
                                                    <option value="Table-A" selected>Table-A</option>
                                                    <option value="Table-B">Table-B</option>
                                                    <option value="Table-C">Table-C</option>
                                                </select>
                                            </div>
                                          </div>                                          
                                          <div class="col-md-12">
                                            <div class="form-group">
                                            <label class="bmd-label-floating">게임상태</label>
                                                <select class="browser-default custom-select" name="game_status">
                                                  <option value="0" selected>예약게임</option>
                                                  <option value="1">진행중</option>
                                                  <option value="2">종료된 게임</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                            <label class="bmd-label-floating">입장 티켓</label>
                                                <select class="browser-default custom-select" name="game_ticket">
                                                  <option value="free" selected>프리티켓</option>
                                                  <option value="seed">시드권</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="bmd-label-floating">입장 티켓 수량</label>
                                                <select class="browser-default custom-select" name="game_ticket_amount">
                                                <?php for($i=1; $i<=50; $i++){
                                                    $selected = $i ===3 ? "selected" : "";
                                                      echo "<option value='$i' $selected>$i</option>";
                                              	 }?>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label>게임 시작 일시</label>
											  <input type="text" class="form-control datetimepicker"  id="game_start"  name="game_start"/>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="bmd-label-floating">최대 참가 인원</label>
                                                <select class="browser-default custom-select" name="game_entry_max">
                                                <?php for($i=1; $i<=24; $i++){
                                                    $selected = $i ===5 ? "selected" : "";
                                                      echo "<option value='$i' $selected>$i</option>";
                                              	 }?>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="bmd-label-floating">최대 바이인 횟수</label>
                                                <select class="browser-default custom-select" name="game_buy_max">
                                                <?php for($i=1; $i<=3; $i++){
                                                    $selected = $i ===3 ? "selected" : "";
                                                      echo "<option value='$i' $selected>$i</option>";
                                              	 }?>
                                                </select>
                                            </div>
                                          </div>
                                          <!-- <div class="col-md-12">
                                            <div class="form-group">
                                              <label>리워드 타입</label><br>
                                                <select class="browser-default custom-select" name="game_reward_type">
                                                  <option value="0"  selected>차등 지급</option>
                                                  <option value="1">수동 지급</option>
                                                </select><br><br>                                                
                                                <div id="reward_list">&nbsp;</div>
                                            </div>
                                          </div> -->
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="text-center">
                                              <button class="btn btn-primary" type="submit">등록</button>
                                              <button class="btn btn-primary" type="button" onclick="location.href='/history_game.php'">리스트</button>
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