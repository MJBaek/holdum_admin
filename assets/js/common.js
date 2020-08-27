$(document).ready(function() {
  $().ready(function() {

	// 티켓 수량에 따른 구매 금액
	$("#ticket_amount").keyup(function(){
		var ticketPrice = $(this).val() * 10000;
		$("#ticket_price").val(ticketPrice);
	});
	
	// 메뉴 active
	var path = location.pathname;
	$(".nav-link").each(function(i){
		if($(this).attr("href") === path){
			$(this).parent().addClass("active");
		}
	});
	
	//상단 제목 
	if(location.pathname === "/game_reg.php"){
		$(".navbar-brand:eq(0)").text("게임등록");
	}else if(location.pathname === "/game_edit.php"){
		$(".navbar-brand:eq(0)").text("게임 정보 수정");
	}	else{
		$(".navbar-brand:eq(0)").text($("ul.nav .nav-item.active a p").text());
	}
	//게임 시작 일자
	$("#game_start").datetimepicker({
		// defaultDate: new Date(),
		format: 'YYYY-MM-DD HH:mm:ss',
		inline: true
	});

	/* 리워드 타입
	rewardType();// 기본값
	$("select[name=game_reward_type]").change(function(){
		rewardType();
	});
	function rewardType(){
		if($("select[name=game_reward_type] option:selected").val() == 0){
			var entryTicketAmount = parseInt($("select[name=game_ticket_amount]").val()); 
			var reward = $("select[name=game_ticket] option:selected").text();
			var addedPercent1 = 50;
			var addedPercent2 = 5;
			var addedPercent3 = 0;
			var rank1 = reward + ' ' +parseInt(entryTicketAmount+(entryTicketAmount/100)*addedPercent1) + '장';
			var rank2 = reward + ' ' +parseInt(entryTicketAmount+(entryTicketAmount/100)*addedPercent2) + '장';
			var rank3 = reward + ' ' +parseInt(entryTicketAmount+(entryTicketAmount/100)*addedPercent3) + '장';
			var html = '<label>1위 보상</label><input type="text" class="form-control" name="game_reward1" readonly value="' +rank1 + '">';
			html += '<label>2위 보상</label><input type="text" class="form-control" name="game_reward2" readonly value="' +rank2 + '">';
			html += '<label>3위 보상</label><input type="text" class="form-control" name="game_reward3" readonly value="' +rank3 + '">';
		
			$("#reward_list").html(html);
		}else{
			var html = '<label>1위 보상</label><input type="text" class="form-control" name="game_reward1">';
			html += '<label>2위 보상</label><input type="text" class="form-control" name="game_reward2">';
			html += '<label>3위 보상</label><input type="text" class="form-control" name="game_reward3">';
			$("#reward_list").html(html);
		}
	}*/
	
	
    $sidebar = $('.sidebar');

    $sidebar_img_container = $sidebar.find('.sidebar-background');

    $full_page = $('.full-page');

    $sidebar_responsive = $('body > .navbar-collapse');

    window_width = $(window).width();

    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

    if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
      if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
        $('.fixed-plugin .dropdown').addClass('open');
      }

    }

    $('.fixed-plugin a').click(function(event) {
      // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
      if ($(this).hasClass('switch-trigger')) {
        if (event.stopPropagation) {
          event.stopPropagation();
        } else if (window.event) {
          window.event.cancelBubble = true;
        }
      }
    });

    $('.fixed-plugin .active-color span').click(function() {
      $full_page_background = $('.full-page-background');

      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('color');

      if ($sidebar.length != 0) {
        $sidebar.attr('data-color', new_color);
      }

      if ($full_page.length != 0) {
        $full_page.attr('filter-color', new_color);
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.attr('data-color', new_color);
      }
    });

    $('.fixed-plugin .background-color .badge').click(function() {
      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('background-color');

      if ($sidebar.length != 0) {
        $sidebar.attr('data-background-color', new_color);
      }
    });

    $('.fixed-plugin .img-holder').click(function() {
      $full_page_background = $('.full-page-background');

      $(this).parent('li').siblings().removeClass('active');
      $(this).parent('li').addClass('active');


      var new_image = $(this).find("img").attr('src');

      if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
        $sidebar_img_container.fadeOut('fast', function() {
          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
          $sidebar_img_container.fadeIn('fast');
        });
      }

      if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

        $full_page_background.fadeOut('fast', function() {
          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          $full_page_background.fadeIn('fast');
        });
      }

      if ($('.switch-sidebar-image input:checked').length == 0) {
        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
      }
    });

    $('.switch-sidebar-image input').change(function() {
      $full_page_background = $('.full-page-background');

      $input = $(this);

      if ($input.is(':checked')) {
        if ($sidebar_img_container.length != 0) {
          $sidebar_img_container.fadeIn('fast');
          $sidebar.attr('data-image', '#');
        }

        if ($full_page_background.length != 0) {
          $full_page_background.fadeIn('fast');
          $full_page.attr('data-image', '#');
        }

        background_image = true;
      } else {
        if ($sidebar_img_container.length != 0) {
          $sidebar.removeAttr('data-image');
          $sidebar_img_container.fadeOut('fast');
        }

        if ($full_page_background.length != 0) {
          $full_page.removeAttr('data-image', '#');
          $full_page_background.fadeOut('fast');
        }

        background_image = false;
      }
    });

    $('.switch-sidebar-mini input').change(function() {
      $body = $('body');

      $input = $(this);

      if (md.misc.sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        md.misc.sidebar_mini_active = false;

        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

      } else {

        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

        setTimeout(function() {
          $('body').addClass('sidebar-mini');

          md.misc.sidebar_mini_active = true;
        }, 300);
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);

    });
  });
});