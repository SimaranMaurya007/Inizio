<?php
require_once 'utils/functions.php';
start_session();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Bootstrap Web Design</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
    <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
</head>

<body>
    <?php $showHeroSection = true; require 'utils/header.php'; ?><!--header content. file found in utils folder-->
    <div class="content"><!--body content holder-->
        <div class="container">
            <div class="col-md-12"><!--body content title holder with 12 grid columns-->
                <h1>Ongoing events</h1><!--body content title-->
            </div>
        </div>

        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row"><!--wedding content-->
            <section>
                <div class="container">
                    <div class="col-md-6"><!--image holder with 6 grid columns-->
                        <img src="images/concert2.jpg" class="img-responsive">
                    </div>
                    <div class="subcontent col-md-6"><!--Text holder with 6 column grid-->
                        <h1>Concert</h1><!--title-->
                        <p><!--content-->
                            Concert Vibes: Feel the Music, Live the Moment
                            Guaranteeing personalized solutions and flawless execution, our venues provide the perfect
                            location for your day.
                        </p>
                        <hr class="customline"><!--css modified horizontal line-->
                        <button type="button"
                            class="btn btn-default btn-lg"
                            onclick="window.location.href='events2.php';"><!--view event button (no function implemented)-->
                            View Events <span class="glyphicon glyphicon-arrow-right"
                                aria-hidden="true"></span><!--arrow right glyphicon-->
                        </button>
                    </div><!--subcontent div-->
                </div><!--container div-->
            </section>
        </div><!--row div-->

        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <section>
                <div class="container">
                    <div class="col-md-6"><!--image holder with 6 grid columns-->
                        <img src="images/college_evenr.jpg" class="img-responsive">
                    </div>
                    <div class="subcontent col-md-6"><!--Text holder with 6 column grid-->
                        <h1>College Event</h1><!--title-->
                        <p><!--content-->
                            Whether an all-day or the ultimate extravaganza that
                            lasts well into the wee hours, our team is here to make sure that your day
                            should not miss the college fun.
                        </p>
                        <hr class="customline"><!--css modified horizontal line-->
                        <button type="button"
                            class="btn btn-default btn-lg"
                            onclick="window.location.href='events2.php';"><!--view event button (no function implemented)-->
                            View Events <span class="glyphicon glyphicon-arrow-right"
                                aria-hidden="true"></span><!--arrow right glyphicon-->
                        </button>
                    </div><!--subcontent div-->
                </div><!--container div-->
            </section>
        </div><!--row div-->

        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <section>
                <div class="container">
                    <div class="col-md-6"><!--image holder with 6 grid columns-->
                        <img src="images/fashionn.jpg" class="img-responsive">
                    </div>
                    <div class="subcontent col-md-6"><!--Text holder with 6 column grid-->
                        <h1>Fashion</h1><!--title-->
                        <p><!--content-->
                            Fast becoming to go-to location for fashion events, PR gatherings and product launches,
                            The Urban Purveyor Group venues provide you with choice and quality in premium locations
                            for all your event needs.
                        </p>
                        <hr class="customline"><!--css modified horizontal line-->
                        <button type="button"
                            class="btn btn-default btn-lg"
                            onclick="window.location.href='events2.php';"><!--view event button (no function implemented)-->
                            View Events <span class="glyphicon glyphicon-arrow-right"
                                aria-hidden="true"></span><!--arrow right glyphicon-->
                        </button>
                    </div><!--subcontent div-->
                </div><!--container div-->
            </section>
        </div><!--row div-->

        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <section>
                <div class="container">
                    <div class="col-md-6"><!--image holder with 6 grid columns-->
                        <img src="images/cosplay.jpg" class="img-responsive">
                    </div>
                    <div class="subcontent col-md-6"><!--Text holder with 6 column grid-->
                        <h1>Cosplay</h1><!--title-->
                        <p><!--content-->
                            Transform Yourself, Embrace the Fantasy: Cosplay Your World, our flexible event
                            spaces can cater to your every need for meetings and conferences large or small, and our
                            dedicated event team can assist with all aspects of your event planning.
                        </p>
                        <hr class="customline"><!--css modified horizontal line-->
                        <button type="button"
                            class="btn btn-default btn-lg"
                            onclick="window.location.href='events2.php';"><!--view event button (no function implemented)-->
                            View Events <span class="glyphicon glyphicon-arrow-right"
                                aria-hidden="true"></span><!--arrow right glyphicon-->
                        </button>
                    </div><!--subcontent div-->
                </div><!--container div-->
            </section>
        </div><!--row div-->
        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <section>
                <div class="container">
                    <div class="col-md-6"><!--image holder with 6 grid columns-->
                        <img src="images/music_festival.jpg" class="img-responsive">
                    </div>
                    <div class="subcontent col-md-6"><!--Text holder with 6 column grid-->
                        <h1>Music Festival</h1><!--title-->
                        <p><!--content-->
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem asperiores animi
                            facere cum aliquid optio perferendis non? Et, rem sint?Z
                        </p>
                        <hr class="customline"><!--css modified horizontal line-->
                        <button type="button"
                        
                            class="btn btn-default btn-lg"
                            onclick="window.location.href='events2.php';" ><!--view event button (no function implemented)-->
                            View Events <span class="glyphicon glyphicon-arrow-right"
                                aria-hidden="true"></span><!--arrow right glyphicon-->
                        </button>
                    </div><!--subcontent div-->
                </div><!--container div-->
            </section>
        </div><!--row div-->

        


        <div class="gallery">
    <img src="images/concert1.jpg" alt="">
    <img src="images/moments1.jpg" alt="">
    <img src="images/moments2.jpg" alt="">
    <img src="images/moments3.jpg" alt="">
    <img src="images/moments4.jpg" alt="">
    <img src="images/moments5.jpg" alt="">
    <img src="images/moments6.jpg" alt="">
    <img src="images/moments7.jpg" alt="">
 </div>

 <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <?php require 'utils/footer.php'; ?>






    <!--body content div-->
</body>

</html>