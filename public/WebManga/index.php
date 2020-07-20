<?php include_once('header.php') ?>
<div class="jumbotron text-center bannerHome" style="background-image: url('assets/img/bannerHome.jpg');">
  <h1 class="display-4 font-weight-bold">Latest Manga Release</h1>
  <p>All the latest release of your favorite
      <br>
    Comics in One Piece </p>
</div>

<div class="container">
    <div class="card card-content mb-3">
        <div class="card-body">
            <div class="row konten p-30">
                <div class="col-md-9">
                    <h5>TOP 20 MANGA</h5>
                    <hr/>

                    <table class="table borderless table-responsive-sm">
                        <thead>
                            <th colspan="3" class="text-left">Top 20</th>
                            <th colspan="3" class="text-center">Latest Chapters</th>
                        </thead>
                        <tbody class="text-center">
                            <?php $no = 0 ;
                            for ($i=0; $i < 20; $i++) : ?>
                            <tr>
                                <td class="align-middle"><?= $no++ < 9 ? '0'.$no : $no ?></td>
                                <td class="align-middle">
                                    <img class="rounded shadow" src="assets/img/comics.jpg" alt="">
                                </td>
                                <td class="text-left">
                                    <p>Rebirth of the Urban <span class="badge badge-danger">HOT</span>
                                    <br> Cultivato</p>
                                    <small>Latest Release 6 / 26 / 20</small>
                                </td>
                                <td class="align-middle">980</td>
                                <td class="align-middle">980</td>
                                <td class="align-middle">981</td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <div class="card">
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
                    </div>

            </div>
            
            
        </div>
    </div>

    <div class="konten mt-5">
        <h5 class="d-inline">Other Manga Release</h5>
        <a href="" class="d-inline float-right">View All</a>
        <hr/>
        <div class="row">
            <?php for ($i=0; $i < 6; $i++) : ?>
            <div class="col-md-4 p-1 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-6" >
                                <img class="rounded shadow" src="assets/img/manga.jpg" alt="">
                            </div>
                            <div class="col-6">

                                <div class="btn btn-danger category">MANGA</div>
                                <p class="titleManga mt-15">Latest Rebirth of
                                    the Urban Cultivato
                                    Release</p>
                                <div class="lastChapter">
                                    <div class="d-inline">198</div>
                                    <div class="d-inline">198</div>
                                    <div class="d-inline">197</div>
                                </div>
                                <div class="mt-15">
                                    <div class="d-inline rating">4.5</div>
                                    <div class="d-inline text-warning"><i class="fas fa-star"></i></div>
                                    <div class="d-inline">Rating</div>
                                </div>
                                <p class="lastUpdate">Updated 6 / 26 / 20</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="konten mt-5">
        <h5 class="d-inline">Manhua Release</h5>
        <a href="" class="d-inline float-right">View All</a>
        <hr/>
        <div class="row">
            <?php for ($i=0; $i < 6; $i++) : ?>
            <div class="col-md-4 p-1 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6" >
                                <img class="rounded shadow" src="assets/img/manhua.jpg" alt="">
                            </div>
                            <div class="col-6">

                                <div class="btn btn-warning category">MANHUA</div>
                                <p class="titleManga mt-15">Release That Witch</p>
                                <div class="lastChapter">
                                    <div class="d-inline">198</div>
                                    <div class="d-inline">198</div>
                                    <div class="d-inline">197</div>
                                </div>
                                <div class="mt-15">
                                    <div class="d-inline rating">4.5</div>
                                    <div class="d-inline text-warning"><i class="fas fa-star"></i></div>
                                    <div class="d-inline">Rating</div>
                                </div>
                                <p class="lastUpdate">Updated 6 / 26 / 20</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="konten mt-5">
        <h5 class="d-inline">Manhwa Release</h5>
        <a href="" class="d-inline float-right">View All</a>
        <hr/>
        <div class="row">
            <?php for ($i=0; $i < 6; $i++) : ?>
            <div class="col-md-4 p-1 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6" >
                                <img class="rounded shadow" src="assets/img/manhwa.jpg" alt="">
                            </div>
                            <div class="col-6">

                                <div class="btn btn-success category">MANHWA</div>
                                <p class="titleManga mt-15">Ao Haru Ride Vol. 11</p>
                                <div class="lastChapter">
                                    <div class="d-inline">198</div>
                                    <div class="d-inline">198</div>
                                    <div class="d-inline">197</div>
                                </div>
                                <div class="mt-15">
                                    <div class="d-inline rating">4.5</div>
                                    <div class="d-inline text-warning"><i class="fas fa-star"></i></div>
                                    <div class="d-inline">Rating</div>
                                </div>
                                <p class="lastUpdate">Updated 6 / 26 / 20</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php include_once('footer.php') ?>