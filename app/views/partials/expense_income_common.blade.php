<div class="row">
	<div class="col-md-12">
		<h3>{{ $title }}</h3>
	</div>

	@if (!empty($leaf_categories))
		<?php $first_category = array_shift($leaf_categories); ?>
		<?php $type = strtolower($title); ?>

		<div class="col-xs-3">
			<ul class="nav nav-tabs tabs-left">
				<li class="active">
					<a 
						href="#category_{{ $first_category['category_id'] }}" 
						data-toggle="tab" 
						data-category-type="{{ $type }}" 
						data-category-id="{{ $first_category['category_id'] }}"
					>
						{{ $first_category['category_path'] }}
					</a>
				</li>

				@if (!empty($leaf_categories))
					@foreach ($leaf_categories as $leaf_category)
						<li>
							<a 
								href="#category_{{ $leaf_category['category_id'] }}" 
								data-toggle="tab" 
								data-category-type="{{ $type }}" 
								data-category-id="{{ $leaf_category['category_id'] }}"
							>
								{{ $leaf_category['category_path'] }}
							</a>
						</li>
					@endforeach						
				@endif
			</ul>
		</div>

		<div class="col-xs-9">
			<div class="tab-content">
				<div class="tab-pane active" id="category_{{ $first_category['category_id'] }}">
					{{ View::make('partials.progressbar', array('text' => 'Items are loading')) }}
				</div>

				@if (!empty($leaf_categories))
					@foreach ($leaf_categories as $leaf_category)
						<div class="tab-pane" id="category_{{ $leaf_category['category_id'] }}">
							{{ View::make('partials.progressbar', array('text' => 'Items are loading')) }}
						</div>
					@endforeach						
				@endif
			</div>
		</div>
	@else
		<div class="col-md-12">
			No categories in the database. <a href="{{ route('categories') }}">Add categories</a>.
		</div>
	@endif
</div>