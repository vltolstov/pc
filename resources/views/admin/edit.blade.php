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
                    <input type="text" name="name" placeholder="Название" value="{{ $currentPage->name }}" maxlength="100">
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
                            <option value="1">Да</option>
                            <option value="0">Нет</option>
                        @else
                            <option value="0">Нет</option>
                            <option value="1">Да</option>
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
                                <img src="{{$image['200x150']}}" width="200px">
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
                                    @if($param['active'])
                                        value="1" checked
                                    @else
                                        value="1"
                                    @endif
                                >
                                <input
                                    class="col-lg-1"
                                    type="checkbox"
                                    name="param-hide-{{$loop->index + 1}}"
                                    @if($param['hide'])
                                        value="1" checked
                                    @else
                                        value="1"
                                    @endif
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
                <div class="tiny-editor">
                    <textarea name="content" placeholder="Контент" class="editor">{{ $contentSet->content }}</textarea>
                </div>
                @if($isCategory)
                    <div class="complete-solution">
                        <label>Комплексное решение</label>
                        <div class="bord">
                            <textarea name="solution_text" placeholder="Описание решения" class="complete-solution-text">@isset($solution->solution_text){{$solution->solution_text}}@endisset</textarea>
                        </div>
                        @if(isset($solution->solution_image))
                            <div class="solution-image">
                                <div class="bord">
                                    <div class="del-button"><span class="icon-exit"></span></div>
                                    <img src="{{$solution->solution_image}}" width="200px">
                                    <input type="hidden" name="solution_image" value="{{$solution->solution_image}}">
                                </div>
                            </div>
                        @else
                            <div class="solution-image">
                                <div class="bord">
                                    <div class="del-button"><span class="icon-exit"></span></div>
                                    <input type="file" name="solution_image">
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                @if(isset($advantages))
                    <div class="advantages-adm-block">
                        <label>Преимущества</label>
                        @foreach($advantages as $advantage)
                            <div class="bord">
                                <input type="text" name="advantage-header-{{$loop->index + 1}}" placeholder="Заголовок №1" value="{{$advantage['advantage-header']}}">
                                <input type="text" name="advantage-info-{{$loop->index + 1}}" placeholder="Описание" value="{{$advantage['advantage-info']}}">
                            </div>
                        @endforeach
                    </div>
                    @else
                    <div class="advantages-adm-block">
                        <label>Преимущества</label>
                        <div class="bord">
                            <input type="text" name="advantage-header-1" placeholder="Заголовок №1" value="{{ old('advantage-header-1') }}">
                            <input type="text" name="advantage-info-1" placeholder="Описание" value="{{ old('advantage-info-1') }}">
                        </div>
                        <div class="bord">
                            <input type="text" name="advantage-header-2" placeholder="Заголовок №2" value="{{ old('advantage-header-2') }}">
                            <input type="text" name="advantage-info-2" placeholder="Описание" value="{{ old('advantage-info-2') }}">
                        </div>
                        <div class="bord">
                            <input type="text" name="advantage-header-3" placeholder="Заголовок №3" value="{{ old('advantage-header-3') }}">
                            <input type="text" name="advantage-info-3" placeholder="Описание" value="{{ old('advantage-info-3') }}">
                        </div>
                    </div>
                @endif
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
