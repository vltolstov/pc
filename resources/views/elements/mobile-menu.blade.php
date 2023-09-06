<div class="mobile-panel">
    <ul>
        <li><a href="o-kompanii">О компании</a></li>
        <li><a href="kontakty">Контакты</a></li>
        <li><a href="katalog" class="mobile-catalog">Каталог</a></li>
    </ul>
</div>

<div class="mobile-menu hide">
    <div class="mobile-menu-wrap">
        <div class="row">
            <div class="col-xs-12">
                <ul class="mobile-submenu">
                    @foreach($mainMenu['catalog-items'] as $item)
                        @if($item->parent_id == 2)
                            <li>
                                <a href="{{$item->urn}}" class="mobile-menu-first-item">{{$item['name']}}</a>
                                <ul>
                                    @foreach($mainMenu['catalog-items'] as $subMenuItem)
                                        @if($subMenuItem->parent_id == $item->id)
                                            <li>
                                                <a href="{{$subMenuItem->urn}}">{{$subMenuItem->name}}</a>
                                                <ul>
                                                    @foreach($mainMenu['catalog-items'] as $endItem)
                                                        @if($endItem->parent_id == $subMenuItem->id)
                                                            <li>
                                                                <a href="{{$endItem->urn}}">{{$endItem->name}}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-exit-button">
        <span class="icon-exit"></span>
    </div>
</div>
