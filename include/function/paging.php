<?php
# 페이지 이동 함수 파라미터 설명
# $start : 시작 값 (10개 씩이라면 2페이지에서는 11값)
# $total : 전체 값 (게시물의 전체 갯수)
# $scale : 표시할 갯 수 (글 목록 갯수)
# $page_scale : 이동할 페이지 링크수 (1~10페이지 바로 이동하는 링크 갯수)
# $link : 페이지 이동시 따라갈 파라미터 (검색 파라미터)

function page($start,$total,$scale,$page_scale,$first,$pre,$next,$last,$link){
  print"<a href='?start=0$link'>$first</a>";

  $page = floor ($start / ($scale * $page_scale));
  if ($total > $scale) {
    if($start+1 > $scale*$page_scale) {
      $pre_start = $page * $scale * $page_scale - $scale;
      print"<a href='?start=$pre_start$link'>$pre</a>";
    }
    else print"$pre";
  }
  else print"$pre";

 if($total > 0) print"&nbsp; ";

 for ($vj=0 ; $vj<$page_scale ; $vj++) {
    $ln = ($page * $page_scale + $vj) * $scale;
    $page_num = $page * $page_scale+$vj + 1;
    if ($ln < $total) {
      if($ln != $start) print"<a href='?start=$ln$link'><b>$page_num</b></a> &nbsp; ";
      else print"<b>$page_num</b> &nbsp; ";
    }
  }

  if($total > (($page+1) * $scale * $page_scale)){
    $n_start = ($page+1) * $scale * $page_scale;
    print "<a href='?start=$n_start$link'>$next</a>";
  }
  else print $next;

  $end_start = floor($total/$scale)*$scale;

  print"<a href='?start=$end_start$link'>$last</a>";
}
?>