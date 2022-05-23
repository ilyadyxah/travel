
@extends('layouts.main')
@section('title')
    @parent Главная
@endsection
@section('header')

@endsection
@section('content')
    <div class='intro'>
        <div class='intro__inner'>
            <h1>Исследуй и путешествуй</h1>
            @include('components.filter')
        </div>
        <div class='intro_img_box'>
            <img class='intro_img' src="{{ asset('images/thousand-01.png') }}" alt="img" />
        </div>
    </div>
    <div class="row g-4 container">

        @foreach($places as $place)
            <div class="col-4">
                <a class="card bg-dark text-white">
                    <img class='card-img' src="{{ $images->find($place->main_picture_id)->url }}" alt="{{ $place->title }}"/>
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{Str::ucfirst($place->title)}}</h5>
                        <p class="card-text">{{ $place->description }}</p>
                        <p class="card-text"> расстояние от города {{ $place->distance }}</p>
                    </div>
                </a>
                <span like="{{$place->id}}" onclick="likeHandle(this)">
                    @if(in_array($place->id, $likes))
                        <i class="fa-star fa-solid"></i>
                    @else
                        <i class="fa-star fa-regular"></i>
                    @endif
                </span>

                <span id="like-{{$place->id}}" class="">{{ $place->likes->count() === 0 ? '' : $place->likes->count() }}</span>
                @auth
{{--                    @dd($favorites)--}}
                    <span favorite="{{$place->id}}" id="favorite-{{ $place->id }}" onclick="favoriteHandle(this)">
                        @if(in_array($place->id, $favorites))
                            <i class="fa-solid fa-thumbs-up"></i>
                        @else
                            <i class="fa-regular fa-thumbs-up"></i>
                        @endif
                    </span>
                @endauth

            </div>

        @endforeach
    </div>
    <div class="section secondary-section " id="portfolio">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Have You Seen our Works?</h1>
                <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
            </div>
            <ul class="nav nav-pills">
                <li class="filter" data-filter="all">
                    <a href="#noAction">All</a>
                </li>
                <li class="filter" data-filter="web">
                    <a href="#noAction">Web</a>
                </li>
                <li class="filter" data-filter="photo">
                    <a href="#noAction">Photo</a>
                </li>
                <li class="filter" data-filter="identity">
                    <a href="#noAction">Identity</a>
                </li>
            </ul>
            <!-- Start details for portfolio project 1 -->
            <div id="single-project">
                <div id="slidingDiv" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio01.png" alt="project 1" />
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>Believe in yourself! Have faith in your abilities! Without a humble but reasonable confidence in your own powers you cannot be successful or happy.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 1 -->
                <!-- Start details for portfolio project 2 -->
                <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio02.png" alt="project 2">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>Life is a song - sing it. Life is a game - play it. Life is a challenge - meet it. Life is a dream - realize it. Life is a sacrifice - offer it. Life is love - enjoy it.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 2 -->
                <!-- Start details for portfolio project 3 -->
                <div id="slidingDiv2" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio03.png" alt="project 3">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>How far you go in life depends on your being tender with the young, compassionate with the aged, sympathetic with the striving and tolerant of the weak and strong. Because someday in your life you will have been all of these.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 3 -->
                <!-- Start details for portfolio project 4 -->
                <div id="slidingDiv3" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio04.png" alt="project 4">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Project for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>Life's but a walking shadow, a poor player, that struts and frets his hour upon the stage, and then is heard no more; it is a tale told by an idiot, full of sound and fury, signifying nothing.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 4 -->
                <!-- Start details for portfolio project 5 -->
                <div id="slidingDiv4" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio05.png" alt="project 5">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>We need to give each other the space to grow, to be ourselves, to exercise our diversity. We need to give each other space so that we may both give and receive such beautiful things as ideas, openness, dignity, joy, healing, and inclusion.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 5 -->
                <!-- Start details for portfolio project 6 -->
                <div id="slidingDiv5" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio06.png" alt="project 6">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>I went to the woods because I wished to live deliberately, to front only the essential facts of life, and see if I could not learn what it had to teach, and not, when I came to die, discover that I had not lived.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 6 -->
                <!-- Start details for portfolio project 7 -->
                <div id="slidingDiv6" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio07.png" alt="project 7">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>Always continue the climb. It is possible for you to do whatever you choose, if you first get to know who you are and are willing to work with a power that is greater than ourselves to do it.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 7 -->
                <!-- Start details for portfolio project 8 -->
                <div id="slidingDiv7" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio08.png" alt="project 8">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>What if you gave someone a gift, and they neglected to thank you for it - would you be likely to give them another? Life is the same way. In order to attract more of the blessings that life has to offer, you must truly appreciate what you already have.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 8 -->
                <!-- Start details for portfolio project 9 -->
                <div id="slidingDiv8" class="toggleDiv row-fluid single-project">
                    <div class="span6">
                        <img src="images/Portfolio09.png" alt="project 9">
                    </div>
                    <div class="span6">
                        <div class="project-description">
                            <div class="project-title clearfix">
                                <h3>Webste for Some Client</h3>
                                <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                            </div>
                            <div class="project-info">
                                <div>
                                    <span>Client</span>Some Client Name</div>
                                <div>
                                    <span>Date</span>July 2013</div>
                                <div>
                                    <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                <div>
                                    <span>Link</span>http://examplecomp.com</div>
                            </div>
                            <p>I learned that we can do anything, but we can't do everything... at least not at the same time. So think of your priorities not in terms of what activities you do, but when you do them. Timing is everything.</p>
                        </div>
                    </div>
                </div>
                <!-- End details for portfolio project 9 -->
                <ul id="portfolio-grid" class="thumbnails row">
                    <li class="span4 mix web">
                        <div class="thumbnail">
                            <img src="images/Portfolio01.png" alt="project 1">
                            <a href="#single-project" class="more show_hide" rel="#slidingDiv">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix photo">
                        <div class="thumbnail">
                            <img src="images/Portfolio02.png" alt="project 2">
                            <a href="#single-project" class="show_hide more" rel="#slidingDiv1">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix identity">
                        <div class="thumbnail">
                            <img src="images/Portfolio03.png" alt="project 3">
                            <a href="#single-project" class="more show_hide" rel="#slidingDiv2">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix web">
                        <div class="thumbnail">
                            <img src="images/Portfolio04.png" alt="project 4">
                            <a href="#single-project" class="show_hide more" rel="#slidingDiv3">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix photo">
                        <div class="thumbnail">
                            <img src="images/Portfolio05.png" alt="project 5">
                            <a href="#single-project" class="show_hide more" rel="#slidingDiv4">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix identity">
                        <div class="thumbnail">
                            <img src="images/Portfolio06.png" alt="project 6">
                            <a href="#single-project" class="show_hide more" rel="#slidingDiv5">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix web">
                        <div class="thumbnail">
                            <img src="images/Portfolio07.png" alt="project 7" />
                            <a href="#single-project" class="show_hide more" rel="#slidingDiv6">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix photo">
                        <div class="thumbnail">
                            <img src="images/Portfolio08.png" alt="project 8">
                            <a href="#single-project" class="show_hide more" rel="#slidingDiv7">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                    <li class="span4 mix identity">
                        <div class="thumbnail">
                            <img src="images/Portfolio09.png" alt="project 9">
                            <a href="#single-project" class="show_hide more" rel="#slidingDiv8">
                                <i class="icon-plus"></i>
                            </a>
                            <h3>Thumbnail label</h3>
                            <p>Thumbnail caption...</p>
                            <div class="mask"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>

    @endpush
@endonce
