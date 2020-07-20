<?php include_once('header.php') ?>
<div class="jumbotron text-center bannerHome" style="background-image: url('assets/img/bannerTop.jpg');">
  <h1 class="display-4 font-weight-bold">Top 10 Manga</h1>
  <p>All the latest release of your favorite</p>
</div>

<div class="container">
    <div class="card card-content mb-3">
        <div class="card-body">
            <div class="row konten p-30">
                <div class="col-md-9">
                    <div class="top">
                        <?php for ($i2=0; $i2 < 3; $i2++) : ?>
                        <table class="table table-responsive-sm">
                            <thead>
                                <th colspan="3" class="text-left">Top 10 Manga</th>
                                <th colspan="3" class="text-center">Latest Chapters</th>
                            </thead>
                            <tbody class="text-center">
                                <?php for ($i=0; $i < 10; $i++) : ?>
                                <tr>
                                    <td class="align-middle">
                                        <img class="rounded shadow" src="assets/img/top.jpg" alt="">
                                    </td>
                                    <td class="text-left align-middle">
                                        <p>Rebirth of the Urban Cultivato</p>
                                        <small>Latest Release 6 / 26 / 20</small>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-inline rating">4.5</div>
                                        <div class="d-inline text-warning"><i class="fas fa-star"></i></div>
                                        <div class="d-inline">Rating</div>
                                    </td>
                                    <td class="align-middle">980</td>
                                    <td class="align-middle">980</td>
                                    <td class="align-middle">981</td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="activity listGenres">
                        <h5 class="d-inline">Genres</h5>
                        <a href="" class="d-inline float-right">View All</a>
                        <ul class="mt-3 list-group">
                        <?php for ($i=0; $i < 30; $i++) : ?>
                            <li class="list-group-item">Genres</li>
                        <?php endfor; ?>
                        </ul>
                    </div>
                    <div class="mt-5 activity">
                        <h5 class="d-inline">Activity</h5>
                        <a href="" class="d-inline float-right">View All</a>
                        <table class="mt-3">
                        <?php for ($i=0; $i < 3; $i++) : ?>
                            <tr >
                                <td style="width: 30%; padding:0px;">
                                    <img class="rounded shadow" src="assets/img/activity.jpg" alt="">
                                </td>
                                <td>
                                    <h6>Reviewed, Liked, Added
                                        to Library & Rate</h6>
                                        <p>Black Clover</p>
                                        <div class="mt-n2">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                        </table>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header text-center text-white bg-dark">
                            Latest Discussions
                        </div>
                        <ul class="list-group list-group-flush latestDiscussions">
                            <?php for ($i=0; $i < 20; $i++) : ?>
                            <li class="list-group-item">
                                <h6>
                                        The Second Coming
                                </h6>
                                <p>1h, 5m ago</p>
                                <hr class="grey">
                            </li>
                            <?php endfor; ?>
                        </ul>
                        </div>
                        
                    </div>

            </div>
            
            
        </div>
    </div>

</div>
<?php include_once('footer.php') ?>