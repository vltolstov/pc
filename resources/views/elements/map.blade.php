<div class="map">
    <div class="container">
        <div class="row map-wrap">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="map-header">
                    <h3>География поставок и запусков</h3>
                </div>
                <div class="map-block">
                    <object class="map-svg" data="/images/map.svg" type="image/svg+xml"></object>
                </div>
                <div class="map-flex">
                    @foreach($projects as $project)
                        @if(isset($project->image))
                            <a href="{{$project->urn}}"
                                class="map-project"
                                data-id="{{$loop->iteration}}"
                                @foreach(json_decode($project->params, true) as $param)
                                    @if($param['name'] == 'город')
                                        data-city="{{Str::slug($param['value'], '-')}}"
                                    @endif
                                @endforeach
                                style="background-image: url('{{json_decode($project->image, true)['image-1']['200x150']}}')"
                            >
                                <p>{{$project->name}}</p>
                            </a>
                        @else
                            <img src="/images/default-200x150.png" alt=" ">
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
