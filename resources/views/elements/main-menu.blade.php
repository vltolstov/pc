<div class="main-menu hide">
    <div class="container main-menu-container">
        <div class="main-menu-catalog hide">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left-submenu">
                        @foreach($mainMenu['catalog-items'] as $item)
                            @if($item->parent_id == 2)
                                <a href="{{$item->urn}}" data-item-id="{{$item->id}}">{{$item['name']}}</a>
                            @endif
                        @endforeach
                    </div>
                </div>

                @foreach($mainMenu['catalog-items'] as $item)
                    @if($item->parent_id == 2)

                        <div class="col-lg-9 right-submenu-flex menu-id-{{$item->id}} hide">
                            @foreach($mainMenu['catalog-items'] as $subMenuItem)
                                @if($subMenuItem->parent_id == $item->id)
                                    <div class="right-submenu">
                                        <a href="{{$subMenuItem->urn}}" class="right-submenu-header">{{$subMenuItem->name}}</a>
                                            <div class="right-submenu-items">
                                            @foreach($mainMenu['catalog-items'] as $endItem)
                                                @if($endItem->parent_id == $subMenuItem->id)
                                                    <a href="{{$endItem->urn}}">{{$endItem->name}}</a>
                                                @endif
                                            @endforeach
                                            </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    @endif
                @endforeach

            </div>
        </div>
        <div class="main-menu-engineering hide">
            <div class="row engineering-flex">
                @foreach($mainMenu['menu-engineering'] as $item)
                <div class="col-lg-4">
                    <a href="{{$item->urn}}" style="background-image: url('/images/default-200x150.png')">{{$item->name}}</a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="main-menu-portfolio hide">
            <div class="row">
                <div class="col-lg-4">
                    <div class="main-menu-portfolio-left">
                        <p class="main-menu-portfolio-header">Проекты и завершенные работы</p>
                        <p class="main-menu-portfolio-intro">Поставки и запуски оборудования, литейных комплексов, металлургических производств и линий. Более 500 проектов в стадии завершен на 100%.</p>
                        <a class="main-menu-portfolio-link" href="/portfolio">Посмотреть все проекты</a>
                        <p class="main-menu-portfolio-header">Наше оборудование в городах</p>
                        <ul class="portfolio-cities">
                            <li>Москва</li>
                            <li>Санкт-Петербург</li>
                            <li>Новосибирск</li>
                            <li>Екатерибург</li>
                            <li>Пенза</li>
                            <li>Нижний новгород</li>
                            <li>Челябинск</li>
                            <li>Барнаул</li>
                            <li>Кемерово</li>
                            <li>Магнитогорск</li>
                            <li>красноярск</li>
                            <li>краснодар</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="main-menu-projects-block">
                        <div class="row">
                            @foreach($mainMenu['menu-projects'] as $project)
                                <div class="col-lg-3">
                                    <div class="main-menu-project-image">
                                        @if(isset($project->image))
                                            <img src="{{json_decode($project->image, true)['image-1']['200x150']}}" alt="{{$project->name}}">
                                        @else
                                            <img src="/images/default-200x150.png" alt=" ">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="main-menu-projects-link">
                            <a href="/portfolio">Посмотреть все проекты</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu-company hide">
            <div class="row">
                <div class="col-lg-4">
                    <div class="main-menu-company-block">
                        <p class="main-menu-company-header">{{$mainMenu['menu-about-company']->name}}</p>
                        <p class="main-menu-company-intro">{{$mainMenu['menu-about-company']->introtext}}</p>
                        <a href="{{$mainMenu['menu-about-company']->urn}}" class="main-menu-company-link">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-menu-company-block">
                        <p class="main-menu-company-header">{{$mainMenu['menu-serts']->name}}</p>
                        <p class="main-menu-company-mini-header">дилерство, качество и соответсвие</p>
                        <div class="row">
                            <div class="col-lg-3 main-menu-sert">
                                <img src="/images/ros-test.png" alt=" ">
                            </div>
                            <div class="col-lg-3 main-menu-sert">
                                <img src="/images/eac.png" alt=" ">
                            </div>
                            <div class="col-lg-3 main-menu-sert">
                                <img src="/images/iso9001.png" alt=" ">
                            </div>
                        </div>
                        <a href="{{$mainMenu['menu-serts']->urn}}" class="main-menu-company-link">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-menu-company-block">
                        <p class="main-menu-company-header">{{$mainMenu['menu-manufacturers']->name}}</p>
                        <p class="main-menu-company-intro">{{$mainMenu['menu-manufacturers']->introtext}}</p>
                        <a href="{{$mainMenu['menu-manufacturers']->urn}}" class="main-menu-company-link">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-menu-company-block">
                        <p class="main-menu-company-header">Новости</p>
                        <div class="main-menu-news">
                            <p class="main-menu-news-date">{{$mainMenu['last-news']->created_at->format('d.m.Y')}}</p>
                            <p class="main-menu-news-header">{{$mainMenu['last-news']->title}}</p>
                        </div>
                        <p class="main-menu-company-intro">{{$mainMenu['last-news']->introtext}}</p>
                        <a href="{{$mainMenu['last-news']->urn}}" class="main-menu-company-link">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-menu-company-block">
                        <p class="main-menu-company-header">Отзывы</p>
                        <div class="main-menu-review">
                            <p class="main-menu-review-date">{{$mainMenu['last-review']->created_at->format('d.m.Y')}}</p>
                            <p class="main-menu-review-header">{{$mainMenu['last-review']->title}}</p>
                        </div>
                        <p class="main-menu-company-intro">{{$mainMenu['last-review']->introtext}}</p>
                        <a href="{{$mainMenu['last-review']->urn}}" class="main-menu-company-link">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-menu-company-block">
                        <div class="main-menu-subinfo">
                            <a href="#" style="background-image: url('/images/info.png')">Реквизиты</a>
                            <a href="#" style="background-image: url('/images/catalog.png')">Каталог в PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-exit-button">
        <span class="icon-exit"></span>
    </div>
</div>
