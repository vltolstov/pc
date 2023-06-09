<div class="overlay hide">
    <div class="exit-button">
        <span class="icon-exit"></span>
    </div>
    <div class="form-wrap">
        <div class="send-form">
            <p class="form-header">Заполните форму</p>
            <form class="modal-form">
                @csrf
                <div class="name-alert">
                    <input type="hidden" name="name" value="">
                </div>
                <input type="hidden" name="title" value="{{$title}}">
                <div class="bord imfa-alert">
                    <div class="imfa-error error-message hide">Ошибка! Проверьте имя</div>
                    <input name="imfa" type="text" value="" placeholder="Фамилия Имя">
                </div>
                <div class="bord email-alert">
                    <div class="email-error  error-message hide">Ошибка! Проверьте E-mail</div>
                    <input name="email" type="text" value="" placeholder="Email">
                </div>
                <div class="bord phone-alert">
                    <div class="phone-error  error-message hide">Ошибка! Проверьте телефон</div>
                    <input name="phone" type="text" value="" placeholder="Телефон">
                </div>
                <div class="bord">
                    <input name="сomment" type="text" value="" placeholder="Сообщение">
                </div>
                <button type="button" class="ajaxFormButton admin-button">Отправить</button>
            </form>
        </div>
    </div>
</div>
