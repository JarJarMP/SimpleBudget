<div class="row top-section">
	<div class="col-sm-12">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-8 top-section-logo">
					<h1><a href="{{ route('home') }}">Simple Budget</a></h1>
				</div>
				<div class="col-sm-4 top-section-icons">
					<?php if (!empty($right_menu)) : ?>
						<ul class="clearfix text-right">
							<li class="text-center">
								<a class="hover-font-green" href="#" title="Export" data-action="export">
									<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
								</a>
							</li>
							<li class="text-center">
								<a class="hover-font-green" href="#" title="Import" data-action="import">
									<span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span>
								</a>
							</li>
							<li class="text-center">
								<a class="hover-font-green" href="#" title="Settings" data-action="settings">
									<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
								</a>
							</li>
							<li class="text-center">
								<a class="hover-font-red" href="{{ route('logout') }}" title="Logout">
									<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
								</a>
							</li>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>