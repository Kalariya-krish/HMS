<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Dashboard</title>
</head>

<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <!-- Main Panel -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <!-- Tab Navigation -->
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <!-- <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Audiences</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
                                        </li>
                                    </ul> -->
                                    <div>
                                        <!-- <div class="btn-wrapper">
                                            <a href="#" class="btn btn-outline-dark align-items-center">
                                                <i class="icon-share"></i> Share
                                            </a>
                                            <a href="#" class="btn btn-outline-dark">
                                                <i class="icon-printer"></i> Print
                                            </a>
                                            <a href="#" class="btn btn-primary text-white me-0">
                                                <i class="icon-download"></i> Export
                                            </a>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Tab Content -->
                                <div class="tab-content tab-content-basic">
                                    <div class="row">
                                        <!-- Card 1 -->
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-margin stretch-card">
                                            <div class="card bg-primary card-rounded">
                                                <div class="card-body pb-0">
                                                    <h4 class="card-title card-title-dash text-white mb-4">Rooms</h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <!-- <p class="status-summary-light-white mb-1">Closed Value</p> -->
                                                            <h2 class="text-info">20</h2>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="status-summary-chart-wrapper pb-4">
                                                                <canvas id="status-summary-1" width="240" height="99"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card 2 -->
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-margin stretch-card">
                                            <div class="card bg-primary card-rounded">
                                                <div class="card-body pb-0">
                                                    <h4 class="card-title card-title-dash text-white mb-4">Bookings</h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <!-- <p class="status-summary-light-white mb-1">Closed Value</p> -->
                                                            <h2 class="text-info">10</h2>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="status-summary-chart-wrapper pb-4">
                                                                <canvas id="status-summary-2" width="240" height="99"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card 3 -->
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 grid-margin stretch-card">
                                            <div class="card bg-primary card-rounded">
                                                <div class="card-body pb-0">
                                                    <h4 class="card-title card-title-dash text-white mb-4">Reviews</h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <!-- <p class="status-summary-light-white mb-1">Closed Value</p> -->
                                                            <h2 class="text-info">20</h2>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="status-summary-chart-wrapper pb-4">
                                                                <canvas id="status-summary-3" width="240" height="99"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Overview Tab -->
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <!-- Add content for Overview here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>