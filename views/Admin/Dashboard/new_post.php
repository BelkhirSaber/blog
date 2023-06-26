<main class="content">
  <div class="container-fluid p-0">
    <div class="row mb-3">
      <div class="col">
        <h1 class="h3"><strong>Edit</strong> Post</h1>
      </div>

      <div class="col">
        <div class="d-flex justify-content-end gap-2">
          <input form="create-post" type="submit" name="draft" value="Draft" class="btn btn-secondary" >
          <input form="create-post" type="submit" name="publish" value="Publish" class="btn btn-primary" >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">

        <form action="/blog/admin/post/save" method="post" id="create-post" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
            <div class="alert border-start border-4 border-0 border-danger rounded-0 px-2 py-3 mb-0 text-danger">
              <span class="align-middle"><i data-feather="alert-circle"></i> </span> <span class="fs-4 align-middle">&MediumSpace; Image Poster Must Be Size 800x400</span>
            </div>
            </div>
            <div class="card-body">
              <div class="form-group mb-4">
                <label class="form-label fw-bold fs-4 mb-3">
                  <i class='bx bx-hash bx-sm bx-fw align-middle'></i>Page Slug
                </label>
                <input type="text" name="page_slug" class="form-control form-control-lg" placeholder="example_page_slug" required>
                <?php if (isset($flash['errors']['page_slug'])) : ?>
                  <span class="d-block invalid-feedback"><?= $flash['errors']['page_slug'] ?></span>
                <?php endif;?>
              </div>
              <div class="form-group mb-4">
                <label class="form-label fw-bold fs-4 mb-3">
                <i class='bx bx-pen bx-sm bx-fw align-middle'></i>Post Title</label>
                <input type="text" name="title" class="form-control form-control-lg" placeholder="enter post title" required>
              </div>
              <div class="form-group mb-4">
                <label class="form-label fw-bold fs-4 mb-3">
                <i class='bx bx-paragraph bx-sm bx-fw align-middle'></i>Post Content</label>
                <textarea id="editorJs" class="w-100" name="content"></textarea>
              </div>
              <div class="form-group mb-4">
                <label class="form-label fw-bold fs-4 mb-3">
                <i class='bx bx-image-add bx-sm bx-fw align-middle'></i>Poster</label>
                <input type="file" name="poster" class="form-control form-control-lg" placeholder="image poster" required>
              </div>
              <div class="form-group mb-4">
                <label class="form-label fw-bold fs-4 mb-3">
                <i class='bx bx-purchase-tag bx-sm bx-fw align-middle'></i>Add Tags </label><small class="text-mute">&ThickSpace;(Tag Optimize SEO)</small>
                <input type="text" name="tags" id="tag" class="form-control form-control-lg bg-white" placeholder="Add some tag">
              </div>
            </div>
          </div>
          <input type="hidden" name="<?= $csrf['key']?>" value="<?= $csrf['value']?>">
          
        </form>

      </div>
    </div>
  </>
</main>


<script>
  // initialize Tagify on the above input node reference
  new Tagify(document.getElementById('tag'))
</script>
