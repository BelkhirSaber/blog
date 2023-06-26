<?php 
  use App\Enums\CalendarEnum;

?>
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

    <div class="row">
      <div class="col-xl-6 col-xxl-5 d-flex">
        <div class="w-100">
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Post Last Week</h5>
                  <h1 class="mt-1 mb-3"><?= $posts->lastWeek() ?></h1>
                  <div class="mb-1">
                    <span class="<?= $posts->percent(CalendarEnum::Week) >= 0 ? 'text-success' : 'text-danger' ;?>"> <i
                        class="mdi mdi-arrow-bottom-right"></i><?= $posts->percent(CalendarEnum::Week) ?>&percnt;</span>
                    <span class="text-muted">Since last week</span>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Posts last month</h5>
                  <h1 class="mt-1 mb-3"><?= $posts->lastMonth() ?></h1>
                  <div class="mb-1">
                    <span class="<?= $posts->percent(CalendarEnum::Month) >= 0 ? 'text-success' : 'text-danger' ;?>">
                      <i class="mdi mdi-arrow-bottom-right"></i>
                      <?= $posts->percent(CalendarEnum::Month) ?>&percnt;
                    </span>
                    <span class="text-muted">Since last month</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Visitors last week</h5>
                  <h1 class="mt-1 mb-3"><?= $visitor->lastWeek() ?></h1>
                  <div class="mb-1">
                    <span
                      class="<?php echo $visitor->percent(CalendarEnum::Week) >= 0 ? 'text-success' : 'text-danger'; ?>">
                      <i class="mdi mdi-arrow-bottom-right"></i>
                      <?= $visitor->percent(CalendarEnum::Week) ?>&percnt;
                    </span>
                    <span class="text-muted">Since last week</span>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Visitors last month</h5>
                  <h1 class="mt-1 mb-3"><?= $visitor->lastMonth() ?></h1>
                  <div class="mb-1">
                    <span class="<?= $visitor->percent(CalendarEnum::Month) >= 0 ? 'text-success' : 'text-danger'; ?>">
                      <i class="mdi mdi-arrow-bottom-right"></i>
                      <?= $visitor->percent(CalendarEnum::Month) ?>&percnt;
                    </span>
                    <span class="text-muted">Since last Month</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 col-xxl-7">
        <div class="card flex-fill w-100">
          <div class="card-header">

            <h5 class="card-title mb-0">Visitor Last 28 Days</h5>
          </div>
          <div class="card-body py-3">
            <div class="chart chart-sm">
              <canvas id="chartjs-dashboard-line" data-values="<?= $visitor->visitorLast28Day() ?>"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-xxl-9 d-flex">
        <div class="card flex-fill">
          <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">Latest Posts</h5>
            <a href="posts">More</a>
          </div>
          <table class="table table-hover my-0">
            <thead>
              <tr>
                <th>Title</th>
                <th class="d-none d-xl-table-cell">Created Date</th>
                <th class="d-none d-md-table-cell">Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($posts->latest() as $post) : ?>
              <tr>
                <td><?= $post->title ? substr($post->title, 0, 20) . '...' : 'Null' ?></td>
                <td class="d-none d-xl-table-cell"><?= $post->created_at ?></td>
                <td class="d-none d-md-table-cell"><span class="badge bg-success">Enable</span></td>
                <td>
                  <a class="btn btn-danger btn-sm" href="#"><span class="d-sm-none">D</span><span
                      class="d-none d-sm-inline-block">Delete</span></a>
                  <a class="btn btn-info btn-sm" href="posts/<?= $post->id ?>"><span class="d-sm-none">U</span><span
                      class="d-none d-sm-inline-block">Update</span></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>

  </div>
</main>

<!-- Visitor last year -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
  var gradient = ctx.createLinearGradient(0, 0, 0, 225);
  gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
  gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
  let data = JSON.parse(document.getElementById("chartjs-dashboard-line").dataset.values);
  let labels = [];
  for (let i = 0; i < 28; i++) labels[i] = i + 1;
  // Line chart
  new Chart(document.getElementById("chartjs-dashboard-line"), {
    type: "line",
    data: {
      labels: labels,
      datasets: [{
        label: "Visitors",
        fill: true,
        backgroundColor: gradient,
        borderColor: window.theme.primary,
        data: data
      }]
    },
    options: {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        intersect: false
      },
      hover: {
        intersect: true
      },
      plugins: {
        filler: {
          propagate: false
        }
      },
      scales: {
        xAxes: [{
          reverse: true,
          gridLines: {
            color: "rgba(0,0,0,0.0)"
          }
        }],
        yAxes: [{
          ticks: {
            stepSize: Math.ceil(Math.max(...data) / 4)
          },
          display: true,
          borderDash: [3, 3],
          gridLines: {
            color: "rgba(0,0,0,0.0)"
          }
        }]
      }
    }
  });
});
</script>