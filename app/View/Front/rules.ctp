<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="section-title page-title">
                    <h3 class="small-title">Rules</h3>
                </div><!-- end text-widget -->
            </div><!-- end col -->
        </div>
    </div>
</div>
<div class="section lb">
    <div class="container">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs text-center" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">INFLUENCER</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">BRAND & ORGANIZATION</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <?php
                    echo $current_award['Award']['influencer_rules'];
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <?php
                    echo $current_award['Award']['brands_rules'];
                    ?>
                </div>
            </div>

        </div>
    </div><!-- end container -->
</div><!-- end section -->
<style>
    .blog-list a {
        display: block;
        text-align: center;
    }
    .blog-list h4 {
        border-bottom: 1px solid #f7f6f6;
        padding-bottom: 30px;
        margin-bottom: 30px;
        font-size: 29px;
    }
    .nav-tabs > li {
        float: none;
        margin-bottom: -1px;
        display: inline-block;
    }
    ul.nav.nav-tabs.text-center {
        border: none;
        margin-bottom: 15px;
    }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: none;
        padding: 10px 34px;
        border-bottom-color: transparent;
        border-radius: 3px !important;
    }
    .tab-pane {
        background: #fff;
        padding: 30px;
        font-weight: normal !important;
        line-height: 2;
    }
</style>