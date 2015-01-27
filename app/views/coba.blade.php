@extends('layoutUser')

@section('pageTitle')
	Coba
@stop

@section('addResource')
	    <script src="lib/jquery.isotope.min.js"></script>
    <link rel="stylesheet" href="stylesheets/isotope.css">
    <link rel="stylesheet" href="lib/fancy-zoom/css/fancyzoom.css" type="text/css" />
	<script type="text/javascript" src="lib/fancy-zoom/src/fancyzoom.js"></script>


	<script type="text/javascript" charset="utf-8">

        $(function(){
            var width = $(window).width();
            $(window).resize(function(){
                setTimeout(function(){
                    $('#blog-posts').isotope('reLayout');}, 100);
            });

			$('.blog-post .thumbnail img').fancyZoom({closeOnClick: true, directory:'lib/fancy-zoom/img/'});

            $('#blog-posts').imagesLoaded( function(){
                $(this).isotope({
                    resizable:false,
                    layoutMode: 'straightDown'
                });
            });

            fancyFilter('.filter', '#blog-posts');
        });

    </script>
@stop

@section('content')
    <h2>Name of the Blog</h2>

<ul class="filter nav nav-pills">
  <li class="active">
    <a href="#all" data-filter=".blog-post">All</a>
  </li>
  <li><a href="#images" data-filter=".sampleFilterOnetrue">Updates</a></li>
  <li><a href="#videos" data-filter=".sampleFilterTwotrue">News</a></li>
</ul>

<div id="blog-posts">

    
    

    <div class="row-fluid blog-post sampleFilterOnefalse sampleFilterTwofalse">
      <div class="span12">
        <h4><strong><a href="#">Title of the post</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="images/blog/442256_20337880.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.
                </p>
                <p><a class="btn btn-mini" href="#">Read more</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> by <a href="#">Ashley</a> 
            | <i class="icon-calendar"></i> January 16th, 2013
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | <i class="icon-tags"></i> Tags <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>
    

    <div class="row-fluid blog-post sampleFilterOnefalse sampleFilterTwofalse">
      <div class="span12">
        <h4><strong><a href="#">Title of the post</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="images/blog/472381_10949156.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.
                </p>
                <p><a class="btn btn-mini" href="#">Read more</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> by <a href="#">Ashley</a> 
            | <i class="icon-calendar"></i> January 16th, 2013
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | <i class="icon-tags"></i> Tags <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>
    

    <div class="row-fluid blog-post sampleFilterOnetrue sampleFilterTwofalse">
      <div class="span12">
        <h4><strong><a href="#">Title of the post</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="images/blog/503993_62595320.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.
                </p>
                <p><a class="btn btn-mini" href="#">Read more</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> by <a href="#">Ashley</a> 
            | <i class="icon-calendar"></i> January 16th, 2013
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | <i class="icon-tags"></i> Tags <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>
    

    <div class="row-fluid blog-post sampleFilterOnefalse sampleFilterTwofalse">
      <div class="span12">
        <h4><strong><a href="#">Title of the post</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="images/blog/625998_12886207.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.
                </p>
                <p><a class="btn btn-mini" href="#">Read more</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> by <a href="#">Ashley</a> 
            | <i class="icon-calendar"></i> January 16th, 2013
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | <i class="icon-tags"></i> Tags <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>
    

    <div class="row-fluid blog-post sampleFilterOnetrue sampleFilterTwotrue">
      <div class="span12">
        <h4><strong><a href="#">Title of the post</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="images/blog/737034_24905666.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.
                </p>
                <p><a class="btn btn-mini" href="#">Read more</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> by <a href="#">Ashley</a> 
            | <i class="icon-calendar"></i> January 16th, 2013
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | <i class="icon-tags"></i> Tags <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>
    

    <div class="row-fluid blog-post sampleFilterOnefalse sampleFilterTwotrue">
      <div class="span12">
        <h4><strong><a href="#">Title of the post</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="images/blog/789080_16753532.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.
                </p>
                <p><a class="btn btn-mini" href="#">Read more</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> by <a href="#">Ashley</a> 
            | <i class="icon-calendar"></i> January 16th, 2013
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | <i class="icon-tags"></i> Tags <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>
    

    <div class="row-fluid blog-post sampleFilterOnetrue sampleFilterTwotrue">
      <div class="span12">
        <h4><strong><a href="#">Title of the post</a></strong></h4>
        <div class="row-fluid">
            <a href="#" class="thumbnail pull-left">
                <img src="images/blog/888272_30368604.jpg" alt="">
            </a>
            <div class="post-summary">      
                <p>
                  Lorem ipsum dolor sit amet, id nec conceptam conclusionemque. Et eam tation option. Utinam salutatus ex eum. Ne mea dicit tibique facilisi, ea mei omittam explicari conclusionemque, ad nobis propriae quaerendum sea.
                </p>
                <p><a class="btn btn-mini" href="#">Read more</a></p>
            </div>
        </div>
        <div class="row-fluid details">
            <i class="icon-user"></i> by <a href="#">Ashley</a> 
            | <i class="icon-calendar"></i> January 16th, 2013
            | <i class="icon-comment"></i> <a href="#">3 Comments</a>
            | <i class="icon-share"></i> <a href="#">39 Shares</a>
            | <i class="icon-tags"></i> Tags <a href="#"><span class="label label-info">Official</span></a> 
            <a href="#"><span class="label label-info">Announcements</span></a> 
            <a href="#"><span class="label label-info">News</span></a> 
            <a href="#"><span class="label label-info">New Features</span></a>
        </div>
      </div>
    </div>
    
    
</div>
@stop