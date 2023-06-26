<main class="content" id="<?= $_GET['page'] ?? 1 ?>">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>All</strong> Post</h1>

    <div class="row">
      <div class="col-12 col-xxl-9 d-flex">
        <div class="card flex-fill">
          <div class="card-body">

            
            <table class="table table-hover my-0">
              <thead>
                <tr>
                  <th>Title</th>
                  <th class="d-none d-xl-table-cell">Created Date</th>
                  <th class="d-none d-md-table-cell">Status</th>
                  <th class="d-none d-xl-table-cell">Author</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $row_nb_per_page = 10;
                  $pages = ceil(count($posts->all()) / $row_nb_per_page);
                  $start = isset($_GET['page']) ? $_GET['page'] - 1 : 0;
                  $start = $start * $row_nb_per_page;
                  $postResult = $posts->limit($start, $row_nb_per_page);
                  foreach ($postResult as $post) : 
                ?>
                  <tr>
                    <td><?= $post->title ? substr($post->title, 0, 20) . '...' : 'Null' ?></td>
                    <td class="d-none d-xl-table-cell"><?= $post->created_at ?></td>
                    <td class="d-none d-md-table-cell"><span class="badge bg-success">Enable</span></td>
                    <td class="d-none d-xl-table-cell">Auther Test</td>
                    <td>
                      <a class="btn btn-danger btn-sm" href="#"><span class="d-sm-none">D</span><span class="d-none d-sm-inline-block">Delete</span></a>
                      <a class="btn btn-info btn-sm" href="posts/<?= $post->id ?>"><span class="d-sm-none">U</span><span class="d-none d-sm-inline-block">Update</span></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  <div class="row">
    <div class="col col-xxl-9 d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <!-- Previous Link -->
          <li class="page-item">
            <?php if (isset($_GET['page']) && $_GET['page'] > 1) :?>
              <a class="page-link" href="?page=<?= $_GET['page'] - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            <?php else :?>
              <a class="page-link" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            <?php endif;?>
          </li>
          <!-- End Previous Link -->
          <?php  for($counter = 1; $counter <= $pages; $counter++) : ?>
            <li id="<?= $counter ?>" class="page-item"><a class="page-link" href="?page=<?= $counter ?>"><?= $counter ?></a></li>
          <?php  endfor; ?>
          <!-- Next Link -->
          <li class="page-item">
            <?php if (isset($_GET['page']) && $_GET['page'] < $pages ) : ?>
              <a class="page-link" href="?page=<?= $_GET['page'] + 1?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            <?php else : ?>
              <a class="page-link" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            <?php endif; ?>
          </li>
          <!-- End Next Link -->
        </ul>
      </nav>
    </div>
  </div>

  </div>
</main>

<script>
  let Links = document.querySelectorAll('.pagination .page-link')
  let id = document.querySelector('main').id;
  Links.item(id).classList.add('active');
</script>
