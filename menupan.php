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
    								<h4 class="card-title ">외식쿠폰 메뉴</h4>
    							</div>
    							<form method="post" action="/process/process_menupan.php">
    								<input type="hidden" name="type" value="reg">
        							<div class="card-body">
        								<div class="row" id="menu_list">
        								<!-- 상단 제목 -->
                                       	<div class="col-md-1">
                                            <div class="form-group"> No</div>
                                        </div>
                                       	<div class="col-md-3">
                                            <div class="form-group"> 이름</div>
                                        </div>
                                       	<div class="col-md-4">
                                            <div class="form-group"> 설명</div>
                                        </div>
                                       	<div class="col-md-2">
                                            <div class="form-group"> 가격</div>
                                        </div>
                                       	<div class="col-md-2">
                                            <div class="form-group"> 삭제</div>
                                        </div>
                                          <!-- 상단 제목 -->
                                          <?php 
                                          require_once $_SERVER["DOCUMENT_ROOT"]."/include/config/database.php";
                                          // 메뉴 리스트
                                          $sql = "
                                                SELECT *
                                                FROM center_item
                                                WHERE center_id='gimp'
                                            ";
                                                $res = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_assoc($res)){
                                          ?>                                          
                                           <div class="col-md-1">
                                            <div class="form-group">
                                              <?php echo $row[item_id]?>
                                            </div>
                                          </div>
                                          <!-- 메뉴 -->
                                          <div class="col-md-3">
                                            <div class="form-group">
                                              <input type="text" class="form-control"  value="<?php echo $row[item_name]?>">
                                            </div>
                                          </div>
                                           <div class="col-md-4">
                                            <div class="form-group">
                                              <input type="text" class="form-control"  value="<?php echo $row[item_desc]?>">
                                            </div>
                                          </div>
                                           <div class="col-md-2">
                                            <div class="form-group">
                                              <input type="text" class="form-control"  value="<?php echo $row[item_price]?>">
                                            </div>
                                          </div>
                                           <div class="col-md-2">
                                            <div class="form-group">
                                              <button type="button"" class="btn btn-error" onclick="menu_delete('<?php echo $row[item_id]?>')">삭제</button>
                                            </div>
                                          </div>
                                            <!-- 메뉴 //-->
                                            <?php }?>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="text-center">
                                              <button class="btn btn-primary" type="submit">수정</button>
                                              <button class="btn btn-error" type="button" onclick="menu_add()">추가</button>
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
			<script>
			//메뉴 삭제
			function menu_delete(item_id){
				console.log(item_id);
			}
			//메뉴 추가
			function menu_add(){
				var menu = "<div class='col-md-1'><div class='form-group'>6</div></div>";
				menu += "<div class='col-md-3'><div class='form-group'><input type='text' class='form-control'></div></div>";
				menu += "<div class='col-md-4'><div class='form-group'><input type='text' class='form-control'></div></div>";
				menu += "<div class='col-md-2'><div class='form-group'><input type='text' class='form-control'></div></div>";
				menu += "<div class='col-md-2'><div class='form-group'><button type='button' class='btn btn-error' onclick='menu_delete()'>삭제</button></div></div>";
				$("#menu_list").append(menu);
			}
			</script>
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