<!DOCTYPE html>
<html lang="ko">
<head>
<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/page/header.php'; //헤더?>
<style>
    .table thead tr:hover {
        background:none;
        cursor:default;
    }
     .table tr:hover {
        background:silver;
        cursor:pointer;
     }
    .table td,th{
        text-align:center;
    }
    .table  th{
        font-weight: bold !important;
    }
    .paging{
        font-size:20px;
        margin-bottom:20px;
    }
    .paging i{
        vertical-align: middle;
    }
    .search_date_button{
        color:#000;
        border:0px;
    }
</style>
</head>
<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/config/session.php'; //세션?>
<body class="">
	<div class="wrapper ">
		<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/page/side_menu.php'; //좌측 메뉴?>
		<div class="main-panel">
			<?php require_once $_SERVER["DOCUMENT_ROOT"].'/include/page/top_menu.php'; //상단 메뉴?>
			<?php 
			require_once $_SERVER["DOCUMENT_ROOT"]."/include/config/database.php";
			
			// 페이징
			require_once $_SERVER["DOCUMENT_ROOT"]."/include/function/paging.php";
			$start = empty($_GET['start']) ? 0 : $_GET['start'] ; //페이지의 시작 값으로 처음에는 0으로 시작
			$scale = 10; //한 화면에 10개씩 표시, 10개 이상 지정하여 사용 가능
			$page_scale = 10; // 보여질 페이지 숫자
			
			//받아온 쿼리스트링을 where문으로 만든다.
			if(empty($_GET[search])){
			    $link = "";//페이징에 사용되는것
			    $search = "";
			    $searchWhere = "";
			}else{
			    $link = "&search=".$_GET[search]; //페이징에 사용되는것
    			$search = $_GET[search];
    			$searchArrExp = explode(",",$search);
    			
    			//쿼리 스트링이 1개 이상일때는 for
    			if(count($searchArrExp)>1){
        			$searchWhere = "WHERE 1=1";
        			for($i=0; $i <=count($searchArrExp); $i++){
        			    $keyValueExp = explode(":", $searchArrExp[$i]);
        			    $searchWhere .= " AND ".$keyValueExp[0] ." = '".$keyValueExp[1]."'";
        			}
    			}else{// 쿼리스트링이 1개일 때
    			    $keyValueExp = explode(":", $searchArrExp[0]);
    			    $searchWhere = "WHERE ".str_replace ("{","",$keyValueExp[0]) . " = '" .str_replace ("}","",$keyValueExp[1]) ."'";
    			}
			}
			
			// 페이징 전체 페이지 개수 가져오기
			$resCnt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(1) AS cnt  FROM game_info"));
			$total = $resCnt["cnt"];
			
			// 게임 리스트
			$sql = "
                SELECT * 
                FROM game_info                
                $searchWhere
                ORDER BY game_status ASC, game_start DESC, game_end DESC
                LIMIT $start , $scale
            ";
			$res = mysqli_query($conn, $sql);
			?>
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header card-header-primary">
									<h4 class="card-title ">등록된 게임들</h4>
									<br>
									<p class="card-category">
										<button class="search_date_button" onclick="location.href='<?php echo $SERVER[PHP_SELF]?>?search={date(game_start):<?php  echo date("Y-m-d", strtotime(date("Y-m-d").'- 1 days'));?>}'">어제</button>
										<button class="search_date_button" onclick="location.href='<?php echo $SERVER[PHP_SELF]?>?search={date(game_start):<?php echo date("Y-m-d");?>}'">오늘</button>
										<button class="search_date_button" onclick="location.href='/history_game.php'">전체</button>
									</p>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead class="text-primary">
												<th>게임 ID</th>
												<th>게임 제목</th>
												<th>게임 테이블</th>
												<th>게임 상태</th>
												<th>참여 티켓</th>
												<th>참여 티켓 수량</th>
												<th>게임레벨</th>
												<th>현재 참가자</th>
												<th>최대 참여자 수</th>
												<th>최대 바이인 수</th>
												<th>시작시간</th>
												<th>종료시간</th>
												<th>수정/삭제</th>
												<th>등록일</th>
											</thead>
											<tbody>
											<?php  while($row = mysqli_fetch_assoc($res)){?>												
												<tr>
													<td><?php echo $row["game_id"];?></td>
													<td><?php echo $row["game_title"];?></td>
													<td><?php echo $row["game_table"];?></td>
													<td><?php echo ($row["game_status"] === "0" ? "<font color=blue>예약게임</font>" : ($row["game_status"] === "1" ? "<font color=green>진행중</font>"  : "<font color=red>종료됨</font>" ));?></td>
													<td><?php echo $row["game_ticket"];?></td>
													<td><?php echo $row["game_ticket_amount"];?></td>
													<td><?php echo $row["game_level"];?></td>
													<td><?php echo $row["game_entry_current"];?></td>
													<td><?php echo $row["game_entry_max"];?></td>
													<td><?php echo $row["game_buy_max"];?></td>
													<td><?php echo $row["game_start"];?></td>
													<td><?php echo empty($row["game_end"]) ? "-" : $row["game_end"];?></td>
													<td>
														<button onclick="location.href='/game_edit.php?game_id=<?php echo $row["game_id"];?>' ">수정</button><br><br>
														<button onclick="location.href='/game_delete.php?game_id=<?php echo $row["game_id"];?>' ">삭제</button>
													</td>
													<td><?php echo $row["reg_date"];?></td>
												</tr>
											<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="text-center paging">
                          <?php echo page( $start , $total ,$scale , $page_scale ,"처음", "<i	class='material-icons'>keyboard_arrow_left</i>", "<i	class='material-icons'>keyboard_arrow_right</i>", "맨끝", $link );?>
                        </div>
                        <div class="text-center">
                          <button class="btn btn-primary" type="button" onclick="location.href='/game_reg.php'">게임 등록</button>
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