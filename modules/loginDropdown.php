<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
	<ul id="login-dp" class="dropdown-menu">
		<li>
			<div class="row">
				<div class="col-md-12">
					<!-- Sign in with
					<div class="social-buttons">
						<a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
						<a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
					</div>
					or -->
					<form class="form" role="form" method="post" action="login.php" accept-charset="UTF-8" id="login-nav">
						<?php
						if (isset($_SESSION['failedLogin'])) {
							echo 'invalid username/password';
						}
						?>
						<div class="form-group">
							<label class="sr-only" for="exampleInputEmail2">Email address</label>
							<input name="email" type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="exampleInputPassword2">Password</label>
							<input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
							<!-- <div class="help-block text-right"><a href="">Forgot your password ?</a></div> -->
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Sign in</button>
						</div>
						<div class="checkbox">
							<!-- <label>
								<input type="checkbox"> keep me logged-in
							</label> -->
						</div>
					</form>
				</div>
				<!-- <div class="bottom text-center">
					New here ? <a href="#"><b>Join Us</b></a>
				</div> -->
			</div>
		</li>
	</ul>
</li>
