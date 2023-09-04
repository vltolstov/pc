<div class="footer">
    <div class="row footer-flex">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="footer-left">
                <h3>Контакты</h3>
                <p class="footer-post-header">{{$postAddress}}</p>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <p class="footer-mini-header">Станция метро</p>
                        <p class="footer-info">{{$metro}}</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <p class="footer-mini-header">Режим работы</p>
                        <p class="footer-info">{{$workTime}}</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <p class="footer-mini-header">E-Mail</p>
                        <p class="footer-info"><a href="mailto:{{$email}}">{{$email}}</a></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <p class="footer-mini-header">Телефон</p>
                        <p class="footer-info">{{$phone}}</p>
                    </div>
                </div>
                <div class="footer-button request-button" data-title="Сообщение с сайта">
                    <p>Написать сообщение</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="footer-map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A9fe861dc8205928f4318a2dcfa1f4c077fe13708d5a3322ec2609a8cbcc3f58e&amp;width=968&amp;height=653&amp;lang=ru_RU&amp;scroll=false"></script>
            </div>
        </div>
    </div>
    <div class="footer-line">
        <p>{{$companyName}} 2023. Все материалы сайта защищены авторскими правами. Копирование и использование на других ресурсах запрещено.
            * Вся информация представленная на сайте носит информационный характер и не является публичной офертой. По вопросам наличия оборудования и актуальным ценам вы можете обратится в отдел продаж по номеру {{$phone}} или отправив заявку на почту {{$email}}</p>
    </div>
</div>
