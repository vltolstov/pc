@extends('layouts.main')

@section('test-layout')

<div class="head">
    <div class="container">
        <header>
            <div class="head-flex">
                <div class="logo">
                    <img src="/images/logo.png" height="64" alt="logo">
                </div>
                <div class="head-menu">
                    <ul>
                        <li><a href="#">Раздел №1</a></li>
                        <li><a href="#">Раздел №2</a></li>
                        <li><a href="#">Раздел №3</a></li>
                        <li><a href="#">Раздел №4</a></li>
                        <li><a href="#">Рвздел №5</a></li>
                    </ul>
                </div>
                <div class="head-contacts">
                    <div class="contacts-block">
                        <p><a class="main-tel" href="tel:80000000000">8 000 000-00-00</a></p>
                        <p><a class="mobile-tel" href="tel:70000000000">+7 000 000-00-00</a></p>
                        <p><a class="head-mail" href="mailto:email@mail.ma">email@mail.ma</a></p>
                        <p class="head-city">г. Новосибирск</p>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>

<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                слайд
            </div>
        </div>
    </div>
</div>

<div class="offers">
    <div class="container">
        <div class="row offers-wrap offers-wrap-close">
            <div class="col-lg-4">
                <a href="#" class="offer" style="background-image: url('/images/test-1000x750.png')">
                    <p class="offer-title">Длинное название для проверки на несколько строк и много символов</p>
                    <p class="offer-price">0000000 руб.</p>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#" class="offer" style="background-image: url('/images/test-1000x750.png')">
                    <p class="offer-title">Длинное название для проверки на несколько строк и много символов</p>
                    <p class="offer-price">0000000 руб.</p>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#" class="offer" style="background-image: url('/images/test-1000x750.png')">
                    <p class="offer-title">Длинное название для проверки на несколько строк и много символов</p>
                    <p class="offer-price">0000000 руб.</p>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#" class="offer" style="background-image: url('/images/test-1000x750.png')">
                    <p class="offer-title">Длинное название для проверки на несколько строк и много символов</p>
                    <p class="offer-price">0000000 руб.</p>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#" class="offer" style="background-image: url('/images/test-1000x750.png')">
                    <p class="offer-title">Длинное название для проверки на несколько строк и много символов</p>
                    <p class="offer-price">0000000 руб.</p>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#" class="offer" style="background-image: url('/images/test-1000x750.png')">
                    <p class="offer-title">Длинное название для проверки на несколько строк и много символов</p>
                    <p class="offer-price">0000000 руб.</p>
                </a>
            </div>
            <div class="offers-open-button">
                <a class="offers-link" href="#">Показать еще</a>
            </div>
        </div>
    </div>
</div>

<div class="map">
    <div class="container">
        <div class="row map-wrap">
            <div class="col-lg-12">

                <div class="map-header">
                    <h3>География поставок и запусков</h3>
                </div>
                <div class="map-block">
                    <object class="map-svg" data="/images/map.svg" type="image/svg+xml"></object>
                </div>
                <div class="map-flex">
                    <a href="#" class="map-project" data-id="1" data-city="bratsk" style="background-image: url('/images/test-1000x750.png')">
                        <p>Текстовое поле для вывода длиного заголовка с переносом строки множеством букв</p>
                    </a>
                    <a href="#" class="map-project" data-id="2" data-city="moskva" style="background-image: url('/images/test-1000x750.png')">
                        <p>Запуск плавильной печи GWJ 0.45-300-1</p>
                    </a>
                    <a href="#" class="map-project" data-id="3" data-city="novosibirsk" style="background-image: url('/images/test-1000x750.png')">
                        <p>Поставка дробеметной установки проходного типа QB4948</p>
                    </a>
                    <a href="#" class="map-project" data-id="4" data-city="perm" style="background-image: url('/images/test-1000x750.png')">
                        <p>Текстовое поле для вывода заголовка</p>
                    </a>
                    <a href="#" class="map-project" data-id="5" data-city="penza" style="background-image: url('/images/test-1000x750.png')">
                        <p>Текстовое поле для вывода заголовка</p>
                    </a>
                    <a href="#" class="map-project" data-id="6" data-city="tver" style="background-image: url('/images/test-1000x750.png')">
                        <p>Текстовое поле для вывода заголовка</p>
                    </a>
                    <a href="#" class="map-project" data-id="7" data-city="vladivostok" style="background-image: url('/images/test-1000x750.png')">
                        <p>Текстовое поле для вывода заголовка</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="special-offer">
    <div class="container">
        <div class="row special-offer-wrap">
            <div class="col-lg-12">
                <div class="special-offer-headers">
                    <h3>Специальное предложение</h3>
                    <p>Подзаголовок - однострочное описание</p>
                </div>
                <div class="row special-offer-flex">
                    <div class="special-offer-info col-lg-4 order-3">
                        <p class="special-offer-name">Заголовок продукта на несколько строк</p>
                        <p class="special-offer-price">000000 руб.<br><span>в наличии</span></p>
                    </div>
                    <div class="special-offer-text col-lg-4 order-2">
                        <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                            и реализации дальнейших направлений развития.</p>
                        <p>Идейные соображения высшего порядка, а также
                            постоянное информационно-пропагандистское обеспечение нашей деятельности играет важную роль
                            в формировании существенных финансовых и административных условий.</p>
                    </div>
                    <div class="special-offer-image col-lg-4 order-1">
                        <img src="/images/test-1000x750.png" alt=" ">
                    </div>
                </div>
                <div class="special-offer-button">
                    <a href="#">Кнопка заказа / запроса информации</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="catalog">
    <div class="container">
        <div class="row catalog-wrap">
            <div class="col-lg-5">
                <div class="catalog-headers">
                    <h3>Каталог</h3>
                    <p>Подзаголовок</p>
                </div>
                <p class="catalog-info">Повседневная практика показывает, что консультация с широким активом способствует подготовки
                    и реализации дальнейших направлений развития.</p>
                <p class="catalog-info">Идейные соображения высшего порядка, а также
                    постоянное информационно-пропагандистское обеспечение нашей деятельности играет важную роль
                    в формировании существенных финансовых и административных условий.</p>
                <div class="catalog-button">
                    <a href="#">Показать еще</a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="catalog-item">
                            <a href="#">
                                <div class="catalog-icon">
                                    <img src="/images/test-1000x750.png">
                                </div>
                                <p>Название</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="advantages">
    <div class="container">
        <div class="row advantages-wrap">
            <div class="col-lg-12">
                <div class="advantages-headers">
                    <h3>Преимущества работы с нами</h3>
                    <p>Подзаголовок - однострочное описание</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row advantages-flex">
                    <div class="col-lg-4">
                        <div class="advantage">
                            <div class="advantage-icon-wrap">
                                <div class="advantage-icon">
                                    <span class="icon-cost"></span>
                                </div>
                            </div>
                            <div class="advantage-text-wrap">
                                <h4>Заголовок</h4>
                                <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                                    и реализации дальнейших направлений развития.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="advantage">
                            <div class="advantage-icon-wrap">
                                <div class="advantage-icon">
                                    <span class="icon-service"></span>
                                </div>
                            </div>
                            <div class="advantage-text-wrap">
                                <h4>Заголовок</h4>
                                <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                                    и реализации дальнейших направлений развития.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="advantage">
                            <div class="advantage-icon-wrap">
                                <div class="advantage-icon">
                                    <span class="icon-guarantees"></span>
                                </div>
                            </div>
                            <div class="advantage-text-wrap">
                                <h4>Заголовок</h4>
                                <p>Повседневная практика показывает, что консультация с широки</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news">
    <div class="container">
        <div class="row news-headers-wrap">
            <div class="col-lg-12">
                <div class="news-headers">
                    <h3>Новости</h3>
                    <p>Самое важное</p>
                </div>
            </div>
        </div>
        <div class="row news-wrap">
            <div class="col-lg-12">
                <div class="row flex">
                    <div class="col-lg-4">
                        <div class="news-block">
                            <div class="news-header news-special">
                                <a href="#">Заголовок новости на две строки для проверки переноса</a>
                            </div>
                            <div class="news-text">
                                <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                                    и реализации дальнейших направлений развития. Повседневная практика показывает, что консультация с широким активом способствует подготовки
                                    и реализации дальнейших направлений развития.</p>
                            </div>
                            <div class="news-date">
                                <p>00.00.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="news-block">
                            <div class="news-header">
                                <a href="#">Заголовок новости на две строки для проверки переноса</a>
                            </div>
                            <div class="news-text">
                                <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                                    и реализации дальнейших направлений развития. Повседневная практика показывает, что консультация с широким активом способствует подготовки
                                    и реализации дальнейших направлений развития.</p>
                            </div>
                            <div class="news-date">
                                <p>00.00.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="news-block">
                            <div class="news-header">
                                <a href="#">Заголовок новости на две строки для проверки переноса</a>
                            </div>
                            <div class="news-text">
                                <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                                    и реализации дальнейших направлений развития.</p>
                            </div>
                            <div class="news-date">
                                <p>00.00.0000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="news-button">
            <a href="#">Показать еще</a>
        </div>
    </div>
</div>

<div class="about">
    <div class="container">
        <div class="row about-headers-wrap">
            <div class="col-lg-12">
                <div class="about-headers">
                    <h3>О компании</h3>
                    <p>работаем с 2000 года</p>
                </div>
            </div>
        </div>
        <div class="row about-wrap">
            <div class="col-lg-4">
                <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                    и реализации дальнейших направлений развития.</p>
                <h5>проверено</h5>
                <p>Повседневная практика показывает, что консультация с широким активом способствует подготовки
                    и реализации дальнейших направлений развития.</p>
                <a href="#">Подробнее</a>
            </div>
            <div class="col-lg-8">
                <div class="about-video">
                    <h5>Видеопрезентация</h5>
                    <div class="presentation">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="consultation">
    <div class="container">
        <div class="consultation-wrap consultation-flex">
            <div class="consultation-headers">
                <h3>Нужна консультация?</h3>
                <p class="post-header">ответим на любые вопросы</p>
                <p>Подробно расскажем о наших услугах, видах работ, и типовых проектах,
                    рассчитаем стоимость и подготовим индивидуальное предложение!</p>
            </div>
            <div class="consultation-button">
                <a href="#">Написать сообщение</a>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="row footer-flex">
        <div class="col-lg-6">
            <div class="footer-left">
                <h3>Контакты</h3>
                <p class="footer-post-header">Новосибирск, Улица 00, 00</p>
                <div class="row">
                    <div class="col-lg-6">
                        <p class="footer-mini-header">Станция метро</p>
                        <p class="footer-info">Красный проспект</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="footer-mini-header">Режим работы</p>
                        <p class="footer-info">Пн-Пт: 09:00-18:00</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="footer-mini-header">E-Mail</p>
                        <p class="footer-info">email@email.email</p>
                    </div>
                    <div class="col-lg-6">
                        <p class="footer-mini-header">Телефон</p>
                        <p class="footer-info">8-000-000-00-00</p>
                    </div>
                </div>
                <div class="footer-button">
                    <a href="#">Написать сообщение</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="footer-map">

            </div>
        </div>
    </div>
    <div class="footer-line">
        <p>Подробно расскажем о наших услугах, видах работ, и типовых проектах,
            рассчитаем стоимость и подготовим индивидуальное предложение! Подробно расскажем о наших услугах, видах работ, и типовых проектах,
            рассчитаем стоимость и подготовим индивидуальное предложение! Подробно расскажем о наших услугах, видах работ, и типовых проектах,
            рассчитаем стоимость и подготовим индивидуальное предложение!</p>
    </div>
</div>


@endsection
