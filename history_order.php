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
                SELECT 
                	uo.order_group,
                    SUM(ci.item_price) AS sum_order_item_price,
                    MIN(uo.reg_date) AS reg_date,
                    MIN((SELECT user_nick FROM user_info WHERE user_id = uo.user_id)) AS user_nick
                FROM user_order AS uo 
                JOIN center_item AS ci
                ON uo.order_item = ci.item_id
                WHERE uo.center_id = 'gimp' AND DATE(uo.reg_date) = CURDATE()
                GROUP BY uo.order_group
            ";
			$res = mysqli_query($conn, $sql);
			?>
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header card-header-primary">
									<h4 class="card-title ">당일 주문 내역</h4>
									<p class="card-category"><?php echo date("Y-m-d")?></p>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead class="text-primary">
												<th>주문번호</th>
												<th>닉네임</th>
												<th>메뉴명</th>
												<th>수량</th>
												<th>외식쿠폰 합계</th>
												<th>구매일</th>
											</thead>
											<tbody>
											<?php 
											     while($row = mysqli_fetch_assoc($res)){
											         $sum += $row["sum_order_item_price"];
											         $sql2 = "
                                                        SELECT * 
                                                        FROM user_order AS uo
                                                        JOIN center_item AS ci
                                                        ON uo.order_item = ci.item_id
                                                        WHERE order_group = '$row[order_group]'
                                                     ";
											         $res2 = mysqli_query($conn, $sql2);
											         $menuArr = [];
											         $i=0;
											         while($row2 = mysqli_fetch_assoc($res2)){											             
											             $item = $row2['item_name']." ".$row2['item_desc']."|".$row2['order_amount'];
											             $menuArr[$row['order_group']][$i++] = $item;
											         }
// 											         echo "<pre>";
// 											         var_dump($menuArr);
// 											         echo "</pre>";
											?>
												<tr>
													<td><?php echo $row["order_group"];?></td>
													<td><?php echo $row["user_nick"];?></td>
													<td>
													<?php 
    													for($j=0; $j<count($menuArr[$row['order_group']]); $j++){
    													       $itemText = explode("|",$menuArr[$row['order_group']][$j]);													       
    													       echo "$itemText[0]<br>";
    													}
													 ?>
													 </td>
													<td align="center">
													<?php 
    													for($j=0; $j<count($menuArr[$row['order_group']]); $j++){
    													       $itemText = explode("|",$menuArr[$row['order_group']][$j]);													       
    													       echo "$itemText[1]<br>";
    													}
													 ?>
													 </td>
													<td align="center"><?php echo number_format($row["sum_order_item_price"]);?></td>
													<td><?php echo $row["reg_date"];?></td>
												</tr>
											<?php
											     }
											?>
											</tbody>
										</table>
									</div>
									<h2 class="card-body"> 합계 : 외식쿠폰 <?php echo number_format($sum);?>장</h2>
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