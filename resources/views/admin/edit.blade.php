@isset($currentPage)

    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{route('page.update', $currentPage->id)}}" enctype="multipart/form-data" method="POST" name="create">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <h2 class="admin-h2">Редактирование</h2>
            </div>
        </div>

        <div class="admin-edit">

            @method('PUT')
            <div class="admin-form">
                <label>Название</label>
                <div class="bord">
                    <input type="text" name="name" placeholder="Название" value="{{ $currentPage->name }}" maxlength="50">
                    <input type="hidden" name="urn" value="{{$slug}}">
                </div>
                <label>Тип страницы</label>
                <div class="bord">
                    <select name="page_type_id">
                        @foreach($pageTypes as $type)
                            <option value="{{ $type->id }}" @if($currentPage->page_type_id == $type->id) selected @endif>{{$type->type_lexicon}}</option>
                        @endforeach
                    </select>
                </div>
                <label>Статус страницы</label>
                <div class="bord">
                    <select name="active">
                        @if($currentPage->active == 1)
                            <option value="1">Вкл</option>
                            <option value="0">Выкл</option>
                        @else
                            <option value="0">Выкл</option>
                            <option value="1">Вкл</option>
                        @endif
                    </select>
                </div>
                <label>Является категорией</label>
                <div class="bord">
                    <select name="category">
                        @if($isCategory)
                            <option value="0">Нет</option>
                            <option value="1">Да</option>
                        @else
                            <option value="1">Да</option>
                            <option value="0">Нет</option>
                        @endif
                    </select>
                </div>
                <label>Категория | Подкатегория</label>
                <div class="bord">
                    <select name="parent_id">
                        <option value="0">Без категории</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($currentPage->parent_id == $category->id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <label>Изображение</label>
                <div class="add-images-button">(Добавить еще изображения)</div>
                @if(isset($images))
                    <div class="images">
                        @foreach($images as $image)
                            <div class="bord">
                                <div class="del-button"><span class="icon-exit"></span></div>
                                <img src="{{$image['main']}}" width="150px">
                                <input type="hidden" name="upload-images[]" value="{{$image['main']}}">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="images">
                        <div class="bord">
                            <div class="del-button"><span class="icon-exit"></span></div>
                            <input type="file" name="image-1">
                        </div>
                    </div>
                @endif

                <label>Заголовок</label>
                <div class="bord">
                    <input type="text" name="title" placeholder="Заголовок" value="{{ $seoSet->title }}" maxlength="70">
                </div>
                <label>Описание</label>
                <div class="bord">
                    <input type="text" name="description" placeholder="Описание" value="{{ $seoSet->description }}" maxlength="160">
                </div>
                <label>Ключевые слова</label>
                <div class="bord">
                    <input type="text" name="keywords" placeholder="Ключевые слова" value="{{ $seoSet->keywords }}">
                </div>
                <label>Интро</label>
                <div class="bord">
                    <input type="text" name="introtext" placeholder="Интро" value="{{ $contentSet->introtext }}">
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
                @if(isset($params))
                    <div class="params">
                        @foreach($params as $param)
                            <div class="params-line row">
                                <div class="del-button"><span class="icon-exit"></span></div>
                                <input
                                    class="col-lg-5"
                                    type="text"
                                    name="param-name-{{$loop->index + 1}}"
                                    placeholder="Параметр"
                                    value="{{$param['name']}}"
                                >
                                <input
                                    class="col-lg-4"
                                    type="text"
                                    name="param-value-{{$loop->index + 1}}"
                                    placeholder="Значение"
                                    value="{{$param['value']}}"
                                >
                                <input
                                    class="col-lg-1"
                                    type="checkbox"
                                    name="param-active-{{$loop->index + 1}}"
                                    value="{{$param['active']}}"
                                    @if($param['active']) checked @endif
                                >
                                <input
                                    class="col-lg-1"
                                    type="checkbox"
                                    name="param-hide-{{$loop->index + 1}}"
                                    value="{{$param['hide']}}"
                                    @if($param['hide']) checked @endif
                                >
                            </div>
                        @endforeach
                    </div>
                @else
                <div class="params">
                    <div class="params-line row">
                        <div class="del-button"><span class="icon-exit"></span></div>
                        <input class="col-lg-5" type="text" name="param-name-1" placeholder="Параметр" value="{{ old('param-name-1') }}">
                        <input class="col-lg-4" type="text" name="param-value-1" placeholder="Значение" value="{{ old('param-value-1') }}">
                        <input class="col-lg-1" type="checkbox" name="param-active-1" value="1">
                        <input class="col-lg-1" type="checkbox" name="param-hide-1" value="1">
                    </div>
                </div>
                @endif

                <label>Контент</label>
                <div class="cke-editor">
                    <textarea name="content" placeholder="Контент" id="ckeditor">
                        {{ $contentSet->content }}
                    </textarea>
                </div>
                <div class="row">
                    <div class="col-lg-12 save-button">
                        <button type="submit" class="admin-button">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('page.destroy', $currentPage->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="row">
            <div class="col-lg-12 delete-block">
                <button type="submit" class="delete-button">Удалить страницу</button>
            </div>
        </div>
    </form>
@endisset
