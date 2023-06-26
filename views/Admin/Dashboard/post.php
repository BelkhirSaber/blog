<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Edit</strong> Post</h1>

    <div class="row">
      <div class="col">

        <form action="/blog/admin/post/save" method="post">
          <div class="card">
            <div class="card-body">
              <textarea id="editorJs" class="w-100" name="content"></textarea>
            </div>
          </div>
          <input type="hidden" name="<?= $csrf['key']?>" value="<?= $csrf['value']?>">
          <input type="submit" name="save" value="save" class="btn btn-primary" >
        </form>

      </div>
    </div>
  </div>
</main>

