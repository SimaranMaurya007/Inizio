<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Bootstrap Web Design</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class = "content"><!--body content holder-->
            <div class = "container">
                <div class = "col-md-12"><!--body content title holder with 12 grid columns-->
                    <h1>Contact Us</h1><!--body content title-->
                </div>
            </div>
			
            <div class="container">
            <div class="col-md-12">
            <hr>
            </div>
            </div>
            
            <div class="container">
                <div class="col-md-12 contacts text-center">
                    <h2><span class="glyphicon glyphicon-earphone"></span> Contact Information</h2>
                    <p>
                        <strong>Indian Institute of Information Technology, Allahabad (IIIT-Allahabad)</strong><br>
                        Devghat, Jhalwa, Prayagraj, Uttar Pradesh, India<br>
                        Email: info@iiita.ac.in<br>
                        Phone: +91-532-2922000<br>
                        Website: <a href="https://www.iiita.ac.in" target="_blank">www.iiita.ac.in</a>
                    </p>
                </div>
                <div class="col-md-6 contacts">
                    <form>
                        <div class="form-group">
                            <label for="Title">Title:</label>
                            <input type="text" name="title" id="Title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Message:</label>
                            <textarea id="Comment" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default pull-right">Send <span class="glyphicon glyphicon-send"></span></button>
                    </form>
                </div>
            </div>
            <div class="container">
            <div class="col-md-12">
            <hr>
            </div>
            </div>
            <?php require 'utils/footer.php'; ?>
            
        </div><!--body content div-->
        <!--footer content. file found in utils folder-->
    </body>
</html>
