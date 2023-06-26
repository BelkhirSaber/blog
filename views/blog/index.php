<!-- ads section -->
<section class="bg-light pt-5">
		<div class="container">
			<div class="bg-primary text-center" style="height: 170px;">
				<h1 class="text-white pt-5">This is a Ad</h1>
			</div>
		</div>
	</section>
<!-- end ads section -->

<section class="section bg-light">
		<div class="container">
			<div class="row align-items-stretch retro-layout">
				<div class="col-md-4 d-grid gap-4">
          <?php for ($i=0; $i<2; $i++): ?> 

					<a href="/blog/posts/<?= $params['posts'][$i]->id ?>" class="h-entry v-height gradient">

						<div class="featured-img" style="background-image: url('<?= $config->get('app.url'); ?>blog/assets/images/<?= $params['posts'][$i]->image ?>');"></div>

						<div class="text">
							<span class="date"><?= date_format(date_create($params['posts'][$i]->created_at), 'Y-m-d') ?></span>
							<h2><?= $params['posts'][$i]->title ?></h2>
							<div>
								<?php  	
									$tags = $params['posts'][$i]->tags();
									for($j = 0; $j < 2; $j++):	if (count($tags) > $j) : ?>									

										<span class="badge bg-info text-white d-inline"><?= $tags[$j]->name ?></span>

								<?php  endif; endfor;?>
							</div>
						</div>
					</a>

          <?php endfor; ?> 
				</div>

				<div class="col-md-4">
					<a href="/blog/posts/<?= $params['posts'][2]->id ?>" class="h-entry img-5 h-100 gradient">

						<div class="featured-img" style="background-image: url('<?= $config->get('app.url'); ?>blog/assets/images/<?= $params['posts'][$i]->image ?>');"></div>

						<div class="text">
							<span class="date"><?= date_format(date_create($params['posts'][2]->created_at), 'Y-m-d')?></span>
							<h2><?= $params['posts'][2]->title ?></h2>
							<div>
								<?php  	
									$tags = $params['posts'][$i]->tags();
									for($j = 0; $j < 2; $j++):	if (count($tags) > $j) : ?>									

										<span class="badge bg-info text-white d-inline"><?= $tags[$j]->name ?></span>

								<?php  endif; endfor;?>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 d-grid gap-4">
          <?php for($i=3; $i<5; $i++): ?>
					<a href="/blog/posts/<?= $params['posts'][$i]->id ?>" class="h-entry v-height gradient">

						<div class="featured-img" style="background-image: url('<?= $config->get('app.url'); ?>blog/assets/images/<?= $params['posts'][$i]->image ?>');"></div>

						<div class="text">
							<span class="date"><?= date_format(date_create($params['posts'][$i]->created_at), 'Y-m-d') ?></span>
							<h2><?= $params['posts'][$i]->title ?></h2>
							<div>
								<?php  	
									$tags = $params['posts'][$i]->tags();
									for($j = 0; $j < 2; $j++):	if (count($tags) > $j) : ?>									

										<span class="badge bg-info text-white d-inline"><?= $tags[$j]->name ?></span>

								<?php  endif; endfor;?>
							</div>
						</div>
					</a>
          <?php endfor;?>
				</div>
			</div>
		</div>
	</section>

	<section class="section posts-entry">
		<div class="container">
			<div class="row mb-4">
				<div class="col-sm-6">
					<h2 class="posts-entry-title">Most viewed articles</h2>
				</div>
				<div class="col-sm-6 text-sm-end"><a href="<?= $config->get('app.url')?>/blog/posts" class="read-more">View All</a></div>
			</div>
			
			<div class="row g-3">
				<div class="col-md-9">
					<div class="row g-3">
						<?php foreach($params['mostViewedPost'] as $post) :  ?>
						<div class="col-md-6" style="min-height: 500px;">
							<div class="blog-entry d-flex flex-column">
								<a href="/blog/posts/<?= $post->id ?>" class="img-link">
									<div style="height:calc(100px + 5vw);overflow: hidden;">
										<img src="<?= $config->get('app.url')?>blog/assets/images/<?= $post->image?>" alt="Image" class="img-fluid">
									</div>
								</a>
								<div class="d-flex justify-content-between">
									<span class="date"><?= date_format(date_create($post->created_at), 'Y-m-d') ?></span>
									<span ><?= $post->views ?> views</span>
								</div>
								<h2><a href="<?= $config->get('app.url')?>/blog/posts/<?= $post->id?>"><?= substr($post->title, 0, 35) . " ..." ?></a></h2>
								<p><?= substr($post->content, 0, 600) . " ..." ?></p>
								<p class="mt-6"><a href="<?= $config->get('app.url') ?>/blog/posts/<?= $post->id ?>" class="btn btn-sm btn-outline-primary">Read More</a></p>
							</div>
						</div>
						<?php endforeach;  ?>
					</div>
				</div>

				<div class="col-md-3">
					<ul class="list-unstyled blog-entry-sm">
						<?php foreach($params['posts'] as $post) :?>
							<li>
								<span class="date"><?= date_format(date_create($post->created_at), 'y-m-d') ?></span>
								<h3><a href="<?= $config->get('app.url') ?>/blog/posts/<?= $post->id ?>"><?= substr($post->title, 0, 15) . ' ...' ?></a></h3>
								<p><?= substr($post->content, 0, 50) . ' ...' ?></p>
								<p><a href="<?= $config->get('app.url') ?>/blog/posts/<?= $post->id ?>" class="read-more">Continue Reading</a></p>
							</li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section posts-entry posts-entry-sm bg-light">
		<div class="container">
			<div class="row">
				<?php $i = 0; foreach($params['allPost'] as $post): ?>
					<div class="col-md-6 col-lg-3">
						<div class="blog-entry">
							<a href="<?= $config->get('app.url') ?>/blog/posts/<?= $post->id ?>" class="img-link">
								<div class="overflow-hidden" style="height: calc(100px + 5vh);">
									<img src="<?= $config->get('app.url') ?>/blog/assets/images/<?=$post->image?>" alt="Image" class="img-fluid">
								</div>
							</a>
							<span class="date"><?= date_format(date_create($post->created_at), 'D. jS, Y') ?></span>
							<h2 class="text-truncate"><a href="<?= $config->get('app.url') ?>blog/posts/<?= $post->id ?>"><?= $post->title ?></a></h2>
							<p><?= substr($post->content, 0, 60) ?></p>
							<p><a href="<?= $config->get('app.url') ?>blog/posts/<?= $post->id ?>" class="read-more">Continue Reading</a></p>
						</div>
					</div>
				<?php $i++;if($i == 4 ) break ; endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Politics -->
	<section class="section">
		<div class="container">

			<div class="row mb-4">
				<div class="col-sm-6">
					<h2 class="posts-entry-title">Politics</h2>
				</div>
				<div class="col-sm-6 text-sm-end"><a href="#" class="read-more">View All</a></div>
			</div>

			<div class="row">
			<?php foreach($params['allPost'] as $post): ?>
				<div class="col-lg-4 mb-4">
					<div class="post-entry-alt">
						<a href="single.html" class="img-link">
							<div style="height: calc(140px + 5vw);">
								<img src="<?= $config->get('app.url')?>blog/assets/images/<?= $post->image?>" alt="Image" class="img-fluid">
							</div>
						</a>
						<div class="excerpt">
							<h2><a href="single.html">Startup vs corporate: What job suits you best?</a></h2>
							<div class="post-meta align-items-center text-left clearfix">
								<figure class="author-figure mb-0 me-3 float-start"><img src="<?= $config->get('app.url') ?>blog/assets/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
								<span class="d-inline-block mt-1">By <a href="#">David Anderson</a></span>
								<span class="bg-light">&nbsp;-&nbsp; July 19, 2019</span>
							</div>

							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo sunt tempora dolor laudantium sed optio, explicabo ad deleniti impedit facilis fugit recusandae! Illo, aliquid, dicta beatae quia porro id est.</p>
							<p><a href="#" class="read-more">Continue Reading</a></p>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			
		</div>
	</section>
	<!-- End Politics -->