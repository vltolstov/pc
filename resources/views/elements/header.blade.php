<div class="head">
    <div class="container">
        <header>
            <div class="head-flex">
                <div class="logo">
                    @if($id == 1)
                        <img src="{{$companyLogo}}" height="43" alt="logo">
                    @else
                        <a href="/"><img src="{{$companyLogo}}" height="43" alt="logo"></a>
                    @endif
                </div>
                <div class="head-menu">
                    <ul>
                        <li><a href="katalog" class="top-menu-catalog">Каталог</a></li>
                        <li><a href="proektirovanie-litejnyix-czexov" class="top-menu-engineering">Проектирование</a></li>
                        <li><a href="portfolio" class="top-menu-portfolio">Портфолио</a></li>
                        <li><a href="o-kompanii" class="top-menu-company">О компании</a></li>
                        <li><a href="kontakty">Контакты</a></li>
                    </ul>
                </div>
                <div class="head-contacts">
                    <div class="contacts-block">
                        <p><a class="main-tel" href="tel:{{Str::remove([' ', '-'], $phone)}}">{{$phone}}</a></p>
                        <p><a class="mobile-tel" href="tel:{{Str::remove([' ', '-'], $mobilePhone)}}">{{$mobilePhone}}</a></p>
                        <p><a class="head-mail" href="mailto:{{$email}}">{{$email}}</a></p>
                        <p class="head-city">г. Москва</p>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>
