<section class="section">
		<div class="container">

			<div class="row mb-4">
				<div class="col-sm-6">
					<h2 class="posts-entry-title">All articles</h2>
				</div>
			</div>
      <?php if ($posts) : ?>
        <div class="row">
        <?php foreach($posts as $post): ?>
          <div class="col-lg-4 mb-4">
            <div class="post-entry-alt">
              <a href="/blog/posts/<?= $post->id?>" class="img-link">
                <div style="height: calc(140px + 5vw);">
                  <img src="<?= $config->get('app.url')?>blog/assets/images/<?= $post->image?>" alt="Image" class="img-fluid">
                </div>
              </a>
              <div class="excerpt">
                <h2><a href="/blog/posts/<?= $post->id ?>">Startup vs corporate: What job suits you best?</a></h2>
                <div class="post-meta align-items-center text-left clearfix">
                  <figure class="author-figure mb-0 me-3 float-start"><img src="<?= $config->get('app.url') ?>blog/assets/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                  <span class="d-inline-block mt-1">By <a href="#">David Anderson</a></span>
                  <span class="bg-light">&nbsp;-&nbsp; July 19, 2019</span>
                </div>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo sunt tempora dolor laudantium sed optio, explicabo ad deleniti impedit facilis fugit recusandae! Illo, aliquid, dicta beatae quia porro id est.</p>
                <p><a href="/blog/posts/<?= $post->id ?>" class="read-more">Continue Reading</a></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="container">
          <p class="h1" > No article found for <?= $tag->name ?> tag</p>
        </div>
			<?php endif; ?> 
			
		</div>
	</section>