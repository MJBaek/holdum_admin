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
			<?php 
			require_once $_SERVER["DOCUMENT_ROOT"]."/include/config/database.php";
			$sql = "
                SELECT uh.*, ui.user_id, ui.user_nick 
                FROM user_history AS uh 
                JOIN user_info AS ui
                ON uh.user_id = ui.user_id
                WHERE uh.center_id = 'gimp' AND uh.ticket_type='at' AND uh.ticket_use = 0 AND DATE(uh.reg_date) = CURDATE()
            ";
			$res = mysqli_query($conn, $sql);
			?>
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header card-header-primary">
									<h4 class="card-title ">당일 구매 내역</h4>
									<p class="card-category"><?php echo date("Y-m-d")?></p>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead class="text-primary">
												<th>아이디</th>
												<th>닉네임</th>
												<th>수량</th>
												<th>금액</th>
												<th>구매일</th>
											</thead>
											<tbody>
											<?php 
											     while($row = mysqli_fetch_assoc($res)){
											         $ticketPrice = $row["amount"]*10000;
											         $sum += $ticketPrice;
											?>
												<tr>
													<td><?php echo $row["user_id"];?></td>
													<td><?php echo $row["user_nick"];?></td>
													<td><?php echo $row["amount"];?></td>
													<td><?php echo number_format($ticketPrice);?></td>
													<td><?php echo $row["reg_date"];?></td>
												</tr>
											<?php }?>
											</tbody>
										</table>
									</div>
									<h2 class="card-body"> 합계 : <?php echo number_format($sum);?>원</h2>
								</div>
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