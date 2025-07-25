<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Bootstrap Web Design</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php $showHeroSection = false; require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class="content"><!--body content holder-->
            <div class="container">
                <div class="col-md-12"><!--body content title holder with 12 grid columns-->
                    <h1>Past Locations</h1><!--body content title-->
                </div>
            </div>
			
            <div class="container">
            <div class="col-md-12">
            <hr>
            </div>
            </div>
			
            <div class="row"><!--location content -->
                <section>
                    <div class="container">
                        <div class="col-md-4"><!--image holder with 4 grid column-->
                            <img src="images/allahabad.png" class="img-responsive" style="height:300px ; width:400px;">
                        </div>
                        <div class="subcontent col-md-8"><!--location non modal content -->
                            <h1 class="title">Indian Institute of Information Technology Allahabad</h1><!--location title-->
                            <p class="location"><!--location secondary content-->
                            Allahabad, India
                            </p>
                            <p class="definition"><!--content body-->
                            Indian Institute of Information Technology Allahabad (IIIT-A) is a premier institute known for its excellence in education and research in the field of information technology.
                            </p>
                            
                        </div><!--subcontent div-->
                    </div><!--container div-->
                </section>
            </div><!--row div-->
			
            <div class="container">
            <div class="col-md-12">
            <hr>
            </div>
            </div>

            <div class="row"><!--location content -->
                <section>
                    <div class="container">
                        <div class="col-md-4"><!--image holder with 4 grid column-->
                            <img src="images/roorkee.png" class="img-responsive" style="height:300px ; width:400px;">
                        </div>
                        <div class="subcontent col-md-8"><!--location non modal content -->
                            <h1 class="title">Indian Institute of Technology Roorkee</h1><!--location title-->
                            <p class="location"><!--location secondary content-->
                            Roorkee, India
                            </p>
                            <p class="definition"><!--content body-->
                            Indian Institute of Information Technology Roorkee (IIT-R) is an esteemed institute focusing on information technology education and research, contributing significantly to the technological landscape of India.
                            </p>
                            
                        </div><!--subcontent div-->
                    </div><!--container div-->
                </section>
            </div><!--row div-->

            <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
            </div>

            <div class="row"><!--location content -->
                <section>
                    <div class="container">
                        <div class="col-md-4"><!--image holder with 4 grid column-->
                            <img src="images/cricket.jpg" class="img-responsive" style="height:300px ; width:400px;">
                        </div>
                        <div class="subcontent col-md-8"><!--location non modal content -->
                            <h1 class="title">Khalsa Ground Punjab</h1><!--location title-->
                            <p class="location"><!--location secondary content-->
                            Punjab, India
                            </p>
                            <p class="definition"><!--content body-->
                            Khalsa Ground in Punjab is a renowned venue known for hosting various events, including cultural programs, sports tournaments, and community gatherings.
                            </p>
                          
                        </div><!--subcontent div-->
                    </div><!--container div-->
                </section>
            </div><!--row div-->

            <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <?php require 'utils/footer.php'; ?>
        </div>
        
    </body>
</html>

