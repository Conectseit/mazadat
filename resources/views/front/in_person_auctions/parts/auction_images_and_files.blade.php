<div class="more">
    <div class="terms">
        <h4>{{ trans('messages.auction.images')}}:</h4>
    </div>
    <div class="row">
        {{--                        <div class="col-md-10 col-10 mx-auto">--}}
            {{--                            <div id="carouselExample" class="carousel slide w-100" data-bs-ride="carousel"--}}
                                                 {{--                                 data-bs-interval="3000">--}}
                {{--                                <div class="carousel-indicators">--}}
                    {{--                                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0"--}}
                                                                    {{--                                            class="active"></button>--}}
                    {{--                                    <button type="button" data-bs-target="#carouselExample"--}}
                                                                    {{--                                            data-bs-slide-to="1"></button>--}}
                    {{--                                    <button type="button" data-bs-target="#carouselExample"--}}
                                                                    {{--                                            data-bs-slide-to="2"></button>--}}
                    {{--                                </div>--}}
                {{--                                <div class="carousel-inner">--}}
                    {{--                                    <div class="carousel-item active">--}}
                        {{--                                        <a href="{{$auction->first_image_path}}" data-popup="lightbox">--}}
                            {{--                                        <img class="d-block w-100 h-100" src="{{$auction->first_image_path}}" alt="First slide">--}}
                            {{--                                        </a>--}}
                        {{--                                    </div>--}}
                    {{--                                    @foreach($images as $image)--}}
                    {{--                                        <div class="carousel-item">--}}
                        {{--                                            <a href="{{$image->image_path}}" data-popup="lightbox">--}}
                            {{--                                                <img class="d-block w-100 h-100" src="{{$image->image_path}}" alt="image">--}}
                            {{--                                            </a>--}}
                        {{--                                        </div>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </div>--}}
                {{--                                <button class="carousel-control-prev" data-bs-target="#carouselExample" type="button"--}}
                                                            {{--                                        data-bs-slide="prev">--}}
                    {{--                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                    {{--                                    <span class="visually-hidden">Previous</span>--}}
                    {{--                                </button>--}}
                {{--                                <button class="carousel-control-next" data-bs-target="#carouselExample" type="button"--}}
                                                            {{--                                        data-bs-slide="next">--}}
                    {{--                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                    {{--                                    <span class="visually-hidden">Next</span>--}}
                    {{--                                </button>--}}
                {{--                            </div>--}}
            {{--                        </div>--}}


        <div class="container col-md-12 col-10">
            <div class="owl-carousel categories-bar-carousel owl-theme">

                @foreach($images as $image)
                <div class="item" style="height: 150px; width: 150px;">
                    <div class="image w-100 h-100">
                        <a class="" href="{{$image->image_path}}" target="_blank"
                           data-popup="lightbox">
                            <img class="d-block w-100 h-100" src="{{$image->image_path}}"
                                 alt="image">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
<hr>
<div class="more-imgs">
    <div class="terms">
        <h4>{{ trans('messages.auction.inspection_report_files')}}:</h4>
    </div>
    <div class="row">
        <div>
            @if(auth()->check())
            @if(auth()->user()->id == $auction->seller_id)
            <a href="#" class="btn btn-success m-1 p-2"
               data-bs-toggle="modal"
               data-bs-target="#upload-file-modal"><i class="fal fa-plus-circle"> </i>
                {{trans('messages.auction.addReportFile')}}</a>
            @endif
            @endif

        </div>

        @if($auction->inspectionimages->count() > 0)
        <table class="table datatable" id="inspection_report_images"
               style="font-size: 16px;">
            <thead>
            <tr>
                <th class="text-center">{{ trans('messages.auction.file') }}</th>
                <th class="text-center">@lang('messages.file_name')</th>
                <th class="text-center">{{ trans('messages.file_desc') }}</th>
                @if(auth()->check())
                @if(auth()->user()->id == $auction->seller_id)
                <th class="text-center">@lang('messages.form-actions')</th>
                @endif
                @endif

            </tr>
            </thead>
            <tbody>
            @foreach($auction->inspectionimages as $file)
            <tr id="inspection_report_image-row-{{ $file->id }}">
                <td class="text-center">
                    <a href="{{route('inspection_view_file',$file->id)}}" target="_blank">
                        <img src="{{asset('Front/assets/imgs/pdf-icon.jpg')}}" alt="image"
                             style="width: 50px;">
                    </a>
                </td>
                <td class="text-center">{{ isset($file->file->name) ? $file->file->name:'..' }}</td>
                <td class="text-center">{{ isset($file->description) ? $file->description:'..' }}</td>
                @if(auth()->check())
                @if(auth()->user()->id == $auction->seller_id)
                <td class="text-center">
                    <div class="buttons ">
                        {{--                                <a href="{{route('front.auction_show_update',$auction->id)}}"--}}
                                                               {{--                                   class="bid">@lang('messages.update')</a>--}}
                        <a data-id="{{ $file->id }}" class="delete-report-file"
                           href="{{route('inspection_view_file',$file->id)}}"
                           style="background-color: #1e3c48;">
                            <i class="icon-database-remove"></i>@lang('messages.delete')
                        </a>

                    </div>
                </td>
                @endif
                @endif

            </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <div style="text-align: center;"><h3> @lang('messages.no_data_found') </h3>
        </div>
        @endif

    </div>
</div>
<hr>
<div class="more-imgs">
    <div class="terms">
        <h4>{{ trans('messages.auction.options')}}:</h4>
    </div>
    <div class="row">
        @foreach($auction->auctiondata as $option)

        <div class="col-md-3 col-6">
            <div class="description" id="description">
                <h5>{{$option->option_detail->option->$name}}:</h5>
                <p>{{$option->option_detail->$value}}</p>
            </div>
            <br>
        </div>
        @endforeach
    </div>
</div>
<hr>
