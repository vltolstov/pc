<div class="slider">
    @foreach($slides as $slide)
        <div class="slider-wrap" style="background-image: url('{{json_decode($slide->images, true)['image-1']['2000x1500']}}')">
            <div class="container">
                    @switch(json_decode($slide->params, true)[0]['value'])
                        @case('top-left')
                            <div class="slide-top-left">
                        @break
                        @case('top-right')
                            <div class="slide-top-right">
                        @break
                        @case('bottom-left')
                            <div class="slide-bottom-left">
                        @break
                        @case('bottom-right')
                            <div class="slide-bottom-right">
                        @break
                    @endswitch
                                <div class="slide-flex-item">
                                    <p class="slide-header">{{$slide->title}}</p>
                                    <div class="slide-info">{!! $slide->content !!}</div>
                                </div>
                            </div>
            </div>
        </div>
    @endforeach
</div>
