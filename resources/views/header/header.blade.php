<!DOCTYPE html>
<html lang="en">

<head>
    <title>Nicepay - One Step Checkout</title>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Checkout - One Step Checkout , Responsive Bootstrap 4 template , bootstrap 4 starter template, bootstrap4 template, checkout template">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" lang="en" content="Checkout Bootstrap 4 pricing template , Responsive and Modern HTML5 Template made from bootstrap 4.">
    <meta name="keywords" lang="en" content="pricing template, bootstrap 4 template,bootstrap 4 checkout template, responsive bootstrap 4 template, bootstrap 4, bootstraping, bootstrap4, oribitthemes">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <meta name="description" content="">
    <!--Font Awesome-->
    <link rel="stylesheet" href="dist/font-awesome/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <div class="loader"></div>
    <header id="header">
        <nav class="navbar navbar-expand-md navbar-light bg-light border-bottom">
            <div class="container">
                <a class="navbar-brand" href="#" id="header-logo">
                    <img src="img/online-shopping.png" alt="nicepay_logo" class="img-fluid" style="width: 45px; height:auto">
                </a>
                <a class="navbar-brand"> NICEPAY PAYMENTS DEMO</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link text-dark" id="checkout" href="#">CHECKOUT
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="checkStatus" href="#">CHECK STATUS</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" id="cancel" href="#">CANCEL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main id="main" role="main">
        
        <section id="checkout-container">
            <div class="container">
                <div class="row py-2">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="mb-3">Payment Methods</h4>

                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="cc" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="cc">Direct CC</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="va" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="va">Virtual Account</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="cvs" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="cvs">Convenience Store</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="ewallet" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="ewallet">Ewallet</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="payloan" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="payloan">Payloan</label>
                            </div>
                        </div>

                        <h4 class="mb-3">Bank or Mitra</h4>
                        <div class="d-block my-3">
                            <div class="input-group">
                                <input type="text" class="form-control">
                                
                            </div>
                        </div>

                       <!--  <div class="payment-methods">
                            <p class="mb-2">Payment Options</p>
                            <hr>
                            <ul class="list-inline d-flex">
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-visa"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-stripe"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-paypal"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-jcb"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-discover"></i>
                                </li>
                                <li class="mx-1 text-info">
                                    <i class="fa-2x fa fa-cc-amex"></i>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Data</h4>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="iMid">Merchant ID</label>
                                    <input type="text" class="form-control" id="iMid" placeholder="" value="">
                                </div>
                                <div class="col-md-9 mb-3">
                                    <label for="merchantKey">Merchant Key</label>
                                    <input type="text" class="form-control" id="merchantKey" placeholder="" value="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                <label for="referenceNo">Reference Number</label>
                                <div class="input-group">
                                    <!-- <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div> -->
                                    <input type="text" class="form-control" id="referenceNo" required>
                                </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="amount">Amount
                                       <!--  <span class="text-muted">(Optional)</span> -->
                                    </label>
                                    <input type="text" class="form-control" id="amount" value="50">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phoneNumber">Phone Number</label>
                                    <input type="text" class="form-control" id="phoneNumber" value="081234500000" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="billingName">Billing Name</label>
                                    <input type="text" class="form-control" id="billingName" value="John Doe">
                                </div>
                            </div>

                            <hr class="mb-4">
                            <button class="btn btn-nicepay btn-lg btn-block" type="submit">
                                <i class="fa fa-credit-card"></i>  Send Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <a href="#" class="btn btn-primary scrollUp">
            <i class="fa fa-arrow-circle-o-up"></i>
        </a>
    </main>
    <!-- Footer -->
   <!--  <footer id="footer">
        <p class="copyright">By
            <a target="_blank" title="Orbit Themes" href="http://www.orbitthemes.com">Yohanes D. Hariyanto</a> &copy;
            <span id="currentYear"></span> All Rights Reserved.
        </p>
        <div class="social">
            <a traget="_blank" href="https://facebook.com/orbitthemes" title="facebook">
                <i class="fa fa-facebook"></i>
            </a>
            <a traget="_blank" href="https://twitter.com/orbitthemes" title="twitter">
                <i class="fa fa-twitter"></i>
            </a>
            <a traget="_blank" href="https://plus.google.com/+orbitthemes" title="Google+" target="_blank">
                <i class="fa fa-google-plus"></i>
            </a>
            <a traget="_blank" href="https://github.com/orbitthemes" title="github" target="_blank">
                <i class="fa fa-github"></i>
            </a>
            <a traget="_blank" href="https://www.behance.net/orbitthemes" title="Behance" target="_blank">
                <i class="fa fa-behance"></i>
            </a>
            <a traget="_blank" href="https://dribbble.com/orbitthemes" title="Dribbble" target="_blank">
                <i class="fa fa-dribbble"></i>
            </a>
            <a traget="_blank" href="https://www.pinterest.com/orbitThemes/" title="Pinterest" target="_blank">
                <i class="fa fa-pinterest"></i>
            </a>
            <a traget="_blank" href="https://www.reddit.com/user/orbitthemes" title="Reddit" target="_blank">
                <i class="fa fa-reddit"></i>
            </a>
            <a traget="_blank" href="https://orbitthemes.com/blog/" title="RSS" target="_blank">
                <i class="fa fa-rss"></i>
            </a>
        </div>
    </footer> -->
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="dist/jquery/jquery.min.js"></script>
    <script src="dist/popper/popper.min.js" integrity=""></script>
    <script src="dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.min.js"></script>
</body>

</html>