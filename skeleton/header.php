<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand noselect" href="./index.php?&page=0"><?php echo $_WEBSITE_NAME ;?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link noselect" style="cursor: pointer;" onclick="window.location.href = './index.php?dpage=comments&page=0';">comments<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link noselect" style="cursor: pointer;" onclick="window.location.href = './index.php?dpage=about';">about <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link noselect" style="cursor: pointer;" onclick="insertParam('upload', 'server');">upload <span class="sr-only">(current)</span></a>
			</li>
			<?php if($user_auth){ ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle noselect" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<strong><?php echo $user_login;?></strong>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item noselect" style="cursor: pointer; color: #007bff;" onclick="window.location.href = './index.php?dpage=personal';">profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item noselect" style="cursor: pointer;" onclick="window.location.href = './index.php?php=logout';">logout</a>
					</div>
				</li>
			<?php }else{ ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle noselect" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 	aria-haspopup="true" aria-expanded="false">
						person
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item noselect" style="cursor: pointer; color: #007bff;" onclick="window.location.href = './index.php?dpage=login';">login</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item noselect" style="cursor: pointer; color: #007bff;" onclick="window.location.href = './index.php?dpage=registration';">registration</a>
					</div>
				</li>
			<?php } ?>
	      <!--<li class="nav-item">
	        <a class="nav-link disabled" href="#">Disabled</a>
	    </li>-->
	    <li class="nav-item active  menu-tags">
	    	<a class="nav-link noselect" style="cursor: pointer;" onclick="window.location.href = './index.php?dpage=tags';">tags</a>
	    </li>
	</ul>
	<form id="input-parameters-search" class="form-inline my-2 my-lg-0" action="./php/find.php" autocomplete="off" method="get">
		<div>
			<input class="form-control mr-sm-2" id="search-value" type="search" name="tag" placeholder="Search" aria-label="Search" maxlength="32" value="<?php echo $_GET['tag']; ?>">
			<div id="input-parameters" class="input-parameters"></div>
		</div>
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
</div>
</nav>

<script>
	var open = false;
	function edw() {
		var wd = document.getElementById("search-value").getBoundingClientRect().width;
		document.getElementById("input-parameters").style.width = wd + "px";
	}
	function getTags(tag){
		if(document.getElementById("search-value").value.length > 0){
			$( document ).ready(function() {
				$.ajax({
					type: "POST",
					data: {
						tags: tag,
					},
					url: './skeleton/mini/inputs-parameters.php',
					success: function(data) {
						$('#input-parameters').html(data);
					}
				});
			});
		}
	}
	var typingTimer;
	var doneTypingInterval = 400;
	var input_spliter = [];
	function outedw(){
		let last = $('#search-value').prop("selectionStart");
		input_spliter = document.getElementById("search-value").value.substr(0, last).split(' ');

		clearTimeout(typingTimer);
		typingTimer = setTimeout(getTags, doneTypingInterval, input_spliter[input_spliter.length - 1]);
	}
	edw();

	window.addEventListener('resize', edw);
	document.getElementById("search-value").addEventListener('input', outedw);

	var tag_stat = false;
	var input_stat = false;

	$('#input-parameters').mouseenter(function(){tag_stat=true; fn();});
	$('#input-parameters').mouseleave(function(){tag_stat=false; fn();});

	$('#search-value').mouseenter(function(){input_stat=true; fn();});
	$('#search-value').mouseleave(function(){input_stat=false; fn();});

	function fn(){
		if(input_stat || tag_stat){
			document.getElementById("input-parameters").style.display = "block";
			edw();
		}
		else if(!input_stat && !tag_stat){
			//document.getElementById("input-parameters").style.display = "none";
		}
	}

	const input_param = document.getElementById("input-parameters-search");
	const input_tag = document.getElementById("input-parameters-search");

	input_param.addEventListener('focusin', (event) => {
		document.getElementById("input-parameters").style.display = "block";
	});

	input_param.addEventListener('focusout', (event) => {
		//document.getElementById("input-parameters").style.display = "none";
	});
</script>

<script>
	const queryString = window.location.search;
	console.log(queryString);
	const urlParams = new URLSearchParams(queryString);
      //urlParams.get('upload');
      $( document ).ready(function() {
      	$(function(){
      		$("img.lazyImg").lazyload({
      			effect: /*"show",*/ "fadeIn",
      			effectspeed: 200,
      			threshold: 600,
      		});
      	});
      });
  </script>

  <script>
  	function isMobile(){
  		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  			return true;
  		}
  		return false;
  	}
  </script>

  <script src="./js/parameters.js"></script>