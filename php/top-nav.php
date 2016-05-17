<div class = "row">
				<div class = "col-lg-1 col-md-1 col-sm-1 col-xs-1">
					<img class = "logo" width = "50px" src = "/v2/socialnetwork/img/branham.png" alt = "logo"></img>
				</div>
				<div class = "col-lg-9 col-md-9 col-sm-9 col-xs-9">
					<div class = "heading">BruinsConnect</div>
					<?php
						if($username){
						
						}else{
							echo '
							<div class = "top-options">
								
								
								
								
								<div class = "top-case top-volunteer"><a id = "volunteer-h" class = "top-links">&nbsp;Volunteer&nbsp;</a></div>
								<div class = "top-case top-sponsors"><a id = "sponsors-h" class = "top-links">&nbsp;Sponsors&nbsp;</a></div>
								<div class = "top-case top-privacy"><a id = "privacy-h" class = "top-links">&nbsp;Privacy&nbsp;</a></div>
								<div class = "top-case top-contact"><a id = "contact-h" class = "top-links">&nbsp;Contact&nbsp;</a></div>
								<div class = "top-case top-about"><a id = "about-h" class = "top-links">&nbsp;About&nbsp;</a></div>
							</div>
							';
						}
					?>
				</div>
				
				<div class = "col-lg-1 col-md-1 col-sm-1 col-xs-1">

					<a class = "btn-login" id = "btn-login"><span class = "glyphicon glyphicon-lock" /> <b>Login</b></a>
				</div>`