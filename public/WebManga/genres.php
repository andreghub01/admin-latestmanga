<?php include_once('header.php') ?>
<div class="jumbotron text-center bannerHome" style="background-image: url('assets/img/bannerGenres.jpg');">
  <!-- <h1 class="display-4 font-weight-bold">Latest Manga Release</h1>
  <p>All the latest release of your favorite
      <br>
    Comics in One Piece </p> -->
</div>

<div class="container">
    <div class="card card-content mb-3">
        <div class="card-body">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </div>
            <div class="row konten p-30">
                <div class="col-md-9">
                    <?php for ($i2=0; $i2 < 3; $i2++) : ?>
                    <div class="mb-5">
                        <h5 class="d-inline"><b>Latest Manga</b></h5>
                        <a href="" class="d-inline float-right">View All</a>
                        <hr/>
                        <div id="listScrollHorizontal">

                            <ul >
                                <?php for ($i=0; $i < 8; $i++) : ?>
                                <li>
                                    <div class="card-body">
                                    <img src="assets/img/one-piece.jpg" alt="" class="rounded shadow img-fluid" >
                                    <p class="titleManga mt-1">Rebirth of the Urban Cultivato</p>
                                    <p class="lastUpdate">Updated 6 / 26 / 20</p>
        
                                    <div class="lastChapter" style="font-size: 14px;">
                                        <div class="d-inline">Chapter</div>
                                        <div class="d-inline">198</div>
                                        <div class="d-inline">198</div>
                                        <div class="d-inline">197</div>
                                    </div>
                                    <hr class="grey">
                                    <div class="mt-15">
                                        <div class="d-inline rating">4.5</div>
                                        <div class="d-inline text-warning"><i class="fas fa-star"></i></div>
                                        <div class="d-inline">Rating</div>
                                    </div>
                                    </div>
                                </li>
                                <?php endfor; ?>
        
                            </ul>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center text-white bg-dark">
                            Last 10 Manga
                        </div>
                        <ul class="list-group list-group-flush latestDiscussions">
                            <?php for ($i=0; $i < 10; $i++) : ?>
                            <li class="list-group-item">
                                <h6>
                                        Latest Manga 2020
                                </h6>
                                <p>1h, 5m ago</p>
                                <hr class="grey">
                            </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                    <div class="activity listGenres mt-5">
                        <h5 class="d-inline">Genres</h5>
                        <a href="" class="d-inline float-right">View All</a>
                        <ul class="mt-3 list-group">
                        <?php for ($i=0; $i < 10; $i++) : ?>
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
                    
                        
                </div>

            </div>
            
            
        </div>
    </div>

</div>
<?php include_once('footer.php') ?>