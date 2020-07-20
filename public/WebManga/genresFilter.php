<?php include_once('header.php') ?>
<div class="container">
    <div aria-label="breadcrumb" class="mt-30">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Latest Manga</li>
        </ol>
    </div>

    <div>
        <ul id="genres" class="genres">
            <li><b>Genres</b></li>
            <li class="active">ALL</li>
            <li>Manga</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
            <li>Manhua</li>
        </ul> 
    </div>

    <div class="">
        <ul class="list-group">
            <?php for ($i=0; $i < 6; $i++): ?>
            <li class="list-group-item bg-transparent">
                    <h5 class="d-inline"><b>Latest Manga</b></h5>
                    <a href="" class="d-inline float-right">View All</a>
                    <hr/>
                    <div class="row">
                        <?php for ($i2=0; $i2 < 6; $i2++): ?>
                        <div class="col-md-2 mt-3">
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
                        <?php endfor; ?>
                    </div>
            </li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
<?php include_once('footer.php') ?>
