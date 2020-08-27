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
			
			// 유저 리스트
			$sql = "
                SELECT * 
                FROM user_info                
                $searchWhere
                ORDER BY reg_date DESC
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
									<h4 class="card-title ">등록된 유저들</h4>
									<br>
									<p class="card-category">
										<button class="search_date_button" onclick="location.href='<?php echo $SERVER[PHP_SELF]?>?search={date(reg_date):<?php  echo date("Y-m-d", strtotime(date("Y-m-d").'- 1 days'));?>}'">어제</button>
										<button class="search_date_button" onclick="location.href='<?php echo $SERVER[PHP_SELF]?>?search={date(reg_date):<?php echo date("Y-m-d");?>}'">오늘</button>
										<button class="search_date_button" onclick="location.href='/user.php'">전체</button>
									</p>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead class="text-primary">
												<th>유저 ID</th>
												<th>이메일</th>
												<th>닉네임</th>
												<th>로그인 타입</th>
												<th>시드포인트</th>
												<th>시드권</th>
												<th>이용권</th>
												<th>프리티켓</th>
												<th>외식쿠폰</th>
												<th>등록일</th>
											</thead>
											<tbody>
											<?php  while($row = mysqli_fetch_assoc($res)){?>												
												<tr>
													<td><?php echo $row["user_id"];?></td>
													<td><?php echo $row["user_email"];?></td>
													<td><?php echo $row["user_nick"];?></td>
													<td><?php echo $row["login_service_type"];?></td>
													<td><?php echo $row["seed_point"];?></td>
													<td><?php echo $row["seed_ticket"];?></td>
													<td><?php echo $row["available_ticket"];?></td>
													<td><?php echo $row["free_ticket"];?></td>
													<td><?php echo $row["food_coupon"];?></td>
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