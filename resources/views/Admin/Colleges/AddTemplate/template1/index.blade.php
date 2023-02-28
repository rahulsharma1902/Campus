@extends('Public.index')
@section('content')
<style>
/* Slider */
.carousel-item {
  height: 100vh;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
}

</style>
<div class="container-fluid">
    <!-- Just an image -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark text-dark fixed-tops" style="margin-top:-3rem;">
  <a class="navbar-brand" href="#">College Name</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">About <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Address</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
    </div>
</nav>
<!-- Slider -->
<section class="slider-section">
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
		</ol> <!-- End of Indicators -->

		<!-- Carousel Content -->
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active" style="background-image: url('https://cdn.pixabay.com/photo/2020/04/03/15/27/flower-meadow-4999277_960_720.jpg');">
				<div class="carousel-caption d-none d-md-block">
					<h3>Amazon Forest</h3>
					<p>Cool description for Amazon Forest.</p>
				</div>
			</div> <!-- End of Carousel Item -->

			<div class="carousel-item" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg');">
				<div class="carousel-caption d-none d-md-block">
					<h3>Bridge Picture</h3>
					<p>Awesome description for bridge.</p>
				</div>
			</div> <!-- End of Carousel Item -->

			<div class="carousel-item" style="background-image: url('https://cdn.pixabay.com/photo/2015/04/23/21/59/tree-736875_960_720.jpg');">
				<div class="carousel-caption d-none d-md-block">
					<h3>Flowers & Grass</h3>
					<p>Beauty of Flowers & Grass.</p>
				</div>
			</div> <!-- End of Carousel Item -->
		</div> <!-- End of Carousel Content -->

		<!-- Previous & Next -->
		<a href="#carousel" class="carousel-control-prev" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
			<span class="sr-only"></span>
		</a>
		<a href="#carousel" class="carousel-control-next" role="button" data-slide="next">
			<span class="carousel-control-next-icon  bg-dark" aria-hidden="true"></span>
			<span class="sr-only"></span>
		</a>
	</div> <!-- End of Carousel -->
</section> <!-- End of Slider -->

@endsection