@isset($createNew)

    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{route('page.store')}}" enctype="multipart/form-data" method="POST" name="create">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <h2 class="admin-h2">Новая страница</h2>
            </div>
        </div>

        <div class="admin-edit">
            <div class="admin-form">
                <label>Название</label>
                <div class="bord @error('name') form-error @enderror">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <input type="text" name="name" placeholder="Название" value="{{ old('name') }}" maxlength="50" class="name">
                </div>
                <label>URI</label>
                <div class="bord @error('urn') form-error @enderror">
                    @error('urn')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <input type="text" name="urn" placeholder="URI" value="{{ old('urn') }}" class="urn">
                </div>
                <label>Тип страницы</label>
                <div class="bord">
                    <select name="page_type_id">
                        @foreach($pageTypes as $type)
                            <option value="{{ $type->id }}">{{$type->type_lexicon}}</option>
                        @endforeach
                    </select>
                </div>
                <label>Статус страницы</label>
                <div class="bord">
                    <select name="active">
                        <option value="1">Вкл</option>
                        <option value="0">Выкл</option>
                    </select>
                </div>
                <label>Является категорией</label>
                <div class="bord">
                    <select name="category">
                        <option value="0">Нет</option>
                        <option value="1">Да</option>
                    </select>
                </div>
                <label>Категория | Подкатегория</label>
                <div class="bord">
                    <select name="parent_id">
                        <option value="0">Без категории</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <label>Изображение</label>
                <div class="add-images-button">(Добавить еще изображения)</div>
                <div class="images">
                    <div class="bord image-1">
                        <div class="del-button"><span class="icon-exit"></span></div>
                        <input type="file" name="image-1">
                    </div>
                </div>
                <label>Заголовок</label>
                <div class="bord @error('title') form-error @enderror">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <input type="text" name="title" placeholder="Заголовок" value="{{ old('title') }}" maxlength="70">
                </div>
                <label>Описание</label>
                <div class="bord @error('description') form-error @enderror">
                    @error('description')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <input type="text" name="description" placeholder="Описание" value="{{ old('description') }}" maxlength="160">
                </div>
                <label>Ключевые слова</label>
                <div class="bord">
                    <input type="text" name="keywords" placeholder="Ключевые слова" value="{{ old('keywords') }}">
                </div>
                <label>Интро</label>
                <div class="bord @error('introtext') form-error @enderror">
                    @error('introtext')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <input type="text" name="introtext" placeholder="Интро" value="{{ old('introtext') }}">
                </div>
                <label>Параметры</label>
                <div class="add-params-button">(Добавить еще параметр)</div>
                <div class="param-labels row">
                    <div class="delCol">
                    </div>
                    <div class="col-lg-5">
                        <p>Наименование</p>
                    </div>
                    <div class="col-lg-4">
                        <p>Значение</p>
                    </div>
                    <div class="col-lg-1">
                        <p align="center">Приоритет</p>
                    </div>
                    <div class="col-lg-1">
                        <p align="center">Скрыт</p>
                    </div>
                </div>
                <div class="params">
                    <div class="params-line row">
                        <div class="del-button"><span class="icon-exit"></span></div>
                        <input class="col-lg-5" type="text" name="param-name-1" placeholder="Параметр" value="{{ old('param-name-1') }}">
                        <input class="col-lg-4" type="text" name="param-value-1" placeholder="Значение" value="{{ old('param-value-1') }}">
                        <input class="col-lg-1" type="checkbox" name="param-active-1" value="1">
                        <input class="col-lg-1" type="checkbox" name="param-hide-1" value="1">
                    </div>
                </div>
                <label>Контент</label>
                <div>
                    <textarea name="content" placeholder="Контент" id="content"></textarea>
                </div>
                <div class="row">
                    <div class="col-lg-12 save-button">
                        <button type="submit" class="admin-button">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endisset
